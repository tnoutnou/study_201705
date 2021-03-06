<?php
App::uses('AppController', 'Controller');
/**
 * Categories Controller
 *
 * @property Category $Category
 * @property PaginatorComponent $Paginator
 */
class CategoriesController extends AppController {

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
		$this->Category->recursive = 0;
		$this->set('categories', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Category->exists($id)) {
//			throw new NotFoundException(__('Invalid category'));
			throw new NotFoundException(__('無効なカテゴリです。'));
		}
		$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
		$this->set('category', $this->Category->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Category->create();
			if ($this->Category->save($this->request->data)) {
//				$this->Flash->success(__('The category has been saved.'));
				$this->Flash->success(__('カテゴリを追加しました。'));
				return $this->redirect(array('action' => 'index'));
			} else {
//				$this->Flash->error(__('The category could not be saved. Please, try again.'));
				$this->Flash->error(__('カテゴリの追加に失敗しました。再度、追加して下さい。'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Category->exists($id)) {
//			throw new NotFoundException(__('Invalid category'));
			throw new NotFoundException(__('無効なカテゴリです。'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Category->save($this->request->data)) {
//				$this->Flash->success(__('The category has been saved.'));
				$this->Flash->success(__('カテゴリを保存しました。'));
				return $this->redirect(array('action' => 'index'));
			} else {
//				$this->Flash->error(__('The category could not be saved. Please, try again.'));
				$this->Flash->error(__('カテゴリの保存に失敗しました。再度、編集して下さい。'));
			}
		} else {
			$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
			$this->request->data = $this->Category->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Category->id = $id;
		if (!$this->Category->exists()) {
//			throw new NotFoundException(__('Invalid category'));
			throw new NotFoundException(__('無効なカテゴリです。'));
		}
		$this->request->allowMethod('post', 'delete');
		$this->Category->delete();
		if (!$this->Category->exists()) {
//			$this->Flash->success(__('The category has been deleted.'));
			$this->Flash->success(__('カテゴリを削除しました。'));
		} else {
//			$this->Flash->error(__('The category could not be deleted. Please, try again.'));
			$this->Flash->error(__('カテゴリの削除に失敗しました。再度、削除して下さい。'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
