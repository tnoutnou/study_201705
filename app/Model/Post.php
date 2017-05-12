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
 // サーチフィルタ
	public $actsAs = array('Search.Searchable');
	public $filterArgs = array(
		'category_id' => array('type' => 'value'),
		'title' => array('type' => 'like'),
		'tag_id' => array('type' => 'query', 'method' => 'findByTags')
	);

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
//			'dependent' => false,
			'dependent' => true,
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

	//タグの検索
	public function findByTags($data = array()){

//		debug($data['tag_id']);
//		$condition = array('tag_id' => $data['tag_id']);
		
		$options = array('fields'=>array('post_id') , 'conditions' => array('tag_id' => $data['tag_id']));
		
		$tmps = $this->PostsTag->find('list', $options);
		
//		debug($tmps);

		/*
		$tmp_arr = [];

		foreach ($tmps as $tmp) {
			debug($tmp);
			array_push($tmp_arr, $tmp);			
		};
*/
		
//		$condition = array('Post.id' => $tmp_arr);
		$condition = array('Post.id' => $tmps);
		return $condition;
		
	}
	
}
