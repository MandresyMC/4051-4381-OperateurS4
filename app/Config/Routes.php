<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'HomeController::index');
$routes->post('/login', 'LoginController::verify');


$routes->get('/client/operation', 'OperationController::index');
