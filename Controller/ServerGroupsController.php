<?php
App::uses('AppController', 'Controller');
/**
 * ServerGroups Controller
 *
 */
class ServerGroupsController extends AppController {

    public function beforeFilter() {

        parent::beforeFilter();

        $this->loadModel('Project');
        $project = $this->Project->findById($this->request->pass[0]);

        $this->set($project);
        $this->set('needProjectMenuBar', true);

        // 本控制器和视图仅在异步调用中用到
        $this->layout = '';
    }

    public function index($project_id) {
        $serverGroupList = $this->ServerGroup->findAllByProjectId($project_id);

        $this->set('ServerGroupList', $serverGroupList);
    }

    public function add($project_id) {

        if($this->request->is('post') && $this->request->accepts('application/json')) {
            // 添加数据库记录
            $serverGroup = $this->ServerGroup->create($this->request->data['server_group']);
            $serverGroup['ServerGroup']['user_id'] = $this->Auth->user('id');
            if($this->ServerGroup->save($serverGroup)) {
                // 组装JSON数组
                $serverGroup = $this->ServerGroup->findById($this->ServerGroup->getInsertID());
                $groupRecord['identifier']        = $serverGroup['ServerGroup']['id'];
                $groupRecord['name']               = $serverGroup['ServerGroup']['name'];
                $groupRecord['preferred_branch'] = $serverGroup['ServerGroup']['branch'];
                $groupRecord['last_revision']     = $serverGroup['ServerGroup']['last_revision'];
                $groupRecord['servers']            = array();

                return $this->_jsonResponse($groupRecord);
            } else {
                return $this->_jsonResponse(array(), 500);
            }
        }

        $this->_setBaseInfo($project_id);
    }

    public function edit($project_id, $id) {
        if($this->request->is('post')) {
            $serverGroup = $this->ServerGroup->create($this->request->data['server_group']);
            $serverGroup['ServerGroup']['user_id'] = $this->Auth->user('id');
            if($this->ServerGroup->save($serverGroup)) {
                // 组装JSON数组
                $this->ServerGroup->bindModel(array('hasMany' => array('Server' => array('className' => 'Server','foreignKey' => 'server_group_identifier'))));
                $serverGroup = $this->ServerGroup->findById($id);
                $groupRecord['identifier']        = $serverGroup['ServerGroup']['id'];
                $groupRecord['name']               = $serverGroup['ServerGroup']['name'];
                $groupRecord['preferred_branch'] = $serverGroup['ServerGroup']['branch'];
                $groupRecord['last_revision']     = $serverGroup['ServerGroup']['last_revision'];
                $groupRecord['servers']            = $serverGroup['Server'];

                return $this->_jsonResponse($groupRecord);
            }
        }

        $serverGroup = $this->ServerGroup->findById($id);

        $this->set($serverGroup);
        $this->_setBaseInfo($project_id);
}

    public function del($project_id, $id) {
        // TODO: 1. 还会有其他的关联数据; 2. 要进行权限判断；
        if($this->ServerGroup->delete($id)) {
            return $this->_jsonResponse(array('status' => 'deleted'));
        }
    }

    protected function _setBaseInfo($project_id)
    {
        // 获取可用的分支
        $this->loadModel('Repository');
        $repository = $this->Repository->findByProjectId($project_id);
        $repoPath = $this->Repository->initGitrepo($project_id);
        $repository['Repository']['branches'] = $this->Repository->branches($repoPath);

        $this->set($repository);
    }

    /**
     * 完成特殊的要求JSON格式的请求响应
     *
     * @param $jsonArray
     *
     */
    protected function _jsonResponse($jsonArray, $status=200) {
        $this->response->type('json');
        $this->response->statusCode($status);
        $this->set('json_array', $jsonArray);
        $this->render('json_response', ''); // do not use any layout
    }
}
