<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$cu = wp_get_current_user();
if (!$cu->has_cap('manage_support_plus_ticket')) exit;
?>

<button type="button" class="btn btn-primary" onclick="wpsp_add_canned_reply()"><?php _e("+ Add New",'wp-support-plus-responsive-ticket-system');?></button>
<br><br>
<?php 
global $wpdb;
global $current_user;
$current_user=wp_get_current_user();
$sql="select * from {$wpdb->prefix}wpsp_canned_reply where uID=".$current_user->ID." OR sid LIKE '%".$current_user->ID."%' OR visibility='public'"; 
$canned = $wpdb->get_results( $sql );
?>
<table class="table table-striped table-hover">
	  <tr>
		  <th style="width: 50px;">#</th>
		  <th><?php _e('Title','wp-support-plus-responsive-ticket-system');?></th>
                  <th><?php _e('Created By','wp-support-plus-responsive-ticket-system');?></th>
                  <th><?php _e('Visibility','wp-support-plus-responsive-ticket-system')?></th>
		  <th><?php _e('Action','wp-support-plus-responsive-ticket-system');?></th>
	  </tr>
	  <?php 
          $wpsp_canned_id=0;
	  foreach ($canned as $can){ 
              $canned_author = get_user_by('id', $can->uID);
              ?>
	  	<tr>
                    <td style="width: 50px;"><?php echo ++$wpsp_canned_id;?></td>
                    <td><?php echo sanitize_text_field(stripcslashes($can->title));?></td>
                    <td><?php echo sanitize_text_field($canned_author->display_name);?></td>
                    <td><?php echo sanitize_text_field(ucfirst($can->visibility));?></td>
                    <td><?php
                        if($can->uID==$current_user->ID ){?>                                 
                                <button type=button  class="btn btn-info" onclick="getEditCannedReply(<?php echo intval($can->id);?>)"><?php _e('Edit','wp-support-plus-responsive-ticket-system');?></button>                                 
                                <button class="btn btn-danger" onclick="deletCannedReply(<?php echo intval($can->id);?>);"><?php _e('Delete','wp-support-plus-responsive-ticket-system');?></button><?php                                                          
                            if($can->visibility=='private') { ?>                                 
                                <button class="btn btn-info" id="showcanned" data-toggle="modal" data-target="#Modal" onclick="setCurrentCannedId(<?php echo $can->id;?>,'<?php echo $can->sid;?>');"><?php _e('Share','wp-support-plus-responsive-ticket-system');?></button> <?php                           
                            } ?><?php                          
                        } ?>
                    </td>
	  	</tr>
	  	
	  <?php }?>
</table>
<?php 
if(!$canned){?>
	<div style="text-align: center;"><?php _e("No Reply Found",'wp-support-plus-responsive-ticket-system');?></div>
	<hr>
<?php }?>
<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><?php _e('Canned Reply','wp-support-plus-responsive-ticket-system');?></h4>
            </div>
            <div class="modal-body" id="mydiv">
                <?php 
                  global $wpdb;
                  $sql="select * from {$wpdb->prefix}wpsp_canned_reply where uID=".$current_user->ID;
                  $canned = $wpdb->get_results( $sql );
                ?>
                <?php _e('Users','wp-support-plus-responsive-ticket-system');?>:<br>
                <select id="share_user" multiple="multiple">
		    <?php 
                    $roleManage=get_option( 'wpsp_role_management' );
                    $advancedSettingsFieldOrder=get_option( 'wpsp_advanced_settings_field_order' );
                    $default_labels=$advancedSettingsFieldOrder['default_fields_label'];
                    $agents=array();
                    $agents=array_merge($agents,get_users(array('orderby'=>'display_name','role'=>'wp_support_plus_agent')));
                    $agents=array_merge($agents,get_users(array('orderby'=>'display_name','role'=>'wp_support_plus_supervisor')));
                    $agents=array_merge($agents,get_users(array('orderby'=>'display_name','role'=>'administrator')));
                    foreach($roleManage['agents'] as $agentRole)
                    {
                        $agents=array_merge($agents,get_users(array('orderby'=>'display_name','role'=>$agentRole)));
                    }                     
                    foreach ($agents as $agent){
                        echo '<option value="'.$agent->ID.'" >'.$agent->data->display_name.'</option>';
                    }
                    ?>
                </select><br><br>
                <div class="modal-footer">
                    <button class="btn btn-info" id="share" onclick="setShareCanned();"><?php _e('Share','wp-support-plus-responsive-ticket-system');?></button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php _e('Close','wp-support-plus-responsive-ticket-system');?></button>
                </div>
            </div>
        </div>
    </div>
</div>

