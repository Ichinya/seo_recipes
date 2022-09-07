/** @type {import('tailwindcss').Config} */
const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
    content: [
        "./components/**/*.{js,vue,ts}",
        "./layouts/**/*.vue",
        "./pages/**/*.vue",
        "./content/**/*.md",
        "./plugins/**/*.{js,ts}",
    ],
    theme: {
        extend: {
            fontFamily: {
                'header': ['Cabinet Grotesk', ...defaultTheme.fontFamily.sans],
                'sans': ['Satoshi', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [
        require('@tailwindcss/typography'),
        // ...
    ],
}