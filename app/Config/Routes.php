<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index', ['filter' => 'login']);


$routes->get('login', 'Login::index');


//login
$routes->post('proses_login', 'Login::login');
$routes->get('logout', 'Login::logout');

//dashboard
$routes->get('dashboard', 'Home::index2', ['filter' => 'login']);

$routes->get('registrasi', 'Login::index_register');
$routes->post('register/user', 'Login::insert_register');

//product
$routes->get('product', 'Product::index', ['filter' => 'login']);
$routes->get('product/detail/(:num)', 'Product::detail/$1', ['filter' => 'login']);
$routes->post('product/addKomentar', 'Product::addKomentar', ['filter' => 'login']);
$routes->post('product/deleteKomentar/(:num)', 'Product::deleteKomentar/$1', ['filter' => 'login']);
$routes->post('product/addReply', 'Product::addReply', ['filter' => 'login']);
$routes->post('product/deleteReply/(:num)', 'Product::deleteReply/$1', ['filter' => 'login']);
