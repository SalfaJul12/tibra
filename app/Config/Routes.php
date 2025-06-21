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
$routes->get('home/shopnow', 'Home::shopnow');

//Auth
$routes->get('login', 'AuthController::index');
$routes->get('register', 'AuthController::register');
$routes->get('forpas', 'AuthController::forpas');
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

// Diskon (Routes yang berhubungan dengan diskon di DiskonController)
$routes->post('diskon/store', 'DiskonController::store'); // Menyimpan diskon baru
$routes->post('diskon/update/(:num)', 'DiskonController::update/$1'); // Mengupdate diskon (dengan ID)
$routes->get('diskon/delete/(:num)', 'DiskonController::delete/$1'); // Menghapus diskon (dengan ID)

//User
$routes->post('user/update/(:num)', 'AdminController::update_user/$1');
$routes->get('user/delete/(:num)', 'AdminController::delete_user/$1');

$routes->get('profile', 'Profile::index');
$routes->post('profile/update', 'Profile::update');

//Report
$routes->get('report', 'AdminController::report');

// produk
$routes->get('/home/detail/(:num)', 'Home::detail/$1');
$routes->get('/home/shopnow/(:num)', 'Home::shopnow/$1');

// Shipping
$routes->post('/home/finishPayment', 'Home::finishPayment');
// Shipping dan History
$routes->get('shipping', 'Home::shipping'); // <== ini penting untuk menghindari 404
$routes->get('history', 'Home::history');
$routes->get('home/history', 'Home::history');

// Pembelian
$routes->post('pembelian/simpan', 'PembelianController::simpan');

//Cart
$routes->get('/cart', 'CartController::index');
$routes->post('/cart/add/', 'CartController::add/$1');
$routes->post('/cart/update/(:num)', 'CartController::update/$1');
$routes->get('/cart/delete/(:num)', 'CartController::delete/$1');

