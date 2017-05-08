<?php
App::uses('AppModel', 'Model');
/**
 * Post Model
 *
 * @property User $User
 */
class Post extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'title' => array(
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

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'Category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public $hasMany = array(
		'Image' => array(
			'className' => 'Image',
			'foreignKey' => 'post_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

/**	
	public $hasAndBelongsToMany = array(
		'Tag' => 
	    array(
	      'className'              => 'tag',
	      'joinTable'              => 'posts_tags',
	      'foreignKey'             => 'post_id',
	      'associationForeignKey'  => 'tag_id',
//	      'unique'                 => true,
		  'unique'                 => 'keepExisting',
	      'conditions'             => '',
	      'fields'                 => '',
	      'order'                  => '',
	      'limit'                  => '',
	      'offset'                 => '',
	      'finderQuery'            => '',
	      'deleteQuery'            => '',
	      'insertQuery'            => ''
	    )
	);
*/
	
	public $hasAndBelongsToMany = array(
		'Tag' => array(
			'className' => 'tag',
			'joinTable' => 'posts_tags',
			'foreignKey' => 'post_id',
			'associationForeignKey' => 'tag_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);

	
}
