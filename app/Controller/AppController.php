<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    public $helpers = array('Html', 'Form', 'Session', 'Tool',  'TB' => array('className' => 'TwitterBootstrap.TwitterBootstrap'));
    public $components = array(
		'Session',
		'Auth' => array(
			'loginAction' => array('controller' => 'users', 'action' => 'login'),
			'loginRedirect' => array('controller' => 'states', 'action' => 'index'),
			'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
			'authorize' => array('Controller') // Added this line
		)
    );
    public function isAuthorized($user) {
		if ($this->Auth->loggedIn($user) == false) {
			return false;
		}
		
		if($user['role'] != 'admin')
		{
			switch($this->params['controller'])
			{
				case 'systems':
						return false;
					break;
				case 'task_recipients':
					if($this->request->is('post'))
						return false;
					break;
				default:
					break;
			}

			if (in_array($this->action, array('add', 'edit', 'delete', 'deleteall','setenabled', 'run'))) {
				return false;
			}
		}
		return true;
	}

}
