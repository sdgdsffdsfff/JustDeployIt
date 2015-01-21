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
			// notes: Auth组件的处理逻辑，跟页面Form元素的配合关系
			// 1. 如果页面form中用类似如下格式的标准cakephp元素
			//     <input class="form-control" id="data[User][email_address]" name="data[User][email_address]" spellcheck="false" type="text" />
			//     <input class="form-control" id="data[User][password]"      name="data[User][password]"      spellcheck="false" type="text" />
			//    则只需要直接调用$this->Auth->login();即可完成验证和登录
			// 2. 否则，则需要在CakeRequest的data数据里制造名为User的数据，以满足Auth组件的identify方法的逻辑

			// 在不改变页面form元素特殊命名的时，制造CakeRequest的data数据，使Auth组件顺利工作的数据转换工作
			$this->request->data['User'] = $this->request->data;
			// 进行登录和验证
			$this->Auth->login();
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
