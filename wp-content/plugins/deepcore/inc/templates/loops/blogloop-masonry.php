<?php
if ( defined( 'DEEP_HANDLE' ) ) {
	global $post;
}
$deep_options                                   = deep_options();
$deep_options['deep_blog_featuredimage_enable'] = isset( $deep_options['deep_blog_featuredimage_enable'] ) ? $deep_options['deep_blog_featuredimage_enable'] : '1';
$deep_options['deep_blog_meta_category_enable'] = isset( $deep_options['deep_blog_meta_category_enable'] ) ? $deep_options['deep_blog_meta_category_enable'] : '1';
$deep_options['deep_blog_posttitle_enable']     = isset( $deep_options['deep_blog_posttitle_enable'] ) ? $deep_options['deep_blog_posttitle_enable'] : '1';
$post_format                                    = get_post_format( get_the_ID() );
$content                                        = get_the_content();
?>
<article  class="pin-box entry -item">
	<div class="img-item">
		<?php
		if ( $deep_options['deep_blog_featuredimage_enable'] ) {
			$meta_video = rwmb_meta( 'deep_featured_video_meta' );
			if ( 'video' == $post_format || 'audio' == $post_format ) {
				$pattern = '\\[' . '(\\[?)' . '(video|audio)' . '(?![\\w-])' . '(' . '[^\\]\\/]*' . '(?:' . '\\/(?!\\])' . '[^\\]\\/]*' . ')*?' . ')' . '(?:' . '(\\/)' . '\\]' . '|' . '\\]' . '(?:' . '(' . '[^\\[]*+' . '(?:' . '\\[(?!\\/\\2\\])' . '[^\\[]*+' . ')*+' . ')' . '\\[\\/\\2\\]' . ')?' . ')' . '(\\]?)';
				preg_match( '/' . $pattern . '/s', $post->post_content, $matches );
				if ( ( is_array( $matches ) ) && ( isset( $matches[3] ) ) && ( ( $matches[2] == 'video' ) || ( 'audio' == $post_format ) ) && ( isset( $matches[2] ) ) ) {
					$video = $matches[0];
					echo do_shortcode( $video );
					$content = preg_replace( '/' . $pattern . '/s', '', $content );
				} elseif ( ( ! empty( $meta_video ) ) ) {
					echo do_shortcode( $meta_video );
				}
			} elseif ( 'gallery' == $post_format ) {
				$pattern = '\\[' . '(\\[?)' . '(gallery)' . '(?![\\w-])' . '(' . '[^\\]\\/]*' . '(?:' . '\\/(?!\\])' . '[^\\]\\/]*' . ')*?' . ')' . '(?:' . '(\\/)' . '\\]' . '|' . '\\]' . '(?:' . '(' . '[^\\[]*+' . '(?:' . '\\[(?!\\/\\2\\])' . '[^\\[]*+' . ')*+' . ')' . '\\[\\/\\2\\]' . ')?' . ')' . '(\\]?)';
				preg_match( '/' . $pattern . '/s', $post->post_content, $matches );
				if ( ( is_array( $matches ) ) && ( isset( $matches[3] ) ) && ( $matches[2] == 'gallery' ) && ( isset( $matches[2] ) ) ) {
					$ids = ( shortcode_parse_atts( $matches[3] ) );
					if ( is_array( $ids ) && isset( $ids['ids'] ) ) {
						$ids = $ids['ids'];
					}
					$galley_url = array();
					$galley_id  = explode( ',', $ids );
					?>
					<div class="post-gallery-format">
						<div class="gl-img owl-carousel owl-theme">
						<?php
						for ( $i = 0; $i < sizeof( $galley_id ); $i++ ) {
							if ( ! empty( $galley_id[ $i ] ) ) {
								if ( ! class_exists( 'Wn_Img_Maniuplate' ) ) {									
									load_template( DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php' );
								}
								$image         = new Wn_Img_Maniuplate(); // instance from settor class
								$thumbnail_url = $image->m_image( $galley_id[ $i ], wp_get_attachment_url( $galley_id[ $i ] ), '373', '249' ); // set required and get result
								echo '<img src="' . esc_url( $thumbnail_url ) . '" alt="' . esc_attr(get_the_title()) . '">';
							}
						}
						?>
						</div>													
					</div>	
					<?php
				}
			} else {
				get_the_image(
					array(
						'meta_key' => array( 'Full', 'Full' ),
						'size'     => 'Full',
					)
				);
			}
		}
		?>
	</div>
	<div class="pin-ecxt">
		<?php if ( $deep_options['deep_blog_meta_category_enable'] && has_category() ) { ?>
		<h6 class="blog-cat"><?php the_category( ', ' ); ?> </h6>
		<?php } ?>
		<?php if ( $deep_options['deep_blog_posttitle_enable'] ) { ?>
			<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
		<?php } ?>
		<?php
		// Post Content
		if ( $post_format == 'quote' ) {
			echo '<blockquote>';
		}
		echo '<p>' . esc_html(deep_excerpt( ( $deep_options['deep_blog_excerpt_list'] ) ? $deep_options['deep_blog_excerpt_list'] : 31 )) . '</p>';
		if ( $post_format == 'quote' ) {
			echo '</blockquote>';
		}
		if ( $post_format == ( 'quote' ) || $post_format == 'aside' ) {
			echo '<a class="readmore" href="' . esc_url( get_permalink( get_the_ID() ) ) . '">' . esc_html__( 'View Post', 'deep-free' ) . '</a>';
		}
		?>
	</div>
	<div class="pin-ecxt2">
		<div class="col1-3"><a class="hcolorf" href="<?php echo esc_html( get_comments_link() ); ?>"><i class="wn-far wn-fa-comment"></i><span><?php echo esc_attr(get_comments_number()); ?></span></a></div>
		<div class="col1-3"><?php echo get_avatar( get_the_author_meta( 'user_email' ), 45 ); ?><p><?php the_author_posts_link(); ?></p></div>
		<div class="col1-3"><h6 class="blog-date"><a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a></h6></div>
	</div>
</article>
