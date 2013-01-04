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
		
		
		/**
		 * getting the set language.
		 * if nonthing is set, set default to english
		 */
		if(!($this->session->userdata('lang')))
			$this->session->set_userdata('lang','en');
    }
}

/* End of file MY_MOLE_Controller.php */
/* Location: ./application/core/MY_MOLE_Controller.php */
