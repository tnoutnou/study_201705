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

// 	public $components = array('Session');
 
 // サーチフィルタ
	public $actsAs = array('Search.Searchable', 'SoftDelete');
	public $filterArgs = array(
		'category_id' => array('type' => 'value'),
		'category_str' => array('type' => 'query', 'method' => 'findByCateg'),
		'title' => array('type' => 'like'),
		'tag_id' => array('type' => 'query', 'method' => 'findByTags'),
		'tag_str' => array('type' => 'query', 'method' => 'findByTagstr'),
		'created_ym' => array('type' => 'query', 'method' => 'findByCreatedYm'),
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
			'conditions' => array('Image.deleted' => '0'),
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
			'conditions' => array('PostsTag.deleted' => '0'),
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);

// ヴァーチャルフィールド
	public $virtualFields = array(
		'old_modified' => 'Post.modified'
	);

	
	
	
	
	
	//タグの検索
	public function findByTags($data = array()){

//		debug($data['tag_id']);
//		$condition = array('tag_id' => $data['tag_id']);
		
		$options = array(
			'fields'=>array('post_id'),
			'conditions' => array('tag_id' => $data['tag_id'])
		);
		
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

	
	//カテゴリの部分一致
	public function findByCateg($data = array()){

//		debug($data['category_str']);
//		$condition = array('tag_id' => $data['category_id_str']);
		
		$options = array(
			'fields'=>array('id'),
			'conditions' => array('name like' => '%' . $data['category_str'] . '%'
			)
		);
		
		$tmps = $this->Category->find('list', $options);
		
//		debug($tmps);

		/*
		$tmp_arr = [];
		foreach ($tmps as $tmp) {
			debug($tmp);
			array_push($tmp_arr, $tmp);			
		};
*/
		
//		$condition = array('Post.id' => $tmp_arr);
		$condition = array('Post.category_id' => $tmps);
		return $condition;
		
	}

	//アーカイブ（年月）指定の検索
	public function findByCreatedYm($data = array()){

//		debug($data['created_ym']);
//		$condition = array('tag_id' => $data['category_id_str']);
		$this->log('!!!!!!');
		$this->log($data['created_ym']);
				
//		$condition = array('Post.id' => $tmp_arr);
		$condition = array("DATE_FORMAT(Post.created,'%Y年%m月')"  => $data['created_ym']);
		return $condition;
		
	}

	
	
	
	
	//タグの部分一致
	public function findByTagstr($data = array()){

//		debug($data['tag_str']);
//		$condition = array('tag_id' => $data['category_id_str']);
		
		$options = array(
			'fields'=>array('id'),
			'conditions' => array('name like' => '%' . $data['tag_str'] . '%'
			)
		);		
		$tmps = $this->Tag->find('list', $options);

//		debug($tmps);

		$options2 = array('fields'=>array('post_id') , 'conditions' => array('tag_id' => $tmps));		
		$tmps2 = $this->PostsTag->find('list', $options2);

//		debug($tmps2);

		/*
		$tmp_arr = [];
		foreach ($tmps as $tmp) {
			debug($tmp);
			array_push($tmp_arr, $tmp);			
		};
*/
		
//		$condition = array('Post.id' => $tmp_arr);
		$condition = array('Post.id' => $tmps2);
		return $condition;
		
	}

	// トランザクション内で更新する。
	public function saveAllTrans($data = array()){
		$datasource = $this->getDataSource();
		try{
			$datasource->begin();			
			//

//			$this->log('!!! 1111 !!!');
//			$this->log($data);
			$this->query('set innodb_lock_wait_timeout = 1;');			
			$now_postedit = $this->query('SELECT id, modified FROM posts AS Post WHERE id = ' . $data['Post']['id'] . ' FOR UPDATE;');

//			$this->log($now_postedit);
			
//			$this->log($data['Post']);
//			$old_postedit = array($data['Post']['id'] , $data['Post']['modified']);
			$old_postedit = array($data['Post']['id'] , $data['Post']['old_modified']);

//			$this->log($old_postedit);
			
			if (($now_postedit[0]['Post']['id'] === $data['Post']['id'])
				and ($now_postedit[0]['Post']['modified'] === $data['Post']['old_modified']))
			{
				if (!$this->saveAll($data)) {
					throw new Exception();
				}
			} else {
				$datasource->rollback();
//				return false;
				return -1;		//他者が更新済みだった			
			}
			
			$datasource->commit();
//			return true;
			return 1;

		} catch(Exception $e) {
			$datasource->rollback();
//			return false;
			return -2;		//予期せねエラー
		}

		
	}

	
}
