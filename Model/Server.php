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
     * 远程服务器连接符
     *
     * @var resource
     */
    protected $_rfsResource;

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
                break;
			case 'sftp':
				$this->data['Server']['port'] = 22;
                break;
			}
		}

        if(empty($this->data['Server']['server_group_identifer'])) {
            $this->data['Server']['server_group_identifer'] = 0;
        }

		return true;
	}

	public function geRemoteFiles($server) {
        if (gettype($this->_rfsResource) != 'object') {
            $this->_initRFS($server);
        }

		$remoteFiles = $this->_rfsResource->getRemoteFilesRecursive($server['server_path']);

		return $remoteFiles;
	}

    public function getFileSizeAndMdtm($fileName) {
        return $this->_rfsResource->getFileSizeAndMdtm($fileName);
    }

    protected function _initRFS($server) {
        App::import('Vendor', 'RFS', array('file' => 'RFS/FtpFactory.php'));
        $this->_rfsResource = FtpFactory::create($this->field('type'));
        $this->_rfsResource->connect($server['hostname'], $server['username'], $server['password'],$server['port']);
    }
}
