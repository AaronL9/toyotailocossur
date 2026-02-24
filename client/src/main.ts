import 'preline';
import './style.css';

import Showroom from './pages/showroom';

const page = document.documentElement.dataset.page;

const routes: Record<string, () => void> = {
  'showroom': Showroom
};

if (page && routes[page]) {
  routes[page]();
}
