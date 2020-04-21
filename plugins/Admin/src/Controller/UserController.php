<?php

namespace Admin\Controller;

use Admin\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Utility\Hash;
use Cake\Http\Response;
use Cake\ORM\Query;
use Cake\Datasource\ConnectionManager;
use Cake\Core\Exception\Exception;

class UserController extends AppController {

    public function initialize(): void
    {
        parent::initialize();
        // $this->loadModel('Users');
    }

	public function login() {
        $this->viewBuilder()->enableAutoLayout(false);
    }

    public function list() 
    {        
        $this->js_page = '/assets/js/pages/list_user.js';
        $this->set('csrf_token', $this->request->getParam('_csrfToken'));        
        $this->set('title_for_layout', __d('admin', 'tai_khoan'));
    }

    public function listJson(){
        $table = TableRegistry::getTableLocator()->get('Users');
        $utilities = $this->loadComponent('Utilities');

        $users = [];        
        try {
            $users = $this->paginate($table->queryListUsers(), [
                'limit' => 5,
                'order' => [
                    'id' => 'desc'
                ]
            ])->toArray();
        } catch (NotFoundException $e) {

        }

        $pagination_info = !empty($this->request->getAttribute('paging')['Users']) ? $this->request->getAttribute('paging')['Users'] : [];
        $pagination_info = $utilities->formatPaginationInfo($pagination_info);

        $this->responseJson([
            CODE => SUCCESS,
            MESSAGE => __d('admin', 'xu_ly_du_lieu_thanh_cong'),
            DATA => $users, 
            META => $pagination_info
        ]);
    }


    public function add()
    {
        $role_model = TableRegistry::get('Roles');
        $list_role = $role_model->find()->where(['is_delete' => 0])->select(['id', 'name'])->toList();
        $list_role = Hash::combine($list_role, '{n}.id', '{n}.name');

        $this->set('list_role', $list_role);

        $this->js_page = '/assets/js/pages/user.js';
        $this->set('title_for_layout', __d('admin', 'them_tai_khoan'));
        $this->render('update');
    }

    public function update($id = null)
    {
        $this->set('title_for_layout', __d('admin', 'cap_nhat_tai_khoan'));
    }

    public function save($id = null)
    {        
        $this->layout = false;
        $this->autoRender = false;

        $data = $this->getRequest()->getData();

        if (!$this->getRequest()->is('post')) {
            $this->responseJson([MESSAGE => __d('admin', 'phuong_thuc_khong_hop_le')]);
        }

        if (empty($data)) {
            $this->responseJson([MESSAGE => __d('admin', 'du_lieu_khong_hop_le')]);
        }

        $utilities = $this->loadComponent('Utilities');
        $users_table = TableRegistry::getTableLocator()->get('Users');

        // validate data        
        if(!empty($data['username'])){
            $data['username'] = trim($data['username']);
            $exist_username = $users_table->checkExistUsername($data['username']);           
            if($exist_username){
                $this->responseJson([MESSAGE => __d('admin', 'ten_dang_nhap_da_ton_tai_tren_he_thong')]);
            }
        }

        if(!empty($data['email'])){
            $data['email'] = trim($data['email']);
            $exist_email = $users_table->checkExistEmail(trim($data['email']));
            if($exist_email){
                $this->responseJson([MESSAGE => __d('admin', 'email_da_ton_tai_tren_he_thong')]);
            }
        }

        if(!empty($data['birthday']) ){
            if(!$utilities->isStringDate($data['birthday'])){
                $this->responseJson([MESSAGE => __d('admin', 'ngay_sinh') . ' - ' . __d('admin', 'chua_dung_dinh_dang_ngay_thang')]);
            }

            $data['birthday'] = $utilities->stringDateToInt(trim($data['birthday']));
        }


        // merge data with entity        
        $user = $users_table->newEntity($data);

        // validation another in model
        if($user->hasErrors()){
            $list_errors = $utilities->errorModel($user->getErrors());
            $this->responseJson([
                MESSAGE => !empty($list_errors[0]) ? $list_errors[0] : null,
                DATA => $list_errors
            ]);             
        }
        
        try{
            $save = $users_table->save($user);    
            if (empty($save->id)){
                throw new Exception();
            }

            $this->responseJson([CODE => SUCCESS, DATA => ['id' => $save->id]]);

        }catch (Exception $e) {
            $this->responseJson([MESSAGE => $e->getMessage()]);  
        }
            
        
    }
}