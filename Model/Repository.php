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
/*	public $belongsTo = array(
		'Project' => array(
			'className' => 'Project',
			'foreignKey' => 'project_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);*/

	// TODO: Git相关操作、返回值处理应该考虑整合进Model模型，让外部控制器不考虑Git的处理逻辑
	/**
	 * 初始化git的关键变量
	 *
	 * @param        $project_id
	 *
	 * @return string
	 */
	public function initGitrepo($project_id) {
		App::import('Vendor', 'Git');

		Git::set_bin(Configure::read('GitSettings.bin_path'));
		$repoPath = Configure::read('GitSettings.repos_path').DS.$project_id;

		return $repoPath;
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
	 * @param $repoPath
	 *
	 * @return array
	 */
	public function branches($repoPath) {

		if(!file_exists($repoPath)) {
			return array();
		}

		$gitRepo = Git::open($repoPath);
		$branches = array();
		if(Git::is_repo($gitRepo)) {
			$branches = $gitRepo->list_branches();
		}

		return $branches;
	}

	public function removeRepoDir($repoPath) {
		// TODO: 不确定不能删除的原因是不是因为有其它权限介入，还是.git目录有特殊限制
		App::uses('Folder', 'Utility');
		$repoFolder = new Folder();
		return $repoFolder->delete($repoPath);
	}
}
