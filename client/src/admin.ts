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
import VehiclesCategoryUpdate from './Pages/Admin/Category/VehicleCategoryUpdatePage';
import VariantsPage from './Pages/Admin/Variants/VariantsPage';
import VariantsCreatePage from './Pages/Admin/Variants/VariantsCreatePage';
import VariantsUpdatePage from './Pages/Admin/Variants/VariantsUpdatePage';
import SpecificationsPage from './Pages/Admin/Specifications/SpecificationsPage';
import Swal from 'sweetalert2';


const page = document.body.dataset.page;

const routes: Record<string, () => void> = {
  'users': UsersPage,

  'vehicles': VehiclesPage,
  'vehicles-create': VehiclesCreatePage,

  'vehicles-category': VehicleCategoryPage,
  'vehicles-category-create': VehiclesCategoryCreatePage,
  'vehicles-category-update': VehiclesCategoryUpdate,

  'variants': VariantsPage,
  'variants-create': VariantsCreatePage,
  'variants-update': VariantsUpdatePage,

  'specifications': SpecificationsPage
};

if (page && routes[page]) {
  routes[page]();
}

Alpine.store('Swal', {
  close() {
    Swal.close();
  },

  clickConfirm() {
    Swal.clickConfirm();
  }
});

Alpine.start();