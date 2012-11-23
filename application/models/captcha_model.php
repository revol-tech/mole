<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Captcha_model extends CI_Model{
	public function __construct()
	{
		parent::__construct();
	}


	//create nu captcha & store in db
    public function create_nu_captcha(){
		$this->load->helper('captcha');

		//first, del old captcha
		$this->_del_captcha();

		$vals = array(
			'img_path' 	=> './public/imgs/captcha/',
			'img_url' 	=> base_url().'public/imgs/captcha/',
			'font_path' => './public/fonts/texb.ttf',
			'img_width' => 120,
			'img_height'=> 40,
			'expiration'=> CAPTCHATIME,
			//'word'		=> 'hello'
			);

		$cap = create_captcha($vals);

		$tmp_store_data = array(	$cap['time'],
									$this->input->ip_address(),
									$cap['word']
								);

		//store created captcha into db
		$this->_update_db($tmp_store_data);

		return $cap;
	}



	//store created captcha into db
	public function _update_db($data){
		$sql = 'insert into captcha (captcha_time, ip_address, word ) '.
				'values (?, ?, ?);';
		$query = $this->db->query($sql, $data);
	}


	//del old captcha
	public function _del_captcha(){
		$expiration = time()- CAPTCHATIME; // captcha limit
		$this->db->query("DELETE FROM captcha WHERE captcha_time < ".$expiration);
	}


	//check captcha
	//returns true | false
	public function check_captcha(){

		$sql = 'SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?;';
		$expiration = time()-CAPTCHATIME; // captcha limit
		$binds = array($this->input->post('captcha'), $this->input->ip_address(), $expiration);
		$query = $this->db->query($sql, $binds);

		$row = $query->row();

		return ($row->count==1);
	}
}

/* End of file captcha_model.php */
/* Location: ./application/models/captcha_model.php */