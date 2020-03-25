<?php

namespace Admin\Controller;

use Cake\Controller\Controller;
use Cake\Event\EventInterface;

class AppController extends Controller {

	public function initialize(): void{
	    parent::initialize();	   
	    // $this->loadComponent('Csrf');
	}

	public function beforeRender(EventInterface $event) {
    	parent::beforeRender($event);
    	$this->viewBuilder()->setClassName('Smarty');

    	// $token = $this->request->getParam('_csrfToken');
    	// debug($token);
	}
}