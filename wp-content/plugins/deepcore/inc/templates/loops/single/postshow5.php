<?php

defined( 'ABSPATH' ) || exit;

$deep_options = deep_options();
global $post;

$author_id               = get_the_author_meta( 'ID' );
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
$enable_author_meta      = deep_get_option( $deep_options, 'deep_blog_meta_author_enable', '0' );
$enable_gravatar_meta    = deep_get_option( $deep_options, 'deep_blog_meta_gravatar_enable', '1' );
$recommended_posts		 = deep_get_option( $deep_options, 'deep_recommended_posts', '1' );
$single_post_style       = rwmb_meta( 'deep_blogpost_meta' ) == 'themeopts' ? deep_get_option( $deep_options, 'deep_blog_single_post_style', '0' ) : rwmb_meta( 'deep_blogpost_meta' );
?>

<hr class="vertical-space2">
<article class="blog-single-post blg-minimal-full">
	<div class="blog-header-metadata">
		<?php if( $enable_gravatar_meta || $enable_author_meta ){ ?>
		<div class="au-avatar-box">
			<div class="au-avatar"><?php echo get_avatar( get_the_author_meta( 'user_email' ), 90 ); ?></div>
			<h6 class="blog-author"><?php the_author_posts_link(); ?></h6>
		</div>
		<?php } ?>
		<div class="postmetadata postshow5">
			<?php if( $enable_date_meta ){?>
			<h6 class="blog-date"><i class="ti-calendar"></i><?php the_time(get_option( 'date_format' )) ?></h6>
			<?php } ?>

			<?php if($enable_category_meta){ ?>
			<h6 class="blog-cat"><i class="ti-folder"></i><?php the_category(', ') ?> </h6>
			<?php } ?>

			<?php if($enable_comments_meta){ ?>
			<h6 class="blog-comments"><i class="ti-comment"></i><?php comments_number(  ); ?> </h6>
			<?php } ?>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="post-trait-w">
		<?php Deep_Blog_Helper::thumbnail( $post ); ?>
		<?php echo esc_html( Deep_Blog_Helper::title() ); ?>
		<div <?php post_class( 'post' ); ?>>
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
	</div>
</article>
