<?php
/**
 * The template for displaying search forms.
 *
 * @package ThinkUpThemes
 */
?>
	<form method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<input type="text" class="search" name="s" value="<?php echo get_search_query(); ?>" placeholder="<?php esc_attr_e( 'Search', 'consulting' ) . ' &hellip;'; ?>" />
		<input type="submit" class="searchsubmit" name="submit" value="<?php esc_attr_e( 'Search', 'consulting' ); ?>" />
	</form>