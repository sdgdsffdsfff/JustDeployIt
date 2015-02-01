<?php
App::uses('AppController', 'Controller');
/**
 * ServerGroups Controller
 *
 */
class ServerGroupsController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();

        // 本控制器和视图仅在异步调用中用到
        $this->layout = '';
    }

    public function index($project_id, $group_id = null) {

        if($this->request->accepts('application/json')) {
            $this->ServerGroup->bindModel(array('hasMany' => array('Server' => array('className' => 'Server','foreignKey' => 'server_group_identifier'))));
            $serverGroup = $this->ServerGroup->findById($group_id);
            return $this->_jsonResponse($this->_assembleGroupArray($serverGroup));
        } else {
            $serverGroupList = $this->ServerGroup->findAllByProjectId($project_id);
            $this->set('ServerGroupList', $serverGroupList);
        }
    }

    public function add($project_id) {

        if($this->request->is('post') && $this->request->accepts('application/json')) {
            // 添加数据库记录
            $serverGroup = $this->ServerGroup->create($this->request->data['server_group']);
            $serverGroup['ServerGroup']['user_id'] = $this->Auth->user('id');
            if($this->ServerGroup->save($serverGroup)) {
                // 组装JSON数组
                $serverGroup = $this->ServerGroup->findById($this->ServerGroup->getInsertID());

                return $this->_jsonResponse($this->_assembleGroupArray($serverGroup));
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

                return $this->_jsonResponse($this->_assembleGroupArray($serverGroup));
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

    /**
     * 将数据库原始数据转换成前端希望的格式
     *
     * @param $serverGroup 标准cake数据格式，包含hasMany的数据
     *
     * @return array
     */
    protected function _assembleGroupArray($serverGroup) {
        /*
         * 前端期望返回的JSON格式
          {
              "identifier":"2b2a4973-1dcd-c412-a57a-11f6ed4b7a41",
              "name":"MyGroup2",
              "preferred_branch":"dev_zsk2",
              "last_revision":null,
              "servers":[
                {
                  "identifier":"6cc01867-db63-74e8-0ee7-5fc874ec2fe1",
                  "name":"RoyalHost",
                  "protocol_type":"ftp",
                  "server_path":"",
                  "auto_deploy_url":"http://treetree.beta.deployhq.com/deploy/deepphpoop/to/royalhost/ypcv16ibwaud",
                  "last_revision":null,
                  "preferred_branch":"dev_zsk",
                  "notify_email":false,
                  "server_group_identifier":"2b2a4973-1dcd-c412-a57a-11f6ed4b7a41",
                  "hostname":"f13-preview.royalwebhosting.net",
                  "username":"1770006",
                  "port":"21",
                  "passive":true,
                  "force_hidden_files":false
                }
              ]
            }
         */
        $serverList = array();
        foreach($serverGroup['Server'] as $server) {
            $serverRecord = array();

            $serverRecord["identifier"]               = $server['id'];
            $serverRecord["name"]                      = $server["name"];
            $serverRecord["protocol_type"]           = $server["type"];
            $serverRecord["server_path"]             = $server["server_path"];
            $serverRecord["last_revision"]            = $server['last_revision'];
            $serverRecord["preferred_branch"]        = $server["branch"];
            $serverRecord["notify_email"]             = empty($server['notification_email']) ? 'false' : 'true'; // 可能是这样的逻辑
            $serverRecord["server_group_identifier"] = $server["server_group_identifier"];
            $serverRecord["hostname"]                  = $server["hostname"];
            $serverRecord["username"]                  = $server["username"];
            $serverRecord["port"]                       = $server["port"];
            $serverRecord["passive"]                    = empty($server['passive']) ? 'false' : 'true';
            $serverRecord["force_hidden_files"]       = empty($server['force_hidden_files']) ? 'false' : 'true';

            $serverList[] = $serverRecord;
        }

        $groupRecord = array();
        $groupRecord['identifier']        = $serverGroup['ServerGroup']['id'];
        $groupRecord['name']               = $serverGroup['ServerGroup']['name'];
        // 当所设分支为空时，应该使用项目级别的默认设置
        $groupRecord['preferred_branch'] = empty($serverGroup['ServerGroup']['branch']) ? $this->_currentProjectDetail['Repository']['branch'] : $serverGroup['ServerGroup']['branch'];
        $groupRecord['last_revision']     = $serverGroup['ServerGroup']['last_revision'];
        $groupRecord['servers']            = $serverList;

        return $groupRecord;
    }
}
