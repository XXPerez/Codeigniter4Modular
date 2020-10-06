<?php
namespace Users\Config;

// Create a new instance of our RouteCollection class.
$routes = \Config\Services::routes();

$routes->add('login', 'Users\Controllers\Users::login', ['filter' => 'noauth']);
$routes->add('logout', 'Users\Controllers\Users::logout', ['filter' => 'auth']);
$routes->add('register', 'Users\Controllers\Users::register', ['filter' => 'noauth']);
$routes->add('profile', 'Users\Controllers\Users::profile', ['filter' => 'auth']);

$routes->group('users', function($routes) {
    $routes->add('login', 'Users\Controllers\Users::login');
    $routes->add('register', 'Users\Controllers\Users::register');
});
