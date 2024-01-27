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
                'custom': "rgba(0, 0, 0, .3) 0px 30px 35px 25px",
            },
            colors: {
                'cyellow': "#efd004",
                'cblue': "#05e8ff",
                'corange': "#f57a00",
                'cgreen': "#3ebd17",
                'cred': "#c91237",
                'cpurple': "#9701d7",
            }
        }
    },
    plugins: [],
}
