import tailwindPreset from './tailwind.preset.js'

/** @type {import('tailwindcss').Config} */
export default {
  presets: [tailwindPreset],
  content: ['./src/resources/views/block/**/*.{js,jsx,php}']
}
