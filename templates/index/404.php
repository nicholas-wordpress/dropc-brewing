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

?>
<main id="content" class="max-w-screen-md mx-auto pt-20">
	<h1 class="text-3xl">404 - Page Not Found</h1>
	<p>The page you are trying to visit could not be found.</p>
</main>