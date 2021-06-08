<?php
/*
 * This is the child theme for Signify theme.
 */

/**
 * Enqueue default CSS styles
 */
function signify_photography_enqueue_styles() {
	// Include parent theme CSS.
    wp_enqueue_style( 'signify-style', get_template_directory_uri() . '/style.css', null, date( 'Ymd-Gis', filemtime( get_template_directory() . '/style.css' ) ) );

    // Include child theme CSS.
    wp_enqueue_style( 'signify-photography-style', get_stylesheet_directory_uri() . '/style.css', array( 'signify-style' ), date( 'Ymd-Gis', filemtime( get_stylesheet_directory() . '/style.css' ) ) );

	// Load rtl css.
	if ( is_rtl() ) {
		wp_enqueue_style( 'signify-rtl', get_template_directory_uri() . '/rtl.css', array( 'signify-style' ), filemtime( get_stylesheet_directory() . '/rtl.css' ) );
	}

	// Enqueue child block styles after parent block style.
	wp_enqueue_style( 'signify-photography-block-style', get_stylesheet_directory_uri() . '/assets/css/child-blocks.css', array( 'signify-block-style' ), date( 'Ymd-Gis', filemtime( get_stylesheet_directory() . '/assets/css/child-blocks.css' ) ) );
}
add_action( 'wp_enqueue_scripts', 'signify_photography_enqueue_styles' );

/**
 * Add child theme editor styles
 */
function signify_photography_editor_style() {
	add_editor_style( array(
			'assets/css/child-editor-style.css',
			signify_fonts_url(),
			get_theme_file_uri( 'assets/css/font-awesome/css/font-awesome.css' ),
		)
	);
}
add_action( 'after_setup_theme', 'signify_photography_editor_style', 11 );

/**
 * Enqueue editor styles for Gutenberg
 */
function signify_photography_block_editor_styles() {
	// Enqueue child block editor style after parent editor block css.
	wp_enqueue_style( 'signify-photography-block-editor-style', get_stylesheet_directory_uri() . '/assets/css/child-editor-blocks.css', array( 'signify-block-editor-style' ), date( 'Ymd-Gis', filemtime( get_stylesheet_directory() . '/assets/css/child-editor-blocks.css' ) ) );
}
add_action( 'enqueue_block_editor_assets', 'signify_photography_block_editor_styles', 11 );

/**
 * Loads the child theme textdomain and update notifier.
 */
function signify_photography_setup() {
    load_child_theme_textdomain( 'signify-photography', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'signify_photography_setup', 11 );

/**
 * Change default background color
 */
function signify_photography_background_default_color( $args ) {
    $args['default-color'] = '#111111';

    return $args;
}
add_filter( 'signify_custom_background_args', 'signify_photography_background_default_color' );

/**
 * Change default header text color
 */
function signify_photography_header_default_color( $args ) {
	$args['default-text-color'] = '#b7b7b7';
	$args['default-image']      =  get_theme_file_uri( 'assets/images/header-image.jpg' );

	return $args;
}
add_filter( 'signify_custom_header_args', 'signify_photography_header_default_color' );

/**
 * Remove color-scheme-default and add color-scheme-photography to body class
 *
 * @since 1.0.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function signify_photography_body_classes( $classes ) {
	// Added color scheme to body class.
	$classes['color-scheme'] = 'color-scheme-photography';

	$classes['header-layout'] = 'header-style-two';

	$classes['absolute-header'] = 'transparent-header-color-scheme';

	return $classes;
}
add_filter( 'body_class', 'signify_photography_body_classes', 100 );


/**
 * Load Customizer Options
 */
require trailingslashit( get_stylesheet_directory() ) . 'inc/customizer/customizer.php';


function signify_sections( $selector = 'header' ) {
	get_template_part( 'template-parts/header/header-media' );
	get_template_part( 'template-parts/slider/display-slider' );
	get_template_part( 'template-parts/service/display-service' );
	get_template_part( 'template-parts/hero-content/content-hero' );
	get_template_part( 'template-parts/portfolio/display-portfolio' );
	get_template_part( 'template-parts/promotion-headline/content-promotion' );
	get_template_part( 'template-parts/testimonial/display-testimonial' );
	get_template_part( 'template-parts/featured-content/display-featured' );
}


function signify_header_media_text() {

	if ( ! signify_has_header_media_text() ) {
		// Bail early if header media text is disabled on front page
		return false;
	}
	?>
	<div class="custom-header-content sections header-media-section content-align-center text-align-center">
		<div class="custom-header-content-wrapper">
			<?php
			$enable_homepage_logo  = get_theme_mod( 'signify_header_media_logo_option', 'homepage' );
			$site_header_text      = get_theme_mod( 'signify_header_media_text' );

			if ( is_front_page() ) :
			$header_media_subtitle = get_theme_mod( 'signify_header_media_subtitle' ); ?>

			<div class="header-media-tagline">
				<?php echo esc_html( $header_media_subtitle ); ?>
			</div>
			<?php
			endif;

			if ( is_singular() && ! is_page() ) {
				signify_header_title( '<div class="section-title-wrapper"><h1 class="section-title">', '</h1></div>' );
			} else {
				signify_header_title( '<div class="section-title-wrapper"><h2 class="section-title">', '</h2></div>' );
			}

			if( $site_header_text ) {
				signify_header_description( '<div class="site-header-text">', '</div>' );
			}

			if ( is_front_page() ) :
				$header_media_url      = get_theme_mod( 'signify_header_media_url' );
				$header_media_url_text = get_theme_mod( 'signify_header_media_url_text' );
			?>

				<?php if ( $header_media_url_text ) : ?>
						<a href="<?php echo esc_url( $header_media_url ); ?>" target="<?php echo esc_attr( get_theme_mod( 'signify_header_url_target' ) ) ? '_blank' : '_self'; ?>" class="more-link"><?php echo esc_html( $header_media_url_text ); ?><span class="screen-reader-text"><?php echo wp_kses_post( $header_media_url_text ); ?></span></a>
				<?php endif; ?>
			<?php endif; ?>
		</div><!-- .custom-header-content-wrapper -->
	</div><!-- .custom-header-content -->
	<?php
} // signify_header_media_text.


/**
 * Add Header Media options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function signify_photography_header_media_options( $wp_customize ) {

		signify_register_option( $wp_customize, array(
			'name'              => 'signify_header_media_subtitle',
			'sanitize_callback' => 'wp_kses_post',
			'active_callback' 	=> 'is_front_page',
			'label'             => esc_html__( 'Header Media Subtitle', 'signify-photography' ),
			'section'           => 'header_image',
			'type'              => 'text',
		)
	);
}
add_action( 'customize_register', 'signify_photography_header_media_options' );

/**
 * Register Google fonts Oswald and Oxygen for Signify Photography
 *
 * @since Signify Photography 1.0.0
 *
 * @return string Google fonts URL for the theme.
 */
function signify_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Open+Sans, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Oswald font: on or off', 'signify-photography' ) ) {
		$fonts[] = 'Oswald:400,700';
	}

	/* translators: If there are characters in your language that are not supported by Lato, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Oxygen font: on or off', 'signify-photography' ) ) {
		$fonts[] = 'Oxygen:300,400,600,700,900';
	}

	$query_args = array(
		'family' => urlencode( implode( '|', $fonts ) ),
		'subset' => urlencode( $subsets ),
	);

	if ( $fonts ) {
		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}


/**
 * Display header of a section
 */
function signify_section_header( $tagline, $title, $description ) {
	if ( $title || $tagline || $description ) : ?>
		<div class="section-heading-wrapper">
			<?php if ( $tagline ) : ?>
				<div class="section-subtitle">
					<?php echo wp_kses_post( $tagline); ?>
				</div><!-- .section-description-wrapper -->
			<?php endif; ?>

			<?php if ( $title ) : ?>
				<div class="section-title-wrapper">
					<h2 class="section-title"><?php echo wp_kses_post( $title ); ?></h2>
				</div>
			<?php endif; ?>

			<?php if ( $description ) : ?>
				<div class="section-description">
					<p><?php echo wp_kses_post( $description ); ?></p>
				</div><!-- .section-description-wrapper -->
			<?php endif; ?>
		</div>
	<?php endif;
}
