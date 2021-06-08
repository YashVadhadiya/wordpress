<?php

defined( 'ABSPATH' ) || exit;

global $post;
$deep_options      = deep_options();
$post_format       = get_post_format( get_the_ID() );
$meta_video        = rwmb_meta( 'deep_featured_video_meta' );
$enable_views_meta = deep_get_option( $deep_options, 'deep_blog_meta_views_enable', '0' );
$single_post_style = rwmb_meta( 'deep_blogpost_meta' ) == 'themeopts' ? deep_get_option( $deep_options, 'deep_blog_single_post_style', '0' ) : rwmb_meta( 'deep_blogpost_meta' ); ?>

<!-- image -->
<div class="col-md-12">
	<?php
	Deep_Blog_Helper::thumbnail( $post );
	if ( $enable_views_meta ) { ?>
			<h6 class="blog-views-ps3">
			<i class="pe-7s-look"></i><span><?php echo esc_html( deep_getViews( get_the_ID() ) ); ?></span>
			</h6>
	<?php } ?>
</div>
