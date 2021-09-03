import fetch from 'nicholas-wp'

export default ( args, next ) => {
	new Promise( async ( res, rej ) => {
		const data = args.url.getCache()

		if ( undefined === data || undefined === data.seo_tag ) {
			try {
				const response = await fetch( {
					path: `/yoast/v1/get_head?url=${args.url.href}`
				} )

				args.url.updateCache( { seo_tag: response.html } )
				data.seo_tag = response.html
			}catch(error){
				args.url.updateCache( { seo_tag: error.html } )
				data.seo_tag = error.html
			}
		}

		document.head.innerHTML = document.head.innerHTML.replace(
			/<!-- This site is optimized with the Yoast SEO plugin.+<!-- \/ Yoast SEO plugin\. -->/gms,
			data.seo_tag
		)

		res();
	} )

	next()
}