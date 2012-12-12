<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function view($params = array()){
		$this->load->model('menu_model');
		$menu = $this->menu_model->render_menu(array('active'=>1));
		$this->template->write('menu',$menu);


		$this->load->model('files_model','slider_model');
		$slider = $this->slider_model->render_slider(array('file_type'=>'slider'));
		$this->template->write('slider',$slider);


		$this->load->library('poll_library');
		$poll = $this->poll_library->render_poll();
		$this->template->write('poll',$poll);


		$this->load->model('news_model');
		$params = array('news_type'=>6,'homepage'=>1);
		$page = $this->news_model->render($params);
		$this->template->write('page',$page);

		$this->template->render();
	}

	public function vote(){
echo 'u just voted';
print_r($_POST);
	}
}