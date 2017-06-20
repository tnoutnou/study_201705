<?php
App::uses('AppModel', 'Model');
/**
 * PostsTag Model
 *
 * @property Post $Post
 * @property Tag $Tag
 */
class PostsTag extends AppModel {

	public $actsAs = array('SoftDelete');

	public $primaryKeyArray = array('post_id', 'tag_id');
	
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'post_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'tag_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
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
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'post_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Tag' => array(
			'className' => 'Tag',
			'foreignKey' => 'tag_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	public function existsPkey($post_id = null, $tag_id = null) {
/*
		if ($id === null) {
			$id = $this->getID();
		}

		if ($id === false) {
			return false;
		}
*/

		if ($this->useTable === false) {
			return false;
		}

		return (bool)$this->find('count', array(
			'conditions' => array(
				$this->alias . '.post_id' => $post_id,
				$this->alias . '.tag_id'  => $tag_id,			
			),
			'recursive' => -1,
			'callbacks' => false
		));
	}
	
	
	
}
