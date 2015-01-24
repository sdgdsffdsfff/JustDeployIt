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
			$projectRecord['name']        = $this->request->data['project']['name'];
			$projectRecord['permalink']  = $this->Project->getInsertID();
			$projectRecord['public_key'] = 'HelloWorldSSHKEY';
			$projectRecord['repository'] = 'null';

			$this->jsonResponse($projectRecord);
		}
	}

	public function edit($project_id) {
		// 需要项目级导航菜单
		$this->set('needProjectMenuBar', true);
		// TODO: 非法id传入处理
		$project = $this->Project->find('first', array('conditions' => array('id' => $project_id)));

		if($this->loadModel('Repository')) {
			$repository = $this->Repository->find('first', array('conditions' => array('project_id' => $project_id)));
			$this->set($repository);
		}

		$this->set($project);
	}

	public function repository($project_id) {
		// 需要项目级导航菜单
		$this->set('needProjectMenuBar', true);
		// 请求修改
		if($this->request->is('post')) {
			$this->loadModel('Repository');
			$repository = $this->Repository->create($this->request->data['repository']);
			$repository['Repository']['project_id'] = $project_id;
			$this->Repository->save($repository);

			// 新增项目时的同步请求
			if($this->request->accepts('application/json')) {
				$this->jsonResponse($this->request->data['repository']);
			} else {
				$this->redirect(array('action' => 'edit', $project_id));
			}

		} else {
			// 仅为新增而来，projects/add或projects/repositiory的新增操作
			// 暂无额外操作
		}
	}

	public function recache($project_id) {
		$this->loadModel('Repository');
		$repository = $this->Repository->find('first', array('conditions' => array('project_id' => $project_id)));
		if(!empty($repository)) {
			$this->loadModel('Gitdata');
			$this->Gitdata->initGitrepo($repository['Repository']['url'], $project_id, $repository['Repository']['branch']);
			$this->Gitdata->recache();
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
