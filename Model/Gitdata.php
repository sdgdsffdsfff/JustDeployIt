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
    protected $_gitBranch;
    protected $_gitRepo;

    public function __construct() {
        App::import('Vendor', 'Git');
    }

    public function initGitrepo($remote, $project_id, $branch = 'master') {
        Git::set_bin(Configure::read('GitSettings.bin_path'));
        $this->_repoPath = Configure::read('GitSettings.repos_path').DS.$project_id;
        $this->_gitRemote = $remote;
        $this->_gitBranch = $branch;

        if(!file_exists($this->_repoPath)) {
            $this->_gitRepo = Git::clone_remote($this->_repoPath, $this->_gitRemote);
        } else {
            $this->_gitRepo = Git::open($this->_repoPath);
        }

        return $this->_gitRepo;
    }

    /**
     * 重新缓存代码库
     *
     * 分两种情况：
     *   1. 还未clone的，直接clone即可
     *   2. 已经clone的，先fetch、再pull
     *
     * @return bool
     */
    public function recache () {

        if(Git::is_repo($this->_gitRepo)) {
            $this->_gitRepo->fetch();
            $this->_gitRepo->pull($this->_gitRemote, $this->_gitBranch);
        }

        return Git::is_repo($this->_gitRepo);
    }

    public function branches() {

        $branches = array();
        if(Git::is_repo($this->_gitRepo)) {
            $branches = $this->_repoPath->list_branches();
        }

        return $branches;
    }
}
?>
