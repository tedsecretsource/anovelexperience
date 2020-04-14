const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter var', ...defaultTheme.fontFamily.sans],
                serif: ['Playfair Display', ...defaultTheme.fontFamily.serif]
            },
            colors: {
                dracgrey: '#24292e',
                dracred: {
                    '100': '#ce0404',
                    '200': '#b50404',
                    '300': '#a20303',
                    '400': '#920303',
                    '500': '#8a0303',
                    '600': '#710202',
                    '700': '#630202',
                    '800': '#500101',
                    '900': '#350101',
                }
            },
        },
    },
    variants: {},
    plugins: [
        require('@tailwindcss/ui')({
            layout: 'sidebar',
        }),
        require('@tailwindcss/custom-forms')
    ]
}
