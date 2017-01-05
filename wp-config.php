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
define('DB_NAME', 'reachnh6_acrent');

/** MySQL database username */
define('DB_USER', 'reachnh6_acrent');

/** MySQL database password */
define('DB_PASSWORD', 'S-4op67nK[');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         'vdejtgpursmttlvghdyjltnbpni6vvtcrutkfoh2x8vx7dtnm0itrb6bsqvmymya');
define('SECURE_AUTH_KEY',  'maxxayoa7mfkk9gdevhi10hqc2pfkhajqfwyw8liux4ylrn1vyh41de0tq1bjbze');
define('LOGGED_IN_KEY',    '7g34ipcjzikz9ng3uoxppeuudlhnauia6bulfycxklcrkaxahw95oap3cvozo9me');
define('NONCE_KEY',        'gbaquodv2xtao7wr4fumuc0za9l5vji9b3kravewhhtzu0ftv1h0kuxhsswq2ufa');
define('AUTH_SALT',        'rdqzqxhrpbap3mxcbnvgm8s7pm9xxanxudpimzh3stgy7d0tmaswfdqw9n3ckwca');
define('SECURE_AUTH_SALT', 'j4hqglf9iwnizrrc5k0cwy0ub9rggezkz6bkr6fys3afkueghx1u6qcxownjqtru');
define('LOGGED_IN_SALT',   'lfdfw2dgsqdvni214qfzmdkm0mp0dxobrmqrjiivqiqmij0w7plcodwgnluzq0b0');
define('NONCE_SALT',       '1c7sja2059uo9pbrc9xy5bxg34brdjsonovmxvmhvxeiazsvhl3pl19kgjrssvcb');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wpdg_';

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
define( 'WP_MEMORY_LIMIT', '128M' );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

# Disables all core updates. Added by SiteGround Autoupdate:
define( 'WP_AUTO_UPDATE_CORE', false );
