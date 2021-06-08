<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package fairy
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <!-- for full single column card layout add [.card-full-width] class -->
    <div class="card card-blog-post card-full-width">
		 <?php fairy_post_thumbnail(); ?>
		 
		 <div class="card_body">
			<?php the_title( '<h1 class="card_title">', '</h1>' ); ?>
			
			<div class="entry-content">
				<?php
				the_content();

				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'fairy' ),
						'after'  => '</div>',
					)
				);
				?>
			</div><!-- .entry-content -->

				
			<?php if ( get_edit_post_link() ) : ?>
				<footer class="entry-footer">
					<?php
					edit_post_link(
						sprintf(
							wp_kses(
								/* translators: %s: Name of current post. Only visible to screen readers */
								__( 'Edit <span class="screen-reader-text">%s</span>', 'fairy' ),
								array(
									'span' => array(
										'class' => array(),
									),
								)
							),
							wp_kses_post( get_the_title() )
						),
						'<span class="edit-link">',
						'</span>'
					);
					?>
				</footer><!-- .entry-footer -->
			<?php endif; ?>

		 </div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
