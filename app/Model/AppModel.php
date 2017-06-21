<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {

    // 以下のコードを追加
    public function exists($id = null) {
        if ($this->Behaviors->loaded('SoftDelete')) {
            return $this->existsAndNotDeleted($id);
        } else {
            return parent::exists($id);
        }
    }

	// ユーザ名の重複チェック（論理削除を考慮）
	public function checkUnique($valid_field1){
		// フィールド名とフォームへの入力値の配列から、キーであるフィールド名を取得
		$fieldname = key($valid_field1);
		if ($this->id == NULL) {
			$conditions = array(
					$this->alias . '.' . $fieldname => $valid_field1,
					$this->alias . '.' . 'delete_flg' => 0,					
				);
		} else {
			$conditions = array(
					$this->alias . '.' . $fieldname => $valid_field1,
					$this->alias . '.' . $this->primaryKey . ' !=' => $this->id,
					$this->alias . '.' . 'delete_flg' => 0,					
				);
		}
		// 同一ユーザ名の存在チェック（カウント）
		$n_cnt = $this->find('count', array(
				'conditions' => $conditions,
			));
		// 存在する場合は重複エラー
		if($n_cnt > 0)
		{
			return false;
		}
		return true;
	}

		
	

	
	
}


	