<?php
define( 'WP_DEBUG', true );

define('WP_DEBUG_LOG', true);

define('WP_DEBUG_DISPLAY', true);
define('WP_CACHE', true); // WP-Optimize Cache
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
define( 'DB_NAME', 'shopfuzz_wp1' );
/** MySQL database username */
define( 'DB_USER', 'shopfuzz_wp1' );
/** MySQL database password */
define( 'DB_PASSWORD', '7b7p1.i@Sy' );
/** MySQL hostname */
define( 'DB_HOST', 'localhost' );
/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );
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
define( 'AUTH_KEY',         'twgtk0rfvosa2tgnn76dmhqinfo0t0dzuy0vb2u6cjddlnoodyp2tietgnelytna' );
define( 'SECURE_AUTH_KEY',  '65vvkhbyu7tfwjm1eizndp7ghe8uvtxqj3p1cbix4ffshpmzgisqffmayi3ws62b' );
define( 'LOGGED_IN_KEY',    'gfiq0ko5lovdf0b8hzibgbsootdyvduazrulaf5yprdgbjv23zskozfxh1qneotb' );
define( 'NONCE_KEY',        'jb0mybzzsbgdz3r9t54yxeldldcircrpowce8vecojkbdqngqoktuqwonarxjjyr' );
define( 'AUTH_SALT',        'dxg21mzyj5uphontm8re9ybktxtshrcmfrz6v5apn74sfhmkgjbrf4mztw5q45zq' );
define( 'SECURE_AUTH_SALT', 'lwdnv1hxxutwzpvxq18bdewomtyzjitvbannwvhlgmagm8ajtvyubl5g1vf7zfsk' );
define( 'LOGGED_IN_SALT',   '8npcsdx2ymxgkfw8qdxditywwcin2iimeckeubela8mybiciexny19r4awztieli' );
define( 'NONCE_SALT',       '3qynsdqjste7g0dtcyrslfktij4cjnftmv8ukzh9top8h4rulocytkcksaa6zfft' );
/**#@-*/
/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpno_';
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