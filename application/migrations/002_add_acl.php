<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_acl extends CI_Migration {

	public function __construct(){
		parent::__construct();
		$this->load->dbforge();
	}


	public function up()
	{
		//--------------------------------------------
		/* create a acl table */
		/**
		 * Generates the sql :
		 */
		$this->dbforge->add_field(array(
				'id' => array(
					'type' 			=> 'INT',
					'unsigned' 		=> TRUE,
					'auto_increment'=> TRUE
				),
				'title' => array(
					'type' 		 => 'VARCHAR',
					'constraint' => '127'
				),
			)//more params to be added .......
		);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('acl');
		//--------------------------------------------


		//--------------------------------------------
		/* crates a acl group table */
		/**
		 * Generates the sql :
		 */
		$this->dbforge->add_field(array(
					'id' => array(
						'type' 			=> 'INT',
						'unsigned' 		=> TRUE,
						'auto_increment'=> TRUE
					),
					'acl_id'  => array(
						'type'		=> 'INT',
						'unsigned'	=> TRUE,
						'constraint'=> '127'
					),
					'name	' => array(
						'type' 		 => 'VARCHAR',
						'constraint' => '127'
					),
					'comments' => array(
						'type' 		 => 'VARCHAR',
						'constraint' => '127'
					),
				)
			);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('acl_group');
		//--------------------------------------------

	}

	public function down()
	{
		$this->dbforge->drop_table('acl');

		$this->dbforge->drop_table('acl_group');
	}
}

/* End of file 002_add_acl.php */
/* Location: ./application/migrations/002_add_acl.php */