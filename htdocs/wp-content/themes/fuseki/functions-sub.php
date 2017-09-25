<?php

/**
 * 
 * Fuseki functions and definitions  
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

/**
 * define description to HTML meta tag
 */
if ( ! defined( 'META_DESCRIPTION' ) ) {
	define( 'META_DESCRIPTION', 'CI-WP is an enterprise software platform that brings MVC(Model-View-Controller) architecture to WordPress' );
}

/**
 * define keywords to HTML meta tag
 */
if ( ! defined( 'META_KEYWORDS' ) ) {
	define( 'META_KEYWORDS', 'CI-WP, CW, MVC, MVC Base Layer, MVC Application Layer, Fuseki, Fuseki Child' );
}

/**
 * define metadata key constant
 */
if ( ! defined( 'CW_POST_COUNTER_KEY' ) ) {
	define( 'CW_POST_COUNTER_KEY', 'popular_posts' );
}

/**
 * allow shortcode for text widget
 */
add_filter( 'widget_text', 'do_shortcode' );

/**
 * allow shortcode for comments
 */
add_filter( 'comment_text', 'do_shortcode' ); 

/**
 * instruct WP to use HTML5 markup
 */
add_theme_support('html5',
                    array(  'comment-list', 
                            'comment-form', 
                            'search-form', 
                            'gallery', 
                            'caption', 
                            'widgets'
                        )
);

/**
 * Define current used template file
 *
 * Create a global variable with the name of the current
 * theme template file being used.
 *
 * @param $template The full path to the current template
 */
function define_current_template( $template ) {
    $GLOBALS['current_theme_template'] = $template;

    return $template;
}

add_action( 'template_include', 'define_current_template', 1000 );

/**
 * get current template file name
 *
 * @global $current_theme_template Defined using define_current_template()
 * @param $echo Defines whether to return or print the template filename
 * @return The name of the template filename, including .php
 */
function get_current_template( $echo = false ) {
    if ( ! isset( $GLOBALS['current_theme_template'] ) ) {
        trigger_error( '$current_theme_template has not been defined yet', E_USER_WARNING );
        return false;
    }
    if ( $echo ) {
        echo $GLOBALS['current_theme_template'];
    }
    else {
        return $GLOBALS['current_theme_template'];
    }
}


/*
 *  load Bootstrap 3 from CDN  
 */
function add_cdn_lib() {
    
    wp_enqueue_style( 'bootstrap_style', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', array(), '3.3.7' );
    wp_enqueue_script( 'bootstrap_script', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array('jquery'), '3.3.7' );
}

//wp_enqueue_scripts is the action hook
add_action( 'wp_enqueue_scripts', 'add_cdn_lib', 0 );

/**
 * Output HTML code for checking bootstrap loading
 * 
 * @return   string  HTML code
 */
function check_fbkcss() {
    echo <<<DOC
<!-- Bootstrap CSS local fallback -->
<div id="bootstrapCssTest" class="hidden"></div>
DOC;
}

/**
 * load Bootstrap 3 from local if failed to load from CDN  
 * 
 * @return   string  HTML code
 */
function check_fbkjs() {
    $localjs = get_template_directory_uri() . '/css/bs/3.3.7/js/bootstrap.min.js';
    $localcss = get_template_directory_uri() . '/css/bs/3.3.7/css/bootstrap.min.css';
    
    echo <<<DOC
<!-- Bootstrap JS local fallback -->
<script>if(typeof(jQuery.fn.modal) === 'undefined') {document.write('<script src="{$localjs}"><\/script>')}</script>
<script>
    jQuery(function() {
      if ( jQuery( '#bootstrapCssTest' ).is( ':visible' ) ) {
        jQuery( "head" ).prepend( '<link rel="stylesheet" href="{$localcss}">' );
      }
    });
</script>
DOC;
}

add_action( "wp_head", "check_fbkcss" ); 
add_action( "wp_head", "check_fbkjs" );

/**
 * Add external CSS and JavaScript files from Fuseki
 * vector icons for CI-WP with genericons.css
 * 
 */
function add_fuseki_libs() {
    if ( defined( 'LOAD_GENERICONS' ) && LOAD_GENERICONS ) {
        wp_enqueue_style( 'fuseki_libs_style_1', get_template_directory_uri() . '/genericons/genericons.css', array(), '0.0.1' );
    }
    
    //wp_enqueue_script( 'useki_libs_script_1', get_template_directory_uri() . '/js/...', array(), '0.0.1' );
}

add_action( 'wp_enqueue_scripts', 'add_fuseki_libs' );


/*
 *  Add post accessed counter to meta data
 *
 */
function chch_popular_posts( $post_id ) {
    $count_key = CW_POST_COUNTER_KEY;
    
    $count = get_post_meta( $post_id, $count_key, true );
    if ( empty( $count ) ) {
        $count = 1;
        delete_post_meta( $post_id, $count_key );
        add_post_meta( $post_id, $count_key, $count );
    } else {
        $count++;
        update_post_meta( $post_id, $count_key, $count );
    }
}

function chch_track_posts( $post_id ) {
    if ( is_single() || is_page() ) {
        if ( empty( $post_id ) ) {
            global $post;
            $post_id = $post->ID;
        }
        
        chch_popular_posts( $post_id );
    } else {
        return;
    }
}

// update popular_posts to single post and page
add_action( 'wp_head', 'chch_track_posts' );


/**
 * add custom post types to main query for index.php
 *
 */
function add_custom_post_type_to_query( $query ) {
    if ( ! is_admin() && $query->is_main_query() && $query->is_home() ) {
        if ( defined( 'CW_CUSTOM_POST_TYPES' ) && ! empty( CW_CUSTOM_POST_TYPES ) ) {
            $ptypes = explode( ",", CW_CUSTOM_POST_TYPES );
            array_unshift( $ptypes, 'post' );
            
            $query->set( 'post_type',  $ptypes );
        }
    }
}

add_action( 'pre_get_posts', 'add_custom_post_type_to_query' );


/**
 * manage the list of posts, pages and custom post types
 *
 */
if ( defined( 'CW_CUSTOM_POST_TYPES' ) && ! empty( CW_CUSTOM_POST_TYPES ) ) {
    $ptypes = explode( ",", CW_CUSTOM_POST_TYPES );
    array_unshift( $ptypes, 'post', 'page' );
    
    /**
     * add a new column to the list of posts and custom post types
     *
     */
    foreach( $ptypes as $ptype ) {
        add_filter("manage_{$ptype}_posts_columns", function ( $columns ) {
            if ( is_array( $columns ) && ! isset( $columns['view_counter'] ) )
                $columns['view_counter'] = __( 'View Counter', 'fuseki' );
            return $columns;
        });

        add_action( "manage_{$ptype}_posts_custom_column", function ( $column_name, $post_id ) {
            if ( $column_name == 'view_counter' ) {
                $count = get_post_meta( $post_id, CW_POST_COUNTER_KEY, true );
                printf( "<strong>%s</strong>", $count );
            }
        }, 10, 2 );
    }
    
    /**
     * limit the 'view_counter' column width
     */
    add_action( 'admin_print_styles-edit.php', function() {
        echo '<style> .column-view_counter { width: 150px; }</style>';
    } );
    
    /**
    *  Change order of custom columns for the list of posts and custom post types
    */
    add_filter( 'manage_posts_columns', function ( $columns ) {
        $new = array();
        foreach ( $columns as $key => $title ) {
            if ( $key == 'date' ) 
                $new['view_counter'] = __( 'View Counter', 'fuseki' );
            
            $new[$key] = $title;
        }
        return $new;
    } );

    /**
    *  Change order of custom columns for the list of posts and custom post types
    */
    foreach( $ptypes as $ptype ) {
        add_filter( "manage_edit-{$ptype}_sortable_columns", function ( $columns ) {
            $columns['view_counter'] = 'counter';          
            //To make a column 'un-sortable' remove it from the array unset($columns['date']);
            
            return $columns;
        }, 10, 2 );
    }
    
    add_action( 'pre_get_posts', function ( $query ) {
        if( ! is_admin() )
            return;
     
        $orderby = $query->get( 'orderby' );
     
        if( 'counter' == $orderby ) {
            $query->set( 'meta_key', CW_POST_COUNTER_KEY );
            $query->set( 'orderby', 'meta_value_num' );
        }
    }, 10, 2 );
    
}

/* 
 * get CodeIgniter link URL from WordPress post, custom post type or page URL 
 * 
 * @param	string        $wp_link  post or page URL
 * @param	string        $cwc      codeIgniter controller
 * @param	string        $cwm      codeIgniter action
 * @param	string|array  $cwp      arguments to transfer to action
                                    default is empty string
 * @return	string  An URL that CodeIgniter is able to parse
 *
 */
function get_ci_link( $wp_link, $cwc, $cwm, $cwp = '' ) {
    if ( empty( $cwp ) ) {
        $cwa = array();
    } elseif ( is_array( $cwp ) ) {
        foreach ( $cwp as $key => $value ) {
           $cwa['cwp' . $key] = $value;
        }
    } else {
        $cwa = array( 'cwp' => $cwp );
    }
    
    $query_var = array_merge( array( 'cwc' => $cwc, 'cwm' => $cwm ), $cwa );
    
    return esc_url( add_query_arg( $query_var, $wp_link ) ); 
}


/* 
 * run php code in shortcode inserted to TinyMCE editor
 * sample code:
 * <code>[cw] $x = array( 'a' => 100, 'b' => "Hello world!" );  print_r( $x ); [/cw]</code>
 */
function php_text_in_shortcode( $atts , $content = null ) {   
    ob_start();
    
    eval( ' ?' . '><' . '?php ' . html_entity_decode( $content ) );
    
    $content = ob_get_contents();
    
    ob_end_clean();
    
    return $content;
}

/**
 *  remove php code in shortcode
 *
 */
function remove_php_text_in_shortcode( $atts , $content = null ) {
    return ''; 
}

if (   defined( 'RUN_PHP_Code_IN_SHORTCODE' )
    && RUN_PHP_Code_IN_SHORTCODE
    && ! empty( $_SERVER['QUERY_STRING'] )
   ) {
    parse_str( $_SERVER['QUERY_STRING'], $querys );
    
    if ( ! empty( $querys['cwc'] ) &&
         ! empty( $querys['cwm'] )
       ) {
        add_shortcode( 'cw', 'php_text_in_shortcode' );
    } else {
        add_shortcode( 'cw', 'remove_php_text_in_shortcode' );
    }
}

/* 
 * run php code in text widget
 *
 * @param  string   $content   php code snippet
 * 
 * @return	string  result HTML that output from php code snippet
 */
function php_text_text_widget( $content ) {
    $str1 = html_entity_decode( $content );
    
    $str2 = preg_replace( array('/<code>\s*\[cw\]/i', '/\[\/cw\]\s*<\/code>/i' ), array( '', '' ), $str1 );
    
    if (strlen($str1) > strlen($str2) + 20) {
        ob_start();
    
        eval( ' ?' . '><' . '?php ' . $str2 );
        
        $content = ob_get_contents();
        
        ob_end_clean();
    }
    
    return $content;
}

/**
 * allow php code for text widget
 */
add_filter( 'widget_text', 'php_text_text_widget' );

// disable HeartBeat Control since it consumes server resources
function stop_heartbeat() {
    wp_deregister_script( 'heartbeat' );
}

add_action( 'init', 'stop_heartbeat', 1 );

// remove admin welcome panel
remove_action( 'welcome_panel', 'wp_welcome_panel' );

/**
 *  clean head
 *
 */
function head_clean () {
    // removes wlwmanifest link
    remove_action('wp_head', 'wlwmanifest_link');
    // keep or remove RSD link in output
    if ( defined( 'REMOVE_RSD_LINK' ) && REMOVE_RSD_LINK ) {
        remove_action('wp_head', 'rsd_link');
    }
}

add_action('after_setup_theme', 'head_clean');

// remove WordPress blog and news
function remove_dashboard_widgets () {
    remove_meta_box( 'dashboard_primary','dashboard','side' ); 
    remove_meta_box( 'dashboard_secondary','dashboard','side' );
}
add_action( 'wp_dashboard_setup', 'remove_dashboard_widgets' );

/**
 *  custom dashboard title
 *
 */
function custom_dashboard_widgets() {
    global $wp_meta_boxes;
    wp_add_dashboard_widget( 'custom_help_widget', 
                              '<img style="vertical-align:middle; margin-right:10px;" src="' . get_template_directory_uri() . '/imgs/cw-favicon.jpg' . '" alt="" height="32" width="30"> CI-WP Enterprise MVC Platform', 
                              'custom_dashboard_code'
                            );
}

/**
 *  custom dashboard content
 *
 */
function custom_dashboard_code() {
    $dashboard_code = <<<HTML
        <p style="padding:15px 10px; line-height:1.8;">
        CI-WP is an enterprise software platform that brings MVC ( Model-View-Controller ) architecture to WordPress, CI-WP are based on CodeIgniter web framework and WordPress CMS with presetting configurations, including a group of MVC base layers and brand new themes for quick developing, testing and producing MVC websites and web applications.
        
        <a style="margin:15px auto; display:block;" href="http://ci-wp.com" target="_blank">Click here to see CI-WP features and documents in details.</a>
        </p>
HTML;
    echo $dashboard_code;
}

// add custom dashboard widget
add_action( 'wp_dashboard_setup', 'custom_dashboard_widgets' );

/**
 *  update the footer on admin screen
 *
 */
function update_admin_footer() {
    $admin_tooter = <<<HTML
        Powered by <a href="http://www.wordpress.org" target="_blank">WordPress</a> | Extended by <a href="http://ci-wp.com" target="_blank">CI-WP</a></p>
HTML;
    
    echo $admin_tooter;
}

add_filter( 'admin_footer_text', 'update_admin_footer' );

/**
 *  disable WordPress and Plugin notifications
 *
 */
function remove_core_updates() {
    global $wp_version;
    return array ( 'last_checked' => time(),
                   'version_checked'=> $wp_version
                );
}

if ( defined( 'WP_NOTIFICATIONS' ) && ! WP_NOTIFICATIONS ) {
     add_filter( 'pre_site_transient_update_core', 'remove_core_updates' );
     add_filter( 'pre_site_transient_update_plugins', 'remove_core_updates' );
     add_filter( 'pre_site_transient_update_themes', 'remove_core_updates' );
}

/**
 * disable the emoji emoticons
 *
 */
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );	
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}

add_action( 'init', 'disable_emojis' );

/**
 * remove the tinymce emoji plugin
 * 
 * @param    array  $plugins  
 * @return   array             Difference between the two arrays
 */
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

/**
 * disable self-pings/self-trackbacks
 *
 */ 
function disable_self_trackback( &$links ) {
  $home = home_url();     // get_option( 'home' );
  foreach ( $links as $l => $link ) {
        if ( 0 === strpos( $link, $home ) )
            unset($links[$l]);
  }
}

add_action( 'pre_ping', 'disable_self_trackback' );

/**
 * update default email address
 *
 */
function email_sender( $email_address ) {
    return OUTGOING_EMAIL_FROM;
}

/**
 * update default email sender name
 *
 */
function email_sender_name( $name ) {
    return OUTGOING_EMAIL_FROM_NAME;
}

if ( defined( 'OUTGOING_EMAIL_FROM' ) && ! empty( OUTGOING_EMAIL_FROM ) &&
     defined( 'OUTGOING_EMAIL_FROM_NAME' ) && ! empty( OUTGOING_EMAIL_FROM_NAME )
    ) {   
    add_filter( 'wp_mail_from', 'email_sender' );
    add_filter( 'wp_mail_from_name', 'email_sender_name' );
}

/**
 * remove WordPress version number in output
 *
 */
function remove_version() {
    return '';
}

add_filter('the_generator', 'remove_version');

/**
 * remove howdy from the tool bar
 *
 */
function change_howdy( $translated, $text, $domain ) {
    if ( false !== strpos( $translated, 'Howdy' ) )
        return str_replace( 'Howdy', 'Welcome', $translated );
    
    return $translated;
}

add_filter( 'gettext', 'change_howdy', 10, 3 );

/**
 * remove the WordPress Logo from the toolbar
 *
 */
function remove_wp_logo( $wp_admin_bar ) {
	$wp_admin_bar->remove_node( 'wp-logo' );
}

add_action( 'admin_bar_menu', 'remove_wp_logo', 999 );

// disable W3TC footer comment for everyone but Admins / Super Admins
if ( !current_user_can( 'unfiltered_html' ) ) {
    add_filter( 'w3tc_can_print_comment', '__return_false', 10, 1 );
}
