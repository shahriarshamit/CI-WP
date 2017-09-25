<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/* BEGIN CLOUGH I.T. SOLUTIONS MODIFICATION
 * Update 19 - improved registered user search
 * allows wildcard searching
 */ 
global $wpdb;
$term = sanitize_text_field($_POST['search_keywords']);
$sql = "SELECT u.* FROM " . $wpdb->base_prefix . "users u INNER JOIN {$wpdb->base_prefix}usermeta m ON u.ID=m.user_id WHERE 1=1 AND (u.user_login LIKE '%" . $term . "%' OR u.user_email LIKE '%" . $term . "%' OR u.display_name LIKE '%" . $term . "%' OR m.meta_value LIKE '%" . $term . "%') GROUP BY u.ID ORDER BY u.display_name ASC LIMIT 20";
$wpspUsers = $wpdb->get_results( $sql );
if (!empty( $wpspUsers ) ) {
    ?>
    <div class="table-responsive" style="margin-top: 5px;">
        <table class="table table-striped table-hover">
            <tr>
                <th><?php _e('Name','wp-support-plus-responsive-ticket-system');?></th>
                <th><?php _e('Username','wp-support-plus-responsive-ticket-system');?></th>
                <th><?php _e('Email','wp-support-plus-responsive-ticket-system');?></th>
                <?php 
                do_action('wpsp_searchRegUserTblTh');
                ?>
            </tr>
            <?php
            foreach( $wpspUsers as $wpspUser ) {
                ?>
                <tr style="cursor: pointer;" onclick="wpspChangeUserFromSearchTable(<?php echo $wpspUser->ID;?>,'<?php echo $wpspUser->display_name;?>');">
                    <td><?php echo $wpspUser->display_name;?></td>
                    <td><?php echo $wpspUser->user_login;?></td>
                    <td><?php echo $wpspUser->user_email;?></td>
                    <?php 
                        do_action('wpsp_searchRegUserTblTd',$wpspUser);
                    ?>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
    <?php
} else {
    ?>
    <div style="text-align: center;"><?php _e('No Results Found','wp-support-plus-responsive-ticket-system');?></div>
    <hr>
    <?php
}
/* END CLOUGH I.T. SOLUTIONS MODIFICATION
 */
?>
