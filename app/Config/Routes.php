<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('download/(:alpha)', 'Home::download');

$routes->get('upload/', 'UploadController::index');
$routes->post('upload/', 'UploadController::upload');
