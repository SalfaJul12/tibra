<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('kategori', 'Home::kategori');
$routes->get('detail', 'Home::detail');
$routes->get('about', 'Home::about');

$routes->get('login', 'AuthController::index');
$routes->get('register', 'AuthController::register');
$routes->get('kanjut', 'AuthController::forpas');
$routes->get('change', 'AuthController::changepass');

$routes->get('dashboard', 'AdminController::index');
$routes->get('produk', 'AdminController::produk');
$routes->get('diskon', 'AdminController::diskon');
$routes->get('user', 'AdminController::user');