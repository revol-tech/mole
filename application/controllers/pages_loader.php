<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pages_loader extends MY_MOLE_Controller {

	public function __construct(){
		parent::__construct();
	}


	/**
	 * default homepage
	 */
	public function index($params = array()){
		$this->render_library->generate_landing();
		
		//main <about> [or <page>]
		$this->load->model('news_model');
		$data = $this->news_model->get(array('news_type'=>6,'homepage'=>1));
		$this->render_library->generate_mainpage($data);
		

		//right side of main page
		//VIP
		$this->load->model('vip_model');
		$vip = $this->vip_model->render(array('active'=>1));
		$this->template->write('vip',$vip);


		//slider
		$this->load->model('files_model','slider_model');
		$slider = $this->slider_model->render_slider(array('file_type'=>'slider'));
		$this->template->write('slider',$slider);
		
		//flash news
		$this->load->model('news_model');
		$params = array('news_type'=>1,'active'=>1);
		$flash_news = $this->news_model->render($params);
		$this->template->write('flash_news',$flash_news);

		
		//events
		$this->load->model('events_model');
		$params = array(/*'homepage'=>1,*/'active'=>1);
		$events = $this->events_model->get($params);
		$events = $this->events_model->render_events($events);
		$this->template->write('events',$events);



		$this->template->render();	
	}
}
