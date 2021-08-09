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
define( 'DB_NAME', 'db_drone' );

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
define( 'AUTH_KEY',         'te#t2%O2@C[Tj]WrzL0j4|]g)FikYH@AnH%km5{@+%RRLYl[DuDin0L_[VSsGI1W' );
define( 'SECURE_AUTH_KEY',  '.>3JOc++]uFki+k6,.uqi:u)[~iQxPdHH/OK!2}LX4;)z0YJ9B1#mNQq+A&c1}{-' );
define( 'LOGGED_IN_KEY',    'V15D8~AGG)?%GBBkx2h(E):N=Pq9?MFLkoCfR0oC`7(Oc_[G%,;}qIgA4TWnaQ|<' );
define( 'NONCE_KEY',        'Td.<D.}dzr+9!e%AcST+^J9aR,U;m$FfO/StX(B@*P@B31tGkV/Ru>`X7xPq1eI%' );
define( 'AUTH_SALT',        'ikaRt (EtA!D>r{Z#Fy,>4qAP}-lWD|JE[p-M/xGZ*$H`Qw},8tNQ@b+;!&PBot1' );
define( 'SECURE_AUTH_SALT', 'I&D]+:QiVLu]mt@Quk/M^Meifsgy0vi~vfzp qr7UFhQ+VY/$IOIiU^.]CzXfaW1' );
define( 'LOGGED_IN_SALT',   '5EX!V&E{({D|a[]ZD[J/X7w7acYb[Z~WGC2Zq!Y>k$:D-Lz4VICQAIX2w&PVc,/%' );
define( 'NONCE_SALT',       'Ws/u[:6+{#w Sn*v3~TR~C{|m$t`H,iW#v1V>O s)ecwyHIo~]KB%F2CP=5%!;gm' );

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
