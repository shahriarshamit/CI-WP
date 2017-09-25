<?php

/**
 * load structure files to generate view top contents
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package		CI-WP
 * @subpackage	WordPress
 * @category	Fuseki Theme
 * @author      W3plan Technologies
 */

// include header top file 
include current_theme_file( "/structure-parts/header-top.php" );
  
if ( ! empty(get_current_template()) 
     && (   pathinfo(trim(get_current_template()), PATHINFO_BASENAME) === 'index.php' 
         || pathinfo(trim(get_current_template()), PATHINFO_BASENAME) === 'home.php' 
        )
    ) {
    // include header file 
    include current_theme_file( "/structure-parts/header.php" );
}

// include navigation menu file 
include current_theme_file( "/structure-parts/navigation-menu.php" );

// include content top file 
include current_theme_file( "/structure-parts/content-top.php" );
