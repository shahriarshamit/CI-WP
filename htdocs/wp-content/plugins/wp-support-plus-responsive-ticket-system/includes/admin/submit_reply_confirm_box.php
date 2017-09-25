<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
<div id="wpsp_reply_confirm">
  <?php _e('Submit Reply?','wp-support-plus-responsive-ticket-system');?>
</div>
<script>
    jQuery('document').ready(function(){
        jQuery( "#wpsp_reply_confirm" ).dialog({
            resizable: false,
            autoOpen: false,
            height: "auto",
            width: 400,
            modal: true,
            dialogClass: "wpsp-dialog",
            buttons: {
              "<?php _e('Cancel','wp-support-plus-responsive-ticket-system');?>": function() {
                jQuery( this ).dialog( "close" );
              },
              "<?php _e('OK','wp-support-plus-responsive-ticket-system');?>": function() {
                jQuery( this ).dialog( "close" );
                wpsp_replyTicket();
              }
            }
        });
    });
    
    function wpsp_replyTicketConfirm(e){
        e.preventDefault();
        if(validateReplyTicketSubmit()){
            jQuery( "#wpsp_reply_confirm" ).dialog('open');
        }
    }
    
</script>