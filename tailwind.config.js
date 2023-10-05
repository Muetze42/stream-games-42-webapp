const theme = require('./resources/tailwind.theme.js')

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./resources/**/*.blade.php', './resources/**/*.js', './resources/**/*.vue'],
  theme: theme,
  plugins: []
}
