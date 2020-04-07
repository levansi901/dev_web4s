<?php

namespace Admin\Controller;

use Admin\Controller\AppController;

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

        $this->set('title_for_layout', __d('admin', 'them_tai_khoan'));
        $this->render('update');
    }

    public function update($id = null){
        $this->set('title_for_layout', __d('admin', 'cap_nhat_tai_khoan'));
    }
}