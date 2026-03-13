<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');

$routes->group("api", function ($routes) {
  $routes->resource('vehicle', ['controller' => '\App\Controllers\Api\VehicleApi']);
  $routes->resource('vehicles-category', ['controller' => '\App\Controllers\Api\VehiclesCategoryApi']);
  $routes->resource('variants', ['controller' => '\App\Controllers\Api\VariantsApi']);
  $routes->resource('specifications-category', ['controller' => '\App\Controllers\Api\SpecificationsCategoryApi']);
  $routes->resource('agents', ['controller' => '\App\Controllers\Api\AgentsApi']);
  $routes->resource('specifications-type', ['controller' => '\App\Controllers\Api\SpecificationsTypeApi']);
  $routes->resource('variants-specifications', ['controller' => '\App\Controllers\Api\VariantsSpecificationsApi']);
});

try {
  $db = \Config\Database::connect();
  $dynamicRoutes = $db->table('vehicles')->get()->getResultArray();

  foreach ($dynamicRoutes as $row) {
    $uri = url_title($row['vehicle_title'], '-', true);
    $routes->get($uri, "Vehicle::show/{$row['vehicle_no']}");
  }
} catch (\Throwable $e) {
  // Silently fail if DB isn't ready (e.g. during migrations)
  log_message('error', 'Dynamic routes failed: ' . $e->getMessage());
}
