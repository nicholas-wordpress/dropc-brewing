<?php
/**
 * Header Template
 *
 * @author: Alex Standiford
 * @date  : 12/21/19
 * @var Underpin_Templates\Abstracts\Template $template
 */

use Nicholas\Nicholas;
use function Nicholas\nicholas;

if ( ! nicholas()->templates()->is_valid_template( $template ) ) {
	return;
}

?>
<!doctype html>
<html <?php language_attributes(); ?> x-data>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head() ?>
</head>
<body :class="$store.bodyClass">
<?= false === Nicholas::use_compatibility_mode() ? $template->get_template( 'loading-wrapper' ) : ''; ?>
<?php wp_body_open() ?>
<?= $template->get_template( 'noscript' ) ?>
<?= $template->get_template( 'nav' ) ?>
<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'sandbox' ); ?></a>
<div id="content" class="site-content">