<?php
App::uses('AppModel', 'Model');
/**
 * Category Model
 *
 */
class Category extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
			'name' => array(
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
		'Post' => array(
			'className' => 'Post',
//			'conditions' => array('' => '1'),
// 下記条件はいらないかも？
			'conditions' =>array('deleted' => '0'),
			'order' => 'Post.id ASC'
		)
	);
	
	public $actsAs = array('SoftDelete');
	
	
	
}
