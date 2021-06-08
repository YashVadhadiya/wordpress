<?php
/**
 * Blog functions.
 *
 * @package ThinkUpThemes
 */


 /* ----------------------------------------------------------------------------------
	BLOG STYLE
---------------------------------------------------------------------------------- */

function consulting_thinkup_input_blogclass($classes){

	if ( consulting_thinkup_check_isblog() ) {
		$classes[] = 'blog-style2';
	}
	return $classes;
}
add_action( 'body_class', 'consulting_thinkup_input_blogclass');

// Add blog class to search results page
function consulting_thinkup_input_searchclass($classes){

	if ( is_search() ) {
		$classes[] = 'blog-style2';
	}
	return $classes;
}
add_action( 'body_class', 'consulting_thinkup_input_searchclass');	

/* ----------------------------------------------------------------------------------
	BLOG STYLE
---------------------------------------------------------------------------------- */

function consulting_thinkup_input_stylelayout() {
	echo ' column-3';
}


/* ----------------------------------------------------------------------------------
	HIDE POST TITLE
---------------------------------------------------------------------------------- */

function consulting_thinkup_input_blogtitle() {

	echo	'<h2 class="blog-title">',
			'<a href="' . esc_url( get_permalink() ) . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'consulting' ), the_title_attribute( 'echo=0' ) ) . '">' . get_the_title() . '</a>',
			'</h2>';

}


/* ----------------------------------------------------------------------------------
	BLOG CONTENT
---------------------------------------------------------------------------------- */

// Input post thumbnail / featured media
function consulting_thinkup_input_blogimage() {
global $post;

	$size    = NULL;
	$link    = NULL;
	$media   = NULL;
	$output  = NULL;

	$blog_lightbox = NULL;
	$blog_link     = NULL;
	$blog_overlay  = NULL;

	// Set image size for blog thumbnail
	$size = 'consulting-thinkup-column3-2/3';

	$featured_id  = get_post_thumbnail_id( $post->ID );
	$featured_img = wp_get_attachment_image_src($featured_id,'full', true);

	// Determine featured media to input
	$link  = $featured_img[0];
	$media = get_the_post_thumbnail( $post->ID, $size );

	// Determine which links to show on hover
	$blog_lightbox = '<a class="hover-zoom prettyPhoto" href="' . esc_url( $link ) . '"></a>';
	$blog_link     = '<a class="hover-link" href="' . esc_url( get_permalink() ) . '"></a>';

	$blog_overlay .= '<div class="image-overlay">';
	$blog_overlay .= '<div class="image-overlay-inner"><div class="hover-icons">';
	$blog_overlay .= $blog_lightbox;
	$blog_overlay .= $blog_link;
	$blog_overlay .= '</div></div>';
	$blog_overlay .= '</div>';

	// Output media on blog page
	if ( ! empty( $featured_id ) ) {
		$output .= '<div class="blog-thumb">';
		$output .= '<a href="' . esc_url( get_permalink($post->ID) ) . '">' . $media . '</a>';
		$output .= $blog_overlay;
		$output .= '</div>';
	}

	return $output;
}

// Input post excerpt / content to blog page
function consulting_thinkup_input_blogtext() {
global $post;

// Get theme options values.
$thinkup_blog_postswitch = consulting_thinkup_var ( 'thinkup_blog_postswitch' );

	// Output full content - EDD plugin compatibility
	if( function_exists( 'EDD' ) and is_post_type_archive( 'download' ) ) {
		the_content();
		return;
	}

	// Output post content
	if ( is_search() ) {
		the_excerpt();
	} else if ( ! is_search() ) {
		if ( ( empty( $thinkup_blog_postswitch ) or $thinkup_blog_postswitch == 'option1' ) ) {
			if( ! is_numeric( strpos( $post->post_content, '<!--more-->' ) ) ) {
				the_excerpt();
			} else {
				the_content();
				wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'consulting' ), 'after'  => '</div>', ) );
			}
		} else if ( $thinkup_blog_postswitch == 'option2' ) {
			the_content();
			wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'consulting' ), 'after'  => '</div>', ) );
		}
	}
}


/* ----------------------------------------------------------------------------------
	BLOG META CONTENT & POST META CONTENT
---------------------------------------------------------------------------------- */

// Input sticky post
function consulting_thinkup_input_sticky() {
	printf( '<span class="sticky"><i class="fa fa-thumb-tack"></i><a href="%1$s" title="%2$s">' . __( 'Sticky', 'consulting' ) . '</a></span>',
		esc_url( get_permalink() ),
		esc_attr( get_the_title() )
	);
}

// Input blog date
function consulting_thinkup_input_blogdate() {
	printf( __( '<span class="date"><a href="%1$s" title="%2$s"><time datetime="%3$s">%4$s</time></a></span>', 'consulting' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_title() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);
}

// Input blog comments
function consulting_thinkup_input_blogcomment() {

	if ( '0' != get_comments_number() ) {
		echo	'<span class="comment">';
			if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) {;
				comments_popup_link( __( '<span class="comment-count">0</span> <span class="comment-text">Comments</span>', 'consulting' ), __( '<span class="comment-count">1</span> <span class="comment-text">Comment</span>', 'consulting' ), __( '<span class="comment-count">%</span> <span class="comment-text">Comments</span>', 'consulting' ) );
			};
		echo	'</span>';
	}
}

// Input blog categories
function consulting_thinkup_input_blogcategory() {
$categories_list = get_the_category_list( __( ', ', 'consulting' ) );

	if ( $categories_list && consulting_thinkup_input_categorizedblog() ) {
		printf( '<span class="category">%s</span>', $categories_list );
	};
}

// Input blog tags
function consulting_thinkup_input_blogtag() {
$tags_list = get_the_tag_list( '', __( ', ', 'consulting' ) );

	if ( $tags_list ) {
		printf( '<span class="tags">%s</span>', $tags_list );
	};
}

// Input blog author
function consulting_thinkup_input_blogauthor() {
	printf( __( '<span class="author"><a href="%1$s" title="%2$s" rel="author">%3$s</a></span>', 'consulting' ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'consulting' ), get_the_author() ) ),
		get_the_author()
	);
}


//----------------------------------------------------------------------------------
//	CUSTOM READ MORE BUTTON.
//----------------------------------------------------------------------------------

function consulting_thinkup_input_readmore( $link ) {
global $post;

	// Make no changes if in admin area
	if ( is_admin() ) {
		return $link;
	}

	$link = '&hellip;<p class="more-link"><a href="' . esc_url( get_permalink($post->ID) ) . '" class="themebutton2">' . esc_html__( 'Read More', 'consulting') . '</a></p>';

	return $link;
}
add_filter( 'excerpt_more', 'consulting_thinkup_input_readmore' );
add_filter( 'the_content_more_link', 'consulting_thinkup_input_readmore' );


/* ----------------------------------------------------------------------------------
	INPUT BLOG META CONTENT
---------------------------------------------------------------------------------- */

// Add format-media class to post article for featured image, gallery and video
function consulting_thinkup_input_blogmediaclass($classes) {
global $post;

// Get theme options values.
$thinkup_blog_postswitch = consulting_thinkup_var ( 'thinkup_blog_postswitch' );

	$featured_id = get_post_thumbnail_id( $post->ID );

	// Determine featured media to input
	if ( consulting_thinkup_check_isblog() ) {
		if ( empty( $featured_id ) or $thinkup_blog_postswitch == 'option2' ) {
			$classes[] = 'format-nomedia';	
		} else if( has_post_thumbnail() ) {
			$classes[] = 'format-media';
		}
	}
	return $classes;
}
add_action( 'post_class', 'consulting_thinkup_input_blogmediaclass');

// Blog meta content - Blog style 1
function consulting_thinkup_input_blogmeta() {

	echo '<div class="entry-meta">';
		if ( is_sticky() && is_home() && ! is_paged() ) { consulting_thinkup_input_sticky(); }

		consulting_thinkup_input_blogdate();
		consulting_thinkup_input_blogauthor();
		consulting_thinkup_input_blogcomment();
		consulting_thinkup_input_blogcategory();
		consulting_thinkup_input_blogtag();
	echo '</div>';
}


/* ----------------------------------------------------------------------------------
	INPUT POST META CONTENT
---------------------------------------------------------------------------------- */

function consulting_thinkup_input_postmedia() {
global $post;

	// Set output variable to avoid php errors
	$output = NULL;

	if ( get_post_format() == 'image' ) {
		$output .= '<div class="post-thumb">' . get_the_post_thumbnail( $post->ID, 'consulting-thinkup-column1-1/4' ) . '</div>';
	}

	// Output featured items if set
	if ( ! empty( $output ) ) {
		echo $output;
	}
}

// Add format-media class to post article for featured image, gallery and video
function consulting_thinkup_input_postmediaclass($classes) {

	if ( is_singular( 'post' ) ) {
		if ( get_post_format() == 'image' or get_post_format() == 'gallery' or get_post_format() == 'video' ) {
			if( has_post_thumbnail() ) {
				$classes[] = 'format-media';
			}
		} else {
			$classes[] = 'format-nomedia';			
		}
	}
	return $classes;
}
add_action( 'post_class', 'consulting_thinkup_input_postmediaclass');

// Input meta data for single post
function consulting_thinkup_input_postmeta() {

	echo '<header class="entry-header">';

		echo '<h3 class="post-title">' . get_the_title() . '</h3>';

		echo '<div class="entry-meta">';
			consulting_thinkup_input_blogdate();
			consulting_thinkup_input_blogauthor();
			consulting_thinkup_input_blogcomment();
			consulting_thinkup_input_blogcategory();
			consulting_thinkup_input_blogtag();
		echo '</div>';

	echo '<div class="clearboth"></div></header><!-- .entry-header -->';
}


/* ----------------------------------------------------------------------------------
	SHOW AUTHOR BIO
---------------------------------------------------------------------------------- */

// HTML for Author Bio
function consulting_thinkup_input_postauthorbiocode() {

	echo	'<div id="author-bio">',
			'<div id="author-image">',
			get_avatar( get_the_author_meta( 'email' ), '160' ),
			'</div>',
			'<div id="author-content">',
			'<div id="author-title">',
			'<p><a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '"/>' . get_the_author() . '</a></p>',
			'</div>';

			if ( get_the_author_meta( 'description' ) !== '' ) {
			echo '<div id="author-text">',
				 wpautop( get_the_author_meta( 'description' ) ),
				 '</div>';
			}

	echo	'</div></div>';
}

// Output Author Bio
function consulting_thinkup_input_postauthorbio() {

// Get theme options values.
$thinkup_post_authorbio = consulting_thinkup_var ( 'thinkup_post_authorbio' );

	if ( $thinkup_post_authorbio == '1' ) {
		consulting_thinkup_input_postauthorbiocode();
	}
}


/* ----------------------------------------------------------------------------------
	TEMPLATE FOR COMMENTS AND PINGBACKS (PREVIOUSLY IN TEMPLATE-TAGS).
---------------------------------------------------------------------------------- */

/* Display comments  - Style 1 */
function consulting_thinkup_input_allowcomments() {

	if ( comments_open() || '0' != get_comments_number() ) {
		comments_template( '/comments.php', true );
	}
}


/* ----------------------------------------------------------------------------------
	TEMPLATE FOR COMMENTS AND PINGBACKS (PREVIOUSLY IN TEMPLATE-TAGS).
---------------------------------------------------------------------------------- */

function consulting_thinkup_input_commenttemplate( $comment, $args, $depth ) {

	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'consulting'); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'consulting' ), ' ' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
					<?php echo get_avatar( $comment, 80 ); ?>
			<header>

				<div class="comment-author">
					<h4><?php printf( '%s', sprintf( '%s', get_comment_author_link() ) ); ?></h4>
				</div>
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'consulting'); ?></em>
					<br />
				<?php endif; ?>

				<div class="comment-meta">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time datetime="<?php esc_attr( comment_time( 'c' ) ); ?>">
					<?php
						/* translators: 1: date, 2: time */
						printf( '%s', get_comment_date() ); ?>
					</time></a>
					<?php edit_comment_link( __( 'Edit', 'consulting' ), ' ' );
					?>
					<span class="reply">
						<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</span>
				</div>

			</header>

			<footer>

				<div class="comment-content"><?php comment_text(); ?></div>

			</footer><div class="clearboth"></div>

		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}

// List comments in single page
function consulting_thinkup_input_comments() {
	$args = array( 
		'callback' => 'consulting_thinkup_input_commenttemplate', 
	);
	wp_list_comments( $args );
}


?>