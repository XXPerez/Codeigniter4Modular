<?php
namespace Dashboard\Config;

// Create a new instance of our RouteCollection class.
$routes = \Config\Services::routes();

$routes->add('dashboard', 'Dashboard\Controllers\Dashboard', ['filter' => 'auth']);
