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

    public function add($project_id_str) {

        // 传入值可能以“.js”结尾
        $project_id_arr = explode('.', $project_id_str);
        $project_id = $project_id_arr[0];
        if(isset($project_id_arr[1]) and $project_id_arr[1] == 'js') { // 进行预览计算
            return $this->_estimate($project_id);
        }

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
                    preview: // 预览，编辑时的键为edit
                */
                $this->view = 'preview';
                $viewBodyJsAction = 'create'; // 特殊的action参数，用于设定页面的body class，详见layouts/default.ctp

                $this->set('BodyJsAction', $viewBodyJsAction);

                return;
            } elseif (isset($this->request->data['edit'])) { // Make Changes按钮的逻辑支持
                // 暂无额外行为，post数据忽略，TODO: 需要看看deployhq的处理逻辑
            }
        }

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

	/**
	 * @param        $project_id
	 * @param string $js 无实际意义，应对前端的请求机制
	 */
    protected function _estimate($project_id) {
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
        $this->view   = 'estimate';

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
            $ServerList = $result['Server'];
            $this->set('ServerList', $ServerList); // hasMany
        } else {
            $ServerList = array($result['Server']);
            $this->set('ServerList', $ServerList); // find first
        }

        // 评估需要上传的本地文件和需要删除的服务器文件
        $this->loadModel('Repository');
        $repositoryFiles = $this->Repository->listDirectory($project_id);
        foreach ($ServerList as $server) {
            $this->loadModel('Server');
            $remoteFiles = $this->Server->geRemoteFiles($server);

            $toBeUploaded = $this->_getDiffRemoteAndRepository($project_id, $remoteFiles, $repositoryFiles);
            $toBeRemoved  = array_diff($remoteFiles, $repositoryFiles);

            $toBeUploadedList[$server['id']] = $toBeUploaded;
            $toBeRemovedList[$server['id']]  = $toBeRemoved;
        }

        $this->set('toBeUploadedList', $toBeUploadedList);
        $this->set('toBeRemovedList', $toBeRemovedList);
        $this->set('startRevisionInfo', $startRevisionInfo);
        $this->set('endRevisionInfo',   $endRevisionInfo);
    }

    protected function _getDiffRemoteAndRepository($project_id, $remoteFiles, $repositoryFiles) {

        $toBeUploaded = array();
        if(is_array($repositoryFiles)){
            foreach($repositoryFiles as $fileName) {
                if(in_array($fileName, $remoteFiles)) {
                    if($this->_isToBeUploaded($this->Server->getFileSizeAndMdtm($fileName), $this->Repository->getFileStat($project_id, $fileName))) {
                        $toBeUploaded[] = $fileName;
                    }
                } else {
                    $toBeUploaded[] = $fileName;
                }
            }
        }

        return $toBeUploaded;
    }

    protected function _isToBeUploaded($remoteFileStat, $repositoryFileStat) {
        if($repositoryFileStat['size'] != $remoteFileStat['size']) {
            return true;
        }
        if($repositoryFileStat['mtime'] != $remoteFileStat['mdtm']) {
            return true;
        }

        return false;
    }
}
