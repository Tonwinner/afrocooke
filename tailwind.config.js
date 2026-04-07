import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Outfit', '-apple-system', 'BlinkMacSystemFont', ...defaultTheme.fontFamily.sans],
                serif: ['Cormorant Garamond', 'Georgia', ...defaultTheme.fontFamily.serif],
            },
            colors: {
                brand: {
                    50:  '#edfbf6',
                    100: '#d4f5ec',
                    200: '#adead9',
                    300: '#78d9c0',
                    400: '#2dbf95',
                    500: '#1a9e7a',
                    600: '#148063',
                    700: '#126751',
                    800: '#0f5242',
                    900: '#0b3d32',
                },
                beige: {
                    50:  '#faf8f4',
                    100: '#f2ede4',
                    200: '#e6ddd0',
                    300: '#d4c7b3',
                    400: '#bfab93',
                    500: '#a89278',
                },
                dark: {
                    DEFAULT: '#15302a',
                    50:  '#1e3f38',
                    100: '#15302a',
                    200: '#0d1f1b',
                },
                gold: {
                    50:  '#fef9f1',
                    100: '#fdf0da',
                    200: '#f9deb0',
                    300: '#e9c784',
                    400: '#D4A853',
                    500: '#c49340',
                    600: '#a67930',
                    700: '#8a6226',
                    800: '#6e4e1e',
                    900: '#523a16',
                },
                brown: {
                    DEFAULT: '#7A6A58',
                    light: '#9A8A78',
                },
            },
        },
    },
    plugins: [forms],
};