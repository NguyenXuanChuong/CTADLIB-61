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
define('DB_NAME', 'comp_net_wp');

/** MySQL database username */
define('DB_USER', 'comp_net_wp');

/** MySQL database password */
define('DB_PASSWORD', 'comp-net');

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
define('AUTH_KEY',         '!/P<CWVs$tlJgLD|c?T+wbs_0%-s8G;g`~1bM$lm-EWEG|8YnL`Gu7J7.%oy<w|P');
define('SECURE_AUTH_KEY',  '/ckhqb.Y1`p+/7LfAWf}`4@:=|3,b?jme?B+,y)KHc3!Y2msnE/cF$mlfq]vp6h;');
define('LOGGED_IN_KEY',    'd:VaF;<i[~KZcXjeI~~@s[K1gP,#q:`[t3-adF4dj6j?i9xj))+&q}KA jt)u+tF');
define('NONCE_KEY',        '`/J|bWdu,1>&9+/PYC:)SJ[0|.jVHG-LL-$B|aVwyQ+PZ}VZv#53(s|TWY^9Ib{^');
define('AUTH_SALT',        '-@R6=HIja_kK*k2z_lZAF4U?n0*D_fcfyK+M]x0J|c| bQSDX :td:r>@UXBOFsH');
define('SECURE_AUTH_SALT', '91EjV.IG~2o=WT0Ouor.ug,EkHPL>XJ}$3_&#1N-IbD^fhd/BE.VN.j/#Dl>wAg ');
define('LOGGED_IN_SALT',   'N+bA3PkNzp}MYHOD++J-6+#ppM)sODRQcAx;h-INK&1r-N9++-mv+8ol$N14,zir');
define('NONCE_SALT',       '8[eDkU)FW-cr)`Z~7U*4,n@>IU3 Rw-uPmn$*MH(XOZJ{r mr7~B5Qg QPrBB0ns');


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