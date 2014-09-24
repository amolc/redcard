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
define('DB_NAME', 'redcard');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '10gXWOqeaf');

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
define('AUTH_KEY',         'wsq*}s+Mm*yP~/VR7cZq4Lr!31)ph:o{P:+~;%)> R~w2(kaVC+K|XqQw`i[msuh');
define('SECURE_AUTH_KEY',  'PTn`Pu#kL/ 8|HiQvgG7c@?L(b6mtuHx$ZB7g==>Q|$uy/An1WapxsT7v3A_+#.V');
define('LOGGED_IN_KEY',    'p3Ahw*^|O7  :5InsMSPvsL`Q>re[$00ynkzSFdb/rE|%BT;wMYgz`K[:bUm4W{/');
define('NONCE_KEY',        '0QovT!;c,uiXG}VuNe+U93|*Y7X-}Vt6p1|S8HG G9Hm4F5|=4fg8<Po+|rl72[L');
define('AUTH_SALT',        '@FxxK-d))Q/w|%.^sw4|E^YQu59MD5I|S!1,WMKTMy_#oyp]9Lb-sCf>[jTb{=w/');
define('SECURE_AUTH_SALT', 'C:;g-L@GS!B4m*)5vX6?LC-T!]Rlim^{igSRf aF-&gxq2^7vPSk3jg#__VtNei|');
define('LOGGED_IN_SALT',   'hF7Z-JtqaHfsjJ}SvD+i/lP8:7LJN=w_|UObq#m@KdO=jRC:A)&xI z~Ewq]r:{<');
define('NONCE_SALT',       'p5&!Iq@?T+LU=c/w3@BvhCiqGITX0DR1g_4B!Pp-#-b$XB}|A<%$A7k.1P2T9h|[');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'rd_';

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
