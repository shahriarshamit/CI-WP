<?php

/**
 * The header top file
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * 
 * @package		CI-WP
 * @subpackage	WordPress
 * @category	Fuseki Theme
 * @author      W3plan Technologies
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php
    if ( defined( 'META_DESCRIPTION' ) && ! empty( META_DESCRIPTION ) ) {
       echo '<meta name="description" content="' . META_DESCRIPTION . '">' . PHP_EOL; 
    } 
    if ( defined( 'META_KEYWORDS' ) && ! empty( META_KEYWORDS ) ) {
       echo '<meta name="keywords" content="' . META_KEYWORDS . '">' . PHP_EOL; 
    }
    if ( defined( 'GOOGLE_SITE_VERIFICATION' ) && ! empty( GOOGLE_SITE_VERIFICATION ) ) {
        // Google site verification for Google Analytics 
        echo '<meta name="google-site-verification" content="' . GOOGLE_SITE_VERIFICATION . '">' . PHP_EOL; 
    }
    
    wp_head();
?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'fuseki' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
    	<div class="site-branding">
            <div class="container<?php if (defined('VIEW_DESIGN') && VIEW_DESIGN === "fluid") echo "-fluid"; ?>">
                <div class="row">
                    <div class="col-sm-4">
                        <?php
                            if ( file_exists( current_theme_file( '/imgs/site-logo.png' ) ) ) {
                                echo '<a href="'. esc_url( home_url( '/' ) ) . '" rel="home"><img class="custom-logo" src="' . current_theme_file_uri( '/imgs/site-logo.png' ) .  '" alt="Site Logo"></a>';
                            } else {
                                echo '<a href="'. esc_url( home_url( '/' ) ) . '" rel="home"><div class="image-placeholder" style="width:150px; height:75px;"><h4>Site Logo</h4></div></a>';
                            }
                        ?>
                    </div>
                    <div class="col-sm-4 horizontal-centered">
                        <?php
                            if ( is_user_logged_in() ) {
                                echo '<a href="/wp-admin/profile.php" class="btn btn-default" role="button">My profile</a>';
                                echo '<div class="horizontal-interval"></div>';
                                echo '<a href="/logout/" class="btn btn-default" role="button">Log out</a>';
                            } else {
                                echo '<a href="/register/" class="btn btn-default" role="button">Register</a>';
                                echo '<div class="horizontal-interval"></div>';
                                echo '<a href="/login/" class="btn btn-default" role="button">Log in</a>';
                            }
                        ?>
                    </div>
                    <div class="col-md-4 horizontal-centered">
                        <?php echo get_search_form(); ?>
                    </div>
                </div>
            </div>
		</div><!-- .site-branding -->       
