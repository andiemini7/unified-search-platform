module.exports = {
  content: ["./**/*.{html,js,php}","./assets/**/*.scss","./assets/**/*.js"],
  theme: {
    extend: {
      margin: {
        '70': '70px',
      },
      boxShadow: {
        'nav-shadow': '0 4px 4px -4px rgba(0, 0, 0, 0.3)',
      },
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
