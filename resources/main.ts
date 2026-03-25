import 'preline';
import './style.css';

import Alpine from 'alpinejs';
window.Alpine = Alpine;

import Swal from 'sweetalert2';

import VehiclePage from './Pages/vehicle';
import Contact from './Pages/Contact';
import Schedule from './Pages/schedule';
import DataPrivacyPage from './Pages/DataPrivacy';


const page = document.documentElement.dataset.page;

const routes: Record<string, () => void> = {
  'vehicle': VehiclePage,
  'contact': Contact,
  'schedule': Schedule
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

DataPrivacyPage();

Alpine.start();
