<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'awaitwinuser_startex' );

/** Database username */
define( 'DB_USER', 'awaitwinuser_startex' );

/** Database password */
define( 'DB_PASSWORD', 'Z08)re0-:t}qUull' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'D|sU3GQj96cE$8VDVwQ31_LE_=t4#[9w;P|kjDT?W4C2vKJOuFtq)x?lW,;T^-fs' );
define( 'SECURE_AUTH_KEY',  'FVOEUEt{4/KHTT~.B)`nc%,pCi.n=79 O9W5lX%JjMHq9^x>gQD%:>(9!Jpg5+}?' );
define( 'LOGGED_IN_KEY',    '.)t4`*9hEnT{} Sm*(w%}u?hbt-DrLbPBNYP=UFI8,(o1,M.LXp#}o}|!@ C9Q4r' );
define( 'NONCE_KEY',        '&yed&8w0:cvf49pKCwwGYp?$8NZbAnDYru$XgCP5P%mc)kisEavpf{sE>}B~/$a@' );
define( 'AUTH_SALT',        '$./v|wkAu+lJFGL69^F_H&-VIk Q4@]sG2c E:cH^w}#g7G_MFxi@hPYGoOvWcZu' );
define( 'SECURE_AUTH_SALT', 'L(APmy3OeN_ZDx*X4^j-Q/nr`=0XW7Sd3DplHz!*J`%j83w$]R#uxB_k&=en(i`(' );
define( 'LOGGED_IN_SALT',   ']Wrs)qkU1ND)#o^|V)^jxywgYrC7T^v=ZLN~:&cy_W%)618o!/lK{C0/*_EZ)7ZJ' );
define( 'NONCE_SALT',       '`jJs7|VVo$bSoD4?c73wg|*SbgC6Ue%Co-ojR:PuSM#0Sv8yN|{/VbW?EaIt8ycg' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
