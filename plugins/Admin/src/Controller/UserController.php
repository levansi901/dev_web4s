<?php

namespace Admin\Controller;

use Admin\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Utility\Hash;
use Cake\Http\Response;
use Cake\ORM\Query;

class UserController extends AppController {

    public function initialize(): void
    {
        parent::initialize();
        // $this->loadModel('Users');
    }

	public function login() {
        $this->viewBuilder()->enableAutoLayout(false);
    }

    public function list($type = null) {


        $this->js_page = '/assets/js/pages/list_user.js';
        $this->set('csrf_token', $this->request->getParam('_csrfToken'));        
        $this->set('title_for_layout', __d('admin', 'tai_khoan'));
    }


    public function add(){
        $role_model = TableRegistry::get('Roles');
        $list_role = $role_model->find()->where(['is_delete' => 0])->select(['id', 'name'])->toList();
        $list_role = Hash::combine($list_role, '{n}.id', '{n}.name');

        $this->set('list_role', $list_role);

        $this->js_page = '/assets/js/pages/user.js';
        $this->set('title_for_layout', __d('admin', 'them_tai_khoan'));
        $this->render('update');
    }

    public function update($id = null){
        $this->set('title_for_layout', __d('admin', 'cap_nhat_tai_khoan'));
    }

    public function save($id = null){
        $this->layout = false;
        $this->autoRender = false;

        $result = [];
        $data = $this->getRequest()->getData();
        if ($this->getRequest()->is('post') && !empty($data)) {
            $question = $this->User->newEmptyEntity();
            $question = $this->User->patchEntity($question, $data);

            $save = $this->User->save($question);
            if(!empty($save['User']['id'])){

            }else{
                
            }
        }

        $this->responseJson($result);
    }
}