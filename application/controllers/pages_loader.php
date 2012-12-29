<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pages_loader extends MY_MOLE_Controller {

	public function __construct(){
		parent::__construct();
//		$this->output->enable_profiler(true);
//		$this->db->cache_on();

		$this->load->library('render_library');
	}


	/**
	 * default homepage
	 */
	public function index($params = array()){
		$this->render_library->render_landing();
		
		//slider
		$this->load->model('files_model','slider_model');
		$slider = $this->slider_model->render_slider(array('file_type'=>'slider'));
		$this->template->write('slider',$slider);


		//flash news
		$this->load->model('news_model');
		$params = array('news_type'=>1,'active'=>1);
		$flash_news = $this->news_model->render($params);
		$this->template->write('flash_news',$flash_news);

		//main <about> [or <page>]
		$this->load->model('news_model');
		$params = array('news_type'=>6,'homepage'=>1);
		$page = $this->news_model->render($params);
		$this->template->write('page',$page);

		//VIP
		$this->load->model('vip_model');
		$vip = $this->vip_model->render(array('active'=>1));
		$this->template->write('vip',$vip);

		//vertical slider notices
		$this->load->model('news_model');
		$params = array('news_type'=>2,'active'=>1);
		$notices = $this->news_model->render($params);
		$this->template->write('notices',$notices);

		//events
		$this->load->model('news_model');
		$params = array('news_type'=>3,'active'=>1);
		$events = $this->news_model->render($params);
		$this->template->write('events',$events);

		//press
		$this->load->model('news_model');
		$params = array('news_type'=>4,'active'=>1);
		$press = $this->news_model->render($params);
		$this->template->write('press',$press);

		//health
		$this->load->model('news_model');
		$params = array('news_type'=>5,'active'=>1);
		$health = $this->news_model->render($params);
		$this->template->write('health',$health);

		//activities & photos -- gallery
		$this->load->model('gallery_model');
		$gallery = $this->gallery_model->render();
		$this->template->write('gallery',$gallery);		
		
		//poll
		$this->load->library('poll_library');
		$poll = $this->poll_library->render_poll();
		$this->template->write('poll',$poll);

		$this->template->render();	
	}
}
