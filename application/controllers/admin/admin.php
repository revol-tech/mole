<?php

class Admin extends CI_Controller {

    public function login()
    {
        $this->load->view('templates/header');
        $this->load->view("admin/login.php");
        $this->load->view('templates/footer');
    }
}

