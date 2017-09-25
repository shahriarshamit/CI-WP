<?php

/**
 * website header images for index and home templates
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package		CI-WP
 * @subpackage	WordPress
 * @category	Fuseki Child Theme
 * @author      W3plan Technologies
 */

// definde slide images that file starts with / from theme root to file name 
$slide_one = '/imgs/slide-one.png';
$slide_two = '/imgs/slide-two.png';
$slide_three = '/imgs/slide-three.png';

?>
<div class="container<?php if ( defined( 'VIEW_DESIGN' ) && VIEW_DESIGN === "fluid" ) echo "-fluid"; ?>">
	<div class="row">
		<div class="col-md-12">
			<div class="carousel slide" id="carousel-ci-wp">
				<ol class="carousel-indicators">
					<li class="active" data-slide-to="0" data-target="#carousel-ci-wp"></li>
					<li data-slide-to="1" data-target="#carousel-ci-wp"></li>
					<li data-slide-to="2" data-target="#carousel-ci-wp"></li>
				</ol>
				<div class="carousel-inner">
					<div class="item active">
                        <?php
                            if ( file_exists( current_theme_file( "/imgs/slide-one.png" ) ) ) {
                                echo '<img alt="Carousel Bootstrap First" src="' . current_theme_file_uri( $slide_one ) . '" />';
                            } else {
                                echo '<img alt="Carousel Bootstrap First" src="http://via.placeholder.com/1700x480?text=Slider+one" />';
                            }
                        ?>
						<div class="carousel-caption">
							<!--h4>Caption title</h4-->
							<p>
								<?php echo __( 'First caption', 'fuseki' ); ?>
							</p>
						</div>
					</div>
					<div class="item">
                    <?php
                        if ( file_exists( current_theme_file( "/imgs/slide-two.png" ) ) ) {
                            echo '<img alt="Carousel Bootstrap Second" src="' . current_theme_file_uri( $slide_two ) . '" />';
                        } else {
                            echo '<img alt="Carousel Bootstrap Second" src="http://via.placeholder.com/1700x480?text=Slider+two" />';
                        }
                    ?>
						<div class="carousel-caption">
							<!--h4>Caption title</h4-->
							<p>
                                <?php echo __( 'Second caption', 'fuseki' ); ?>
							</p>
						</div>
					</div>
					<div class="item">
                        <?php
                            if ( file_exists( current_theme_file( "/imgs/slide-three.png" ) ) ) {
                                echo '<img alt="Carousel Bootstrap Third" src="' . current_theme_file_uri($slide_three) . '" />';
                            } else {
                                echo '<img alt="Carousel Bootstrap Third" src="http://via.placeholder.com/1700x480?text=Slider+three" />';
                            }
                        ?>
						<div class="carousel-caption">
							<!--h4>Caption title</h4-->
							<p>
								<?php echo __( 'Third caption', 'fuseki' ); ?>
							</p>
						</div>
					</div>
				</div>
				<a class="left carousel-control" href="#carousel-ci-wp" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
                <a class="right carousel-control" href="#carousel-ci-wp" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
			</div>
		</div>
	</div>
</div>
