<?php
use Cake\Routing\Route\DashedRoute;
use Cake\Routing\Router;

Router::plugin(
    'Admin',
    ['path' => '/123'],
    function ($routes) {
        $routes->get('/123', ['controller' => 'User']);
        $routes->get('/123', ['controller' => 'User', 'action' => 'login']);
    }
);