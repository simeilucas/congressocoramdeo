<?php
define( 'WP_CACHE', true );
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'u367511854_8YsSh' );

/** Database username */
define( 'DB_USER', 'u367511854_KUj9V' );

/** Database password */
define( 'DB_PASSWORD', 'YqIHW6UlqX' );

/** Database hostname */
define( 'DB_HOST', 'mysql' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'cWMGWB_MN!@ShWTEeDhh5aZKP#RdJq,QfTK9UyP_8ssiI:bG1ScYND/P@Rjh~ <y' );
define( 'SECURE_AUTH_KEY',   'AjJ?[nTta5+DR]u9CL-MA4FdX3QXP:YcCL5z.KnYv]cJi DaXm<rndFn[f^`.]E#' );
define( 'LOGGED_IN_KEY',     'H+SN[0F5 >iN4@!qUrthkO]7qU~vlYbpPnnR?xD[V^,iHxD~R3$RB)sOZ!]9@1W6' );
define( 'NONCE_KEY',         ' BlLqOt!`o&qTtr2D4;^Xo>Yj9bU1%<io8~-7.a1-Gtqh4zq2H#Uf?L1ff;-;&{x' );
define( 'AUTH_SALT',         'b:Z}3hyGDfsaSK-1y`v/m~4GO6J>=BV3]gitXD,<Ua+SHr7||Vo=M`G4;&]<B$7F' );
define( 'SECURE_AUTH_SALT',  'LTrd5OyL]8*LKea_}HJDQPSv*@vl*kxF=Co.Q|7~yhoXW#*%m.Z81k/3dMf3Wc[,' );
define( 'LOGGED_IN_SALT',    '!g!9+DSbF300uuIF&~lVvrCmXf,e@2HzQ^^`Uk+#>~Mxy|SK`Z=s$r[cx6f[R@#{' );
define( 'NONCE_SALT',        'UND#(f,PX=8CK>Z9Bi@z<by=GEPfJx;_>HOA&54V9wGPvYwSkQ@tY9ppzZyZz+cs' );
define( 'WP_CACHE_KEY_SALT', 'n1`V}zd<Itn4;-m9ocz%dfrN.6o8g<WzyMo-!w8lv.2UQisp,yfb_bt-7=3x 3CG' );


/**#@-*/

/**
 * WordPress database table prefix.
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


/* Add any custom values between this line and the "stop editing" line. */



define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
