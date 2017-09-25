<?php

/**
 * Single custom post type template
 * create your single custom post type template with name: single-$posttype.php
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
echo "<style>.evcontenta {margin: 50px 10px;}.evcontentb {margin: 30px 20px;} .evtitle {font-weight:bold;}</style>";
echo '<article id="' . get_the_ID() . '">';
    echo '<header class="entry-header">';
    // Get post data
    the_post();
    
    the_title( '<h1 class="entry-title">', '</h1>' );

    the_post_thumbnail('post-thumbnail', ['class' => 'img-responsive responsive--full', 'title' => 'Feature image']);
    
    echo '<div class="evcontenta">';
    
    the_content();
    
    echo '</div><table border="0">';
    
    echo '<tr><td><p class="evtitle">Event venue name</p>';
    echo '<div class="evcontentb">' . get_field( "venue_name" ) . '</div></td>';
    
    echo '<td><p class="evtitle">Organizer name</p>';
    echo '<div class="evcontentb">' . get_field( "organizer_name" )  . '</div></td></tr>';
    
    echo '<tr><td><p class="evtitle">Start date and time</p>';
    echo '<div class="evcontentb">' . get_field( "start_date_time" )  . '</div></td>';
    
    echo '<td><p class="evtitle">End date and time</p>';
    echo '<div class="evcontentb">' . get_field( "end_date_time" )  . '</div></td></tr>';
    
    echo '<tr><td><p class="evtitle">Event contact phone</p>';
    echo '<div class="evcontentb">' . get_field( "event_phone" )  . '</div></td>';
    
    echo '<td><p class="evtitle">Event cost</p>';
    echo '<div class="evcontentb">' . get_field( "event_cost" )  . '</div></td></tr></table>';
    
    echo '<p class="evtitle">Image slider</p>';
    echo '<div class="evcontentb">' . do_shortcode( get_field( "image_slider" ) )  . '</div>';
    
    echo '</header>';
echo '</article>';

// include view bottom file 
include current_theme_file( "/structure-parts/template-bottom.php" );
