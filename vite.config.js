import { defineConfig } from "vite";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
  plugins: [tailwindcss()],
  root: "resources",

  server: {
    cors: {
      origin: "http://localhost:8080",
    },
  },

  build: {
    outDir: "../public/dist",
    emptyOutDir: true,

    // generate assets/manifest.json in outDir
    manifest: true,

    rollupOptions: {
      // overwrite default .html entry
      input: {
        admin: "/admin.ts",
        main: "/main.ts",
      },
    },
  },
});
