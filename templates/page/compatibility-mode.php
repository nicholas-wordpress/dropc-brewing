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
	<?php if ( get_page_template_slug() === '' ): ?>
		<?= $template->get_template( 'default', $template->get_params() ) ?>
	<?php else: ?>
		<?= $template->get_template( 'document', $template->get_params() ) ?>
	<?php endif; ?>
</div>