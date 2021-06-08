<?php
/**
 * The template for displaying testimonial items
 *
 * @package Signify
 */

$signify_enable = get_theme_mod( 'signify_testimonial_option', 'disabled' );

if ( ! signify_check_section( $signify_enable ) ) {
	// Bail if featured content is disabled
	return;
}

$signify_title    = get_theme_mod( 'signify_testimonial_headline', esc_html__( 'Testimonials', 'signify' ) );
$signify_description = get_theme_mod( 'signify_testimonial_description' );

$signify_classes[] = 'section testimonial-content-section';

if ( ! $signify_title && ! $signify_description ) {
	$signify_classes[] = 'no-section-heading';
}
?>

<div id="testimonial-content-section" class="<?php echo esc_attr( implode( ' ', $signify_classes ) ); ?>">
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
		<?php endif;

		get_template_part( 'template-parts/testimonial/post-types-testimonial' );
	?>
	</div><!-- .wrapper -->
</div><!-- .testimonial-content-section -->
