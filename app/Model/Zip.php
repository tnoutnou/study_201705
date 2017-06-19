<?php
App::uses('AppModel', 'Model');
/**
 * Zip Model
 *
 */
class Zip extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'prefecture_name_kana' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'ken_name_kan' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	
	
		
	public $hasMany = array(
		'User' => array(
			'className' => 'User',
//			'conditions' => array('' => '1'),
			'conditions' => '',
			'order' => ''
		)
	);			
	
	
	
}
