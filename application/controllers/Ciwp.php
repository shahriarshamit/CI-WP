<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Default CI-WP Controller 
 *
 * @link		https://codeigniter.com/user_guide
 *
 * @package		CI-WP
 * @subpackage	CodeIgniter
 * @category	Controller
 * @author      W3plan Technologies
 */

// include basic CI-WP controller file
require_once APPPATH . "controllers/Cw.php";

class Ciwp extends CW_Controller 
{    
    /**
	 * Class constructor
	 *
	 * @return	void
	 */
    public function __construct()
    {        
        parent::__construct();
        
        // load CodeIgniter library 
        //$this->load->library(array('library name',...));
        
        // load basic CI-WP model
        $this->load->model('cw_model', 'cw', TRUE);
    }
    
    /**
     * index action
     *
     */
	public function index() 
    {
        // set action sign for CI-WP view
        $data['indexview'] = "index_view";
        
        // load CI-WP view
        $this->load->view('ci-wp_view', $data);
	}
    
}
