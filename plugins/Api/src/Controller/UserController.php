<?php

namespace Api\Controller;

use Api\Controller\AppController;

class UserController extends AppController {

    public function login() {
        $result = [
            DATA => []
        ];
        
        $this->resSuccess($result);
    }
}