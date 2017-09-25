<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$cu = wp_get_current_user();
if (!$cu->has_cap('manage_options')) exit; // Exit if current user is not admin

global $wpdb;

$wpsp_et_change_ticket_status=get_option( 'wpsp_et_change_ticket_status' );
$advancedSettings=get_option( 'wpsp_advanced_settings' );
//$ticket_label= $advancedSettings['default_main_ticket_label'];
//$tickets_label= $advancedSettings['default_main_tickets_label'];
?>
<br>
<span class="label label-info wpsp_title_label">
<?php _e("Available Templates", 'wp-support-plus-responsive-ticket-system' );?>
</span><br><br>
<div class='template_display'>
<?php 
foreach ($wpsp_et_change_ticket_status['templates'] as $key=>$val){
	echo '{'.$key.'} - '.__($val,'wp-support-plus-responsive-ticket-system').'<br>';
}
?>
</div>
<hr>
<br>
<form id='frmETChangeTicketStatus'>
	<span class="label label-info wpsp_title_label">
	<?php _e("Change Status Notification Email", 'wp-support-plus-responsive-ticket-system' );?>
	</span><br><br>
	<table class='wpsp_et_role_tbl'>
	  <tr>
	  	<th><?php _e("Applicable Users", 'wp-support-plus-responsive-ticket-system' );?></th>
	  	<th><?php _e("Enable", 'wp-support-plus-responsive-ticket-system' );?></th>
	  	<th><?php _e("Disable", 'wp-support-plus-responsive-ticket-system' );?></th>
	  </tr>
	  <tr>
	  	<td>
	  		<?php _e("Customer", 'wp-support-plus-responsive-ticket-system' );?><br>
	  		<small><i>(<?php _e($advancedSettings['ticket_label_alice'][13], 'wp-support-plus-responsive-ticket-system' );?>)</i></small>
	  	</td>
	    <td><input type="radio" name='etEnableCustomer' value="1" <?php echo ($wpsp_et_change_ticket_status['notify_to']['customer'])?'checked':'';?>></td>
	    <td><input type="radio" name='etEnableCustomer' value="0" <?php echo ($wpsp_et_change_ticket_status['notify_to']['customer'])?'':'checked';?>></td>    
	  </tr>
	  <tr>
	  	<td>
	  		<?php _e("Administrator", 'wp-support-plus-responsive-ticket-system' );?><br>
	  		<small><i>(<?php _e("Administrator Emails set in Email Notification Settings", 'wp-support-plus-responsive-ticket-system' );?>)</i></small>
	  	</td>
	    <td><input type="radio" name='etEnableStaffAdmin' value="1" <?php echo ($wpsp_et_change_ticket_status['notify_to']['administrator'])?'checked':'';?>></td>
	    <td><input type="radio" name='etEnableStaffAdmin' value="0" <?php echo ($wpsp_et_change_ticket_status['notify_to']['administrator'])?'':'checked';?>></td>    
	  </tr>
	  <tr>
	  	<td><?php _e("Supervisor", 'wp-support-plus-responsive-ticket-system' );?></td>
	    <td><input type="radio" name='etEnableStaffSupervisor' value="1" <?php echo ($wpsp_et_change_ticket_status['notify_to']['supervisor'])?'checked':'';?>></td>
	    <td><input type="radio" name='etEnableStaffSupervisor' value="0" <?php echo ($wpsp_et_change_ticket_status['notify_to']['supervisor'])?'':'checked';?>></td>    
	  </tr>
	  <tr>
	  	<td>
	  		<?php _e("Assigned Agents", 'wp-support-plus-responsive-ticket-system' );?><br>
	  		<small><i>(<?php _e("Agents pre-assigned to category", 'wp-support-plus-responsive-ticket-system' );?>)</i></small>
	  	</td>
	    <td><input type="radio" name='etEnableStaffAssignedAgent' value="1" <?php echo ($wpsp_et_change_ticket_status['notify_to']['assigned_agent'])?'checked':'';?>></td>
	    <td><input type="radio" name='etEnableStaffAssignedAgent' value="0" <?php echo ($wpsp_et_change_ticket_status['notify_to']['assigned_agent'])?'':'checked';?>></td>    
	  </tr>
	  <tr>
	  	<td><?php _e("All Agents", 'wp-support-plus-responsive-ticket-system' );?></td>
	    <td><input type="radio" name='etEnableStaffAllAgent' value="1" <?php echo ($wpsp_et_change_ticket_status['notify_to']['all_agents'])?'checked':'';?>></td>
	    <td><input type="radio" name='etEnableStaffAllAgent' value="0" <?php echo ($wpsp_et_change_ticket_status['notify_to']['all_agents'])?'':'checked';?>></td>    
	  </tr>
	</table><br>
        <b><?php _e("Subject", 'wp-support-plus-responsive-ticket-system' );?>:</b>
        [<?php echo __($advancedSettings['ticket_label_alice'][1],'wp-support-plus-responsive-ticket-system');?> <?php echo $advancedSettings['wpsp_ticket_id_prefix'];?>] <input type="text" id='wpsp_et_change_ticket_status_suject' name='wpsp_et_change_ticket_status_suject' style="width: 50%;" value='<?php echo htmlspecialchars(stripcslashes($wpsp_et_change_ticket_status['mail_subject']), ENT_QUOTES);?>'/><br>
        <b><?php _e("Body", 'wp-support-plus-responsive-ticket-system' );?>:</b><br>
	<textarea id='wpsp_et_change_ticket_status_body' name='wpsp_et_change_ticket_status_body'><?php echo stripcslashes($wpsp_et_change_ticket_status['mail_body']);?></textarea>
	<hr>
	<button id="wpsp_save_et_cteate_new_ticket" type="submit" class="btn btn-success"><?php _e("Save Settings", 'wp-support-plus-responsive-ticket-system' );?></button>
        <button id="wpsp_reset_et_change_ticket_status" onclick="resetETChangeTicketStatus(event);" type="submit" class="btn btn-success"><?php _e("Reset Settings", 'wp-support-plus-responsive-ticket-system' );?></button>
</form>
