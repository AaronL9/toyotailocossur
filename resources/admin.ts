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
import AgentsCreatePage from './Pages/Admin/agents/AgentsCreatePage';
import AgentsPage from './Pages/Admin/agents/AgentsPage';
import AgentsEditPage from './Pages/Admin/agents/AgentsEditPage';
import SpecificationsTypePage from './Pages/Admin/SpecificationType/SpecificationTypePage';
import VariantsSpecificationsPage from './Pages/Admin/VariantsSpecifications/VariantsSpecificationsPage';
import VehiclesEditPage from './Pages/Admin/Vehicles/VehiclesEditPage';
import VariantsUploadPhotoPage from './Pages/Admin/Variants/VariantsUploadPhotoPage';
import InquiryPage from './Pages/Admin/inquiry/InquiryPage';

const page = document.body.dataset.page;

const routes: Record<string, () => void> = {
  'users': UsersPage,

  'vehicles': VehiclesPage,
  'vehicles-create': VehiclesCreatePage,
  'vehicles-edit': VehiclesEditPage,

  'vehicles-category': VehicleCategoryPage,
  'vehicles-category-create': VehiclesCategoryCreatePage,
  'vehicles-category-update': VehiclesCategoryUpdate,

  'variants': VariantsPage,
  'variants-create': VariantsCreatePage,
  'variants-update': VariantsUpdatePage,
  'variants-specifications': VariantsSpecificationsPage,
  'variants-upload-photo': VariantsUploadPhotoPage,

  'specifications': SpecificationsPage,

  'agents': AgentsPage,
  'agents-create': AgentsCreatePage,
  'agents-edit': AgentsEditPage,

  'specifications-type': SpecificationsTypePage,

  'inquiry': InquiryPage
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
  },
});

Alpine.store('helper', {
  formatNumber(value: any) {

    const formatterPH = new Intl.NumberFormat('en-PH', {
      style: 'currency',
      currency: 'PHP'
    });

    if (isNaN(parseFloat(value))) {
      return formatterPH.format(0);
    }

    return formatterPH.format(value);
  }
})

Alpine.start();