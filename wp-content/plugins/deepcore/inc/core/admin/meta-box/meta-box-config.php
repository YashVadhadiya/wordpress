<?php
add_filter( 'rwmb_meta_boxes', 'deep_meta_boxes' );
function deep_meta_boxes( $meta_boxes ) {
	// Post
	$meta_boxes[] = array(
		'title'			=> esc_attr__( 'Webnus Post Options', 'deep' ),
		'post_types'	=> 'post',
		'fields'		=> array(
			array(
				'id'		=> 'deep_blogpost_width',
				'name'		=> 'Use full width post',
				'type'		=> 'button_group',
				'desc'		=> esc_attr__( 'This option works when you create your post using a page builder such as Visual Composer. By enabling this, post options will be disabled. This option is disabled by default.' , 'deep' ),
				'inline'	=> true,
				'options' 	=> array(
					'yes' => 'Enable',
					'no' => 'Disable',
				),
			),
			array(
				'id'		=> 'deep_blogpost_meta',
				'name'		=> esc_attr__( 'Post Style', 'deep' ),
				'type'		=> 'select',
				'options'	=> array(
					'themeopts' => esc_attr__( 'Inherit from theme options', 'deep' ),
					'postshow0' => esc_attr__( 'Post Show Default', 'deep' ),
					'postshow1' => esc_attr__( 'Post Show 1', 'deep' ),
					'postshow2' => esc_attr__( 'Post Show 2', 'deep' ),
					'postshow3' => esc_attr__( 'Post Show 3', 'deep' ),
					'postshow4' => esc_attr__( 'Post Show 4', 'deep' ),
					'postshow5' => esc_attr__( 'Post Show 5', 'deep' ),
				),
				'std'			=> 'postshow0',
			),
			array(
				'id'	=> 'deep_rec_post_style',
				'name'	=> esc_attr__( 'Style of Recommended Posts', 'deep' ),
				'type'	=> 'select',
				'options'     => array(
					'type0' => esc_attr__( 'Inherit from Theme Options', 'deep' ),
					'type1' => esc_attr__( 'Default Style', 'deep' ),
					'type2' => esc_attr__( 'Magazine Style', 'deep' ),
					'type3' => esc_attr__( 'Personal Blog Style', 'deep' ),
				),				
				'std'	=> 'type0',
			),
			array(
				'id'		=> 'deep_blogpost_review',
				'name'		=> esc_attr__( 'Post review', 'deep' ),
				'type'		=> 'text_list',
				'clone'  	=> true,
				'options'	=> array(
					'Subject'					=> '',
					'leave your rate from 5'	=> '',
				),
			),
			array(
				'id'	=> 'deep_featured_video_meta',
				'name'	=> esc_attr__( 'Video or Audio iFrame', 'deep' ),
				'desc'	=> esc_attr__( 'Enter the Embed Code', 'deep' ),
				'type'	=> 'textarea',
			),
			array(
				'id'	=> 'deep_post_excerpt',
				'name'	=> esc_attr__( 'Post Excerpt', 'deep' ),
				'desc'	=> esc_attr__( 'Enter the post Excerpt', 'deep' ),
				'type'	=> 'textarea',
			),
			array(
				'id'	=> 'deep_review_desc',
				'name'	=> esc_attr__( 'Review description', 'deep' ),
				'type'	=> 'textarea',
			),
		),
	);

	// Page
	$meta_boxes[] = array(
		'title'			=> esc_attr__( 'Webnus Page Options', 'deep' ),
		'post_types'	=> 'page',
		'fields'		=> array(
			array(
				'id'	=> 'deep_page_title_bar_meta',
				'name'	=> esc_attr__( 'Show Page Title:', 'deep' ),
				'type'	=> 'select',
				'options'     => array(
					'none' 	=> esc_attr__( 'Inherit from Theme Options', 'deep' ),
					'1' 	=> esc_attr__( 'Show', 'deep' ),
					'0' 	=> esc_attr__( 'Hide', 'deep' ),
				),
				'std'	=> 'none',
			),
			array(
				'id'	=> 'deep_custom_page_title',
				'name'	=> esc_attr__( 'Custom Page Title:', 'deep' ),
				'desc'	=> esc_attr__( 'It will show instead of page title.', 'deep' ),
				'type'	=> 'text',
			),
			array(
				'id'	=> 'deep_breadcrumb_meta',
				'name'	=> esc_attr__( 'Show Breadcrumb:', 'deep' ),
				'type'	=> 'select',
				'options'	=> array(
					'themeoptions'	=> esc_attr__( 'Inherit from Theme Options', 'deep' ),
					'yes'			=> esc_attr__( 'Yes', 'deep' ),
					'no'			=> esc_attr__( 'No', 'deep' ),
				),
				'std'	=> 'themeoptions',
			),
			array(
				'id'	=> 'deep_page_title_text_color_meta',
				'name'	=> esc_attr__( 'Page Title Text Color:', 'deep' ),
				'type'	=> 'color',
			),
			array(
				'id'	=> 'deep_page_title_bg_color_meta',
				'name'	=> esc_attr__( 'Page Title Background Color:', 'deep' ),
				'type'	=> 'color',
			),
			array(
				'id'	=> 'deep_page_title_bg_img',
				'name'	=> esc_attr__( 'Page Title Background Image:', 'deep' ),
				'type'	=> 'image_advanced',
			),
			array(
				'id'	=> 'deep_page_title_textalign',
				'name'	=> esc_attr__( 'Page Title text-align:', 'deep' ),
				'type'	=> 'select',
				'options'	=> array(
					'none'		=> esc_attr__( 'None', 'deep' ),
					'center'	=> esc_attr__( 'Center', 'deep' ),
					'left'		=> esc_attr__( 'Left', 'deep' ),
					'right'		=> esc_attr__( 'Right', 'deep' ),
				),
				'std'	=> 'none',
			),
			array(
				'id'	=> 'deep_page_title_font_size_meta',
				'name'	=> esc_attr__( 'Page Title Font Size:', 'deep' ),
				'desc'	=> esc_attr__( '(in px format)', 'deep' ),
				'type'	=> 'text',
			),
			array(
				'id'	=> 'deep_page_title_lineheight',
				'name'	=> esc_attr__( 'Page Title Line-height:', 'deep' ),
				'type'	=> 'text',
			),
			array(
				'id'	=> 'deep_page_title_height',
				'name'	=> esc_attr__( 'Page Title Height:', 'deep' ),
				'desc'	=> esc_attr__( '(in px format)', 'deep' ),
				'type'	=> 'text',
			),
			array(
				'id'	=> 'deep_page_title_mobileheight',
				'name'	=> esc_attr__( 'Page Title Mobile Height:', 'deep' ),
				'desc'	=> esc_attr__( '(in px format)', 'deep' ),
				'type'	=> 'text',
			),
			array(
				'id'	=> 'deep_page_title_padding',
				'name'	=> esc_attr__( 'Page Title Padding:', 'deep' ),
				'type'	=> 'text',
			),
			array(
				'type'	=>'divider',
			),
			array(
				'id'	=> 'deep_sidebar_position_meta',
				'name'	=> esc_attr__( 'Sidebar Position:', 'deep' ),
				'type'	=> 'select',
				'options'	=> array(
					'inherit'	=> esc_attr__( 'Inherit from Theme Options', 'deep' ),
					'none'		=> esc_attr__( 'None', 'deep' ),
					'right'		=> esc_attr__( 'Right', 'deep' ),
					'left'		=> esc_attr__( 'Left', 'deep' ),
					'both'		=> esc_attr__( 'Both', 'deep' ),
				),
				'std'		=> 'inherit',
			),
			array(
				'type'	=>'divider',
			),
			array(
				'id'	=> 'deep_header_show',
				'name'	=> esc_attr__( 'Show Header:', 'deep' ),
				'type'	=> 'switcher',
				'std'	=> 1,
			),
			array(
				'name'	=> esc_attr__( 'Transparent Header:', 'deep' ),
				'id'	=> 'deep_transparent_header_meta',
				'type'	=> 'select',
				'options'	=> array(
					'inherit'	=> esc_attr__( 'Inherit from Theme Options', 'deep' ),
					'none'		=> esc_attr__( 'None', 'deep' ),
					'light'		=> esc_attr__( 'Light Style', 'deep' ),
					'dark'		=> esc_attr__( 'Dark Style', 'deep' ),
				),
				'desc'	=> esc_attr__( 'To enable it you should set the option "Show Page Title" on "Hide" . If this page is supposed to be set as 404 page, please adjust it from Theme Options > Pages > 404 page', 'deep' ),
				'std'	=> 'inherit',
			),
			array(
				'id'	=> 'deep_footer_show',
				'name'	=> esc_attr__( 'Show Footer:', 'deep' ),
				'type'	=> 'switcher',
				'std'	=> 1,
			),
			array(
				'id'          => 'deep_custom_footer_for_this_page',
				'name'        => 'Select a footer',
				'type'        => 'post',
				'post_type'   => 'wbf_footer',
				'field_type'  => 'select_advanced',
				'placeholder' => 'Select a footer',
				'query_args'  => array(
					'post_status'    => 'publish',
					'posts_per_page' => - 1,
				),
			),
			array(
				'type'	=>'divider',
			),
			array(
				'id'	=> 'deep_edge_onepage',
				'name'	=> esc_attr__( 'Edge Onepager', 'deep' ),
				'desc'	=> esc_attr__( 'More Options in Deep > Theme options > Pages > Edge Onepager', 'deep' ),
				'type'	=> 'switcher',
				'std'	=> 0,
			),
			array(
				'id'	=> 'deep_wrap_color_meta',
				'name'	=> esc_attr__( 'Content Background Color:', 'deep' ),
				'type'	=> 'color',
			),
			array(
				'id'	=> 'deep_body_bg_color_meta',
				'name'	=> esc_attr__( 'Body Background Color:', 'deep' ),
				'type'	=> 'color',
			),
			array(
				'id'	=> 'deep_body_bg_img_meta',
				'name'	=> esc_attr__( 'Body Background Image:', 'deep' ),
				'type'	=> 'image_advanced',
			),
			array(
				'id'	=> 'deep_body_bg_image_100_meta',
				'name'	=> esc_attr__( '100% Background Image:', 'deep' ),
				'type'	=> 'switcher',
				'std'	=> 0,
			),
			array(
				'id'	=> 'deep_body_bg_image_repeat_meta',
				'name'	=> esc_attr__( 'Background Repeat:', 'deep' ),
				'type'	=> 'select',
				'options'	=> array(
					'0'	=> esc_attr__( 'No repeat', 'deep' ),
					'1'	=> esc_attr__( 'Repeat both vertically and horizontally', 'deep' ),
					'2'	=> esc_attr__( 'Repeat only horizontally', 'deep' ),
					'3'	=> esc_attr__( 'Repeat only vertically', 'deep' ),
				),
				'placeholder'	=> esc_attr__( 'Select an Item', 'deep' ),
			),
			array(
				'type'	=>'divider',
			),
		),
	);

	// Portfolio
	$meta_boxes[] = array(
		'title'			=> esc_attr__( 'Webnus Portfolio Options', 'deep' ),
		'post_types'	=> 'portfolio',
		'fields'		=> array(
			array(
				'id'	=> 'deep_portfolio_page_nav',
				'name'	=> esc_attr__( 'Please select navigation type', 'deep' ),
				'type'	=> 'image_select',
				'options'     => array(
					'nav1' => DEEP_ASSETS_URL . 'images/portfolio/nav1.jpg',
					'nav2' => DEEP_ASSETS_URL . 'images/portfolio/nav2.jpg',
					'nav3' => DEEP_ASSETS_URL . 'images/portfolio/nav3.jpg',
				),
				'placeholder' => esc_attr__( 'Select an Item', 'deep' ),
				
			),
			array(
				'id'	=> 'deep_portfolio_page_nav_align',
				'name'	=> esc_attr__( 'Select navigation align (for type 3)', 'deep' ),
				'type'	=> 'radio',
				'options'     => array(
					'left' 		=> 'Left',
					'center' 	=> 'Center',
					'right' 	=> 'Right',
				),
				'placeholder' => esc_attr__( 'Select an Item', 'deep' ),
				
			),
			array(
				'id'	=> 'deep_portfolio_page_related_work',
				'name'	=> esc_attr__( 'Display "Related Works"?', 'deep' ),
				'desc'	=> esc_attr__( 'If you want to display that, please check it. This section will show at the end of page', 'deep' ),
				'type'	=> 'checkbox',
			),
		),
	);

	// Mega Menu
	$meta_boxes[] = array(
		'title'			=> esc_attr__( 'Webnus Mega Menu Options', 'deep' ),
		'post_types'	=> 'mega_menu',
		'fields'		=> array(
			array(
				'id'			=> 'megamenu_width',
				'name'			=> esc_attr__( 'Width', 'deep' ),
				'type'			=> 'text',
				'placeholder'	=> esc_html__( 'Example: 1600', 'deep' ),
				'desc'			=> esc_attr__( 'This is calculated in pixels. Without entering % or px, write your preferred number.', 'deep' ),
			),
			array(
				'id'		=> 'megamenu_full_relative',
				'name'		=> esc_attr__( 'Displaying', 'deep' ),
				'type'		=> 'button_group',
				'options'  	=> array(
					'fullwidth'   => esc_html__( 'Fullwidth', 'deep' ),
					'inherit'    => esc_html__( 'Inherit from Theme Options', 'deep' ),
					'inheritfl'    => esc_html__( 'Inherit from Field', 'deep' ),
				),
				'inline' 	=> true,
				'std'		=> 'inherit',				
			),		
		),
	);

	if ( defined('RECIPES_DIR') ) {
		// recipes
		$meta_boxes[] = array(
			'title'			=> esc_attr__( 'Webnus Recipe Options', 'deep' ),
			'post_types'	=> 'recipe',
			'fields'		=> array(
				array(
					'id'	=> 'deep_recipe_transparent_header_meta',
					'name'	=> esc_attr__( 'Transparent Header:', 'deep' ),
					'type'	=> 'select',
					'options'	=> array(
						'light'	=> esc_attr__( 'Light Style', 'deep' ),
						'dark'	=> esc_attr__( 'Dark Style', 'deep' ),
					),
					'placeholder'	=> esc_attr__( 'Select an Item', 'deep' ),
				),
				array(
					'id'			=> 'deep_recipe',
					'name'			=> esc_attr__( 'Recipe', 'deep' ),
					'type'			=> 'text',
					'placeholder'	=> esc_html__( 'Recipe', 'deep' ),
				),
				array(
					'id'			=> 'deep_recipe_food_name',
					'name'			=> esc_attr__( 'Food Name', 'deep' ),
					'type'			=> 'text',
					'placeholder'	=> esc_html__( 'Food Name', 'deep' ),
				),
				array(
					'id'			=> 'deep_recipe_brief_desc',
					'name'			=> esc_attr__( 'Brief description', 'deep' ),
					'type'			=> 'text',
					'placeholder'	=> esc_html__( 'Short description', 'deep' ),
				),
				array(
					'id'			=> 'deep_recipe_serves',
					'name'			=> esc_attr__( 'Serves', 'deep' ),
					'type'			=> 'text',
					'placeholder'	=> esc_html__( '3 people', 'deep' ),
				),
				array(
					'id'			=> 'deep_recipe_prep_time',
					'name'			=> esc_attr__( 'Prep Time', 'deep' ),
					'type'			=> 'text',
					'placeholder'	=> esc_html__( '30 min', 'deep' ),
				),
				array(
					'id'			=> 'deep_recipe_calories',
					'name'			=> esc_attr__( 'Calories', 'deep' ),
					'type'			=> 'text',
					'placeholder'	=> esc_html__( '236 kcal', 'deep' ),
				),
				array(
					'id'			=> 'deep_recipe_cooking_time',
					'name'			=> esc_attr__( 'Cooking Time', 'deep' ),
					'type'			=> 'text',
					'placeholder'	=> esc_html__( '2 hours', 'deep' ),
				),
			),
		);
	}

	// Cause
	if ( defined('CAUSES_DIR') ) {

		$meta_boxes[] = array(
			'title'			=> esc_attr__( 'Webnus Cause Options', 'deep' ),
			'post_types'	=> 'cause',
			'fields'		=> array(
				
				array(
					'id'	=> 'deep_cause_end_date',
					'name'	=> esc_attr__( 'Cause End Date', 'deep' ),
					'desc'	=> esc_attr__( 'Insert date of Cause end. for example 8/12/2018', 'deep' ),
					'type'	=> 'date',
				),
				
				array(
					'id'	=> 'deep_cause_amount',
					'name'	=> esc_attr__( 'Cause Amount', 'deep' ),
					'desc'	=> esc_attr__( 'Insert total number of amount required for cause. for example 48000', 'deep' ),
					'type'	=> 'text',
				),
				
				array(
					'id'	=> 'deep_cause_amount_received',
					'name'	=> esc_attr__( 'Cause Amount Received', 'deep' ),
					'desc'	=> esc_attr__( 'This is the total amount reveived for this cause. for example 30000', 'deep' ),
					'type'	=> 'text',
				),
			),
		);

	}

	// Sermon
	if ( defined('SERMONS_DIR') ) {

		$meta_boxes[] = array(
			'title'			=> esc_attr__( 'Webnus Sermon Options', 'deep' ),
			'post_types'	=> 'sermon',
			'fields'		=> array(
				
				array(
					'id'	=> 'deep_sermon_video',
					'name'	=> esc_attr__( 'Video', 'deep' ),
					'desc'	=> esc_attr__( 'Enter the Video URL', 'deep' ),
					'type'	=> 'url',
				),
				
				array(
					'id'	=> 'deep_sermon_audio',
					'name'	=> esc_attr__( 'Audio', 'deep' ),
					'desc'	=> esc_attr__( 'Enter the Audio URL', 'deep' ),
					'type'	=> 'url',
				),
				
				array(
					'id'	=> 'deep_sermon_attachment',
					'name'	=> esc_attr__( 'File for Download', 'deep' ),
					'desc'	=> esc_attr__( 'Add the PDF or Media', 'deep' ),
					'type'	=> 'url',
				),
			),
		);

	}


	// Goal
	if ( defined('GOAL_DIR') ) {
		$meta_boxes[] = array(
			'title'			=> esc_attr__( 'Webnus Goal Options', 'deep' ),
			'post_types'	=> 'goal',
			'fields'		=> array(
				array(
					'id'	=> 'deep_goal_end_meta',
					'name'	=> esc_attr__( 'Goal End Date', 'deep' ),
					'desc'	=> esc_attr__( 'Insert date of Goal end.', 'deep' ),
					'type'	=> 'date',
					'js_options' => array(
						'changeMonth'		=> true,
						'changeYear'		=> true,
						'showButtonPanel'	=> true,
					),
				),
				array(
					'id'	=> 'deep_goal_amount_meta',
					'name'	=> esc_attr__( 'Goal Amount', 'deep' ),
					'desc'	=> esc_attr__( 'Insert total number of amount required for goal.', 'deep' ),
					'type'	=> 'text',
				),
				array(
					'id'	=> 'deep_goal_amount_received_meta',
					'name'	=> esc_attr__( 'Goal Amount Received', 'deep' ),
					'desc'	=> esc_attr__( 'This is the total amount revived for this goal.', 'deep' ),
					'type'	=> 'text',
				),
			),
		);
	}

	return $meta_boxes;
}