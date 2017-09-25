<?php

/**
 * The template file for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package		CI-WP
 * @subpackage	WordPress
 * @category	Fuseki Theme
 * @author      W3plan Technologies
 */

// include view top file 
include current_theme_file( "/structure-parts/view-top.php" );
?>

<div class="container<?php if ( defined( 'VIEW_DESIGN' ) && VIEW_DESIGN === "fluid" ) echo "-fluid"; ?>">
	<div class="row">
        <div class="col-md-9<?php if ( defined( 'VIEW_LAYOUT' ) && VIEW_LAYOUT === "sidebar-content" ) echo " col-md-push-3"; ?>">
            <section id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <div class="row">
                <div class="col-sm-12">
                
                <?php
                    if ( have_posts() ) {

                        /* translate search query */
                        $search_words = esc_html__( 'Search Results for: ', 'fuseki' ) . '<strong>' . get_search_query() . '</strong>';
                        
                        echo <<<HTML
                                <header class="page-header">
                                    <p class="page-title">$search_words</p>
                                </header><!-- .page-header -->
                                <div class="vertical-interval"></div>
HTML;
                        while ( have_posts() ) {
                            the_post();
                            
                            echo '<div class="row">';
                            echo '<div class="col-sm-12">';
                            
                            // run the loop for the search to output the results.
                            include current_theme_file( '/template-parts/content-search.php' );
                            
                            echo '</div></div>';
                            echo '<div class="vertical-interval"></div>';
                        }
                            
                            echo '<div class="row">';
                            echo '<div class="col-sm-12">';
                                 the_posts_pagination( array(
                                    'prev_text'          => __( 'Previous page', 'fuseki' ),
                                    'next_text'          => __( 'Next page', 'fuseki' ),
                                    'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'fuseki' ) . ' </span>',
                                ) );
                            echo '</div></div>';
                        
                    } else {
                        include current_theme_file( '/template-parts/content-none.php' );
                    }
                ?>
                
                </div>
                </div>
            </main><!-- #main -->
            </section><!-- #primary -->
        </div>
        
		<div class="col-md-3<?php if ( defined( 'VIEW_LAYOUT' ) && VIEW_LAYOUT === "sidebar-content" ) echo " col-md-pull-9"; ?>">
            <?php include current_theme_file( "/structure-parts/sidebar.php" ); ?>
        </div>
	</div>
</div>

<?php
// include view bottom file 
include current_theme_file( "/structure-parts/view-bottom.php" );
