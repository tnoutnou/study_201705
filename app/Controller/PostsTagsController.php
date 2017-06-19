<?php
App::uses('AppController', 'Controller');
/**
 * PostsTags Controller
 *
 * @property PostsTag $PostsTag
 * @property PaginatorComponent $Paginator
 */
class PostsTagsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Flash');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->PostsTag->recursive = 0;
		$this->set('postsTags', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PostsTag->exists($id)) {
//			throw new NotFoundException(__('Invalid posts tag'));
			throw new NotFoundException(__('無効な投稿タグです'));
		}
		$options = array('conditions' => array('PostsTag.' . $this->PostsTag->primaryKey => $id));
		$this->set('postsTag', $this->PostsTag->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
//	public function add() {
	public function add($id = null) {
		if ($this->request->is('post')) {
			$this->PostsTag->create();
			if ($this->PostsTag->save($this->request->data)) {
//				$this->Flash->success(__('The posts tag has been saved.'));
				$this->Flash->success(__('投稿タグを保存しました。'));
				return $this->redirect(array('action' => 'index'));
			} else {
//				$this->Flash->error(__('The posts tag could not be saved. Please, try again.'));
				$this->Flash->error(__('投稿タグの保存に失敗しました。再度、追加して下さい。'));
			}
		}
//		$posts = $this->PostsTag->Post->find('list');
		if ($id === null) {
			$posts = $this->PostsTag->Post->find('list');
		} else {
			$options = array('conditions' => array('Post.' . 'id' => $id));
			$posts = $this->PostsTag->Post->find('list', $options);
		}
//		$tags = $this->PostsTag->Tag->find('list');
		$tags = $this->PostsTag->Tag->find('list',array('fields'=>array('id','name')));
		$this->set(compact('posts', 'tags'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->PostsTag->exists($id)) {
//			throw new NotFoundException(__('Invalid posts tag'));
			throw new NotFoundException(__('無効な投稿タグです'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->PostsTag->save($this->request->data)) {
//				$this->Flash->success(__('The posts tag has been saved.'));
				$this->Flash->success(__('投稿タグを保存しました。'));
				return $this->redirect(array('action' => 'index'));
			} else {
//				$this->Flash->error(__('The posts tag could not be saved. Please, try again.'));
				$this->Flash->error(__('投稿タグの保存に失敗しました。再度、編集して下さい。'));
			}
		} else {
			$options = array('conditions' => array('PostsTag.' . $this->PostsTag->primaryKey => $id));
			$this->request->data = $this->PostsTag->find('first', $options);
		}
		$posts = $this->PostsTag->Post->find('list');
//		$tags = $this->PostsTag->Tag->find('list');
		$tags = $this->PostsTag->Tag->find('list',array('fields'=>array('id','name')));
		$this->set(compact('posts', 'tags'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->PostsTag->id = $id;
		if (!$this->PostsTag->exists()) {
//			throw new NotFoundException(__('Invalid posts tag'));
			throw new NotFoundException(__('無効な投稿タグです'));
		}
		$this->request->allowMethod('post', 'delete');
		$this->PostsTag->delete();
		if (!$this->PostsTag->exists()) {
//			$this->Flash->success(__('The posts tag has been deleted.'));
			$this->Flash->success(__('投稿タグを削除しました。'));
		} else {
//			$this->Flash->error(__('The posts tag could not be deleted. Please, try again.'));
			$this->Flash->error(__('投稿タグの削除に失敗しました。再度、削除して下さい。'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
