import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/views/**/*.vue',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Mulish', ...defaultTheme.fontFamily.sans],
            },
            keyframes: {
                typing: {
                  "0%": {
                    width: "0%",
                    visibility: "hidden"
                  },
                  "100%": {
                    width: "100%"
                  }  
                },
                blink: {
                  "50%": {
                    borderColor: "transparent"
                  },
                  "100%": {
                    borderColor: "white"
                  }  
                }
            },
            animation: {
                typing: "typing 2s steps(20) infinite alternate, blink .7s infinite"
            }
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
                    "base-200": "#FBFBFB",

                    "primary-content": "#ffffff",
                    "secondary-content": "#ffffff",
                    "neutral-content": "#000000",
                    "--rounded-btn": "2rem",
                    "--border-btn": "0px", 
                    "--rounded-input": "2rem",
                },
            }
        ],
    },

    plugins: [
        forms,
        require('daisyui'),
        require('@tailwindcss/typography'),
    ],
};
