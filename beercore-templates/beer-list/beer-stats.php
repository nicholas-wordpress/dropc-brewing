<?php
if ( ! isset( $template ) || ! $template instanceof Beer_Lister\Blocks\Beer_List ) {
	return;
}
$beer = $template->get_param( 'beer', false );

$style = get_beer_style( $beer );

if ( is_wp_error( $style ) ) {
	$style = '';
	$link  = '';
} else {
	$link  = get_term_link( $style );
	$style = $style->name;
}


if ( false === $beer ) {
	return;
}
?>
<dl class="beer-stats">
	<dt><?= beer()->__( 'ABV' ) ?>:</dt>
	<dd><?= get_beer_abv( $beer->ID ) ?></dd>
	<dt><?= beer()->__( 'IBU' ) ?>:</dt>
	<dd><?= get_beer_ibu( $beer->ID ) ?></dd>
	<dt><?= beer()->__( 'Style' ) ?>:</dt>
	<?php if ( ! is_wp_error( $style ) ): ?>
		<dd><?= $style ?></dd>
	<?php endif; ?>
</dl>
