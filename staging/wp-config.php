<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

define('WP_HOME','http://staging.any.tv');
define('WP_SITEURL','http://staging.any.tv');

/** Enable W3 Total Cache */
 //Added by WP-Cache Manager

/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
 //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/home/anytv/public_html/any.tv/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'anytv_staging');

/** MySQL database username */
define('DB_USER', 'anytv_staging');

/** MySQL database password */
define('DB_PASSWORD', 'Nothing69');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'gb9wprenzae4vbcnrudpp9p0aiolxo5oahqwzpclbxebxfsnu0vkrmorfzzyzuo5');
define('SECURE_AUTH_KEY',  'mpsi1gygq7h7o6upo39fa9zwadjonthwkk6sovnebh2qersln5ivu6fjfsig6dxb');
define('LOGGED_IN_KEY',    'hifyhjemy5q3d1rvis6z6w6mptriyrkqs4gyf2fygh7pcbke0xvqr1rqmxbjv2lt');
define('NONCE_KEY',        '3hsfis7we7j1hdy4beklgzqnvabmeowmnzuacyd5soiqlqa9vkdftkorar4a87ir');
define('AUTH_SALT',        'v7gzyfh3uyoa0tshwjvpulr6qhmnuh1xnvnrxzap62smwternyxjihwydqz5omje');
define('SECURE_AUTH_SALT', 'svk0wzmvp9zysav4x6x1m0nbblnnngjqtvlrfrvf8hhyjyk4okxo422ipttiq1vk');
define('LOGGED_IN_SALT',   'yjvetoawxdzohm8xh8zn6xo01bdlvkryvoimfba7ioeovoff9khvw6gepnabm8iq');
define('NONCE_SALT',       'yxchgzv00otzonfoq2j8hk8h5hu3eeuy3tbnyp4rb5lbzzxsgysclissd3va14mv');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);
define( 'SUNRISE', 'on' );

/* Multisite */
define('WP_ALLOW_MULTISITE', false);
define('MULTISITE', false);
define('SUBDOMAIN_INSTALL', true);
define('DOMAIN_CURRENT_SITE', 'staging.any.tv');
define('PATH_CURRENT_SITE', '/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
