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
foreach ( [ 'page', 'post' ] as $type ): ?>
	<template x-if="$store.postType === <?= "'" . $type . "'" ?>">
		<?= nicholas()->templates()->get_template( $type, 'index' ) ?>
	</template>
<?php endforeach; ?>