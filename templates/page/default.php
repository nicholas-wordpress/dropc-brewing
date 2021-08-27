<?php
/**
 * Index Loop Template
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
<article x-data="theme.Post( typeof index === 'undefined' ? 0 : index )" x-html="content">
	<?= $template->get_param( 'content', '' ) ?>
</article>