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
    	$result = $this->Users->getListUsers();

        exit(json_encode($result));
        // $this->set([
        //     'users' => $users,
        //     '_serialize' => ['users']
        // ]);        
    }
}