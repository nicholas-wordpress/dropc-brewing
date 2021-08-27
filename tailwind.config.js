const colors = require( 'tailwindcss/colors' )

module.exports = {
	darkMode: 'media',
	purge: {
		enabled: true,
		content: ['./templates/**/*.php'],
	},
	theme: {
		fontFamily: {
			sans: [ 'Montserrat', 'ui-sans-serif', 'system-ui'],
			serif: [ '"Bebas Neue"', 'ui-serif', 'system-ui'],
		},
		colors: {
			transparent: 'transparent',
			current: 'currentColor',
			black: colors.black,
			white: colors.white,
			gray: colors.warmGray,
			indigo: colors.indigo,
			red: colors.rose,
			yellow: colors.amber,
		},
		extend: {
			typography: ( theme ) => ( {
				dark: {
					css: {
						color: theme( 'colors.white' ),
						h1: {
							color: theme( 'colors.white' ),
						},
						h2: {
							color: theme( 'colors.white' ),
						},
						h3: {
							color: theme( 'colors.white' ),
						},
						h4: {
							color: theme( 'colors.white' ),
						},
						h5: {
							color: theme( 'colors.white' ),
						},
						h6: {
							color: theme( 'colors.white' ),
						},
						th: {
							color: theme( 'colors.white' ),
						},
						input: {
							color: theme( 'colors.black' ),
						},
						select: {
							color: theme( 'colors.black' ),
						},
						pre: {
							background: theme( 'colors.black' ),
							color: theme( 'colors.white' )
						},
						strong: {
							color: theme( 'colors.white' ),
						},
						blockquote: {
							color: theme( 'colors.gray.200' ),
						},
						code: {
							color: theme( 'colors.red.500' )
						},
						a: {
							color: theme( 'colors.red.500' ),
							'&:hover': {
								color: theme( 'colors.red.600' )
							},
						},
					},
				},
				DEFAULT: {
					css: {
						color: theme( 'colors.black' ),
						h1: {
							color: theme( 'colors.gray.800' ),
						},
						h2: {
							color: theme( 'colors.gray.800' ),
						},
						h3: {
							color: theme( 'colors.gray.800' ),
						},
						h4: {
							color: theme( 'colors.gray.800' ),
						},
						h5: {
							color: theme( 'colors.gray.800' ),
						},
						h6: {
							color: theme( 'colors.gray.800' ),
						},
						strong: {
							color: theme( 'colors.gray.800' ),
						},
						blockquote: {
							'border-left-color': theme( 'colors.red.500' )
						},
						code: {
							color: theme( 'colors.red.700' )
						},
						pre: {
							background: theme( 'colors.yellow.100' ),
							color: theme( 'colors.black' )
						},
						a: {
							color: theme( 'colors.red.700' ),
							'&:hover': {
								color: theme( 'colors.red.500' )
							},
						},
					},
				},
			} )
		},
	},
	plugins: [
		require( '@tailwindcss/typography' ),
		require( '@tailwindcss/forms' )
	],
	variants: {
		extend: {
			typography: ['dark'],
		}
	}
}