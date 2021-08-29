<?php

if ( ! isset( $template ) || ! $template instanceof Beer_Lister\Blocks\Beer_List ) {
	return;
}

$beer = $template->get_param( 'beer', false );

if ( false === $beer ) {
	return;
}

?>
<article>
	<?= $template->get_template( 'srm-icon', [ 'beer' => $beer ] ) ?>
	<div class="beer-info">
		<h3 class="text-2xl"><a class="text-red-500 hover:text-red-300 underline" href="<?= get_post_permalink( $beer->ID ) ?>"><?= get_the_title( $beer->ID ) ?></a></h3>
		<?= $template->get_template( 'on-tap-badge', [ 'beer' => $beer ] ); ?>
		<em><?= get_the_excerpt( $beer->ID ) ?></em>
		<?= $template->get_template( 'beer-stats', [ 'beer' => $beer ] ) ?>
	</div>
</article>

