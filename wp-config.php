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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
if ($_SERVER['SERVER_NAME'] == "local.pearson-master.com") {
	/** The name of the database for WordPress */
	define('DB_NAME', 'pearson');

	/** MySQL database username */
	define('DB_USER', 'root');

	/** MySQL database password */
	define('DB_PASSWORD', 'root');
	define( 'WP_SITEURL',  'http://local.pearson-master.com' );
	define( 'WP_HOME', 'http:/local.pearson-master.com' );
}
else if($_SERVER['SERVER_NAME'] == "pearson.catus.tech"){
	/** The name of the database for WordPress */
	define('DB_NAME', 'pearson');

	/** MySQL database username */
	define('DB_USER', 'root');

	/** MySQL database password */
	define('DB_PASSWORD', 'catus');
	define( 'WP_SITEURL',  'http://pearson.catus.tech' );
	define( 'WP_HOME', 'http://pearson.catus.tech' );
}


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
define('AUTH_KEY',         '7l.Lf`&~%&+ |O3BIG|UDnZ2^s-,vSzl`7.k7rB]IM9|=kezN|px$tDe<*/)d(nk');
define('SECURE_AUTH_KEY',  'O?NkSj*~(^C$s.i=-o/gM5Z7A(?EbTe-$?HYr;)EfB.jo6p l~QST%jSbW}y&g|{');
define('LOGGED_IN_KEY',    ',EVQSL+-`]j2L:I,rN|!s/JxG}|M*N1M$0c*deL|Xf!+Ick?l$FJT/-1Q({{H:&-');
define('NONCE_KEY',        '4H!-Qmr[B|f@3I` ;+]+&K9Y}!oi11[U?N+1m3;MJie^Y2x=O|P_8ZmmGv-Lgafu');
define('AUTH_SALT',        'Q<`Ec^kVCEm*=TE,3orCTz%}89Jf)NpH07?}(UHU@$s3R9TT9WFle{UgP_+PgOp9');
define('SECURE_AUTH_SALT', '7+-kg6%]N~;%UW4IL/b|2z87l5lL9gOvYK9@`EFcSAx R;fru@H?-rX]Z7n-RvR1');
define('LOGGED_IN_SALT',   'w9n6sYwj.wLFtx.pH@:Dk?y5+fo{]~|M/$6=j VWCXs|s-chkX/5x30c]4zDOVa.');
define('NONCE_SALT',       '.6yt(e)]-$rqd.8lT^iC,mXYib9:>CT~?1XQB9~6R)0s:=u|ijM$+n!O^~i#^F34');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);
define('WP_ENV', 'development');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
