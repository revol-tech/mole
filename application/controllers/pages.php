<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function view($page = 'home'){
$this->load->model('menu_model');
$xyz = $this->menu_model->render_menu(array('active'=>1));

$this->template->write('menu',$xyz);
		$this->template->render();
	}
}