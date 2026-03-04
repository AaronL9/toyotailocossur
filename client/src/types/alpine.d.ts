// types/alpine.d.ts
import 'alpinejs' // ← this import is REQUIRED, without it the module augmentation breaks

declare module 'alpinejs' {
  interface Stores {
    spec: {
      editInput: string;
    }
  }
}