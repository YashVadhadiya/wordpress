<?php
/**
 * @author  Webnus
 *
 * @package Deep Theme
 */

if ( ! defined( 'DEEPTHEME' ) ) {
	define( 'DEEPTHEME', '1.0.6' );
}

if ( ! defined( 'DEEP_HANDLE' ) ) {
	define( 'DEEP_HANDLE', 'true' );
}

if ( ! defined( 'DEEP_THEME_DIR' ) ) {
	define( 'DEEP_THEME_DIR', trailingslashit( get_template_directory() ) );
}

if ( ! defined( 'DEEP_THEME_URI' ) ) {
	define( 'DEEP_THEME_URI', trailingslashit( esc_url( get_template_directory_uri() ) ) );
}

/**
 * Deep Theme.
 */
require DEEP_THEME_DIR . '/src/class-deep-theme.php';
