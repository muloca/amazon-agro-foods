import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                amazon: {
                    // Paleta alinhada às cores do novo logo
                    verde: {
                        50: '#ebf2ee',
                        100: '#cce0d4',
                        200: '#9ac1aa',
                        300: '#68a380',
                        400: '#358556',
                        500: '#03662c', // Verde profundo do corpo
                        600: '#035924',
                        700: '#02471c',
                        800: '#013617',
                        900: '#012611',
                    },
                    verde_claro: {
                        50: '#f2f8ef',
                        100: '#ddeed9',
                        200: '#bcddb3',
                        300: '#9acb8e',
                        400: '#79bc68',
                        500: '#58ac43', // Verde claro do destaque
                        600: '#4a9238',
                        700: '#3d782e',
                        800: '#305e24',
                        900: '#23441b',
                    },
                    azul: {
                        50: '#ebf2f6',
                        100: '#cde0e8',
                        200: '#9bc1d2',
                        300: '#6aa3bb',
                        400: '#3884a5',
                        500: '#07668f', // Azul da faixa inferior
                        600: '#055679',
                        700: '#044764',
                        800: '#03384e',
                        900: '#022839',
                    },
                    amarelo: {
                        50: '#fdfbee',
                        100: '#faf7d5',
                        200: '#f4efac',
                        300: '#efe782',
                        400: '#eadf59',
                        500: '#e5d830', // Amarelo do bico
                        600: '#c2b728',
                        700: '#a09721',
                        800: '#7e761a',
                        900: '#5b5613',
                    },
                    branco: '#FFFFFF',
                },
                brasil: {
                    verde: "#009B3A",
                    amarelo: "#FFDF00",
                    azul: "#002776",
                    branco: "#FFFFFF",
                },
            },
        },
    },

    plugins: [forms],
};
