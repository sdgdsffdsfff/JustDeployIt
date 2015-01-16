<?php
App::uses('ProjectsController', 'Controller');

/**
 * ProjectsController Test Case
 *
 */
class ProjectsControllerTest extends ControllerTestCase {

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

}
