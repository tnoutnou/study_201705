<?php
App::uses('AppController', 'Controller');
/**
 * Groups Controller
 *
 * @property Group $Group
 * @property PaginatorComponent $Paginator
 */
class GroupsController extends AppController {

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
		$this->Group->recursive = 0;
		$this->set('groups', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Group->exists($id)) {
//			throw new NotFoundException(__('Invalid group'));
			throw new NotFoundException(__('無効なグループです。'));
		}
		$options = array('conditions' => array('Group.' . $this->Group->primaryKey => $id));
		$this->set('group', $this->Group->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Group->create();
			if ($this->Group->save($this->request->data)) {
//				$this->Flash->success(__('The group has been saved.'));
				$this->Flash->success(__('グループを登録しました。'));
				return $this->redirect(array('action' => 'index'));
			} else {
//				$this->Flash->error(__('The group could not be saved. Please, try again.'));
				$this->Flash->error(__('グループの登録に失敗しました。再度、登録して下さい。'));
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
		if (!$this->Group->exists($id)) {
//			throw new NotFoundException(__('Invalid group'));
			throw new NotFoundException(__('無効なグループです。'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Group->save($this->request->data)) {
//				$this->Flash->success(__('The group has been saved.'));
				$this->Flash->success(__('グループを保存しました。'));
				return $this->redirect(array('action' => 'index'));
			} else {
//				$this->Flash->error(__('The group could not be saved. Please, try again.'));
				$this->Flash->error(__('グループの保存に失敗しました。再度、編集して下さい。'));
			}
		} else {
			$options = array('conditions' => array('Group.' . $this->Group->primaryKey => $id));
			$this->request->data = $this->Group->find('first', $options);
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
		$this->Group->id = $id;
		if (!$this->Group->exists()) {
//			throw new NotFoundException(__('Invalid group'));
			throw new NotFoundException(__('無効なグループです。'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Group->delete()) {
//			$this->Flash->success(__('The group has been deleted.'));
			$this->Flash->success(__('グループを削除しました。'));
		} else {
//			$this->Flash->error(__('The group could not be deleted. Please, try again.'));
			$this->Flash->error(__('グループの削除に失敗しました。再度、削除して下さい。'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function beforeFilter() {
		parent::beforeFilter();

		// CakePHP 2.1以上
		$this->Auth->allow();
	}

		
	
}
