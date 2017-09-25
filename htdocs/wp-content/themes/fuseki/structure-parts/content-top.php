<?php

/**
 * content top file for Leaderboard Ad
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package		CI-WP
 * @subpackage	WordPress
 * @category	Fuseki Theme
 * @author      W3plan Technologies
 */

?>

<div id="content" class="site-content">
<div class="container<?php if ( defined( 'VIEW_DESIGN' ) && VIEW_DESIGN === "fluid" ) echo "-fluid"; ?>">
	<div class="row">
		<div class="col-md-12">
            <div class="content-top">
            <?php // Google DoubleClick for Publishers 
                if ( defined( 'GOOGLE_DFP_TAGS' ) && GOOGLE_DFP_TAGS ) {
                    echo <<<HTML
                    <div id="div-gpt-ad-123456789-0" style="width: 728px; height: 90px">
                        <script>
                            googletag.cmd.push(function() {
                                googletag.display("div-gpt-ad-123456789-0");
                            });
                        </script>
                    </div>
HTML;
                } else {
                    echo '<div class="image-placeholder leaderboard"><h4>' . esc_html__( 'Leaderboard Ad', 'fuseki' ) . '</h4></div>';
                }
            ?>
            </div>
		</div>
	</div>
</div>
