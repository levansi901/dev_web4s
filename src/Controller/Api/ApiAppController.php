<?php
declare(strict_types=1);

namespace App\Controller\Api;
use Cake\Controller\Controller;

class ApiAppController extends Controller {
	
	public function initialize(): void{
	    parent::initialize();
	    $this->viewBuilder()->setClassName('Json');
	}

	// protected function resSuccess($params = []) {
	// 	$status = SUCCESS;
	// 	$code = CODE_SUCCESS;
	// 	$message = !empty($params[MESSAGE]) ? $params[MESSAGE] : '';
	// 	$data = !empty($params[DATA]) ? $params[DATA] : [];
	// 	if(!empty($params[PAGINATION])){
	// 		$pagination = $params[PAGINATION];
	// 	}
		
	// 	$this->set(compact(STATUS, CODE, MESSAGE, PAGINATION, DATA));
	// 	$this->set('_serialize', [STATUS, CODE, MESSAGE, PAGINATION, DATA]);
	// }


	// protected function resError($params = []) {
	// 	$status = ERROR;
	// 	$code = !empty($params[CODE]) ? $params[CODE] : CODE_SUCCESS;
	// 	$message = !empty($params[MESSAGE]) ? $params[MESSAGE] : '';
	// 	$data = !empty($params[DATA]) ? $params[DATA] : [];

	// 	$this->set(compact(STATUS, CODE, MESSAGE, DATA));
	// 	$this->set('_serialize', [STATUS, CODE, MESSAGE, DATA]);
	// }
}

