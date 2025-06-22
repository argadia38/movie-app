import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'

export default defineConfig({
  server: {
    host: true,         // supaya bisa diakses dari luar container
    port: 5173,
    hmr: {
      host: 'localhost', // atau sesuaikan dengan IP host kamu di docker network
    },
  },
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true,
    }),
  ],
})
