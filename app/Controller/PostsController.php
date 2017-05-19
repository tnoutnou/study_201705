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
	public $components = array('Paginator','Flash','Search.Prg');
	
	public $uses = array('Post', 'Category', 'Tag','PostsTag');

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
		$tags = $this->Post->Tag->find('list',array('fields'=>array('id','tagname')));
		$this->set(compact('tags'));
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
			throw new NotFoundException(__('Invalid post'));
		}
		$options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
		$this->set('post', $this->Post->find('first', $options));
//		
//		$poststags = $this->Post->Tag->find('list');
//		$this->set(compact('poststags'));
//		debug($poststags);
//		$options1 = array('conditions' => array('Tag.' . 'post_id' => $id));
//		$this->set('poststags', $this->Post->Tag->find('list', $options1));
//		debug($this->Post->find('first', $options));
//		debug($poststags);
//		var_dump($poststags); 
		$categories = $this->Post->Category->find('list',array('fields'=>array('id','categoryname')));
		$this->set(compact('categories'));
		$tags = $this->Post->Tag->find('list',array('fields'=>array('id','tagname')));
		$this->set(compact('tags'));

	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Post->create();
			if ($this->Post->save($this->request->data)) {
				$this->Flash->success(__('The post has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The post could not be saved. Please, try again.'));
			}
		}
//		$users = $this->Post->User->find('list');
		$users = $this->Post->User->find('list',array('fields'=>array('id','username')));
		$this->set(compact('users'));
//		$categories = $this->Post->Category->find('list');
		$categories = $this->Post->Category->find('list',array('fields'=>array('id','categoryname')));
		$this->set(compact('categories'));
		
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
			throw new NotFoundException(__('Invalid post'));
		}
		if ($this->request->is(array('post', 'put'))) {
//			if ($this->Post->save($this->request->data)) {
//			debug($this->request->data);
//			debug($this->request->data['Image'][0]['filename']['name']);
			
			//
//			debug($this->request->data);
//			debug($this->request->data['Post']['tag_id']);

//			$this->request->data['Tag'] = implode( ',', $this->data['Post']['tag_id']);
			$this->request->data['Tag'] = $this->data['Post']['tag_id'];
			
//			debug($this->request->data);
//			return;

			
			if (empty($this->request->data['Image'][0]['filename']['name'])) {
				// ファイルが指定されなかった場合
//				debug('1');
//				$var_end = $this->Tag->save($this->request->data);
//				$var_end = $this->PostsTag->save($this->request->data);
//				if ($var_end) {
//					$var_end = $this->Post->save($this->request->data);
//				}

				unset($this->request->data['Image']);

//				debug($this->request->data);
//				return;

//				$var_end = $this->Post->save($this->request->data);
				
				
			} else {
				// ファイルが指定された場合
//				debug('2');
			}

//			debug($this->request->data);
			//
//			debug($selected);
//			debug($this->Post->PostsTag->find('list',array('fields'=>array('tag_id'),'conditions' => array('PostsTag.' . 'post_id' => $id ))));

			// タグが全解除の場合に登録されていたタグを削除する
			if (empty($this->request->data['Tag'])) {
				$poststags = $this->Post->PostsTag->find('list',array('fields'=>array('id'),'conditions' => array('PostsTag.' . 'post_id' => $id )));
				foreach ($poststags as $poststag) {
//					debug($poststag);
					$this->PostsTag->delete($poststag);
				}
			}
			
			$var_end = $this->Post->saveAll($this->request->data);

			
			
			if ($var_end) {
				$this->Flash->success(__('The post has been saved.'));
				return $this->redirect(array('action' => 'index'));
//				return;
			} else {
				$this->Flash->error(__('The post could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
//			debug($this->Post->find('first', $options));
			$this->request->data = $this->Post->find('first', $options);
		// ?? post にも設定（たぶん不適切）
			$this->set('post', $this->Post->find('first', $options));
//			debug($this->Post->find('first', $options));
		}
//		$users = $this->Post->User->find('list');
		$users = $this->Post->User->find('list',array('fields'=>array('id','username')));
		$this->set(compact('users'));
//		$categories = $this->Post->Category->find('list');
		$categories = $this->Post->Category->find('list',array('fields'=>array('id','categoryname')));
		$this->set(compact('categories'));
//		$tags = $this->Post->Tag->find('list');
//		$options = array('conditions' => array('Tag.' . 'post_id' => $id));

		$tags = $this->Post->Tag->find('list',array('fields'=>array('id','tagname')));
		$this->set(compact('tags'));
			
	
		$selected = $this->Post->PostsTag->find('list',array('fields'=>array('tag_id'),'conditions' => array('PostsTag.' . 'post_id' => $id )));
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
//		if ($this->Post->deleteall()) {
		if ($this->Post->delete()) {
			$this->Flash->success(__('The post has been deleted.'));
		} else {
			$this->Flash->error(__('The post could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('index', 'view');
	}
	
}
