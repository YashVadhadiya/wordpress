<?php
function deep_widget_tab( $attributes, $content = null ) {
	extract(
		shortcode_atts(
			array(

				'sort_by'               => 'comments',
				'counter_popular_post'  => '5',
				'counter_recent_post'   => '5',
				'counter_comments_post' => '5',
				'show_popular'          => 'on',
				'show_recent'           => 'on',
				'show_comments'         => 'on',

			),
			$attributes
		)
	);

	$counter_popular_post  = $counter_popular_post ? $counter_popular_post : '';
	$counter_recent_post   = $counter_recent_post ? $counter_recent_post : '';
	$counter_comments_post = $counter_comments_post ? $counter_comments_post : '';
	$show_popular          = $show_popular ? $show_popular : '';
	$show_comments         = $show_comments ? $show_comments : '';
	$show_recent           = $show_recent ? $show_recent : '';
	$sort_by               = $sort_by ? $sort_by : '';

	$instance = array(
		'posts'              => $counter_popular_post,
		'comments'           => $counter_recent_post,
		'tags'               => $counter_comments_post,
		'show_popular_posts' => $show_popular,
		'show_recent_posts'  => $show_recent,
		'show_comments'      => $show_comments,
		'show_tags'          => null,
		'orderby'            => $sort_by,
	);

	$args = array(
		'before_title' => '<div class="subtitle-wrap"><h4 class="subtitle">',
		'after_title'  => '</h4></div>',
	);

	return get_the_widget( 'WebnusWidgetTabs', $instance, $args );
}

add_shortcode( 'widget-tab', 'deep_widget_tab' );
