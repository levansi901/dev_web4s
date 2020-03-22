<?php

namespace Admin\Controller;

use Admin\Controller\AppController;

class UserController extends AppController {

	public function login() {

    }

    public function viewListUsers($type = null) {    	
    	if($type == JSON){

    	}
        $this->render('list');
    }


    public function viewSaveUser(){

    }


}