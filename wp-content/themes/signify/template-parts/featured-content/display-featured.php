<?php
/**
 * The template for displaying featured content
 *
 * @package Signify
 */
?>

<?php
$enable_content = get_theme_mod( 'signify_featured_content_option', 'disabled' );

if ( ! signify_check_section( $enable_content ) ) {
	// Bail if featured content is disabled.
	return;
}

$classes[] = 'layout-three';
$classes[] = 'page';
$classes[] = 'section';

$signify_title       = get_theme_mod( 'signify_featured_content_title' );
$signify_description = get_theme_mod( 'signify_featured_content_description' );

if ( ! $signify_title && ! $signify_description ) {
	$classes[] = 'no-section-heading';
}
?>

<div id="featured-content-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
	<div class="wrapper">
		<?php if ( $signify_title || $signify_description ) : ?>
			<div class="section-heading-wrapper">
				<?php if ( $signify_title ) : ?>
					<div class="section-title-wrapper">
						<h2 class="section-title"><?php echo wp_kses_post( $signify_title ); ?></h2>
					</div><!-- .section-title-wrapper -->
				<?php endif; ?>

				<?php if ( $signify_description ) : ?>
					<div class="section-description">
						<p><?php echo wp_kses_post( $signify_description ); ?></p>
					</div><!-- .section-description-wrapper -->
				<?php endif; ?>
			</div><!-- .section-heading-wrapper -->
		<?php endif; ?>

		<div class="section-content-wrapper featured-content-wrapper layout-three">
			<?php
			get_template_part( 'template-parts/featured-content/content-featured' );
			?>
		</div><!-- .section-content-wrap -->
	</div><!-- .wrapper -->
</div><!-- #featured-content-section -->
