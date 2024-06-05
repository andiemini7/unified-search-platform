/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**/*.{html,js,php}","./assets/**/*.scss","./assets/**/*.js"],
  theme: {
    extend: {
      backdropBlur: ['responsive', 'hover', 'focus'],
    },
  },
  plugins: [],
}
