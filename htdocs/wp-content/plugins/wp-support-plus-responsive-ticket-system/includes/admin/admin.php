<?php 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

final class WPSupportPlusAdmin {
	
	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'loadScripts') );
		add_action( 'admin_menu', array($this,'custom_menu_page') );		
	}
	
	function loadScripts(){
            $advancedSettings=get_option( 'wpsp_advanced_settings');
            wp_enqueue_script( 'jquery' );
            wp_enqueue_script( 'jquery-ui-core' );
            wp_enqueue_script( 'jquery-ui-dialog' );
            wp_enqueue_style ( 'wp-jquery-ui-dialog' );
            wp_enqueue_script('wpsp_admin', WCE_PLUGIN_URL.'asset/js/admin.js?version='.WPSP_VERSION);
            wp_enqueue_style("jquery-ui-css", WCE_PLUGIN_URL . 'asset/css/jquery-ui.min.css?version='.WPSP_VERSION);
            wp_enqueue_style("jquery-ui-structure-css", WCE_PLUGIN_URL . 'asset/css/jquery-ui.structure.min.css?version='.WPSP_VERSION);
            wp_enqueue_style("jquery-ui-theme-css", WCE_PLUGIN_URL . 'asset/css/jquery-ui.theme.min.css?version='.WPSP_VERSION);
            if($advancedSettings['enable_accordion']==1){
                wp_enqueue_script( 'jquery-ui-accordion' );
            }
            wp_enqueue_style('wpce_admin', WCE_PLUGIN_URL . 'asset/css/admin.css?version='.WPSP_VERSION);
            wp_enqueue_script('jquery-ui-datepicker');
	}
	
	function custom_menu_page(){
		$advancedSettings=get_option( 'wpsp_advanced_settings' );
		add_menu_page( 'WP Support Plus', $advancedSettings['wpsp_dashboard_menu_label'], 'manage_support_plus_ticket', 'wp-support-plus', array($this,'tickets'),WCE_PLUGIN_URL.'asset/images/support.png', '51.66' );
		add_submenu_page( 'wp-support-plus', 'WP Support Plus FAQ',  __('FAQ','wp-support-plus-responsive-ticket-system'), 'manage_support_plus_agent', 'wp-support-plus-faq', array($this,'faq') );
		add_submenu_page( 'wp-support-plus', 'WP Support Plus Canned Reply',  __('Canned Reply','wp-support-plus-responsive-ticket-system'), 'manage_support_plus_ticket', 'wp-support-plus-Canned-Reply', array($this,'canned_reply') );
                add_submenu_page( 'wp-support-plus', 'WP Support Plus Statistics', __('Statistics','wp-support-plus-responsive-ticket-system'), 'manage_support_plus_agent', 'wp-support-plus-statistics', array($this,'statistics') );
		add_submenu_page( 'wp-support-plus', 'WP Support Plus Settings', __('Settings','wp-support-plus-responsive-ticket-system'), 'manage_options', 'wp-support-plus-settings', array($this,'settings') );
		add_submenu_page( 'wp-support-plus', 'WP Support Plus Advanced Settings', __('Advanced Settings','wp-support-plus-responsive-ticket-system'), 'manage_options', 'wp-support-plus-advanced-settings', array($this,'advancedsettings') );
		add_submenu_page( 'wp-support-plus', 'WP Support Plus Email Templates', __('Email Templates','wp-support-plus-responsive-ticket-system'), 'manage_options', 'wp-support-plus-email-templates', array($this,'email_templates') );
                add_submenu_page( 'wp-support-plus', 'WP Support Plus Add-ons', __('Add-ons','wp-support-plus-responsive-ticket-system'), 'manage_options', 'wp-support-plus-add-ons', array($this,'addons') );
		add_submenu_page( 'wp-support-plus', 'WP Support Plus Support', __('Doc & Support','wp-support-plus-responsive-ticket-system'), 'manage_options', 'wp-support-plus-support', array($this,'support') );
	}
	
	function tickets(){
            $advancedSettings=get_option( 'wpsp_advanced_settings' );
            //Load Bootstrap

            wp_enqueue_script('wpce_bootstrap', WCE_PLUGIN_URL . 'asset/js/bootstrap/js/bootstrap.min.js?version='.WPSP_VERSION);
            wp_enqueue_style('wpce_bootstrap', WCE_PLUGIN_URL . 'asset/js/bootstrap/css/bootstrap.min.css?version='.WPSP_VERSION);
            wp_enqueue_script('wpce_display_ticket', WCE_PLUGIN_URL . 'asset/js/display_ticket.js?version='.WPSP_VERSION);

            wp_enqueue_style('wpce_display_ticket', WCE_PLUGIN_URL . 'asset/css/display_ticket.css?version='.WPSP_VERSION);
            
            $confirmsg=apply_filters('wpsp_change_confirm_msg_backend','Are you sure to submit?');
            
            $localize_script_data=array(
                'wpsp_ajax_url'=>admin_url( 'admin-ajax.php' ),
                'wpsp_site_url'=>site_url(),
                'plugin_url'=>WCE_PLUGIN_URL,
                'plugin_dir'=>WCE_PLUGIN_DIR,
                'insert_all_required'=>__('Please Enter all required fields','wp-support-plus-responsive-ticket-system'),
                'reply_not_empty'=>__('Reply can not be empty!','wp-support-plus-responsive-ticket-system'),
                'sure_to_delete'=>__('Are you sure to delete this ticket?','wp-support-plus-responsive-ticket-system'),
                'sure_to_clone'=>__('Are you sure to clone this ticket?','wp-support-plus-responsive-ticket-system'),
                'sure_to_delete_mult'=>__('Are you sure to delete these tickets?','wp-support-plus-responsive-ticket-system'),
                'can_not_undone'=>__('Can not be undone','wp-support-plus-responsive-ticket-system'),
                'reply_ticket_position'=>$advancedSettings['wpsp_reply_form_position'],
                'wpsp_shortcode_used_in'=>$advancedSettings['wpsp_shortcode_used_in'],
                'enable_accordion'=>$advancedSettings['enable_accordion'],
                'ticketId'=>$advancedSettings['ticketId'],
                'clone_succes'=>__('Clone Ticket ID:','wp-support-plus-responsive-ticket-system'),
                'sure_to_close_status'=>__('Are you sure?','wp-support-plus-responsive-ticket-system'),
                'close_status_succes'=>__('Close Ticket ID:','wp-support-plus-responsive-ticket-system'),
                'Not_valid_email_address'=>__('Please enter valid email address!','wp-support-plus-responsive-ticket-system'),
                'not_applicable'=>__('Not Applicable','wp-support-plus-responsive-ticket-system'),
                'wpsp_redirect_after_ticket_update'=>$advancedSettings['wpsp_redirect_after_ticket_update'],
                'sure_to_submit_ticket'=>__($confirmsg,'wp-support-plus-responsive-ticket-system'),
                'sure_to_submit_note'=>__('Are you sure to add note?','wp-support-plus-responsive-ticket-system'),
                'wpspAttachMaxFileSize'=>$advancedSettings['wpspAttachMaxFileSize'],
                'wpspAttachFileSizeExeeded'=>__('File Size limit exceeded! Allowed limit:','wp-support-plus-responsive-ticket-system').' '.$advancedSettings['wpspAttachMaxFileSize'].__('MB','wp-support-plus-responsive-ticket-system'),
                'wpspRemoveAttachment'=>__('Remove','wp-support-plus-responsive-ticket-system'),
                'wait_until_upload'=>__('Uploading attachment, please wait!','wp-support-plus-responsive-ticket-system'),
                'reset_form'=>__('Reset form data??','wp-support-plus-responsive-ticket-system'),
                'sure_to_delete_thread'=>__('Are you sure to delete this thread?','wp-support-plus-responsive-ticket-system'),
                'wpspAttachment_bc'=>$advancedSettings['wpspAttachment_bc'],                 
                'wpspAttachment_pc'=>$advancedSettings['wpspAttachment_pc'],
                'sure_to_restore_ticket'=>__('Are you sure to restore ticket?','wp-support-plus-responsive-ticket-system')
            );
            wp_localize_script( 'wpce_display_ticket', 'display_ticket_data', $localize_script_data );

            wp_enqueue_script('wpce_ckeditor_editor', WCE_PLUGIN_URL . 'asset/lib/ckeditor/ckeditor.js?version='.WPSP_VERSION);
            wp_enqueue_script('wpce_ckeditor_jquery_adapter', WCE_PLUGIN_URL . 'asset/lib/ckeditor/adapters/jquery.js?version='.WPSP_VERSION);

            global $current_user;
            $current_user=wp_get_current_user();
            $generalSettings=get_option( 'wpsp_general_settings' );
            $this->check_offer();
            ?>
            <div class="panel panel-primary wpsp_admin_panel">
              <div class="panel-heading">
                <h3 class="panel-title"><?php _e('WP Support Plus','wp-support-plus-responsive-ticket-system');?></h3>
                <span class="wpsp_support_admin_welcome"><?php echo __('Welcome','wp-support-plus-responsive-ticket-system').", ".$current_user->display_name;?></span>
              </div>
              <div class="panel-body">
                <?php include( WCE_PLUGIN_DIR.'includes/admin/display_ticket.php' );?>
              </div>
            </div>
            <?php 
            do_action('wpsp_tickets_end_backend');
	}
        
        function addons(){
            $this->check_offer();
            include( WCE_PLUGIN_DIR.'includes/admin/add_ons.php' );
        }
	
	function settings(){
		//Load Bootstrap
		wp_enqueue_script('wpce_bootstrap', WCE_PLUGIN_URL . 'asset/js/bootstrap/js/bootstrap.min.js?version='.WPSP_VERSION);
		wp_enqueue_style('wpce_bootstrap', WCE_PLUGIN_URL . 'asset/js/bootstrap/css/bootstrap.min.css?version='.WPSP_VERSION);
		wp_enqueue_script('wpce_admin_settings', WCE_PLUGIN_URL . 'asset/js/admin_settings.js?version='.WPSP_VERSION);
		wp_enqueue_style('wpce_admin_settings', WCE_PLUGIN_URL . 'asset/css/admin_settings.css?version='.WPSP_VERSION);
		
                $pipe_active=0;
                if(class_exists('WPSupportPlusEmailPipe')){
                    $pipe_active=1;
                }
                
		$localize_script_data=array(
				'wpsp_ajax_url'=>admin_url( 'admin-ajax.php' ),
				'wpsp_site_url'=>site_url(),
				'plugin_url'=>WCE_PLUGIN_URL,
				'plugin_dir'=>WCE_PLUGIN_DIR,
				'insert_cat_name'=>__('Please insert category name!','wp-support-plus-responsive-ticket-system'),
				'insert_admin_email_add'=>__('Please insert adminstrator email address!','wp-support-plus-responsive-ticket-system'),
				'insert_menu_text'=>__('Please insert menu text','wp-support-plus-responsive-ticket-system'),
				'insert_redirection_url'=>__('Please insert Redirect URL','wp-support-plus-responsive-ticket-system'),
				'sure'=>__('Are you sure?','wp-support-plus-responsive-ticket-system'),
				'insert_field_label'=>__('Please insert field label!','wp-support-plus-responsive-ticket-system'),
				'insert_field_options'=>__('Please insert field options!','wp-support-plus-responsive-ticket-system'),
                                'select_user'=>__('Please select user','wp-support-plus-responsive-ticket-system'),
                                'test_imap_error'=>__('Please test your IMAP connection first!','wp-support-plus-responsive-ticket-system'),
                                'pipe_active'=>$pipe_active
		);
		wp_localize_script( 'wpce_admin_settings', 'display_ticket_data', $localize_script_data );
		
		add_thickbox();
		$this->check_offer();
		?>
		<div class="panel panel-primary wpsp_admin_panel" >
		  <div class="panel-heading">
		    <h3 class="panel-title"><?php _e('WP Support Plus Settings','wp-support-plus-responsive-ticket-system');?></h3>
		  </div>
		  <div class="panel-body">
		    <?php include( WCE_PLUGIN_DIR.'includes/admin/admin_settings.php' );?>
		  </div>
		</div>
		<?php 
	}

	function advancedsettings(){
		//Load Bootstrap
		wp_enqueue_script('wpce_bootstrap', WCE_PLUGIN_URL . 'asset/js/bootstrap/js/bootstrap.min.js?version='.WPSP_VERSION);
		wp_enqueue_style('wpce_bootstrap', WCE_PLUGIN_URL . 'asset/js/bootstrap/css/bootstrap.min.css?version='.WPSP_VERSION);
		wp_enqueue_script( 'my-jquery-ui' );
		wp_enqueue_script('jquery-ui-dropable');
   		wp_enqueue_script('jquery-ui-dragable');
   		wp_enqueue_script('jquery-ui-selectable');
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script('wpce_advanced_settings', WCE_PLUGIN_URL . 'asset/js/advanced_settings.js?version='.WPSP_VERSION);
		wp_enqueue_style('wpce_advanced_settings', WCE_PLUGIN_URL . 'asset/css/admin_settings.css?version='.WPSP_VERSION);
		wp_enqueue_script('jquery-ui-datepicker');
                wp_enqueue_style('wpce_admin', WCE_PLUGIN_URL . 'asset/css/jquery-ui.css?version='.WPSP_VERSION);
		
                $localize_script_data=array(
                    'wpsp_ajax_url'=>admin_url( 'admin-ajax.php' ),
                    'wpsp_site_url'=>site_url(),
                    'plugin_url'=>WCE_PLUGIN_URL,
                    'plugin_dir'=>WCE_PLUGIN_DIR,
                    'insert_cat_name'=>__('Please insert category name!','wp-support-plus-responsive-ticket-system'),
                    'insert_admin_email_add'=>__('Please insert adminstrator email address!','wp-support-plus-responsive-ticket-system'),
                    'insert_menu_text'=>__('Please insert menu text','wp-support-plus-responsive-ticket-system'),
                    'insert_redirection_url'=>__('Please insert Redirect URL','wp-support-plus-responsive-ticket-system'),
                    'sure'=>__('Are you sure?','wp-support-plus-responsive-ticket-system'),
                    'insert_field_label'=>__('Please insert field label!','wp-support-plus-responsive-ticket-system'),
                    'custom_status_warning'=>__(' All the tickets belonging to this status will get moved to pending status','wp-support-plus-responsive-ticket-system'),
                    'insert_integer_value'=>__('Please insert integer value','wp-support-plus-responsive-ticket-system'),
                    'custom_priority_warning'=>__(' All the tickets belonging to this priority will get moved to normal priority','wp-support-plus-responsive-ticket-system'),
                    'export_date_missing'=>__('Missing From date or To date!','wp-support-plus-responsive-ticket-system'),
                    'select_image'=>__('Please select at least one image!','wp-support-plus-responsive-ticket-system')
                    
		);
		wp_localize_script( 'wpce_advanced_settings', 'display_ticket_data', $localize_script_data );
		wp_enqueue_script('wpce_ckeditor_editor', WCE_PLUGIN_URL . 'asset/lib/ckeditor/ckeditor.js?version='.WPSP_VERSION);
		wp_enqueue_script('wpce_ckeditor_jquery_adapter', WCE_PLUGIN_URL . 'asset/lib/ckeditor/adapters/jquery.js?version='.WPSP_VERSION);
		$this->check_offer();
		?>
		<div class="panel panel-primary wpsp_admin_panel" >
		  <div class="panel-heading">
		    <h3 class="panel-title"><?php _e('WP Support Plus Settings','wp-support-plus-responsive-ticket-system');?></h3>
		  </div>
		  <div class="panel-body">
		    <?php include( WCE_PLUGIN_DIR.'includes/admin/advanced_settings.php' );?>
		  </div>
		</div>
		<?php
	}
	
	function support(){
		$this->check_offer();
                
                wp_enqueue_script('wpce_admin_settings', WCE_PLUGIN_URL . 'asset/js/admin_settings.js?version='.WPSP_VERSION);
                $localize_script_data=array(
				'wpsp_ajax_url'=>admin_url( 'admin-ajax.php' ),
				'wpsp_site_url'=>site_url(),
				'plugin_url'=>WCE_PLUGIN_URL,
				'plugin_dir'=>WCE_PLUGIN_DIR
		);
                wp_localize_script( 'wpce_admin_settings', 'display_ticket_data', $localize_script_data );
		?>
                <br>
                <p class="wpsp_support_page_paragraph">Please check <b><a target="_blank" href="https://www.wpsupportplus.com/documentation/">Documentation</a></b> before creating Support Ticket.</p>
                <p class="wpsp_support_page_paragraph"><b><a target="_blank" href="https://www.wpsupportplus.com/support/">Click here</a></b> to Create Support Ticket for <b>WP Support Plus</b>. Support ticket is one to one conversation between you and our support team. Here we are offering priority support to our customers who purchased at least one add-on.</p>
                <p class="wpsp_support_page_paragraph">If you want free support, please create new topic to our wordpress.org on <a href="https://wordpress.org/support/plugin/wp-support-plus-responsive-ticket-system" target="_blank">this page</a>. If you have any pre-sale question or want to contact privately, please like our <a href="https://www.facebook.com/wpsupportplus/" target="_blank">Facebook Page</a> and send private message.</p>
                
                    
                <div id="wpsp_support_backup" class="wpsp_support_backup">
                    <h2>System Information</h2>
                    We are always there to help you. If you have any issue regarding WP Support Plus plugin,<br>
                    please create a system information file by clicking below button and send us the file while creating ticket. <br>
                    We will try our best to solve your issue.
                    The system information file have following information
                    <ul>
                        <li>Server Information</li>
                        <li>WP Support Plus settings</li>
                        <li>Active plugins on the server</li>
                        <li>Active theme</li>
                    </ul>
                    <button class="btn btn-success" id="wpsp_take_settings_backup" onclick="setwpspSettingsBackup();"><?php _e('Download WPSP System info','wp-support-plus-responsive-ticket-system');?></button>
                    <img id="wpsp_take_settings_backup_wait" style="width: 16px; display: none;" alt="Please Wait" src="<?php echo WCE_PLUGIN_URL.'asset/images/ajax-loader@2x.gif?ver='.WPSP_VERSION;?>">
                    <form id="wpsp_frmDownloadSystemInfo" action="" method="post">
                        <input type="hidden" name="wpsp_system_info" value="1" />
                    </form>
                </div>
                <?php 
	}
	
	function statistics(){
		wp_enqueue_script('wpce_bootstrap', WCE_PLUGIN_URL . 'asset/js/bootstrap/js/bootstrap.min.js?version='.WPSP_VERSION);
		wp_enqueue_style('wpce_bootstrap', WCE_PLUGIN_URL . 'asset/js/bootstrap/css/bootstrap.min.css?version='.WPSP_VERSION);
		$this->check_offer();
		?>
		<div class="panel panel-primary wpsp_admin_panel">
		  <div class="panel-heading">
		    <h3 class="panel-title"><?php _e('WP Support Plus Statistics','wp-support-plus-responsive-ticket-system');?></h3>
		  </div>
		  <div class="panel-body">
		    <?php include( WCE_PLUGIN_DIR.'includes/admin/statistics.php' );?>
		  </div>
		</div>
		<?php 
	}

	function faq(){
		wp_enqueue_script('wpce_bootstrap', WCE_PLUGIN_URL . 'asset/js/bootstrap/js/bootstrap.min.js?version='.WPSP_VERSION);
		wp_enqueue_style('wpce_bootstrap', WCE_PLUGIN_URL . 'asset/js/bootstrap/css/bootstrap.min.css?version='.WPSP_VERSION);
                $this->check_offer();
		?>
		<div class="panel panel-primary wpsp_admin_panel">
		  <div class="panel-heading">
		    <h3 class="panel-title"><?php _e('WP Support Plus FAQ','wp-support-plus-responsive-ticket-system');?></h3>
		  </div>
		  <div class="panel-body">
		    <?php include( WCE_PLUGIN_DIR.'includes/admin/faq.php' );?>
		  </div>
		</div>
		<?php
	}
	
	function email_templates(){
		wp_enqueue_script('wpce_bootstrap', WCE_PLUGIN_URL . 'asset/js/bootstrap/js/bootstrap.min.js?version='.WPSP_VERSION);
		wp_enqueue_style('wpce_bootstrap', WCE_PLUGIN_URL . 'asset/js/bootstrap/css/bootstrap.min.css?version='.WPSP_VERSION);
		wp_enqueue_style('wpce_advanced_settings', WCE_PLUGIN_URL . 'asset/css/admin_settings.css?version='.WPSP_VERSION);
		wp_enqueue_script('wpce_email_template_settings', WCE_PLUGIN_URL . 'asset/js/email_template.js?version='.WPSP_VERSION);
		$localize_script_data=array(
				'wpsp_ajax_url'=>admin_url( 'admin-ajax.php' ),
				'wpsp_site_url'=>site_url(),
				'plugin_url'=>WCE_PLUGIN_URL,
				'plugin_dir'=>WCE_PLUGIN_DIR,
                                'sure_to_reset_setting'=>__('Are you sure to reset this settings?','wp-support-plus-responsive-ticket-system')
		);
		wp_localize_script( 'wpce_email_template_settings', 'display_ticket_data', $localize_script_data );
		wp_enqueue_script('wpce_ckeditor_editor', WCE_PLUGIN_URL . 'asset/lib/ckeditor/ckeditor.js?version='.WPSP_VERSION);
		wp_enqueue_script('wpce_ckeditor_jquery_adapter', WCE_PLUGIN_URL . 'asset/lib/ckeditor/adapters/jquery.js?version='.WPSP_VERSION);
		$this->check_offer();
		?>
		<div class="panel panel-primary wpsp_admin_panel">
		  <div class="panel-heading">
		    <h3 class="panel-title"><?php _e('Email Templates','wp-support-plus-responsive-ticket-system');?></h3>
		  </div>
		  <div class="panel-body">
		    <?php include( WCE_PLUGIN_DIR.'includes/admin/emailTemplates.php' );?>
		  </div>
		</div>
		<?php
	}
        
        function canned_reply(){
		wp_enqueue_script('wpce_bootstrap', WCE_PLUGIN_URL . 'asset/js/bootstrap/js/bootstrap.min.js?version='.WPSP_VERSION);
		wp_enqueue_style('wpce_bootstrap', WCE_PLUGIN_URL . 'asset/js/bootstrap/css/bootstrap.min.css?version='.WPSP_VERSION);
                wp_enqueue_script('wpce_canned_reply', WCE_PLUGIN_URL . 'asset/js/canned.js?version='.WPSP_VERSION);
                wp_enqueue_style('wpce_admin', WCE_PLUGIN_URL . 'asset/css/admin.css?version='.WPSP_VERSION);
                $localize_script_data=array(
				'wpsp_ajax_url'=>admin_url( 'admin-ajax.php' ),
				'wpsp_site_url'=>site_url(),
				'plugin_url'=>WCE_PLUGIN_URL,
				'plugin_dir'=>WCE_PLUGIN_DIR,
                                'insert_canned_reply_title'=>__('Please enter Canned reply title!','wp-support-plus-responsive-ticket-system')
		);
                wp_localize_script( 'wpce_canned_reply', 'display_ticket_data', $localize_script_data );
                wp_enqueue_script('wpce_ckeditor_editor', WCE_PLUGIN_URL . 'asset/lib/ckeditor/ckeditor.js?version='.WPSP_VERSION);                
                wp_enqueue_script('wpce_ckeditor_jquery_adapter', WCE_PLUGIN_URL . 'asset/lib/ckeditor/adapters/jquery.js?version='.WPSP_VERSION);
		$this->check_offer();
		?>
		<div class="panel panel-primary wpsp_admin_panel">
		  <div class="panel-heading">
		    <h3 class="panel-title"><?php _e('WP Support Plus Canned Reply','wp-support-plus-responsive-ticket-system');?></h3>
		  </div>
		  <div class="panel-body">
		    <?php include( WCE_PLUGIN_DIR.'includes/admin/canned.php' );?>
		  </div>
		</div>
		<?php
	}
        
        function check_offer(){
            if(!$this->is_addon_activated()){
                include( WCE_PLUGIN_DIR.'includes/admin/offer.php' );
            }
        }
        
        function is_addon_activated(){
            $addons = array(
                'WPSupportPlusEmailPipe',
                'WPSupportPlusWoocommerce',
                'WPSupportPlusExportTicket',
                'WPSP_EDD',
                'WPSP_TIMER',
                'WPSP_COMPANY',
                'WPSP_CANNED_REPLY',
                'WPSP_GOOGLE_CAL_EVENT',
                'WPSP_STICK_TICKET',
                'WPSP_CONDITIONAL_AGENT_ASSIGN'
            );
            $flag = FALSE;
            foreach ($addons as $addon){
                if(class_exists($addon)){
                    $flag = TRUE;
                    break;
                }
            }
            return $flag;
        }

}

$GLOBALS['WPSupportPlusAdmin'] =new WPSupportPlusAdmin();
?>
