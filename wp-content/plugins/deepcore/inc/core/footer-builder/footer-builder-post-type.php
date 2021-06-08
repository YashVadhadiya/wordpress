<?php
/**
* Register Footer Builder Post type
*/
add_action( 'init', 'deep_footer_builder', 99 );
function deep_footer_builder() {
	$labels = array(
		'name'               => _x( 'Footer Builder', 'post type general name', 'deep' ),
		'singular_name'      => _x( 'Footer', 'post type singular name', 'deep' ),
		'menu_name'          => _x( 'Footer Builder', 'admin menu', 'deep' ),
		'name_admin_bar'     => _x( 'Footer Builder', 'add new on admin bar', 'deep' ),
		'add_new'            => _x( 'Add New Footer', 'footer', 'deep' ),
		'add_new_item'       => __( 'Add New Footer', 'deep' ),
		'new_item'           => __( 'New Footer', 'deep' ),
		'edit_item'          => __( 'Edit Footer', 'deep' ),
		'view_item'          => __( 'View Footer', 'deep' ),
		'all_items'          => __( 'All Footers', 'deep' ),
		'search_items'       => __( 'Search Footers', 'deep' ),
		'parent_item_colon'  => __( 'Parent Footers:', 'deep' ),
		'not_found'          => __( 'No Footer found.', 'deep' ),
		'not_found_in_trash' => __( 'No Footer found in Trash.', 'deep' )
	);

	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Description.', 'deep' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'wbf_footer' ),
		'has_archive'        => true,
		'hierarchical'       => true,
		'menu_position'      => 28,
		'menu_icon'			 => 'dashicons-menu',
		'supports'           => array( 'title', 'editor' )
	);

	register_post_type( 'wbf_footer', $args );
}