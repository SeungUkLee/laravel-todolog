<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2016-11-14
 * Time: ¿ÀÈÄ 12:25
 */

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
define('DB_NAME', 'laravel_wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '9k5rmfh');

/** MySQL hostname */
define('DB_HOST', '52.79.198.44');

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
define('AUTH_KEY',         '-PnP6cqSB22E3jAB{{+;h/[{aWn4TWGb8$F$;_~W>z,a-T<1rgy|^H33Es]u C8o');
define('SECURE_AUTH_KEY',  'jWyX=aOv2q=;&%!L]St8rwo+*%lalf Y1;jTWy#CK}BPiW3rZcfZr/vIu4fzs=-0');
define('LOGGED_IN_KEY',    'Q!1+kqm0,l^BH.DvXi:?tjUsGuux5|p6E2<SopBj~0pWW6a)bh;:xc11Ym?(A9nW');
define('NONCE_KEY',        'm5GAQF!NQ} k?b=EO.hkTn)*H7lm]qZT`bA}[(c8,Zte5c?-U+vQpO>hle HWHBY');
define('AUTH_SALT',        'W[TK+:$17-Oj:XEl=N<aE7I%(!qYo.&^u^~jHm HIKd`8TuzGhbUfxtn{%<#7~j!');
define('SECURE_AUTH_SALT', '^i@`+}Mdq*]*Pt,@D/.hZ~(9U.}ep&CS{UvAy_cC2R78 @R^}QS[+j*BJW1Nk,lh');
define('LOGGED_IN_SALT',   'JqbM_e{&2?bKik)8^($.3?&-cm@#FAM?=XTC)oxX&IDY_fpR=9ty>o}[xZlL,/)K');
define('NONCE_SALT',       'fG9ncf!5j`r&GxMK8e,^IN&-rNMg7Ox7L(8j+D:9asE.iGp/0K%r`=`xNS78zlvJ');

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

// FTP
define('FS_METHOD', 'direct');
