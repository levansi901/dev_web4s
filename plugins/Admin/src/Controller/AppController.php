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

    protected function responseJson($params = []) {
        $code = ERROR;
        if(!empty($params[CODE]) && in_array($params[CODE], [SUCCESS, ERROR])){
            $code = $params[CODE];
        }

        $message = !empty($params[MESSAGE]) ? $params[MESSAGE] : null;
        if(empty($params[MESSAGE]) && $code == ERROR){
            $message = __d('admin', 'cap_nhat_khong_thanh_cong');
        }

        if(empty($params[MESSAGE]) && $code == SUCCESS){
            $message = __d('admin', 'cap_nhat_thanh_cong');
        }
        
        $result = [
            CODE => $code,
            MESSAGE => $message,
            DATA => !empty($params[DATA]) ? $params[DATA] : []
        ];        
        exit(json_encode($result));
    }
}