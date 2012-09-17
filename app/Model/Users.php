<?php

App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel {
	public $name = 'User';
	public $primaryKey = '_id';
	var $useDbConfig = 'default';
	
	var $mongoSchema = array(
		'email'=>array('type'=>'string'),
		'password'=>array('type'=>'string'),
		'username'=>array('type'=>'string'),
	);
	 
	public $validate = array(
			'username' => array(
					'required' => array(
							'rule' => array('notEmpty'),
							'message' => 'A username is required'
					)
			),
			'password' => array(
					'required' => array(
							'rule' => array('notEmpty'),
							'message' => 'A password is required'
					)
			),
			'role' => array(
					'valid' => array(
							'rule' => array('inList', array('admin', 'author')),
							'message' => 'Please enter a valid role',
							'allowEmpty' => false
					)
			)
	);
	
	public function beforeSave($options = array()) {
		debug($this->data['User']['password']);
	    if (isset($this->data['User']['password'])) {
	        $this->request->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
	    }
	    return true;
	}
	 
}