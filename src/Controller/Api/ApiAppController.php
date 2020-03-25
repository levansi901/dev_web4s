<?php
declare(strict_types=1);

namespace App\Controller\Api;
use Cake\Controller\Controller;

class ApiAppController extends Controller {
	
	public function initialize(): void{
		$this->layout = false;
		$this->autoRender = false;
	    // $this->viewBuilder()->setClassName('Json');	    
	}
}

