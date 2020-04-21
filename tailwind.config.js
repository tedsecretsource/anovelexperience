const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    theme: {
        extend: {
            screens: {
                'sm': '640px',
                // => @media (min-width: 640px) { ... }

                'md': '768px',
                // => @media (min-width: 768px) { ... }

                'lg': '1024px',
                // => @media (min-width: 1024px) { ... }

                'xl': '1280px',
                // => @media (min-width: 1280px) { ... }

                '2xl': '1400px',
                // => @media (min-width: 1280px) { ... }
            },
            fontFamily: {
                'sans': ['Inter var', ...defaultTheme.fontFamily.sans],
                'serif': ['Playfair Display', ...defaultTheme.fontFamily.serif],
                'mono': ['Courier', 'Courier New', 'Consola', ...defaultTheme.fontFamily.mono],
                'gothic-intense': ['UnifrakturMaguntia'],
                'gothic-mild': ['Pirata One'],
                'gothic-modern': ['Astloch'],
                'gothic-modern-thick': ['Berkshire Swash'],
                'gothic-extra-mild': ['New Rocker'],
                'typewriter-heavy': ['Special Elite'],
                'cursive-rough': ['Homemade Apple'],
                'cursive-soft': ['Cedarville Cursive'],
                'handwriting-block-letters': ['Nothing You Could Do'],
                'handwriting-caligraphic': ['Monsieur La Doulaise'],
                'handwriting-cursive': ['Herr Von Muellerhoff'],
                'bleeding-caps': ['Nosifer']
            },
            colors: {
                dracgrey: '#24292e',
                dracred: {
                    '100': '#ff1818',
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
