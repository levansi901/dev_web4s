<?php

namespace Admin\Controller;

use Admin\Controller\AppController;

class UserController extends AppController {

     public function initialize(): void
    {
        parent::initialize();
        $this->loadModel('Users');
    }

	public function viewLogin() {

    }

    public function viewListUsers($type = null) {
        $this->render('list');
    }


    public function viewSaveUser(){

    }


}