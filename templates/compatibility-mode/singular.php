<?php
/**
 * Index Loop Template
 *
 * @author: Alex Standiford
 * @date  : 12/21/19
 * @var Theme\Abstracts\Template $template
 */

use Nicholas\Nicholas;
use function Nicholas\nicholas;

if ( ! nicholas()->templates()->is_valid_template( $template ) ) {
	return;
}

$post_type = get_post_type();

// Default to post template
if ( ! in_array( $post_type, [ 'page', 'post' ] ) ) {
	$post_type = 'post';
}

if ( $post_type === 'page' ) {
	echo nicholas()->templates()->get_template( 'page', 'compatibility-mode', [
		'featured_image' => get_the_post_thumbnail(),
		'content'        => Nicholas::get_buffer( 'the_content' ),
		'title'          => Nicholas::get_buffer( 'the_title' ),
	] );
}

if ( $post_type === 'post' ) {
	echo nicholas()->templates()->get_template( 'post', 'index', [
		'featured_image' => get_the_post_thumbnail(),
		'content'        => Nicholas::get_buffer( 'the_content' ),
		'title'          => Nicholas::get_buffer( 'the_title' ),
	] );
}
