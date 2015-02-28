<?php
App::uses('AppModel', 'Model');
/**
 * Server Model
 *
 * @property Project $Project
 * @property ServerGroup $ServerGroup
 * @property Deployment $Deployment
 */
class Server extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
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
		'name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'type' => array(
			'inList' => array(
				'rule' => array('inList', array('ssh', 'ftp')),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'hostname' => array(
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
		),
		'ServerGroup' => array(
			'className' => 'ServerGroup',
			'foreignKey' => 'server_group_identifier', // 迎合前端元素命名方式
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
*/
/**
 * hasMany associations
 *
 * @var array
 */
/*	public $hasMany = array(
		'Deployment' => array(
			'className' => 'Deployment',
			'foreignKey' => 'server_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
*/
	public function beforeSave($options = array())
	{
		if(empty($this->data['Server']['port'])) {
			switch ($this->data['Server']['type']) {
			case 'ftp':
				$this->data['Server']['port'] = 21;
			case 'sftp':
				$this->data['Server']['port'] = 22;
			}
		}

		return true;
	}

	public function geRemoteFiles($server) {
		App::import('Vendor', 'RFS', array('file' => 'RFS/FtpFactory.php'));
		$rfs = FtpFactory::create($this->field('type'));
		$rfs->connect($server['hostname'], $server['username'], $server['password'],$server['port']);

		$remoteFiles = $rfs->getRemoteFilesRecursive($server['server_path']);

		return $remoteFiles;
	}
}
