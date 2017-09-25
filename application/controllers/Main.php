<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * General CI-WP controller 
 *
 * @link		https://codeigniter.com/user_guide
 *
 * @package		CI-WP
 * @subpackage	CodeIgniter
 * @category	Controller
 * @author      W3plan Technologies
 */

 // include CI-WP basic controller file
require_once APPPATH . "controllers/Cw.php";

class Main extends CW_Controller 
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
        $this->load->library(array('session', 'email', 'table'));
        
        // load CodeIgniter helper 
        $this->load->helper(array('cw_base', 'url'));
        
        // load general CI-WP model
        $this->load->model('main_model', 'main', TRUE);
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
    
    /**
     * demo action
     *
     */
    public function demo() 
    {
        /**
         * get query value from the request 
         *
         * transferred query value by query string under setting, 
         * $config['enable_query_strings'] = TRUE;
         *
         */
        $qvals = $this->input->get();
        
        unset($qvals['cwc']);
        unset($qvals['cwm']);
        
        $data['qvals'] = $qvals;
        
        /**
         * check user login status using WordPress function
         *
         */
        if ( is_user_logged_in() ) 
        {
            $data['user_status'] = 'You are logged in';
        } else 
        {
            $data['user_status'] = "You aren't logged in";
        }
        
        /**
         * apply database query and CodeIgniter table class 
         *
         */
        $this->benchmark->mark('code_start');
        
        $ci_results = $this->main->get_query_by_ci();
        
        $this->benchmark->mark('code_end');
        $data['elapsed1'] =  $this->benchmark->elapsed_time('code_start', 'code_end');
        
        $this->table->set_heading('Post title', 'Post time');        
        $data['ci_results'] = $this->table->generate($ci_results);
        
        $this->benchmark->mark('code_start');
        
        $data['wp_results'] = $this->main->get_query_by_wp();
        
        $this->benchmark->mark('code_end');
        $data['elapsed2'] =  $this->benchmark->elapsed_time('code_start', 'code_end');
        
        /**
         * get WordPress administrator information then save it to session 
         *
         */
        $use_id = 1;
        $user_info = get_userdata($use_id);
        if ($this->session->userdata('user_name') !== $user_info->user_login) 
        {
           $user_data = array( 
               'user_name'  => $user_info->user_login, 
               'user_email' => $user_info->user_email, 
               'user_roles' => implode(', ', $user_info->roles)
            );
            
            $this->session->set_userdata($user_data);
        }
        
        /**
         * output all data to CI-WP view
         *
         */
        // set action label for CI-WP view
        $data['demo_view'] = "demo-view";
        
        // load CI-WP view
        $this->load->view("ci-wp_view", $data);
        
    }
    
}
