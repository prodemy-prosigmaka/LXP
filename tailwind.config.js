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
                sans: ['Mulish', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    daisyui: {
        themes: [
            {
                mytheme: {
                    ...require("daisyui/src/theming/themes")["light"],
                    // "primary": "#FF9900",
                    // "primary": "#0064C8",
                    "primary": "#26CAD3",
                    "secondary": "#FC4F00",
                    "accent": "#C7EFF1",
                    "neutral": "#eaeaea",
                    "neutral-focus": "#e6e6e6", // Hover state for neutral
                    "base-100": "#ffffff",

                    "primary-content": "#ffffff",
                    "secondary-content": "#ffffff",
                    "neutral-content": "#000000",
                    "--rounded-btn": "10rem",
                    "--border-btn": "0px", 
                    "--rounded-input": "10rem",
                },
            }
        ],
    },

    plugins: [
        forms,
        require('daisyui'),
    ],
};
