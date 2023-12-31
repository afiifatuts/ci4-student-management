<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Layout::index');
$routes->get('/layout', 'Layout::index',['filter'=>'ceklogin']);
$routes->get('/layout/(:any)', 'Layout::$1',['filter'=>'ceklogin']);


$routes->get('/login', 'Login::index');
$routes->post('/login/cekuser', 'Login::cekuser');
$routes->get('/login/keluar', 'Login::keluar');
//melindungi route
$routes->get('/mahasiswa', 'Mahasiswa::index',['filter'=>'ceklogin']);
$routes->get('/mahasiswa/(:any)', 'Mahasiswa::$1',['filter'=>'ceklogin']);
$routes->get('/mahasiswa/ambildata', 'Mahasiswa::ambildata');
$routes->get('/mahasiswa/formtambah', 'Mahasiswa::formtambah');
$routes->post('/mahasiswa/simpandata', 'Mahasiswa::simpandata');
$routes->post('/mahasiswa/formedit', 'Mahasiswa::formedit');
$routes->post('/mahasiswa/updatedata', 'Mahasiswa::updatedata');
$routes->post('/mahasiswa/hapus', 'Mahasiswa::hapus');
$routes->get('/mahasiswa/formtambahbanyak', 'Mahasiswa::formtambahbanyak');
$routes->post('/mahasiswa/simpandatabanyak', 'Mahasiswa::simpandatabanyak');
$routes->post('/mahasiswa/hapusbanyak', 'Mahasiswa::hapusbanyak');
$routes->post('/mahasiswa/listdata', 'Mahasiswa::listdata');
$routes->post('/mahasiswa/formupload', 'Mahasiswa::formupload');
$routes->post('/mahasiswa/doupload', 'Mahasiswa::doupload');
// $routes->get('/mahasiswa/hash', 'Mahasiswa::hash');
// $routes->post('/mahasiswa/doupload', 'Mahasiswa::doupload');
