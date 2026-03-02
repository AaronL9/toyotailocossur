<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');

$routes->group("api", function ($routes) {
  $routes->resource('vehicle', ['controller' => '\App\Controllers\Api\Vehicle']);
  $routes->resource('vehicles-category', ['controller' => '\App\Controllers\Api\VehiclesCategoryApi']);
  $routes->resource('variants', ['controller' => '\App\Controllers\Api\VariantsApi']);
});
