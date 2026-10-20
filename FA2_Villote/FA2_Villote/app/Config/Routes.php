<?php
use CodeIgniter\Router\RouteCollection;
/** @var RouteCollection $routes */
$routes->get('/', 'AuthController::home');
$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::attempt');
$routes->post('logout', 'AuthController::logout', ['filter' => 'auth']);
$routes->group('', ['filter' => 'auth'], static function ($routes) {
    $routes->get('dashboard', 'AuthController::dashboard');
    $routes->get('customers', 'CustomersController::index');
    $routes->get('customers/new', 'CustomersController::create');
    $routes->post('customers', 'CustomersController::store');
    $routes->get('customers/(:num)/edit', 'CustomersController::edit/$1');
    $routes->post('customers/(:num)', 'CustomersController::update/$1');
    $routes->post('customers/(:num)/delete', 'CustomersController::delete/$1');
    $routes->get('users', 'UsersController::index');
    $routes->get('users/new', 'UsersController::create');
    $routes->post('users', 'UsersController::store');
    $routes->get('users/(:num)/edit', 'UsersController::edit/$1');
    $routes->post('users/(:num)', 'UsersController::update/$1');
    $routes->post('users/(:num)/delete', 'UsersController::delete/$1');
});
