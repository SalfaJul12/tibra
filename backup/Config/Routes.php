<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//Customer
$routes->get('/', 'Home::index');
$routes->get('kategori', 'Home::kategori');
$routes->get('detail', 'Home::detail');
$routes->get('about', 'Home::about');
$routes->get('shopnow', 'Home::shopnow');

//Auth
$routes->get('login', 'AuthController::index');
$routes->get('register', 'AuthController::register');
$routes->get('kanjut', 'AuthController::forpas');
$routes->get('change', 'AuthController::changepass');
//Login System
$routes->get('/register', 'AuthController::register');
$routes->post('/register/save', 'AuthController::saveRegister');
$routes->post('/check', 'AuthController::doLogin');

$routes->get('/logout', 'AuthController::logout');

//Admin
$routes->get('dashboard', 'AdminController::index');
$routes->get('produk', 'AdminController::produk');
$routes->get('diskon', 'AdminController::diskon');
$routes->get('user', 'AdminController::user');
$routes->post('store', 'AdminController::store');
$routes->post('update/(:num)', 'AdminController::update/$1');
$routes->get('delete/(:num)', 'AdminController::delete/$1');