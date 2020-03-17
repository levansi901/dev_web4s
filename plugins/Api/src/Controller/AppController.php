<?php

namespace Api\Controller;
use Cake\Controller\Controller;

class AppController extends Controller {
	
	public function initialize(): void{
	    parent::initialize();
	    $this->viewBuilder()->setClassName('Json');
	}

	protected function resSuccess($params = []) {
		$status = SUCCESS;
		$code = CODE_SUCCESS;
		$message = !empty($params[MESSAGE]) ? $params[MESSAGE] : '';
		$data = !empty($params[DATA]) ? $params[DATA] : [];
		if(!empty($params[PAGINATION])){
			$pagination = $params[PAGINATION];
		}
		
		$this->set(compact(STATUS, CODE, MESSAGE, PAGINATION, DATA));
		$this->set('_serialize', [STATUS, CODE, MESSAGE, PAGINATION, DATA]);
	}


	protected function resError($params = []) {
		$status = ERROR;
		$code = !empty($params[CODE]) ? $params[CODE] : CODE_SUCCESS;
		$message = !empty($params[MESSAGE]) ? $params[MESSAGE] : '';
		$data = !empty($params[DATA]) ? $params[DATA] : [];

		$this->set(compact(STATUS, CODE, MESSAGE, DATA));
		$this->set('_serialize', [STATUS, CODE, MESSAGE, DATA]);
	}
}

