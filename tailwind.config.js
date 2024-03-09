import defaultTheme from 'tailwindcss/defaultTheme';
function withOpacity(varName) {
    return ({opacityValue}) => {
        if(opacityValue) {
            return `rgba(var(${varName}), ${opacityValue})`;
        }
        return `rgb(var(${varName}))`;
    }
}
/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                'sans': ['Tajawal', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    50: withOpacity('--color-primary-50'),
                    100: withOpacity('--color-primary-100'),
                    200: withOpacity('--color-primary-200'),
                    300: withOpacity('--color-primary-300'),
                    400: withOpacity('--color-primary-400'),
                    500: withOpacity('--color-primary-500'),
                    600: withOpacity('--color-primary-600'),
                    700: withOpacity('--color-primary-700'),
                    800: withOpacity('--color-primary-800'),
                    900: withOpacity('--color-primary-900'),
                },

                secondary: {
                    50: withOpacity('--color-secondary-50'),
                    100: withOpacity('--color-secondary-100'),
                    200: withOpacity('--color-secondary-200'),
                    300: withOpacity('--color-secondary-300'),
                    400: withOpacity('--color-secondary-400'),
                    500: withOpacity('--color-secondary-500'),
                    600: withOpacity('--color-secondary-600'),
                    700: withOpacity('--color-secondary-700'),
                    800: withOpacity('--color-secondary-800'),
                    900: withOpacity('--color-secondary-900'),
                },

                accent:{

                },
                gold: {
                    100: '#ffeb51',
                    200: '#e8d122',
                    300: '#d0bb19',
                    400: '#a8960c',
                    500: '#938305',
                    600: '#938305',
                    700: '#756801',
                    800: '#4f4705',
                    900: '#373204',
                },
                dark: {
                    50: '#37424d',
                    primary: '#2C3640',
                    secondary: '#7e7d7d',
                    100: '#252E38',
                    200: '#1E2732',
                    300: '#1C2732',
                    400: '#2C3640',
                    500: '#15202B',
                },
                /*dark: {
                    100: '#514836',
                    200: '#352f23',
                    300: '#22262A',
                    500: '#1b1e21',
                },*/
            },
        },
    },

    plugins: [],
};
