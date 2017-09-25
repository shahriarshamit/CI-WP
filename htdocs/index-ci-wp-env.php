<?php

/**
 * Load CI-WP Environment
 *
 *
 * @package		CI-WP
 * @subpackage	WordPress
 * @category	Environment
 */


if ( ! isset( $wp_did_header ) ) {
    
	$wp_did_header = true;

	// Load the WordPress library.
	require_once( dirname( __FILE__ ) . '/wp-load.php' );

}
