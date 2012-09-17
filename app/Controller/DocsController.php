<?php
/**
 * DocsController class
 *
 * @uses          AppController
 * @package       mongodb
 * @subpackage    mongodb.samples.controllers
 */

App::import('Vendor','ValumsFileUploader');

class DocsController extends AppController {

/**
 * name property
 *
 * @var string 'Docs'
 * @access public
 */
	public $name = 'Docs';

/**
 * index method
 *
 * @return void
 * @access public
 */
	public function index() {
		$this->Session->delete('msgType');
		$this->Session->delete('msgTxt');
		
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
	}

/**
 * add method
 *
 * @return void
 * @access public
 */
	public function add() {
		if (!empty($this->data)) {
			$this->Doc->create();
			if ($this->Doc->save($this->data)) {
				$this->Session->write('msgType' , 'success');
				$this->Session->write('msgTxt' , 'Document Successfully Saved.');
				$this->redirect(array('controller'=>'pages', 'action' => 'display'));
				//$this->flash(__('Doc saved.', true), array('controller'=>'pages', 'action' => 'display'));
			} else {
				$this->Session->write('msgType' , 'error');
				$this->Session->write('msgTxt' , 'Document Save Failed. Please Try Again.');
			}
		} else {
			$this->layout = false;
			$this->Cat = ClassRegistry::init('Cat');
			//debug($this);
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
		}
	}

/**
 * edit method
 *
 * @param mixed $id null
 * @return void
 * @access public
 */
	public function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->write('msgType' , 'error');
			$this->Session->write('msgTxt' , 'Invalid Document Data.');
		}
		if (!empty($this->data)) {
			if ($this->Doc->save($this->data)) {
				$this->Session->write('msgType' , 'success');
				$this->Session->write('msgTxt' , 'Document Successfully Saved.');
			} else {
				$this->Session->write('msgType' , 'error');
				$this->Session->write('msgTxt' , 'Document Save Failed.');
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Doc->read(null, $id);
			//$this->data = $this->Post->find('first', array('conditions' => array('_id' => $id)));
		}
	}

/**
 * delete method
 *
 * @param mixed $id null
 * @return void
 * @access public
 */
	public function delete($id = null) {
		$id = $this->request->query['id'];
		if (!$id) {
			$this->Session->write('msgType' , 'error');
			$this->Session->write('msgTxt' , 'Invalid Document Data.');
			$this->redirect(array('controller'=>'pages', 'action' => 'display'));
		}
		if ($this->Doc->delete($id)) {
			$this->Session->write('msgType' , 'success');
			$this->Session->write('msgTxt' , 'Document Successfully Deleted.');
			$this->redirect(array('controller'=>'pages', 'action' => 'display'));
		} else {
			$this->Session->write('msgType' , 'error');
			$this->Session->write('msgTxt' , 'Document Delete Failed.');
			$this->redirect(array('controller'=>'pages', 'action' => 'display'));
		}
	}

/**
 * deleteall method
 *
 * @return void
 * @access public
 */
	public function deleteall() {
		if(!empty($this->params['cat_name'])){
			$conditions = array('cat_name' => $this->params['cat_name']);
		} else {
			$conditions = 'aa';
		}
		if ($this->Doc->deleteAll($conditions)) {
			//debug($conditions);
// 			$this->Session->write('msgType' , 'success');
// 			$this->Session->write('msgTxt' , 'Document Successfully Deleted.');
// 			$this->redirect(array('controller'=>'Docs', 'action' => 'index'));

		} else {
// 			$this->Session->write('msgType' , 'error');
// 			$this->Session->write('msgTxt' , 'Document Delete Failed.');
// 			$this->redirect(array('controller'=>'Docs', 'action' => 'index'));
		}
	}

/**
 * updateall method
 *
 * @return void
 * @access public
 */
	public function updateall() {
		$conditions = array('title' => 'ichi2' );

		$field = array('title' => 'ichi' );

		if ($this->Doc->updateAll($field, $conditions)) {
			$this->Session->write('msgType' , 'success');
			$this->Session->write('msgTxt' , 'Document Successfully Updated.');
			$this->redirect(array('controller'=>'Docs', 'action' => 'index'));

		} else {
			$this->Session->write('msgType' , 'error');
			$this->Session->write('msgTxt' , 'Document Update Failed.');
			$this->redirect(array('controller'=>'Docs', 'action' => 'index'));
		}
	}

	public function createindex() {
		$mongo = ConnectionManager::getDataSource($this->Doc->useDbConfig);
		$mongo->ensureIndex($this->Doc, array('title' => 1));

	}
	
	public function upload(){
		$this->layout = false;
		$this->autoRender = false;
		$allowedExtensions = array();
		$sizelimit = 1 * 1024 * 1024;
		
		$uploader = new qqFileUploader($allowedExtensions, $sizelimit); 
		$return = $uploader->handleUpload('files/');
		//debug(exif_read_data('files/'.$return['file']));
		$this->set('return',$return);
		echo json_encode($return);
	}
}