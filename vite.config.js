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

    // generate assets/manifest.json in outDir
    manifest: "assets/manifest.json",

    rollupOptions: {
      // overwrite default .html entry
      input: {
        admin: "/src/admin.ts",
        main: "/src/main.ts",
      },
    },
  },
});
