import { Alpine as AlpineType } from 'alpinejs'

declare global {
  var Alpine: AlpineType
}

declare global {
  interface Window {
    CSRF: {
      name: string;
      value: string;
    };
  }
}