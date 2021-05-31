<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'TestWP_db' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '^6sW`)<>MaOVh[@m{7nFQ##j[#*I=zK-ZF`LQ0fX ,m H28jIP7D^jl!$BOG><e*' );
define( 'SECURE_AUTH_KEY',  'dCWs@<Q?7)38N7z3rCoz@XK&M>5#R.!+R>m>$KDlNgKpaYitoUi&9YbqigWs*24w' );
define( 'LOGGED_IN_KEY',    'd![O9,=0X`<3R@m_e2i!5]D2w{.n7^P0@4SF`jM*IV6{l%- ?y)<+ [q;!P/>5kQ' );
define( 'NONCE_KEY',        '@$@Ef7V?.&jXQOrK%7o~]Bqp/)B5AbCyOGBG50 Uw;OWl$kT@ZfL ;QYQ+p4h-l[' );
define( 'AUTH_SALT',        'qr;<gy21?xng/,H-Q=+Q/2~Qcj$)Me0lH5yzpi%uW G`Y7jobd%<M4bCo<fad1)>' );
define( 'SECURE_AUTH_SALT', 'QJ21lSSrUr&mx|p**YQ# @Te6:iiU]99oD.1`rUZlv$}peJGe[|-Q>yYG$1y!6I7' );
define( 'LOGGED_IN_SALT',   '!d8&SxR~?%]ro0p`M[%0N{,/^Nkc9n2}R+mS[p/CH6~z,R 3;5I;W!J#OS>6uQWH' );
define( 'NONCE_SALT',       'vs0;FDajJ_Zf3$khbx9]v!=?yXTtB#ToB+O}9-k)4vo^|S/R&;F?#5INX|MSUUJF' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
