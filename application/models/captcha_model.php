<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Captcha_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	/**
	 * store captcha into db
	 */
	public function set_data($data){

		$sql = 	'INSERT INTO `captcha`( `captcha_time`,`ip_address`, `word`) '.
				'VALUES ( ? , ? , ?);';

		$query = $this->db->query($sql, $data);
	}

	/**
	 * chk the captcha
	 * returns true | false
	 */
	public function chk_captcha(){
		$cond = false;

		//delete old captchas
		$expiration = time()-720;
		$this->db->query("DELETE FROM captcha WHERE captcha_time < ".$expiration);

		//chk if a captcha exists
		$sql = 'SELECT COUNT(*) AS count FROM captcha '.
				'WHERE word = ? AND captcha_time > ? ;';
		$binds = array($_POST['captcha'], $this->input->ip_address(), $expiration);
		$query = $this->db->query($sql, $binds);

		$row = $query->row();

		if ($row->count > 0)
		{
			$cond = true;
		}
		return $cond;
	}
}

/* End of file captcha_model.php */
/* Location: ./application/models/captcha_model.php */