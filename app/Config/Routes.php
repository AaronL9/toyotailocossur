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
  $routes->resource('inquiry', ['controller' => '\App\Controllers\Api\InquiryApi']);
  $routes->resource('modules', ['controller' => '\App\Controllers\Api\ModulesApi']);
  $routes->resource('users', ['controller' => '\App\Controllers\Api\UsersApi']);
  $routes->resource('user-module', ['controller' => '\App\Controllers\Api\UserModuleApi']);
  $routes->resource('csr', ['controller' => '\App\Controllers\Api\CsrApi']);
});

$routes->get('admin/vehicles', "Admin\Vehicles::getIndex");
$routes->get('admin/vehicles/create', "Admin\Vehicles::getCreate");
$routes->get('admin/vehicles/edit/(:segment)', "Admin\Vehicles::getEdit/$1");

try {
  $db = \Config\Database::connect();
  $dynamicRoutes = $db->table('vehicles')
    ->where('vehicle_delete', 0)
    ->where('vehicle_inactive', 0)
    ->get()
    ->getResultArray();

  foreach ($dynamicRoutes as $row) {
    $uri = url_title($row['vehicle_title'], '-', true);
    $routes->get($uri, "Vehicle::show/{$row['vehicle_no']}");
    $routes->get("admin/vehicles/{$uri}", "Admin\Vehicles::getVariants/{$row['vehicle_no']}");
    $routes->get("admin/vehicles/{$uri}/variant-create", "Admin\Vehicles::variantAddForm/{$row['vehicle_no']}");
    $routes->get("admin/vehicles/{$uri}/variant-edit/(:segment)", "Admin\Vehicles::variantEditForm/$1/{$row['vehicle_no']}");
    $routes->get("admin/vehicles/{$uri}/variant/photo/(:segment)", "Admin\Variants::getPhoto/$1");
    $routes->get("admin/vehicles/{$uri}/variant/gallery/(:segment)", "Admin\Variants::getGallery/$1");
    $routes->get("admin/vehicles/{$uri}/variant/specifications/(:segment)", "Admin\Variants::getSpecifications/$1");

    $routes->post("admin/vehicles/{$uri}/variant/photo/(:segment)", "Admin\Variants::postUploadPhoto/$1");
    $routes->post("admin/vehicles/{$uri}/variant/gallery/(:segment)", "Admin\Variants::postUploadGallery/$1");

    $routes->delete("admin/vehicles/{$uri}/variant/photo/(:segment)", "Admin\Variants::deleteVariantPhoto/$1");
    $routes->delete("admin/vehicles/{$uri}/variant/gallery/(:segment)/(:segment)", "Admin\Variants::deleteGalleryPhoto/$1/$2");
  }
} catch (\Throwable $e) {
  // Silently fail if DB isn't ready (e.g. during migrations)
  log_message('error', 'Dynamic routes failed: ' . $e->getMessage());
}
