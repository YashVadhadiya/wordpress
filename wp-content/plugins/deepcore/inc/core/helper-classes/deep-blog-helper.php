<?php
defined( 'ABSPATH' ) || exit;

/**
 * Blog Helper.
 *
 * @package deep
 * @since   1.0.0
 * @author  Webnus
 */
class Deep_Blog_Helper {
	/**
	 * Get post thumbnail.
	 *
	 * @since   1.0.0
	 */
	public static function thumbnail( $post ) {
		$deep_options = deep_options();
		$enable_single_fimage = deep_get_option( $deep_options, 'deep_blog_sinlge_featuredimage_enable', '1' );

		if ( 'video' == get_post_format( get_the_ID() ) || 'audio' == get_post_format( get_the_ID() ) ) {
			$pattern = '\\[' . '(\\[?)' . '(video|audio)' . '(?![\\w-])' . '(' . '[^\\]\\/]*' . '(?:' . '\\/(?!\\])' . '[^\\]\\/]*' . ')*?' . ')' . '(?:' . '(\\/)' . '\\]' . '|' . '\\]' . '(?:' . '(' . '[^\\[]*+' . '(?:' . '\\[(?!\\/\\2\\])' . '[^\\[]*+' . ')*+' . ')' . '\\[\\/\\2\\]' . ')?' . ')' . '(\\]?)';
			preg_match('/'.$pattern.'/s', $post->post_content, $matches);
			if ( ( is_array( $matches ) ) && ( isset( $matches[3] ) ) && ( ( $matches[2] == 'video' ) || ( 'audio' == get_post_format( get_the_ID() ) ) ) && ( isset( $matches[2] ) ) ) {
				$video = $matches[0];
				echo do_shortcode( $video );
				$content = get_the_content();
				$content = preg_replace( '/' . $pattern . '/s', '', $content );
			} elseif ( ! empty( rwmb_meta( 'deep_featured_video_meta' ) ) ) {
				echo do_shortcode( rwmb_meta( 'deep_featured_video_meta' ) );
			}
		} elseif ( 'gallery' == get_post_format( get_the_ID() ) ) {
			if ( has_block( 'gallery', $post->post_content ) ) {
				$blocks = parse_blocks( get_the_content() );
				foreach ( $blocks as $block ) {
					if ( $block['blockName'] == 'core/gallery' ) {
						wp_kses_post( $block['innerHTML'] );
					}
				}
			}
		} elseif ( ( ! empty( rwmb_meta( 'deep_featured_video_meta' ) ) ) ) {
			echo do_shortcode( rwmb_meta( 'deep_featured_video_meta' ) );
		} else {
			if ( $enable_single_fimage == '0' ) {
				return;
			}
			?>
			<figure class="single-featured-image image-id-<?php echo get_post_thumbnail_id(); ?>">
				<?php get_the_image( array(
					'meta_key'     => array( 'Full', 'Full' ),
					'size'         => 'Full',
					'link_to_post' => false,
				) ); ?>
			</figure>
			<?php
		}
	}

	/**
	 * Get post title.
	 *
	 * @since   1.0.0
	 */
	public static function title( $post_id = null, $html_tag = 'h1' ) {
		$post_id = $post_id ? $post_id : get_the_ID();

		echo '<' . $html_tag . ' class="post-title deep-post-title">';
			if ( ! is_single() ) {
				echo '<a class="post-title deep-post-title-link" href="' . esc_url( get_the_permalink( $post_id ) ) . '" title="' . esc_attr( get_the_title( $post_id ) ) . '">';
					echo wp_kses( get_the_title( $post_id ), 'post' );
				echo '</a>';
			} else {
				echo wp_kses( get_the_title( $post_id ), 'post' );
			}
		echo '</' . $html_tag . '>';
	}

	/**
	 * Get post excerpt.
	 *
	 * @since   1.0.0
	 */
	public static function excerpt( $post_id = null, $limit = 25 ) {
		$post_id = $post_id ? $post_id : get_the_ID();
		$excerpt = explode( ' ', get_the_excerpt( $post_id ), $limit );

		if ( count( $excerpt ) >= $limit ) {
			array_pop( $excerpt );
			$excerpt = implode( ' ', $excerpt ) . '...';
		} else {
			$excerpt = implode( ' ', $excerpt );
		}

		$excerpt = preg_replace( '`\[[^\]]*\]`', '', $excerpt );
		echo '<p class="deep-post-excerpt">' . $excerpt . '</p>';
	}

	/**
	 * Get post read more.
	 *
	 * @since   1.0.0
	 */
	public static function read_more( $post_id = null, $text = null ) {
		$post_id = $post_id ? $post_id : get_the_ID();
		$text    = $text ? $text : esc_html__( 'Read More', 'deep' );

		echo '<a class="deep-post-read-more" href="' . esc_url( get_permalink( $post_id ) ) . '">' . esc_html( $text ) . '</a>';
	}

	/**
	 * Get post categories.
	 *
	 * @since   1.0.0
	 */
	public static function categories( $post_id = null, $separator = ' ' ) {
		$output          = [];
		$post_id         = $post_id ? $post_id : get_the_ID();
		$post_categories = get_the_category( $post_id );

		if ( $post_categories ) {
			foreach ( $post_categories as $post_category ) {
				$output[] = '<a href="' . esc_url( get_category_link( $post_category ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'deep' ), $post_category->name ) ) . '">' . esc_html( $post_category->name ) . '</a>';
			}
			if ( $output ) {
				echo '<span class="deep-category-links">' . implode( $separator, $output ) . '</span>';
			}
		}
	}

	/**
	 * Get post-date/time.
	 *
	 * @since   1.0.0
	 */
	public static function date( $post_id = null, $date_format = null ) {
		$post_id     = $post_id ? $post_id : get_the_ID();
		$time_string = sprintf(
			'<time datetime="%1$s">%2$s</time>',
			esc_attr( get_the_date( DATE_W3C, $post_id ) ),
			esc_html( get_the_date( $date_format, $post_id ) )
		);

		echo '
		<span class="deep-post-metadata-date">
			<a href="' . esc_url( get_permalink( $post_id ) ) . '" rel="bookmark">' . $time_string . '</a>
		</span>';
	}

	/**
	 * Get post-date/time.
	 *
	 * @since   1.0.0
	 */
	public static function time( $post_id = null ) {
		$post_id = $post_id ? $post_id : get_the_ID();
		echo get_post_time( 'g:i a', true, $post_id, false );
	}

	/**
	 * Get post comments number.
	 *
	 * @since   1.0.0
	 */
	public static function comments_number( $post_id = null, $no_comments = null, $one_comment = null ) {
		$post_id = $post_id ? $post_id : get_the_ID();

		if ( comments_open( $post_id ) || get_comments_number( $post_id ) ) {
			echo '
			<span class="deep-post-metadata-comments-number">
				<span>';
					comments_number( $no_comments, $one_comment, '% Comments' );
				echo '
				</span>
			</span>';
		}
	}

	/**
	 * Get comments.
	 *
	 * @since   1.0.0
	 */
	public static function comments( $post_id = null ) {
		$post_id = $post_id ? $post_id : get_the_ID();

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open( $post_id ) || get_comments_number( $post_id ) ) {
			comments_template();
		}
	}

	/**
	 * Get latest post ID.
	 *
	 * @since   1.0.0
	 */
	public static function latest_post_id() {
		if ( is_singular( 'post' ) ) {
			return;
		}

		$latest_post = get_posts( 'posts_per_page=1&post_type=post' );
		return $latest_post[0]->ID;
	}

	/**
	 * socials.
	 *
	 * @since   1.0.0
	 */
	public static function socials( $social ) {
		if( $social == 1 ) {
			deep_social_share( get_the_id() );
		}
	}

	/**
	 * Jetpack socials.
	 *
	 * @since   1.0.0
	 */
	public static function jeptpack_socials() {
		if ( is_plugin_active( 'jetpack/jetpack.php' ) ) :  ?>
			<div class="wn-jeptpack-socials">
				<?php if ( !empty (  get_theme_mod( 'jetpack-facebook' ) ) ) : ?>
					<a href="<?php echo esc_url( get_theme_mod( 'jetpack-facebook' ) ); ?>">
						<?php _e( 'Facebook', 'deep' ); ?>
					</a>
				<?php endif; ?>
				<?php if ( !empty (  get_theme_mod( 'jetpack-twitter' ) ) ) : ?>
					<a href="<?php echo esc_url( get_theme_mod( 'jetpack-twitter' ) ); ?>">
						<?php _e( 'Twitter', 'deep' ); ?>
					</a>
				<?php endif; ?>
				<?php if ( !empty (  get_theme_mod( 'jetpack-linkedin' ) ) ) : ?>
					<a href="<?php echo esc_url( get_theme_mod( 'jetpack-linkedin' ) ); ?>">
						<?php _e( 'Linkedin', 'deep' ); ?>
					</a>
				<?php endif; ?>
				<?php if ( !empty (  get_theme_mod( 'jetpack-google_plus' ) ) ) : ?>
					<a href="<?php echo esc_url( get_theme_mod( 'jetpack-google_plus' ) ); ?>">
						<?php _e( 'Google+', 'deep' ); ?>
					</a>
				<?php endif; ?>
				<?php if ( !empty (  get_theme_mod( 'jetpack-tumblr' ) ) ) : ?>
					<a href="<?php echo esc_url( get_theme_mod( 'jetpack-tumblr' ) ); ?>">
						<?php _e( 'Tumblr', 'deep' ); ?>
					</a>
				<?php endif; ?>
			</div>
		<?php endif;
	}

	/**
	 * Post Content.
	 *
	 * @since   1.0.0
	 */
	public static function content( $post_format ) {
		if( 'quote' == $post_format  ) :
			echo '<blockquote>';
		endif;

		echo apply_filters( 'the_content', get_the_content() );

		if( 'quote' == $post_format  ) :
			echo '</blockquote>';
		endif;
	}

	/**
	 * Get Post Tags.
	 *
	 * @since   1.0.0
	 */
	public static function tags( $post_id = null ) {
		$post_id   = $post_id ? $post_id : get_the_ID();
		$tags_list = get_the_tag_list( '', ' ', '', $post_id );

		if ( $tags_list ) {
			/* translators: 1: list of tags. */
			printf( '<div class="post-tags"><i class="wn-fa wn-fa-tags"></i>' . esc_html__( '%1$s', 'deep' ) . '</div>', $tags_list );
		}
	}

	/**
	 * Get Post Author.
	 *
	 * @since   1.0.0
	 */
	public static function author( $post_id = null, $show_author = '1', $show_avatar = '1' ) {
		$post_id   = $post_id ? $post_id : get_the_ID();
		$author_id = get_post_field( 'post_author', $post_id );
		$avatar    = $show_avatar ? get_avatar( $author_id, '35' ) : '';
		if ( $show_author ) { ?>
			<div class="au-avatar-box">
				<a href="<?php echo esc_url( get_author_posts_url( $author_id ) ); ?>">
					<div class="au-avatar">
						<p class="deep-post-metadata-author">
							<?php echo wp_kses( $avatar, wp_kses_allowed_html('post') ); ?>
							<?php echo wp_kses( get_the_author_meta( 'nickname', $author_id ), wp_kses_allowed_html('post') ); ?>
						</p>
					</div>
				</a>
			</div>
		<?php
		}
	}

	/**
	 * Get Post Author Box.
	 *
	 * @since   1.0.0
	 */
	public static function author_box( $enable_single_authorbox, $type = 0, $author_position = null ) {
		if ( $enable_single_authorbox  ) :
			if( $type == 0 ) { ?>
				<div class="about-author-sec">
					<?php echo get_avatar( get_the_author_meta( 'user_email' ), 90 ); ?>
					<h5><?php the_author_posts_link(); ?></h5>
					<?php echo $author_position ? '<h6>' . esc_html( $author_position ) . '</h6>' : ''; ?>
					<p><?php echo get_the_author_meta( 'description' ); ?></p>
				</div>
			<?php } else { ?>
				<div class="about-author-sec-ps3">
					<div class="blue-sec">
						<div>
							<h5><?php the_author_posts_link(); ?></h5>
							<?php echo $author_position ? '<h6>' . esc_html( $author_position ) . '</h6>' : ''; ?>
						</div>
					</div>
					<?php echo get_avatar( get_the_author_meta( 'user_email' ), 275 ); ?>
					<p><?php echo get_the_author_meta( 'description' ); ?></p>
				</div>
			<?php }
		endif;
	}

	/**
	 * Get Post Author Review.
	 *
	 * @since   1.0.0
	 */
	public static function post_review() {
		$reviews	 		= rwmb_meta( 'deep_blogpost_review' );
		$total_vots			= 0;
		$total_rates		= 0;
		$stars				= '';
		$item_empty_stars	= '';
		$item_full_stars	= '';
		$out				= ''; ?>
		<ul class="wn-review-section">
			<?php
			if ( $reviews ) {
				foreach ( $reviews as $item ) {
					if ( !empty( $item['0'] ) and !empty( $item['1'] ) ) {
						// All Empty stars
						for ( $i=0; $i < 5; $i++ ) {
							$item_empty_stars .= '<i class="wn-far wn-fa-star"></i>';
						}
						// All full stars
						for ( $i=0; $i < $item['1']; $i++ ) {
							$item_full_stars .= '<i class="wn-fas wn-fa-star full-stars"></i>';
						}
						$total_vots = $total_vots + round( $item['1'] );
						$total_rates++; ?>
						<li class="review-item" >
							<div class="title-review"><?php echo wp_kses( $item['0'], wp_kses_allowed_html( 'post' ) ) ?></div>
							<div class="post-review-rating">
								<span class="item-empty-stars"><?php echo wp_kses( $item_empty_stars, wp_kses_allowed_html( 'post' ) ) ?></span>
								<span class="item-full-stars"><?php echo wp_kses( $item_full_stars, wp_kses_allowed_html( 'post' ) ) ?></span>
							</div>
							<div class="clearfix"></div>
						</li>
						<?php
						$item_empty_stars = $item_full_stars = '';
					}
				}
			}
			if ( $total_vots != 0 && $total_rates != 0 ) {

				$average	= $total_vots / $total_rates;
				$decimals	=  explode( '.', $average ); ?>

				<!-- stars wrap -->
				<li class="wn-average-stars">
					<span class="average"><?php esc_html__( 'Average', 'deep' ) ?></span>
					<div class="post-review-rating">
						<div class="average-number"><?php echo $average ?></div>
						<!-- empty stars -->
						<div class="wn-empty-stars">
							<?php for ( $i = 0; $i < 5; $i++ ) { ?>
								<i class="wn-far wn-fa-star"></i>
							<?php } ?>
						</div>

						<!-- full stars -->
						<div class="item-full-stars">
							<?php for ( $i = 0; $i < $decimals['0']; $i++ ) { ?>
								<i class="wn-fas wn-fa-star full-stars"></i>
							<?php }

							// half stars
							if ( ! empty( $decimals['1'] ) ) :
								if ( $decimals['1'] <= 5 ) { ?>
									<i class="wn-fas wn-fa-star-half half-stars"></i>
								<?php } elseif ( $decimals['1'] > 5 ) { ?>
									<i class="wn-fas wn-fa-star"></i>
								<?php }
							endif; ?>

						</div>
					</div>
					<div class="clearfix"></div>
				</li> <!-- wn-post-stars -->
			<?php } ?>
		</ul><!-- end wn-review-section -->
		<?php
	}

	/**
	 * Get User Rates.
	 *
	 * @since   1.0.0
	 */
	public static function user_rateing( $user_rating ) {
		if ( $user_rating == '1' ) :
			if ( is_plugin_active( 'post-ratings/post-ratings.php' ) ) { ?>
				<ul class="sinlge-review-row" data-post="<?php  get_the_ID(); ?>">
					<?php
					wp_enqueue_style( 'deep-blog-review', DEEP_ASSETS_URL . 'css/frontend/blog/review.css', false, DEEP_VERSION );
					global $post;
					$post_rating = new Post_Ratings;
					$base = post_ratings_get_rating( $post->ID );
					$rating = $base['rating'];
					$votes = $base['votes'];
					$bayesian_rating = $base['bayesian_rating'];
					$max_rating = $base['max_rating'];
					?>
					<div class="post-ratings" data-post="<?php the_ID(); ?>">
						<li>
							<div class="rating-meta">
								<?php
								printf( _n( '%2$s avg. rating (%3$s%% score) - %1$s vote', '%2$s avg. rating (%3$s%% score) - %1$s votes', $votes, 'post-ratings' ), sprintf( '<strong class="votes">%d</strong>', $votes ), sprintf( '<strong>%.2F</strong>', $rating ), sprintf( '<strong>%d</strong>', $bayesian_rating ) );
								?>
							</div>
						</li>
						<li>
							<div class="rating" data-post="<?php the_ID(); ?>" data-rating="<?php echo esc_attr( $rating ); ?>" data-readonly="<?php echo (int) ! $post_rating->current_user_can_rate( get_the_ID() ); ?>"></div>
						</li>
					</div>
				</ul><?php
			}
		endif;
	}

	/**
	 * Get post Meta Data.
	 *
	 * @since   1.0.0
	 */
	public static function post_meta_data( $enable_date_meta , $enable_category_meta , $enable_comments_meta , $enable_views_meta ) { ?>
		<?php if( $enable_date_meta || $enable_category_meta || $enable_comments_meta || $enable_views_meta ) { ?>
			<div class="postmetadata">
				<?php if( $enable_date_meta ){?>
					<h6 class="blog-date">
						<i class="ti-calendar"></i>
						<?php the_time(get_option( 'date_format' )) ?>
					</h6>
				<?php } if( $enable_category_meta ){ ?>
					<h6 class="blog-cat">
						<i class="ti-folder"></i>
						<?php the_category(', '); deep_category_color(); ?>
					</h6>
				<?php } if( $enable_comments_meta ){ ?>
					<h6 class="blog-comments">
						<i class="ti-comment"></i>
						<?php comments_number( ); ?>
					</h6>
				<?php } if ( $enable_views_meta ) { ?>
					<?php deep_setViews( get_the_ID() ); ?>
					<h6 class="blog-views">
						<i class="wn-far wn-fa-eye"></i>
						<span><?php echo deep_getViews(get_the_ID()); ?></span>
					</h6>
				<?php } ?>
			</div>
		<?php } ?>
		<?php
	}

	/**
	 * Recommended Posts.
	 *
	 * @since   1.0.0
	 */
	public static function recommended_posts( $recommended_posts ) {
		if ( $recommended_posts ) {
			$deep_options = deep_options();
			global $post;
			$tags = wp_get_post_tags($post->ID);
			$tag_ids = array();
			foreach($tags as $individual_tag)
			$tag_ids[] = $individual_tag->term_id;
			$cats = wp_get_post_categories($post->ID);
			$post_ids = array();
			$post_ids[] = $post->ID;
			$args = array(
				'post__not_in' => $post_ids,
				'showposts' => 3,
				'tax_query' => array(
					'relation' => 'OR',
					array(
						'taxonomy' => 'post_tag',
						'field' => 'id',
						'terms' => $tag_ids,
					),
					array(
						'taxonomy' => 'category',
						'field' => 'cat_ID',
						'terms' => $cats,
					),
				)
			);
			$rec_post_style = rwmb_meta( 'deep_rec_post_style' ) == 'type0' ? deep_get_option( $deep_options, 'deep_blog_single_rec_posts', '0' ) : rwmb_meta( 'deep_rec_post_style' );
			$my_query = new wp_query($args);
			if ( $rec_post_style == 'type1' ) {
				if ( $my_query->have_posts() ) { ?>
					<div class="container rec-posts">
						<div class="col-md-12">
							<h3 class="rec-title"><?php echo esc_html__('Recommended Posts','deep') ?></h3>
						</div> <?php
						while ( $my_query->have_posts() ) {
							$my_query->the_post();
							$post_ids[] = $post->ID;
							$thumbnail_url = get_the_post_thumbnail_url();
							$thumbnail_id  = get_post_thumbnail_id();
							if( !empty( $thumbnail_url ) ) {
								// if main class not exist get it
								if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
									require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
								}
								$image = new Wn_Img_Maniuplate; // instance from settor class
								$thumbnail_url = $image->m_image( $thumbnail_id, $thumbnail_url , '420' , '330' ); // set required and get result
							}
							?>
							<div class="col-md-4 col-sm-4">
								<article class="rec-post">
									<figure>
										<a href="<?php the_permalink(); ?>">
											<?php if ( has_post_thumbnail() == true ) { ?>
												<img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php the_title(); ?>" >
											<?php } elseif( ! empty( $thumbnail_url_def ) ) { ?>
												<img src="<?php echo esc_url( $thumbnail_url_def ); ?>" alt="<?php the_title(); ?>" >
											<?php } ?>
										</a>
									</figure>
									<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
									<p><?php the_time(get_option( 'date_format' )) ?> </p>
								</article>
							</div>
						<?php } ?>
					</div>
				<?php } else { ?>
					<div class="container rec-posts">
						<div class="col-md-12">
							<h3 class="rec-title"><?php echo esc_html__('Recent Posts','deep') ?></h3>
						</div> <?php
						$rel_count = $my_query->found_posts;
						if ( $rel_count < 3 ) {
							$rec_count = 3 - $rel_count;
							$args = array(
								'post__not_in' => $post_ids,
								'showposts' => $rec_count,
							);
							$rec_query = new wp_query($args);
							if ( $rec_query->have_posts() ) {
								while ( $rec_query->have_posts() ) {
									$rec_query->the_post();
									$thumbnail_url = get_the_post_thumbnail_url();
									$thumbnail_id  = get_post_thumbnail_id();
									if( !empty( $thumbnail_url ) ) {
										// if main class not exist get it
										if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
											require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
										}
										$image = new Wn_Img_Maniuplate; // instance from settor class
										$thumbnail_url = $image->m_image( $thumbnail_id, $thumbnail_url , '420' , '330' ); // set required and get result
									} ?>
									<div class="col-md-4 col-sm-4">
										<article class="rec-post">
											<figure>
												<a href="<?php the_permalink(); ?>">
													<?php if ( has_post_thumbnail() == true ) { ?>

													<img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php the_title(); ?>" >

													<?php } else { ?>

													<img src="<?php echo esc_url( $thumbnail_url_def ); ?>" alt="<?php the_title(); ?>" >

													<?php } ?>
												</a>
											</figure>
											<h5>
												<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
											</h5>
											<p><?php the_time(get_option( 'date_format' )) ?></p>
										</article>
									</div> <?php
								}
							}
						} ?>
					</div> <?php
					wp_reset_postdata();
				}
			} elseif( $rec_post_style == 'type2' ) {
				if ( $my_query->have_posts() ) {
					echo '
						<div class="container rec-posts-type2">
							<div class="col-md-12"><h3 class="rec-posts-type2-title">'. esc_html__('Recommended Posts','deep') .'</h3>
						</div>';
						while ( $my_query->have_posts() ) {
							$my_query->the_post();
							$post_ids[] = $post->ID;
							$thumbnail_url = get_the_post_thumbnail_url();
							$thumbnail_id  = get_post_thumbnail_id();
							if( !empty( $thumbnail_url ) ) {
								// if main class not exist get it
								if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
									require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
								}
								$image = new Wn_Img_Maniuplate; // instance from settor class
								$thumbnail_url = $image->m_image( $thumbnail_id, $thumbnail_url , '420' , '330' ); // set required and get result
							}
							?>
							<div class="col-md-4 col-sm-4">
								<article class="rec-post-type2-item">
									<div class="rec-post-type2-figure">
										<figure>
											<a href="<?php the_permalink(); ?>">
												<?php if ( has_post_thumbnail() == true ) { ?>

												<img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php the_title(); ?>" >

												<?php } else { ?>

												<img src="<?php echo esc_url( $thumbnail_url_def ); ?>" alt="<?php the_title(); ?>" >

												<?php } ?>
											</a>
										</figure>
									</div>
									<div class="rec-post-type2-content">
										<div class="category" style="background: <?php echo deep_category_color(); ?>"><?php the_category(', ');  ?></div>
										<p><?php the_time(get_option( 'date_format' )) ?></p>
										<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
									</div>
								</article>
							</div>
						<?php }
					echo '</div>';
					wp_reset_postdata();
				} else { ?>
					<div class="container rec-posts-type2">
						<div class="col-md-12">
							<h3 class="rec-posts-type2-title"><?php echo esc_html__('Recent Posts','deep'); ?></h3>
						</div> <?php
						$rel_count = $my_query->found_posts;
						if ( $rel_count < 3 ) {
							$rec_count = 3 - $rel_count;
							$args = array(
								'post__not_in' => $post_ids,
								'showposts' => $rec_count,
							);
							$rec_query = new wp_query($args);
								if ( $rec_query->have_posts() ) {
									while ( $rec_query->have_posts() ) {
										$rec_query->the_post();
										$thumbnail_url = get_the_post_thumbnail_url();
										$thumbnail_id  = get_post_thumbnail_id();
										if( !empty( $thumbnail_url ) ) {
											// if main class not exist get it
											if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
												require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
											}
											$image = new Wn_Img_Maniuplate; // instance from settor class
											$thumbnail_url = $image->m_image( $thumbnail_id, $thumbnail_url , '420' , '330' ); // set required and get result
										} ?>
										<div class="col-md-4 col-sm-12">
											<article class="rec-post-type2-item">
												<figure class="rec-post-type2-figure">
													<a href="<?php the_permalink(); ?>">
														<?php if ( has_post_thumbnail() == true ) { ?>
															<img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php the_title(); ?>" >
														<?php } else { ?>
															<img src="<?php echo esc_url( $thumbnail_url_def ); ?>" alt="<?php the_title(); ?>" >
														<?php } ?>
													</a>
												</figure>
												<div class="rec-post-type2-cat">
													<?php the_category(', '); ?>
												</div>
												<div class="rec-post-type2-content">
													<p><?php the_time(get_option( 'date_format' )) ?></p>
													<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
												</div>
											</article>
										</div>
								<?php }
							}
						} ?>
					</div> <?php
				}
			} elseif ( $rec_post_style == 'type3' ) {
				if ( $my_query->have_posts() ) { ?>
					<div class="container rec-posts-type3">
							<div class="col-md-12">
								<h3 class="rec-posts-type3-title"><?php echo esc_html__('Related Posts','deep'); ?></h3>
							</div> <?php
						while ( $my_query->have_posts() ) {
							$my_query->the_post();
							$post_ids[] = $post->ID;
							$thumbnail_url = get_the_post_thumbnail_url();
							$thumbnail_id  = get_post_thumbnail_id();
							if( !empty( $thumbnail_url ) ) {
								// if main class not exist get it
								if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
									require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
								}
								$image = new Wn_Img_Maniuplate; // instance from settor class
								$thumbnail_url = $image->m_image( $thumbnail_id, $thumbnail_url , '420' , '330' ); // set required and get result
							} ?>
							<div class="col-md-4 col-sm-4">
								<article class="rec-post-type3-item">
									<div class="rec-post-type3-figure">
										<figure>
											<a href="<?php the_permalink(); ?>">
												<?php if ( has_post_thumbnail() == true ) { ?>
													<img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php the_title(); ?>" >
												<?php } else { ?>
													<img src="<?php echo esc_url( $thumbnail_url_def ); ?>" alt="<?php the_title(); ?>" >
												<?php } ?>
											</a>
										</figure>
									</div>
									<div class="rec-post-type3-content">
										<p><?php the_time(get_option( 'date_format' )) ?></p>
										<h5><a href="<?php the_permalink(); ?>" class="hcolorf"><?php the_title(); ?></a></h5>
									</div>
								</article>
							</div>
						<?php } ?>
					</div> <?php
					wp_reset_postdata();
				} else { ?>
				<div class="container rec-posts-type3">
					<div class="col-md-12">
						<h3 class="rec-posts-type3-title"><?php echo esc_html__('Recent Posts','deep') ?></h3>
					</div>
					<?php
					$rel_count = $my_query->found_posts;
					if ( $rel_count < 3 ) {
						$rec_count = 3 - $rel_count;
						$args = array(
							'post__not_in' => $post_ids,
							'showposts' => $rec_count,
						);
						$rec_query = new wp_query($args);
						if ( $rec_query->have_posts() ) {
							while ( $rec_query->have_posts() ) {
								$rec_query->the_post();
								$thumbnail_url = get_the_post_thumbnail_url();
								$thumbnail_id  = get_post_thumbnail_id();
								if( !empty( $thumbnail_url ) ) {
									// if main class not exist get it
									if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
										require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
									}
									$image = new Wn_Img_Maniuplate; // instance from settor class
									$thumbnail_url = $image->m_image( $thumbnail_id, $thumbnail_url , '420' , '330' ); // set required and get result
								} ?>
								<div class="col-md-4 col-sm-12">
									<article class="rec-post-type3-item">
										<figure class="rec-post-type3-figure">
											<a href="<?php the_permalink(); ?>">
												<?php if ( has_post_thumbnail() == true ) { ?>

												<img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php the_title(); ?>" >

												<?php } else { ?>

												<img src="<?php echo esc_url( $thumbnail_url_def ); ?>" alt="<?php the_title(); ?>" >

												<?php } ?>
											</a>
										</figure>
										<div class="rec-post-type3-cat">
											<?php the_category(', '); ?>
										</div>
										<div class="rec-post-type3-content">
											<p><?php the_time(get_option( 'date_format' )) ?></p>
											<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
										</div>
									</article>
								</div>
						<?php }
						}
					} ?>
				</div> <?php
				}
			}
		}
	}
}