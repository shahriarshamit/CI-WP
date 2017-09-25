<?php

/**
 * The content bottom file
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * 
 * @package		CI-WP
 * @subpackage	WordPress
 * @category	Fuseki Child Theme
 * @author      W3plan Technologies
 */

// Demo of CodeIgniter controller output variables to view
?>

<div class="container<?php if ( defined( 'VIEW_DESIGN' ) && VIEW_DESIGN === "fluid" ) echo "-fluid"; ?>">
    <div class="row">
        <div class="col-md-12">
            <div class="content-bottom">
                <?php 
                    if ( isset( $demo_view) && strtolower( trim( $demo_view ) ) == "demo-view" ) {
                        echo '<p style="text-align:center;font-size:1.5em;font-weight:bold;background-color:#eeeeee;">'.
                              esc_html__( 'Output sample data from controller action', 'fuseki' ) . '</p>';
                        
                        echo "<p>". esc_html__( 'Query variables and values sent to controller action by', 'fuseki' ) . 
                             " <strong>http://" . urldecode( $_SERVER["SERVER_NAME"] . $_SERVER['REQUEST_URI'] ) . "</strong></p>";
                        
                        echo '<ul style="margin: 30px 60px;">';
                        
                        foreach( $qvals as $key => $val ) {
                            echo '<li>variable: <strong>' . sanitize_text_field($key) . 
                                 '</strong>, value: <strong>' . sanitize_text_field($val) . 
                                 '</strong></li>';
                        }
                        
                        echo "</ul><p>". esc_html__( 'User login status', 'fuseki' ) . ": <strong>" . $user_status . '</strong></p>';
                        
                        echo "<p>" . esc_html__( 'CodeIginter helper output', 'fuseki' ) . ": <strong>". rand_str( 12 ) . '</strong></p>';
                        
                        echo "<p>" . esc_html__( 'CodeIginter ci_site_url() output', 'fuseki' ) . ": <strong>" . ci_site_url() . '</strong></p>';
                        
                        echo "<p>". esc_html__( 'WordPress site_url() output', 'fuseki' ) . ": <strong>" . site_url() . '</strong></p>';
                        
                        // get admin user session data
                        $user_name = $this->session->userdata( 'user_name' );
                        $user_email = $this->session->userdata( 'user_email' );
                        $user_roles = $this->session->userdata( 'user_roles' );
                        
                        echo "<p>" . esc_html__( 'Admin user session data', 'fuseki' ) . ':</p>';
                        echo <<<HTML
                        <ul style="margin: 30px 60px;">
                            <li>$user_name</li>
                            <li>$user_email</li>
                            <li>$user_roles</li>
                        </ul>
HTML;
                        echo "<p>" . esc_html__( 'CodeIginter query results', 'fuseki' ) . ": " . $ci_results . '</p>';
                        
                        echo "<p>" . esc_html__( 'Code execution time in seconds', 'fuseki' ) . ": <strong>" . $elapsed1 . ' </strong></p>';
                        
                        echo "<p>" . esc_html__( 'WordPress query results', 'fuseki' ) . ':</p>';
                        echo <<<HTML
                            <table>
                              <tr>
                                <th>Post title</th>
                                <th>Post time</th> 
                              </tr>
HTML;
                        foreach( $wp_results as $wp_result ) {                                
                            echo '<tr><td>' . $wp_result->post_title . '</td>';
                            echo '<td>' . $wp_result->post_date . '</td></tr>';
                        }
                        echo "</table>";
                        
                        echo "<p>" . esc_html__( 'Code execution time in seconds', 'fuseki' ) . ": <strong>" . $elapsed2 . ' </strong></p>';
                    }
                ?>
            </div>
        </div>
    </div>
</div>

</div><!-- #content -->
