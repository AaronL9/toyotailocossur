// types/alpine.d.ts
import 'alpinejs' // ← this import is REQUIRED, without it the module augmentation breaks
import type { string } from 'zod';

declare module 'alpinejs' {
  interface Stores {
    spec: {
      editInput: string;
    }
    variantSpec: {
      editInput: string;
      editSpecNo: string;
    }
    specType: {
      editInput: string;
    }

    colorType: {
      editInput: string,
      editHexVal: string
    }
  }
}