<?php
declare(strict_types=1);

namespace App\Controller\Api;

use Api\Controller\AppController;
use Cake\Http\Exception\NotFoundException;
use Cake\Http\Response;
use Cake\ORM\Query;


class UserController extends ApiAppController {

    public function initialize(): void
    {
        parent::initialize();

        $this->loadModel('Users');

    }

    public function listUsers(){
    	$users = $this->Users->getListUsers();
        
       	$this->set(compact('users'));
		$this->set('_serialize', ['users']);
    }
}