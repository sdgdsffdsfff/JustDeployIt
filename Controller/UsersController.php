<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 */
class UsersController extends AppController {

	public function beforeFilter() {
		$this->Auth->allow('reset');
	}
	public function login() {
		$this->layout = 'log';
	}

	public function reset() {
		$this->layout = 'log';
	}
}
