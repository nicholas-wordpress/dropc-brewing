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

$title          = $template->get_param( 'title', '' );
$excerpt        = $template->get_param( 'excerpt', '' );
$url            = $template->get_param( 'link', '' );
$featured_image = $template->get_param( 'featured_image', '' );
$comment_count  = $template->get_param( 'comment_count', 0 );
$author         = $template->get_param( 'author', '' );
$author_url     = $template->get_param( 'author_url', '' );
$last_updated   = $template->get_param( 'last_updated', '' );

// No need to parse this if compatibility mode is not set.
if ( Nicholas::use_compatibility_mode() ) {
	if ( $comment_count <= 0 || ! comments_open() ) {
		$comment_count = 'No Comments';
	} elseif ( $comment_count === 1 ) {
		$comment_count = '1 Comment';
	} else {
		$comment_count = $comment_count . 'Comments';
	}

	$author = 'By ' . $author;
}

?>
<article class="mx-auto max-w-screen-md my-20 p-5 border-2 box-border" x-data="theme.Post(index)">
	<header class="mb-5">
		<h2 class="text-4xl break-words">
			<a class="text-red-500" x-html="title" x-bind:href="link" href="<?= $url ?>"><?= $title ?></a>
		</h2>
		<div class="flex divide-x divide-gray-500 divide-solid text-sm text-gray-500">
			<span class="pr-2">Last Updated on <time x-text="lastUpdated"><?= $last_updated ?></time></span>
			<a href="<?= $author_url ?>" class="px-2" x-data="author" x-bind:href="link" x-text="`By ${fullName}`"><?= $author ?></a>
			<a class="pl-2" x-bind:href="`${link}#comments`" x-text="commentText"><?= $comment_count ?></a>
		</div>
	</header>
	<div class="flex gap-2 flex-col-reverse md:flex-row mt-5">
		<div class="w-full">
			<div class="excerpt" x-html="excerpt"><?= $excerpt ?></div>
			<div class="wp-block-button mt-5">
				<a x-bind:href="link" href="<?= $url ?>" class="wp-block-button__link no-border-radius">
					Read More
				</a>
			</div>
		</div>

		<?php if ( Nicholas::use_compatibility_mode() && ! empty( $featured_image ) ): ?>
			<div class="flex-shrink w-full md:w-96 max-w-full"><?= $featured_image ?></div>
		<?php endif; ?>

		<?php if ( ! Nicholas::use_compatibility_mode() ): ?>
			<div x-show="featuredImage" class="flex-shrink w-full md:w-96 max-w-full" x-html="featuredImage"></div>
		<?php endif; ?>
	</div>
</article>