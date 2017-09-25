<?php

/**
 * Fuseki Theme Customizer
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * 
 * @package		CI-WP
 * @subpackage	WordPress
 * @category	Fuseki Theme
 * @author      W3plan Technologies
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function fuseki_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'fuseki_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function fuseki_customize_preview_js() {
	wp_enqueue_script( 'fuseki_customizer', current_theme_file_uri('/js/customizer.js'), array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'fuseki_customize_preview_js' );
