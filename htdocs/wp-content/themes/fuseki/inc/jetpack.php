<?php

/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.com/
 * 
 * @package		CI-WP
 * @subpackage	WordPress
 * @category	Fuseki Theme
 * @author      W3plan Technologies
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 */
function fuseki_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'fuseki_infinite_scroll_render',
		'footer'    => 'page',
	) );

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );
}
add_action( 'after_setup_theme', 'fuseki_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function fuseki_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) {
            include current_theme_file('/template-parts/content-search.php');
        } else {
			include current_theme_file('/template-parts/content.php');
		}
	}
}
