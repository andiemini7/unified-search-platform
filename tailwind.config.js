module.exports = {
  mode: 'jit',
  purge: ['./**/*.php'],
  darkMode: false,
  theme: {
    extend: {},
  },
  variants: {
    extend: {},
  },
  plugins: [],
  separator: '_',
  future: {
    removeDeprecatedGapUtilities: true,
    purgeLayersByDefault: true,
  },

  syntax: 'postcss-scss'
}
