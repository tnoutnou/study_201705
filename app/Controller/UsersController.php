<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Flash','Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
//			throw new NotFoundException(__('Invalid user'));
			throw new NotFoundException(__('無効なユーザです'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
//		$this->log($this->User->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
//				$this->Flash->success(__('The user has been saved.'));
				$this->Flash->success(__('ユーザ情報が登録されました。'));
				return $this->redirect(array('action' => 'index'));
			} else {
//				$this->Flash->error(__('The user could not be saved. Please, try again.'));
				$this->Flash->error(__('保存できませんでした。再度、追加して下さい。'));
			}
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
//			throw new NotFoundException(__('Invalid user'));
			throw new NotFoundException(__('無効なユーザです'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
//				$this->Flash->success(__('The user has been saved.'));
				$this->Flash->success(__('ユーザ情報を保存しました。'));
				return $this->redirect(array('action' => 'index'));
			} else {
//				$this->Flash->error(__('The user could not be saved. Please, try again.'));
				$this->Flash->error(__('保存できませんでした。再度、編集して下さい。'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
//			$this->log($this->request->data);
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
//			throw new NotFoundException(__('Invalid user'));
			throw new NotFoundException(__('無効なユーザです'));
		}
		$this->request->allowMethod('post', 'delete');

		$this->User->delete();
		if (!$this->User->exists()) {
//			$this->Flash->success(__('The user has been deleted.'));
			$this->Flash->success(__('該当ユーザを削除しました。'));
		} else {
//			$this->Flash->error(__('The user could not be deleted. Please, try again.'));
			$this->Flash->error(__('削除できませんでした。再度、削除して下さい。'));
		}
		return $this->redirect(array('action' => 'index'));
	}


	public function login() {
		

		if ($this->Session->read('Auth.User')) {
//			$this->Session->setFlash('You are logged in!');
//			$this->Session->setFlash('ログイン済みです。', 'error');
			$this->Flash->default('ログイン済みです。');
			$this->redirect('/posts/index', null, false);
		}
		
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->Session->write('login_user', $this->request->data['User']['username']);
				//管理者の判断
				if ($this->checkAdmin($this->request->data['User']['username'])){
					$this->Session->write('admin_flg', '1');
				} else {
					$this->Session->write('admin_flg', '2');
				}
				
				return $this->redirect($this->Auth->redirect());

			}
//			$this->Session->setFlash(__('Your username or password was incorrect.'));
			$this->Session->setFlash(__('ユーザ名かパスワードが間違っています。', 'error'));
		}
	}

	public function logout() {
//		$this->Session->setFlash('Good-Bye');
		$this->Session->setFlash('ログアウトしました。');
		// セッション情報を全削除
		$this->Session->destroy();
		$this->redirect($this->Auth->logout());
	 }	
	
	public function beforeFilter() {
		parent::beforeFilter();
				
		// CakePHP 2.1以上
		$this->Auth->allow();
	}

	/*
	public function initDB() {
		$group = $this->User->Group;
		//管理者グループには全てを許可する
		$group->id = 1;
		$this->Acl->allow($group, 'controllers');

		//マネージャグループには posts と widgets に対するアクセスを許可する
		$group->id = 2;
		$this->Acl->deny($group, 'controllers');
		$this->Acl->allow($group, 'controllers/Posts');
		$this->Acl->allow($group, 'controllers/Widgets');

		//ユーザグループには posts と widgets に対する追加と編集を許可する
		$group->id = 3;
		$this->Acl->deny($group, 'controllers');
		$this->Acl->allow($group, 'controllers/Posts/add');
		$this->Acl->allow($group, 'controllers/Posts/edit');
		$this->Acl->allow($group, 'controllers/Widgets/add');
		$this->Acl->allow($group, 'controllers/Widgets/edit');
		//馬鹿げた「ビューが見つからない」というエラーメッセージを表示させないために exit を追加します
		echo "all done";
		exit;
	}
	*/

	public function changePassword($id = null) {
		if (!$this->User->exists($id)) {
//			throw new NotFoundException(__('Invalid user'));
			throw new NotFoundException(__('無効なユーザです'));
		}
		if ($this->request->is(array('post', 'put'))) {
//			$this->log($this->request->data);
			if ($this->User->save($this->request->data)) {
//				$this->Flash->success(__('The user has been saved.'));
				$this->Flash->success(__('パスワードを変更しました。'));
				return $this->redirect(array('action' => 'index'));
			} else {
//				$this->Flash->error(__('The user could not be saved. Please, try again.'));
				$this->Flash->error(__('パスワードを変更できませんでした。再度、変更して下さい。'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
//			$this->request->data = $this->User->find('first', $options);
			$users = $this->User->find('first', $options);

			$users['User']['olddbpassword'] = $users['User']['password'];

//			$this->log('2222');
//			$this->log($users);
			
			$this->request->data = $users;
		}
		
	}

	// 管理者かを確認する
	public function checkAdmin($username = null) {
		$options = array('conditions' => array('User.username' => $username, 'User.delete_flg' => '0'));
		$users = $this->User->find('first', $options);
//		$this->log($users);
//		$this->log($users['Group']['name']);
		
		// グループ名が「administrators」なら管理者と判断する
		if($users['Group']['name'] == 'administrators') {
			return true;
		}
		else {
			return false;
		}
		
		
	}

	
}
