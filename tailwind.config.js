import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Raleway', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    daisyui: {
        themes: [
            {
                mytheme: {
                    // "primary": "#FF9900",
                    // "primary": "#0064C8",
                    "primary": "#26CAD3",
                    "secondary": "#FC4F00",
                    "accent": "#00B187",
                    "neutral": "FACD00",

                    "primary-content": "#ffffff",
                    "secondary-content": "#ffffff",
                    "--rounded-btn": "1.5rem",
                    "--border-btn": "0px", 
                    "--rounded-input": "1.5rem"
                },
            },
        ],
    },

    plugins: [
        forms,
        require('daisyui'),
    ],
};
