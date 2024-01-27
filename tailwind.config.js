/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            boxShadow: {
                'lg': "rgba(0, 0, 0, .3) 0px 30px 35px 25px",
            },
            colors: {
                'yellow': "#efd004",
                'blue': "#05e8ff",
                'orange': "#f57a00",
                'green': "#3ebd17",
                'red': "#c91237",
                'purple': "#9701d7",
            }
        }
    },
    plugins: [],
}
