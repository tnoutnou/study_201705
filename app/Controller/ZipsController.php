<?php
App::uses('AppController', 'Controller');
/**
 * Zips Controller
 *
 * @property Zip $Zip
 * @property PaginatorComponent $Paginator
 */
class ZipsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Zip->recursive = 0;
		$this->set('zips', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Zip->exists($id)) {
			throw new NotFoundException(__('Invalid zip'));
		}
		$options = array('conditions' => array('Zip.' . $this->Zip->primaryKey => $id));
		$this->set('zip', $this->Zip->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Zip->create();
			if ($this->Zip->save($this->request->data)) {
				$this->Flash->success(__('The zip has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The zip could not be saved. Please, try again.'));
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
		if (!$this->Zip->exists($id)) {
			throw new NotFoundException(__('Invalid zip'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Zip->save($this->request->data)) {
				$this->Flash->success(__('The zip has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The zip could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Zip.' . $this->Zip->primaryKey => $id));
			$this->request->data = $this->Zip->find('first', $options);
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
		$this->Zip->id = $id;
		if (!$this->Zip->exists()) {
			throw new NotFoundException(__('Invalid zip'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Zip->delete()) {
			$this->Flash->success(__('The zip has been deleted.'));
		} else {
			$this->Flash->error(__('The zip could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	
	//
//	public function ziplist($zipcode = null) {
	public function zipList() {
//		$this->log('LOG!!!22!!!');
		// CakePHP 2.1以上
		$this->Auth->allow();

//		debug(str_replace('-','', $_GET['zipcode']));
		// ビューの使用無を設定
		$this->autoRender = false;

		// ContentTypeをJSONにする
		$this->response->type('json');

		// Ajax以外の通信の場合
		if(!$this->request->is('ajax')) {
			throw new BadRequestException();
		}
		
		// zipcode を受け取る 
		$options = array('conditions' => array('Zip.zip_code like' => str_replace('-','', $_GET['zipcode']) . '%'));
//		$result = $this->Zip->find('first', $options);
		$result = $this->Zip->find('all',$options);
		

//		$this->log('LOG!1');
//		$this->log($result);

		$rst = array();
		
		foreach ($result as $rs){

//			$this->log('LOG!2');
//			$this->log($rs);
	
//			$rst[] = 
//				$rs['Zip']['ken_name_kan'] . $rs['Zip']['city_name_kan'] . $rs['Zip']['town_name_kan']
//				;

			$rst[] = array(
				"zip_code"  => $rs['Zip']['zip_code'],
				"ken_name_kan"  => $rs['Zip']['ken_name_kan'],
				"city_name_kan" => $rs['Zip']['city_name_kan'],
				"town_name_kan" => $rs['Zip']['town_name_kan']
				);
	
//			$rst = $rst + array(
//				"ken_name_kan"  => $rs['ken_name_kan'],
//				"city_name_kan" => $rs['city_name_kan'],
//				"town_name_kan" => $rs['town_name_kan']
//			);
				
//			$rst = array(
//				$rs['Zip']['ken_name_kan'] . $rs['Zip']['city_name_kan'] . $rs['Zip']['town_name_kan']
//				);

//			$rst = array(
//				"ken_name_kan"  => $result['Zip']['ken_name_kan'],
//				"city_name_kan" => $result['Zip']['city_name_kan'],
//				"town_name_kan" => $result['Zip']['town_name_kan']
//			);
		
		}

//		$this->log('LOG!3');
//		$this->log($rst);
		
		
//		debug($rst);
//		return;
				
		$status = !empty($result);
		if(!$status) {
//			throw new NotFoundException();
			$error = array(
				'message' => 'データがありません',
				'code' => 404
				);
		}
		
		// json_encodeを使用してJSON形式で返却
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($rst);

		
	}

	public function beforeFilter() {
		parent::beforeFilter();
				
		// CakePHP 2.1以上
		$this->Auth->allow();
	}

	
}
