<?php

/**
 * The page template file for displaying all pages
 * 
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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
            
            <?php
                while ( have_posts() ) {
                    the_post(); 
                    
                    echo '<div class="row">';
                    echo '<div class="col-sm-12">';
                    
                    include current_theme_file( 'template-parts/content-page.php' );
                    
                    echo '</div></div>';
                    
                    if ( defined( 'SHOW_PAGE_COMMENTS' ) && SHOW_PAGE_COMMENTS ) {
                    
                        $comments = get_comments( array( 
                                                         'post_id' => get_the_ID(), 
                                                         'status' => 'approve'
                                                ) );
                        
                        if ( ! empty( $comments ) ) { 
                            echo '<div class="entry-content">';
                            echo '<div class="vertical-interval"></div>';
                            echo '<h3>User Comments</h3>';
                            echo '<div class="row">';
                            echo '<div class="col-sm-12">';
                        
                            foreach ( $comments as $comment ) {
                               echo '<div class="vertical-interval"></div>';
                               echo '<div class="row">';
                               echo '<div class="col-md-12">' 
                                    . $comment->comment_date . ' By ' 
                                    . $comment->comment_author . ' [' 
                                    . $comment->comment_author_email . ']</div>';
                               echo '<div class="col-md-1"></div>
                                     <div class="col-md-10"> ' 
                                     . $comment->comment_content
                                     . ' </div><div class="col-md-1"></div>';                           
                               echo '</div>';
                            }
                            
                            echo '</div></div></div>';
                        }                  
                    }
                    
                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) {
                        echo '<div class="vertical-interval"></div>';
                        echo '<div class="row">';
                        echo '<div class="col-sm-12">';
                        
                        include current_theme_file( '/structure-parts/comments.php' );
                        
                        echo '</div></div>';
                    }
                }
            ?>
            
            </main><!-- #main -->
            </div><!-- #primary -->
        </div>
        
		<div class="col-md-3<?php if ( defined( 'VIEW_LAYOUT' ) && VIEW_LAYOUT === "sidebar-content" ) echo " col-md-pull-9"; ?>">
            <?php include current_theme_file( "/structure-parts/sidebar.php" ); ?>
        </div>
	</div>
</div>

<?php
// include view bottom file 
include current_theme_file( "/structure-parts/view-bottom.php" );
