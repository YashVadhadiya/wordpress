<?php
/**
 * The template for displaying service content
 *
 * @package Signify
 */
?>

<?php
$enable_content = get_theme_mod( 'signify_service_option', 'disabled' );

if ( ! signify_check_section( $enable_content ) ) {
	// Bail if service content is disabled.
	return;
}

$signify_title       = get_theme_mod( 'signify_service_title' );
$signify_description = get_theme_mod( 'signify_service_description' );

$classes[] = 'service-section';
$classes[] = 'section';

if ( ! $signify_title && ! $signify_description ) {
	$classes[] = 'no-section-heading';
}
?>

<div id="service-section" class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>">
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

		<div class="section-content-wrapper service-content-wrapper layout-three">
			<?php
				get_template_part( 'template-parts/service/content-service' );			
			?>
		</div><!-- .service-wrapper -->
	</div><!-- .wrapper -->
</div><!-- #service-section -->
