<?php

namespace Admin\Controller;

use Cake\Controller\Controller;
use Cake\Event\EventInterface;

class AppController extends Controller {

	public function initialize(): void{
	    parent::initialize();	   
	}

	public function beforeRender(EventInterface $event) {
    	parent::beforeRender($event);
    	$this->viewBuilder()->setClassName('Smarty');
	}
}