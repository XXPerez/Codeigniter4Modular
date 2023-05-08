<?php

/**
 * This file contains the routes for the {moduleName} module
 *
 * @package App\Modules\{moduleName}
 */

// Check if the $routes variable is defined
if (!isset($routes)) {
    // Get an instance of the routes collection
    $routes = Config\Services::routes();
}

// Define a route group for the {moduleName} module with the namespace
$routes->group('{routeName}', ['namespace' => 'App\Modules\{moduleName}\Controllers'], function ($routes) {
    // Define a route for the index method of the {moduleName} controller
    // This will match the URL /{routeName}
    $routes->get('/', '{moduleName}::index');
});
