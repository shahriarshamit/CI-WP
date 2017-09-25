<?php

/**
 * website disclaimer files
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package		CI-WP
 * @subpackage	WordPress
 * @category	Fuseki Chile Theme
 * @author      W3plan Technologies
 * @author      W3plan Technologies
 */

?>
        <div class="container<?php if ( defined( 'VIEW_DESIGN' ) && VIEW_DESIGN === "fluid" ) echo "-fluid"; ?>">
            <div class="row footer-bottom">
                <div class="pull-left">
                </div>
                <div class="pull-right">
                    <?php 
                        echo esc_html__( 'Copyright 2017 - ', 'fuseki' ); 
                        echo '<script>document.write(new Date().getFullYear())</script>';
                        echo '<a href="http://ci-wp.com/about-us" target="_blank"><img style="margin:auto 10px; vertical-align: middle;" src="' . current_theme_file_uri( '/imgs/w3plan-logo-small.png' ) . '" width="24" height="12" alt="W3plan Logo"> W3plan Technologies</a>';
                        echo esc_html__( ' - All rights reserved.', 'fuseki' );
                    ?>
                </div>
            </div>
        </div>
        
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php 
    // always have wp_footer() just before the closing </body>
    wp_footer();
    
    // Google DoubleClick for Publishers 
    if ( defined( 'GOOGLE_DFP_TAGS' ) && GOOGLE_DFP_TAGS ) {
        /* 
         * Asynchronous Google Publisher Tags for two AD slots
         * Ad slot "div-gpt-ad-123456789-0" located in content-top.php
         * Ad slot "div-gpt-ad-123456789-1" located on sidebar
         *
         */
?>
<script async="async" src="https://www.googletagservices.com/tag/js/gpt.js"></script>
<script>
var googletag = googletag || {};
googletag.cmd = googletag.cmd || [];
googletag.cmd.push(function() {
    googletag.pubads().set("adsense_background_color", "FFFFFF");    
});
googletag.cmd.push(function() {
    googletag.defineSlot("<?php echo AD_UNIT_PATH_0; ?>", <?php echo AD_SLOT_SIZE_0; ?>, "div-gpt-ad-123456789-0")
        .addService(googletag.pubads())
        .setTargeting(<?php echo SLOT_LEVEL_TARGETING_0; ?>);
    googletag.defineSlot("<?php echo AD_UNIT_PATH_1; ?>", <?php echo AD_SLOT_SIZE_1; ?>, "div-gpt-ad-123456789-1")
        .addService(googletag.pubads())
        .setTargeting(<?php echo SLOT_LEVEL_TARGETING_1; ?>);
    googletag.pubads().setTargeting(<?php echo PAGE_LEVEL_TARGETING; ?>);
    googletag.pubads().enableSingleRequest();
    googletag.enableServices();
});
</script>

<?php
    }
    // Google Analytics tracking snippet
    if ( defined( 'GOOGLE_SITE_VERIFICATION' ) && ! empty( GOOGLE_SITE_VERIFICATION ) ) {
?>
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo ANALYTICS_TRACKING_ID; ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments)};
  gtag('js', new Date());
  gtag('config', '<?php echo ANALYTICS_TRACKING_ID; ?>');
</script>
<?php } ?>

</body>
</html>
