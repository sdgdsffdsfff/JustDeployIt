<?php
App::uses('AppController', 'Controller');

/**
 * Servers Controller
 *
 */
class ServersController extends AppController
{

    public function beforeFilter() {
        parent::beforeFilter();

        $this->_needProjectMenuBar = true;
        $this->set('needProjectMenuBar', $this->_needProjectMenuBar);
    }

    public function index($project_id, $server_id=null) {
        // TODO:用户权限判断
        if($this->request->accepts('application/json')) {
            $server = $this->Server->findById($server_id);
            return $this->_jsonResponse($this->_assembleServerArray($server['Server']));
        } else {
            // 独立服务器
            $serverList = $this->Server->find('all', array('conditions' => array('project_id' => $project_id, 'server_group_identifier' => 0)));
            // 服务器组
            $this->loadModel('ServerGroup');
            $this->ServerGroup->bindModel(
                array('hasMany' => array('Server' => array('className' => 'Server', 'foreignKey' => 'server_group_identifier')))
            );
            $groupList = $this->ServerGroup->find('all', array('conditions' => array('ServerGroup.project_id' => $project_id)));

            $this->set('ServerList', $serverList);
            $this->set('GroupList', $groupList);
        }
    }

    public function add($project_id)
    {
        // TODO:需要进行服务器可访问检查，密码保存时要加密
        if ($this->request->is('post')) {
            $server = $this->Server->create($this->request->data['server']);
            $server['Server']['user_id'] = $this->Auth->user('id');
            if($this->Server->save($server)) {
                $this->Session->setFlash('Server has been added successfully!', 'common/flash', array('type' => 'success'), 'function');
                $this->redirect(array('action' => 'index', $project_id));
            } else {
                $this->Session->setFlash('Something went wrong when creating server!', 'common/flash', array('type' => 'alert'), 'function');
                $this->set($server);
            }
        } elseif (isset($this->request->query['type'])) {
            // 处理用户选择不同服务器类型时的页面渲染内容
            // type的值为ssh或ftp
            return $this->render($this->request->query['type'], ''); // 函数执行结束，返回不带layout的页面内容
        }

        // 正常渲染空值的add页面
        $this->_setBaseInfo($project_id);
    }

    public function edit($project_id, $id) {

        // 请求修改
        if($this->request->is('post')) {
            $server = $this->Server->create($this->request->data['server']);
            $server['Server']['user_id'] = $this->Auth->user('id');
            if($this->Server->save($server)) {
                $this->Session->setFlash('Server has been updated successfully!', 'common/flash', array('type' => 'success'), 'function');
                $this->redirect(array('action' => 'index', $project_id));
            } else {
                $this->Session->setFlash('Something went wrong when saving server!', 'common/flash', array('type' => 'alert'), 'function');
                $this->set($server);
            }
        }  else {
            $this->_setBaseInfo($project_id);
            $server = $this->Server->findById($id);
            $this->loadModel('ServerGroup');
            $group  = $this->ServerGroup->findById($server['Server']['server_group_identifier']);

            $this->set($server);
            $this->set($group);
        }
    }

    public function del($project_id, $id) {
        // TODO: 1. 还会有其他的关联数据; 2. 要进行权限判断；
        if($this->Server->delete($id)) {
            $this->Session->setFlash('Server has been removed successfully!', 'common/flash', array('type' => 'success'), 'function');
        } else {
            $this->Session->setFlash('Something went wrong when deleting server!', 'common/flash', array('type' => 'alert'), 'function');
        }

        $this->redirect(array('action' => 'index', $project_id));

    }

    protected function _setBaseInfo($project_id) {
        // 获取可用的ServerGroup
        $this->loadModel('ServerGroup');
        $serverGroupList = $this->ServerGroup->findAllByProjectId($project_id);
        // 获取可用的分支
        $this->loadModel('Repository');
        $repository = $this->Repository->findByProjectId($project_id);
        $repository['Repository']['branches'] = $this->Repository->branches($project_id);

        $this->set('ServerGroupList', $serverGroupList);
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
     * @param $server 标准cake数据格式
     *
     * @return array
     */
    protected function _assembleServerArray($server) {
        /*
         * 前端期望返回的JSON格式
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
         */
        $serverRecord = array();

        $serverRecord["identifier"]               = $server['id'];
        $serverRecord["name"]                      = $server["name"];
        $serverRecord["protocol_type"]           = $server["type"];
        $serverRecord["server_path"]             = $server["server_path"];
        $serverRecord["last_revision"]            = $server['last_revision'];
        // 当所设分支为空时，应该使用项目级别的默认设置
        $serverRecord["preferred_branch"]        = empty($server["branch"]) ?  $this->_currentProjectDetail['Repository']['branch'] : $server["branch"];
        $serverRecord["notify_email"]             = empty($server['notification_email']) ? 'false' : 'true'; // 可能是这样的逻辑
        $serverRecord["server_group_identifier"] = $server["server_group_identifier"];
        $serverRecord["hostname"]                  = $server["hostname"];
        $serverRecord["username"]                  = $server["username"];
        $serverRecord["port"]                      = $server["port"];
        $serverRecord["passive"]                  = empty($server['passive']) ? 'false' : 'true';
        $serverRecord["force_hidden_files"]     = empty($server['force_hidden_files']) ? 'false' : 'true';

        return $serverRecord;
    }
}
