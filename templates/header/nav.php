<?php
/**
 * Navigation Template
 *
 * @author: Alex Standiford
 * @date  : 12/21/19
 * @var Underpin_Templates\Abstracts\Template $template
 */

use function Nicholas\nicholas;

if ( ! nicholas()->templates()->is_valid_template( $template ) ) {
	return;
}

?>
<header id="navigation">
	<div class="flex justify-between h-28 items-center px-12 text-white bg-black">
		<?= get_custom_logo() ?>
		<?php
		wp_nav_menu( [
			'theme_location' => 'primary',
			'depth'          => 1,
			'container'      => 'nav',
			'menu_class'     => 'flex justify-end',
		] );
		?>
	</div>
</header>
