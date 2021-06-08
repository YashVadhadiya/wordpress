<?php
/**
 * Signify Pro functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Signify
 */

if ( ! function_exists( 'signify_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function signify_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Signify Pro, use a find and replace
		 * to change 'signify' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'signify', get_parent_theme_file_path( '/languages' ) );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, and column width.
		 *
		 * Google fonts url addition
		 *
		 * Font Awesome addition
		 */
		add_editor_style( array(
			'css/editor-style.css',
			signify_fonts_url(),
			get_template_directory_uri() . '/css/font-awesome/css/font-awesome.css' )
		);

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// Used in Portfolio
		set_post_thumbnail_size( 666, 666, true ); // Ratio 1:1

		// Used in featured slider
		add_image_size( 'signify-slider', 1920, 1080, true );

		// Used in featured content
		add_image_size( 'signify-featured-content', 440, 330, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1'        => esc_html__( 'Primary', 'signify' ),
			'social-footer' => esc_html__( 'Footer Social Menu', 'signify' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		/**
		 * Add support for essential widget image.
		 *
		 */
		add_theme_support( 'ew-newsletter-image' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Add support for responsive embeds.
		add_theme_support( 'responsive-embeds' );

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => esc_html__( 'Small', 'signify' ),
					'shortName' => esc_html__( 'S', 'signify' ),
					'size'      => 13,
					'slug'      => 'small',
				),
				array(
					'name'      => esc_html__( 'Normal', 'signify' ),
					'shortName' => esc_html__( 'M', 'signify' ),
					'size'      => 18,
					'slug'      => 'normal',
				),
				array(
					'name'      => esc_html__( 'Large', 'signify' ),
					'shortName' => esc_html__( 'L', 'signify' ),
					'size'      => 42,
					'slug'      => 'large',
				),
				array(
					'name'      => esc_html__( 'Huge', 'signify' ),
					'shortName' => esc_html__( 'XL', 'signify' ),
					'size'      => 56,
					'slug'      => 'huge',
				),
			)
		);

		// Add support for custom color scheme.
		add_theme_support( 'editor-color-palette', array(
			array(
				'name'  => esc_html__( 'White', 'signify' ),
				'slug'  => 'white',
				'color' => '#ffffff',
			),
			array(
				'name'  => esc_html__( 'Black', 'signify' ),
				'slug'  => 'black',
				'color' => '#000000',
			),
			array(
				'name'  => esc_html__( 'Eighty Black', 'signify' ),
				'slug'  => 'eighty-black',
				'color' => '#151515',
			),
			array(
				'name'  => esc_html__( 'Sixty Five Black', 'signify' ),
				'slug'  => 'sixty-five-black',
				'color' => '#151515',
			),
			array(
				'name'  => esc_html__( 'Gray', 'signify' ),
				'slug'  => 'gray',
				'color' => '#444444',
			),
			array(
				'name'  => esc_html__( 'Medium Gray', 'signify' ),
				'slug'  => 'medium-gray',
				'color' => '#7b7b7b',
			),
			array(
				'name'  => esc_html__( 'Light Gray', 'signify' ),
				'slug'  => 'light-gray',
				'color' => '#f8f8f8',
			),
			array(
				'name'  => esc_html__( 'Dark Yellow', 'signify' ),
				'slug'  => 'dark-yellow',
				'color' => '#ffa751',
			),
			array(
				'name'  => esc_html__( 'Yellow', 'signify' ),
				'slug'  => 'yellow',
				'color' => '#f9a926',
			),
		) );
	}
endif;
add_action( 'after_setup_theme', 'signify_setup' );

/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 *
 */
function signify_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-2' ) ) {
		$count++;
	}

	if ( is_active_sidebar( 'sidebar-3' ) ) {
		$count++;
	}

	if ( is_active_sidebar( 'sidebar-4' ) ) {
		$count++;
	}

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
		case '4':
			$class = 'four';
			break;
	}

	if ( $class ) {
		echo 'class="widget-area footer-widget-area ' . esc_attr( $class ) . '"';
	}
}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function signify_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'signify_content_width', 920 );
}
add_action( 'after_setup_theme', 'signify_content_width', 0 );

if ( ! function_exists( 'signify_template_redirect' ) ) :
	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet for different value other than the default one
	 *
	 * @global int $content_width
	 */
	function signify_template_redirect() {
		$layout = signify_get_theme_layout();

		if ( 'no-sidebar-full-width' === $layout ) {
			$GLOBALS['content_width'] = 1510;
		}
	}
endif;
add_action( 'template_redirect', 'signify_template_redirect' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function signify_widgets_init() {
	$args = array(
		'before_widget' => '<section id="%1$s" class="widget %2$s"> <div class="widget-wrap">',
		'after_widget'  => '</div></section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	);

	register_sidebar( array(
		'name'        => esc_html__( 'Sidebar', 'signify' ),
		'id'          => 'sidebar-1',
		'description' => esc_html__( 'Add widgets here.', 'signify' ),
		) + $args
	);

	register_sidebar( array(
		'name'        => esc_html__( 'Footer 1', 'signify' ),
		'id'          => 'sidebar-2',
		'description' => esc_html__( 'Add widgets here to appear in your footer.', 'signify' ),
		) + $args
	);

	register_sidebar( array(
		'name'        => esc_html__( 'Footer 2', 'signify' ),
		'id'          => 'sidebar-3',
		'description' => esc_html__( 'Add widgets here to appear in your footer.', 'signify' ),
		) + $args
	);

	register_sidebar( array(
		'name'        => esc_html__( 'Footer 3', 'signify' ),
		'id'          => 'sidebar-4',
		'description' => esc_html__( 'Add widgets here to appear in your footer.', 'signify' ),
		) + $args
	);
}
add_action( 'widgets_init', 'signify_widgets_init' );

if ( ! function_exists( 'signify_fonts_url' ) ) :
	/**
	 * Register Google fonts for Signify Pro
	 *
	 * Create your own signify_fonts_url() function to override in a child theme.
	 *
	 * @since 1.0.0
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function signify_fonts_url() {
		$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	* supported by Open Sans, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$open_sans = _x( 'on', 'Open Sans: on or off', 'signify' );

	/* Translators: If there are characters in your language that are not
	* supported by Playfair Display, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$playfair_display = _x( 'on', 'Playfair Display font: on or off', 'signify' );

	if ( 'off' !== $open_sans || 'off' !== $playfair_display ) {
		$font_families = array();

		if ( 'off' !== $open_sans ) {
		$font_families[] = 'Open Sans';
		}

		if ( 'off' !== $playfair_display ) {
		$font_families[] = 'Playfair Display';
		}

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
	}
endif;

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since 1.0.0
 */
function signify_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'signify_javascript_detection', 0 );

/**
 * Enqueue scripts and styles.
 */
function signify_scripts() {
	$min  = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'signify-fonts', signify_fonts_url(), array(), null );

	// Theme stylesheet.
	wp_enqueue_style( 'signify-style', get_stylesheet_uri(), null, date( 'Ymd-Gis', filemtime( get_template_directory() . '/style.css' ) ) );

	// Theme block stylesheet.
	wp_enqueue_style( 'signify-block-style', get_theme_file_uri( '/css/blocks.css' ), array( 'signify-style' ), '1.0' );

	// Load the html5 shiv.
	wp_enqueue_script( 'signify-html5',  get_template_directory_uri() . '/js/html5' . $min . '.js', null, '3.7.3' );

	wp_script_add_data( 'signify-html5', 'conditional', 'lt IE 9' );

	// Font Awesome
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome/css/font-awesome.css', array(), '4.7.0', 'all' );

	wp_enqueue_script( 'signify-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix' . $min . '.js', array(), '201800703', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_register_script( 'jquery-match-height', get_template_directory_uri() . '/js/jquery.matchHeight' . $min . '.js', array( 'jquery' ), '201800703', true );

	$deps[] = 'jquery';

	$enable_featured_content = get_theme_mod( 'signify_featured_content_option', 'disabled' );

	if ( signify_check_section( $enable_featured_content ) ) {
		$deps[] = 'jquery-match-height';
	}

	$enable_portfolio = get_theme_mod( 'signify_portfolio_option', 'disabled' );

	if ( signify_check_section( $enable_portfolio ) ) {
		$deps[] = 'jquery-masonry';
	}

	$enable_slider      = signify_check_section( get_theme_mod( 'signify_slider_option', 'disabled' ) );
	$enable_testimonial_slider = signify_check_section( get_theme_mod( 'signify_testimonial_option', 'disabled' ) );

	if ( $enable_slider || $enable_testimonial_slider ) {
		// Enqueue owl carousel css. Must load CSS before JS.
		wp_enqueue_style( 'owl-carousel-core', get_theme_file_uri( 'css/owl-carousel/owl.carousel' . $min . '.css' ), null, '2.3.4' );
		wp_enqueue_style( 'owl-carousel-default', get_theme_file_uri( 'css/owl-carousel/owl.theme.default' . $min . '.css' ), null, '2.3.4' );

		// Enqueue script
		wp_enqueue_script( 'owl-carousel', get_theme_file_uri( 'js/owl.carousel' . $min . '.js' ) , array( 'jquery' ), '2.3.4', true );

		$deps[] = 'owl-carousel';

	}

	wp_enqueue_script( 'signify-script', get_template_directory_uri() . '/js/functions' . $min . '.js', $deps, '201800703', true );

	wp_localize_script( 'signify-script', 'signifyOptions', array(
		'screenReaderText' => array(
			'expand'   => esc_html__( 'expand child menu', 'signify' ),
			'collapse' => esc_html__( 'collapse child menu', 'signify' ),
		),
		'rtl' => is_rtl(),
	) );

	// Remove Media CSS, we have ouw own CSS for this.
	wp_deregister_style('wp-mediaelement');
}
add_action( 'wp_enqueue_scripts', 'signify_scripts' );

/**
 * Enqueue editor styles for Gutenberg
 */
function signify_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'signify-block-editor-style', get_theme_file_uri( 'css/editor-blocks.css' ) );

	// Add custom fonts.
	wp_enqueue_style( 'signify-fonts', signify_fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'signify_block_editor_styles' );

if ( ! function_exists( 'signify_excerpt_length' ) ) :
	/**
	 * Sets the post excerpt length to n words.
	 *
	 * function tied to the excerpt_length filter hook.
	 * @uses filter excerpt_length
	 *
	 * @since 1.0.0
	 */
	function signify_excerpt_length( $length ) {
		if ( is_admin() ) {
			return $length;
		}

		// Getting data from Customizer Options
		$length	= get_theme_mod( 'signify_excerpt_length', 20 );

		return absint( $length );
	}
endif; //signify_excerpt_length
add_filter( 'excerpt_length', 'signify_excerpt_length', 999 );

if ( ! function_exists( 'signify_excerpt_more' ) ) :
	/**
	 * Replaces "[...]" (appended to automatically generated excerpts) with ... and a option from customizer
	 *
	 * @return string option from customizer prepended with an ellipsis.
	 */
	function signify_excerpt_more( $more ) {
		if ( is_admin() ) {
			return $more;
		}

		$more_tag_text = get_theme_mod( 'signify_excerpt_more_text',  esc_html__( 'Continue reading', 'signify' ) );

		$link = sprintf( '<p><a href="%1$s" class="more-link">%2$s</a></p>',
			esc_url( get_permalink() ),
			/* translators: %s: Name of current post */
			wp_kses_data( $more_tag_text ). '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>'
			);

		return $link;
	}
endif;
add_filter( 'excerpt_more', 'signify_excerpt_more' );

if ( ! function_exists( 'signify_custom_excerpt' ) ) :
	/**
	 * Adds Continue reading link to more tag excerpts.
	 *
	 * function tied to the get_the_excerpt filter hook.
	 *
	 * @since 1.0.0
	 */
	function signify_custom_excerpt( $output ) {
		if ( has_excerpt() && ! is_attachment() ) {
			$more_tag_text = get_theme_mod( 'signify_excerpt_more_text', esc_html__( 'Continue reading', 'signify' ) );

			$link = sprintf( '<a href="%1$s" class="more-link">%2$s</a>',
				esc_url( get_permalink() ),
				/* translators: %s: Name of current post */
				wp_kses_data( $more_tag_text ). '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>'
			);

			$link = ' &hellip; ' . $link;

			$output .= $link;
		}

		return $output;
	}
endif; //signify_custom_excerpt
add_filter( 'get_the_excerpt', 'signify_custom_excerpt' );

if ( ! function_exists( 'signify_more_link' ) ) :
	/**
	 * Replacing Continue reading link to the_content more.
	 *
	 * function tied to the the_content_more_link filter hook.
	 *
	 * @since 1.0.0
	 */
	function signify_more_link( $more_link, $more_link_text ) {
		$more_tag_text = get_theme_mod( 'signify_excerpt_more_text', esc_html__( 'Continue reading', 'signify' ) );

		return ' &hellip; ' . str_replace( $more_link_text, wp_kses_data( $more_tag_text ), $more_link );
	}
endif; //signify_more_link
add_filter( 'the_content_more_link', 'signify_more_link', 10, 2 );

/**
 * Checks if there are options already present from free version and adds it to the Pro theme options
 *
 * @since 1.0.0
 * @hook after_theme_switch
 */
function signify_setup_options( $old_theme_name ) {
	if ( $old_theme_name ) {
		$old_theme_slug = sanitize_title( $old_theme_name );
		$free_version_slug = array(
			'signify',
		);

		$pro_version_slug  = 'signify';

		$free_options = get_option( 'theme_mods_' . $old_theme_slug );

		// Perform action only if theme_mods_signify free version exists.
		if ( in_array( $old_theme_slug, $free_version_slug ) && $free_options && '1' !== get_theme_mod( 'free_pro_migration' ) ) {
			$new_options = wp_parse_args( get_theme_mods(), $free_options );

			if ( update_option( 'theme_mods_' . $pro_version_slug, $free_options ) ) {
				// Set Migration Parameter to true so that this script does not run multiple times.
				set_theme_mod( 'free_pro_migration', '1' );
			}
		}
	}
}
add_action( 'after_switch_theme', 'signify_setup_options' );

/**
 * Load TGMPA.
 */
require_once get_parent_theme_file_path( '/inc/tgm.php' );

/**
 * Implement the Custom Header feature
 */
require get_parent_theme_file_path( '/inc/custom-header.php' );

/**
 * Custom template tags for this theme
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Functions which enhance the theme by hooking into WordPress
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions
 */
require get_parent_theme_file_path( '/inc/customizer/customizer.php' );

/**
 * Color Scheme additions
 */
require get_parent_theme_file_path( '/inc/header-background-color.php' );

/**
 * Load Jetpack compatibility file
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_parent_theme_file_path( '/inc/jetpack.php' );
}

/**
 * Load Social Widgets
 */
require get_parent_theme_file_path( '/inc/widget-social-icons.php' );

/**
 * Load Theme About Page
 */
require get_parent_theme_file_path( '/inc/admin/admin.php' );
