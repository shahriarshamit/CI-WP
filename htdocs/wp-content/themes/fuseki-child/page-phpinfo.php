<?php

/**
 * A sample of custom page template
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
echo '<style> .custom-logo {float: none;} </style>';

// output PHP information
phpinfo();

echo '<style>.footer ul li a { padding: auto; display: inline; }</style>';

// include view bottom file 
include current_theme_file( "/structure-parts/template-bottom.php" );
