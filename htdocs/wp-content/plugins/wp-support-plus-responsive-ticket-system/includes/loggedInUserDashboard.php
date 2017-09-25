<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $current_user;
$current_user=wp_get_current_user();
$roleManage=get_option('wpsp_role_management');
$advancedSettings=get_option( 'wpsp_advanced_settings' );
$generalSettings=get_option( 'wpsp_general_settings' );
$allowed_roles=array_intersect($roleManage['front_ticket'],$current_user->roles);
if($roleManage['front_ticket_all'] || count($allowed_roles)>0){?>
    <div id="wpsp_user_welcome">
        <?php if($advancedSettings['logout_Settings']==1){
        echo(__("Welcome", 'wp-support-plus-responsive-ticket-system').' <b>' . $current_user->display_name .'</b>'.'.');
        ?>
        <?php wp_loginout($_SERVER['REQUEST_URI']);} ?>
    </div><br>
    <div id="wpsp_dash_ticket_stat">
        <h4><?php echo(__("Ticket Statistics", 'wp-support-plus-responsive-ticket-system'));?></h4>
        <?php include( WCE_PLUGIN_DIR.'includes/admin/getFrontDashboardStatistics.php' );?>
    </div>
<?php } ?> 
