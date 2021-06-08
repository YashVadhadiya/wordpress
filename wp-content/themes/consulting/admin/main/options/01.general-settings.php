<?php
/**
 * General settings functions.
 *
 * @package ThinkUpThemes
 */

/* ----------------------------------------------------------------------------------
	Logo Settings
---------------------------------------------------------------------------------- */

function consulting_thinkup_custom_logo() {

	$output = NULL;

    // Get logo image url if image has been assigned.
	$check_logoset = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );

	if ( ! empty( $check_logoset[0] ) ) {
	   if ( function_exists( 'the_custom_logo' ) ) {
			$output = get_custom_logo();
		}
	} else {
		$output .= '<a rel="home" href="' . esc_url( home_url( '/' ) ) . '">';
		$output .= '<h1 rel="home" class="site-title" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '">' . esc_html( get_bloginfo( 'name' ) ) . '</h1>';
		$output .= '<h2 class="site-description" title="' . esc_attr( get_bloginfo( 'description', 'display' ) ) . '">' . esc_html( get_bloginfo( 'description' ) ) . '</h2>';
		$output .= '</a>';
	}

	// Output logo is set
	if ( ! empty( $output ) ) {
		return $output;
	}
}


/* ----------------------------------------------------------------------------------
	Page Layout
---------------------------------------------------------------------------------- */

/* Add Custom Sidebar css */
function consulting_thinkup_sidebar_css($classes) {

// Get theme options values.
$thinkup_homepage_layout           = consulting_thinkup_var ( 'thinkup_homepage_layout' );
$thinkup_general_layout            = consulting_thinkup_var ( 'thinkup_general_layout' );
$thinkup_blog_layout               = consulting_thinkup_var ( 'thinkup_blog_layout' );
$thinkup_post_layout               = consulting_thinkup_var ( 'thinkup_post_layout' );
$thinkup_portfolio_layout          = consulting_thinkup_var ( 'thinkup_portfolio_layout' );
$thinkup_project_layout            = consulting_thinkup_var ( 'thinkup_project_layout' );
$thinkup_woocommerce_layout        = consulting_thinkup_var ( 'thinkup_woocommerce_layout' );
$thinkup_woocommerce_layoutproduct = consulting_thinkup_var ( 'thinkup_woocommerce_layoutproduct' );

	$class_sidebar = NULL;

	if ( is_front_page() ) {
		if ( $thinkup_homepage_layout == "option1" or empty( $thinkup_homepage_layout ) ) {		
			$class_sidebar = '';
		} else if ( $thinkup_homepage_layout == "option2" ) {
			$class_sidebar = 'layout-sidebar-left';
		} else if ( $thinkup_homepage_layout == "option3" ) {
			$class_sidebar = 'layout-sidebar-right';
		}
	} else if ( is_page() ) {	
		if ( $thinkup_general_layout == "option1" or empty( $thinkup_general_layout ) ) {		
			$class_sidebar = '';
		} else if ( $thinkup_general_layout == "option2" ) {
			$class_sidebar = 'layout-sidebar-left';
		} else if ( $thinkup_general_layout == "option3" ) {
			$class_sidebar = 'layout-sidebar-right';
		}
	} else if ( consulting_thinkup_check_isblog() and ! is_single() ) {
		if ( $thinkup_blog_layout == "option1" or empty( $thinkup_blog_layout ) ) {		
			$class_sidebar = '';
		} else if ( $thinkup_blog_layout == "option2" ) {
			$class_sidebar = 'layout-sidebar-left';
		} else if ( $thinkup_blog_layout == "option3" ) {
			$class_sidebar = 'layout-sidebar-right';
		}
	} else if ( is_singular( 'post' ) ) {
		if ( $thinkup_post_layout == "option1" or empty( $thinkup_post_layout ) ) {		
			$class_sidebar = '';
		} else if ( $thinkup_post_layout == "option2" ) {
			$class_sidebar = 'layout-sidebar-left';
		} else if ( $thinkup_post_layout == "option3" ) {
			$class_sidebar = 'layout-sidebar-right';
		} else {
			$class_sidebar = '';
		}
	} else if ( is_search() ) {
		if ( $thinkup_general_layout == "option1" or empty( $thinkup_general_layout ) ) {		
			$class_sidebar = '';
		} else if ( $thinkup_general_layout == "option2" ) {
			$class_sidebar = 'layout-sidebar-left';
		} else if ($thinkup_general_layout == "option3") {
			$class_sidebar = 'layout-sidebar-right';
		}
	}

	// Output sidebar class
	if( ! empty( $class_sidebar ) ) {
		$classes[] = $class_sidebar;
	} else {
		$classes[] = 'layout-sidebar-none';
	}
	return $classes;
}
add_action( 'body_class', 'consulting_thinkup_sidebar_css' );

/* Add Custom Sidebar html */
function consulting_thinkup_sidebar_html() {

// Get theme options values.
$thinkup_homepage_layout           = consulting_thinkup_var ( 'thinkup_homepage_layout' );
$thinkup_general_layout            = consulting_thinkup_var ( 'thinkup_general_layout' );
$thinkup_blog_layout               = consulting_thinkup_var ( 'thinkup_blog_layout' );
$thinkup_post_layout               = consulting_thinkup_var ( 'thinkup_post_layout' );
$thinkup_portfolio_layout          = consulting_thinkup_var ( 'thinkup_portfolio_layout' );
$thinkup_project_layout            = consulting_thinkup_var ( 'thinkup_project_layout' );
$thinkup_woocommerce_layout        = consulting_thinkup_var ( 'thinkup_woocommerce_layout' );
$thinkup_woocommerce_layoutproduct = consulting_thinkup_var ( 'thinkup_woocommerce_layoutproduct' );

do_action('consulting_thinkup_sidebar_html');

	if ( is_front_page() ) {	
		if ( $thinkup_homepage_layout == "option1" or empty( $thinkup_homepage_layout ) ) {		
				echo '';
		} else if ( $thinkup_homepage_layout == "option2" ) {
				echo get_sidebar(); 
		} else if ( $thinkup_homepage_layout == "option3" ) {
				echo get_sidebar();
		}
	} else if ( is_page() ) {	
		if ( $thinkup_general_layout == "option1" or empty( $thinkup_general_layout ) ) {		
			echo '';
		} else if ( $thinkup_general_layout == "option2" ) {
			echo get_sidebar();
		} else if ( $thinkup_general_layout == "option3" ) {
			echo get_sidebar();
		}
	} else if ( consulting_thinkup_check_isblog() and ! is_single() ) {
		if ( $thinkup_blog_layout == "option1" or empty( $thinkup_blog_layout ) ) {		
			echo '';
		} else if ( $thinkup_blog_layout == "option2" ) {
			echo get_sidebar();
		} else if ( $thinkup_blog_layout == "option3" ) {
			echo get_sidebar();
		}
	} else if ( is_singular( 'post' ) ) {
		if ( $thinkup_post_layout == "option1" or empty( $thinkup_post_layout ) ) {
			echo '';
		} else if ( $thinkup_post_layout == "option2" ) {
			echo get_sidebar();
		} else if ( $thinkup_post_layout == "option3" ) {
			echo get_sidebar();
		} else {
			echo '';
		}
	} else if ( is_search() ) {
		if ( $thinkup_general_layout == 'option1' or empty( $thinkup_general_layout ) ) {		
			echo '';
		} else if ( $thinkup_general_layout == "option2" ) {
			get_sidebar();
		} else if ( $thinkup_general_layout == "option3" ) {
			get_sidebar();
		}
	}
}


/* ----------------------------------------------------------------------------------
	Select a Sidebar
---------------------------------------------------------------------------------- */

/* Add Selected Sidebar To Specific Pages */
function consulting_thinkup_input_sidebars() {

// Get theme options values.
$thinkup_general_sidebars            = consulting_thinkup_var ( 'thinkup_general_sidebars' );
$thinkup_homepage_sidebars           = consulting_thinkup_var ( 'thinkup_homepage_sidebars' );
$thinkup_blog_sidebars               = consulting_thinkup_var ( 'thinkup_blog_sidebars' );
$thinkup_post_sidebars               = consulting_thinkup_var ( 'thinkup_post_sidebars' );
$thinkup_portfolio_sidebars          = consulting_thinkup_var ( 'thinkup_portfolio_sidebars' );
$thinkup_project_sidebars            = consulting_thinkup_var ( 'thinkup_project_sidebars' );
$thinkup_woocommerce_sidebars        = consulting_thinkup_var ( 'thinkup_woocommerce_sidebars' );
$thinkup_woocommerce_sidebarsproduct = consulting_thinkup_var ( 'thinkup_woocommerce_sidebarsproduct' );

	if ( is_front_page() ) {
		$output = $thinkup_homepage_sidebars;
	} else if ( is_page() ) {
		$output = $thinkup_general_sidebars;
	} else if ( consulting_thinkup_check_isblog() and ! is_single() ) {
		$output = $thinkup_blog_sidebars;
	} else if ( is_singular( 'post' ) ) {
		$output = $thinkup_post_sidebars;
	} else if ( is_search() ) {	
		$output = $thinkup_general_sidebars;
	}

	if ( empty( $output ) or $output == 'Select a sidebar:' ) {
		$output = 'Sidebar';
	}

return $output;
}


/* ----------------------------------------------------------------------------------
	Intro Default options
---------------------------------------------------------------------------------- */

/* Add custom intro section [Extend for more options in future update] */
function consulting_thinkup_custom_intro() {

// Get theme options values.
$thinkup_general_breadcrumbswitch = consulting_thinkup_var ( 'thinkup_general_breadcrumbswitch' );

$class_intro = NULL;

	if ( ! is_front_page() ) {

		// Determine if breadcrumb is enables. Ensures table-cells align correctly with css
		if ( $thinkup_general_breadcrumbswitch == '1' ) {
			$class_intro = 'option2';
		}

		// If no breadcrumbs are available on current page then change intro class to option1
		if ( consulting_thinkup_input_breadcrumbswitch() == '' ) { 
			$class_intro = 'option1'; 
		}

		// Output intro with breadcrumbs if set
		echo	'<div id="intro" class="' . esc_attr( $class_intro ) . '"><div class="wrap-safari"><div id="intro-core"><div id="intro-core-wrap">',
				'<h1 class="page-title">',
				consulting_thinkup_title_select(),
				'</h1>',
				consulting_thinkup_input_breadcrumbswitch(),
				'</div></div></div></div>';
	}
}

function consulting_thinkup_custom_introbackground() {

// Get theme options values.
$thinkup_general_introbackgroundcolor = consulting_thinkup_var ( 'thinkup_general_introbackgroundcolor' );

$output = NULL;

	if ( ! empty( $thinkup_general_introbackgroundcolor ) ) {
		$output .= '#intro {';
		$output .= 'background: ' . esc_html( $thinkup_general_introbackgroundcolor ) . ';';
		$output .= '}';
	}

	if( ! empty( $output ) ) {
		echo '<style>' . $output . '</style>';
	}
}
add_action( 'wp_head','consulting_thinkup_custom_introbackground', '12' );

/* Add custom intro class - Determine whether intro is enabled or disabled */
function consulting_thinkup_custom_introclass($classes) {

// Get theme options values.
$thinkup_general_introstyle = consulting_thinkup_var ( 'thinkup_general_introstyle' );

	if ( ! is_front_page() ) {
		$classes[] = 'intro-on';

		// Output intro style class
		if( empty( $thinkup_general_introstyle ) or $thinkup_general_introstyle == 'option1' ) {
			$classes[] = 'intro-style1';
		} else if( $thinkup_general_introstyle == 'option2' ) {
			$classes[] = 'intro-style2';
		}

	}
	return $classes;
}
add_action( 'body_class', 'consulting_thinkup_custom_introclass');


/* ----------------------------------------------------------------------------------
	Enable Breadcrumbs
---------------------------------------------------------------------------------- */

/* Toggle Breadcrumbs */
function consulting_thinkup_input_breadcrumbswitch() {

// Get theme options values.
$thinkup_general_breadcrumbswitch = consulting_thinkup_var ( 'thinkup_general_breadcrumbswitch' );

	if( ! is_front_page() ) {
		if ( $thinkup_general_breadcrumbswitch == '0' or empty( $thinkup_general_breadcrumbswitch ) ) {
			return '';
		} else if ( $thinkup_general_breadcrumbswitch == '1' ) {
			return consulting_thinkup_input_breadcrumb();
		}
	}
}


/* ----------------------------------------------------------------------------------
	Enable Responsive Layout
---------------------------------------------------------------------------------- */

/* http://wordpress.stackexchange.com/questions/27497/how-to-use-wp-nav-menu-to-create-a-select-menu-dropdown */
class consulting_thinkup_nav_menu_responsive extends Walker_Nav_Menu{

	function start_el(&$output, $item, $depth=0, $args=array(), $id = 0) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
 
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';
 
		$output .= $indent . '<li id="res-menu-item-'. $item->ID . '"' . $value . $class_names .'>';

		$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_url( $item->url ) . '"' : '';

        // Insert title for top level
		$title = ( $depth == 0 )
			? '<span>' . apply_filters( 'the_title', $item->title, $item->ID ) . '</span>' : apply_filters( 'the_title', $item->title, $item->ID );

        // Insert sub-menu titles
		if ( $depth > 0 ) {
			$title = str_repeat('&#45; ', $depth ) . esc_html( $item->title );
		}

        // Structure of output
		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . $title . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

// Fallback responsive menu when custom header menu has not been set.
function consulting_thinkup_input_responsivefall() {

	$output = wp_list_pages('echo=0&title_li=');

	echo '<div id="header-responsive-inner" class="responsive-links nav-collapse collapse"><ul>',
		 $output,
		 '</ul></div>';
}

function consulting_thinkup_input_responsivehtml1() {

// Get theme options values.
$thinkup_general_fixedlayoutswitch = consulting_thinkup_var ( 'thinkup_general_fixedlayoutswitch' );

	if ( $thinkup_general_fixedlayoutswitch !== '1' ) {

		echo '<div id="header-nav">',
		     '<a class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse" tabindex="0">',
		     '<span class="icon-bar"></span>',
		     '<span class="icon-bar"></span>',
		     '<span class="icon-bar"></span>',
		     '</a>',
		     '</div>';
	}
}

function consulting_thinkup_input_responsivehtml2() {

// Get theme options values.
$thinkup_general_fixedlayoutswitch = consulting_thinkup_var ( 'thinkup_general_fixedlayoutswitch' );

	if ( $thinkup_general_fixedlayoutswitch !== '1' ) {

		echo '<div id="header-responsive">',
		     wp_nav_menu( 
				array(
					'container_class' => 'responsive-links nav-collapse collapse', 
					'container_id'    => 'header-responsive-inner', 
					'menu_class'      => '', 
					'theme_location'  => 'header_menu', 
					'walker'          => new consulting_thinkup_nav_menu_responsive(), 
					'fallback_cb'     => 'consulting_thinkup_input_responsivefall',
				)
			),
		    '</div>';
	}
}

function consulting_thinkup_input_responsivecss() {

// Get theme options values.
$thinkup_general_fixedlayoutswitch = consulting_thinkup_var ( 'thinkup_general_fixedlayoutswitch' );
	
	if ( $thinkup_general_fixedlayoutswitch !== '1' ) {
		wp_enqueue_style ( 'consulting-thinkup-responsive' );
	}
}
add_action( 'wp_enqueue_scripts', 'consulting_thinkup_input_responsivecss', '12' );

function consulting_thinkup_input_responsiveclass($classes){

// Get theme options values.
$thinkup_general_fixedlayoutswitch = consulting_thinkup_var ( 'thinkup_general_fixedlayoutswitch' );

	if ( $thinkup_general_fixedlayoutswitch == '1' ) {
		$classes[] = 'layout-fixed';
	} else {
		$classes[] = 'layout-responsive';	
	}
	return $classes;
}
add_action( 'body_class', 'consulting_thinkup_input_responsiveclass');


?>