<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 */
class UsersController extends AppController {

	public function beforeFilter() {
		$this->Auth->allow('reset');

		parent::beforeFilter();
	}
	public function login() {
		$this->layout = 'identifying';

		if($this->request->is('post')) {
			$this->Auth->login($this->request->data);

			if(!$this->Auth->user()) {
				$this->Session->setFlash('Access Denied. Your username and/or password were incorrect. Please check and try again.', 'common/flash', array('type' => 'alert'));
			} else {
				return $this->redirect($this->Auth->loginRedirect);
			}
		}
	}

	public function logout() {
		return $this->redirect($this->Auth->logout());
	}

	public function reset() {
		$this->layout = 'identifying';

	}

	public function add() {
		// 不需要项目级导航菜单
		$this->set('noMenuBar', true);

		// 新用户入库
		if ($this->request->is('post') && $this->User->save($this->request->data['user'])) {
			$id = $this->User->id;
			$this->request->data['user'] = array_merge(
				$this->request->data['user'],
				array('id' => $id)
			);

			return $this->redirect('/users');
		}
	}}
