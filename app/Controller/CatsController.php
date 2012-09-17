<?php
/**
 * DocsController class
 *
 * @uses          AppController
 * @package       mongodb
 * @subpackage    mongodb.samples.controllers
 */


class CatsController extends AppController {


/**
 * name property
 *
 * @var string 'Cats'
 * @access public
 */
	public $name = 'Cats';

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
		$cats_list = $this->Cat->find('all', $params);
		//$result = $this->Post->find('count', $params);
		$this->set(compact('cats_list'));
	}

/**
 * add method
 *
 * @return void
 * @access public
 */
	public function add() {
		$this->layout = false;
		//debug($this->data);
		if (!empty($this->data)) {
			$this->Cat->create();
			if ($this->Cat->save($this->data)) {
				$this->Session->write('msgType' , 'success');
				$this->Session->write('msgTxt' , 'Category Successfully Saved.');
				$this->redirect(array('controller'=>'Cats', 'action' => 'index'));
			} else {
				$this->Session->write('msgType' , 'error');
				$this->Session->write('msgTxt' , 'Category Save Failed.');
				$this->set(compact('msgType','msgTxt'));
			}
		} else {
			$this->layout = false;
		}
	}
	
	public function cats_list(){
		
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
	
	public function add_fields() {

		if (!empty($this->data)) {

			$category = $this->data['Cat']['cat_name'];
			$field_name = $this->data['Cat']['f_name'];
			$field_sname = $this->data['Cat']['f_sname'];
			$field_type = $this->data['Cat']['f_type'];
			debug($this->data['Cat']);
			//return;
			$conditions = array('cat_name' => $category );
			
			$field = array(
					$field_name => array(
							'sname' => $field_sname,
							'type' => $field_type
							)
					);
			
			if ($this->Cat->updateAll($field, $conditions)) {
				$this->Session->write('msgType' , 'success');
				$this->Session->write('msgTxt' , 'Category Successfully Updated.');
				$this->redirect(array('controller'=>'Cats', 'action' => 'index'));
				//$this->flash(__('Cat updateAll success', true), array('action' => 'index'));
			
			} else {
				$msgType = 'error';
				$this->Session->write('msgType' , 'error');
				$this->Session->write('msgTxt' , 'Category Update Failed.');
				$this->redirect(array('controller'=>'Cats', 'action' => 'index'));
				//$this->flash(__('Cat updateAll Fail', true), array('action' => 'index'));
			}
		} else {
			$this->layout = false;
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
			$this->Session->write('msgTxt' , 'Invalid Category.');
			$this->redirect(array('controller'=>'Cats', 'action' => 'index'));
			//$this->flash(__('Invalid Cat', true), array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Cat->save($this->data)) {
				$this->Session->write('msgType' , 'success');
				$this->Session->write('msgTxt' , 'Category Successfully Updated.');
				$this->redirect(array('controller'=>'Cats', 'action' => 'index'));
				//$this->flash(__('The Cat has been saved.', true), array('action' => 'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Cat->read(null, $id);
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
		$id = ($this->request->query['id']);
		if (!$id) {
			$this->Session->write('msgType' , 'error');
			$this->Session->write('msgTxt' , 'Invalid Category.');
			$this->redirect(array('controller'=>'Cats', 'action' => 'index'));
			//$this->flash(__('Invalid Cat', true), array('action' => 'index'));
		}
		if ($this->Cat->delete($id)) {
			$this->Session->write('msgType' , 'success');
			$this->Session->write('msgTxt' , 'Category Successfully Deleted.');
			// Delete all related documents too!
			$cat_name = ($this->request->query['n']);
			//$this->requestAction('/Docs/deleteall', array('cat_name' => $cat_name));
			//return;
			$this->redirect(array('controller'=>'Cats', 'action' => 'index'));
			//$this->flash(__('Cat deleted', true), array('action' => 'index'));
		} else {
			$this->Session->write('msgType' , 'error');
			$this->Session->write('msgTxt' , 'Category Delete Failed.');
			$this->redirect(array('controller'=>'Cats', 'action' => 'index'));
			//$this->flash(__('Cat deleted Fail', true), array('action' => 'index'));
		}
	}
	
	/**
	 * unset method
	 *
	 * @return void
	 * @access public
	 */
	public function d_unset($f = null, $t = null) {
		$this->autoRender = false;
		//$this->layout = false;
		$f = ($this->request->query['f']);
		$t = str_replace("_", " ",($this->request->query['t']));
		$params = array(
				'fields' => array(),
				//'fields' => array('Post.title', ),
				'conditions' => array('cat_name' => $t),
				//'conditions' => array('hoge' => array('$gt' => '10', '$lt' => '34')),
				//'order' => array('title' => 1, 'body' => 1),
				//'order' => array('_id' => -1),
				'limit' => 1,
				'page' => 1,
		);
		$cData = $this->Cat->find('all', $params);
 		unset($cData[0]['Cat'][$f]);
 		$id = $cData[0]['Cat']['_id'];
 		unset($cData[0]['Cat']['_id']);
 		$this->Cat->delete($id);
 		$cData[0]['Cat']['cat_name'] = str_replace("_"," ",$cData[0]['Cat']['cat_name']);
 		$conditions = array('_id'=>$cData[0]['Cat']['cat_name']); 
 		$this->Cat->save($cData[0]);
 		unset($cData[0]['Cat']['cat_name']);
 		$fields = $cData[0]['Cat'];
 		if($this->Cat->updateAll($fields, $conditions)){
			$this->Session->write('msgType' , 'success');
			$this->Session->write('msgTxt' , 'Category Successfully Updated.');
			$this->redirect(array('controller'=>'Cats', 'action' => 'index'));
			//$this->flash(__('Cat updateAll success', true), array('action' => 'index'));

		} else {
			$this->Session->write('msgType' , 'error');
			$this->Session->write('msgTxt' , 'Category Update Failed.');
			$this->redirect(array('controller'=>'Cats', 'action' => 'index'));
			//$this->flash(__('Cat updateAll Fail', true), array('action' => 'index'));
		}
		//unset($this->Cat->mongoNoSetOperator);
	}
	
/**
 * deleteall method
 *
 * @return void
 * @access public
 */
	public function deleteall() {
		$conditions = array('title' => 'aa');
		if ($this->Cat->deleteAll($conditions)) {
			$this->Session->write('msgType' , 'success');
			$this->Session->write('msgTxt' , 'Category Successfully Deleted.');
			$this->redirect(array('controller'=>'Cats', 'action' => 'index'));
			//$this->flash(__('Cat deleteAll success', true), array('action' => 'index'));

		} else {
			$this->Session->write('msgType' , 'error');
			$this->Session->write('msgTxt' , 'Category Delete Failed.');
			$this->redirect(array('controller'=>'Cats', 'action' => 'index'));
			//$this->flash(__('Cat deleteAll Fail', true), array('action' => 'index'));
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

		if ($this->Cat->updateAll($field, $conditions)) {
			$this->Session->write('msgType' , 'success');
			$this->Session->write('msgTxt' , 'Category Successfully Updated.');
			$this->redirect(array('controller'=>'Cats', 'action' => 'index'));
			//$this->flash(__('Cat updateAll success', true), array('action' => 'index'));

		} else {
			$this->Session->write('msgType' , 'error');
			$this->Session->write('msgTxt' , 'Category Update Failed.');
			$this->redirect(array('controller'=>'Cats', 'action' => 'index'));
			//$this->flash(__('Cat updateAll Fail', true), array('action' => 'index'));
		}
	}

	public function createindex() {
		$mongo = ConnectionManager::getDataSource($this->Cat->useDbConfig);
		$mongo->ensureIndex($this->Cat, array('title' => 1));

	}
}