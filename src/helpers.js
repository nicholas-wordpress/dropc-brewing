import Alpine from "alpinejs";

function setStore( pageData ) {
	const defaults = {
		posts: [],
		body_class: [],
		type: '',
		pagination: '',
		comments_open: false
	}

	// Set default values. This ensures pageData has all of the necessary properties.
	pageData = { ...defaults, ...pageData }

	Alpine.store( 'posts', pageData.posts )
	Alpine.store( 'pageType', pageData.type )
	Alpine.store( 'postType', 'singular' === pageData.type ? getTemplateType( 0, pageData.posts ) : false )
	Alpine.store( 'pagination', pageData.pagination )
	Alpine.store( 'bodyClass', pageData.body_class )
	Alpine.store( 'commentsOpen', pageData.comments_open )
}

function setLoadingState( to ) {
	Alpine.store( 'isLoading', to === true )
}

async function setCompatibilityModeUrls() {
	const compatibilityModeUrls = await theme.fetch( { path: 'nicholas/v1/compatibility-mode-urls' } )

	Alpine.store( 'compatibilityModeUrls', compatibilityModeUrls );
}

function setHistory( url ) {
	window.history.pushState( {
		comments: Alpine.store( 'comments' )
	}, document.title, url )
}

function getPost( index, posts = false ) {
	posts = false === posts ? Alpine.store( 'posts' ) : posts

	return undefined === posts[index] ? false : posts[index]
}

function getTemplateType( index = 0, posts = false ) {
	const post = getPost( index, posts )
	const postTypes = ['page']

	if ( false === post || undefined === post.type ) {
		return false
	}

	if ( postTypes.includes( post.type ) ) {
		return post.type
	}

	// Beer post type just uses the page type.
	if ( post.type === 'beer' ) {
		return 'page'
	}

	// Fallback to default (post) type
	return 'post'
}

export { setStore, setLoadingState, setCompatibilityModeUrls, setHistory }