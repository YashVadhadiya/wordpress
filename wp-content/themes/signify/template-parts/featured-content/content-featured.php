<?php
/**
 * The template for displaying featured posts on the front page
 *
 * @package Signify
 */
$number        = get_theme_mod( 'signify_featured_content_number', 3 );
$post_list     = array();
$no_of_post    = 0;

$args = array(
	'post_type'           => 'post',
	'ignore_sticky_posts' => 1, // ignore sticky posts.
);

	$args['post_type'] = 'page';

	for ( $i = 1; $i <= $number; $i++ ) {
		$signify_post_id = '';

		$signify_post_id = get_theme_mod( 'signify_featured_content_page_' . $i );

		if ( $signify_post_id && '' !== $signify_post_id ) {
			$post_list = array_merge( $post_list, array( $signify_post_id ) );

			$no_of_post++;
		}
	}

	$args['post__in'] = $post_list;
	$args['orderby']  = 'post__in';

if ( ! $no_of_post ) {
	return;
}

$args['posts_per_page'] = $no_of_post;

$loop = new WP_Query( $args );

while ( $loop->have_posts() ) :
	
	$loop->the_post();

	?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="hentry-inner">
			<?php signify_post_thumbnail( 'signify-featured-content' ); ?>

			<div class="entry-container">
				<header class="entry-header">
					<?php if ( 'post' === get_post_type() ) : ?>
					<div class="entry-meta">
						<?php signify_posted_on(); ?>

					</div><!-- .entry-meta -->
					<?php endif; ?>
					
					<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h2>' ); ?>
				</header>
				
				<div class="entry-summary"><?php the_excerpt(); ?></div><!-- .entry-summary -->
			</div><!-- .entry-container -->
		</div><!-- .hentry-inner -->
	</article>
<?php
endwhile;

wp_reset_postdata();
