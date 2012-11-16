<?php

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
    public function login()
    {
        $this->load->view('templates/header');
        $this->load->view("admin/login.php");
        $this->load->view('templates/footer');
    }
}

