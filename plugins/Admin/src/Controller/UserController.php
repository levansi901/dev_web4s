<?php

namespace Admin\Controller;

use Admin\Controller\AppController;

class UserController extends AppController {

    public function initialize(): void
    {
        parent::initialize();
        $this->loadModel('Users');
    }

	public function login() {
        $this->viewBuilder()->enableAutoLayout(false);
    }

    public function list($type = null) {
        $this->js_page = '/assets/js/list_user.js';

        $this->set('csrf_token', $this->request->getParam('_csrfToken'));
        $this->render('list');
    }


    public function save(){

    }


}