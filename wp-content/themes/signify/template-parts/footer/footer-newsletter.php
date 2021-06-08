<?php
/**
 * Displays footer widgets if assigned
 *
 * @package Signify
 */

if ( ! is_active_sidebar( 'sidebar-newsletter' ) ) {
	// Bail if there is no widget in newsletter sidebar.
	return;
}

?>

<aside id="footer-newsletter" class="widget-area" role="complementary">
	<div class="wrapper">
		<div class="footer-newsletter">
			<?php dynamic_sidebar( 'sidebar-newsletter' ); ?>
		</div>
	</div><!-- .wrapper -->
</aside><!-- .widget-area -->
