<?php

namespace Admin\Controller;

use Cake\Controller\Controller;
use Cake\Core\Configure;
use Cake\Event\EventInterface;

static $js_page = [];

class AppController extends Controller {

	public function initialize(): void{
	    parent::initialize();	   
	    $this->loadComponent(
            'RequestHandler', ['enableBeforeRedirect' => false]
        );
	}

	public function beforeRender(EventInterface $event) {
    	parent::beforeRender($event);

    	if (!$this->request->is('ajax')) {
            $this->set('js_page', $this->js_page);
        }

    	$this->viewBuilder()->setClassName('Smarty');
	}

	public function responseJson($result = []){
        $this->response->type('json');
        $this->response->body(json_encode($result));
        return $this->response;
    }

}