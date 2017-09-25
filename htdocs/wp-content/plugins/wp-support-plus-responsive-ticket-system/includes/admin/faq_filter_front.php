<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wpdb;
$categories = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}wpsp_faq_catagories" );
?>
<div class="faq_item">
	<table>
		<tr>
			<td><?php _e('Category:','wp-support-plus-responsive-ticket-system');?>
			
				<select id="filter_by_faq_category_front">
					<option value="all"><?php _e('All','wp-support-plus-responsive-ticket-system');?></option>
					<?php 
					foreach ($categories as $category){
						echo '<option value="'.$category->id.'">'.$category->name.'</option>';
					}
					?>
				</select>
			</td>
                        <td>
                        <input type="text" id="filter_by_faq_search_front" placeholder="<?php _e('Search...','wp-support-plus-responsive-ticket-system');?>" />    
                        </td>
		</tr>
	</table>
</div>
