<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
/**
 * User Model
 *
 * @property Group $Group
 * @property Post $Post
 */
class User extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'username' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'password' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'same' => array(
				'rule' => array('checkCompare', 'new_password'),
				'message' => '上下で同じ内容を入力してください',
//				'message' => array('label'='上下で同じ内容を入力してください'),
			),
		),
		'new_password' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
//			'same' => array(
//				'rule' => array('checkCompare', 'new_password'),
//				'message' => '上下で同じ内容を入力してください',
//			),
		'old_password' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'sameOld' => array(
				'rule' => array('checkOldPassword'),
				'message' => '現在のパスワードが正しくありません。',
			),
		),
		'group_id' => array(
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
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => array('deleted' => '0'),
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	public function beforeSave($options = array()) {
        $this->data['User']['password'] = AuthComponent::password(
          $this->data['User']['password']
        );
        return true;
    }
	
//	public $actsAs = array('Acl' => array('type' => 'requester'));
	public $actsAs = array('Acl' => array('type' => 'requester'), 'SoftDelete');

	public function parentNode() {
        if (!$this->id && empty($this->data)) {
            return null;
        }
        if (isset($this->data['User']['group_id'])) {
            $groupId = $this->data['User']['group_id'];
        } else {
            $groupId = $this->field('group_id');
        }
        if (!$groupId) {
            return null;
        } else {
            return array('Group' => array('id' => $groupId));
        }
    }

	public function checkCompare($valid_field1, $valid_field2){
		// フィールド名とフォームへの入力値の配列から、キーであるフィールド名を取得
//		$this->log('1');
//		$this->log($valid_field1);
//		$this->log('2');
//		$this->log($valid_field2);
		$fieldname = key($valid_field1);
		// 2つのフィールドの入力値を比較
		if($this->data[$this->name][$fieldname] === $this->data[$this->name][$valid_field2]){
			return true;
		}
		return false;
	}

	public function checkOldPassword($valid_field1){
		// フィールド名とフォームへの入力値の配列から、キーであるフィールド名を取得
		$fieldname = key($valid_field1);

		// 旧パスワードの一致確認 未完
		if($this->data[$this->name]['olddbpassword'] === AuthComponent::password($this->data[$this->name]['old_password'])){
			return true;
		}
		return false;

	}
		
		
		
}
