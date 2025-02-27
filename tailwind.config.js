module.exports = {
  content: ["./**/*.{html,js,php}","./assets/**/*.scss","./assets/**/*.js"],
  theme: {
    extend: {
      margin: {
        '55': '55px',
      },
      boxShadow: {
        'nav-shadow': '0 4px 4px -4px rgba(0, 0, 0, 0.3)',
      },
      fontFamily: {
        sans: ['Poppins', 'sans-serif'],
      },
      backgroundImage: {
        'grey-gradient': 'linear-gradient(to bottom, #e0e0e0, #ffffff)',
      }
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
