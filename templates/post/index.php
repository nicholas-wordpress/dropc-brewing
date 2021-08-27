<?php
/**
 * Index Loop Template
 *
 * @author: Alex Standiford
 * @date  : 12/21/19
 * @var Theme\Abstracts\Template $template
 */

use function Nicholas\nicholas;

if ( ! nicholas()->templates()->is_valid_template( $template ) ) {
	return;
}

$title          = $template->get_param( 'title', '' );
$content        = $template->get_param( 'content', '' );
$featured_image = $template->get_param( 'featured_image', '' );
?>
<article x-data="theme.Post( typeof index === 'undefined' ? 0 : index )">
	<header class="pb-10 mb-10 border-b-4">
		<div class="relative h-56 overflow-hidden" id="featured-image" x-html="featuredImage">
			<?= $featured_image ?>
		</div>
		<h1 class="text-4xl pt-5 max-w-screen-lg mx-auto break-words" x-html="title"><?= $title ?></h1>
	</header>
	<div class="prose dark:prose-dark mx-auto max-w-screen-md" x-html="content"><?= $content ?></div>
</article>