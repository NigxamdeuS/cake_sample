<?php

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

return function (RouteBuilder $routes): void {
    $routes->setRouteClass(DashedRoute::class);

    $routes->scope('/', function (RouteBuilder $builder): void {
        $builder->connect('/', ['controller' => 'Login', 'action' => 'index']);
        $builder->connect('/index', ['controller' => 'Login', 'action' => 'index']);
        $builder->connect('/login', ['controller' => 'Login', 'action' => 'login']);
        $builder->connect('/logout', ['controller' => 'Login', 'action' => 'logout']);
        $builder->connect('/list', ['controller' => 'List', 'action' => 'index']);
        $builder->connect('/delete', ['controller' => 'List', 'action' => 'delete']);
        $builder->connect('/regist_input', ['controller' => 'Regist', 'action' => 'input']);
        $builder->connect('/regist_check', ['controller' => 'Regist', 'action' => 'check']);
        $builder->connect('/regist_complete', ['controller' => 'Regist', 'action' => 'complete'])->setMethods(['POST']);
        $builder->connect('/regist_complete', ['controller' => 'Regist', 'action' => 'completeView'])->setMethods(['GET']);
        $builder->connect('/update_input', ['controller' => 'Update', 'action' => 'input']);
        $builder->connect('/update_check', ['controller' => 'Update', 'action' => 'check']);
        $builder->connect('/update_complete', ['controller' => 'Update', 'action' => 'complete'])->setMethods(['POST']);
        $builder->connect('/update_complete', ['controller' => 'Update', 'action' => 'completeView'])->setMethods(['GET']);
    });
};
