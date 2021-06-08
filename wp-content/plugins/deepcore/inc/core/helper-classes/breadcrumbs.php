<?php
function deep_breadcrumbs() {
	$delimiter = '<i class="wn-fa wn-fa-angle-right"></i>'; // delimiter between crumbs
	$home = 'Home'; // text for the 'Home' link
	$showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
	$deep_options = deep_options();
	global $post;
	$homeLink = esc_url(home_url('/'));
    echo '<div id="crumbs"><a href="' . esc_url($homeLink) . '">' . $home . '</a> ' . $delimiter . ' ';

    if ( is_category() ) {
    	$thisCat = get_category(get_query_var('cat'), false);
    	if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
    	echo '<span class="current">' . esc_html__('Archive by category ','deep') . single_cat_title('', false) . '</span>';
    } elseif ( is_search() ) {
    	echo '<span class="current">' . esc_html__('Search results for ','deep') . get_search_query() . '</span>';
    } elseif ( is_day() ) {
    	echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
    	echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
    	echo '<span class="current">' . get_the_time('d') . '</span>';
    } elseif ( is_month() ) {
    	echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
    	echo '<span class="current">' . get_the_time('F') . '</span>';
    } elseif ( is_year() ) {
    	echo '<span class="current">' . get_the_time('Y') . '</span>';
    } elseif ( is_single() && !is_attachment() ) {
    	if ( get_post_type() != 'post' ) {
    		$post_type = get_post_type_object(get_post_type());
    		$slug = $post_type->rewrite;
    		echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
    		if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . '<span class="current">' . get_the_title() . '</span>';
    	} else {
			$cat = get_the_category(); $cat = $cat[0];
			$cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
			if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
			echo '' . $cats;
			if ($showCurrent == 1) echo '<span class="current">' . get_the_title() . '</span>';
    	}
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
    	$post_type = get_post_type_object(get_post_type());
    	echo '<span class="current">' . $post_type->labels->singular_name . '</span>';
    } elseif ( is_attachment() ) {
		$parent = get_post($post->post_parent);
		$cat = get_the_category($parent->ID); $cat = $cat[0];
		echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
		echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
		if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . '<span class="current">' . get_the_title() . '</span>';
    } elseif ( is_page() && !$post->post_parent ) {
		if ($showCurrent == 1) echo '<span class="current">' . get_the_title() . '</span>';
    } elseif ( is_page() && $post->post_parent ) {
    	$parent_id  = $post->post_parent;
    	$breadcrumbs = array();
    	while ($parent_id) {
    		$page = get_page($parent_id);
    		$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
    		$parent_id  = $page->post_parent;
    	}
    	$breadcrumbs = array_reverse($breadcrumbs);
    	for ($i = 0; $i < count($breadcrumbs); $i++) {
    		echo $breadcrumbs[$i];
    		if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
    	}
    	if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . '<span class="current">' . get_the_title() . '</span>';
    } elseif ( is_tag() ) {
		echo '<span class="current">' . esc_html__('Posts tagged' ,'deep') . single_tag_title('', false) . '</span>';
    } elseif ( is_author() ) {
		global $author;
		$userdata = get_userdata($author);
		echo '<span class="current">' .  esc_html__('Articles posted by ','deep') . $userdata->display_name . '</span>';
	} elseif ( is_404() ) {
    	echo '<span class="current">' . esc_html__('Error 404','deep') . '</span>';
    }
    if ( get_query_var('paged') ) {
    	if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
    	echo esc_html__('Page','deep') . ' ' . get_query_var('paged');
    	if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
    echo '</div>';
} // end qt_custom_breadcrumbs()
?>