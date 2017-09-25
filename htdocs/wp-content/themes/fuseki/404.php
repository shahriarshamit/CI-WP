<?php

/**
 * The template file for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
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
            <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <div class="row">
                <div class="col-sm-12">
                    
                    <section class="error-404 not-found">
                        <header class="page-header">
                            <h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'fuseki' ); ?></h1>
                        </header><!-- .page-header -->

                        <div class="page-content">
                            <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'fuseki' ); ?></p>
                            
                            <?php
                                get_search_form();
                                
                                echo '<div class="vertical-interval"></div>';

                                the_widget( 'WP_Widget_Recent_Posts' );

                                // Only show the widget if site has multiple categories.
                                if ( fuseki_categorized_blog() ) {
                                    $widget_cat = esc_html_e( 'Most Used Categories', 'fuseki' );
                                    $list_cats = wp_list_categories( array(
                                                                            'orderby'    => 'count',
                                                                            'order'      => 'DESC',
                                                                            'show_count' => 1,
                                                                            'title_li'   => '',
                                                                            'number'     => 10,
                                                                    ) );
                                    echo <<<HTML
                                            <div class="widget widget_categories">
                                                <h2 class="widget-title">$widget_cat</h2>
                                                <ul>
                                                    $list_cats 
                                                </ul>
                                            </div><!-- .widget -->
HTML;
                                }
                                
                                /* translators: %1$s: smiley */
                                $archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'fuseki' ), convert_smilies( ':)' ) ) . '</p>';
                                the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );

                                the_widget( 'WP_Widget_Tag_Cloud' );
                            ?>
                        
                        </div><!-- .page-content -->
                    </section><!-- .error-404 -->
                
                </div>
                </div>
            </main><!-- #main -->
            </div><!-- #primary -->
        </div>
	</div>
</div>

<?php
// include view bottom file 
include current_theme_file( "/structure-parts/view-bottom.php" );
