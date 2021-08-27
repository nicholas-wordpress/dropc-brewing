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
?>
<main id="content">
	<?php
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			if ( is_singular() ) {
				echo $template->get_template( 'singular' );
				if ( comments_open() ) {
					echo nicholas()->templates()->get_template( 'index', 'comments' );
				}
			} else {
				echo $template->get_template( 'archive' );
			}
		}
		if ( ! is_singular() ) {
			echo nicholas()->templates()->get_template( 'index', 'archive-pagination', [
				'pagination' => Nicholas::get_buffer( 'the_posts_pagination' ),
			] );
		}
	}
	?>
</main>
