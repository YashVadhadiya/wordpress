<?php
/**
 * The template used for displaying hero content
 *
 * @package Signify
 */
?>

<?php

if ( $signify_id = get_theme_mod( 'signify_hero_content' ) ) {
	$args['page_id'] = absint( $signify_id );
}

// If $args is empty return false
if ( empty( $args ) ) {
	return;
}

// Create a new WP_Query using the argument previously created
$hero_query = new WP_Query( $args );
if ( $hero_query->have_posts() ) :
	while ( $hero_query->have_posts() ) :
		$hero_query->the_post();
		?>
		<div id="hero-section" class="hero-section section content-align-right text-align-left">
			<div class="wrapper">
				<div class="section-content-wrapper hero-content-wrapper">
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="hentry-inner">
							<?php $post_thumbnail = signify_post_thumbnail( 'post-thumbnail', 'html-with-bg', false ); 

						if ( $post_thumbnail ) :
							echo $post_thumbnail;
							?>
							<div class="entry-container">
						<?php else : ?>
							<div class="entry-container full-width">
						<?php endif; ?>
							<header class="entry-header">
								<h2 class="entry-title section-title">
									<?php the_title(); ?>
								</h2>
							</header><!-- .entry-header -->
							<div class="entry-content">
								<?php

									$show_content = get_theme_mod( 'signify_hero_content_show', 'excerpt' );

									if ( 'full-content' === $show_content ) {
										the_content();
									} elseif ( 'excerpt' === $show_content ) {
										the_excerpt();
									}

									wp_link_pages( array(
										'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'signify' ) . '</span>',
										'after'       => '</div>',
										'link_before' => '<span class="page-number">',
										'link_after'  => '</span>',
										'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'signify' ) . ' </span>%',
										'separator'   => '<span class="screen-reader-text">, </span>',
									) );
								?>
							</div><!-- .entry-content -->

							<?php if ( get_edit_post_link() ) : ?>
								<footer class="entry-footer">
									<div class="entry-meta">
										<?php
											edit_post_link(
												sprintf(
													/* translators: %s: Name of current post */
													esc_html__( 'Edit %s', 'signify' ),
													the_title( '<span class="screen-reader-text">"', '"</span>', false )
												),
												'<span class="edit-link">',
												'</span>'
											);
										?>
									</div>	<!-- .entry-meta -->
								</footer><!-- .entry-footer -->
							<?php endif; ?>
						</div><!-- .hentry-inner -->
					</article>
				</div><!-- .section-content-wrapper -->
			</div><!-- .wrapper -->
		</div><!-- .section -->
	<?php
	endwhile;

	wp_reset_postdata();
endif;
