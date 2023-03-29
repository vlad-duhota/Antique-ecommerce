
<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'hx459480_ronati' );

/** Database username */
define( 'DB_USER', 'hx459480_ronati' );

/** Database password */
define( 'DB_PASSWORD', '-Sf4c5s2;P' );

/** Database hostname */
define( 'DB_HOST', 'hx459480.mysql.tools' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );
define( 'WP_HOME',           'http://'.$_SERVER['HTTP_HOST'] );
define( 'WP_SITEURL',        'http://'.$_SERVER['HTTP_HOST'] );

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
define('AUTH_KEY',		 'Fxf[m9/iov0l)ew>UaouE4ONb@G;& gN=9tSOYn,@2R4d7b$H>Vihm`.fxLUq0H7');
define('SECURE_AUTH_KEY',  'Ix>lD8Wg&Fa3n(@Tnf=Cex^Cdti~hm-!Bk}FFr}EIiC-gCiG|;VALyx-xU<`~`^(');
define('LOGGED_IN_KEY',	'~&nr5 EEqh}K]L:RTO6XP{dh7e^SvjL,@s0C>`ScmX@YOuOD0Xfrl@acS_i§,HIW');
define('NONCE_KEY',		';K}W=1G,§YJ%@O@|Q3Q&@&/;v3pJH7<(@hf-[TL@08bIbdC_8+PI,|7.jT`KIP3W');
define('AUTH_SALT',		'p|4Z~zC!u&Mz}=[3I.x!WOa5=;Sv`~tsAL(]<uuD$:8w`.7O8D{jH`D6sH,Ll8jY');
define('SECURE_AUTH_SALT', 'f!f$@+c~(_[:Ki30B Yj--IS v C+aJTE;x7MK{7fVOCS+§]DOB,m|UrKB]v3t8g');
define('LOGGED_IN_SALT',   'v_aq}Tm>tp$Z3g5DZYja7G)l=US<T3cSV,Z9fcunyGl>dL)e_k U^E^nj$v-25&>');
define('NONCE_SALT',	   'Up?M;4}NM%IJ>%<[~p9?Eg[^?@C!L!9]Smy+26Ai,a@)C.FNjGvTfHt9b2{3>c1{');

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
