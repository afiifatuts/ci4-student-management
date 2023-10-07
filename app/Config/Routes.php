<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/layout', 'Layout::index');
$routes->get('/mahasiswa', 'Mahasiswa::index');