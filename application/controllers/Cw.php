<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Basic CI-WP Controller 
 *
 * @link		https://codeigniter.com/user_guide
 *
 * @package		CI-WP
 * @subpackage	CodeIgniter
 * @category	Controller
 * @author      W3plan Technologies
 */

class CW_Controller extends CI_Controller 
{   
    /**
	 * Class constructor
	 *
	 * @return	void
	 */
    public function __construct() 
    {
        
        parent::__construct();
        
        // load WordPress environments
        require FCPATH . "index-ci-wp-env.php";
    }
    
}
