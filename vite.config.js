import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import copy from 'rollup-plugin-copy';

export default defineConfig({
  plugins: [
    laravel({
      input: ['resources/scss/app.scss', 'resources/js/app.js'],
      refresh: true,
    }),
    copy({
      targets: [
        { src: 'public/css/app.css', dest: 'dist/css' } // Copia app.css de public a dist/css
      ]
    })
  ],
});
