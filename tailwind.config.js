import tailwindCssForms from '@tailwindcss/forms'

/** @type {import('tailwindcss').Config} */
export default {
  content: ['./src/resources/**/*.{js,jsx,php}'],
  theme: {
    extend: {},
  },
  plugins: [tailwindCssForms],
}

