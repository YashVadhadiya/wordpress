<?php

defined( 'ABSPATH' ) || exit;

$deep_options = deep_options();
global $post;

$author_id               = get_the_author_meta( 'ID' );
$single_post_style       = rwmb_meta( 'deep_blogpost_meta' ) == 'themeopts' ? deep_get_option( $deep_options, 'deep_blog_single_post_style', '0' ) : rwmb_meta( 'deep_blogpost_meta' );
$post_format             = get_post_format( get_the_ID() );
$user_rating             = deep_get_option( $deep_options, 'deep_user_rating' );
$author_position         = get_user_meta( $author_id, 'author_position', true );
$author_position         = $author_position ? $author_position : '';
$social					 = deep_get_option( $deep_options, 'deep_blog_social_share', '1' );
$enable_date_meta        = deep_get_option( $deep_options, 'deep_blog_meta_date_enable', '1' );
$single_rec_posts        = deep_get_option( $deep_options, 'deep_blog_single_rec_posts', '0' );
$enable_views_meta       = deep_get_option( $deep_options, 'deep_blog_meta_views_enable', '0' );
$authorbox_sec_type      = deep_get_option( $deep_options, 'deep_authorbox_sec_type', '0' );
$enable_comments_meta    = deep_get_option( $deep_options, 'deep_blog_meta_comments_enable', '1' );
$enable_category_meta    = deep_get_option( $deep_options, 'deep_blog_meta_category_enable', '1' );
$enable_single_authorbox = deep_get_option( $deep_options, 'deep_blog_single_authorbox_enable', '0' );
$recommended_posts		 = deep_get_option( $deep_options, 'deep_recommended_posts', '1' );
$enable_author_meta      = deep_get_option( $deep_options, 'deep_blog_meta_author_enable', '0' );
$enable_gravatar_meta    = deep_get_option( $deep_options, 'deep_blog_meta_gravatar_enable', '1' );
$uniqid = uniqid();
?>

<hr class="vertical-space2">
<article class="blog-single-post">
	<div <?php post_class( 'post' ); ?>>
	<?php Deep_Blog_Helper::thumbnail( $post ); ?>
	<div class="showpost4-contnet">
		<!-- Post Meta Data -->
		<div class="postmetadata postshow4">
			<?php if( $enable_category_meta ) { ?>
			<div class="blog-cat">
				<span class="category-color category-color-<?php echo esc_attr( $uniqid ); ?>"></span>
				<?php the_category(', ') ?>
			</div>
			<?php } if( $enable_date_meta ) { ?>
				<div class="blog-date">
					<?php the_time(get_option( 'date_format' )) ?>
				</div>
			<?php } ?>
		</div>
		<?php echo esc_html( Deep_Blog_Helper::title() ); ?>
		<!-- Post Meta Data -->
		<div class="postmetadata postshow4">
			<?php if( $enable_author_meta ){ ?>
				<div class="au-avatar-box">
					<?php if( $enable_gravatar_meta ){ ?>
						<div class="au-avatar"><?php echo get_avatar( get_the_author_meta( 'user_email' ), 35 ); ?></div>
					<?php } if($enable_author_meta) { ?>
						<p class="blog-author"><?php the_author_posts_link(); ?></p>
					<?php } ?>
				</div>
			<?php } if( $enable_comments_meta ) { ?>
				<div class="blog-comments">
					<i class="wn-far wn-fa-comment"></i>
					<?php comments_number( ); ?>
				</div>
			<?php } if ( $enable_views_meta ) { ?>
				<div class="blog-views">
					<i class="wn-far wn-fa-eye"></i>
					<span><?php echo esc_html( deep_getViews(get_the_ID()) ); ?></span>
				</div>
			<?php } ?>
		</div>
	</div>
		<!-- block quote -->
		<?php Deep_Blog_Helper::content( $post_format ); ?>
		<!-- Jetpack Socials -->
		<?php Deep_Blog_Helper::jeptpack_socials(); ?>
		<div class="clear"></div>
		<!-- Post Tags -->
		<?php Deep_Blog_Helper::tags(); ?>
		<div class="clear"></div>
		<!-- Next And Previous Post -->
		<?php deep_next_prev_post(); ?>
		<div class="clear"></div>
		<!-- socials -->
		<?php Deep_Blog_Helper::socials( $social ); ?>
		<!-- Author Box -->
		<?php Deep_Blog_Helper::author_box( $enable_single_authorbox, $authorbox_sec_type, $author_position ); ?>
		<!-- Post Review -->
		<?php Deep_Blog_Helper::post_review(); ?>
		<!-- Recomended Posts -->
		<?php Deep_Blog_Helper::recommended_posts( $recommended_posts ); ?>
		<!-- Comments -->
		<?php Deep_Blog_Helper::comments(); ?>
		<!-- User Rating -->
		<?php Deep_Blog_Helper::user_rateing( $user_rating ); ?>
	</div>
</article>
