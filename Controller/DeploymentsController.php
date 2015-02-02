<?php
App::uses('AppController', 'Controller');
/**
 * Deployments Controller
 *
 */
class DeploymentsController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();

        $this->_needProjectMenuBar = true;
        $this->set('needProjectMenuBar', $this->_needProjectMenuBar);
    }
    public function add($project_id) {

        if($this->request->is('post')) {
            if(isset($this->request->data['preview'])) {
                /*
                 * POST的数据
                    utf8:✓
                    authenticity_token:gw5yNsLC2NJwoOZZmYeK41LphlxJJ0jDXFQq8xOVV9o=
                    deployment[parent_identifier]:1.Server // or 1.Group，数字表示ID，Server和Group表示该ID是独立服务器或者服务器组
                    deployment[start_revision]:
                    deployment[end_revision]:fc11bd753f20577727986a13251a0d565eeee8d4
                    deployment[copy_config_files]:0
                    deployment[copy_config_files]:1
                    deployment[email_notify]:0
                    deployment[branch]:master
                    preview:
                */
                $this->view = 'create';
                $viewBodyJsAction = 'create'; // 特殊的action参数，用于设定页面的body class，详见layouts/default.ctp

                $this->set('BodyJsAction', $viewBodyJsAction);
            }
        } else {
            // 独立服务器
            $this->loadModel('Server');
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

	/**
	 * @param        $project_id
	 * @param string $js 无实际意义，应对前端的请求机制
	 */
    public function estimate($project_id, $js='js.js') {
        /*
         *  utf8:✓
            authenticity_token:gw5yNsLC2NJwoOZZmYeK41LphlxJJ0jDXFQq8xOVV9o=
            deployment[start_revision]:
            deployment[end_revision]:fc11bd753f20577727986a13251a0d565eeee8d4
            deployment[server_id]:
            deployment[parent_identifier]:1.Server // or 1.Group
            deployment[copy_config_files]:1
            deployment[email_notify]:0
            deployment[branch]:master
         */
        $this->layout = '';

        $this->loadModel('Repository');
        if(empty( $this->request->data['deployment']['start_revision'])) {
            $startRevisionInfo = array();
        } else {
            $startRevisionInfo = $this->Repository->commit_info($project_id, $this->request->data['deployment']['start_revision']);
        }
        if(empty( $this->request->data['deployment']['end_revision'])) {
            $endRevisionInfo = array();
        } else {
            $endRevisionInfo = $this->Repository->commit_info($project_id, $this->request->data['deployment']['end_revision']);
        }

        // 获得要部署到的服务器列表，独立或组
        $parentTarget = explode('.', $this->request->data['deployment']['parent_identifier']);
        $this->loadModel($parentTarget[1]);
        if($parentTarget[1] == 'ServerGroup') {
            $this->$parentTarget[1]->bindModel(
                array('hasMany' => array('Server' => array('className' => 'Server', 'foreignKey' => 'server_group_identifier')))
            );
        }
        $result = $this->$parentTarget[1]->findById($parentTarget[0]);
        if($parentTarget[1] == 'ServerGroup') {
            $this->set('ServerList', $result['Server']); // hasMany
        } else {
            $this->set('ServerList', array($result['Server'])); // find first
        }


        $this->set('startRevisionInfo', $startRevisionInfo);
        $this->set('endRevisionInfo',   $endRevisionInfo);
    }
}
