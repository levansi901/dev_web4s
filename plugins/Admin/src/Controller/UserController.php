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

    public function list($type = null) 
    {
        $this->js_page = '/assets/js/pages/list_user.js';
        $this->set('csrf_token', $this->request->getParam('_csrfToken'));        
        $this->set('title_for_layout', __d('admin', 'tai_khoan'));
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

        $users_table = TableRegistry::getTableLocator()->get('Users');
        $user = $users_table->newEntity($data);    


        // check unique username
        if(!empty($user->username)){
            $exist_username = $users_table->checkExistUsername(trim($user->username));           
            if($exist_username){
                $this->responseJson([MESSAGE => __d('admin', 'ten_dang_nhap_da_ton_tai_tren_he_thong')]);
            }
        }

        // check unique username
        if(!empty($user->email)){
            $exist_email = $users_table->checkExistEmail(trim($user->email));
            if($exist_email){
                $this->responseJson([MESSAGE => __d('admin', 'email_da_ton_tai_tren_he_thong')]);
            }
        }        

        // validation another in model
        if($user->hasErrors()){
            $utilities_component = $this->loadComponent('Utilities');
            $list_errors = $utilities_component->errorModel($user->getErrors());
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