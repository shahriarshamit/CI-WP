<?php

/**
 * One column content layout
 * Rename this file with home.php will replace index.php of Fuseki theme in output
 * 
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package		CI-WP
 * @subpackage	WordPress
 * @category	Fuseki Child Theme
 * @author      W3plan Technologies
 */

// include view top file 
include current_theme_file("/structure-parts/view-top.php");
?>

<div class="container<?php if (defined('VIEW_DESIGN') && VIEW_DESIGN === "fluid") echo "-fluid"; ?>">
	<div class="row">
        <div class="col-sm-12">
            <div id="primary" class="content-area">
                <main id="main" class="site-main" role="main">                    
                    Home content here...
                    
                </main>
            </div>
        </div>
	</div>
</div>

<?php
// include view bottom file 
include current_theme_file("/structure-parts/view-bottom.php");
