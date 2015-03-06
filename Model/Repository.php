<?php
App::uses('AppModel', 'Model');
/**
 * Repository Model
 *
 * 这个Model类里面封装了Git的部分方法，为其它控制器提供支持
 *
 * @property Project $Project
 */
class Repository extends AppModel {

/**
 * Display field
 *
 * @var string
 */
    public $displayField = 'url';

/**
 * Validation rules
 *
 * @var array
 */
    public $validate = array(
        'project_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'scm_type' => array(
            'inList' => array(
                'rule' => array('inList', array('git')),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'url' => array(
            'url' => array(
                'rule' => array('url'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'branch' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
    );

    //The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
/*    public $belongsTo = array(
        'Project' => array(
            'className' => 'Project',
            'foreignKey' => 'project_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );*/

    // TODO: Git相关操作、返回值处理应该考虑整合进Model模型，让外部控制器不考虑Git的处理逻辑
    protected $_gitInstance;

    /**
     * 返回提交日志的历史记录
     *
     * 返回值数据格式
     * array(
     *      'commit'     => '218eba5a19079b47a296178cac22df34ab266532',
     *      'Author'     => '赵淑楷 <zhaoshukai@xdf.cn>',
     *      'AuthorDate' => 'Sat Aug 9 14:21:33 2014 +0800';
     *      'Commit'     => '赵淑楷 <zhaoshukai@xdf.cn>',
     *      'CommitDate' => 'Sat Aug 9 14:21:33 2014 +0800';
     *      'message'   => '奇怪的分支图'
     * )
     *
     * @param      $project_id
     * @param      $branch
     * @param null $limit
     * @param null $skip
     *
     * @return array
     */
    public function getLog($project_id, $branch='master', $limit = null, $skip = null) {
        if(gettype($this->_gitInstance) != 'object') {
           $this->_initGitrepo($project_id);
        }

        $this->_gitInstance->switchBranch($branch);

        $logs = $this->_gitInstance->getLog($limit, $skip);

        /*
		 * 额外处理返回值的格式
         * getLog返回值的格式
         * Array
         * (
         * [0] => commit 218eba5a19079b47a296178cac22df34ab266532
         * Author:     赵淑楷 <zhaoshukai@xdf.cn>
         * AuthorDate: Sat Aug 9 14:23:39 2014 +0800
         * Commit:     赵淑楷 <zhaoshukai@xdf.cn>
         * CommitDate: Sat Aug 9 14:23:39 2014 +0800
		 *
         *     了解了一些疑惑
         * [1] => commit 62666d35a6d3e95eacf3da47c22caf465e735154
         * Author:     赵淑楷 <zhaoshukai@xdf.cn>
         * AuthorDate: Sat Aug 9 14:21:33 2014 +0800
         * Commit:     赵淑楷 <zhaoshukai@xdf.cn>
         * CommitDate: Sat Aug 9 14:21:33 2014 +0800
         *
         *     奇怪的分支图
         * );
         */
        $gitLogs = array();
        foreach($logs as $k1 => $log) {
            $logArray = explode("\n", $log);
            foreach($logArray as $k2 => $item) {
                $firstSpace = strpos($item, ' ');
                if($firstSpace) {
                    $k3  = trim(substr($item, 0, $firstSpace), ':');
					$gitLogs[$k1][$k3] = trim(substr($item, $firstSpace));
                } else {
					$gitLogs[$k1]['message'] = trim($logArray[$k2 + 1]);
					break;
				}
            }
        }

		return $gitLogs;
    }

    public function latest_revision($project_id, $branch= 'master') {
        if(gettype($this->_gitInstance) != 'object') {
            $this->_initGitrepo($project_id);
        }

        $this->_gitInstance->switchBranch($branch);

        return $this->_gitInstance->getCurrentCommit();
    }

    /**
     * 返回处理过后符合前端处理要求的数组
     *
     * 返回值数据格式
     * array(
     *      'ref'       => '218eba5a19079b47a296178cac22df34ab266532',
     *      'author'    => '赵淑楷 <zhaoshukai@xdf.cn>',
     *      'timestamp' => 'Sat Aug 9 14:21:33 2014 +0800';
     *      'message'   => '奇怪的分支图'
     * )

     * @param $project_id
     * @param $hash
     *
     * @return array
     */
    public function commit_info($project_id, $hash) {
        if(gettype($this->_gitInstance) != 'object') {
            $this->_initGitrepo($project_id);
        }

        $infoText = $this->_gitInstance->showCommit($hash);
        // 处理文本，产生的数组格式参考函数getLog的返回值
        $logArray = explode("\n", $infoText);
        $gitLogs  = array();
        foreach($logArray as $k2 => $item) {
            $firstSpace = strpos($item, ' ');
            if($firstSpace) {
                $k3  = trim(substr($item, 0, $firstSpace), ':');
                $gitLogs[$k3] = trim(substr($item, $firstSpace));
            } else {
                $gitLogs['message'] = trim($logArray[$k2 + 1]);
                break;
            }
        }
        $commtInfo = array();
        $commtInfo['ref']        = $gitLogs['commit'];
        $commtInfo['timestamp'] = $gitLogs['CommitDate'];
        $commtInfo['message']   = $gitLogs['message'];
        $commtInfo['author']    = $gitLogs['Author'];

        return $commtInfo;
    }

    /**
     * 返回代码库目录下当前状态的所有文件
     *
     * 包含文件所在的目录
     *
     * @param $project_id
     *
     * @return array
     */
    public function listDirectory($project_id)
    {
        if (gettype($this->_gitInstance) != 'object') {
            $this->_initGitrepo($project_id);
        }
        return $this->_gitInstance->listDirectory();
    }

        /**
     * 初始化git的关键变量
     *
     * @param        $project_id
     *
     * @return string
     */
    protected function _initGitrepo($project_id) {
        App::import('Vendor', 'TQ', array('file' => 'TQ/Git/Repository/Repository.php'));
        $this->_gitInstance = \TQ\Git\Repository\Repository::open(Configure::read('GitSettings.repos_path').DS.$project_id, Configure::read('GitSettings.bin_path'));
    }


    /**
     * 将远程代码clone到本地
     *
     * 如果本地已有，则先删除
     *
     * @param $repoPath
     * @param $gitRemote
     *
     * @return bool
     */
    public function cloneRepo($repoPath, $gitRemote) {
        if(file_exists($repoPath)) {
            $this->removeRepoDir($repoPath);
        }

        // clone远程库
        $gitRepo = Git::clone_remote($repoPath, $gitRemote);
        // 将所有远程分支checkout到本地
        $remoteBranches = $gitRepo->list_remote_branches();
        foreach($remoteBranches as $key => $remote) {
            $branch = substr($remote, strpos($remote, '/') + 1);
            if('master' == $branch) continue; // master分支在clone时已经创建了
            // git checkout -b dev_zsk2 origin/dev_zsk2
            $gitRepo->checkout_remote($branch,$remote);
        }
        return true;
    }

    /**
     * 获得所有本地分支
     *
     * @param $project_id
     *
     * @return array
     */
    public function branches($project_id) {

        if(gettype($this->_gitInstance) != 'object') {
            $this->_initGitrepo($project_id);
        }

        return $this->_gitInstance->getBranches();
    }

    public function removeRepoDir($repoPath) {
        // TODO: 不确定不能删除的原因是不是因为有其它权限介入，还是.git目录有特殊限制
        App::uses('Folder', 'Utility');
        $repoFolder = new Folder();
        return $repoFolder->delete($repoPath);
    }
}
