<?php

namespace Admin\Controller;

use Admin\Controller\AppController;

class UserController extends AppController {

	public function login() {

    }

    public function viewListUsers($type = null) {    	

    	$this->set('users', []);
        $this->render('list');
    }

    public function listUsers(){
    	if($type == JSON){

    	}
        $this->render('list');
    }


    public function viewSaveUser(){

    }


}