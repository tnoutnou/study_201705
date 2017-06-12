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
		$this->paginate = array(
			'conditions' => $this->Post->parseCriteria($this->passedArgs),
			'limit' => 10,
		);
		$this->set('posts', $this->paginate());

//		debug($this->Paginator->paginate());
		$categories = $this->Post->Category->find('list',array('fields'=>array('id','categoryname')));
		$this->set(compact('categories'));
		$tags = $this->Post->Tag->find(
				'list',
				array(
						'fields'=>array('id','tagname'),
						'conditions' =>array('deleted' => '0')
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

	}

	
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Post->exists($id)) {
//			throw new NotFoundException(__('Invalid post'));
			throw new NotFoundException(__('無効な投稿です。'));
		}
		$options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
		$this->set('post', $this->Post->find('first', $options));
//		
//		$poststags = $this->Post->Tag->find('list');
//		$this->set(compact('poststags'));
//		$options1 = array('conditions' => array('Tag.' . 'post_id' => $id));
//		$this->set('poststags', $this->Post->Tag->find('list', $options1));

//		var_dump($poststags); 
		$categories = $this->Post->Category->find('list',array('fields'=>array('id','categoryname')));
		$this->set(compact('categories'));
		$tags = $this->Post->Tag->find(
			'list',
			array(
				'fields'=>array('id','tagname'),
				'conditions' =>array('deleted' => '0')
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
			
			$this->request->data['Tag'] = $this->request->data['Post'][tag_id];

			if($this->Post->saveall($this->request->data)) {
//				$this->Post->Image->save($img_lst2);
				
				// 一時ファイルの削除
//				$add_files　= $this->Session->read('add_files');
//				$this->log($add_files);
			
//				foreach ($add_files　 as $afl) {
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
		$categories = $this->Post->Category->find('list',array('fields'=>array('id','categoryname')));
		$this->set(compact('categories'));

		$tags = $this->Post->Tag->find(
			'list',
			array(
				'fields'=>array('id','tagname'),
				'conditions' =>array('deleted' => '0')
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
		$add_files　= $this->Session->read('add_files');
//		$this->log($add_files);
		
		foreach ($add_files　 as $afl) {
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
					'list',
					array(
						'fields'=>array('id'),
						'conditions' => array('PostsTag.' . 'post_id' => $id )
					)
				);
				foreach ($poststags as $poststag) {
					$this->PostsTag->delete($poststag);
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
		$categories = $this->Post->Category->find('list',array('fields'=>array('id','categoryname')));
		$this->set(compact('categories'));
//		$tags = $this->Post->Tag->find('list');
//		$options = array('conditions' => array('Tag.' . 'post_id' => $id));

		$tags = $this->Post->Tag->find(
			'list',
			array(
				'fields'=>array('id','tagname')
				, 'conditions' =>array('deleted' => '0')
			)
		);
		$this->set(compact('tags'));			
	
		$selected = $this->Post->PostsTag->find(
			'list',
			array(
				'fields'=>array('tag_id'),
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


		$this->Post->delete();
		
		if (!$this->Post->exists()) {
			// 子データの削除処理（論理削除対応）
			
		foreach ($images as $image) {
//			$this->log($image['id']);
			$this->Image->delete($image['id']);
		}		


		foreach ($tags as $tag) {
//			$this->log($tag['PostsTag']['id']);
			$this->PostsTag->delete($tag['PostsTag']['id']);
		}

//			$this->Flash->success(__('The post has been deleted.'));
			$this->Flash->success(__('投稿を削除しました。'));
		} else {
//			$this->Flash->error(__('The post could not be deleted. Please, try again.'));
			$this->Flash->error(__('投稿の削除に失敗しました。再度、投稿削除を行って下さい。'));

		}
		return $this->redirect(array('action' => 'index'));
	}

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('index', 'view', 'addFile', 'delTmpFile');
	}
	
}

