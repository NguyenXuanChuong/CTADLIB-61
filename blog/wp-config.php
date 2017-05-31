<?php
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
define('DB_NAME', 'A884688_Wordpress16');

/** MySQL database username */
define('DB_USER', 'A884688_cmpeay');

/** MySQL database password */
define('DB_PASSWORD', '20083205Cd');

/** MySQL hostname */
define('DB_HOST', '76.162.254.165');

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
define('AUTH_KEY',         '!}%*&( h`DE`Q{6t_zB2)lfA$wN#jJ>HZeI{m%GkA.B|mw6S<tz0RtUtv5r{}/?h');
define('SECURE_AUTH_KEY',  'YP0M4,:_qD;|{#o]-hAf,.?Ck,7R|tw>${O2k.TgQ}P;#&o9!*7djz!Y2!B}|`4!');
define('LOGGED_IN_KEY',    'oZ#Qerh+-3kz^~!-Q,aFjcG7KIqXCpY8n*1B!5Qk+-b@r lO=-Kr]}=O04.d9Fh[');
define('NONCE_KEY',        'E~MlC<O?FWUjexCgHU7g8J~M,M^v%r~h1!hmt./U)7&a*s#M|Ep3{iB4n*[Fl@sU');
define('AUTH_SALT',        'O%n1$dS7]w7l{9U2JmDaM.pdqj*w0S)e-LC)rTvW{Z-`~>BA(W~3if75EjK=LT u');
define('SECURE_AUTH_SALT', '082_d*Op,+Uvs11Y/=4^Mh4o|.|Zn)sdEuY,l^L2u;vT+t#l2f$EY>Zo~;:U4^9k');
define('LOGGED_IN_SALT',   'ROzAk=rwY1.?K57+)h;#iD8ph_^=8$5AVfEoJ8_n<(:H%SIRN~vYhK,;_&U36/^?');
define('NONCE_SALT',       'pjxRh%%p3FX0_o1&ZV`2[aP/}_w7lEK>5j7ZXKV}R$F;?_p7f@=%/yT^8TCB:y_]');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_comprehensivenet_com';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress.  A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de.mo to wp-content/languages and set WPLANG to 'de' to enable German
 * language support.
 */
define ('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
