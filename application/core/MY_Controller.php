<?php

class MY_MOLE_Controller extends CI_Controller {

    public function __construct(){
        parent::__construct();
        
		/**
		 * count the no. of times unique client ip 
		 * address accesses the site
		 * 
		 */
		set_count_visitors();
    }
}

/* End of file MY_MOLE_Controller.php */
/* Location: ./application/core/MY_MOLE_Controller.php */
