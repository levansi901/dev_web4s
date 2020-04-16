<?php

namespace Admin\Controller;

use Cake\Controller\Controller;
use Cake\Core\Configure;
use Cake\Event\EventInterface;

static $js_page = [];

class AppController extends Controller {

	public function initialize(): void{
	    parent::initialize();
	}

	public function beforeRender(EventInterface $event) {
        $this->viewBuilder()->setClassName('Smarty');
    	if (!$this->request->is('ajax')) {
            $this->set('js_page', !empty($this->js_page) ? $this->js_page : []);
        }
	}

    protected function resSuccess($params = []) {
        $result = [
            CODE => SUCCESS,
            MESSAGE => !empty($params[MESSAGE]) ? $params[MESSAGE] : __d('admin', 'cap_nhat_thanh_cong'),
            DATA => !empty($params[DATA]) ? $params[DATA] : []
        ];        
        $this->response->type('json');
        $this->response->body(json_encode($result));
        return $this->response;
    }

    protected function resError($params = []) {
        $result = [
            CODE => ERROR,
            MESSAGE => !empty($params[MESSAGE]) ? $params[MESSAGE] : __d('admin', 'cap_nhat_khong_thanh_cong')
        ];        
        $this->response->type('json');
        $this->response->body(json_encode($result));
        return $this->response;
    }

}