<?php
// ===================================================
// Load database info and local development parameters
// ===================================================
if ( file_exists( dirname( __FILE__ ) . '/local-config.php' ) ) {
	define( 'WP_LOCAL_DEV', true );
	include( dirname( __FILE__ ) . '/local-config.php' );
} else {
	define( 'WP_LOCAL_DEV', false );
	define( 'DB_NAME',		'devdal1_creatives' );
	define( 'DB_USER',		'devdal1_crea8iv' );
	define( 'DB_PASSWORD',	'_J,{glf1_)OF' );
	define( 'DB_HOST',		'localhost' );
}

// ========================
// Custom Content Directory
// ========================
define( 'WP_CONTENT_DIR', dirname( __FILE__ ) . '/content' );
define( 'WP_CONTENT_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/content' );

// ================================================
// You almost certainly do not want to change these
// ================================================
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );

// ==============================================================
// Salts, for security
// Grab these from: https://api.wordpress.org/secret-key/1.1/salt
// ==============================================================
define('AUTH_KEY',         'R!u 7&N-Wo/Vw3{E2)*N14I%St)+LjN:[!;dTT=Wmy;,$?7_Giwbn7aEwk4$,%Kc');
define('SECURE_AUTH_KEY',  'W7?1J:E148+v/R[M3^L+|0|rD2jd!q6O|5#3)D!3KbrIw*UQFM;%<Jf9[Esd- z ');
define('LOGGED_IN_KEY',    'I*XR-7|]#q*Z<ka`Try/@}Nmf?-ehF.Y5rJYO(re#,EM1KA~Wp[~ruyo ^rD~T2^');
define('NONCE_KEY',        'H+1sW/}9tnm%4IDD`tWHKpLbb!<WGtC9>Q?.X%U[;|-+vans>[-V/t+y `ikI&~ ');
define('AUTH_SALT',        'PS;F)Fw#V[+OfI|-~}|G9=2w0#_nPYQoBi:cO8DmPzK0.a+S0NW5eS8i&@SPy@vL');
define('SECURE_AUTH_SALT', '9{WXeUp-co43UdGf1+TSjH;+W]OqF?~?-U*Lb&B-hIsg+mDpz|G;een2Jes-@x$i');
define('LOGGED_IN_SALT',   'Lyqx^Iw&$RS4[Y-d q&F~zeXM1oz@u8FE~-}f+;H/G{|s*-TSGPS~+b _di8GZ6B');
define('NONCE_SALT',       ',OUCM_6mUReC&n~`_>)hjK.6Rc<%!I~bYQ&r,b>T&[>-@t!0Ne}!=]ap1-X||}8U');

// ==============================================================
// Table prefix
// Change this if you have multiple installs in the same database
// ==============================================================
$table_prefix  = 'wp_';

// ================================
// Language
// Leave blank for American English
// ================================
define( 'WPLANG', '' );

// ===========
// Hide errors
// ===========
ini_set( 'display_errors', 0 );
define( 'WP_DEBUG_DISPLAY', false );

// =================================================================
// Debug mode
// Debugging? Enable these. Can also enable them in local-config.php
// =================================================================
// define( 'SAVEQUERIES', true );
// define( 'WP_DEBUG', true );

// ======================================
// Load a Memcached config if we have one
// ======================================
if ( file_exists( dirname( __FILE__ ) . '/memcached.php' ) )
	$memcached_servers = include( dirname( __FILE__ ) . '/memcached.php' );

// ===========================================================================================
// This can be used to programatically set the stage when deploying (e.g. production, staging)
// ===========================================================================================
define( 'WP_STAGE', '%%WP_STAGE%%' );
define( 'STAGING_DOMAIN', '%%WP_STAGING_DOMAIN%%' ); // Does magic in WP Stack to handle staging domain rewriting

// ===================
// Bootstrap WordPress
// ===================
if ( !defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/wp/' );
require_once( ABSPATH . 'wp-settings.php' );

// Disable admin bar on front-end
add_action( 'show_admin_bar', '__return_false' );