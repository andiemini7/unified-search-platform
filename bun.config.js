module.exports = {
    stylesheets: {
      entry: './assets/sass/style.scss',
      output: './assets/dist/css/style.css',
      processor: 'sass',
      plugins: ['tailwindcss', 'autoprefixer'],
    },
    javascripts: {
      entry: './assets/js/main.js',
      output: './assets/dist/js',
    },
  };
  