<?php

/**
 * The template file for displaying all single posts
 * 
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
                    
                    include current_theme_file( '/template-parts/content.php' );
                    
                    echo '</div></div>';
                    
                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) {
                        echo '<div class="vertical-interval"></div>';
                        echo '<div class="row">';
                        echo '<div class="col-sm-12">';
                        
                        include current_theme_file( '/structure-parts/comments.php' );
                        
                        echo '</div></div>';
                    }
                    
                    echo '<div class="vertical-interval"></div>';
                    echo '<div class="row">';
                    echo '<div class="col-sm-12">';
                    
                    if ( is_singular( 'attachment' ) ) {
                        // Parent post navigation.
                        the_post_navigation( array(
                            'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'fuseki' ),
                        ) );
                    } elseif ( is_singular( 'post' ) ) {
                        // Previous/next post navigation.
                        the_post_navigation( array(
                            'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'fuseki' ) . '</span> ' .
                                '<span class="screen-reader-text">' . __( 'Next post:', 'fuseki' ) . '</span> ' .
                                '<span class="post-title">%title</span>',
                            'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'fuseki' ) . '</span> ' .
                                '<span class="screen-reader-text">' . __( 'Previous post:', 'fuseki' ) . '</span> ' .
                                '<span class="post-title">%title</span>',
                        ) );
                    }
                    
                    echo '</div></div>';
                }
            ?>
                
                <div class="row">
                <div class="col-sm-12">
                
                <?php
                    $cols = get_option( 'posts_per_page' );
                    if ( ! $cols || $cols > 8 ) {
                        $cols = 8;
                    }
                    if ( defined( 'POPULAR_POSTS_START_YEAR' ) && POPULAR_POSTS_START_YEAR > 1900 ) {
                        $start_year = POPULAR_POSTS_START_YEAR;
                    } else {
                        $start_year = 2010;
                    }
                    $args = array(
                                    'posts_per_page' => $cols,
                                    'post_status' => 'publish',
                                    'orderby' => 'meta_value_num', 
                                    'meta_key' => 'popular_posts',
                                    'date_query' => array( 'after' => array( 'year' => $start_year, 'month' => 1, 'day' => 1 ) ),
                                    'order' => 'DESC'
                                );
                    
                    if ( defined( 'CW_CUSTOM_POST_TYPES' ) && ! empty( CW_CUSTOM_POST_TYPES ) ) {
                        $ptypes = explode( ",", CW_CUSTOM_POST_TYPES );
                        array_unshift( $ptypes, 'post' );
                        $args['post_type'] = $ptypes;
                    }
                    
                    $query = new WP_Query( $args );
                    $populars = $query->get_posts();
                    
                    echo '<p class="title-bar">POPULAR POSTS</p>';
                    
                    $cnt = 1;
                    foreach ( $populars as $popular ) {
                        if ( get_post_meta( $popular->ID, 'popular_posts', true) > 1 ) {
                            
                            $cnt++;

                            if ( $cnt % $cols == 1 ) {
                                echo '<div class="row">';
                            }
                            
                            $plink = esc_url( get_permalink( $popular->ID ) ?: '' );
                            $title = get_the_title( $popular->ID );
                            $postImageUrl = get_the_post_thumbnail_url( $popular->ID );
                            
                            if ( $postImageUrl ) {	
                                $postImage = '<img class="post-thumbnail thumbnail_img img-responsive" src="' . $postImageUrl . '" alt="' . $title . '">';
                            } else {
                                $postImage = '<img class="post-thumbnail thumbnail_img img-responsive" src="' . current_theme_file_uri(   "/imgs/post-thumbnail.png" ) . '" alt="Post thumbnail">';
                            }

                            echo <<<HTML
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 md-box">
                                <a class="entry-link" href="$plink">
                                    $postImage
                                    <p class="cw-post-title">$title</p>
                                </a>
                            </div>
HTML;
                            if ( $cnt % $cols == 1 ) {
                                echo '</div>';
                            }
                            
                            if ( $cnt > 8 ) {
                                break;
                            }
                        }
                    }
                ?>
                
                </div></div>
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
