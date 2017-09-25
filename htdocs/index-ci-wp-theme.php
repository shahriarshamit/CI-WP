<?php

/**
 * Load CI-WP theme
 *
 *
 * @package		CI-WP
 * @subpackage	WordPress
 * @category	Theme
 */

/**
 * tells WordPress to load CI-WP theme and output it
 *
 * @var bool
 */
define( 'WP_USE_THEMES', true );

// load CI-WP theme template
require_once( ABSPATH . WPINC . '/template-loader.php' );
