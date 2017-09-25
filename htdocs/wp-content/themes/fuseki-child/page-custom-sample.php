<?php

/**
 * Template Name: Sample custom page template
 *
 * copy and rename this file as page-[an_effective_file_name].php to 
 * create your custom page template
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package		CI-WP
 * @subpackage	WordPress
 * @category	Fuseki Child Theme
 * @author      W3plan Technologies
 */

// include view top file 
include current_theme_file( "/structure-parts/template-top.php" );

/**
 * Area to add the content of page custom template
 * 
 */
$code = <<<HTML
    <?php

    /**
     * Template Name: Sample custom page template
     *
     * copy and rename this file as page-[an_effective_file_name].php to 
     * create your custom page template
     *
     * @link https://codex.wordpress.org/Template_Hierarchy
     *
     * @package      CI-WP
     * @subpackage   WordPress
     * @category     Fuseki Child Theme
     * @author       W3plan Technologies
     */
    
    include current_theme_file( "/structure-parts/template-top.php" );
    
    /**
     * Area to add the content of page custom template
     * 
     */
        
    
    // include view top file 
    include current_theme_file( "/structure-parts/template-bottom.php" );
    
HTML;

echo '<pre>' . htmlspecialchars( $code ) . '</pre>';

// include view top file 
include current_theme_file( "/structure-parts/template-bottom.php" );
