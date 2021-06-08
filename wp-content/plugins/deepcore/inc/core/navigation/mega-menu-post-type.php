<?php
// mega menu post type
add_action( 'init', 'wn_mega_menu', 99 );
function wn_mega_menu() {
	$labels = array(
		'name'					=> esc_html__( 'Mega Menus', 'deep' ),
		'all_items'				=> esc_html__( 'Mega Menus', 'deep' ),
		'singular_name'			=> esc_html__( 'Mega Menu', 'deep' ),
		'add_new'				=> esc_html__( 'Add New', 'deep' ),
		'add_new_item'			=> esc_html__( 'Add New Mega Menu', 'deep' ),
		'edit_item'				=> esc_html__( 'Edit Mega Menu', 'deep' ),
		'new_item'				=> esc_html__( 'New Mega Menu', 'deep' ),
		'view_item'				=> esc_html__( 'View Mega Menu', 'deep' ),
		'search_items'			=> esc_html__( 'Search Mega Menus', 'deep' ),
		'not_found'				=> esc_html__( 'No Mega Menus found', 'deep' ),
		'not_found_in_trash'	=> esc_html__( 'No Mega Menus found in Trash', 'deep' ),
	);

	$args = array(
		'labels'			=> $labels,
		'public'			=> true,
		'show_ui'			=> true,
		'capability_type'	=> 'post',
		'hierarchical'		=> true,
		'rewrite'			=> array( 'slug' => 'mega_menus' ),
		'supports'			=> array( 'title', 'editor' ),
		'menu_position'		=> 23,
		'menu_icon'			=> 'dashicons-grid-view',
	);

	register_post_type( 'mega_menu', $args );
}