import tailwindPreset from './tailwind.preset.js'
import tailwindForms from '@tailwindcss/forms'

/** @type {import('tailwindcss').Config} */
export default {
  presets: [tailwindPreset],
  content: ['./src/resources/views/shortcode/**/*.{js,jsx,php}'],
  plugins: [tailwindForms],
  safelist: ['md:ch-grid-cols-1', 'md:ch-grid-cols-2', 'md:ch-grid-cols-3']
}
