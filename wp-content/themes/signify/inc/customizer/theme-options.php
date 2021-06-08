<?php
/**
 * Theme Options
 *
 * @package Signify
 */

/**
 * Add theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function signify_theme_options( $wp_customize ) {
	$wp_customize->add_panel( 'signify_theme_options', array(
		'title'    => esc_html__( 'Theme Options', 'signify' ),
		'priority' => 130,
	) );

	signify_register_option( $wp_customize, array(
			'name'              => 'signify_latest_posts_title',
			'default'           => esc_html__( 'News', 'signify' ),
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Latest Posts Title', 'signify' ),
			'section'           => 'signify_theme_options',
		)
	);

	// Layout Options
	$wp_customize->add_section( 'signify_layout_options', array(
		'title' => esc_html__( 'Layout Options', 'signify' ),
		'panel' => 'signify_theme_options',
		)
	);

	/* Default Layout */
	signify_register_option( $wp_customize, array(
			'name'              => 'signify_default_layout',
			'default'           => 'right-sidebar',
			'sanitize_callback' => 'signify_sanitize_select',
			'label'             => esc_html__( 'Default Layout', 'signify' ),
			'section'           => 'signify_layout_options',
			'type'              => 'radio',
			'choices'           => array(
				'right-sidebar'         => esc_html__( 'Right Sidebar ( Content, Primary Sidebar )', 'signify' ),
				'no-sidebar-full-width' => esc_html__( 'No Sidebar: Full Width', 'signify' ),
			),
		)
	);

	/* Homepage/Archive Layout */
	signify_register_option( $wp_customize, array(
			'name'              => 'signify_homepage_archive_layout',
			'default'           => 'right-sidebar',
			'sanitize_callback' => 'signify_sanitize_select',
			'label'             => esc_html__( 'Homepage/Archive Layout', 'signify' ),
			'section'           => 'signify_layout_options',
			'type'              => 'radio',
			'choices'           => array(
				'right-sidebar'         => esc_html__( 'Right Sidebar ( Content, Primary Sidebar )', 'signify' ),
				'no-sidebar-full-width' => esc_html__( 'No Sidebar: Full Width', 'signify' ),
			),
		)
	);

	/* Single Page/Post Image */
	signify_register_option( $wp_customize, array(
			'name'              => 'signify_single_layout',
			'default'           => 'disabled',
			'sanitize_callback' => 'signify_sanitize_select',
			'label'             => esc_html__( 'Single Page/Post Image', 'signify' ),
			'section'           => 'signify_layout_options',
			'type'              => 'radio',
			'choices'           => array(
				'disabled'        => esc_html__( 'Disabled', 'signify' ),
				'post-thumbnail'  => esc_html__( 'Post Thumbnail', 'signify' ),
			),
		)
	);

	// Excerpt Options.
	$wp_customize->add_section( 'signify_excerpt_options', array(
		'panel'     => 'signify_theme_options',
		'title'     => esc_html__( 'Excerpt Options', 'signify' ),
	) );

	signify_register_option( $wp_customize, array(
			'name'              => 'signify_excerpt_length',
			'default'           => '20',
			'sanitize_callback' => 'absint',
			'input_attrs' => array(
				'min'   => 10,
				'max'   => 200,
				'step'  => 5,
				'style' => 'width: 60px;',
			),
			'label'    => esc_html__( 'Excerpt Length (words)', 'signify' ),
			'section'  => 'signify_excerpt_options',
			'type'     => 'number',
		)
	);

	signify_register_option( $wp_customize, array(
			'name'              => 'signify_excerpt_more_text',
			'default'           => esc_html__( 'Continue reading...', 'signify' ),
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Read More Text', 'signify' ),
			'section'           => 'signify_excerpt_options',
			'type'              => 'text',
		)
	);

	// Excerpt Options.
	$wp_customize->add_section( 'signify_search_options', array(
		'panel'     => 'signify_theme_options',
		'title'     => esc_html__( 'Search Options', 'signify' ),
	) );

	signify_register_option( $wp_customize, array(
			'name'              => 'signify_search_text',
			'default'           => esc_html__( 'Search', 'signify' ),
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Search Text', 'signify' ),
			'section'           => 'signify_search_options',
			'type'              => 'text',
		)
	);

	// Footer Options.
	$wp_customize->add_section( 'signify_footer_options', array(
		'title'       => esc_html__( 'Footer Options', 'signify' ),
		'description' => esc_html__( 'You can either add html or plain text or custom shortcodes, which will be automatically inserted into your theme. Some shorcodes: [the-year], [site-link] and [privacy-policy-link] for current year, site link and privacy policy link respectively.', 'signify' ),
		'panel'       => 'signify_theme_options',
	) );

	$theme_data = wp_get_theme();

	signify_register_option( $wp_customize, array(
			'name'              => 'signify_footer_copyright_text',
			'default'           => sprintf( _x( 'Copyright &copy; %1$s %2$s %3$s', '1: Year, 2: Site Title with home URL, 3: Privacy Policy Link', 'signify' ), '[the-year]', '[site-link]', '[privacy-policy-link]' ) . '<span class="sep"> | </span>',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Copyright Text', 'signify' ),
			'section'           => 'signify_footer_options',
			'type'              => 'textarea',
		)
	);

	signify_register_option( $wp_customize, array(
			'name'              => 'signify_reset_footer_content',
			'sanitize_callback' => 'signify_sanitize_checkbox',
			'label'             => esc_html__( 'Reset Footer Content', 'signify' ),
			'description'       => esc_html__( 'Refresh the page after save to view full effects.', 'signify' ),
			'section'           => 'signify_footer_options',
			'transport'         => 'postMessage',
			'type'              => 'checkbox',
		)
	);

	// Homepage / Frontpage Options.
	$wp_customize->add_section( 'signify_homepage_options', array(
		'description' => esc_html__( 'Only posts that belong to the categories selected here will be displayed on the front page', 'signify' ),
		'panel'       => 'signify_theme_options',
		'title'       => esc_html__( 'Homepage / Frontpage Options', 'signify' ),
	) );

	signify_register_option( $wp_customize, array(
			'name'              => 'signify_recent_posts_heading',
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => esc_html__( 'News', 'signify' ),
			'label'             => esc_html__( 'Recent Posts Heading', 'signify' ),
			'section'           => 'signify_homepage_options',
		)
	);

	signify_register_option( $wp_customize, array(
			'name'              => 'signify_static_page_heading',
			'sanitize_callback' => 'sanitize_text_field',
			'active_callback'	=> 'signify_is_static_page_enabled',
			'default'           => esc_html__( 'Archives', 'signify' ),
			'label'             => esc_html__( 'Posts Page Header Text', 'signify' ),
			'section'           => 'signify_homepage_options',
		)
	);

	signify_register_option( $wp_customize, array(
			'name'              => 'signify_front_page_category',
			'sanitize_callback' => 'signify_sanitize_category_list',
			'custom_control'    => 'Signify_Multi_Cat',
			'label'             => esc_html__( 'Categories', 'signify' ),
			'section'           => 'signify_homepage_options',
			'type'              => 'dropdown-categories',
		)
	);

	//Menu Options
	$wp_customize->add_section( 'signify_menu_options', array(
		'title'       => esc_html__( 'Menu Options', 'signify' ),
		'panel'       => 'signify_theme_options',
	) );

	signify_register_option( $wp_customize, array(
			'name'              => 'signify_primary_search_enable',
			'sanitize_callback' => 'signify_sanitize_checkbox',
			'label'             => esc_html__( 'Search in Primary Menu', 'signify' ),
			'section'           => 'signify_menu_options',
			'type'              => 'checkbox',
		)
	);

	// Pagination Options.
	$pagination_type = get_theme_mod( 'signify_pagination_type', 'default' );

	$nav_desc = '';

	/**
	* Check if navigation type is Jetpack Infinite Scroll and if it is enabled
	*/
	$nav_desc = sprintf(
		wp_kses(
			__( 'For infinite scrolling, use %1$sJetpack%2$s with Infinite Scroll module Enabled.', 'signify' ),
			array(
				'a' => array(
					'href' => array(),
					'target' => array(),
				),
				'br'=> array()
			)
		),
		'<a target="_blank" href="https://wordpress.org/plugins/jetpack/">',
		'</a>'
	);

	$wp_customize->add_section( 'signify_pagination_options', array(
		'description'     => $nav_desc,
		'panel'           => 'signify_theme_options',
		'title'           => esc_html__( 'Pagination Options', 'signify' ),
		'active_callback' => 'signify_scroll_plugins_inactive'
	) );

	signify_register_option( $wp_customize, array(
			'name'              => 'signify_pagination_type',
			'default'           => 'default',
			'sanitize_callback' => 'signify_sanitize_select',
			'choices'           => signify_get_pagination_types(),
			'label'             => esc_html__( 'Pagination type', 'signify' ),
			'section'           => 'signify_pagination_options',
			'type'              => 'select',
		)
	);

	/* Scrollup Options */
	$wp_customize->add_section( 'signify_scrollup', array(
		'panel'    => 'signify_theme_options',
		'title'    => esc_html__( 'Scrollup Options', 'signify' ),
	) );

	signify_register_option( $wp_customize, array(
			'name'              => 'signify_disable_scrollup',
			'default'			=> 1,
			'sanitize_callback' => 'signify_sanitize_checkbox',
			'label'             => esc_html__( 'Scroll Up', 'signify' ),
			'section'           => 'signify_scrollup',
			'type'              => 'checkbox',
		)
	);
}
add_action( 'customize_register', 'signify_theme_options' );

/** Active Callback Functions */

if ( ! function_exists( 'signify_scroll_plugins_inactive' ) ) :
	/**
	* Return true if infinite scroll functionality exists
	*
	* @since 1.0.0
	*/
	function signify_scroll_plugins_inactive( $control ) {
		if ( ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) || class_exists( 'Catch_Infinite_Scroll' ) ) {
			// Support infinite scroll plugins.
			return false;
		}

		return true;
	}
endif;

if ( ! function_exists( 'signify_is_static_page_enabled' ) ) :
	/**
	* Return true if A Static Page is enabled
	*
	* @since Signify Pro 1.1.2
	*/
	function signify_is_static_page_enabled( $control ) {
		$enable = $control->manager->get_setting( 'show_on_front' )->value();
		if ( 'page' === $enable ) {
			return true;
		}
		return false;
	}
endif;

if ( ! function_exists( 'signify_is_to_top_inactive' ) ) :
    /**
    * Return true if to top is active
    *
    * @since Signify 0.1
    */
    function signify_is_to_top_inactive( $control ) {
        return ! ( class_exists( 'To_Top' ) );
    }
endif;
