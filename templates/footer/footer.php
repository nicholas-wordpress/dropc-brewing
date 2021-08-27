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

</div><!-- #content -->

<footer class="mt-10 text-white bg-black prose-dark w-full p-10 box-border">
	<div class="max-w-screen-lg mx-auto">
		<?php dynamic_sidebar( 'footer' ) ?>
		<small class="block w-full text-center">
			&copy; <?= date( 'Y' ) ?> <?= get_option( 'blogname' ) ?>
			<br/><em><?= get_option( 'blogdescription' ); ?></em>
		</small>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
