<?php
/**
 * Index Loop Template
 *
 * @author: Alex Standiford
 * @date  : 12/21/19
 * @var Theme\Abstracts\Template $template
 */
use function Nicholas\nicholas;
use Nicholas\Nicholas;

if ( ! nicholas()->templates()->is_valid_template( $template ) ) {
	return;
}
?>
<aside id="comments" class="py-10 my-10 border-t-4" x-data="theme.Comments()">
	<div class="mx-auto max-w-screen-lg" x-html="$store.comments">
		<?php
		if ( Nicholas::use_compatibility_mode() ) {
			echo nicholas()->templates()->get_template( 'comments', 'comments' );
		}
		?>
	</div>
	<template x-if="true === isLoading">
		<div class="max-w-sm mx-auto p-4 box-border animate-pulse">
			<?= wp_get_attachment_image( get_theme_mod( 'custom_logo' ), 'full' ); ?>
			<p class="text-center text-3xl">loading comments...</p>
		</div>
	</template>
</aside>
