import defaultTheme from 'tailwindcss/defaultTheme.js'

/** @type {import('tailwindcss').Config} */
export default {
  content: ['./src/resources/**/*.{js,jsx,php}'],
  prefix: 'ch-',
  theme: {
    extend: {
      colors: {
        primary: '#2A9C66',
        secondary: '#18203D'
      }
    },
    fontFamily: {
      montserrat: ['montserrat', ...defaultTheme.fontFamily.sans]
    }
  },
  corePlugins: {
    preflight: false
  }
}
