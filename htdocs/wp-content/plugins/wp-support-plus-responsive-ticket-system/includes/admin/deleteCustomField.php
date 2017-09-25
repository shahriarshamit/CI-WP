<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 
global $wpdb;
$field_id= intval(sanitize_text_field($_POST['field_id']));
$cu = wp_get_current_user();
if ($cu->has_cap('manage_options')) {
    
        $isVariable=$wpdb->get_var("select isVarFeild from ".$wpdb->prefix.'wpsp_custom_fields'." where id=".$field_id);
        
	$wpdb->delete($wpdb->prefix.'wpsp_custom_fields',array('id'=>$field_id));
	
	$sql = "ALTER TABLE `{$wpdb->prefix}wpsp_ticket` DROP `cust".$field_id."`";
	$wpdb->query($sql);
	
	$advancedSettingsFieldOrder=get_option( 'wpsp_advanced_settings_field_order' );
	if(isset($advancedSettingsFieldOrder['fields_order']) && $isVariable==0){
		array_splice($advancedSettingsFieldOrder['fields_order'], array_search($field_id, $advancedSettingsFieldOrder['fields_order']), 1);
		update_option('wpsp_advanced_settings_field_order',$advancedSettingsFieldOrder);
	}
        
        if(isset($advancedSettingsFieldOrder['display_fields']) && array_search($field_id, $advancedSettingsFieldOrder['display_fields']) > -1){
             unset($advancedSettingsFieldOrder['display_fields'][array_search($field_id, $advancedSettingsFieldOrder['display_fields'])]);
             update_option('wpsp_advanced_settings_field_order',$advancedSettingsFieldOrder);
        }
        
	$advancedSettingsTicketList=get_option( 'wpsp_advanced_settings_ticket_list_order' );
	if(isset($advancedSettingsTicketList['backend_ticket_list']) && $advancedSettingsTicketList['backend_ticket_list']){
		unset($advancedSettingsTicketList['backend_ticket_list'][$field_id]);
		unset($advancedSettingsTicketList['frontend_ticket_list'][$field_id]);
		update_option('wpsp_advanced_settings_ticket_list_order',$advancedSettingsTicketList);
	}
	
	$wpsp_et_create_new_ticket=get_option( 'wpsp_et_create_new_ticket' );
	unset($wpsp_et_create_new_ticket['templates']['cust'.$field_id]);
	update_option('wpsp_et_create_new_ticket',$wpsp_et_create_new_ticket);
	
	$wpsp_et_reply_ticket=get_option( 'wpsp_et_reply_ticket' );
	unset($wpsp_et_reply_ticket['templates']['cust'.$field_id]);
	update_option('wpsp_et_reply_ticket',$wpsp_et_reply_ticket);
        
        apply_filters('wpsp_in_deletecustomfield_filter',$field_id);
}
?>
