<?php
/**
 * The configuration for WordPress
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
 * * CI-WP Settings
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package		CI-WP
 * @subpackage	WordPress
 * @category	Config
 * @author      W3plan Technologies
 */


// set php execution time limit if non setting in php.ini
set_time_limit( 120 );


/**
 * MySQL settings - You can get this info from your web host
 *
 * please use same setting in CodeIgniter package
 * remember WordPress does not support PDO currently 
 *
 */
 
/** The name of the database for WordPress */
define( 'DB_NAME', 'ciwp' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'rdli' );

/** MySQL hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', 'utf8mb4_bin' );

// Using mysqli instead of mysql extension
define( 'WP_USE_EXT_MYSQL', false );

// CI-WP Database table prefix.
$table_prefix  = 'cw_';


/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
 
define( 'AUTH_KEY',         '5-~4$r-c&t%-=*8qEH[~H=aHalXE5bb,YoG|On0mp)n{UWeV56^|ONSi=7M5:6i.' );
define( 'SECURE_AUTH_KEY',  'aP&D&+Wsq^S384!%:N}Xb`XrvPfSl43 TqYNocSaEb37~kqoY,T;Tc;$u.-L8<PR' );
define( 'LOGGED_IN_KEY',    '^RBR%iMtYu.W6YyK||w|eEC_cM<EqB?;ZRO)sLK[}aHU?<I;orgWCT@tK7XkA&7Q' );
define( 'NONCE_KEY',        'exocp=,KHA(bU=ia2iv4|^YZnVnz{ui|~B@*VJu4E{H{q`qz<g+_|,8jjKc6~o:V' );
define( 'AUTH_SALT',        'bo7I+WpB]iz%b96|Ox,~o<o-ikBQqLdJ6@4??=%M%h*P7ZjNW.9}cd(hEcR{]X~x' );
define( 'SECURE_AUTH_SALT', 'p,xGv|K^|E+#|$I-f;];9WZmDo:sN/ ypf`hb^<K&as?}^y_Q(9u.kHq7;81]V~9' );
define( 'LOGGED_IN_SALT',   'Zp2br}=J)iFLHkdp-6+S-tDqwS@3%C[?dr[8SWH8#B=g3f`??9{[fp1s `oaJVZ ' );
define( 'NONCE_SALT',       'Gk}9p(v),l]GD/B/um+tn7s0h,6dCbJ Zi<^K=M!UB,O?]6qLIi;>?`qfL.etDKS' );

/**#@-*/


/** 
 * set dynamic http server name no matter of virtual host and production host
 * 
 * It is an advice to use static http server name on production environment
 * 
 */

$scheme = ( isset( $_SERVER["HTTPS"] ) && ! empty( $_SERVER["HTTPS"] ) ) ? 'https' : 'http';

define( 'WP_SITEURL', $scheme . '://' . $_SERVER['SERVER_NAME'] );

define( 'WP_HOME', $scheme . '://' . $_SERVER['SERVER_NAME'] );

define( 'NOBLOGREDIRECT', $scheme . '://' . $_SERVER['SERVER_NAME'] );


/** 
 * update WordPress default setting
 *
 */

// permanently override memory_limit defined by php.ini
define( 'WP_MEMORY_LIMIT', '512M' );

// temporarily override memory_limit for some memory consume events
define( 'WP_MAX_MEMORY_LIMIT', '1024M' );

// empty WordPress trash in 5 days
define( 'EMPTY_TRASH_DAYS', 5 );

// disable all automatic updates:
define( 'AUTOMATIC_UPDATER_DISABLED', true );

// set auto-save interval is 1440 seconds 
define( 'AUTOSAVE_INTERVAL', 1440 );

// disable post revisions
define( 'WP_POST_REVISIONS', false );

// disable WordPress and Plugin notifications
define( 'WP_NOTIFICATIONS', false );

// remove RSD link from output
define( 'REMOVE_RSD_LINK', true );

// update default outgoing email address, empty value don't any update
define( 'OUTGOING_EMAIL_FROM', '' );

// update default outgoing email sender name, empty value don't any update
define( 'OUTGOING_EMAIL_FROM_NAME', '' );


/** 
 * CI-WP environment setting
 *
 * load different configurations depending on environment setting in htaccess
 * default setting could be: 
 *   development
 *   testing
 *   production
 */

define( 'WP_ENV', isset( $_SERVER['CIWP_ENV'] ) ? $_SERVER['CIWP_ENV'] : 'development' );

if ( defined( 'WP_ENV' ) && WP_ENV === "production" ) {
    @ini_set( 'log_errors', 'On' );    /* this should be set in php.ini, if you have access it */
    
    define( 'WP_DEBUG', false );
    define( 'WP_DEBUG_LOG', false );
    define( 'WP_DEBUG_DISPLAY', false );
    
        
    //define('DISALLOW_FILE_EDIT', true);
    
} else {
    /**
     * This will log all errors notices and warnings to a file /wp-content/debug.log
     */
    define( 'WP_DEBUG', true );
    define( 'WP_DEBUG_LOG', true );
    define( 'WP_DEBUG_DISPLAY', false );
    
    // Lists all the queries executed on the page to $wpdb->queries
    define( 'SAVEQUERIES', true );
}

/**
 * Genericons vector icons for theme
 * Not loading Genericons in default
 *
 */
define( 'LOAD_GENERICONS', false ); 


/** Fuseki theme setting
 *
 * apply fluid width or fixed width for Responsive Web Design
 * default setting is: 
 *   fluid
 *   fixed
 *
 * fluid for fluid width design,
 * fixed for fixed width design
 */
define( 'VIEW_DESIGN', 'fluid' ); 


/** Fuseki theme setting
 *
 * set content and sidebar layout fot middle part of the view
 * default setting is: 
 *   content-sidebar
 *   sidebar-content
 *
 * content-sidebar for left content right sidebar layout,
 * sidebar-content for left sidebar right contetnt layout
 */ 
define( 'VIEW_LAYOUT', 'content-sidebar' ); 


/**
 * CI-WP will add access counter to custom post types 
 * if constant CW_CUSTOM_POST_TYPES inlcudes custom post types
 * 
 * Default CI-WP's custom post type is event
 *
 */
// set the value with a comma separated string of custom post types used by CI-WP
define( 'CW_CUSTOM_POST_TYPES', 'event' );


/**
 * run php code snippet from shortcode inserted to TinyMCE editor
 * 
 */
define( 'RUN_PHP_Code_IN_SHORTCODE', true );


/**
 * show up comments at bottom of the page if there are page comments
 * 
 */
define( 'SHOW_PAGE_COMMENTS', true );


/**
 * Start year to count popular posts that will be displayed
 * under single post
 *
 */
define( 'POPULAR_POSTS_START_YEAR', 2010 );


/**
 * Google site verification code for Google Analytics 
 * keeping empty if don't use it 
 *
 */
define( 'GOOGLE_SITE_VERIFICATION', '' );

/**
 * Google Analytics tracking ID in format of UA-XXXXX-Y
 * keeping empty if don't use it 
 *
 */
define( 'ANALYTICS_TRACKING_ID', '' );


/**
 * Google DoubleClick for Publishers to add ADs to the view of CI-WP 
 * with asynchronous Google Publisher Tag
 *
 */
define( 'GOOGLE_DFP_TAGS', false );

/**
 * define parameters for Leaderboard Ad and Banner AD
 * See https://developers.google.com/doubleclick-gpt/reference for the details
 *
 */
if ( defined( 'GOOGLE_DFP_TAGS' ) && GOOGLE_DFP_TAGS ) {
    // AD unit path for Leaderboard Ad, for example, '/1234/travel/asia'
    define( 'AD_UNIT_PATH_0', '' );
    
    // AD slot size for Leaderboard Ad, for example, '[728, 90]' or '[[728, 90], [468, 60]]'
    define( 'AD_SLOT_SIZE_0', '[728, 90]' );
    
    // slot level targeting for Leaderboard Ad, for example, '"interests", "sports"'
    // or '"interests", ["sports", "music", "movies"]'
    define( 'SLOT_LEVEL_TARGETING_0', '"", ""' );
    
    // AD unit path for Banner AD on sidebar
    define( 'AD_UNIT_PATH_1', '' );
    
    // AD slot size for Banner AD on sidebar
    define( 'AD_SLOT_SIZE_1', '[300, 250]' );
    
    // slot level targeting for Banner AD on sidebar
    define( 'SLOT_LEVEL_TARGETING_1', '"", ""' );
    
    // page level targeting, for example, '"topic", "basketball"'
    define( 'PAGE_LEVEL_TARGETING', '"", ""' );    
}


/* 
 * That's all, stop editing! 
 *
 */

/** Absolute path to the WordPress directory. */
if ( !defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
