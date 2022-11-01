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
        'blue-50': 'rgb(239 246 255)',
        'blue-100': 'rgb(219 234 254)',
        'blue-200': 'rgb(191 219 254)',
        'blue-300': 'rgb(147 197 253)',
        'blue-400': 'rgb(96 165 250)',
        'blue-500': 'rgb(59 130 246)',
        'blue-600': 'rgb(37 99 235)',
        'blue-700': 'rgb(29 78 216)',
        'blue-800': 'rgb(30 64 175)',
        'blue-900': 'rgb(30 58 138)',
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}
