<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		chk_admin();

		/**
		 * set headers to prevent back after logout
		 */
		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
	}


	/**
	 * admin's main fn's
	 */
    public function index()
    {
		if($this->input->post('logout')){
			$this->logout();
		}

		$this->load->view('templates/header');
		$this->load->view('admin/index.php');
		$this->load->view('templates/footer');
    }


	/**
	 * admin logout
	 */
    private function logout(){
		$this->ion_auth->logout();

		$this->load->view('admin/logout.php');

		redirect(base_url());
	}

}