<?php

class Admin extends CI_Controller {

	public function login()
	{
		$this->load->view("admin/login.php");
	}
}

