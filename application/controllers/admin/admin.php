<?php

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->library('ion_auth');
		$this->load->helper('captcha');
		$this->load->model('captcha_model');
	}

    public function login()
    {
		$data = array();

		if($this->nativesession->get('user_id')==1)
			//redirect to admin's homepage.
			redirect('admin/main');

		// admin login form submitted
		if($this->input->post('login')){
			$data = $this->_chk_login();
		}

		//generate nu captcha for admin login form
		$img = $this->generate_captcha();

		//set captcha data
		$this->captcha_model->set_data(	array(	$img['time'],
												$this->input->ip_address,
												$img['word']
											));
		$data['image'] = $img['image'];


		//load admin login view
        $this->load->view('templates/header');
        $this->load->view('admin/login.php',$data);
        $this->load->view('templates/footer');
    }

	//generate nu captcha for admin login form
	public function generate_captcha(){

		$captcha = array(
						'font_path'	 => './'.FONTPATH.'/Times_New_Roman.ttf',
						'img_path'	 => './'.CAPTCHAPATH,
						'img_url'	 => base_url().CAPTCHAPATH,
						'img_width'  => 125,
						'img_height' => 50,
						'expiration' => 20,
					);
		$img = create_captcha($captcha);
		$this->captcha_model->set_data(	array(	$img['time'],
												$this->input->ip_address,
												$img['word']
											));
		return $img;
	}

	/**
	 * validate admin login username, password, captcha
	 * returns array of errors
	 */
    private function _chk_login(){
		$this->load->model('users_model');
		$data = array();

		$cap = $this->captcha_model->chk_captcha();

		if($this->users_model->login() && $cap ){
			//set session
			$this->nativesession->set('user_id',1);

			//redirect to admin's homepage.
			redirect('admin/main');

		//invalid login information
		}else{

			//get entered username
			$data['username'] = $this->input->post('username');
			$data['errors'] = array();

			//err msg for invalid captcha
			array_push($data['errors'],($cap==null)?'<p>Invalid Captcha</p>' : '');

			//err msg for invalid login
			if($err = $this->ion_auth->errors()){
				array_push($data['errors'],$err);
			}
		}
		return $data;
	}
}