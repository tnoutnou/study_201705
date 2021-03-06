<?php
App::uses('AppController', 'Controller');
/**
 * Posts Controller
 *
 * @property Post $Post
 * @property PaginatorComponent $Paginator
 */
class PostsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Flash','Search.Prg' , 'Session');
	
	public $uses = array('Post', 'Category', 'Tag', 'PostsTag', 'Image');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Post->recursive = 1;			// 0 から 1に変更
		//タイトルの必須入力を無効にする。	検索条件で利用しているタイトル
		unset($this->Post->validate['title']);
		$this->Prg->commonProcess();
//		$this->set('posts', $this->Paginator->paginate());

//		$this->log('!!!! ★A !!!!');
//		$this->log($this->passedArgs);
//		$this->log('!!!! ★B !!!!');

		$all_posts = $this->Post->find(
			'all',
			array(
				'fields'	=>	array('Post.id','Post.title'),
				'conditions' => $this->Post->parseCriteria($this->passedArgs),
				'recursive' => 0,
				)
		);
		
//		$this->log('!!!! ★D !!!!');
//		$this->log($this->paginate());
//		$this->Session->write('all_posts', $this->paginate());
		$this->Session->write('all_posts', $all_posts);


		$this->paginate = array(
			'conditions' => $this->Post->parseCriteria($this->passedArgs),
			'limit' => 10,
		);
		$this->set('posts', $this->paginate());

//		debug($this->Paginator->paginate());
		$categories = $this->Post->Category->find(
			'list',
			array('fields'=>array('id','name'))
		);
		$this->set(compact('categories'));
		$tags = $this->Post->Tag->find(
				'list',
				array(
						'fields'=>array('id','name'),
						'conditions' =>array('delete_flg' => '0')
				)
		);
		$this->set(compact('tags'));
		
//		$this->log($this->Auth->user());
//	最近の投稿
		$recent_posts = $this->Post->find(
			'list',
			array(
				'fields'=>array('id','title'),
				'limit'=>'5',
				'order'=>'created DESC'
			)
		);
		$this->set(compact('recent_posts'));

//	アーカイブ（月ごとの件数）
		$this->Post->virtualFields['CreatedYM'] = 0;			// バーチャルフィールドを動的に追加？
		$this->Post->virtualFields['cnt'] = 0;			// バーチャルフィールドを動的に追加？
		$arcive_posts = $this->Post->find(
			'all',
			array(
				'fields'=>array("DATE_FORMAT(Post.created,'%Y年%m月') as Post__CreatedYM", "count(Post.id) as Post__cnt"),
				'group'=>array("DATE_FORMAT(Post.created,'%Y年%m月')"),
				'order'=>array("DATE_FORMAT(Post.created,'%Y年%m月') DESC"),
				'recursive'=>-1,
			)
		);
//		$this->log($arcive_posts);
		$this->set(compact('arcive_posts'));

		
	}

	
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null,$opt = null) {
		if (!$this->Post->exists($id)) {
//			throw new NotFoundException(__('Invalid post'));
			throw new NotFoundException(__('無効な投稿です。'));
		}

		// 第２引数が設定されていない場合に前のURLを記録 
		if ($opt == null) {
			$preurl = $this->referer();
			$this->set(compact('preurl'));
			$this->Session->write('preurl',$preurl);
		} else {
			$preurl = $this->Session->read('preurl');			
			$this->set(compact('preurl'));
		}

		
		//　該当POSTの配列の位置を特定
		$post_key = NULL;
		$all_posts = $this->Session->read('all_posts');		// POSTSのIDとTITLEを格納した配列
		if ($opt == null) {			
			foreach ($all_posts as $key => $one_post) {
				if ($one_post['Post']['id'] == $id) {
					$post_key = $key;
					break;
				}
			}
			// 検索にヒットした投稿以外の投稿を表示している場合、検索条件を除き全件で位置を特定
			if ($post_key == NULL ) {
				
				$all_posts = $this->Post->find(
					'all',
					array(
						'fields'	=>	array('Post.id','Post.title'),
						'recursive' => 0,
						)
				);
				$this->Session->write('all_posts', $all_posts);
				
				foreach ($all_posts as $key => $one_post) {
					if ($one_post['Post']['id'] == $id) {
						$post_key = $key;
						break;
					}
				}								
			}
			
		} else {
			$post_key = $opt;
		}

//		$this->log('!!');
//		$this->log($id);
//		$this->log($post_key);
//		$this->log('!!!!');
				
		// 前の投稿　のタイトルとIDとKEYを　設定？
		if ($post_key > 0) {
			$pre_post_key = $post_key - 1;
			$pre_post_id = $all_posts[$post_key - 1]['Post']['id'];
			$pre_post_title = $all_posts[$post_key - 1]['Post']['title'];
		} else {
			$pre_post_key = null;
			$pre_post_id = null;
			$pre_post_title = null;
		}
		
		$pre_post = array(
			'pkey' => $pre_post_key,
			'id' => $pre_post_id,
			'title'=> $pre_post_title
		);

//		$this->log($pre_post);
		
		// 次の投稿　のタイトルとIDとKEYを　設定？
		if (!($post_key == (count($all_posts) - 1))) {
			$nxt_post_key = $post_key + 1;
			$nxt_post_id = $all_posts[$post_key + 1]['Post']['id'];
			$nxt_post_title = $all_posts[$post_key + 1]['Post']['title'];
		} else {
			$nxt_post_key = null;
			$nxt_post_id = null;
			$nxt_post_title = null;
		}

		$nxt_post = array(
			'pkey' => $nxt_post_key,
			'id' => $nxt_post_id,
			'title'=> $nxt_post_title
		);
		
		$this->set('pre_post', $pre_post);
		$this->set('nxt_post', $nxt_post);
		$this->set('all_posts', $all_posts);

		
		
		$options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));

		$this->set('post', $this->Post->find('first', $options));
//		
//		$poststags = $this->Post->Tag->find('list');
//		$this->set(compact('poststags'));
//		$options1 = array('conditions' => array('Tag.' . 'post_id' => $id));
//		$this->set('poststags', $this->Post->Tag->find('list', $options1));

//		var_dump($poststags); 
		$categories = $this->Post->Category->find('list',array('fields'=>array('id','name')));
		$this->set(compact('categories'));
		$tags = $this->Post->Tag->find(
			'list',
			array(
				'fields'=>array('id','name'),
				'conditions' =>array('delete_flg' => '0')
			)
		);
		$this->set(compact('tags'));
//$this->log(WEBROOT_DIR);
	}

	
/**
 * add method
 *
 * @return void
 */
	public function add() {
		
		if ($this->request->is('post')) {

			$this->Post->create();

			if (empty($this->request->data['Image'][0]['filename'])) {
				unset($this->request->data['Image']);
			}
			
/*			if(!empty($this->request->data['Post']['Image'][0]['name'])) {
				foreach ($this->request->data['Post']['Image'] as $img_o) {
					$img_lst2[] = array("model"=>"Post",
										"filename" => $img_o,
					);
				}
				$this->request->data['Image'] = $img_lst2;
			}
*/
			$j = count($this->request->data['Image']);
			
			for ($i = 0; $i < $j ; $i++){
				if (empty($this->request->data['Image'][$i]['filename']['name'])) {
					unset($this->request->data['Image'][$i]);
				}		
			}
			
			$this->request->data['Tag'] = $this->request->data['Post']['tag_id'];

			if($this->Post->saveall($this->request->data)) {
//				$this->Post->Image->save($img_lst2);
				
				// 一時ファイルの削除
//				$add_files = $this->Session->read('add_files');
//				$this->log($add_files);
			
//				foreach ($add_files  as $afl) {
//					$this->log($afl);
//					if(file_exists($afl)) {
//						$this->log(' !!! exists !!!');
//						unlink($afl);
//					}
//				}
//				$this->Session->delete('add_files');
				$this->delTmpFile();
				
//				$this->Flash->success(__('The post has been saved.'));
				$this->Flash->success(__('投稿を保存しました。'));
				return $this->redirect(array('action' => 'index'));
			} else {
//				$this->Flash->error(__('The post could not be saved. Please, try again.'));
				$this->Flash->error(__('投稿の保存に失敗しました。再度、投稿追加を行って下さい。'));
			}
		}
//		$users = $this->Post->User->find('list');

		$options = array(
			'conditions' => array('username' => $this->Session->read('login_user')),
			'fields'=>array('id','username')
		);

//		$users = $this->Post->User->find('list',array('fields'=>array('id','username')));
//		$users = $this->Post->User->find('list',array('fields'=>array('id','username')));
		$users = $this->Post->User->find('list', $options );

		
		$this->set(compact('users'));
//		$categories = $this->Post->Category->find('list');
		$categories = $this->Post->Category->find('list',array('fields'=>array('id','name')));
		$this->set(compact('categories'));

		$tags = $this->Post->Tag->find(
			'list',
			array(
				'fields'=>array('id','name'),
				'conditions' =>array('delete_flg' => '0')
			)
		);
		$this->set(compact('tags'));			
	
//		$selected = $this->Post->PostsTag->find('list',array('fields'=>array('tag_id'),'conditions' => array('PostsTag.' . 'post_id' => $id )));
//		$this->set(compact('selected'));
		
	}


	public function addFile() {
		// ビューの使用無を設定
		$this->autoRender = false;
		
		$prefile = $_POST["file_pre"];
		$dir = $_POST["dir"];

		if($_FILES["file"]["tmp_name"]){
			list($file_name,$file_type) = explode(".",$_FILES['file']['name']);

			$name = $prefile . $_FILES['file']['name'];

			$file = "img/".$dir;
			
			//ディレクトリを作成してその中にアップロードしている。
			if(!file_exists($file)){
			  mkdir($file,0755);
			}

			if (move_uploaded_file($_FILES['file']['tmp_name'], $file."/".$name)) {
			  chmod($file."/".$name, 0644);
			}
		}

	// 一時的に取り込んだファイルを記録する（後で削除するときに利用）
	$add_files = $this->Session->read('add_files');
	$add_files[] = $file . "/" . $name;
	$this->Session->write('add_files', $add_files);
		
	}

	public function delTmpFile() {
		// ビューの使用無を設定
		$this->autoRender = false;
		// 一時ファイルの削除
		$add_files = $this->Session->read('add_files');
//		$this->log($add_files);
		
		foreach ($add_files  as $afl) {
//			$this->log($afl);
			if(file_exists($afl)) {
//				$this->log(' !!! exists !!!');
				unlink($afl);
			}
		}
		$this->Session->delete('add_files');
		return;
	}

	
/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		
		//ファイル名の必須入力を無効にする。
		unset($this->Post->validate['filename']);

		if (!$this->Post->exists($id)) {
//			throw new NotFoundException(__('Invalid post'));
			throw new NotFoundException(__('無効な投稿です。'));
		}
		if ($this->request->is(array('post', 'put'))) {
//			if ($this->Post->save($this->request->data)) {

//			$this->request->data['Tag'] = implode( ',', $this->data['Post']['tag_id']);
			$this->request->data['Tag'] = $this->data['Post']['tag_id'];			

			$j = count($this->request->data['Image']);
			
			for ($i = 0; $i < $j ; $i++){
				if (empty($this->request->data['Image'][$i]['filename']['name'])) {
					unset($this->request->data['Image'][$i]);
				}		
			}
			
			if (empty($this->request->data['Image'][0]['filename']['name'])) {
				// ファイルが指定されなかった場合

//				$var_end = $this->Tag->save($this->request->data);
//				$var_end = $this->PostsTag->save($this->request->data);
//				if ($var_end) {
//					$var_end = $this->Post->save($this->request->data);
//				}
				unset($this->request->data['Image']);

//				$var_end = $this->Post->save($this->request->data);
			}

			// タグが全解除の場合に登録されていたタグを削除する
			if (empty($this->request->data['Tag'])) {
				$poststags = $this->Post->PostsTag->find(
//					'list',
					'all',
					array(
//						'fields'=>array('id'),
						'fields'=>array('post_id','tag_id'),
						'conditions' => array('PostsTag.' . 'post_id' => $id )
					)
				);
				foreach ($poststags as $poststag) {
//					$this->PostsTag->delete($poststag);
//					$this->log($poststag);
//					$this->log($poststag['PostsTag']['post_id']);
//					$this->log($poststag['PostsTag']['tag_id']);
//					$this->PostsTag->delete($poststag['PostsTag']['post_id'], $poststag['PostsTag']['tag_id']);
//					$this->PostsTag->delete($poststag['PostsTag']['post_id'], $poststag['PostsTag']['tag_id']);
					$this->PostsTag->deleteAll(
						array(
							'PostsTag.post_id' => $poststag['PostsTag']['post_id'],
							'PostsTag.tag_id' => $poststag['PostsTag']['tag_id']),
						false
					);
					
				}
			}
			
			// トランザクション対応（中）
//			$var_end = $this->Post->saveAll($this->request->data);
			$var_end = $this->Post->saveAllTrans($this->request->data);


			switch ($var_end) {
			case 1:
//				$this->Flash->success(__('The post has been saved.'));
				$this->Flash->success(__('投稿を保存しました。'));
				return $this->redirect(array('action' => 'index'));
				break;
			case -1:
				$this->Flash->error(__('投稿の保存に失敗しました。他のユーザが更新済みです。再度、投稿一覧から開き直してから編集を行って下さい。'));
				break;
			case -2:
				$this->Flash->error(__('投稿の保存に失敗しました。再度、投稿編集を行って下さい。'));
				break;
			}
		} else {
			$options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
			$this->request->data = $this->Post->find('first', $options);
			// ?? post にも設定（たぶん不適切）
			$this->set('post', $this->Post->find('first', $options));
//			debug($this->Post->find('first', $options));
			// 投稿者で無い場合は、編集画面を起動しない。
//			debug($this->request->data['User']['username']);
//			debug($this->Session->read('login_user'));

			//更新日時を取得
//			$options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id) , 'fields'=>array('id','modified') );
//			$postedit_tmp = $this->Post->find('first', $options);
//			$postedit = $postedit_tmp['Post'];
			
//			$this->log($this->request->data);
			
//			$this->Session->write('post_edit', $postedit);

			// 
			if (!((($this->request->data['User']['username']) === $this->Session->read('login_user'))
					or ($this->Session->read('admin_flg') === '1')
				))
			{
				$this->Flash->success(__('投稿の登録者か、管理者しか編集できません。'));
				return $this->redirect(array('action' => 'index'));
			}
			
		}

		// 投稿したユーザに固定
//		$options = array('conditions' => array('username' => $this->Session->read('login_user')), 'fields'=>array('id','username') );
		$options = array(
			'conditions' => array('id' => $this->request->data['User']['id']),
			'fields'=>array('id','username')
		);
		
//		$users = $this->Post->User->find('list');
//		$users = $this->Post->User->find('list',array('fields'=>array('id','username')));
		$users = $this->Post->User->find('list', $options );


		
		$this->set(compact('users'));
//		$categories = $this->Post->Category->find('list');
		$categories = $this->Post->Category->find('list',array('fields'=>array('id','name')));
		$this->set(compact('categories'));
//		$tags = $this->Post->Tag->find('list');
//		$options = array('conditions' => array('Tag.' . 'post_id' => $id));

		$tags = $this->Post->Tag->find(
			'list',
			array(
				'fields'=>array('id','name')
				, 'conditions' =>array('delete_flg' => '0')
			)
		);
		$this->set(compact('tags'));			
	
		$selected = $this->Post->PostsTag->find(
			'list',
//			'all',
			array(
				'fields'=>array('tag_id','tag_id'),
//				'fields'=>array('tag_id','post_id'),
				'conditions' => array('PostsTag.' . 'post_id' => $id )
			)
		);
		$this->set(compact('selected'));

	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Post->id = $id;
		if (!$this->Post->exists()) {
			throw new NotFoundException(__('Invalid post'));
		}

		$this->request->allowMethod('post', 'delete');

		// 投稿者しか削除できないように。
//		$options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
//		$posts = $this->Post->find('first', $options);
//		if (!(($posts['User']['username']) === $this->Session->read('login_user')) ) {
//			$this->Flash->success(__('投稿者しか削除できません。'));
//			return $this->redirect(array('action' => 'index'));
//		}

		$options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
//		$this->set('post', $this->Post->find('first', $options));
		$posts = $this->Post->find('first', $options);
		$images = $posts['Image'];
		$tags = $posts['Tag'];

//		$this->log($posts);
//		$this->log($tags);
		

		$this->Post->delete();
		
		if (!$this->Post->exists()) {
			// 子データの削除処理（論理削除対応）
			
			foreach ($images as $image) {
	//			$this->log($image['id']);
				$this->Image->delete($image['id']);
			}		


			foreach ($tags as $tag) {
	//			$this->log($tag['PostsTag']['id']);
	//			$this->PostsTag->delete($tag['PostsTag']['id']);
	//			$this->PostsTag->delete($tag['PostsTag']['post_id'], $tag['PostsTag']['tag_id']);
				$this->PostsTag->deleteAll(
					array(
						'PostsTag.post_id' => $tag['PostsTag']['post_id'],
						'PostsTag.tag_id' => $tag['PostsTag']['tag_id']),
					false
				);
			}

//			$this->Flash->success(__('The post has been deleted.'));
			$this->Flash->success(__('投稿を削除しました。'));
		} else {
//			$this->Flash->error(__('The post could not be deleted. Please, try again.'));
			$this->Flash->error(__('投稿の削除に失敗しました。再度、投稿削除を行って下さい。'));

		}
		return $this->redirect(array('action' => 'index'));
	}

	public function backIndex() {
		// ビューの使用無を設定
		$this->autoRender = false;
/*		return $this->redirect($this->referer());	*/
		return $this->redirect($this->Auth->redirect());
	}

	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('index', 'view', 'addFile', 'delTmpFile','backIndex');
	}
	
}

