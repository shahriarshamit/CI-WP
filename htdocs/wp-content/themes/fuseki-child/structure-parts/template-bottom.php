<?php

/**
 * The template bottom file
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * 
 * @package		CI-WP
 * @subpackage	WordPress
 * @category	Fuseki Child Theme
 * @author      W3plan Technologies
 */
               
                echo '</div></div>';
                
                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) {
                    echo '<div class="vertical-interval"></div>';
                    echo '<div class="row">';
                    echo '<div class="col-sm-12">';
                    
                    include current_theme_file( '/structure-parts/comments.php' );
                    
                    echo '</div></div>';
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
