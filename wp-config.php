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
define('DB_NAME', 'wp_theinfo');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '123456');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('FS_METHOD', 'direct');


/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '}.boO*]f7S+dxM$N#V.!OsG}^KoyrX^3u/O^K2!eyj%ei9G%7=:v}H!jDLgIpF0D');
define('SECURE_AUTH_KEY',  '?:*,pV9Jw8],P*v7S_9_^Zo8GUIxs{eOmN^RgKYrF,UDKLW7Zg,FzJGGN{[XBUX[');
define('LOGGED_IN_KEY',    '9TCSA%>HE2VqxN@oT6lEE^}e%vw5mHw&*k5lLp^e4{HGaU5eQbXm0H#$t]NoHGgo');
define('NONCE_KEY',        'uSmvaom3o )g/:~vNS4P<__aoV|M<qRVg-.LTXr0^JMqwdxqQAnBz]kLzA[S4/W^');
define('AUTH_SALT',        '(xmq}P~eM2gjC{eX6AhgX.~nfHJJ/~*P_B95&/~SiWUY%x3;4*klWJ<$yo<kc4:W');
define('SECURE_AUTH_SALT', 'W]*b0>[`I!&o-O?p!5kutY8T-nzz@RIJPOSXO,p^p&7X:-5bdY,(09#GvQ_&TeH#');
define('LOGGED_IN_SALT',   'Q[)tt.tv$.]qBpu]^)/WWxwmf0T{9>{Q6Q6=_B&7{G@dc1?B;>( OcD(L04 P<9Z');
define('NONCE_SALT',       '|PL>6H)hGQ7]FDm@_:`Fvg%J*F}em1]JIcw>-A4b>3Dc6`d;alJzyHF8%BgBV/KX');

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
define('WP_DEBUG', TRUE);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
