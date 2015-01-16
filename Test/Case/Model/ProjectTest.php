<?php
App::uses('Project', 'Model');

/**
 * Project Test Case
 *
 */
class ProjectTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.project',
		'app.user',
		'app.config_file',
		'app.deployment',
		'app.exclude_file',
		'app.server_group'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Project = ClassRegistry::init('Project');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Project);

		parent::tearDown();
	}

}
