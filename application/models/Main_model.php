<?php

/**
 * General CI-WP Model
 *
 * @link		https://codeigniter.com/user_guide
 *
 * @package		CI-WP
 * @subpackage	CodeIgniter
 * @category	Model
 * @author      W3plan Technologies
 */

// include basic CI-WP model file
require_once APPPATH . "models/Cw_model.php";

class Main_Model extends CW_Model 
{   
    // select the meta data WordPress collects for a post in news category (category id < 10)  
    private $statement  = '
            SELECT DISTINCT post_title, post_date 
            FROM cw_posts a 
            LEFT JOIN cw_term_relationships b ON ( a.ID = b.object_id ) 
            LEFT JOIN cw_postmeta c ON ( a.ID = c.post_id ) 
            LEFT JOIN cw_term_taxonomy d ON ( d.term_taxonomy_id = b.term_taxonomy_id ) 
            LEFT JOIN cw_terms e ON ( e.term_id = d.term_id ) 
            WHERE e.term_id < 10
        ';
    
    /**
	 * Class constructor
	 *
	 * @return	void
	 */
	function __construct()
    {
		parent::__construct();
	}
    
    /**
	 * apply CodeIgniter query
	 *
	 * @return	array   containing the names of selected tables from database  
	 */
	function get_tables()
    {
		return $this->db->list_tables();
	}
    
    /**
	 * apply CodeIgniter query
	 *
	 * @return	array   result arrray of query execution  
	 */
    function get_query_by_ci() 
    {
        $results = $this->db->query($this->statement);
        
        return $results->result_array();
    }
    
    /**
	 * apply WordPress query
	 *
	 * @return	array   result arrray of query execution
	 */
    function get_query_by_wp() 
    {
        // declaim WordPress global variable
        global $wpdb;
        
        return $wpdb->get_results($this->statement);
    }
    
}
