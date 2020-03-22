<?php

use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

$routes->setRouteClass(DashedRoute::class);


// router frontend
$routes->scope('/', function (RouteBuilder $builder) {
    $builder->registerMiddleware('csrf', new CsrfProtectionMiddleware([
        'httpOnly' => true,
    ]));

    $builder->applyMiddleware('csrf');

    $builder->fallbacks();
});




// router admin
$routes->scope('/' . ADMIN_PATH, function (RouteBuilder $builder) {
    $builder->registerMiddleware('csrf', new CsrfProtectionMiddleware([
        'httpOnly' => true,
    ]));    
    $builder->applyMiddleware('csrf');

    // user
    $builder->connect('/', ['plugin' => 'Admin', 'controller' => 'User', 'action' => 'login']);
    $builder->connect('/login', ['plugin' => 'Admin', 'controller' => 'User', 'action' => 'login']);
    $builder->connect('/user/list', ['plugin' => 'Admin', 'controller' => 'User', 'action' => 'listUsers']);
    $builder->connect('/user/list/:type', ['plugin' => 'Admin', 'controller' => 'User', 'action' => 'listUsers'], ['pass' => ['type']]);


    $builder->fallbacks();
});







$routes->scope('/api', function (RouteBuilder $builder) {
    $builder->registerMiddleware('csrf', new CsrfProtectionMiddleware([
        'httpOnly' => true,
    ]));
    $builder->applyMiddleware('csrf');
    $builder->fallbacks();
});