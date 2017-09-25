<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
global $wpdb;
$upload_dir = wp_upload_dir();
$path_to_export=$upload_dir['basedir'].'/wpsp_backup_settings.txt';
$url_to_export=$upload_dir['baseurl'].'/wpsp_backup_settings.txt';
$divider="------------------------------------------------------------------------------------------";
$filename=$path_to_export;
$fp=fopen($filename,"w");

$content = "Server Information";
//php version
$php_ver='Current PHP version: ' . phpversion().PHP_EOL;

//mysql version
$output = shell_exec('mysql -V'); 
preg_match('@[0-9]+\.[0-9]+\.[0-9]+@', $output, $version); 
$mysql_ver='Current MySQL version: '.$version[0].PHP_EOL.$divider; 

$is_multi=is_multisite() ? 'Yes': 'No';
$wordpress='Wordpress Version: '. get_bloginfo( 'version' ) ;
$imap_loaded=extension_loaded ('imap')?'Yes':'No';
$is_imap_loaded='IMAP Loaded: '.$imap_loaded;
$site_info='Site Info: '.PHP_EOL.'Multisite: '.$is_multi.PHP_EOL.$wordpress.PHP_EOL.$is_imap_loaded.PHP_EOL.$divider;

//active plugins
$strplugins="Active Plugins ".PHP_EOL;
$active=get_option('active_plugins');
$plugins=get_plugins();
$activated_plugins=array();
foreach ($active as $p){           
    if(isset($plugins[$p])){
         array_push($activated_plugins, $plugins[$p]);
    }           
}
for($i=0;$i<count($activated_plugins);$i++){
    $strplugins.=$activated_plugins[$i]['Name'].'(version:'.$activated_plugins[$i]['Version'].')'.PHP_EOL;
}
$strplugins.=PHP_EOL.$divider;

//active theme
$my_theme = wp_get_theme();
$active_theme="Active Theme: ".PHP_EOL."Theme Name: ".$my_theme->get( 'Name' )."(version:".$my_theme->get( 'Version' ).")".PHP_EOL.$divider;

//option table backup

$optkeys=array(
    'wpsp_remove_faulty_indexes',
    'wp_support_plus_version',
    'wpsp_add_table_indexes',
    'wpsp_repair_faulty_indexes',
    'wpsp_general_settings',
    'wpsp_email_notification_settings',
    'wpsp_role_management',
    'wpsp_customcss_settings',
    'wpsp_advanced_settings',
    'wpsp_shortcode_used_in_settings',
    'wpsp_advanced_settings_field_order',
    'wpsp_advanced_settings_status_order',
    'wpsp_advanced_settings_priority_order',
    'wpsp_advanced_settings_ticket_list_order',
    'wpsp_ticket_list_date_format',
    'wpsp_advanced_settings_custom_filter_front',
    'wpsp_ticket_list_subject_char_length',
    'wpsp_et_create_new_ticket',
    'wpsp_et_reply_ticket',
    'wpsp_et_change_ticket_status',
    'wpsp_et_change_ticket_assign_agent',
    'wpsp_et_delete_ticket',
    'wpsp_default_status_priority_names',
    'wpsp_ckeditor_settings',
    'wpsp_upload_image_settings',
    'wpsp_front_end_display_settings',
    'wpsp_attachment_random_key',
    'wpsp_ticket_open_page_shortcode',
    'wpsp_imap_pipe_list',
    'date_format',
    'users_can_register',
    'wpsp_license_key_emailpipe',
    'wpsp_license_key_woo',
    'wpsp_license_key_exportticket',
    'wpsp_license_key_edd',
    'wpsp_license_key_company',
    'wpsp_license_key_timer',
    'wpsp_license_key_gcal',
    'wpsp_license_key_acan'
);
if(class_exists('WPSupportPlusEmailPipe')){
    $optkeys[]='wpsp_email_pipe_ignore_incomming_email';
    $optkeys[]='wpsp_email_pipe_ignore_incomming_email_subject';
    $optkeys[]='wpsp_email_pipe_version';
    $optkeys[]='wpsp_plugin_reloaded_date';
    
}
if(class_exists('WPSP_CANNED_REPLY')){
    $optkeys[]='wpsp_canned_reply_template';
}
if(class_exists('WPSP_COMPANY')){
    $optkeys[]='wp_support_plus_company_version';
}
if(class_exists('WPSP_EDD')){
    $optkeys[]='wp_support_plus_edd_version';
}
if(class_exists('WPSupportPlusExportTicket')){
    $optkeys[]='wpsp_export_ticket_version';
}
if(class_exists('WPSP_TIMER')){
    $optkeys[]='wpsp_timer_settings';
}
if(class_exists('WPSupportPlusWoocommerce')){
    $optkeys[]='wpsp_woo_settings';
    $optkeys[]='wpsp_woocommerce_version';
}
$opt_queries="Support Plus Options ".PHP_EOL;

foreach ($optkeys as $key){
    $key_del=$key_insert="";
    $user_option=$wpdb->get_row("select * from {$wpdb->prefix}options where option_name='".$key."'");
    $key_insert="";
    if(!empty($user_option)){
        $key_del="DELETE FROM `wp_options` WHERE `wp_options`.`option_name`='".$key."';";
        $key_insert="INSERT INTO `wp_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES (".$user_option->option_id.", '".$key."','".$user_option->option_value."', 'yes');";
        $opt_queries.=$key_del.PHP_EOL.$key_insert.PHP_EOL.PHP_EOL;
    }
}
$opt_queries.=$divider;

//Category Backup
$del_cat="TRUNCATE TABLE wp_wpsp_catagories;";

$cat_values=array();
$get_category=$wpdb->get_results("select * from {$wpdb->prefix}wpsp_catagories");
if(!empty($get_category)){
    foreach ($get_category as $cat){
       $str="(".$cat->id.",'".$cat->name."','".$cat->default_assignee."')";
       $cat_values[]=$str;
    }
}

$categories="INSERT INTO `wp_wpsp_catagories` (`id`, `name`, `default_assignee`) VALUES ";
$values=  implode(',', $cat_values);
$categories.=$values.";";
$category_queries="Support Plus Categories:".PHP_EOL.$del_cat.PHP_EOL.$categories.PHP_EOL.$divider;

//Custom Status Backup
$del_status="TRUNCATE TABLE wp_wpsp_custom_status;";
$status_values=array();
$get_status=$wpdb->get_results("select * from {$wpdb->prefix}wpsp_custom_status");
if(!empty($get_status)){
    foreach ($get_status as $status){
       $str="(".$status->id.",'".$status->name."','".$status->color."')";
       $status_values[]=$str;
    }
}
$statues="INSERT INTO `wp_wpsp_custom_status` (`id`, `name`, `color`) VALUES ";
$values=  implode(',', $status_values);
$statues.=$values.";";
$status_queries="Support Plus Custom Statuses:".PHP_EOL.$del_status.PHP_EOL.$statues.PHP_EOL.$divider;

//Custom Priority Backup
$del_priority="TRUNCATE TABLE wp_wpsp_custom_priority;";
$priority_values=array();
$get_priority=$wpdb->get_results("select * from {$wpdb->prefix}wpsp_custom_priority");
if(!empty($get_priority)){
    foreach ($get_priority as $priority){
       $str="(".$priority->id.",'".$priority->name."','".$priority->color."')";
       $priority_values[]=$str;
    }
}
$priority="INSERT INTO `wp_wpsp_custom_priority` (`id`, `name`, `color`) VALUES ";
$values=  implode(',', $priority_values);
$priority.=$values.";";
$prioriy_queries="Support Plus Custom Priority:".PHP_EOL.$del_priority.PHP_EOL.$priority.PHP_EOL.$divider;

//Custom Fields
$del_cfields="TRUNCATE TABLE wp_wpsp_custom_fields;";
$cfields_values=array();
$ticket_alter="";
$get_cfields=$wpdb->get_results("select * from {$wpdb->prefix}wpsp_custom_fields");
if(!empty($get_cfields)){
    foreach ($get_cfields as $field){
       $str="(".$field->id.",'".$field->label."','".$field->required."','".$field->field_type."','".$field->field_options."','".$field->field_categories."','".$field->isVarFeild."')";
       $cfields_values[]=$str;
       //add column to ticket table
        $coloums=$wpdb->get_results("SHOW COLUMNS FROM wp_wpsp_ticket like '%cust".$field->id."'");
        if(count($coloums)==0){
            $tq="ALTER TABLE wp_wpsp_ticket ADD cust".$field->id." varchar(50) NULL DEFAULT NULL;";
            $ticket_alter.=$tq.PHP_EOL;
        }
    }
}

$custom_fields="INSERT INTO `wp_wpsp_custom_fields` (`id`, `label`, `required`, `field_type`, `field_options`, `field_categories`, `isVarFeild`) VALUES ";
$values=  implode(',', $cfields_values);
$custom_fields.=$values.";";
$cfields_queries="Support Plus Custom Fields:".PHP_EOL.$ticket_alter.PHP_EOL.$del_cfields.PHP_EOL.$custom_fields.PHP_EOL.$divider;

//Company add-on
$company_queries="";
if(class_exists('WPSP_COMPANY')){
    //Custom Priority Backup
    $del_company="TRUNCATE TABLE wp_wpsp_companies;";
    $comp_values=array();
    $get_comp=$wpdb->get_results("select * from {$wpdb->prefix}wpsp_companies");
    if(!empty($get_comp)){
        foreach ($get_comp as $comp){
           $str="(NULL,'".$comp->name."','".$comp->users."')";
           $comp_values[]=$str;
        }
    }
    $company="INSERT INTO `wp_wpsp_companies` (`id`, `name`, `users`) VALUES ";
    $values=  implode(',', $comp_values);
    $company.=$values.";";
    $company_queries="Support Plus Company:".PHP_EOL.$del_company.PHP_EOL.$company.PHP_EOL;
    
    //add column to ticket table
    $coloums=$wpdb->get_results("SHOW COLUMNS FROM wp_wpsp_ticket like '%cid'");
    if(count($coloums)==0){
        $tq="ALTER TABLE wp_wpsp_ticket ADD cid varchar(50) NULL DEFAULT NULL;";
        $company_queries.=$tq.PHP_EOL;
    }
}


$content=$content.PHP_EOL.$php_ver.PHP_EOL.$mysql_ver.PHP_EOL.$site_info.PHP_EOL.$strplugins.PHP_EOL.$active_theme
        .PHP_EOL.$opt_queries.PHP_EOL.$category_queries.PHP_EOL.$status_queries.
        PHP_EOL.$prioriy_queries.PHP_EOL.$cfields_queries.PHP_EOL.$company_queries;

$myfile = file_put_contents($filename, $content.PHP_EOL , FILE_APPEND | LOCK_EX);
fclose($fp);
echo '{"url_to_export":"'.$url_to_export.'"}';
?>
