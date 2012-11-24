<?php defined("BASEPATH") or exit("No direct script access allowed");

class Migration extends CI_Controller{

	public function index($version){
		//do migration for development version only
		if(ENVIRONMENT != 'development'){
			show_404("migrate");
			exit;
		}
		$this->load->library("migration");

		if(!$this->migration->version($version)){
			show_error($this->migration->error_string());
		}
	}
}


/* End of file migration.php */
/* Location: ./application/controller/migration.php */
