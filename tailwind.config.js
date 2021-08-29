const fs = require( 'fs' )

const themeJson = fs.readFileSync( './theme.json' )
const theme = JSON.parse( themeJson )

// Parse the color palette for use in Tailwind
const colors = theme.settings.color.palette.reduce( ( acc, item ) => {
	const [color, number] = item.slug.split( '-' )

	// If there is a number identifier, make this an object
	if ( undefined !== number ) {
		if ( !acc[color] ) {
			acc[color] = {}
		}
		acc[color][number] = item.color
	} else {
		acc[color] = item.color
	}

	return acc
}, {} )


module.exports = {
	darkMode: 'media',
	purge: {
		enabled: true,
		content: ['./templates/**/*.php', './beercore-templates/**/*.php'],
		safelist: [
			// Max width
			'max-w-xs', 'max-w-sm', 'max-w-md', 'max-w-lg', 'max-w-xl', 'max-w-2xl', 'max-w-3xl', 'max-w-4xl', 'max-w-5xl', 'max-w-6xl', 'max-w-7xl', 'max-w-screen-sm', 'max-w-screen-md', 'max-w-screen-lg', 'max-w-screen-xl', 'max-w-screen-2xl',
			// Margins
			'mt-0', 'mb-0', 'ml-0', 'mr-0', 'mx-0', 'my-0', 'px-0', 'm-5', 'm-10', 'm-20', 'm-40', 'm-60', 'm-80', 'm-auto', 'mx-5', 'mx-10', 'mx-20', 'mx-40', 'mx-60', 'mx-80', 'mx-auto', 'my-5', 'my-10', 'my-20', 'my-40', 'my-60', 'my-80', 'my-auto', 'mt-5', 'mt-10', 'mt-20', 'mt-40', 'mt-60', 'mt-80', 'mt-auto', 'mr-5', 'mr-10', 'mr-20', 'mr-40', 'mr-60', 'mr-80', 'mr-auto', 'mb-5', 'mb-10', 'mb-20', 'mb-40', 'mb-60', 'mb-80', 'mb-auto', 'ml-5', 'ml-10', 'ml-20', 'ml-40', 'ml-60', 'ml-80', 'ml-auto',
			// Padding
			'pt-0', 'pb-0', 'pl-0', 'pr-0', 'px-0', 'py-0', 'px-0', 'p-5', 'p-10', 'p-20', 'p-40', 'p-60', 'p-80', 'px-5', 'px-10', 'px-20', 'px-40', 'px-60', 'px-80', 'py-5', 'py-10', 'py-20', 'py-40', 'py-60', 'py-80', 'pt-5', 'pt-10', 'pt-20', 'pt-40', 'pt-60', 'pt-80', 'pr-5', 'pr-10', 'pr-20', 'pr-40', 'pr-60', 'pr-80', 'pb-5', 'pb-10', 'pb-20', 'pb-40', 'pb-60', 'pb-80', 'pl-5', 'pl-10', 'pl-20', 'pl-40', 'pl-60', 'pl-80',
		]
	},
	theme: {
		fontFamily: {
			sans: ['Montserrat', 'ui-sans-serif', 'system-ui'],
			serif: ['"Bebas Neue"', 'ui-serif', 'system-ui'],
		},
		colors,
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
							color: theme( 'colors.yellow.500' ),
							'&:hover': {
								color: theme( 'colors.yellow.600' )
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
							color: theme( 'colors.yellow.700' ),
							'&:hover': {
								color: theme( 'colors.yellow.600' )
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