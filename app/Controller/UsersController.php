<?php
/**
 * UserController class
 *
 * @uses          AppController
 * @package       mongodb
 * @subpackage    mongodb.samples.controllers
 */

class UsersController extends AppController {

	function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('add','logout');
	}

/**
 * name property
 *
 * @var string 'User'
 * @access public
 */
	public $name = 'Users';

/**
 * index method
 *
 * @return void
 * @access public
 */
	public function index() {
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
		$this->User->recursive = 0;
		$users_list = $this->User->find('all', $params);
		//$result = $this->Post->find('count', $params);
		$this->set(compact('users_list'));
		$this->set('user', $this->paginate());
	}

# Action to log the user in
	public function login() 
	{
	        if ($this->Auth->login()) 
	        {
	            $this->redirect($this->Auth->redirect());
	        } 
	        else 
	        {
	            //$this->Session->setFlash(__('Invalid username or password, try again'),'flash_fail');
	        }
	    }

	public function logout() 
	{
	    $this->redirect($this->Auth->logout());
	}


    public function view($id = null) 
    {

        $this->User->id = $id;

        if (!$this->User->exists()) 
        {
            throw new NotFoundException(__('Invalid user'));
        }

        $this->set('user', $this->User->read(null, $id));
    }	
	
	
/**
 * add method
 *
 * @return void
 * @access public
 */
	public function add() {
	//	$this->layout = false;
		
		if (!empty($this->data)) {
			//debug($this->data);
			$this->User->create();
			$this->request->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
			//debug($this->data);
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('controller'=>'Users', 'action' => 'login'));
				//$this->flash(__('User saved.', true), array('action' => 'index'));
			} else {
				//$this->layout = false;
				$this->Session->setFlash(__('The user could not be registered. Please, try again.'));
				$this->redirect(array('controller'=>'Users', 'action' => 'add'));
			}
		}
	}
	
	public function users_list(){
		
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
		
		$users_list = $this->User->find('all', $params);
		
		//$result = $this->Post->find('count', $params);
		$this->set(compact('users_list'));
	}
	
/**
 * edit method
 *
 * @param mixed $id null
 * @return void
 * @access public
 */
	public function edit($id = null) {
		$id = $this->request->query['id'];
		
		//debug($this->data);
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid User', true), array('action' => 'index'));
		}
		
		if (!empty($this->data)) {
			if(!empty($this->data['User']['password'])){
				$this->request->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
			} else {
				unset($this->request->data['User']['password']);
			}
			if ($this->User->save($this->data['User'])) {
				//$this->flash(__('The User has been saved.', true), array('controller'=> 'Users', 'action' => 'logout'));
				$this->redirect(array('controller'=>'Users', 'action' => 'logout'));
			} else {
				//unable to save user data
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
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
			//$this->Session->setFlash(__('Invalid User.'));
			$this->redirect(array('controller'=>'Pages', 'action' => 'display'));
			//$this->flash(__('Invalid User', true), array('action' => 'index'));
		}
		if ($this->User->delete($id)) {
			//$this->Session->setFlash(__('Usaer deleted.'));
			$this->redirect(array('controller'=>'Pages', 'action' => 'display'));
			//$this->flash(__('User deleted', true), array('action' => 'index'));
		} else {
			//$this->Session->setFlash(__('User delete Failed.'));
			$this->redirect(array('controller'=>'Pages', 'action' => 'display'));
			//$this->flash(__('User deleted Fail', true), array('action' => 'index'));
		}
	}
	
	
/**
 * deleteall method
 *
 * @return void
 * @access public
 */
	public function deleteall() {
		$conditions = array('title' => 'aa');
		if ($this->User->deleteAll($conditions)) {
			$this->flash(__('User deleteAll success', true), array('action' => 'index'));

		} else {
			$this->flash(__('User deleteAll Fail', true), array('action' => 'index'));
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

		if ($this->User->updateAll($field, $conditions)) {
			$this->flash(__('User updateAll success', true), array('action' => 'index'));

		} else {
			$this->flash(__('User updateAll Fail', true), array('action' => 'index'));
		}
	}

	public function createindex() {
		$mongo = ConnectionManager::getDataSource($this->User->useDbConfig);
		$mongo->ensureIndex($this->User, array('title' => 1));

	}
}