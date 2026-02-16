import { defineConfig } from "vite";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
  plugins: [tailwindcss()],
  server: {
    cors: {
      // the origin you will be accessing via browser
      origin: "http://localhost:8080",
    },
    origin: "http://localhost:5173",
    watch: {
      usePolling: true,
    },
  },
  build: {
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
