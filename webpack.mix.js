// webpack.mix.js
const mix = require('laravel-mix');

mix.disableNotifications();

mix.js('assets/js/main.js', 'assets/dist/js/')
   .options({
       processCssUrls: false,
       postCss: [tailwindcss('./tailwind.config.js')],
   });