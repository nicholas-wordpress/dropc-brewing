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
<div>
	<template x-data="theme.Post()" x-if="template === ''">
		<?= $template->get_template( 'default', $template->get_params() ) ?>
	</template>

	<template x-data="theme.Post()" x-if="template === 'document'">
		<?= $template->get_template( 'document', $template->get_params() ) ?>
	</template>
</div>