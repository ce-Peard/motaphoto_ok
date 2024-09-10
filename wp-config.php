<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'motaphoto' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         '4//,N].*Ion)i;Pp])[h2%r4VErLM~xZ9hQ?laD4$9mS*@$>BjuKCFQvm2_E&Xm5' );
define( 'SECURE_AUTH_KEY',  'zxe5ws@8`HP85[@>[qx3Z3`Cy^Pp6Tt]Cap&0-M{47Os6<xEV/}J{Cj !?F/[`<|' );
define( 'LOGGED_IN_KEY',    '|k~~M,6@sf/bfT7MuU(&$RiV1uvyre!ilF}e%Nx16&SN<r2qTLr<D!:hNH#/GIKS' );
define( 'NONCE_KEY',        'FS8}K&e=8:@_]K5X;DdnSy1tDSgZQ9x5S7w}e{_4vzMQ}blaI<KX6,]Wi!*mSMzr' );
define( 'AUTH_SALT',        'l5~ZIE9r%^[g.=DGV?-F%RF37[l+0y(6tOq)HIji6#lx@::~.Ffa #-UmF(k)9/V' );
define( 'SECURE_AUTH_SALT', 'oLLkZ!P17PPUwTu3z1E@F90%c03-_/V5wv_w6 {5TS7L _aX[znQd:^K3*k.n.zk' );
define( 'LOGGED_IN_SALT',   'l{yy`.Ge3Oq53q^M>_+vNMqQpPj,J3OQ6,Wo*lO^>#SkV])o}1kjr V:|*|vY!t;' );
define( 'NONCE_SALT',       'aeoLqXlzllR_RiUtDh%w}GSP5)#^:@%8_g0vy=M];m.k_s,{W6eIAhyKRkK4=-m ' );

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );
@ini_set( 'display_errors', 0 );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
