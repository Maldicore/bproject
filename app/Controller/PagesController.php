<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
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

App::uses('AppController', 'Controller');


/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Pages';

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();
	
	public function contact() {
		
	}

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 */
	public function display() {
		$this->Session->delete('msgType');
		$this->Session->delete('msgTxt');
		
		$this->Doc = ClassRegistry::init('Doc');
		
		$params = array(
				'fields' => array(),
				//'fields' => array('Post.title', ),
				//'conditions' => array('title' => 'hehe'),
				//'conditions' => array('hoge' => array('$gt' => '10', '$lt' => '34')),
				//'order' => array('title' => 1, 'body' => 1),
				'order' => array('_id' => -1),
				//'limit' => 35,
				'page' => 1,
		);
		
		$results = $this->Doc->find('all', $params);
		
		//$result = $this->Post->find('count', $params);
		$this->set(compact('results'));
		
		$this->Cat = ClassRegistry::init('Cat');
		
		$params = array(
				'fields' => array(),
			//'fields' => array('Post.title', ),
			//'conditions' => array('title' => 'hehe'),
			//'conditions' => array('hoge' => array('$gt' => '10', '$lt' => '34')),
			//'order' => array('title' => 1, 'body' => 1),
			'order' => array('_id' => -1),
			//'limit' => 35,
			'page' => 1,
		);
		
		$cats_list = $this->Cat->find('all', $params);
		
		//$result = $this->Post->find('count', $params);
		$this->set(compact('cats_list'));
		
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			$this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title_for_layout'));
		$this->render(implode('/', $path));
	}
	
}