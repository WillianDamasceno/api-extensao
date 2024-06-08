/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            screens: {
                xs: "480px",
                "2xl": "1440px",
            },
            container: {
                center: true,
                padding: "1rem",
            },
            colors: {
                primary: "oklch(36.92% 0.128 5.26 / <alpha-value>)",
                "primary-light": "oklch(62.64% 0.137 359.09 / <alpha-value>)",
                secondary: "oklch(69.71% 0.329 342.55 / <alpha-value>)", // Default color
                accent: "oklch(76.76% 0.184 183.61 / <alpha-value>)", // Default color
                neutral: "#585858",
                mono: {
                    DEFAULT: "#767676",
                },
            },
        },
    },
    plugins: [
        require("@tailwindcss/typography"),
        require("@tailwindcss/container-queries"),
        require("daisyui"),
    ],
    daisyui: {
        themes: [
            {
                light: {
                    ...require("daisyui/src/theming/themes")[
                        "[data-theme=light]"
                    ],
                    primary: "oklch(36.92% 0.128 5.26)",
                    "primary-content": "oklch(100% 0 0)", // Default color

                    secondary: "oklch(69.71% 0.329 342.55)", // Default color
                    "secondary-content": "oklch(98.71% 0.0106 342.55)", // Default color

                    accent: "oklch(76.76% 0.184 183.61)", // Default color
                    "accent-content": "oklch(100% 0 0)", // Default color

                    neutral: "#585858",
                    "neutral-content": "#D7DDE4", // Default color

                    "base-100": "oklch(100% 0 0)", // Default color
                    "base-200": "#F1F1F1", // Default color
                    "base-300": "#E5E6E6", // Default color
                    "base-content": "#1f2937", // Default color

                    "--rounded-btn": "0",
                },
            },
        ],
    },
};
