import 'preline';
import './admin.css'
import '@fortawesome/fontawesome-free/css/all.css';

import Alpine from 'alpinejs';
window.Alpine = Alpine;

import UsersPage from './pages/admin/UsersPage';
import VehiclesPage from './pages/admin/VehiclesPage';

const page = document.documentElement.dataset.page;

const routes: Record<string, () => void> = {
  'users': UsersPage,
  'vehicles': VehiclesPage
};

if (page && routes[page]) {
  routes[page]();
}

Alpine.start();