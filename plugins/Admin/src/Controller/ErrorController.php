<?php

namespace Admin\Controller;

use Admin\Controller\AppController;

class ErrorController extends AppController {

    public function initialize(): void
    {
        parent::initialize();
    }

	public function beforeRender(Event $event)
    {
        parent::beforeRender($event);

        $this->viewBuilder()->setTemplatePath('Error');
    }


}