import tailwindPreset from './tailwind.preset.js'
import tailwindForms from '@tailwindcss/forms'

/** @type {import('tailwindcss').Config} */
export default {
  presets: [tailwindPreset],
  content: ['./src/resources/views/admin/**/*.{js,jsx,php}'],
  plugins: [tailwindForms]
}
