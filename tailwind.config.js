/** @type {import('tailwindcss').Config} */
export default {
  content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
  ],
  theme: {
    extend: {
        colors: {
            'primary-color': '#13293D',
            'secondary-color': '#006494',
            'third-color': '#1D94CC',
            'fourth-color': '#2C465E',
            'fifth-color': '#1BB3FA',
            'sixth-color': '#E8F1F2',
            'seventh-color': '#22B9C9',
        },
    },
  },
  plugins: [
      require('@tailwindcss/forms')({
          strategy: 'class'
      })
  ],
}

