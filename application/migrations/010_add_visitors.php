<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_visitors extends CI_Migration {

	public function __construct(){
		parent::__construct();
		$this->load->dbforge();
	}


	public function up()
	{
		$this->dbforge->add_field(array(
				'id' => array(
					'type' 			=> 'INT',
					'unsigned' 		=> TRUE,
					'auto_increment'=> TRUE
				),
				'name' => array(
					'type' 		 => 'VARCHAR',
					'constraint' => '127'
				),
				'email' => array(
					'type' 		 => 'VARCHAR',
					'constraint' => '127'
				),
				'address' => array(
					'type' => 'varchar',
					'constraint'=> '255'
				),
				'ip_address' => array(
					'type' 		 => 'VARCHAR',
					'constraint' => '11'
				),
				'date_created'=>array(
					'type'		=> 'timestamp',
					'null'		=> true
				),
				'date_published'=>array(
					'type'		=> 'timestamp',
					'null'		=> true
				),
			)
		);

		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('visitors');
		//--------------------------------------------

	}

	public function down()
	{
		$this->dbforge->drop_table('visitors');
	}
}

/* End of file 010_add_visitors.php */
/* Location: ./application/migrations/010_add_visitors.php */