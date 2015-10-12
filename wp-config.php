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
define('DB_NAME', 'wp4');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'esfera');

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
define('AUTH_KEY',         'iaFn@$M9)4b_/H|]R0ON-S @E<yK 9oXBOWfw h0RL$m=K w$J)mL4@;9+@5Kw8a');
define('SECURE_AUTH_KEY',  'y>>+a5/_1Q#s}W*>y2KF2NCAPHOc.e.PBxl>%Vy-eWGSE[Ld<@tM3E!7A+n4GLDh');
define('LOGGED_IN_KEY',    '0aNBs8o  Ns4wV[^Z-;;UnB+DiDMx<>?S=LqN9P%w+(}R^NR4>U,Z<g^+n,rf#[k');
define('NONCE_KEY',        'l@/_J#lBU6>S{|k8eh!_e-CN]+yG$z@/405bYcIlS)pXDqAaaB:Qc&j|*ehz(f6G');
define('AUTH_SALT',        'NLKqqR;c:ma!?$m5$l.R;w+].;!|>PS=<s9JRw<Ud#+s~,H6Fu>K%CS33vQ.T~I]');
define('SECURE_AUTH_SALT', 'p?2kW&gv#@t:vyi^}O38oe[NUvZ Q~M|2MUhctX|+wxUi$hCtd}#Y@Y@[o-`[xN|');
define('LOGGED_IN_SALT',   '!,(SgaM+O!s oE)4X W~|kNj%tCpks;@+p%PoqBj?Huj#o`8_0S4+`VIW)fF1TL(');
define('NONCE_SALT',       '.O!f|O|n@!VE8q=v|wNV(r{ PR&qew#Jb-):3X9J@E>/!U]L|.8duLK]R&/q^|5u');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */

define('WP_DEBUG', false);

define('FS_METHOD', 'direct');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
