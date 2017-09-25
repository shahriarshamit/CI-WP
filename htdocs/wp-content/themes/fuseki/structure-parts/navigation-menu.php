<?php

/**
 * website navigation menu
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package		CI-WP
 * @subpackage	WordPress
 * @category	Fuseki Theme
 * @author      W3plan Technologies
 */

?>

    <div class="container<?php if ( defined( 'VIEW_DESIGN' ) && VIEW_DESIGN === "fluid" ) echo "-fluid"; ?>">
        <nav id="site-navigation" class="row main-navigation" role="navigation">
            <?php
                wp_nav_menu( array(
                                    'theme_location' => 'primary',
                                    'menu_class'     => 'primary-menu'
                             ) );
            ?>
        </nav><!-- #site-navigation -->
    </div>
</header><!-- #masthead -->
