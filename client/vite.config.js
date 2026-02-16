import { defineConfig } from "vite";

export default defineConfig({
  server: {
    cors: {
      // the origin you will be accessing via browser
      origin: 'http://localhost:8080',
    },
  },
  build: {
    // generate .vite/manifest.json in outDir
    manifest: true,
    rollupOptions: {
      // overwrite default .html entry
      input: {
        admin: "/src/admin.ts",
        main: "/src/main.ts"
      }
    },
  },
  watch: {
      usePolling: true
    }
})