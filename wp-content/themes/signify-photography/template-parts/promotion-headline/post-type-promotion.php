<?php
/**
 * The template used for displaying promotion headline
 *
 * @package Signify_Photography
 */

$signify_id = get_theme_mod( 'signify_promotion_headline' );
$signify_args['page_id'] = absint( $signify_id );


// If $signify_args is empty return false
if ( empty( $signify_args ) ) {
	return;
}

// Create a new WP_Query using the argument previously created
$promotion_headline_query = new WP_Query( $signify_args );
if ( $promotion_headline_query->have_posts() ) :
	while ( $promotion_headline_query->have_posts() ) :
		$promotion_headline_query->the_post();
		
		$signify_title       = get_theme_mod( 'signify_promotion_headline_title' );

		?>

		<div id="promotion-section" class="section promotion-section content-align-center text-align-center content-frame promotion-headline-one">
			<div class="wrapper">
				<div class="section-content-wrapper">
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="hentry-inner">
							<?php signify_post_thumbnail( 'signify-promotion-headline', 'html-with-bg' ); // signify_post_thumbnail( $image_size, $signify_type = 'html', $echo = true, $no_thumb = false ). ?>

							<div class="content-wrapper">
								<div class="entry-container">
									<div class="entry-container-frame">
										<header class="entry-header section-title-wrapper">
											<?php the_title( '<h2 class="section-title">', '</h2>' ); ?>
										</header><!-- .entry-header -->
										
										<?php
										$show_content = get_theme_mod( 'signify_promo_head_show', 'excerpt' ); ?>

											<div class="entry-summary">
												<?php the_excerpt(); ?>
											</div><!-- .entry-summary -->

									</div><!-- .entry-container-frame -->
								</div><!-- .entry-container -->
							</div><!-- .content-wrapper -->
						</div><!-- .hentry-inner -->
					</article><!-- #post-## -->
				</div><!-- .section-content-wrapper -->
			</div><!-- .wrapper -->
		</div><!-- .section -->
	<?php
	endwhile;
	wp_reset_postdata();
endif;
