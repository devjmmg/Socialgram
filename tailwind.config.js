/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php"
    
  ],
  theme: {
    extend: {
      rotate: {
        '15': '15deg',
      }
    },
  },
  plugins: [
    require('tailwind-scrollbar'),
  ],
}

