<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Update_db extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->library('migration');
	}

	public function index($version = FALSE)
	{
		if($version){
			/**
			 * updates db to the spcified version line 23.
			 */
			$this->migration->version($version);
		}else{
			/**
			 * updates db to be version mentioned in
			 * 	$config['migration_version']
			 *
			 * in line 23 of ./application/config/migration/
			 * ????????
			 * unsure.
			 */
			$this->migration->latest();
		}
	}
}

/* End of file update_db.php */
/* Location: ./application/controller/update_db.php */