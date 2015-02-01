<?php
App::uses('AppController', 'Controller');
/**
 * Projects Controller
 *
 */
class ProjectsController extends AppController {

	public function index() {
		// 根据用户身份筛选其所有的项目
		// TODO: 应该以user_projects为依据
		$this->Project->bindModel(array('hasMany' => array('Deployment' => array('className' => 'Deployment'))));
		$this->Project->bindModel(array('hasMany' => array('Server' => array('className' => 'Server'))));
		$projects = $this->Project->find('all', array('conditions' => array('user_id' => $this->Auth->user('id'))));

		$this->set('projectList', $projects);
	}

	public function add() {
		// 如果是POST请求和JSON响应要求，则视为创建项目请求
		if($this->request->is('post') && $this->request->accepts('application/json')) {
			// 添加数据库记录
			$project = $this->Project->create($this->request->data['project']);
			$project['Project']['user_id'] = $this->Auth->user('id');
			$this->Project->save($project);
			// 组装JSON数组
			$project = $this->Project->findById($this->Project->getInsertID());
			$projectRecord['name']        = $project['Project']['name'];
			$projectRecord['permalink']  = $project['Project']['id'];
			$projectRecord['public_key'] = $project['Project']['public_key'];
			$projectRecord['repository'] = null;

			$this->jsonResponse($projectRecord);
		}
	}

	public function edit($project_id) {
		// 需要项目级导航菜单
		$this->_needProjectMenuBar = true;
		$this->set('needProjectMenuBar', $this->_needProjectMenuBar);

		$project = $this->Project->findById($project_id);

		// 非法id传入处理
		if(empty($project)) {
			throw new NotFoundException('Could not find that project');
		}

		// 初始化gidaa
		$this->loadModel('Repository');
		$repository = $this->Repository->findByProjectId($project_id);
		$gitUrl     = $repository['Repository']['url'];
		// 修改
		if($this->request->is('POST')) {
			$project = $this->Project->create($this->request->data['project']);
			$this->Project->save($project);
			$newRepository = $this->Repository->create($this->request->data['repository']);
			$this->Repository->save($newRepository);

			// 代码库的url发生了变化，需要重新clone
			if(strtolower($repository['Repository']['url']) != strtolower($newRepository['Repository']['url'])) {
				$reclone = true;
				$gitUrl = $newRepository['Repository']['url'];
			}
		}
		// 获取请求或修改后的结果
		$project = $this->Project->findById($project_id);
		$repository = $this->Repository->findByProjectId($project_id);

		// 得到代码库的可用分支
		 $repoPath = $this->Repository->initGitrepo($project_id);
		if(isset($reclone) )$this->Repository->cloneRepo($repoPath, $gitUrl);
		$repository['Repository']['branches'] = $this->Repository->branches($repoPath);

		$this->set($repository);
		$this->set($project);
	}

	public function del($project_id) {
		// TODO: 1. 还会有其他的关联数据; 2. 要进行权限判断；3. 创建人和具备admin权限的人
		$this->Project->delete($project_id);
		$this->loadModel('Repository');
		$this->Repository->deleteAll(array('project_id' => $project_id));
		// 删除clone到本地的代码库
		$repoPath = $this->Repository->initGitrepo($project_id);
		$this->Repository->removeRepoDir($repoPath);

		$this->redirect(array('action' => 'index'));
	}
	public function repository($project_id) {
		// 需要项目级导航菜单
		$this->_needProjectMenuBar = true;
		$this->set('needProjectMenuBar', $this->_needProjectMenuBar);
		// 请求修改
		if($this->request->is('post')) {
			$this->loadModel('Repository');
			$repository = $this->Repository->create($this->request->data['repository']);
			$repository['Repository']['project_id'] = $project_id;
			$this->Repository->save($repository);

			// clone代码库
			$repoPath = $this->Repository->initGitrepo($project_id);
			$this->Repository->cloneRepo($repoPath, $repository['Repository']['url']);
			// 新增项目时的同步请求
			if($this->request->accepts('application/json')) {
				$this->jsonResponse($repository);
			} else {
				$this->redirect(array('action' => 'edit', $project_id));
			}

		} else {
			// 为新增准备页面，一般在项目没有设置代码库时的专门的添加操作
			// 暂无额外操作
		}
	}

	public function recache($project_id) {

		$this->loadModel('Repository');
		$repository = $this->Repository->findByProjectId($project_id);
		if(!empty($repository)) {
			// clone代码库
			$repoPath = $this->Repository->initGitrepo($project_id);
			$this->Repository->cloneRepo($repoPath, $repository['Repository']['url']);
		}

		$this->redirect($this->referer());
	}

	/**
	 * 完成特殊的要求JSON格式的请求响应
	 *
	 * @param $jsonArray
	 *
	 */
	protected function jsonResponse($jsonArray) {
		$this->response->type('json');
		$this->set('json_array', $jsonArray);
		$this->render('json_response', ''); // do not use any layout
	}
}
