<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package fairy
 */

if ( ! is_active_sidebar( 'sidebar-shop' ) ) {
	return;
}
?>

<aside class="widget-area">
	<?php dynamic_sidebar( 'sidebar-shop' ); ?>
</aside><!-- #secondary -->
