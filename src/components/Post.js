import Author from './Author'
export default function ( iterator = 0 ) {

	return {
		field( field ) {
			const post = Alpine.store( 'posts' )[iterator]

			if ( undefined === post ) {
				return ''
			}

			if ( undefined === post[field] ) {
				return ''
			}

			return post[field]
		},

		get title() {
			const field = this.field( 'title' )

			return undefined === field.rendered ? '' : field.rendered
		},

		get content() {
			const field = this.field( 'content' )

			return undefined === field.rendered ? '' : field.rendered
		},

		get excerpt() {
			const field = this.field( 'excerpt' )

			return undefined === field.rendered ? '' : field.rendered
		},

		get link() {
			return this.field( 'link' )
		},

		get featuredImage() {
			return this.field( 'featured_image' )
		},

		get template() {
			return this.field( 'template' )
		},

		get author() {
			return new Author( this.field( 'author' ) )
		},

		get commentCount() {
			return this.field( 'comment_count' )
		},

		get commentsOpen() {
			return this.field( 'comment_status' ) === 'open'
		},

		get lastUpdated() {
			return new Date( this.field( 'modified_gmt' ) )
				.toLocaleString( 'default', { year: 'numeric', month: 'long', day: 'numeric' } );
		},

		get commentText() {
			if ( this.commentCount === 0 ) {
				return 'No Comments'
			}
			if ( this.commentCount === 1 ) {
				return '1 Comment'
			}

			return `${this.commentCount} Comments`
		}
	}
}