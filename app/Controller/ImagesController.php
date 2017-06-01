<?php
App::uses('AppController', 'Controller');
/**
 * Images Controller
 *
 * @property Image $Image
 * @property PaginatorComponent $Paginator
 */
class ImagesController extends AppController {

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
		$this->Image->recursive = 0;
		$this->set('images', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Image->exists($id)) {
//			throw new NotFoundException(__('Invalid image'));
			throw new NotFoundException(__('無効なイメージです'));
		}
		$options = array('conditions' => array('Image.' . $this->Image->primaryKey => $id));
		$this->set('image', $this->Image->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Image->create();
			if ($this->Image->save($this->request->data)) {
//				$this->Flash->success(__('The image has been saved.'));
				$this->Flash->success(__('イメージを追加しました。'));
				return $this->redirect(array('action' => 'index'));
			} else {
//				$this->Flash->error(__('The image could not be saved. Please, try again.'));
				$this->Flash->error(__('イメージの保存に失敗しました。再度、追加して下さい。'));
			}
		}
		$posts = $this->Image->Post->find('list');
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
		if (!$this->Image->exists($id)) {
//			throw new NotFoundException(__('Invalid image'));
			throw new NotFoundException(__('無効なイメージです'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Image->save($this->request->data)) {
//				$this->Flash->success(__('The image has been saved.'));
				$this->Flash->success(__('イメージを保存しました。'));
				return $this->redirect(array('action' => 'index'));
			} else {
//				$this->Flash->error(__('The image could not be saved. Please, try again.'));
				$this->Flash->error(__('イメージの保存に失敗しました。再度、編集して下さい。'));
			}
		} else {
			$options = array('conditions' => array('Image.' . $this->Image->primaryKey => $id));
			$this->request->data = $this->Image->find('first', $options);
		}
		$posts = $this->Image->Post->find('list');
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
		$this->Image->id = $id;
		if (!$this->Image->exists()) {
//			throw new NotFoundException(__('Invalid image'));
			throw new NotFoundException(__('無効なイメージです'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Image->delete()) {
//			$this->Flash->success(__('The image has been deleted.'));
			$this->Flash->success(__('イメージを削除しました。'));
		} else {
//			$this->Flash->error(__('The image could not be deleted. Please, try again.'));
			$this->Flash->error(__('イメージの削除に失敗しました。再度、削除して下さい。'));
		}
//		return $this->redirect(array('action' => 'index'));
//		return $this->redirect(array('controller' => 'posts', 'action' => 'index'));
		return $this->redirect($this->request->referer());
	}
}
