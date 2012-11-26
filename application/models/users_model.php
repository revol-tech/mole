<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model{

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * check selected username, password, ip address
	 * returns true, false
	 */
	public function check_login(){

		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$remember = $this->input->post('remember');


		$logged =  $this->ion_auth->login($username, $password, $remember);

		return $logged;
	}
}

/* End of file users_model.php */
/* Location: ./application/models/users_model.php */