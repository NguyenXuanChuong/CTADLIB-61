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
define('DB_NAME', 'comp_net_wp_news');

/** MySQL database username */
define('DB_USER', 'comp_net_wp_news');

/** MySQL database password */
define('DB_PASSWORD', 'adlib1111');

/** MySQL hostname */
define('DB_HOST', 'sql5c38a.carrierzone.com');

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
define('AUTH_KEY',         ':3RNd[!F;]|yB(1qo|$-RVJy|me}e^UM}-GTrl`cET(8EY)mU:>E*P.[$D&<)@T-');
define('SECURE_AUTH_KEY',  '5tX|GVov]j2l:fQ3yS VQ!Eu<a=$|RdmH(``g$N,XcdF+-t2-K>h.by[^..wX0]+');
define('LOGGED_IN_KEY',    'sun4c/Pq-AbM-f8OcgX7 Z4)k,,Bd= MQ2m<SJ,T=$inixV?K:[g?n4Qb?g!?0%m');
define('NONCE_KEY',        '_ko})|eZi@fa-G-g|>GS.C,Ar[}c<uF>2F3e,A|Z;Vpg?WU>/05;dDYpvL<(L0Kx');
define('AUTH_SALT',        'gTZ8mP-OXvTR)2(QrQ<>S6N4-6XOwTn/7@%r>7mN_+$7d,Y2!?*wyEC-d|-W78->');
define('SECURE_AUTH_SALT', '_?L:$r;OQ,,`kKcwvHQ~]oeGn]Y)mGOW$4S=@?D_f)mg9)0]+yf;J .UEb|I;x~2');
define('LOGGED_IN_SALT',   ']sj6cLt+y=Zv5-V;hYR/>f#jD6x,{8rm k#j`1K0M;b|yU?~<bV(D?qNL,R^Yj7L');
define('NONCE_SALT',       'C+5|6Kx,8[nYQuH;g6Or*dT7QL<2|YAy;0r.X%Yxh3~SQm|dq?+M{z1-c{IA+ofg');

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
