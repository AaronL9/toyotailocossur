import 'preline';

import './admin.css'
import '@fortawesome/fontawesome-free/css/all.css';

import Alpine from 'alpinejs';
window.Alpine = Alpine;

import UsersPage from './Pages/Admin/UsersPage';
import VehiclesPage from './Pages/Admin/Vehicles/VehiclesPage';
import VehiclesCreatePage from './Pages/Admin/Vehicles/VehiclesCreatePage';
import VehicleCategoryPage from './Pages/Admin/Category/VehicleCategoryPage';
import VehiclesCategoryCreatePage from './Pages/Admin/Category/VehiclesCategoryCreatePage';

const path = location.pathname;

const routes: Record<string, () => void> = {
  'users': UsersPage,

  '/admin/vehicles': VehiclesPage,
  '/admin/vehicles/create': VehiclesCreatePage,

  '/admin/vehicles-category': VehicleCategoryPage,
  '/admin/vehicles-category/create': VehiclesCategoryCreatePage
};

if (path && routes[path]) {
  routes[path]();
  Alpine.start();
}
