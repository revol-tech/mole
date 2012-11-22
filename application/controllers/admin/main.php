<?php

class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');

		if($this->nativesession->get('user_id')!=1)
			show_error('Access Denied');
	}



	/**
	 * show admin main screen
	 */
    public function index(){
		//logout admim
		if($this->input->post('logout'))
			$this->_logout();


		//the admin's main screen here
		$this->load->view('templates/header');
		$this->load->view('admin/index.php');
		$this->load->view('templates/footer');
    }


	/**
	 * logout admin
	 */
	private function _logout(){
		if($this->input->post('logout')){
			$this->ion_auth->logout();
			$this->nativesession->delete('user_id');

			redirect(base_url());
		}
	}
}