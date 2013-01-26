<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_menu extends CI_Migration {

	public function __construct(){
		parent::__construct();
		$this->load->dbforge();
	}


	public function up()
	{
		$fields = array(
						'`id` int(13) unsigned NOT NULL AUTO_INCREMENT',
						'`title_np` varchar(127) NOT NULL',
						'`comments_np` varchar(255)',
						'`title` varchar(127) NOT NULL',
						'`link` varchar(127) NOT NULL DEFAULT "#"',
						'`parent_id` int(11) NOT NULL default 0',
						'`active` tinyint(1) not null default 1',
						'`comments` varchar(255)',
						'`sort_order` int(11) not null',
					);
					
		$this->dbforge->add_field($fields);

		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->add_key('parent_id');
		$this->dbforge->create_table('menu');

		$this->db->query('ALTER TABLE `menu` ADD UNIQUE (`link`)');
		$this->db->query('ALTER TABLE `menu` ADD UNIQUE (`title`)');

	//--------------------------------------------

	}

	public function down()
	{
		$this->dbforge->drop_table('menu');
	}
}

/* End of file 013_add_menu.php */
/* Location: ./application/migrations/013_add_menu.php */
