<?php
/**
 * Header Template
 *
 * @author: Alex Standiford
 * @date  : 12/21/19
 * @var Theme\Abstracts\Template $template
 */

use function Nicholas\nicholas;

if ( ! nicholas()->templates()->is_valid_template( $template ) ) {
	return;
}
?>
<div class="fixed w-full h-full bg-white top-0 left-0" x-show="$store.isLoading" x-transition>
	<div class="centered max-w-sm p-4 box-border animate-pulse">
		<?= wp_get_attachment_image( get_theme_mod( 'custom_logo' ), 'full' ); ?>
		<p class="text-center text-3xl">loading...</p>
	</div>
</div>