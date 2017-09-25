<?php

/**
 * Basic CI-WP Model
 *
 * @link		https://codeigniter.com/user_guide
 *
 * @package		CI-WP
 * @subpackage	CodeIgniter
 * @category	Model
 * @author      W3plan Technologies
 */

class CW_Model extends CI_Model 
{
    /**
	 * Class constructor
	 *
	 * @return	void
	 */
	function __construct()
    {
		parent::__construct();
        
        // set up WordPress query
        require FCPATH . "index-ci-wp-query.php";
	}
    
}
