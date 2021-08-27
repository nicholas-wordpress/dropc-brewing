import Alpine from 'alpinejs'
import Post from './components/Post'
import Comments from './components/Comments'
import fetchComments from './middlewares/route/fetchComments'
import updateStore from './middlewares/route/updateStore'
import updateHistory from './middlewares/route/updateHistory'
import startLoading from './middlewares/route/startLoading'
import setupPopstate from './middlewares/setup/setupPopstate'
import validateCache from './middlewares/setup/validateCache'
import fetchCacheMiddleware from './middlewares/fetch/cacheMiddleware'
import { setStore, setLoadingState } from './helpers'
import { addRouteActions, handleClickMiddleware, setupRouter, Url, validateMiddleware } from "nicholas-router";
import fetch from 'nicholas-wp'
import {
	updateAdminBar, validateAdminPage, validateCompatibilityMode,
	primeCache, setPreloadWorker
} from 'nicholas-wp/middlewares'

// Set up additional fetch cache middlewares.
fetch.use( fetchCacheMiddleware )

// Delay startup of this script until after the page is loaded.
window.onload = function () {
	window.Alpine = Alpine

	// When Alpine is initialized, do these actions.
	document.addEventListener( 'alpine:init', async () => {

		// First, set up the initial state in our global store.
		// By passing an empty object here, we basically force it to reset.
		setStore( {} )
		setLoadingState( true )
		Alpine.store( 'comments', '' )


		// Now fetch data. Fetch returns a promise, so we use 'await' to tell JS to wait it to resolve before moving on.
		const pageData = await theme.fetch( { path: theme_vars.preloaded_endpoint } )

		// Setup the Alpine store
		setStore( pageData[0] )

		// Set loading state after fonts are loaded
		new Promise( async ( res, rej ) => {
			await document.fonts.ready
			setLoadingState( false )
			res()
		} )


		// Store data in the cache
		new Url( window.location.href ).updateCache( pageData[0] )
	} )

	// Setup route middleware actions
	addRouteActions(
		// First, validate the URL
		validateMiddleware,
		// Validate this page is not an admin page
		validateAdminPage,
		// Validate this page doesn't require compatibility mode
		validateCompatibilityMode,
		// Start loading
		startLoading,
		// Then, we prime the cache for this URL
		primeCache,
		// Then, we Update the Alpine store
		updateStore,
		// Maybe fetch comments, if enabled
		fetchComments,
		// Update the history
		updateHistory,
		// Maybe update the admin bar
		updateAdminBar
	)

	// Fire up Nicholas router
	setupRouter( handleClickMiddleware, setupPopstate, validateCache, setPreloadWorker )

	// Fire up AlpineJS
	Alpine.start()
}

// Export fetch so we can add middleware.
export { fetch, Post, Comments }