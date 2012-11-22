<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	/**
	 * check login
	 * returns true | false
	 */
	public function login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$remember = $this->input->post('remember');

		$cond =  $this->ion_auth->login($username, $password, $remember);

		return $cond;
	}

	/**
	 * chk the captcha
	 * returns true | false
	 */
/*
	public function chk_captcha(){
		$cond = true;

		//delete old captchas
		$expiration = time()-720;
		$this->db->query("DELETE FROM captcha WHERE captcha_time < ".$expiration);

		//chk if a captcha exists
		$sql = 'SELECT COUNT(*) AS count FROM captcha '.
				'WHERE word = ? AND captcha_time > ? ;';
		$binds = array($_POST['captcha'], $expiration);
		$query = $this->db->query($sql, $binds);


		$row = $query->row();

		if ($row->count != 1)
		{
			$cond = false;
		}
		return $cond;
	}
*/

	/**
	 * logout users
	 */
	public function logout(){
		$this->ion_auth->logout();
		redirect(base_url());
	}

}

/* End of file users_model.php */
/* Location: ./application/models/users_model.php */