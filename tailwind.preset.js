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
      },
      fontSize: {
        sm: 'var(--wp--preset--font-size--small, 0.875rem)',
        base: 'var(--wp--preset--font-size--medium, 1rem)',
        lg: 'var(--wp--preset--font-size--large, 1.125rem)',
        xl: 'var(--wp--preset--font-size--x-large, 1.25rem)'
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
