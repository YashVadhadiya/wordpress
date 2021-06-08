<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package deep
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php deep_theme_post_thumbnail(); ?>

		<div class="entry-meta deep-theme-blog-meta">

			<div class="deep-theme-post-meta">

				<div class="deep-theme-post-meta-date">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="10"><path d="M400 64h-48V12c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v52H160V12c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v52H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V112c0-26.5-21.5-48-48-48zm-6 400H54c-3.3 0-6-2.7-6-6V160h352v298c0 3.3-2.7 6-6 6z"/></svg>
					<span class="post-date"><?php echo esc_html( get_the_date() ); ?></span>
				</div>

				<div class="deep-theme-post-meta-category">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="12"><path d="M464 128H272l-54.63-54.63c-6-6-14.14-9.37-22.63-9.37H48C21.49 64 0 85.49 0 112v288c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V176c0-26.51-21.49-48-48-48zm0 272H48V112h140.12l54.63 54.63c6 6 14.14 9.37 22.63 9.37H464v224z"/></svg>
					<span class="post-category"><?php echo esc_html( the_category(', ') ); ?></span>
				</div>

				<div class="deep-theme-post-meta-comments">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="11"><path d="M448 0H64C28.7 0 0 28.7 0 64v288c0 35.3 28.7 64 64 64h96v84c0 7.1 5.8 12 12 12 2.4 0 4.9-.7 7.1-2.4L304 416h144c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64zm16 352c0 8.8-7.2 16-16 16H288l-12.8 9.6L208 428v-60H64c-8.8 0-16-7.2-16-16V64c0-8.8 7.2-16 16-16h384c8.8 0 16 7.2 16 16v288z"/></svg>
					<span class="blog-comments"><a href="<?php echo esc_url( get_comments_link() );?>"><?php comments_number(  ); ?></a></span>
				</div>

			</div>

		</div><!-- .entry-meta -->

	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif; ?>


	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php

		if ( is_single() ) {
			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'deep' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'deep' ),
					'after'  => '</div>',
				)
			);

			// Display Tags
			$tags = the_tags('<div class="deep-theme-tags">'. esc_html__( 'Tags', 'deep' ) .': ',', ','</div>');

			if ( $tags ) {
				wp_kses_post($tags);
			}


		} else {
			wp_kses_post( the_excerpt() );
			?>
			<a class="more-link" href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_html__( 'Continue Reading', 'deep' ); ?></a>
			<?php

		}

		?>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
