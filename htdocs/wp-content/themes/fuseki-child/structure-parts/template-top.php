<?php

/**
 * The template top file
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * 
 * @package		CI-WP
 * @subpackage	WordPress
 * @category	Fuseki Child Theme
 * @author      W3plan Technologies
 */

// include view top file
include current_theme_file( "/structure-parts/view-top.php" );
?>

<div class="container<?php if ( defined( 'VIEW_DESIGN' ) && VIEW_DESIGN === "fluid" ) echo "-fluid"; ?>">
	<div class="row">
		<div class="col-md-9<?php if ( defined( 'VIEW_LAYOUT' ) && VIEW_LAYOUT === "sidebar-content" ) echo " col-md-push-3"; ?>">        
            <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <div class="row">
                <div class="col-sm-12">
