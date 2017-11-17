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
define('DB_NAME', 'valho_blog');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'Rtl8039v');

/** MySQL hostname */
define('DB_HOST', '192.168.1.245');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         ')1^5(/2H}[m^vf)T0!/#=X,X$[4T6#q[KaWr3Xq,zqK[6J/[6Gz&CGs13=n^.urH');
define('SECURE_AUTH_KEY',  'u$_wU<5p~0JFN^O5c$F1?m3ymCFN?r6db5Yap %K8ULd]Tu7~s>Fu*D-R~HE#g6.');
define('LOGGED_IN_KEY',    ']:.:cAT(Pag|k_FGaej1&>k#$dz%ky!o%H?G9ps)an@e@ZpJ+L/vuLI?gLQb,2-P');
define('NONCE_KEY',        'Wk@05bxfB<;[;t(U&<rLMg-yB<?<d@DPSv;f<%a{LXr3B8}TAI3|J?::/aY8Y$yo');
define('AUTH_SALT',        'KKg!t/y,/+ecgGVt4Ct}tk^Y~RQj4?U_c~$Ae|7J4gY<MQ;lKU9;08@M%uFy}=i(');
define('SECURE_AUTH_SALT', '=.@itb7d>rvPOa1hAXYiZUQfA3RV@wOE`[7f0nN?OsUSGJ{V0RII@;ywE5SS:ONo');
define('LOGGED_IN_SALT',   '9k+c#55|>{.c,RiXH;/F~F_@Y`>(P]PzrWY?H#} ot4_}YEwA]Xs].c[Gh!a3V`!');
define('NONCE_SALT',       'gFz#m?V;@WkN:+?^&s] ||9.f#}yF9mXO0bkU!EU`]$uJS!Lkhvd)mm~)1[)o3PT');

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
