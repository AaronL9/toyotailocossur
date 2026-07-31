import { defineConfig } from "vite";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
  plugins: [tailwindcss()],
  root: "resources",
  base: '/dist/',

  server: {
    cors: {
      origin: "http://localhost:8081",
    },

    origin: 'http://localhost:5173'
  },

  build: {
    outDir: "../public/dist",
    emptyOutDir: true,

    // generate assets/manifest.json in outDir
    manifest: "manifest.json",

    rollupOptions: {
      // overwrite default .html entry
      input: {
        admin: "/admin.ts",
        main: "/main.ts",
      },
    },
  },
});
