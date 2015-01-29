<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    public $components = array(
        'DebugKit.Toolbar',
        'Session',
        'Auth' => array(
            'loginAction' => array(
                'controller' => 'users',
                'action'     => 'login'
            ),
            'authError' => 'Access Denied. You should login first.',
            'flash'     => array(
                'element' => 'common/flash',
                'key'       => 'auth',
                'params'    => array('type' => 'notice')
            ),
            'authenticate'  => array(
                'Form' => array(
                    'passwordHasher' => array(
                        'className' => 'Simple',
                        'hashType'  => 'sha256'
                    ),
                    'userModel' => 'User',
                    'fields' => array(
                        'username' => 'email_address',
                        'password' => 'password'
                    ),
                )
            )
        )
    );

    public $needProjectMenuBar = false;

    public function beforeFilter() {
        parent::beforeFilter();

        // 需要用到关联项目的信息
        if(in_array($this->request['controller'], array('servers', 'server_groups', 'config_files', 'exclude_files'))) {
            $this->loadModel('Project');
            $project = $this->Project->findById($this->request->pass[0]);

            $this->set($project);
        }
    }

    public function beforeRender() {
        parent::beforeRender();

        if($this->needProjectMenuBar) {
            $this->loadModel('Deployment');
            $lastDeployment = $this->Deployment->find('first', array('conditions' => array('project_id' => $this->request->pass[0]), 'order' => array('id desc')));

            $this->set('LastDeployment', $lastDeployment);
        }
    }
}
