<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		//admin is already logged in.
		if($this->ion_auth->is_admin()){
			redirect('admin/main');
		}
	}

    public function login()
    {
		$this->load->model('captcha_model');
		$data = array();

		//----------------------------
		//if admin is trying to login ...
		if($this->input->post('login')){
			//check & login
			//redirect to admin/main if succces
			//else return err msg array
			$data['errors'] = $this->_chk_login();
			$data['username']=$this->input->post('username');
			$data['password']=$this->input->post('password');
		}
		//----------------------------

		// create nu captcha
		$cap = $this->captcha_model->create_nu_captcha();

		$data['image'] = $cap['image'];

		$this->load->view('templates/header');
		$this->load->view('admin/login.php',$data);
		$this->load->view('templates/footer');
    }

	/**
	 * validate username,password,captcha
	 * redirect to admin if successful
	 */
	private function _chk_login(){
		$err = array();

		if(!$this->captcha_model->check_captcha()){
			$err['captcha_err'] = 'Invalid Captcha';
		}

		$this->load->model('users_model');

		//if admin's login is valid ...
		if($this->users_model->check_login()){
			//redirect to admin's main page
			redirect('/admin/main');
		}
		$err['login_err'] = 'Invalid Login';

		return $err;
	}
}