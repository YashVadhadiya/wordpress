<?php
/**
 * The template for displaying testimonial items
 *
 * @package Signify
 */

$signify_number = get_theme_mod( 'signify_testimonial_number', 5 );

if ( ! $signify_number ) {
	// If number is 0, then this section is disabled
	return;
}
?>

<div class="testimonial-slider-wrapper">
	<div class="section-content-wrapper testimonial-content-wrapper testimonial-slider owl-carousel">
		<?php
			$signify_loop = new WP_Query( signify_testimonial_posts_args() );

			$thumbnails = array();

			if ( $signify_loop -> have_posts() ) :
				while ( $signify_loop -> have_posts() ) :
					$signify_loop -> the_post();

					if( has_post_thumbnail() ) {
						$thumbnails[] = get_the_post_thumbnail_url( null, array( 140, 140 ) );
					} else {
						$thumbnails[] = trailingslashit( esc_url( get_template_directory_uri() ) ) . 'images/no-thumb-140x140.jpg';
					} ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="hentry-inner">
							<div class="entry-container">
								<div class="entry-content">
									<?php the_excerpt(); ?>
								</div>

								<?php
								$position = get_theme_mod('signify_testimonial_position_' . ( absint ( $signify_loop->current_post ) + 1 ) ); ?>
									<header class="entry-header">
										<h2 class="entry-title"><a href=<?php the_permalink(); ?>><?php the_title(); ?></a></h2> <?php
										?>
										<?php if ( $position ) : ?>
											<p class="entry-meta"><span class="position">
												<?php echo esc_html( $position ); ?></span>
											</p>
										<?php endif; ?>
									</header>
							</div><!-- .entry-container -->
						</div><!-- .hentry-inner -->
					</article>
				<?php endwhile;
				wp_reset_postdata();
			endif;
		?>
	</div><!-- .section-content-wrapper -->
	
	<div class="testimonial-pagination">	
		<ul id='testimonial-dots' class='owl-dots'>
			<?php
				foreach ( $thumbnails as $thumb ) {
					echo '<li class="owl-dot"><img src="' . esc_url( $thumb ) . '"/></li>';
				}
			?>
		</ul>

		<ul id='testimonial-nav' class='owl-nav'>
		</ul>
	</div>	
</div>
