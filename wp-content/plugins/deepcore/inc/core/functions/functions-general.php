<?php
// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Make theme available for translation
 *
 * @author  Webnus
 * @since   1.0.0
 */
load_theme_textdomain( 'deep', get_template_directory() . '/languages' );

/**
 * Include inc folder files
 *
 * @author  Webnus
 * @since   1.0.0
 */
require_once ABSPATH . 'wp-admin/includes/plugin.php';

/**
 * Sets up theme defaults and registers support for various WordPress features
 *
 * @author  Webnus
 * @since   1.0.0
 */
add_action( 'after_setup_theme', 'deep_theme_setup' );
function deep_theme_setup() {

	add_theme_support( 'title-tag' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'quote', 'image', 'video', 'audio' ) );

	// Add Actions
	add_action( 'widgets_init', 'deep_sidebar_init' );
	add_action( 'admin_enqueue_scripts', 'deep_admin_enqueue' );
	add_action( 'login_head', 'deep_custom_login_logo' );
	add_action( 'wp_head', 'deep_open_graph_tags' );
	add_action( 'template_redirect', 'deep_maintenance_mode' );
	add_action( 'admin_head', 'add_deep_theme_url' );
	add_action( 'admin_bar_menu', 'remove_redux_themeoption_from_adminbar', 999 );
	add_action( 'admin_bar_menu', 'deep_admin_bar_link', 99 );
	add_action( 'init', 'deep_set_vc_as_theme' );
	add_action( 'init', 'deep_kses' );
	add_action( 'show_user_profile', 'deep_author_position' );
	add_action( 'edit_user_profile', 'deep_author_position' );
	add_action( 'admin_init', 'deep_remove_revslider_notice' );
	add_action( 'admin_footer', 'deep_admin_custom_css' );
	add_action( 'admin_init', 'check_favicon' );
	add_action( 'wp_footer', 'deep_fire_dyn_styles' );

	// Remove Actions
	remove_action( 'admin_notices', 'yp_update_message' );
	remove_action( 'admin_notices', 'the_champ_addon_update_notification' );
	remove_action( 'admin_notices', 'snp_affiliate_message' );
	remove_action( 'admin_notices', 'bp_social_articles_addons_notice' );

	// Filters
	add_filter( 'excerpt_length', 'deep_excerpt_length', 999 );
	add_filter( 'excerpt_more', 'deep_excerpt_more' );
	add_filter( 'the_content', 'deep_fix_vc_sec' );
	add_filter( 'the_content_more_link', 'deep_excerpt_more' );
	add_filter( 'upload_mimes', 'deep_custom_font_mimes' );
	add_filter( 'body_class', 'deep_body_classes' );
	add_filter( 'widget_text', 'do_shortcode' );

	// Options
	update_option( 'image_default_link_type', 'file' );

	/**
	 * Prevent modern event calendar redirection
	 *
	 * @author  Webnus
	 * @since   1.0.0
	 */
	add_filter( 'mec_do_redirection_after_activation', '__return_false' );

	// Demo data folder
	$webnus_dir = wp_upload_dir()['basedir'] . '/webnus/';
	$demo_dir = $webnus_dir . 'demo-data/';
	$result = $demo_dir.'result.txt';

	if ( ! wp_mkdir_p( $demo_dir ) ) {
		wp_mkdir_p( $demo_dir );
	}

	if ( ! file_exists( $result ) ) {
		$result_file = fopen( $demo_dir.'result.txt', "w" );
		fwrite($result_file, '0');

		// Close the file
		fclose($result_file);
	}

}

/**
 * deep theme URL
 *
 * @since     1.0.0
 */
function add_deep_theme_url() {
	echo "<script> var deep_theme_url='" . DEEP_URL . "'; </script>";
}

/**
 * Globals should always be within a function
 *
 * @author  Webnus
 * @since   1.0.0
 */
function deep_options() {
	global $deep_options;
	return $deep_options;
}

function load_webnus_woocommerce() {
	$deep_options = deep_options();
	$deep_options['deep_shop_style'] = ( isset( $deep_options['deep_shop_style'] ) && $deep_options['deep_shop_style'] == 1 ) ? '1' : '0';
	if ( $deep_options['deep_shop_style'] == '0' ) {
		include_once DEEP_CORE_DIR . 'woocommerce/woo-integration.php';
	} else {
		include_once DEEP_CORE_DIR . 'woocommerce/woo-default.php';
		add_filter(
			'body_class',
			function( $classes ) {
				return array_merge( $classes, array( 'deep-default-woo' ) );
			}
		);
	}
}

/**
 * Maintenance mode
 *
 * @author  Webnus
 * @since   1.0.0
 */
function deep_maintenance_mode() {
	$deep_options = deep_options();

	$is_maintenance   = isset( $deep_options['deep_maintenance_mode'] ) ? $deep_options['deep_maintenance_mode'] : '';
	$maintenance_page = isset( $deep_options['deep_maintenance_page'] ) ? $deep_options['deep_maintenance_page'] : '';

	if ( ! is_page( $maintenance_page ) && $is_maintenance && $maintenance_page && ! current_user_can( 'edit_posts' ) && ! in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ) ) ) {
		wp_redirect( esc_url( home_url( 'index.php?page_id=' . $maintenance_page ) ) );
		exit();
	}
}

/**
 * Register sidebars
 *
 * @author  Webnus
 * @since   1.0.0
 */
function deep_sidebar_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Left Sidebar', 'deep' ),
			'id'            => 'left-sidebar',
			'description'   => esc_html__( 'Appears in left side in the blog page.', 'deep' ),
			'before_widget' => '<div class="widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="subtitle-wrap"><h4 class="subtitle">',
			'after_title'   => '</h4></div>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Right Sidebar', 'deep' ),
			'id'            => 'right-sidebar',
			'description'   => esc_html__( 'Appears in right side in the blog page.', 'deep' ),
			'before_widget' => '<div class="widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="subtitle-wrap"><h4 class="subtitle">',
			'after_title'   => '</h4></div>',
		)
	);

	if ( is_plugin_active( 'buddypress/bp-loader.php' ) ) {
		register_sidebar(
			array(
				'name'          => esc_html__( 'Buddypress Sidebar', 'deep' ),
				'id'            => 'buddypress-sidebar',
				'description'   => esc_html__( 'Buddypress Sidebar', 'deep' ),
				'before_widget' => '<div class="widget">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="subtitle-wrap"><h4 class="subtitle">',
				'after_title'   => '</h4></div>',
			)
		);
	}
	if ( defined( 'RECIPES_DIR' ) ) {
		register_sidebar(
			array(
				'name'          => esc_html__( 'Recipe Sidebar', 'deep' ),
				'id'            => 'recipe-sidebar',
				'description'   => esc_html__( 'Appears in right side in the recipe page.', 'deep' ),
				'before_widget' => '<div class="widget">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="subtitle-wrap"><h4 class="subtitle">',
				'after_title'   => '</h4></div>',
			)
		);
	}
	register_sidebar(
		array(
			'name'          => esc_html__( 'Toggle Top Area Section 1', 'deep' ),
			'id'            => 'top-area-1',
			'description'   => esc_html__( 'Appears in top area section 1', 'deep' ),
			'before_widget' => '<div class="widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="subtitle">',
			'after_title'   => '</h5>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Toggle Top Area Section 2', 'deep' ),
			'id'            => 'top-area-2',
			'description'   => esc_html__( 'Appears in top area section 2', 'deep' ),
			'before_widget' => '<div class="widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="subtitle">',
			'after_title'   => '</h5>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Toggle Top Area Section 3', 'deep' ),
			'id'            => 'top-area-3',
			'description'   => esc_html__( 'Appears in top area section 3', 'deep' ),
			'before_widget' => '<div class="widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="subtitle">',
			'after_title'   => '</h5>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Toggle Top Area Section 4', 'deep' ),
			'id'            => 'top-area-4',
			'description'   => esc_html__( 'Appears in top area section 4', 'deep' ),
			'before_widget' => '<div class="widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="subtitle">',
			'after_title'   => '</h5>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Section 1', 'deep' ),
			'id'            => 'footer-section-1',
			'description'   => esc_html__( 'Appears in footer section 1', 'deep' ),
			'before_widget' => '<div class="widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="subtitle">',
			'after_title'   => '</h5>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Section 2', 'deep' ),
			'id'            => 'footer-section-2',
			'description'   => esc_html__( 'Appears in footer section 2', 'deep' ),
			'before_widget' => '<div class="widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="subtitle">',
			'after_title'   => '</h5>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Section 3', 'deep' ),
			'id'            => 'footer-section-3',
			'description'   => esc_html__( 'Appears in footer section 3', 'deep' ),
			'before_widget' => '<div class="widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="subtitle">',
			'after_title'   => '</h5>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Section 4', 'deep' ),
			'id'            => 'footer-section-4',
			'description'   => esc_html__( 'Appears in footer section 4', 'deep' ),
			'before_widget' => '<div class="widget">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5 class="subtitle">',
			'after_title'   => '</h5>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'WooCommerce Page Sidebar', 'deep' ),
			'id'            => 'shop-widget-area',
			'description'   => esc_html__( 'Product page widget area', 'deep' ),
			'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
			'after_widget'  => '</div></li>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span><i class="ti-plus"></i></h3><div class="sidebar-line"><span></span></div><div class="woo-widget-content">',
		)
	);

	if ( function_exists( 'is_woocommerce' ) ) {
		register_sidebar(
			array(
				'name'          => esc_html__( 'WooCommerce Header Widget Area', 'deep' ),
				'id'            => 'woocommerce_header',
				'description'   => esc_html__( 'This widget area should be used only for WooCommerce header cart widget', 'deep' ),
				'before_widget' => '',
				'after_widget'  => '',
				'before_title'  => '',
				'after_title'   => '',
			)
		);
	}
}

/**
 * Excerpt
 *
 * @author  Webnus
 * @since   1.0.0
 */
function deep_excerpt_length( $length ) {
	return 300;
}
function deep_excerpt( $limit ) {
	$excerpt = explode( ' ', get_the_excerpt(), $limit + 1 );
	if ( count( $excerpt ) >= $limit ) {
		array_pop( $excerpt );
		$excerpt = implode( ' ', $excerpt ) . '...';
	} else {
		$excerpt = implode( ' ', $excerpt );
	}
	return $excerpt;
}
function deep_excerpt_more( $more ) {
	$deep_options                            = deep_options();
	$deep_options['deep_blog_readmore_text'] = isset( $deep_options['deep_blog_readmore_text'] ) ? $deep_options['deep_blog_readmore_text'] : 'Continue Reading';
	global $post;
	return '... <br><br><a class="readmore" href="' . get_permalink( $post->ID ) . '">' . esc_html( $deep_options['deep_blog_readmore_text'] ) . '</a>';
}

/**
 * Add webnus options to admin menu
 *
 * @author  Webnus
 * @since   1.0.0
 */
function deep_admin_bar_link() {
	if ( ! is_super_admin() || ! is_admin_bar_showing() ) {
		return;
	}

	global $wp_admin_bar;
	$deep_options          = deep_options();
	$theme_data            = wp_get_theme();
	$menu_visiblity        = array(
		'dashboard'   => ! empty( $deep_options['deep_theme_menus']['dashboard'] ) ? $deep_options['deep_theme_menus']['dashboard'] : '0',
		'importer'    => ! empty( $deep_options['deep_theme_menus']['importer'] ) ? $deep_options['deep_theme_menus']['importer'] : '0',
		'plugins'     => ! empty( $deep_options['deep_theme_menus']['plugins'] ) ? $deep_options['deep_theme_menus']['plugins'] : '0',
		'tutorials'   => ! empty( $deep_options['deep_theme_menus']['tutorials'] ) ? $deep_options['deep_theme_menus']['tutorials'] : '0',
		'performance' => ! empty( $deep_options['deep_theme_menus']['performance'] ) ? $deep_options['deep_theme_menus']['performance'] : '0',
	);
	$deep_theme_admin_logo = ! empty( $deep_options['deep_theme_admin_logo']['url'] ) ? '<img src="' . $deep_options['deep_theme_admin_logo']['url'] . '">' : DEEP_SVG;
	$custom_name           = isset( $deep_options['deep_theme_lbl_name'] ) ? $deep_options['deep_theme_lbl_name'] : '';
	$theme_name            = ( isset( $custom_name ) && $custom_name != null ) ? $custom_name : $theme_data->Name;
	$admin_url             = admin_url() . '/admin.php?page=';
	$wp_admin_bar->add_menu(
		array(
			'id'    => 'wn_main_menu_item',
			'title' => $deep_theme_admin_logo . $theme_name,
			'href'  => $admin_url . 'wn-admin-welcome',
			'meta'  => array(
				'class' => 'wn-admin-menu-bar',
			),
		)
	);
	$wp_admin_bar->add_menu(
		array(
			'id'     => 'wn_first_menu_item',
			'parent' => 'wn_main_menu_item',
			'title'  => 'Dashboard',
			'href'   => $admin_url . 'wn-admin-welcome',
		)
	);
	if ( $menu_visiblity['importer'] != '1' ) {
		$wp_admin_bar->add_menu(
			array(
				'id'     => 'wn_second_menu_item',
				'parent' => 'wn_main_menu_item',
				'title'  => 'Demo Importer',
				'href'   => $admin_url . 'wn-admin-demo-importer',
			)
		);
	}
	if ( $menu_visiblity['plugins'] != '1' ) {
		$wp_admin_bar->add_menu(
			array(
				'id'     => 'wn_third_menu_item',
				'parent' => 'wn_main_menu_item',
				'title'  => 'Plugins',
				'href'   => $admin_url . 'wn-admin-plugins',
			)
		);
	}
	if ( $menu_visiblity['tutorials'] != '1' ) {
		$wp_admin_bar->add_menu(
			array(
				'id'     => 'wn_fourth_menu_item',
				'parent' => 'wn_main_menu_item',
				'title'  => 'Tutorials',
				'href'   => $admin_url . 'wn-admin-video-tutorial',
			)
		);
	}
	if ( $menu_visiblity['performance'] != '1' ) {
		$wp_admin_bar->add_menu(
			array(
				'id'     => 'wn_fifth_menu_item',
				'parent' => 'wn_main_menu_item',
				'title'  => 'Performance',
				'href'   => $admin_url . 'wn-admin-performance',
			)
		);
	}
	$wp_admin_bar->add_menu(
		array(
			'id'     => 'wn_sixth_menu_item',
			'parent' => 'wn_main_menu_item',
			'title'  => 'Header Builder',
			'href'   => $admin_url . 'webnus_header_builder',
		)
	);
	$wp_admin_bar->add_menu(
		array(
			'id'     => 'wn_seventh_menu_item',
			'parent' => 'wn_main_menu_item',
			'title'  => 'Theme Options',
			'href'   => $admin_url . 'webnus_theme_options',
		)
	);
}

/**
 * Enqueue scripts
 *
 * @author  Webnus
 * @since   1.0.0
 */
function deep_google_fonts_url() {
	$fonts_url     = '';
	$font_families = array();
	$subsets       = 'latin,latin-ext';

	// Default typography
	if ( 'off' !== _x( 'on', 'Rubik font: on or off', 'deep' ) ) {
		$font_families[] = 'Rubik:400,300,400italic,700,700italic';
	}
	if ( 'off' !== _x( 'on', 'Lora font: on or off', 'deep' ) ) {
		$font_families[] = 'Lora:400,400italic,700,700italic';
	}

	if ( $font_families ) {
		$fonts_url = add_query_arg(
			array(
				'family' => urlencode( implode( '|', $font_families ) ),
				'subset' => urlencode( $subsets ),
			),
			'https://fonts.googleapis.com/css'
		);
	}

	return esc_url( $fonts_url );
}

/**
 * Enqueue admin scripts
 *
 * @author  Webnus
 * @since   1.0.0
 */
function deep_admin_enqueue() {
	// IconFonts Style
	if ( function_exists( 'kc_add_icon' ) ) {
		wp_enqueue_style( 'deep-iconfonts-load', DEEP_ASSETS_URL . 'css/backend/kc-font-icon.css', null, null );
		wp_enqueue_style( 'deep-iconfonts-style', DEEP_ASSETS_URL . 'css/backend/kc-icons.css', null, null );
	} else {
        wp_enqueue_style( 'deep-iconset', DEEP_ASSETS_URL . 'css/frontend/icons/iconset.css' );
        wp_enqueue_style( 'deep-font-awesome', DEEP_ASSETS_URL . 'css/frontend/icons/font-awesome.css' );
        wp_enqueue_style( 'deep-et-line', DEEP_ASSETS_URL . 'css/frontend/icons/et-line.css' );
        wp_enqueue_style( 'deep-linea-arrows', DEEP_ASSETS_URL . 'css/frontend/icons/linea-arrows-10.css' );
        wp_enqueue_style( 'deep-linea-basic', DEEP_ASSETS_URL . 'css/frontend/icons/linea-basic-10.css' );
        wp_enqueue_style( 'deep-linea-ecommerce', DEEP_ASSETS_URL . 'css/frontend/icons/linea-ecommerce-10.css' );
        wp_enqueue_style( 'deep-linea-software-10', DEEP_ASSETS_URL . 'css/frontend/icons/linea-software-10.css' );
        wp_enqueue_style( 'deep-linecons', DEEP_ASSETS_URL . 'css/frontend/icons/linecons.css' );
        wp_enqueue_style( 'deep-simple-line-icons', DEEP_ASSETS_URL . 'css/frontend/icons/simple-line-icons.css' );
        wp_enqueue_style( 'deep-themify-icons', DEEP_ASSETS_URL . 'css/frontend/icons/themify.css' );
	}

	wp_enqueue_style( 'wn-the-grid', DEEP_ASSETS_URL . 'css/backend/the-grid.css', array(), 'all' );

	// Webnus Admin JS
	wp_enqueue_script( 'deep-nicescroll-script', DEEP_ASSETS_URL . 'js/libraries/jquery.nicescroll.js', array( 'jquery' ), null, true );
	wp_enqueue_script( 'deep-niceselect-script', DEEP_ASSETS_URL . 'js/libraries/jquery.niceselect.js', array( 'jquery' ), null, true );
	if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {
		wp_enqueue_script( 'deep-lazyload', DEEP_ASSETS_URL . 'js/libraries/jquery.lazyload-any.js', array( 'jquery' ), null, true );
	}
	wp_enqueue_script( 'deep-custom-scripts', DEEP_ASSETS_URL . 'js/backend/webnus-custom-admin.js', array( 'jquery' ), null, true );
	wp_dequeue_style( 'rs-open-sans' );

	wp_localize_script(
		'deep-custom-scripts',
		'ajaxObject',
		array(
			'ajaxUrl'    => admin_url( 'admin-ajax.php' ),
			'colornonce' => wp_create_nonce( 'colorCategoriesNonce' ),
		)
	);

}

/**
 * Custom Admin Logo
 *
 * @author  Webnus
 * @since   1.0.0
 */
function deep_custom_login_logo() {
	$deep_options = deep_options();
	$logo         = isset( $deep_options['deep_admin_login_logo']['url'] ) ? $deep_options['deep_admin_login_logo']['url'] : '';
	if ( isset( $logo ) && ! empty( $logo ) ) {
		echo '<style>h1 a { background-image:url(' . esc_url( $logo ) . ') !important; }</style>';
	}
}

/**
 * Open Graph
 *
 * @author  Webnus
 * @since   1.0.0
 */
function deep_my_excerpt( $text, $excerpt ) {
	if ( $excerpt ) {
		return $excerpt;
	}
	$text           = strip_shortcodes( $text );
	$text           = apply_filters( 'the_content', $text );
	$text           = str_replace( ']]>', ']]&gt;', $text );
	$text           = strip_tags( $text );
	$excerpt_length = apply_filters( 'excerpt_length', 55 );
	$excerpt_more   = apply_filters( 'excerpt_more', ' ' . '[...]' );
	$words          = preg_split(
		"/[\n
            ]+/",
		$text,
		$excerpt_length + 1,
		PREG_SPLIT_NO_EMPTY
	);
	if ( count( $words ) > $excerpt_length ) {
		array_pop( $words );
		$text = implode( ' ', $words );
		$text = $text . $excerpt_more;
	} else {
		$text = implode( ' ', $words );
	}
	return apply_filters( 'wp_trim_excerpt', $text, $excerpt );
}
function deep_open_graph_tags() {
	if ( is_single() ) {
		global $post;
		if ( get_the_post_thumbnail( $post->ID, 'thumbnail' ) ) {
			$thumbnail_id     = get_post_thumbnail_id( $post->ID );
			$thumbnail_object = get_post( $thumbnail_id );
			$image            = $thumbnail_object->guid;
		} else {
			$image = ''; // Change this to the URL of the logo you want beside your links shown on Facebook
		}
		$description = deep_my_excerpt( $post->post_content, $post->post_excerpt );
		$description = strip_tags( $description );
		$description = str_replace( '"', "'", $description ); ?>

		<?php
		if ( !is_plugin_active( 'seo-by-rank-math/rank-math.php' ) && !is_plugin_active( 'wordpress-seo/wp-seo.php' ) ) { ?>
			<meta property="og:title" content="<?php the_title(); ?>" />
			<meta property="og:type" content="article" />
			<meta property="og:image" content="<?php echo esc_url( $image ); ?>" />
			<meta property="og:url" content="<?php the_permalink(); ?>" />
			<meta property="og:description" content="<?php echo esc_attr( $description ); ?>" />
			<meta property="og:site_name" content="<?php echo get_bloginfo( 'name' ); ?>" />
		<?php }
	}
}

/**
 * Post View
 *
 * @author  Webnus
 * @since   1.0.0
 */
function deep_setViews( $postID ) {
	$count_key = 'deep_views';
	$count     = get_post_meta( $postID, $count_key, true );
	if ( $count == '' ) {
		$count = 0;
		delete_post_meta( $postID, $count_key );
		add_post_meta( $postID, $count_key, '0' );
	} else {
		$count++;
		update_post_meta( $postID, $count_key, $count );
	}
	return $count;
}
function deep_getViews( $postID ) {
	$count_key = 'deep_views';
	$count     = get_post_meta( $postID, $count_key, true );
	if ( $count == '' ) {
		$count = 0;
		delete_post_meta( $postID, $count_key );
		add_post_meta( $postID, $count_key, '0' );
	}
	return $count;
}

/**
 * Find string
 *
 * @author  Webnus
 * @since   1.0.0
 */
if ( ! function_exists( 'find_string' ) ) {
	function find_string( $string, $start, $end = '' ) {
		$string = ' ' . $string;
		$ini    = strpos( $string, $start );
		if ( $ini == 0 ) {
			return '';
		}
		$ini += strlen( $start );
		$len  = strpos( $string, $end, $ini ) - $ini;
		return substr( $string, $ini, $len );
	}
}

/**
 * MIMETYPE fonts
 *
 * @author  Webnus
 * @since   1.0.0
 */
function deep_custom_font_mimes( $existing_mimes = array() ) {
	$existing_mimes['woff'] = 'application/octet-stream';
	$existing_mimes['woff2'] = 'application/octet-stream';
	$existing_mimes['ttf']  = 'application/font-sfnt';
	$existing_mimes['otf']  = 'application/vnd.ms-opentype';
	$existing_mimes['svg']  = 'image/svg+xml';
	$existing_mimes['svgz'] = 'image/svg+xml';
	return $existing_mimes;
}

/**
 * Set WPBakery Page Builder as theme
 *
 * @author  Webnus
 * @since   1.0.0
 */
function deep_set_vc_as_theme() {
	if ( function_exists( 'vc_set_as_theme' ) ) {
		vc_set_as_theme( $notifier = false );
	}
}

/**
 * WordPress utilities
 *
 * @author  Webnus
 * @since   1.0.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 940;
}

if ( false ) {
	wp_link_pages();
	posts_nav_link();
	paginate_links();
	the_tags();
	get_post_format( 0 );
}

/**
 * Fix WPBakery Page Builder auto <p></p>
 *
 * @author  Webnus
 * @since   1.0.0
 */
function deep_fix_vc_sec( $content ) {
	return strtr(
		$content,
		array(
			'<p>['    => '[',
			']</p>'   => ']',
			']<br />' => ']',
		)
	);
}

/**
 * Adds custom classes to the array of body classes.
 *
 * @author  Webnus
 * @since   1.0.0
 * @param   array $classes Classes for the body element.
 * @return  array (Maybe) filtered body classes.
 */
function deep_body_classes( $classes ) {
	$deep_options                                = deep_options();
	$deep_options['deep_blog_single_post_style'] = isset( $deep_options['deep_blog_single_post_style'] ) ? $deep_options['deep_blog_single_post_style'] : '';
	// Transparent Header
	$transparent_header = '';
	if ( is_page() ) {
		$transparent_header = isset( $deep_options['page_transparent_dis'] ) ? $deep_options['page_transparent_dis'] : 'none';
		$transparent_header = ( rwmb_meta( 'deep_transparent_header_meta' ) != 'inherit' ) ? rwmb_meta( 'deep_transparent_header_meta' ) : $transparent_header;
		$classes[]          = ( $transparent_header == 'light' ) ? esc_attr( ' transparent-header-w' ) : '';
		$classes[]          = ( $transparent_header == 'dark' ) ? esc_attr( ' transparent-header-w t-dark-w' ) : '';
		$one_page_class     = rwmb_meta( 'deep_onepage_menu_meta' );
		$classes[]          = ( $one_page_class == '1' ) ? esc_attr( ' wn-one-page' ) : '';
	} elseif ( is_404() ) {
		$transparent_header = ( isset( $deep_options['deep_404_page_header'] ) && $deep_options['deep_404_page_header'] ) ? $deep_options['deep_404_page_header'] : 'none';
		$classes[]          = ( $transparent_header == 'light' ) ? esc_attr( ' transparent-header-w' ) : '';
		$classes[]          = ( $transparent_header == 'dark' ) ? esc_attr( ' transparent-header-w t-dark-w' ) : '';
	}
	if ( is_singular( 'recipe' ) ) {
		$recipe_transparent_header = rwmb_meta( 'deep_recipe_transparent_header_meta' );
		$classes[]                 = ( $recipe_transparent_header == 'light' ) ? esc_attr( ' transparent-header-w' ) : '';
		$classes[]                 = ( $recipe_transparent_header == 'dark' ) ? esc_attr( ' transparent-header-w t-dark-w' ) : '';
	}

	if ( is_singular( 'mec-events' ) ) {
		$transparent_header = isset( $deep_options['page_transparent_dis'] ) ? $deep_options['page_transparent_dis'] : 'none';
		$classes[]          = ( $transparent_header == 'light' ) ? esc_attr( ' transparent-header-w' ) : '';
		$classes[]          = ( $transparent_header == 'dark' ) ? esc_attr( ' transparent-header-w t-dark-w' ) : '';
	}

	// Post Show
	if ( is_single() ) {
		$post_meta = rwmb_meta( 'deep_blogpost_meta' );
		if ( ! empty( $post_meta ) || ! empty( $deep_options['deep_blog_single_post_style'] ) ) {
			if ( ( $post_meta == 'postshow1' || $deep_options['deep_blog_single_post_style'] == 'postshow1' ) && $thumbnail_id = get_post_thumbnail_id() ) {
				$classes[] = esc_attr( ' postshow1-hd transparent-header-w t-dark-w' );
			} elseif ( ( $post_meta == 'postshow2' || $deep_options['deep_blog_single_post_style'] == 'postshow2' ) && $thumbnail_id = get_post_thumbnail_id() ) {
				$classes[] = esc_attr( ' postshow2-hd' );
			}
		}
	}

	// Edge one page
	if ( is_page() ) {
		$edge_onepage = rwmb_meta( 'deep_edge_onepage' );
		if ( $edge_onepage == '1' ) {
			$classes[] = esc_attr( ' wn-edge-onepage' );
		}
	}

	if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
		if ( is_shop() ) {
			$classes[] = esc_attr( ' wn-shop' );
		}
	}
	$deep_options['deep_header_topbar_enable'] = isset( $deep_options['deep_header_topbar_enable'] ) ? $deep_options['deep_header_topbar_enable'] : '1';
	$deep_options['deep_topbar_fixed']         = isset( $deep_options['deep_topbar_fixed'] ) ? $deep_options['deep_topbar_fixed'] : '0';
	$deep_options['deep_enable_smoothscroll']  = isset( $deep_options['deep_enable_smoothscroll'] ) ? $deep_options['deep_enable_smoothscroll'] : '';
	$deep_options['deep_header_menu_type']     = isset( $deep_options['deep_header_menu_type'] ) ? $deep_options['deep_header_menu_type'] : '13';
	// topbar
	$classes[] = ( $deep_options['deep_header_topbar_enable'] ) ? esc_attr( ' has-topbar-w' ) : '';
	$classes[] = ( $deep_options['deep_topbar_fixed'] ) ? esc_attr( ' topbar-fixed' ) : '';

	// smooth scroll
	$classes[] = $deep_options['deep_enable_smoothscroll'] ? esc_attr( ' smooth-scroll' ) : '';

	// header 11
	$classes[] = $deep_options['deep_header_menu_type'] == '11' ? esc_attr( ' has-header-type11' ) : '';

	// header 13
	$classes[] = $deep_options['deep_header_menu_type'] == '13' ? esc_attr( ' has-header-type13' ) : '';

	// header 9
	$classes[] = $deep_options['deep_header_menu_type'] == '9' ? esc_attr( ' has-header-type9' ) : '';

	// hamburger toggle
	$deep_options['deep_header_hamburger_menu_enable'] = isset( $deep_options['deep_header_hamburger_menu_enable'] ) ? $deep_options['deep_header_hamburger_menu_enable'] : '1';
	$classes[] = empty( $deep_options['deep_header_menu_icon'] ) ? esc_attr( 'wn-responsive' ) . ' ' : '';

	// Custom Scrollbar
	$deep_options['deep_custom_scrollbar'] = isset( $deep_options['deep_custom_scrollbar'] ) ? $deep_options['deep_custom_scrollbar'] : '0';
	$deep_options['deep_hide_scrollbar']   = isset( $deep_options['deep_hide_scrollbar'] ) ? $deep_options['deep_hide_scrollbar'] : '0';
	$classes[]                             = $deep_options['deep_custom_scrollbar'] == '1' ? esc_attr( ' wn-custom-scrollbar' ) : '';
	$classes[]                             = ( $deep_options['deep_hide_scrollbar'] == '1' && $deep_options['deep_custom_scrollbar'] == '1' ) ? esc_attr( ' wn-hide-scrollbar' ) : esc_attr( ' wn-show-scrollbar' );

	// Preloader
	$enable_preloader = isset( $deep_options['enable_preloader'] ) && $deep_options['enable_preloader'] == '1' ? $deep_options['enable_preloader'] : false;
	$classes[]        = $enable_preloader ? ' wn-preloader' : '';

	return $classes;
}


/**
 * Comments
 *
 * @author  Webnus
 * @since   1.0.0
 */
function deep_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<div class="comment-content">
			<div class="comment-info">
				<?php echo get_avatar( $comment, 90 ); ?>
				<cite>
				<?php comment_author_link(); ?> :
					<span class="comment-data"><a href="#comment-<?php comment_ID(); ?>" title=""><?php comment_date(); ?> at <?php comment_time( 'g:i a' ); ?></a><?php edit_comment_link( 'Edit', ' | ', '' ); ?></span>
				</cite>
			</div>
			<div class="comment-text">
			<?php if ( $comment->comment_approved == '0' ) : ?>
					<p><em><?php esc_html_e( 'Your comment is awaiting moderation.', 'deep' ); ?></em></p>
				<?php endif; ?>
			<?php comment_text(); ?>
				<div class="reply">
				<?php
				comment_reply_link(
					array_merge(
						$args,
						array(
							'depth'     => $depth,
							'max_depth' => $args['max_depth'],
						)
					)
				);
				?>
				</div>
			</div>
		</div>
		<?php
}

/**
 * Remove theme option from admin topbar
 *
 * @author  Webnus
 * @since   1.0.0
 */
if ( ! function_exists( 'remove_redux_themeoption_from_adminbar' ) ) :
	function remove_redux_themeoption_from_adminbar( $wp_admin_bar ) {
		$wp_admin_bar->remove_node( 'webnus_theme_options' );
	}
endif;

/**
 * Kses helper function
 *
 * @author  Webnus
 * @since   1.0.0
 */
if ( ! function_exists( 'deep_kses' ) ) {
	function deep_kses() {
		return array(
			'a'      => array(
				'href'   => array(),
				'title'  => array(),
				'target' => array(),
				'style'  => array(),
				'class'  => array(),
			),
			'br'     => array(),
			'em'     => array(),
			'strong' => array(),
			'span'   => array(
				'class' => array(),
			),
		);
	}
}

/**
 * Donate modal
 *
 * @author  Webnus
 * @since   1.0.0
 */
function deep_modal_donate() {
	global $post;
	$deep_options                            = deep_options();
	$deep_options['deep_webnus_donate_form'] = isset( $deep_options['deep_webnus_donate_form'] ) ? $deep_options['deep_webnus_donate_form'] : '';
	return '
		<a class="donate-button colorb colorr" href="#w-donate-' . get_the_ID() . '" target="_self" data-effect="mfp-zoom-in">
			<span class="media_label">' . __( 'DONATE NOW', 'deep' ) . '</span>
		</a>
		<div class="white-popup mfp-with-anim mfp-hide">
			<div id="donate-contact-modal-' . get_the_ID() . '">
				<div class="w-modal modal-donate wn-donate-contact-modal" id="w-donate-' . get_the_ID() . '">
                    <h3 class="modal-title">' . __( 'Donate now', 'deep' ) . '</h3>
					' . do_shortcode( '[contact-form-7 id="' . $deep_options['deep_webnus_donate_form'] . '" title="' . get_the_title( $deep_options['deep_webnus_donate_form'] ) . '"]' ) . '
				</div>
			</div>
		</div>';
}

/**
 * Plugin Name:    SVG Support
 * Plugin URI:     http://wordpress.org/plugins/svg-support/
 */
add_filter( 'wp_prepare_attachment_for_js', 'deep_bodhi_svgs_response_for_svg', 10, 3 );
add_filter( 'upload_mimes', 'deep_bodhi_svgs_upload_mimes' );
function deep_bodhi_svgs_response_for_svg( $response, $attachment, $meta ) {
	if ( $response['mime'] == 'image/svg+xml' && empty( $response['sizes'] ) ) {
		$svg_path = get_attached_file( $attachment->ID );
		if ( ! file_exists( $svg_path ) ) {
			// If SVG is external, use the URL instead of the path
			$svg_path = $response['url'];
		}
		$dimensions        = deep_bodhi_svgs_get_dimensions( $svg_path );
		$response['sizes'] = array(
			'full' => array(
				'url'         => $response['url'],
				'width'       => $dimensions->width,
				'height'      => $dimensions->height,
				'orientation' => $dimensions->width > $dimensions->height ? 'landscape' : 'portrait',
			),
		);
	}

	return $response;
}
function deep_bodhi_svgs_get_dimensions( $svg ) {
	$svg = simplexml_load_file( $svg );
	if ( $svg === false ) {
		$width  = '0';
		$height = '0';
	} else {
		$attributes = $svg->attributes();
		$width      = (string) $attributes->width;
		$height     = (string) $attributes->height;
	}
	return (object) array(
		'width'  => $width,
		'height' => $height,
	);
}
function deep_bodhi_svgs_upload_mimes( $mimes = array() ) {
	global $bodhi_svgs_options;

	if ( empty( $bodhi_svgs_options['restrict'] ) || current_user_can( 'administrator' ) ) {
		// allow SVG file upload
		$mimes['svg']  = 'image/svg+xml';
		$mimes['svgz'] = 'image/svg+xml';

		return $mimes;
	} else {
		return $mimes;
	}
}

// Mime Check fix for WP 4.7.1 / 4.7.2
// Fixes uploads for these 2 version of WordPress
// Issue was fixed in 4.7.3 core
global $wp_version;
if ( $wp_version == '4.7.1' || $wp_version == '4.7.2' ) {
	add_filter( 'wp_check_filetype_and_ext', 'deep_bodhi_svgs_disable_real_mime_check', 10, 4 );
}

function deep_bodhi_svgs_disable_real_mime_check( $data, $file, $filename, $mimes ) {
	$wp_filetype     = wp_check_filetype( $filename, $mimes );
	$ext             = $wp_filetype['ext'];
	$type            = $wp_filetype['type'];
	$proper_filename = $data['proper_filename'];

	return compact( 'ext', 'type', 'proper_filename' );
}

/**
 * Get file content
 *
 * @author  Webnus
 * @since   1.0.0
 */
function deep_get_file_content( $url ) {
	$args = array(
		'httpversion' => '1.1',
		'user-agent'  => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.116 Safari/537.36'
	);
	$output = wp_remote_get( $url, $args );
	return $output['body'];
}

/**
 * Get category color
 *
 * @author  Webnus
 * @since   1.0.0
 */
if ( ! function_exists( 'deep_category_color' ) ) :
	function deep_category_color( $post_id = '' ) {
		global $post;
		$post_id = $post_id != '' ? $post_id : $post->ID;
		// Category color
		$term_lists = wp_get_post_terms( $post->ID, 'category', array( 'fields' => 'ids' ) );
		foreach ( $term_lists as $term_list ) {
			$category_color = get_term_meta( $term_list, 'cc_color', true );
			return $category_color;
		}
	}
endif;

/**
 * Inline style for elements options
 *
 * @author  Webnus
 * @since   1.0.0
 */
if ( ! function_exists( 'deep_save_dyn_styles' ) ) :
	add_action( 'init', 'deep_save_dyn_styles' );
	function deep_save_dyn_styles( $style ) {
		$GLOBALS['deep_dynshortcodes'] .= $style;
		global $wp_filesystem;
		if ( empty( $wp_filesystem ) ) {
			require_once ABSPATH . '/wp-admin/includes/file.php';
			WP_Filesystem();
		}
		$deep_dyn_css_dir = DEEP_ASSETS_DIR . 'css/frontend/dynamic-style/shortcodes' . get_the_ID() . '.dyn.css';
		$wp_filesystem->put_contents(
			$deep_dyn_css_dir,
			str_replace(
				array( "\r\n", "\r", "\n", "\t", '    ' ),
				'',
				preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $GLOBALS['deep_dynshortcodes'] )
			), 0644
		);
	}
endif;

function deep_fire_dyn_styles() {
	if ( file_exists( DEEP_ASSETS_DIR . 'css/frontend/dynamic-style/shortcodes' . get_the_ID() . '.dyn.css' ) ) {
		wp_enqueue_style( 'shortcodes-dyn', DEEP_ASSETS_URL . 'css/frontend/dynamic-style/shortcodes' . get_the_ID() . '.dyn.css', false, DEEP_VERSION );
		$custom_css = file_get_contents( DEEP_ASSETS_DIR . 'css/frontend/dynamic-style/shortcodes' . get_the_ID() . '.dyn.css' );
        wp_add_inline_style( 'shortcodes-dyn', $custom_css );
	}
	wp_enqueue_style( 'dyncss-php', DEEP_ASSETS_URL . 'css/frontend/dynamic-style/dyncssphp.css', false, null );
}


/**
 * Post navigation
 *
 * @author  Webnus
 * @since   1.0.0
 */
if ( ! function_exists( 'deep_next_prev_post ' ) ) {
	function deep_next_prev_post() {
		$deep_options                        = deep_options();
		$deep_options['deep_next_prev_post'] = isset( $deep_options['deep_next_prev_post'] ) ? $deep_options['deep_next_prev_post'] : '1';
		if ( $deep_options['deep_next_prev_post'] ) {
			?>
				<div class="col-md-6 col-sm-6 w-prev-article">
					<?php previous_post_link( '%link', '<span>' . esc_html__( 'PRV  POST', 'deep' ) . '</span><i class="icon-arrows-slim-left"></i>' ); ?>
				</div>
				<div class="col-md-6 col-sm-6 w-next-article">
					<?php next_post_link( '%link', '<span>' . esc_html__( 'NXT POST', 'deep' ) . '</span><i class="icon-arrows-slim-right"></i>' ); ?>
				</div>
				<?php
		}
	}
}

/**
 * Get custom post type category
 *
 * @author  Webnus
 * @since   1.0.0
 */
if ( ! function_exists( 'deep_get_custom_postype_category' ) ) {
	function deep_get_custom_postype_category( $taxonomy_name ) {
		$taxonomy = $taxonomy_name;
		$terms    = get_terms( $taxonomy ); // Get all terms of a taxonomy
		if ( $terms && ! is_wp_error( $terms ) ) {
			?>
				<ul class="category <?php echo '' . $taxonomy; ?>">
					<?php foreach ( $terms as $term ) { ?>
					<li><a href="<?php echo get_term_link( $term->slug, $taxonomy ); ?>"><?php echo '' . $term->name; ?></a></li>
					<?php } ?>
				</ul>
				<?php
		}
	}
}

/**
 * Get custom post type tags
 *
 * @author  Webnus
 * @since   1.0.0
 */
if ( ! function_exists( 'deep_get_custom_postype_tags' ) ) {
	function deep_get_custom_postype_tags( $taxonomy_name ) {
		$taxonomy = $taxonomy_name;
		$terms    = get_terms( $taxonomy ); // Get all terms of a taxonomy
		if ( $terms && ! is_wp_error( $terms ) ) {
			?>
				<ul class="tags <?php echo '' . $taxonomy; ?>">
					<?php foreach ( $terms as $term ) { ?>
					<li><a href="<?php echo get_term_link( $term->slug, $taxonomy ); ?>"><?php echo '' . $term->name; ?></a></li>
					<?php } ?>
				</ul>
				<?php
		}
	}
}

/**
 * Social share
 *
 * @author  Webnus
 * @since   1.0.0
 */
if ( ! function_exists( 'deep_social_share' ) ) {
	function deep_social_share( $post_id ) {
		$deep_options          = deep_options();
		$layout                = $deep_options['deep_social_share_layout'] ? $deep_options['deep_social_share_layout'] : '';
		$dashed_title          = sanitize_title_with_dashes( get_the_title( $post_id ) );
		$dashed_blog_info_name = sanitize_title_with_dashes( get_bloginfo( 'name' ) );
		$title_with_dash       = str_replace( ' ', '-', get_the_title( $post_id ) );
		switch ( $layout ) {
			case '1':
				echo '<div class="post-sharing post-sharing-' . $layout . '">
                        <div class="blog-social-' . $layout . '">
                            <a target="_blank" class="facebook single-wntooltip" data-wntooltip="Share on facebook" href="https://www.facebook.com/sharer.php?u=' . get_the_permalink( $post_id ) . '"><i class="wn-fab wn-fa-facebook-f"></i></a>
                            <a target="_blank" class="twitter single-wntooltip" data-wntooltip="Tweet" href="https://twitter.com/share?text=' . $title_with_dash . '&url=' . get_the_permalink( $post_id ) . '"><i class="sl-social-twitter"></i></a>
                            <a target="_blank" class="linkedin single-wntooltip" data-wntooltip="Share on LinkedIn" href="https://www.linkedin.com/shareArticle?mini=true&url=' . get_the_permalink( $post_id ) . '&title=' . $title_with_dash . '"><i class="sl-social-linkedin"></i></a>
                            <a target="_blank" class="email single-wntooltip" data-wntooltip="Email" href="mailto:?subject=' . esc_html( $dashed_title ) . '&amp;body=' . get_the_permalink( $post_id ) . '"><i class="sl-envelope"></i></a>
                        </div>
                    </div>';
				break;
			case '2':
				echo '<div class="post-sharing post-sharing-' . $layout . '">
                        <div class="blog-social-' . $layout . '">
                            <a target="_blank" class="facebook hcolorf" href="https://www.facebook.com/sharer.php?u=' . get_the_permalink( $post_id ) . '"><i class="wn-fab wn-fa-facebook-f"></i>' . esc_html__( 'FACEBOOK', 'deep' ) . '</a>
                            <a target="_blank" class="twitter hcolorf" href="https://twitter.com/share?text=' . $title_with_dash . '&url=' . get_the_permalink( $post_id ) . '"><i class="wn-fab wn-fa-twitter"></i>' . esc_html__( 'TWITTER', 'deep' ) . '</a>
                            <a target="_blank" class="linkedin hcolorf" href="https://www.linkedin.com/shareArticle?mini=true&url=' . get_the_permalink( $post_id ) . '&title=' . $title_with_dash . '"><i class="wn-fab wn-fa-linkedin"></i>' . esc_html__( 'LINKEDIN', 'deep' ) . '</a>
                            <a target="_blank" class="email hcolorf" href="mailto:?subject=' . esc_html( $dashed_title ) . '&amp;body=' . get_the_permalink( $post_id ) . '"><i class="wn-fa wn-fa-envelope"></i>' . esc_html__( 'MAIL', 'deep' ) . '</a>
                        </div>
                    </div>';
				break;
			case '3':
				echo '<div class="post-sharing post-sharing-' . $layout . '">
                        <div class="blog-social-' . $layout . '">
                            <a target="_blank" class="facebook single-wntooltip" data-wntooltip="Share on facebook" href="https://www.facebook.com/sharer.php?u=' . get_the_permalink( $post_id ) . '"><i class="wn-fab wn-fa-facebook-f"></i></a>
                            <a target="_blank" class="twitter single-wntooltip" data-wntooltip="Tweet" href="https://twitter.com/share?text=' . $title_with_dash . '&url=' . get_the_permalink( $post_id ) . '"><i class="sl-social-twitter"></i></a>
                            <a target="_blank" class="linkedin single-wntooltip" data-wntooltip="Share on LinkedIn" href="https://www.linkedin.com/shareArticle?mini=true&url=' . get_the_permalink( $post_id ) . '&title=' . $title_with_dash . '"><i class="sl-social-linkedin"></i></a>
                            <a target="_blank" class="email single-wntooltip" data-wntooltip="Email" href="mailto:?subject=' . esc_html( $dashed_title ) . '&amp;body=' . get_the_permalink( $post_id ) . '"><i class="sl-envelope"></i></a>
                        </div>
                    </div>';
				break;
			case '4':
				echo '<div class="post-sharing post-sharing-' . $layout . '">
                        <h6> ' . esc_html__( 'Share on', 'deep' ) . '</h6>
                        <div class="blog-social-' . $layout . '">
                            <a target="_blank" class="facebook hcolorf" href="https://www.facebook.com/sharer.php?u=' . get_the_permalink( $post_id ) . '">' . esc_html__( 'FACEBOOK', 'deep' ) . '</a>
                            <a target="_blank" class="twitter hcolorf" href="https://twitter.com/share?text=' . $title_with_dash . '&url=' . get_the_permalink( $post_id ) . '">' . esc_html__( 'TWITTER', 'deep' ) . '</a>
                            <a target="_blank" class="linkedin hcolorf" href="https://www.linkedin.com/shareArticle?mini=true&url=' . get_the_permalink( $post_id ) . '&title=' . $title_with_dash . '">' . esc_html__( 'LINKEDIN', 'deep' ) . '</a>
                            <a target="_blank" class="email hcolorf" href="mailto:?subject=' . esc_html( $dashed_title ) . '&amp;body=' . get_the_permalink( $post_id ) . '">' . esc_html__( 'MAIL', 'deep' ) . '</a>
                        </div>
                    </div>';
				break;
			case '5':
				echo '<div class="post-sharing post-sharing-' . $layout . '">
				<h6 class="hcolorf">' . esc_html__( 'Share', 'deep' ) . '<i class="wn-icon sl-options-vertical"></i></h6>
                        <div class="blog-social-' . $layout . '">
                            <a target="_blank" class="facebook hcolorf" href="https://www.facebook.com/sharer.php?u=' . get_the_permalink( $post_id ) . '"><i class="wn-fab wn-fa-facebook-f"></i>' . esc_html__( 'FACEBOOK', 'deep' ) . '</a>
                            <a target="_blank" class="twitter hcolorf" href="https://twitter.com/share?text=' . get_the_title( $post_id ) . '&url=' . get_the_permalink( $post_id ) . '"><i class="sl-social-twitter"></i>' . esc_html__( 'TWITTER', 'deep' ) . '</a>
                            <a target="_blank" class="linkedin hcolorf" href="https://www.linkedin.com/shareArticle?mini=true&url=' . get_the_permalink( $post_id ) . '&title=' . get_the_title( $post_id ) . '"><i class="sl-social-linkedin"></i>' . esc_html__( 'LINKEDIN', 'deep' ) . '</a>
                            <a target="_blank" class="email hcolorf" href="mailto:?subject=' . esc_html( $dashed_title ) . '&amp;body=' . get_the_permalink( $post_id ) . '"><i class="sl-envelope"></i>' . esc_html__( 'MAIL', 'deep' ) . '</a>
                            <a href="#" class="more-less">
                                <div class="more">
                                    <i class="sl-plus"></i> ' . esc_html__( 'MORE', 'deep' ) . '
                                </div>
                                <div class="less">
                                    <i class="sl-minus"></i> ' . esc_html__( 'LESS', 'deep' ) . '
                                </div>
                            </a>
                        </div>
                    </div>';
				break;
		}
	}
}

/**
 * Add custom field to users profile
 *
 * @author  Webnus
 * @since   1.0.0
 */
add_action( 'personal_options_update', 'save_deep_author_position' );
add_action( 'edit_user_profile_update', 'save_deep_author_position' );
function deep_author_position( $user ) {
	?>
	<table class="form-table">
		<tr>
			<th><label for="author_position"><?php esc_html_e( 'Author position', 'deep' ); ?></label></th>
			<td>
				<input type="text" name="author_position" id="author_position" value="<?php echo esc_attr( get_the_author_meta( 'author_position', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="position"><?php esc_html_e( 'Please enter your author position.', 'deep' ); ?></span>
			</td>
		</tr>
	</table>
	<?php
}
function save_deep_author_position( $user_id ) {
	if ( ! current_user_can( 'edit_user', $user_id ) ) {
		return false;
	}

	$author_position = sanitize_text_field( $_POST['author_position'] );
	update_user_meta( $user_id, 'author_position', $author_position );
}

/**
 * Remove category parentheses and surround the post count with a span
 *
 * @author  Webnus
 * @since   1.0.0
 */
add_filter( 'wp_list_categories', 'categories_postcount_filter' );
add_filter( 'get_avatar', 'deep_gravatar_alt' );
function categories_postcount_filter( $variable ) {
	$variable = str_replace( '(', '<span class="post_count"> ', $variable );
	$variable = str_replace( ')', ' </span>', $variable );
	return $variable;
}
function deep_gravatar_alt( $text ) {
	$alt  = get_the_author_meta( 'display_name' );
	$text = str_replace( 'alt=\'\'', 'alt=\'Avatar for ' . $alt . '\' title=\'Gravatar for ' . $alt . '\'', $text );
	return $text;
}


/**
 * Adaptive images img tag
 *
 * @author  Webnus
 * @since   1.0.0
 */
if ( ! function_exists( 'deep_adaptive_images' ) ) {
	function deep_adaptive_images( $image_id = '' ) {
		$deep_options = deep_options();
		if ( $deep_options['deep_adaptive_images'] == '1' ) {
			// get image srcset
			$img_src    = wp_get_attachment_image_url( $image_id, 'medium' );
			$img_srcset = wp_get_attachment_image_srcset( $image_id, 'medium' );
			$out        = ' srcset="' . esc_attr( $img_srcset ) . '" sizes="( max-width: 300px ) 300px, ( max-width: 768px ) 768px, ( max-width: 1024px ) 1024px, ( max-width: 1440px ) 1440px, 100%"';
			return $out;
		}
	}
}

/**
 * Adaptive images background-img
 *
 * @author  Webnus
 * @since   1.0.0
 */
if ( ! function_exists( 'deep_adaptive_images_css' ) ) {
	function deep_adaptive_images_css( $attachment_id, $selector, $important = '' ) {
		$srcset = wp_get_attachment_image_srcset( $attachment_id, 'medium' );
		$sets   = explode( ', ', $srcset );

		if ( $srcset == false ) {
			return;
		}

		if ( is_array( $sets ) ) {
			$smallest_image_url = '';
			$smallest_width     = 9999;
			$min_width          = 0;
			$out                = '';
			foreach ( $sets as $set ) {
				list( $url, $width ) = explode( ' ', $set );

				if ( $smallest_width > $width ) {
					$smallest_image_url = $url;
				}

				$width = str_replace( 'w', '', $width );
				$out  .= '
					@media ( min-width: ' . $min_width . 'px ) and ( max-width: ' . $width . 'px ) {
						' . $selector . ' {
							background-image: url(' . $url . ') ' . $important . ' ;
						}
					} ';

				$min_width = $width + 1;
			}
		}

		return $out;
	}
}

/**
 * Fast contact
 *
 * @author  Webnus
 * @since   1.0.0
 */
if ( ! function_exists( 'deep_fast_contact' ) ) {
	function deep_fast_contact() {
		$deep_options = deep_options();
		$fast_contact = isset( $deep_options['deep_fast_contact_form'] ) ? $deep_options['deep_fast_contact_form'] : '';

		if ( $fast_contact == '1' ) {
			$fst_contact_t  = $deep_options['deep_fast_contact_form_title'] ? $deep_options['deep_fast_contact_form_title'] : '';
			$fst_contact_st = $deep_options['deep_fast_contact_form_subtitle'] ? $deep_options['deep_fast_contact_form_subtitle'] : '';
			$fst_form       = $deep_options['deep_fast_contact_form_forms'] ? $deep_options['deep_fast_contact_form_forms'] : '';
			$out            = '
            <div class="wn-ftc">
                <div class="wn-ftc-header colorb">
                    <i class="ti-comments"></i>
                    <div class="wn-ftc-title-wrap">
                    <h5>' . $fst_contact_t . '</h5>
                    <p>' . $fst_contact_st . '</p>
                    </div>
                    <div class="wn-ftc-close-icons">
                    <span class="ftc-min">
                        <span class="line"></span>
                    </span>
                    <span class="ftc-close"></span>

                    </div>
                </div>
                <div class="wn-ftc-body">
                    ' . do_shortcode( '[contact-form-7 id="' . $fst_form . '"]' ) . '
                </div>
            </div>';
			echo '' . $out;
		}
	}
}

/**
 * Get category slug
 *
 * @author  Webnus
 * @since   1.0.0
 */
function deep_get_cat_slug( $cat_id ) {
	if ( ! empty( $cat_id ) ) {
		$cat_id   = (int) $cat_id;
		$category = get_category( $cat_id );
		if ( ! empty( $category ) ) {
			return $category->slug;
		}
	}
}

/**
 * Get the widget
 *
 * @author  Webnus
 * @since   1.0.0
 */
if ( ! function_exists( 'get_the_widget' ) ) {
	function get_the_widget( $widget, $instance = '', $args = '' ) {
		ob_start();
		the_widget( $widget, $instance, $args );
		return ob_get_clean();
	}
}

/**
 * Separate pixel from value
 *
 * @author  Webnus
 * @since   1.0.0
 */
function deep_pixel_separate( $value ) {

	if ( isset( $value ) ) {
		if ( substr( $value, -2, 2 ) == 'px' ) {
			$value = $value;
		} elseif ( substr( $value, -1, 1 ) == '%' ) {
			$value = $value;
		} elseif ( substr( $value, -2, 2 ) == 'em' ) {
			$value = $value;
		} elseif ( ! empty( $value ) ) {
			$value = $value . 'px';
		}

		return $value;
	}

}

/**
 * Add Icons to king composer
 *
 * @author  Webnus
 * @since   1.0.0
 */
add_action( 'init', 'add_kc_icons' );
function add_kc_icons() {
	if ( function_exists( 'kc_add_icon' ) ) {
		kc_add_icon( DEEP_ASSETS_URL . 'css/backend/kc-linea-icons.css' );
		kc_add_icon( DEEP_ASSETS_URL . 'css/backend/kc-linecons-icons.css' );
		kc_add_icon( DEEP_ASSETS_URL . 'css/backend/kc-simpleline-icons.css' );
		kc_add_icon( DEEP_ASSETS_URL . 'css/backend/kc-themify-icons.css' );
		kc_add_icon( DEEP_ASSETS_URL . 'css/backend/kc-7s-icons.css' );
	}
}

/**
 * install VC and KC
 *
 * @author Webnus
 * @since   1.0.0
*/
add_action( 'admin_notices', 'deep_page_builders_activation' );
if ( ! function_exists( 'deep_page_builders_activation' ) ) {
	function deep_page_builders_activation() {
		if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {
			if ( is_plugin_active( 'kingcomposer/kingcomposer.php ') ) {
				deactivate_plugins( '/kingcomposer/kingcomposer.php' );
				echo '<div id="massage" class="error notice notice-success is-dismissible"><p>' . __( 'You have installed WPBakery Page Builder (formerly WPBakery Page Builder) before and you can not install 2-page builders together.', 'deep' ) . '</p></div>';
			}
			if ( is_plugin_active( 'kc_pro/kc_pro.php' ) ) {
				deactivate_plugins( '/kc_pro/kc_pro.php' );
				echo '<div id="massage" class="error notice notice-success is-dismissible"><p>' . __( 'You have installed WPBakery Page Builder (formerly WPBakery Page Builder) before and you can not install 2-page builders together.', 'deep' ) . '</p></div>';
			}
		}
	}
}

/**
 * Remove slider revolution Admin Notice
 *
 * @author Webnus
 * @since   1.0.0
 */
function deep_remove_revslider_notice() {
	update_option( 'revslider-valid-notice', false );
}


/**
 * Deactivate webnus-core plugin
 *
 * @author Webnus
 * @since   1.0.0
 */
add_action( 'init', 'deactivate_webnucore' );
function deactivate_webnucore() {
	if ( is_plugin_active( 'webnus-core/webnus-core.php' ) ) {
		deactivate_plugins( 'webnus-core/webnus-core.php' );
	}
}

/**
 * Admin Custom css
 *
 * @author Webnus
 * @since   1.0.6
 */
function deep_admin_custom_css() {
	$deep_options          = deep_options();
	$deep_admin_custom_css = isset( $deep_options['deep_theme_admin_custom_css'] ) ? $deep_options['deep_theme_admin_custom_css'] : '';
	$deep_theme_admin_logo = isset( $deep_options['deep_theme_admin_logo']['url'] ) ? $deep_options['deep_theme_admin_logo']['url'] : '';

	if ( ! empty( $deep_admin_custom_css ) ) {
		$deep_admin_custom_css = str_replace( array( "\r\n", "\r", "\n", "\t", '    ' ), '', $deep_admin_custom_css );
		echo '<style rel="stylesheet" id="deep-admin-custom-css" >';
				echo esc_html( $deep_admin_custom_css );
		echo '</style>';

	}

	if ( ! empty( $deep_theme_admin_logo ) ) {
		echo '<style>';
			echo '.toplevel_page_wn-admin-welcome .wp-menu-image img {width: 18px;}';
			echo '.wn-admin-wrap .wp-badge { background-image: url(' . $deep_theme_admin_logo . '); }';
			echo '.redux-sidebar:before { background: #fff url(' . $deep_theme_admin_logo . ') no-repeat center; background-size: contain;}';
		echo '</style>';
	}
}

/**
 * Admin Post rating
 *
 * @author Webnus
 * @since   1.1.0
 */
function deep_admin_post_review() {
	wp_enqueue_style( 'deep-blog-average-stars', DEEP_ASSETS_URL . 'css/frontend/blog/average-stars.css', false, DEEP_VERSION );

	$reviews          = rwmb_meta( 'deep_blogpost_review' );
	$total_vots       = 0;
	$total_rates      = 0;
	$stars            = '';
	$item_empty_stars = '';
	$item_full_stars  = '';
	$out              = '';

	if ( $reviews ) {
		foreach ( $reviews as $item ) {
			if ( ! empty( $item['0'] ) and ! empty( $item['1'] ) ) {
				$total_vots = $total_vots + round( $item['1'] );
				$total_rates++;
			}
		}
		if ( $total_vots != 0 && $total_rates != 0 ) {
			$average  = $total_vots / $total_rates;
			$decimals = explode( '.', $average );

			// stars wrap
			$stars .= '<div class="blg-wn-average-stars">';
			$stars .= '<div class="post-review-rating">';
			$stars .= '<div class="stars-wrap">';
			// empty stars
			$stars .= '<div class="wn-empty-stars">';
			for ( $i = 0; $i < 5; $i++ ) {
				$stars .= '<i class="wn-far wn-fa-star"></i>';
			}
			$stars .= '</div>';
			$stars .= '<div class="item-full-stars">';

			for ( $i = 0; $i < $decimals['0']; $i++ ) {
				$stars .= '<i class="wn-fas wn-fa-star full-stars"></i>';
			}
			// half stars
			if ( ! empty( $decimals['1'] ) ) :
				if ( $decimals['1'] <= 5 ) {
					$stars .= '<i class="wn-fas wn-fa-star-half half-stars"></i>';
				} elseif ( $decimals['1'] > 5 ) {
					$stars .= '<i class="wn-fas wn-fa-star"></i>';
				}
			endif;

			$stars .= '</div>';
			$stars .= '</div>';
			$stars .= '</div>';
			$stars .= '</div>'; // end wn-post-stars
			$stars .= '<div class="clearfix"></div>';
			$out   .= $stars;
		}
	}
	return $out;
}

/**
 * SSL Support
 *
 * @author Webnus
 * @since   1.1.1
 */
function deep_ssl() {
	$protocol = ( is_ssl() ) ? 'https://' : 'http://';
	return $protocol;
}


/**
 * Sync Favicon
 *
 * @author Webnus
 * @since   1.1.1
*/
add_action( 'after_switch_theme', 'wn_favicon' );
function wn_favicon() {
	add_option( 'sync_favicon', '0' );
	add_option( 'theme_option_fav', '0' );
	add_option( 'customizer_fav', '0' );
	if ( get_option( 'sync_favicon' ) == '0' ) {
		update_option( 'sync_favicon', '1' );
		$file        = DEEP_ASSETS_URL . 'images/favicon.png';
		$filename    = basename( $file );
		$upload_file = wp_upload_bits( $filename, null, file_get_contents( $file ) );
		if ( ! $upload_file['error'] ) {
			$wp_filetype   = wp_check_filetype( $filename, null );
			$attachment    = array(
				'post_mime_type' => $wp_filetype['type'],
				'post_parent'    => $parent_post_id,
				'post_title'     => preg_replace( '/\.[^.]+$/', '', $filename ),
				'post_content'   => '',
				'post_status'    => 'inherit',
			);
			$attachment_id = wp_insert_attachment( $attachment, $upload_file['file'], $parent_post_id );
			$attach_url    = wp_get_attachment_url( $attachment_id );
			if ( ! is_wp_error( $attachment_id ) ) {
				require_once ABSPATH . 'wp-admin' . '/includes/image.php';
				$attachment_data = wp_generate_attachment_metadata( $attachment_id, $upload_file['file'] );
				wp_update_attachment_metadata( $attachment_id, $attachment_data );
			}
		}

		if ( get_option( 'site_icon' ) == '0' ) {
			update_option( 'site_icon', $attachment_id );
		}
		update_option( 'sync_favicon_url', $attach_url );
		update_option( 'sync_favicon_id', $attachment_id );
		$option_array = array( 'url' => $attach_url, 'id' => $attachment_id );
		Redux::setOption( 'deep_options', 'deep_favicon', $option_array );
		Redux::setOption( 'deep_options', 'deep_footer_logo', $option_array );
	}
}

function check_favicon() {
	if ( get_option( 'sync_favicon' ) == '1' ) {
		$deep_options = deep_options();
		if ( empty( $deep_options['deep_favicon']['url'] ) && ! empty( get_option( 'sync_favicon_url' ) ) ) {
			$option_array = array( 'url' => get_option( 'sync_favicon_url' ), 'id' => get_option( 'sync_favicon_id' ) );
			Redux::setOption( 'deep_options', 'deep_favicon', $option_array );
			Redux::setOption( 'deep_options', 'deep_footer_logo', $option_array );
		} elseif ( ! empty( $deep_options['deep_favicon']['url'] ) && $deep_options['deep_favicon']['url'] != get_option( 'sync_favicon_url' ) ) {
			update_option( 'sync_favicon_url', $deep_options['deep_favicon']['url'] );
			update_option( 'sync_favicon_id', $deep_options['deep_favicon']['id'] );
			update_option( 'site_icon', $deep_options['deep_favicon']['id'] );
		}
		if ( ( get_option( 'site_icon' ) != '0' ) && get_option( 'site_icon' ) != get_option( 'sync_favicon_id' ) ) {
			update_option( 'sync_favicon_id', get_option( 'site_icon' ) );
			update_option( 'sync_favicon_url', wp_get_attachment_url( get_option( 'sync_favicon_id' ) ) );
			$option_array = array( 'url' => get_option( 'sync_favicon_url' ), 'id' => get_option( 'sync_favicon_id' ) );
			Redux::setOption( 'deep_options', 'deep_favicon', $option_array );
			Redux::setOption( 'deep_options', 'deep_footer_logo', $option_array );
		}
	}

}


/**
 * JetPack Compatibility
 *
 * @author Webnus
 * @since   1.1.1
*/
if ( is_plugin_active( 'jetpack/jetpack.php' ) ) :

// Responsive Video
function jetpackme_compatibility() {

	add_theme_support( 'jetpack-responsive-videos' );
	add_theme_support( 'jetpack-social-menu' );
	add_theme_support(
		'social-links',
		array(
			'facebook',
			'twitter',
			'linkedin',
			'google_plus',
			'tumblr',
		)
	);
	add_theme_support(
		'featured-content',
		array(
			'filter'     => 'deep_get_featured_posts',
			'max_posts'  => 20,
			'post_types' => array( 'post', 'page' ),
		)
	);
	add_theme_support(
		'infinite-scroll',
		array(
			'container' => 'wn-infinite-jetpack',
			'render'    => 'wn_jetpack_infinite_scroll',
		)
	);

}
add_action( 'after_setup_theme', 'jetpackme_compatibility' );

function deep_get_featured_posts() {

	return apply_filters( 'deep_get_featured_posts', array() );

}

function wn_jetpack_infinite_scroll() {

	while ( have_posts() ) {
		the_post();
			get_template_part( 'inc/templates/loops/blogloop' );
	}
}


function deep_has_featured_posts( $minimum = 1 ) {
	if ( is_paged() ) {
		return false;
	}

	$minimum        = absint( $minimum );
	$featured_posts = apply_filters( 'deep_get_featured_posts', array() );

	if ( ! is_array( $featured_posts ) ) {
		return false;
	}

	if ( $minimum > count( $featured_posts ) ) {
		return false;
	}

	return true;
}

endif;

// Google AdSense
function deep_google_adsense( $content ) {
	if ( is_single() ) {
		global $deep_options;
		$aftercontent  = '';
		$beforecontent = '';

		if ( deep_get_option( $deep_options, 'deep_ads_after' ) == '1' ) {
			$aftercontent = deep_get_option( $deep_options, 'deep_google_ads' );
		}
		if ( deep_get_option( $deep_options, 'deep_ads_before' ) == '1' ) {
			$beforecontent = deep_get_option( $deep_options, 'deep_google_ads' );
		}
		$fullcontent = $beforecontent . $content . $aftercontent;
		return $fullcontent;
	}
	return $content;
}
add_filter( 'the_content', 'deep_google_adsense' );

function header_hide_admin() {
	echo '<style>
	.whb-frontend-builder-wrap #wpadminbar {
		display: none;
	}
	</style>';
}
add_action('admin_head', 'header_hide_admin');

/**
 * Prebuilds header
 *
 * @author Webnus
 * @since   4.0.1
 */
function deep_prebuilds_header() {

	$upload_dir = wp_upload_dir()['basedir'] . '/deep-header';

	if ( wp_mkdir_p( $upload_dir ) ) {
		wp_mkdir_p( $upload_dir );
	}

	if ( file_exists($upload_dir) ) {

		$value = '';

		if ( wn_check_url( deep_ssl() . 'deeptem.com/deep-downloads/prebuilds/headers.zip') ) {
			$value = deep_ssl() . 'deeptem.com/deep-downloads/prebuilds/headers.zip';
		}

		$get_file = wp_remote_get( $value, array( 'timeout' => 120, 'httpversion' => '1.1', ) );

		$upload = wp_upload_bits( basename( $value ), '', wp_remote_retrieve_body( $get_file ) );
		// var_dump($upload['file']);

		if( !empty( $upload['error'] ) ) {
			return false;
		}

		die();
	}
}

if ( is_plugin_active( 'yith-woocommerce-wishlist/init.php' ) && class_exists( 'YITH_WCWL' ) ) {
	class DEEP_YITH_WCWL extends YITH_WCWL {
		function __construct() {

		}
		public function get_wish_id() {

			$wishlist_id = ( isset( $this->details['wishlist_id'] ) && strcmp( $this->details['wishlist_id'], 0 ) != 0 ) ? $this->details['wishlist_id'] : false;

			return $wishlist_id;
		}
		public function get_quantity() {

			$quantity = ( isset( $this->details['quantity'] ) ) ? ( int ) $this->details['quantity'] : 1;

			return $quantity;

		}
	}
}

if ( ! function_exists( 'deep_get_wish' ) ) {
	/**
	* Before Shop Loop item
	*
	* @since   1.0.0
	* @return  wishlist items
	*/
	function deep_get_wish( $type = 'render' ) {
		if ( ! is_plugin_active( 'yith-woocommerce-wishlist/init.php' ) ) {
			return;
		}

		global $wpdb, $yith_wcwl, $woocommerce;

		$cnt = array();
		if ( is_user_logged_in() ) {
			$user_id = get_current_user_id();
			$cnt = $wpdb->get_results( $wpdb->prepare( 'SELECT COUNT(*) as `cnt` FROM `' . YITH_WCWL_TABLE . '` WHERE `user_id` = %d', $user_id  ), ARRAY_A );
			$cnt = $cnt[0]['cnt'];
		} else {
			$cnt[0]['cnt'] = count( yith_getcookie( 'yith_wcwl_products' ) );
			$cnt = $cnt[0]['cnt'];
		}

		if ( is_array( $cnt ) ) {
			$cnt = 0;
		}

		// if user is loged in get item or get cookie items
		if( is_user_logged_in() ) {
			$lm_sql = '';
			$wnlist = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM `" . YITH_WCWL_TABLE . "` WHERE `user_id` = %s" . $lm_sql, $user_id ), ARRAY_A );
		} else {
			$wnlist = yith_getcookie( 'yith_wcwl_products' );
		}

		// define product limit var
		$cnt_limit = 0;
		$out_contents = '';

		// if wnlist greater than 0 start to list them
		if ( count( $wnlist ) > 0 ) {
			foreach( $wnlist as $values ) {

				// start define yith render attrs
				if ( $type == 'yith_render' ) {
					global $product;

					// check if woo get product exist for get info
					if( function_exists( 'wc_get_product' ) ) {
						$product = wc_get_product( $values['prod_id'] );
					} else {
						$product = wc_get_product( $values['prod_id'] );
					}

					$stock_status = 'out-of-stock';
					// check if product exist return stock status
					if( $product !== false && $product->exists() ) {
						$availability = $product->get_availability();
						$stock_status = $availability['class'];
					}

					// check for stock status
					if( $stock_status == 'out-of-stock' ) {
						$s_status = '0';
						$stock_status = '<span class="wishlist-out-of-stock-sl col-md-2">' . __( 'Out of Stock', 'deep' ) . '</span>';
					} else {
						$s_status = '1';
						$stock_status = '<span class="wishlist-in-stock col-md-2">' . __( 'In Stock', 'deep' ) . '</span>';
					}
				}
				// end define yith render attrs

				// show only 6 item
				if ($cnt_limit < 1000) {

					if ( is_user_logged_in() == false ) {
						if ( isset( $values[ 'add-to-wishlist' ] ) ) {
							$values[ 'prod_id' ] = $values[ 'add-to-wishlist' ];
							$values[ 'ID' ] = $values[ 'add-to-wishlist' ];
						} else {
							if ( isset( $values[ 'product_id' ] ) ) {
								$values[ 'prod_id' ] = $values[ 'product_id' ];
								$values[ 'ID' ] = $values[ 'product_id' ];
							} else {
								$values[ 'ID' ] = $values[ 'prod_id' ];
							}
						}
					}

					$product_obj = wc_get_product( $values[ 'prod_id' ] );
					// show product on wish list
					if ( $product_obj == true && $product_obj->exists() ) {
						$out_thumb = $out_price = '';

						// get product thumnail
						if ( has_post_thumbnail( $values[ 'prod_id' ] ) ) {
							$image  = wp_get_attachment_image_src( get_post_thumbnail_id( $values[ 'prod_id' ] ), 'thumbnail' );
							if ( $image ) {
								$out_thumb = '<a class="wn-wishlist-img" href="'.esc_url( get_permalink( $values[ 'prod_id' ] ) ).'"><img src="' . $image[0] . '" /></a>';
							}
						}

						// get price
						if ( get_option( 'woocommerce_display_cart_prices_excluding_tax' ) == 'yes' ) {
							$out_price = apply_filters( 'woocommerce_cart_item_price_html', wc_price( $product_obj->get_price_excluding_tax() ), $values, '' );
						} else {
							$out_price = apply_filters( 'woocommerce_cart_item_price_html', wc_price( $product_obj->get_price() ), $values, '' );
						}

						// header render
						$out_thumb_header = '';
						if ( has_post_thumbnail( $values[ 'prod_id' ] ) ) {
							$image_url  = wp_get_attachment_image_src( get_post_thumbnail_id( $values[ 'prod_id' ] ) );
							if( !empty( $image_url ) ) {
								// if main class not exist get it
								if ( !class_exists( 'Wn_Img_Maniuplate' ) ) {
									require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
								}
								$image = new Wn_Img_Maniuplate; // instance from settor class
								$image_url = $image->m_image( get_post_thumbnail_id( $values[ 'prod_id' ] ) , $image_url[0] , '64' , '64' ); // set required and get result
							}
							if ( $image_url ) {
								$out_thumb_header = '<a class="wn-wishlist-img" href="'.esc_url( get_permalink( $values[ 'prod_id' ] ) ).'"><img src="' . $image_url . '" /></a>';
							}
						}
						if ( $type == 'render' && $cnt_limit < 6 ) {
							$out_contents .= '
								<div class="clearfix wn-wishlist-content">
									' . $out_thumb_header . '
									<div class="wn-wishlist-entry-content">
										<h4><a class="wn-wishlist-title" href="' . esc_url( get_permalink( $values['prod_id'] ) ) . '">' . $product_obj->get_title() . '</a>
										</h4>
										<a data-wish="' . $values['prod_id']  . '" class="wn-remove-from-wishlist">&times;
										</a>
										' . $out_price . '
									</div>
								</div>';

							// single wishlist render
						} elseif ( $type == 'yith_render' ) {

							// is add to cart enable?
							$show_add_to_cart = get_option( 'yith_wcwl_add_to_cart_show' ) == 'yes' ;

							// thumnails and titles
							$out_contents .= '
								<div class="wn-wishlist-content-sl row">
									<div class="wishlist-overflow"></div>
									<div class="wn-wishlist-entry-content-sl wn-wishlist-content">
										<span class="col-md-1"> ' . $out_thumb . ' </span>
										<h4><a class="wn-wishlist-product-title-sl col-md-4" href="' . esc_url( get_permalink( $values['prod_id'] ) ) . '">' . $product_obj->get_title() . '</a>
										</h4>';
							// in stock and price
							$out_contents .= '
										' . $stock_status . '
										<span class="col-md-1"> ' . $out_price . ' </span> ';
							$out_contents .= isset( $show_add_to_cart ) ? '<div class="wn-add-cart col-md-2" > <a href=" '. esc_url( get_permalink( $values['prod_id'] ) ) .' " class="wn-add-to-cart-single"> ' .__( 'Add To Cart', 'deep' ) . '</a></div>' : '' ;
							// remove button
							$out_contents .= '
										<div class="wn-remove-product col-md-1" >
											<a data-wish="' . $values['prod_id']  . '" class="wn-remove-from-wishlist">&times;
											</a>
										</div>
									</div>
								</div>';
						}
					}

					$cnt_limit++;
				}

			}
		} else {
			$out_contents = '<div class="wn-empty-wishlist aligncenter"><span>' . esc_html__( 'Your wishlist is empty.', 'deep' ) . '</span></div>';
		}

		if ( $type == 'icon' ) {
			return '
					<i class="wn-wishlist-btn sl-heart wn-click"></i>
						<span class="wn-wishlist-cnt">' . $cnt . '</span>';
		}

		if ( $cnt > 1 ) {
			$items_text = esc_html__( 'Items In Wishlist', 'deep' );
		} else {
			$items_text = esc_html__( 'Item In Wishlist', 'deep' );
		}

		if ( $type == 'render' ) {
			$out = '
				<div class="wn-header-wishlist-content-wrap wn-content-toggle">
					<p class="wn-wishlist-total"><span class="wn-wishlist-total-cnt">' . $cnt .' </span> '. $items_text . '</p>
					<div class="wn-wishlist-contents">' . $out_contents . '
						<a class="wn-wishlist-buttons" href="' . $yith_wcwl->get_wishlist_url() . '">
							<span>' . esc_html__( 'View Wishlist', 'deep' ) . '</span>
						</a>
					</div>
				</div>';
			return $out;
		}
		if ( $type == 'yith_render' ) {
			return $out_contents;
		}

	}
}

if ( is_plugin_active( 'yith-woocommerce-wishlist/init.php' ) ) {
	/**
	* Register wishlist ajax
	*
	* @since   1.0.0
	* @return  wishlist items
	*/
	add_action( 'wp_ajax_nopriv_add_wishlist_deep', 'add_wishlist_deep' );
	add_action( 'wp_ajax_add_wishlist_deep', 'add_wishlist_deep' );
	function add_wishlist_deep () {

		global $wpdb;
		$prod_id = isset( $_POST[ 'proidadd' ] )  ?  sanitize_text_field( $_POST[ 'proidadd' ] ) : false;
		$user_id = get_current_user_id() ? get_current_user_id() : false;

		if ( is_user_logged_in() ) {
			$insert_args = array(
				'prod_id' => $prod_id,
				'user_id' => $user_id,
				'quantity' => '1',
				'dateadded' => date( 'Y-m-d H:i:s' )
			);

			$result = $wpdb->insert( $wpdb->yith_wcwl_items, $insert_args );

			$out = deep_get_wish( 'render' );
			die( $out );

		} else {
			echo 'doit';
			$details = new DEEP_YITH_WCWL;

			$quantity = $details->get_quantity();

			$wishlist_id = $details->get_wish_id();

			$cookie = array(
				'prod_id' => $prod_id,
				'quantity' => $quantity,
				'wishlist_id' => $wishlist_id
			);

			$wishlist = yith_getcookie( 'yith_wcwl_products' );

			$found = $details->is_product_in_wishlist( $prod_id, $wishlist_id );

			if( ! $found ){
				$wishlist[] = $cookie;
			}

			yith_setcookie( 'yith_wcwl_products', $wishlist );

			$result = true;

		}

		wp_die();
	}
}

/**
* Elementor magazine widget AJAX
*
* @author Webnus
* @since   4.1.2
*/
function deep_magazine_ele_ajax() {
	$uniqid 		= sanitize_text_field( $_POST['uniqid'] )			? sanitize_text_field( $_POST['uniqid'] ) : '' ;
	$param_category	= sanitize_text_field( $_POST['param_category'] )	? sanitize_text_field( $_POST['param_category'] ) : '' ;
	$post_title		= sanitize_text_field( $_POST['post_title'] )		? sanitize_text_field( $_POST['post_title'] ) : '' ;
	$post_url		= sanitize_text_field( $_POST['post_url'] )		    ? sanitize_text_field( $_POST['post_url'] ) : '' ;
	$post_number	= sanitize_text_field( $_POST['post_number'] )		? sanitize_text_field( $_POST['post_number'] ) : '' ;
	$post_prepage	= sanitize_text_field( $_POST['post_prepage'] )	    ? sanitize_text_field( $_POST['post_prepage'] ) : '' ;
	$sort_order		= sanitize_text_field( $_POST['sort_order'] )		? sanitize_text_field( $_POST['sort_order'] ) : '' ;
	$type			= sanitize_text_field( $_POST['type'] ) 			? sanitize_text_field( $_POST['type'] ) : '' ;
	$param_tag		= sanitize_text_field( $_POST['param_tag'] )		? sanitize_text_field( $_POST['param_tag'] ) : '' ;
	$pagination		= sanitize_text_field( $_POST['pagination'] )		? sanitize_text_field( $_POST['pagination'] ) : '' ;
	$reviews		= sanitize_text_field( $_POST['reviews'] )			? sanitize_text_field( $_POST['reviews'] ) : '' ;

	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => $post_number,
		'cat'            => $param_category,
		'orderby'        => $sort_order,
	);

	$custom_query = new \WP_Query( $args );
	$temp_query   = $custom_query;
	$custom_query = null;
	$magazine     = $temp_query;
	$totall_post = $magazine->post_count ? $magazine->post_count : '';

	if ( $type == '1' ) {
		static $magazin_uniqid = 0;
		$magazin_uniqid++;
		?>

	<div
	class="magazin-wrap magazin-<?php echo '' . $type; ?>"
	data-id="<?php echo esc_attr( $magazin_uniqid ); ?>"
	data-totall_post="<?php echo esc_attr( $totall_post ); ?>"
	data-pagination="<?php echo esc_attr( $pagination ); ?>"
	data-param_tag="<?php echo esc_attr( $param_tag ); ?>"
	data-post_title="<?php echo esc_html( $post_title ); ?>"
	data-post_url="<?php echo esc_attr( $post_url ); ?>"
	data-type="<?php echo esc_attr( $type ); ?>"
	data-sort_order="<?php echo esc_attr( $sort_order ); ?>"
	data-post_number="<?php echo esc_attr( $post_number ); ?>"
	data-post_prepage="<?php echo esc_attr( $post_prepage ); ?>"
	>

		<?php static $title_uniqid = 0; $title_uniqid++; ?>
		<?php if ($post_url): ?>
				<?php $post_title = $post_title ? '<a href="' . $post_url . '"><h4 class="magazin-title" data-id="' . $title_uniqid . '">' . $post_title . '</h4></a>' : '';  ?>
		<?php else: ?>
				<?php $post_title = $post_title ? '<h4 class="magazin-title" data-id="' . $title_uniqid . '">' . $post_title . '</h4>' : '';  ?>
		<?php endif; ?>
		<div class="clearfix">
		<div class="magazin-wrap-content">

			<?php
			$post_counter = 0;
			if ( $magazine->have_posts() ) {
				?>
				<?php
				static $uniqid = 0;
				while ( $magazine->have_posts() ) {
					$post_counter++;
					$magazine->the_post();

					$uniqid++;
					$thumbnail_url = get_the_post_thumbnail_url();
					$thumbnail_id  = get_post_thumbnail_id();

					if ( ! empty( $thumbnail_url ) ) {
						if ( ! class_exists( 'Wn_Img_Maniuplate' ) ) {
							require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';

						}
						$image         = new \Wn_Img_Maniuplate();
						$thumbnail_url = $image->m_image( $thumbnail_id, $thumbnail_url, '508', '300' );
					}
					?>

					<?php if ( $post_counter % 2 == 1 ) { ?>
						<div class="row">
					<?php } ?>
							<div class="col-md-6 wn-pagination" >
								<article class="magazine-b<?php echo '' . $type; ?> magazine-b<?php echo '' . $type; ?>-cont" data-id="<?php echo '' . $uniqid; ?>">
									<figure class="magazine-b<?php echo '' . $type; ?>-img">
										<a href="<?php the_permalink(); ?>">
											<?php if ( ! empty( $thumbnail_url ) ) : ?>
												<img src="<?php echo '' . $thumbnail_url; ?>" alt="<?php the_title(); ?>" >
											<?php else : ?>
												<img src="<?php echo DEEP_ASSETS_URL . 'images/featured.jpg'; ?>"  alt="<?php echo get_the_title(); ?>"/>
											<?php endif ?>
										</a>
									</figure>
									<div class="magazine-b<?php echo '' . $type; ?>-cont">
										<div class="magazine-b<?php echo '' . $type; ?>-category" style="background: <?php echo deep_category_color(); ?>;">
											<span class="magazine-b<?php echo '' . $type; ?>-cat magazine-cat" data-id="<?php echo '' . $uniqid; ?>"><?php the_category( ', ' ); ?></span>
										</div>
										<div class="magazine-b<?php echo '' . $type; ?>-date">
											<i class="pe-7s-clock"></i><?php echo get_the_date(); ?>
										</div>
										<h3 class="magazine-b<?php echo '' . $type; ?>-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
										<div class="magazine-author">
											<span><?php echo get_avatar( get_the_author_meta( 'user_email' ), 28 ); ?></span>
											<span><?php the_author_posts_link(); ?></span>
										</div>
										<?php $reviews == 'show' ? deep_admin_post_review() : ''; ?>
									</div>
								</article>
							</div>
					<?php if ( $post_counter % 2 == 0 ) { ?>
						</div>
					<?php } ?>
				<?php } ?>
		</div>
	</div><!-- End magazin-wrap  -->
		<?php } ?>
	</div>
		<?php
	} elseif ( $type == '2' ) {
		static $magazin_uniqid = 0;
		$magazin_uniqid++;
		?>

	<div
		class="magazin-wrap magazin-<?php echo esc_attr( $type ); ?>"
		data-id="<?php echo esc_attr( $magazin_uniqid ); ?>"
		data-totall_post="<?php echo esc_attr( $totall_post ); ?>"
		data-pagination="<?php echo esc_attr( $pagination ); ?>"
		data-param_tag="<?php echo esc_attr( $param_tag ); ?>"
		data-post_title="<?php echo esc_attr( $post_title ); ?>"
		data-post_url="<?php echo esc_attr( $post_url ); ?>"
		data-type="<?php echo esc_attr( $type ); ?>"
		data-sort_order="<?php echo esc_attr( $sort_order ); ?>"
		data-post_number="<?php echo esc_attr( $post_number ); ?>"
		data-post_prepage="<?php echo esc_attr( $post_prepage ); ?>"
	>
		<?php
		static $title_uniqid = 0;
		$title_uniqid++;

		$post_title = $post_title ? '<h4 class="magazin-title" data-id="' . $title_uniqid . '">' . $post_title . '</h4>' : '';
		?>
		<div class="clearfix">
			<div class="magazin-wrap-content">

				<?php
				$first_post   = true;
				$post_counter = 0;
					// The Loop
				if ( $magazine->have_posts() ) {
					static $uniqid = 0;
					?>

					<div class="row">
						<?php
						while ( $magazine->have_posts() ) {
							$post_counter++;
							$magazine->the_post();
							$uniqid++;
							$thumbnail_url = get_the_post_thumbnail_url();
							$thumbnail_id  = get_post_thumbnail_id();
							if ( ! empty( $thumbnail_url ) ) {
								if ( ! class_exists( 'Wn_Img_Maniuplate' ) ) {
									require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
								}
								$image           = new \Wn_Img_Maniuplate();
								$thumbnail_url_1 = $image->m_image( $thumbnail_id, $thumbnail_url, '508', '300' );
								$thumbnail_url_2 = $image->m_image( $thumbnail_id, $thumbnail_url, '120', '80' );
							}
							if ( $first_post == true ) {
								?>
								<div class="col-md-6">
									<div class="left-section">
										<article class="magazine-b<?php echo '' . $type; ?> magazine-b<?php echo '' . $type; ?>-cont" data-id="<?php echo '' . $uniqid; ?>">
											<figure class="magazine-b<?php echo '' . $type; ?>-img">
												<img src="<?php echo '' . $thumbnail_url_1; ?>" alt="<?php the_title(); ?>" >
											</figure>
											<div class="magazine-b<?php echo '' . $type; ?>-cont">
												<div class="magazine-b<?php echo '' . $type; ?>-category" style="background: <?php echo deep_category_color(); ?>;">
													<span class="magazine-b<?php echo '' . $type; ?>-cat magazine-cat" data-id="<?php echo '' . $uniqid; ?>"><?php the_category( ', ' ); ?></span>
												</div>
												<div class="magazine-b<?php echo '' . $type; ?>-date">
													<i class="pe-7s-clock"></i><?php echo get_the_date(); ?>
												</div>
												<h3 class="magazine-b<?php echo '' . $type; ?>-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
												<div class="magazine-author">
													<span><?php echo get_avatar( get_the_author_meta( 'user_email' ), 28 ); ?></span>
													<span><?php the_author_posts_link(); ?></span>
												</div>
												<?php $reviews == 'show' ? deep_admin_post_review() : ''; ?>
											</div>
										</article>
									</div>
								</div>
							<?php } else { ?>
									<?php if ( $post_counter == 2 ) { ?>
										<div class="col-md-6">
											<div class="right-section">
									<?php } ?>
											<article class="wn-pagination magazine-b<?php echo '' . $type; ?> magazine-b<?php echo '' . $type; ?>-cont" data-id="<?php echo '' . $uniqid; ?>">
												<figure class="magazine-b<?php echo '' . $type; ?>-img">
													<img src="<?php echo '' . $thumbnail_url_2; ?>" alt="<?php the_title(); ?>" >
												</figure>
												<div class="magazine-b<?php echo '' . $type; ?>-cont">
													<div class="magazine-b<?php echo '' . $type; ?>-date">
														<i class="pe-7s-clock"></i><?php echo get_the_date(); ?>
													</div>
													<?php $reviews = $reviews == 'show' ? deep_admin_post_review() : ''; ?>
													<h3 class="magazine-b<?php echo '' . $type; ?>-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
												</div>
											</article>
									<?php if ( ( $magazine->current_post + 1 ) == ( $magazine->post_count ) ) { ?>
											</div>
										</div>
									<?php } ?>
								<?php if ( $first_post == true ) { ?>
									</div>
								<?php } ?>
								<?php
							} $first_post = false;
						}
						?>
					</div>
			</div>
		</div><!-- End magazin-wrap  -->
			<?php } ?>
	</div>
		<?php
	} elseif ( $type == '3' ) {
		static $magazin_uniqid = 0;
		$magazin_uniqid++;
		?>

	<div
		class="magazin-wrap magazin-<?php echo esc_attr( $type ); ?>"
		data-id="<?php echo esc_attr( $magazin_uniqid ); ?>"
		data-totall_post="<?php echo esc_attr( $totall_post ); ?>"
		data-pagination="<?php echo esc_attr( $pagination ); ?>"
		data-param_tag="<?php echo esc_attr( $param_tag ); ?>"
		data-post_title="<?php echo esc_html( $post_title ); ?>"
		data-post_url="<?php echo esc_attr( $post_url ); ?>"
		data-type="<?php echo esc_html( $type ); ?>"
		data-sort_order="<?php echo esc_attr( $sort_order ); ?>"
		data-post_number="<?php echo esc_attr( $post_number ); ?>"
		data-post_prepage="<?php echo esc_attr( $post_prepage ); ?>"
	>
		<?php
		static $title_uniqid = 0;
		$title_uniqid++;
		$post_title = $post_title ? '<h4 class="magazin-title" data-id="' . $title_uniqid . '">' . $post_title . '</h4>' : '';
		?>
		<div class="clearfix">
			<div class="magazin-wrap-content">
				<?php
				$first_post   = true;
				$post_counter = 0;
				// The Loop
				if ( $magazine->have_posts() ) {
					?>
					<div class="row">
						<?php
						static $uniqid = 0;
						while ( $magazine->have_posts() ) {
							$post_counter++;
							$magazine->the_post();
							$uniqid++;
							$thumbnail_url = get_the_post_thumbnail_url();
							$thumbnail_id  = get_post_thumbnail_id();
							if ( ! empty( $thumbnail_url ) ) {
								if ( ! class_exists( 'Wn_Img_Maniuplate' ) ) {
									require_once DEEP_CORE_DIR . 'helper-classes/class_webnus_manuplate.php';
								}
								$image           = new \Wn_Img_Maniuplate();
								$thumbnail_url_1 = $image->m_image( $thumbnail_id, $thumbnail_url, '508', '300' );
								$thumbnail_url_2 = $image->m_image( $thumbnail_id, $thumbnail_url, '120', '80' );
							}
							if ( $first_post == true ) {
								?>
								<div class="col-md-6">
									<div class="left-section ">
										<article class="magazine-b<?php echo '' . $type; ?> magazine-b<?php echo '' . $type; ?>-cont" data-id="<?php echo '' . $uniqid; ?>">
											<figure class="magazine-b<?php echo '' . $type; ?>-img">
												<a href="<?php the_permalink(); ?>">
													<img src="<?php echo '' . $thumbnail_url_1; ?>" alt="<?php the_title(); ?>" >
												</a>
											</figure>
											<div class="magazine-b<?php echo '' . $type; ?>-cont">
												<div class="magazine-b<?php echo '' . $type; ?>-category" style="background: <?php echo deep_category_color(); ?>;">
													<span class="magazine-b<?php echo '' . $type; ?>-cat magazine-cat" data-id="<?php echo '' . $uniqid; ?>"><?php the_category( ', ' ); ?></span>
												</div>
												<div class="magazine-b<?php echo '' . $type; ?>-date">
													<i class="pe-7s-clock"></i><?php echo get_the_date(); ?>
												</div>
												<h3 class="magazine-b<?php echo '' . $type; ?>-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
												<div class="magazine-author">
													<span><?php echo get_avatar( get_the_author_meta( 'user_email' ), 28 ); ?></span>
													<span><?php the_author_posts_link(); ?></span>
												</div>
												<?php $reviews == 'show' ? deep_admin_post_review() : ''; ?>
											</div>
										</article>
									</div>
								</div>
							<?php } else { ?>
									<?php if ( $post_counter == 2 ) { ?>
										<div class="col-md-6">
											<div class="left-section">
												<article class="magazine-b<?php echo '' . $type; ?> magazine-b<?php echo '' . $type; ?>-cont" data-id="<?php echo '' . $uniqid; ?>">
													<figure class="magazine-b<?php echo '' . $type; ?>-img">
														<a href="<?php the_permalink(); ?>">
															<img src="<?php echo '' . $thumbnail_url_1; ?>" alt="<?php the_title(); ?>" >
														</a>
													</figure>
													<div class="magazine-b<?php echo '' . $type; ?>-cont">
														<div class="magazine-b<?php echo '' . $type; ?>-category" style="background: <?php echo deep_category_color(); ?>;">
															<span class="magazine-b<?php echo '' . $type; ?>-cat magazine-cat" data-id="<?php echo '' . $uniqid; ?>"><?php the_category( ', ' ); ?></span>
														</div>
														<div class="magazine-b<?php echo '' . $type; ?>-date">
															<i class="pe-7s-clock"></i><?php echo get_the_date(); ?>
														</div>
														<h3 class="magazine-b<?php echo '' . $type; ?>-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
														<div class="magazine-author">
															<span><?php echo get_avatar( get_the_author_meta( 'user_email' ), 28 ); ?></span>
															<span><?php the_author_posts_link(); ?></span>
														</div>
														<?php $reviews == 'show' ? deep_admin_post_review() : ''; ?>
													</div>
												</article>
											</div>
										</div>
									</div>
									<?php } ?>
								<?php if ( $post_counter >= 3 ) { ?>
									<div class="col-md-6 below-section wn-pagination">
										<article class="magazine-b<?php echo '' . $type; ?> magazine-b<?php echo '' . $type; ?>-cont" data-id="<?php echo '' . $uniqid; ?>">
											<figure class="magazine-b<?php echo '' . $type; ?>-img">
												<a href="<?php the_permalink(); ?>">
													<img src="<?php echo '' . $thumbnail_url_2; ?>" alt="<?php the_title(); ?>" >
												</a>
											</figure>
											<div class="magazine-b<?php echo '' . $type; ?>-cont">
												<div class="magazine-b<?php echo '' . $type; ?>-date">
													<i class="pe-7s-clock"></i><?php echo get_the_date(); ?>
												</div>
												<?php $reviews == 'show' ? deep_admin_post_review() : ''; ?>
												<h3 class="magazine-b<?php echo '' . $type; ?>-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
											</div>
										</article>
									</div>
								<?php } ?>

								<?php
							} $first_post = false;
						}
						?>
				</div>
			</div>
		</div><!-- End magazin-wrap  -->
			<?php } ?>
		<?php

	}
	wp_reset_postdata();
	wp_die();
}
add_action( 'wp_ajax_deep_magazine_ele_ajax', 'deep_magazine_ele_ajax' );
add_action( 'wp_ajax_nopriv_deep_magazine_ele_ajax', 'deep_magazine_ele_ajax' );

/**
 * Instagram
 *
 * @since 4.2.6
 */
function deep_theme_instagram( $token ) {
	$get_data = 'https://graph.instagram.com/me/media?fields=id,caption,media_url,permalink,username,media_type,timestamp&access_token=' . $token;
	$img_date = wp_safe_remote_get( $get_data, [ 'timeout' => 60 ] );
	return $img_date;
}

/**
 * Is Blog
 *
 * @since 4.3.0
 */
function deep_is_blog() {
    return ( is_author() || is_category() || is_tag() || is_date() || is_home() || is_archive() || is_search() || is_singular( 'post' ) );
}


/**
 * Is Active Sidebar
 *
 * @since 4.4.0
 */
function deep_is_active_sidebar() {
	return ( is_active_sidebar( 'left-sidebar' ) || is_active_sidebar( 'right-sidebar' ) || is_active_sidebar( 'top-area-1' ) || is_active_sidebar( 'top-area-2' ) || is_active_sidebar( 'top-area-3' ) || is_active_sidebar( 'top-area-4' ) || is_active_sidebar( 'footer-section-1' ) || is_active_sidebar( 'footer-section-2' ) || is_active_sidebar( 'footer-section-3' ) || is_active_sidebar( 'footer-section-4' ) || is_active_sidebar( 'shop-widget-area' ) );
}

/**
 * Is Active Footer Widgets
 *
 * @since 4.4.0
 */
function deep_is_active_footer_widgets() {
	return (  is_active_sidebar( 'footer-section-1' ) || is_active_sidebar( 'footer-section-2' ) || is_active_sidebar( 'footer-section-3' ) || is_active_sidebar( 'footer-section-4' ) );
}
