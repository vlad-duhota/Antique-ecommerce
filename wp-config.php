
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


define( 'DB_NAME',     'test5' );
define( 'DB_USER',     'user' );
define( 'DB_PASSWORD', ';:RLZSm/LnkEm8E' );
define( 'DB_HOST',     'localhost' );
define( 'DB_CHARSET',  'utf8mb4' );
define( 'DB_COLLATE',  '' );

define( 'WP_DEBUG',          true );
define( 'WP_DEBUG_DISPLAY',  false );
define( 'WP_DEBUG_LOG',      true );

define( 'WP_HOME',           'http://'.$_SERVER['HTTP_HOST'] );
define( 'WP_SITEURL',        'http://'.$_SERVER['HTTP_HOST'] );
define('FS_METHOD',          'direct');

define('AUTH_KEY',	       'Fxf[m9/iov0l)ew>UaouE4ONb@G;& gN=9tSOYn,@2R4d7b$H>Vihm`.fxLUq0H7');
define('SECURE_AUTH_KEY',  'Ix>lD8Wg&Fa3n(@Tnf=Cex^Cdti~hm-!Bk}FFr}EIiC-gCiG|;VALyx-xU<`~`^(');
define('LOGGED_IN_KEY',	   '~&nr5 EEqh}K]L:RTO6XP{dh7e^SvjL,@s0C>`ScmX@YOuOD0Xfrl@acS_i§,HIW');
define('NONCE_KEY',	       ';K}W=1G,§YJ%@O@|Q3Q&@&/;v3pJH7<(@hf-[TL@08bIbdC_8+PI,|7.jT`KIP3W');
define('AUTH_SALT',	       'p|4Z~zC!u&Mz}=[3I.x!WOa5=;Sv`~tsAL(]<uuD$:8w`.7O8D{jH`D6sH,Ll8jY');
define('SECURE_AUTH_SALT', 'f!f$@+c~(_[:Ki30B Yj--IS v C+aJTE;x7MK{7fVOCS+§]DOB,m|UrKB]v3t8g');
define('LOGGED_IN_SALT',   'v_aq}Tm>tp$Z3g5DZYja7G)l=US<T3cSV,Z9fcunyGl>dL)e_k U^E^nj$v-25&>');
define('NONCE_SALT',	   'Up?M;4}NM%IJ>%<[~p9?Eg[^?@C!L!9]Smy+26Ai,a@)C.FNjGvTfHt9b2{3>c1{');

$table_prefix = 'wp_';

if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
