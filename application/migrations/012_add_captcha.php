<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_captcha extends CI_Migration {

	public function __construct(){
		parent::__construct();
		$this->load->dbforge();
	}


	public function up()
	{
		$fields = array(
						'`captcha_id` bigint(13) unsigned NOT NULL AUTO_INCREMENT',
						'`captcha_time` int(10) unsigned NOT NULL',
						'`ip_address` varchar(16) NOT NULL DEFAULT 0',
						'`word` varchar(20) NOT NULL',
					);
		$this->dbforge->add_field($fields);

		$this->dbforge->add_key('captcha_id', TRUE);
		$this->dbforge->add_key('word');
		$this->dbforge->create_table('captcha');
		//--------------------------------------------

	}

	public function down()
	{
		$this->dbforge->drop_table('captcha');
	}
}

/* End of file 012_add_captcha.php */
/* Location: ./application/migrations/012_add_captcha.php */