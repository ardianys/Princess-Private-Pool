import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/views/layouts/app.blade.php",
    "./resources/js/app.js",
    "./resources/css/app.css",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

