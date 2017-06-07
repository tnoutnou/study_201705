<?php
App::uses('AppController', 'Controller');
/**
 * Tags Controller
 *
 * @property Tag $Tag
 * @property PaginatorComponent $Paginator
 */
class TagsController extends AppController {

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
		$this->Tag->recursive = 0;
		$this->set('tags', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Tag->exists($id)) {
//			throw new NotFoundException(__('Invalid tag'));
			throw new NotFoundException(__('無効なタグです。'));
		}
		$options = array('conditions' => array('Tag.' . $this->Tag->primaryKey => $id));
		$this->set('tag', $this->Tag->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Tag->create();
			if ($this->Tag->save($this->request->data)) {
//				$this->Flash->success(__('The tag has been saved.'));
				$this->Flash->success(__('タグを追加しました。'));
				return $this->redirect(array('action' => 'index'));
			} else {
//				$this->Flash->error(__('The tag could not be saved. Please, try again.'));
				$this->Flash->error(__('タグの保存に失敗しました。再度、追加を行って下さい。'));
			}
		}
		$posts = $this->Tag->Post->find('list');
		$this->set(compact('posts'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Tag->exists($id)) {
//				$this->Flash->success(__('The tag has been saved.'));
				$this->Flash->success(__('タグを追加しました。'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Tag->save($this->request->data)) {
//				$this->Flash->success(__('The tag has been saved.'));
				$this->Flash->success(__('タグを保存しました。'));
				return $this->redirect(array('action' => 'index'));
			} else {
//				$this->Flash->error(__('The tag could not be saved. Please, try again.'));
				$this->Flash->error(__('タグの保存に失敗しました。再度、編集を行って下さい。'));
			}
		} else {
			$options = array('conditions' => array('Tag.' . $this->Tag->primaryKey => $id));
			$this->request->data = $this->Tag->find('first', $options);
		}
		$posts = $this->Tag->Post->find('list');
		$this->set(compact('posts'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Tag->id = $id;
		if (!$this->Tag->exists()) {
//			throw new NotFoundException(__('Invalid tag'));
			throw new NotFoundException(__('無効なタグです。'));
		}
		$this->request->allowMethod('post', 'delete');
		$this->Tag->delete();
		if (!$this->Tag->exists()) {
//			$this->Flash->success(__('The tag has been deleted.'));
			$this->Flash->success(__('タグを削除しました。'));
		} else {
//			$this->Flash->error(__('The tag could not be deleted. Please, try again.'));
			$this->Flash->error(__('タグの削除に失敗しました。再度、削除を行って下さい。'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
