<?php
/**
 * Custom template tags for this theme.
 *
 * @package ThinkUpThemes
 */


/* ----------------------------------------------------------------------------------
	Display navigation to next/previous pages when applicable.
---------------------------------------------------------------------------------- */
if ( ! function_exists( 'consulting_thinkup_input_nav' ) ) :
function consulting_thinkup_input_nav( $nav_id ) {

global $wp_query, $post;

	// Don't print empty markup on single pages if there's nowhere to navigate.
	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}

	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;

	?>
	<nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>">
	<?php if ( is_single() ) : ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-icon"><i class="fa fa-angle-left fa-lg"></i></span><span class="meta-nav">' . __( 'Previous', 'consulting' ) . '</span>' ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', '<span class="meta-nav">' . __( 'Next', 'consulting' ) . '</span><span class="meta-icon"><i class="fa fa-angle-right fa-lg"></i></span>' ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php next_posts_link( __( 'Older posts', 'consulting') ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'consulting') ); ?></div>
		<?php endif; ?>

	<?php endif; ?>

	</nav><!-- #<?php echo esc_html( $nav_id ); ?> -->
	<?php

}
endif; 


/* ----------------------------------------------------------------------------------
	Display navigation to next/previous image when applicable.
---------------------------------------------------------------------------------- */
if ( ! function_exists( 'consulting_thinkup_input_imagesnav' ) ) :
function consulting_thinkup_input_imagesnav() {

global $wp_query, $post;
	?>

	<nav role="navigation" id="nav-below">
		<div class="nav-previous"><?php previous_image_link( 'false', '<span class="meta-icon"><i class="fa fa-angle-left fa-lg"></i></span><span class="meta-nav">' . __( 'Previous', 'consulting' ) . '</span>' ); ?></div>
		<div class="nav-next"><?php next_image_link( 'false', '<span class="meta-nav">' . __( 'Next', 'consulting' ) . '</span><span class="meta-icon"><i class="fa fa-angle-right fa-lg"></i></span>' ); ?></div>
	</nav><!-- #image-navigation -->

<?php

}
endif;


/* ----------------------------------------------------------------------------------
	Returns true if a blog has more than 1 category.
---------------------------------------------------------------------------------- */
function consulting_thinkup_input_categorizedblog() {
	if ( false === ( $consulting_thinkup_transient_categories = get_transient( 'consulting_thinkup_transient_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$consulting_thinkup_transient_categories = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$consulting_thinkup_transient_categories = count( $consulting_thinkup_transient_categories );

		set_transient( 'consulting_thinkup_transient_categories', $consulting_thinkup_transient_categories );
	}

	if ( '1' != $consulting_thinkup_transient_categories ) {
		return true;
	} else {
		return false;
	}
}

/* Flush out the transients used in consulting_thinkup_input_categorizedblog. */
function consulting_thinkup_input_transient_flusher() {
	delete_transient( 'consulting_thinkup_transient_categories' );
}
add_action( 'edit_category', 'consulting_thinkup_input_transient_flusher' );
add_action( 'save_post', 'consulting_thinkup_input_transient_flusher' );