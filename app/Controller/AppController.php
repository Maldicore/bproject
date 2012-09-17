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
	//public $components = array('DebugKit.Toolbar','Auth','Session');
	public $components = array(
			//'DebugKit.Toolbar',
			'Session',
			'Auth' => array(
					'loginRedirect' => array('controller' => 'pages', 'action'=>'display'),
					'logoutRedirect' => array('controller' => 'Users', 'action'=>'login'),
					//'authorize' => array('controller' => 'pages', 'action'=>'display')
					)
			);
	
	public function isAuthorized($user){
		//Admin has access to everything
		if(isset($user['role']) && $user['role'] === 'admin'){
			return true;
		}
		//Default deny
		return false;
	}
	
	public function beforeFilter(){
		$this->Auth->allow('index','login','add');
		// Get session data for appllication use
		$this->app = $this->Session->read();
	}
	
	function beforeRender() {
		// Make app variables available to view
		$this->set('app', $this->app);
	}
	
}
