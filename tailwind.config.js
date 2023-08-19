import defaultTheme from 'tailwindcss/defaultTheme.js'
import forms from '@tailwindcss/forms'

/** @type {import('tailwindcss').Config} */
export default {
  content: ['./src/resources/**/*.{js,jsx,php}'],
  theme: {
    extend: {
      colors: {
        primary: '#2A9C66',
        secondary: '#18203D'
      },
    },
    fontFamily: {
      'montserrat': ['montserrat', ...defaultTheme.fontFamily.sans]
    }
  },
  corePlugins: {
    preflight: false
  },
  plugins: [forms],
}

