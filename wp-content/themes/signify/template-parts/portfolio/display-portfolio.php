<?php
/**
 * The template for displaying portfolio items
 *
 * @package Signify
 */
?>

<?php
$enable = get_theme_mod( 'signify_portfolio_option', 'disabled' );

if ( ! signify_check_section( $enable ) ) {
	// Bail if portfolio section is disabled.
	return;
}

$signify_title       = get_theme_mod( 'signify_portfolio_title' );
$signify_description = get_theme_mod( 'signify_portfolio_description' );
?>

<div id="portfolio-content-section" class="section portfolio-section section-boxed<?php echo ( ! $signify_title && ! $signify_description ) ? ' no-section-heading' : ''; ?>">
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

		<div class="section-content-wrapper layout-three">
			<div class="grid">
				<?php
					get_template_part( 'template-parts/portfolio/post-types', 'portfolio' );
				?>
			</div>
		</div><!-- .section-content-wrap -->
	</div><!-- .wrapper -->
</div><!-- #portfolio-section -->
