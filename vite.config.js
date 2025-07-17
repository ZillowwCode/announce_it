import { resolve } from 'path'

export default {
  root: 'assets',
  publicDir: false,
  build: {
    emptyOutDir: false,
    outDir: resolve(__dirname, 'dist'),
    rollupOptions: {
      input: {
        js: resolve(__dirname, 'assets/js/app.js'),
        css: resolve(__dirname, 'assets/scss/styles.scss'),
      },
      output: {
        entryFileNames: 'announce_it.js',
        assetFileNames: 'announce_it.css',
      },
    },
  },
  css: {
    preprocessorOptions: {
      scss: {
        additionalData: `@use "sass:math";`,
      },
    },
  },
}
