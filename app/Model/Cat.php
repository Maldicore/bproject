<?php

class Cat extends AppModel {
	public $primaryKey = '_id';
	var $useDbConfig = 'default';
	
	//public $mongoNoSetOperator = true;
		
// 	 var $mongoSchema = array(
// 	 		'cat_name' => array('type'=>'string'),
// 	 		'field_name'=>array('type'=>'string'),
// 	 		'field_sname'=>array('type'=>'string'),
// 	 		'field_type'=>array('type'=>'string'),
// 	 );
}