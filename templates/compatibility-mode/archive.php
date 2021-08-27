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

$comment_count = get_comment_count();

echo nicholas()->templates()->get_template( 'index', 'archive-post', [
	'excerpt'        => Nicholas::get_buffer( 'the_excerpt' ),
	'title'          => Nicholas::get_buffer( 'the_title' ),
	'link'           => get_post_permalink(),
	'featured_image' => get_the_post_thumbnail(),
	'last_updated'   => Nicholas::get_buffer( 'the_modified_date' ),
	'comment_count'  => get_approved_comment_count( get_the_ID() ),
	'author'         => get_the_author_meta( 'display_name' ),
	'author_url'     => get_the_author_meta('url')
] );
