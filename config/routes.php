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
    $builder->connect('/user/list', ['plugin' => 'Admin', 'controller' => 'User', 'action' => 'viewListUsers']);
    $builder->connect('/user/list/:type', ['plugin' => 'Admin', 'controller' => 'User', 'action' => 'viewListUsers'], ['pass' => ['type']]);


    $builder->fallbacks();
});


