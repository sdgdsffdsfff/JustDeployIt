<?php
/**
 * ProjectFixture
 *
 */
class ProjectFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 32, 'collate' => 'utf8_general_ci', 'comment' => 'ÏîÄ¿Ãû³Æ', 'charset' => 'utf8'),
		'repository_type' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 32, 'collate' => 'utf8_general_ci', 'comment' => '´úÂë¹ÜÀíÏµÍ³µÄÀàÐÍ£¬enum.ini.phpÀïÅäÖÃÎªProject.repository_typeµÄÖµ', 'charset' => 'utf8'),
		'repository_url' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '´úÂë¿âµÄµØÖ·', 'charset' => 'utf8'),
		'default_branch' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 32, 'collate' => 'utf8_general_ci', 'comment' => 'ÓÃÓÚ²¿ÊðµÄÄ¬ÈÏ·ÖÖ§', 'charset' => 'utf8'),
		'repository_username' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 32, 'collate' => 'utf8_general_ci', 'comment' => '·ÃÎÊ´úÂë¿âµÄÓÃ»§Ãû', 'charset' => 'utf8'),
		'repository_password' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 32, 'collate' => 'utf8_general_ci', 'comment' => '·ÃÎÊ´úÂë¿âµÄÃÜÂë', 'charset' => 'utf8'),
		'ssh_key' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'ssh·ÃÎÊÐÎÊ½ÏÂµÄpublic key', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'user_id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'repository_type' => 'Lorem ipsum dolor sit amet',
			'repository_url' => 'Lorem ipsum dolor sit amet',
			'default_branch' => 'Lorem ipsum dolor sit amet',
			'repository_username' => 'Lorem ipsum dolor sit amet',
			'repository_password' => 'Lorem ipsum dolor sit amet',
			'ssh_key' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'created' => '2015-01-16 04:02:19',
			'modified' => '2015-01-16 04:02:19'
		),
	);

}
