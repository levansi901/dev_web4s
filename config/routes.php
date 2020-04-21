<?php

use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;


$routes->setRouteClass(DashedRoute::class);


// router frontend
$routes->scope('/', function (RouteBuilder $builder) {
    $builder->registerMiddleware('csrf', new CsrfProtectionMiddleware([
        'httpOnly' => true,
    ]));
    $builder->applyMiddleware('csrf');

    $builder->connect('/', ['controller' => 'Page', 'action' => 'index']);

    // api
    Router::prefix('api', function ($routes) {
        $routes->connect('/user/list', ['controller' => 'User', 'action' => 'listUsers']);        
        $routes->fallbacks(DashedRoute::class);
    });

    $builder->fallbacks();
});




// router admin
$routes->scope(ADMIN_PATH, function (RouteBuilder $builder) {
    $builder->registerMiddleware('csrf', new CsrfProtectionMiddleware([
        'httpOnly' => true,
    ]));    
    $builder->applyMiddleware('csrf');

    // user
    $builder->connect('/', ['plugin' => 'Admin', 'controller' => 'User', 'action' => 'login']);
    $builder->connect('/login', ['plugin' => 'Admin', 'controller' => 'User', 'action' => 'login']);

    $builder->connect('/user', ['plugin' => 'Admin', 'controller' => 'User', 'action' => 'list']);
    $builder->connect('/user/list', ['plugin' => 'Admin', 'controller' => 'User', 'action' => 'list']);
    $builder->connect('/user/list/json', ['plugin' => 'Admin', 'controller' => 'User', 'action' => 'listJson']);
    $builder->connect('/user/add', ['plugin' => 'Admin', 'controller' => 'User', 'action' => 'add']);
    $builder->connect('/user/update/:id', ['plugin' => 'Admin', 'controller' => 'User', 'action' => 'update'], ['pass' => ['id'], 'id' => '[0-9]+']);
    $builder->connect('/user/save', ['plugin' => 'Admin', 'controller' => 'User', 'action' => 'save']);

    $builder->fallbacks();
});


