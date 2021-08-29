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
	<div class="flex flex-col lg:flex-row text-center lg:text-left justify-between h-28 items-center px-12 text-white bg-black">
		<div>
			<a href="/" class="block font-serif text-3xl"><?= get_bloginfo( 'name' ) ?></a>
			<em class="block"><?= get_bloginfo( 'description' ) ?></em>
		</div>
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
