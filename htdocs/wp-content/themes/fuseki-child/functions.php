<?php

/**
 * 
 * Fuseki child functions and definitions 
 * 
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 * @link https://developer.wordpress.org/themes/basics/theme-functions
 *
 * @package     CI-WP
 * @subpackage  Fuseki
 * @category	Theme Functions
 * @since Fuseki 1.0
 * @author      W3plan Technologies
 */

 
// override the formats as defined by the parent theme 
add_theme_support( 'post-formats' );

/**
 * import the parent theme stylesheet instead @import by default
 *
 */
function fuseki_enqueue_styles() {
    
    $parent_style = 'fuseki-style';
    
    wp_enqueue_style( $parent_style, 
                      get_template_directory_uri() . '/style.css',
                      array(),
                      wp_get_theme()->get( 'Version' )
                    );
    
    wp_enqueue_style( 'fuseki-child-style', 
                      get_stylesheet_directory_uri() . '/style.css',
                      array( $parent_style ),
                      wp_get_theme()->get( 'Version' )
                    );
}

add_action( 'wp_enqueue_scripts', 'fuseki_enqueue_styles' );

/**
 * set up Fuseki Child's textdomain
 *
 * Declare textdomain for this child theme
 * Translations can be filed in the /languages/ directory
 */
function fuseki_child_languages() {
    load_child_theme_textdomain( 
                                  'fuseki-child', 
                                  get_stylesheet_directory() . '/languages'
                                );
}

add_action( 'after_setup_theme', 'fuseki_child_languages' );

/**
 *  register JavaScript and CSS files for CI-WP view 
 *  
 */
function add_script_libs() {
    /**
     * load WordPress default scripts
     */
    //wp_enqueue_style( 'fuseki_default_style_1', '/wp-includes/css/style_file', array(), wp_get_theme()->get( 'Version' ) );
    //wp_enqueue_script( 'fuseki_default_js_1', '/wp-includes/js/javascript_file', array(), wp_get_theme()->get( 'Version' ) );
    
    /**
     * load scripts from Fuseki Child Theme
     */
    //wp_enqueue_style( 'fuseki_custom_style_1', get_stylesheet_directory_uri() . '/css/style_file', array(), wp_get_theme()->get( 'Version' ) );
    //wp_enqueue_script( 'fuseki_custom_js_1', get_stylesheet_directory_uri() . '/js/javascript_file', array(), wp_get_theme()->get( 'Version' ) );
    
    /**
     * load scripts from CDN
     */
    //wp_enqueue_style( 'fuseki_cdn_style_1', 'the_url_of_cdn_style', array(), wp_get_theme()->get( 'Version' ) );
    //wp_enqueue_script( 'fuseki_cdn_js_1', 'the_url_of_cdn_js_script', array(), wp_get_theme()->get( 'Version' ) );
}

/**
 * add scripts to CI-WP view of specified post id, custom post
 * type id and page id otherwise add scripts to all CI-WP views
 * 
 */
$id = '';
if ( is_single( $id ) || is_page( $id ) ) {
    add_action( 'wp_enqueue_scripts', 'add_script_libs' );
} else {
    add_action( 'wp_enqueue_scripts', 'add_script_libs' );
}


/**
 *  manage Admin Menu by Fuseki's third_party libraries
 *
 */
function my_admin_menu() {
  /**
    // Rename Media Section to MyMedia for your example
    rename_admin_menu_section( 'Media', 'Media Library' );   
    
    // Swap location of Posts Section with Pages Section
    //swap_admin_menu_sections( 'Pages', 'Posts' );
    
    // Save off the event Tags Menu
    $event_tags_item_array = get_admin_menu_item_array( 'event', 'Event Tags' ); 
    
    // Rename two event Menu Items and Delete the Event Tags Item
    update_admin_menu_section( 'Event', array(              
        array( 'rename-item','item'=>'Event', 'new_title'=>'List event' ),
        array( 'rename-item','item'=>'Add New', 'new_title'=>'Add event' ),
        array( 'delete-item','item'=>'Event Tags' )
    ) );
    
    // Copy the 'Add New' over from Actors
    copy_admin_menu_item( 'Event',array( 'Actors', 'Add New' ) ); 
  */
}

add_action( 'admin_menu', 'my_admin_menu' );


/**
 * print out all undefined CSS classes used by current page to browser console
 * when website environment is development 
 * 
 */
function show_undefiled_css_class() {
    $queries = get_num_queries();
    $timers = timer_stop( 0 );
    $curtemp = get_current_template();
    
    echo <<<HTML
<script>
  console.log("$queries queries in $timers seconds");
  console.log("Current template file: $curtemp");
  console.log('');
  var allClasses = Array.from(document.querySelectorAll( '*' ))
    .map( n => Array.from( n.classList ) )
    .reduce( ( all, a ) => all ? all.concat( a ) : a )
    .reduce( ( all, i ) => all.add( i ), new Set() );

  //load contents of all CSS stylesheets applied to the document
  var loadStyleSheets = Array.from( document.styleSheets )
    .map( s => {
      if ( s.href ) {
        return fetch( s.href )
              .then( r => r.text() )
              .catch( e => {
                console.warn( 'Coudn\'t load ' + s.href + ' - skipping' );
                return "";
              } );
      }
      
      return s.ownerNode.innerText
    } );

  Promise.all( loadStyleSheets ).then( s => {
    var text = s.reduce( ( all, s ) => all + s );

    //get a list of all CSS classes that are not mentioned in the stylesheets
    var undefinedClasses = Array.from( allClasses )
      .filter( c => {
        var rgx = new RegExp( escapeRegExp( '.' + c ) + '[^_a-zA-Z0-9-]' );

        return !rgx.test( text );
      });

    if( undefinedClasses.length ) {
        console.log( 'List of ' + undefinedClasses.length + ' undefined CSS classes: ', undefinedClasses );
    } else {
        console.log( 'All CSS classes are defined!' );
    }
  });

  function escapeRegExp( str ) {
    return str.replace( /[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&" );
  }
</script>
HTML;
}

if ( defined('WP_ENV' ) && WP_ENV === "development" ) {
    add_action( 'wp_footer', 'show_undefiled_css_class' );
}
