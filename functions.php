<?php
/**
 * Theme functions file.
 * Contains useful functions, and sets up the theme.
 */

use Nicholas\Nicholas;
use function Nicholas\nicholas;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function get_approved_comment_count( $post_id ) {
	$comments = get_comment_count( $post_id );

	return $comments['approved'];
}

// Require composer autoloader. If you forget to install composer, wp_die will fire.
$autoload = trailingslashit( get_template_directory() ) . 'vendor/autoload.php';
if ( ! file_exists( $autoload ) ) {
	wp_die( 'Composer autoload not found. Did you forget to run composer install in your theme?' );
}

require_once( $autoload );

// Enqueue theme script
add_action( 'nicholas/enqueue_app_scripts', function () {
	nicholas()->scripts()->get( 'theme' )->enqueue();
} );

// Add compatibility mode URLs
add_filter( 'nicholas/compatibility_mode_urls', function ( $urls ) {

	// Filter Twitter Embeds
	$filtered_urls = Nicholas::get_urls_for_query( [
		'post_type' => 'any',
		's'         => '"providerNameSlug":"twitter"', // Twitter embeds
	] );

	return array_merge( $urls, $filtered_urls );
} );

register_rest_field( 'user', 'display_name', [
	'get_callback' => function ( $user ) {
		return get_the_author_meta( 'display_name', $user['id'] );
	},
] );

// Add rendered output for post thumbnail to REST calls
register_rest_field( 'post', 'featured_image', [
	'get_callback' => function ( $post ) {
		return get_the_post_thumbnail( $post['id'] );
	},
] );

// Add rendered output for post thumbnail to REST calls
register_rest_field( 'post', 'comment_count', [
	'get_callback' => function ( $post ) {
		return get_approved_comment_count( $post['id'] );
	},
] );

// Add rendered output for post thumbnail to REST calls
register_rest_field( 'page', 'featured_image', [
	'get_callback' => function ( $post ) {
		return get_the_post_thumbnail( $post['id'] );
	},
] );

// Flush cache when user with posts updates their profile.
add_action( 'profile_update', function ( $user_id ) {
	$user_posts = new WP_Query( [ 'fields' => 'ids', 'posts_per_page' => 1, 'author' => $user_id ] );

	// If this user has any posts, flush the cache.
	// This is necessary because user data is used on the front-end.
	if ( ! empty( $user_posts->posts ) ) {
		nicholas()->options()->get( 'nicholas_last_updated' )->update( current_time( 'U', 1 ) );
	}
} );

// Enqueue stylesheet in block editor
add_action( 'enqueue_block_editor_assets', function () {
	nicholas()->styles()->get( 'theme' )->enqueue();
} );

// Set Up Theme Supports
add_theme_support( 'custom-logo' );
add_theme_support( 'menus' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'title-tag' );

/**
 * Templates.
 *
 * Underpin comes with a powerful template loading system, and this boilerplate expands on that with a template loader.
 * Below, you will see a few basic pre-set loaders built inline.
 *
 * These can be built inline as shown below, but they can also be added as a class that extends
 * Theme/Abstracts/Template. In circumstances where your template needs to prefetch a lot of data before render, it's
 * probably better to create a class, add your data, and then pass that data to the template.
 *
 * For more information, check out Underpin loader documentation here: https://github.com/underpin-WP/underpin#loaders
 * You may also want to check out the Theme\Loaders\Templates loader to see how to register your own templates.
 *
 * Additionally, check out more information on how the template system works here:
 * https://github.com/underpin-WP/underpin#template-system-trait
 */

$template_path = trailingslashit( get_template_directory() ) . 'templates';

/**
 * Index Templates
 * Files located in /templates/index/
 */
nicholas()->templates()->add( 'index', [
	'description' => "Renders the home page.",
	'name'        => "Index Template.",
	'group'       => 'index',
	'root_path'   => $template_path,
	'templates'   => [
		'index'              => [ 'override_visibility' => 'public' ],
		'archive'            => [ 'override_visibility' => 'public' ],
		'comments'           => [ 'override_visibility' => 'public' ],
		'singular'           => [ 'override_visibility' => 'public' ],
		'archive-post'       => [ 'override_visibility' => 'public' ],
		'archive-pagination' => [ 'override_visibility' => 'public' ],
		'404'                => [ 'override_visibility' => 'public' ],
		'no-posts'           => [ 'override_visibility' => 'public' ],
	],
] );

/**
 * Index Templates
 * Files located in /templates/page/
 */
nicholas()->templates()->add( 'page', [
	'description' => "Renders the page post type content.",
	'name'        => "Page post type template.",
	'group'       => 'page',
	'root_path'   => $template_path,
	'templates'   => [
		'index'              => [ 'override_visibility' => 'public' ],
		'document'           => [ 'override_visibility' => 'public' ],
		'default'            => [ 'override_visibility' => 'public' ],
		'compatibility-mode' => [ 'override_visibility' => 'public' ],
	],
] );

/**
 * Index Templates
 * Files located in /templates/post/
 */
nicholas()->templates()->add( 'post', [
	'description' => "Renders the default post type content.",
	'name'        => "Page post type template.",
	'group'       => 'post',
	'root_path'   => $template_path,
	'templates'   => [
		'index' => [ 'override_visibility' => 'public' ],
	],
] );

/**
 * Header Template
 * Files located in /templates/header/
 */
nicholas()->templates()->add( 'header', [
	'description' => "Renders the header.",
	'name'        => "Header Template.",
	'root_path'   => $template_path,
	'group'       => 'header',
	'templates'   => [
		'header'          => [ 'override_visibility' => 'public' ],
		'nav'             => [ 'override_visibility' => 'public' ],
		'loading-wrapper' => [ 'override_visibility' => 'public' ],
		'noscript'        => [ 'override_visibility' => 'public' ],
	],
] );

/**
 * Footer Template
 * Files located in /templates/footer/
 */
nicholas()->templates()->add( 'footer', [
	'description' => "Renders the home page.",
	'name'        => "Index Template.",
	'root_path'   => $template_path,
	'group'       => 'footer',
	'templates'   => [
		'footer' => [ 'override_visibility' => 'public' ],
	],
] );

/**
 * Comments Template
 * Files located in /templates/comments/
 */
nicholas()->templates()->add( 'comments', [
	'description' => "Renders comments.",
	'name'        => "Comments Template.",
	'root_path'   => $template_path,
	'group'       => 'comments',
	'templates'   => [
		'comments' => [ 'override_visibility' => 'public' ],
	],
] );

/**
 * Compatibility Mode Template
 * Files located in /templates/compatibility-mode/
 */
nicholas()->templates()->add( 'compatibility-mode', [
	'description' => "Renders the page in compatibility mode.",
	'name'        => "Compatibility Mode Index Template.",
	'root_path'   => $template_path,
	'group'       => 'compatibility-mode',
	'templates'   => [
		'index'    => [ 'override_visibility' => 'public' ],
		'singular' => [ 'override_visibility' => 'public' ],
		'archive'  => [ 'override_visibility' => 'public' ],
	],
] );

nicholas()->styles()->add( 'theme', [
	'name'        => 'Theme Styles',
	'src'         => nicholas()->asset_url() . 'style.css',
	'deps'        => nicholas()->asset_dir() . 'style.asset.php',
	'handle'      => 'theme-styles',
	'description' => 'Stylesheet for the theme',
	'middlewares' => [
		'Underpin_Styles\Factories\Enqueue_Style',
	],
] );

/**
 * Primary menu
 * Registers the primary menu
 */
nicholas()->menus()->add( 'primary', [
	'name'     => nicholas()->__( 'Primary Menu' ),
	'location' => 'primary',
] );

/**
 * Document Post Template
 * Creates the custom page template, "Document"
 * Gets rendered in templates/page/document
 */
nicholas()->post_templates()->add( 'document', [
	'name'        => 'Document',
	'description' => 'Used for documents, and other prose-focused pages.',
	'template'    => 'document',
] );


nicholas()->sidebars()->add( 'footer', [
	'name'        => nicholas()->__( 'Footer' ),
	'id'          => 'footer',
	'description' => nicholas()->__( 'Content to display in the footer' ),
] );