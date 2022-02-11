<?php
if(!isset($routes))
{ 
    $routes = \Config\Services::routes(true);
}

$routes->group('utils', function($routes) {
    $routes->add('setlang/(:segment)/(:segment)', 'Utils\Controllers\Language::setLang/$1/$2');
    $routes->add('setlang/(:segment)', 'Utils\Controllers\Language::setLang/$1');
    $routes->add('setlang', 'Utils\Controllers\Language::setLang');
});
