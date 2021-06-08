<?php

defined( 'ABSPATH' ) || exit;

$deep_options = deep_options();
$author_id               = get_the_author_meta( 'ID' );
$post_format             = get_post_format( get_the_ID() );
$user_rating             = deep_get_option( $deep_options, 'deep_user_rating' );
$author_position         = get_user_meta( $author_id, 'author_position', true );
$author_position         = $author_position ? $author_position : '';
$enable_date_meta        = deep_get_option( $deep_options, 'deep_blog_meta_date_enable', '1' );
$recommended_posts		 = deep_get_option( $deep_options, 'deep_recommended_posts', '1' );
$single_rec_posts        = deep_get_option( $deep_options, 'deep_blog_single_rec_posts', '0' );
$enable_views_meta       = deep_get_option( $deep_options, 'deep_blog_meta_views_enable', '0' );
$authorbox_sec_type      = deep_get_option( $deep_options, 'deep_authorbox_sec_type', '0' );
$enable_comments_meta    = deep_get_option( $deep_options, 'deep_blog_meta_comments_enable', '1' );
$enable_category_meta    = deep_get_option( $deep_options, 'deep_blog_meta_category_enable', '1' );
$social					 = deep_get_option( $deep_options, 'deep_blog_social_share', '1' );
$enable_author_meta      = deep_get_option( $deep_options, 'deep_blog_meta_author_enable', '1' );
$enable_gravatar_meta    = deep_get_option( $deep_options, 'deep_blog_meta_gravatar_enable', '1' );
$single_post_style       = rwmb_meta( 'deep_blogpost_meta' ) == 'themeopts' ? deep_get_option( $deep_options, 'deep_blog_single_post_style', '0' ) : rwmb_meta( 'deep_blogpost_meta' );
$enable_single_authorbox = deep_get_option( $deep_options, 'deep_blog_single_authorbox_enable', '0' ); ?>

<hr class="vertical-space2">
<article class="blog-single-post">
	<div class="post-trait-w">
		<div <?php post_class( 'post' ); ?>>
			<!-- Post Meta Data -->
			<?php Deep_Blog_Helper::post_meta_data( $enable_date_meta, $enable_category_meta, $enable_comments_meta, $enable_views_meta ); ?>
			<!-- Post Meta Author -->
			<?php Deep_Blog_Helper::author( '', $enable_author_meta, $enable_gravatar_meta ); ?>
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
