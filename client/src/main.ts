import 'preline';
import './style.css';

import Alpine from 'alpinejs';
window.Alpine = Alpine;

import Swal from 'sweetalert2';

import Showroom from './Pages/showroom';
import VehiclePage from './Pages/vehicle';


const page = document.documentElement.dataset.page;

const routes: Record<string, () => void> = {
  'showroom': Showroom,
  'vehicle': VehiclePage,
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

Alpine.start();
