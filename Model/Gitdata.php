<?php
App::uses('AppModel', 'Model');
/**
 * Gitdata Model
 *
 */
class Gitdata extends AppModel
{
    public $useTable = false;
    public $name      = 'Gitdata';

    protected $_repoPath;
    protected $_gitRemote;

    public function __construct() {
        App::import('Vendor', 'Git');
    }

    public function initGitrepo($project_id, $remote='') {
        Git::set_bin(Configure::read('GitSettings.bin_path'));
        $this->_repoPath = Configure::read('GitSettings.repos_path').DS.$project_id;
        $this->_gitRemote = $remote;
    }

    public function cloneRepo() {
        if(file_exists($this->_repoPath)) {
            $this->removeRepoDir();
        }

        // clone远程库
        $gitRepo = Git::clone_remote($this->_repoPath, $this->_gitRemote);
        // 将所有远程分支checkout到本地
        $remoteBranches = $gitRepo->list_remote_branches();
        foreach($remoteBranches as $key => $remote) {
            $branch = substr($remote, strpos($remote, '/') + 1);
            if('master' == $branch) continue; // master分支在clone时已经创建了
            // git checkout -b dev_zsk2 origin/dev_zsk2
            $gitRepo->checkout_remote($branch,$remote);
        }
        return $gitRepo;
    }

    public function branches() {

        if(!file_exists($this->_repoPath)) {
            return array();
        }

        $gitRepo = Git::open($this->_repoPath);
        $branches = array();
        if(Git::is_repo($gitRepo)) {
            $branches = $gitRepo->list_branches();
        }

        return $branches;
    }

    public function removeRepoDir() {
        // TODO: 不确定不能删除的原因是不是因为有其它权限介入，还是.git目录有特殊限制
        App::uses('Folder', 'Utility');
        $repoFolder = new Folder();
        return $repoFolder->delete($this->_repoPath);
    }
}
?>
