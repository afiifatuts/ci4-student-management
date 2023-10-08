<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/layout', 'Layout::index');
$routes->get('/mahasiswa', 'Mahasiswa::index');
$routes->get('/mahasiswa/ambildata', 'Mahasiswa::ambildata');
$routes->get('/mahasiswa/formtambah', 'Mahasiswa::formtambah');
$routes->post('/mahasiswa/simpandata', 'Mahasiswa::simpandata');
$routes->post('/mahasiswa/formedit', 'Mahasiswa::formedit');
$routes->post('/mahasiswa/updatedata', 'Mahasiswa::updatedata');
$routes->post('/mahasiswa/hapus', 'Mahasiswa::hapus');
