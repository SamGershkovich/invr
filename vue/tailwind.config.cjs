/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      colors: {
        'sky-400': 'rgb(56 189 248)',
        'sky-500': 'rgb(14 165 233)',
        'sky-600': 'rgb(2 132 199)',
        'sky-700': 'rgb(3 105 161)',
        'gray-100': 'rgb(249 249 249)',
        'gray-200': 'rgb(229 231 235)',
        'gray-300': 'rgb(209 213 219)',
        'gray-400': 'rgb(156 163 175)',
        'gray-500': 'rgb(107 114 128)',
        'gray-600': 'rgb(75 85 99)',
        'gray-700': 'rgb(55 65 81)',
        'gray-800': 'rgb(31 41 55)',
        'gray-900': 'rgb(17 24 39)',
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}
