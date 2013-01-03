<?php

class MY_MOLE_Controller extends CI_Controller {

    public function __construct(){
        parent::__construct();

//		$this->output->enable_profiler(true);
//		$this->ci->db->cache_on();
        
		/**
		 * count the no. of times unique client ip 
		 * address accesses the site
		 * 
		 */
		set_count_visitors();		

		/**
		 * load the render library
		 */
		$this->load->library('render_library');
		
		$this->session->set_userdata('lang','eng');
    }
}

/* End of file MY_MOLE_Controller.php */
/* Location: ./application/core/MY_MOLE_Controller.php */
