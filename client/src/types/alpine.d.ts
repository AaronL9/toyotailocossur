// alpine.d.ts
import 'alpinejs';

declare module 'alpinejs' {
  interface AlpineStores {
    csrfToken: {
      name: string;
      value: string;
    };
  }
}