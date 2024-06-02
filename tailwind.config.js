/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/views/movies/index.blade.php"
  ],
  theme: {
    extend: {
        display: ["group-hover"],
    },
  },
  plugins: [],
}

