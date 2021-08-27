export default function ( id ) {

	return {
		authorData: false,

		field( field, defaultValue = '' ) {

			// If the author data is still being fetched, return the fallback instead
			if ( false === this.authorData ) {
				return defaultValue
			}

			return this.authorData[field]
		},

		get username() {
			return this.field( 'name' )
		},

		get fullName() {
			return this.field('display_name')
		},

		get link() {
			return this.field('link')
		},

		async init() {
			this.authorData = await theme.fetch( { path: `wp/v2/users/${id}`, cacheItem: true } )
		}
	}
}