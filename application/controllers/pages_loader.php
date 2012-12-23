<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pages_loader extends MY_MOLE_Controller {

	public function __construct(){
		parent::__construct();

		$this->_header_view();
		$this->_footer_view();
//$this->output->enable_profiler(true);
//$this->output->cache(5);
	}


	/**
	 * default homepage
	 */
	public function index($params = array()){
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
		$vip = $this->vip_model->render();
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


	public function routes(){
//echo 'routed to : '	; 
//echo '<pre>';
//print_r($this->uri->segment_array());
//echo '</pre>';

		$this->template->render();
	}
	
	
	/**
	 * headers.
	 * Contains the links & menus
	 */
	private function _header_view(){
		//menu
		$this->load->model('menu_model');
		$menu = $this->menu_model->render_menu(array('active'=>1));
		$this->template->write('menu',$menu);	
	}

	/**
	 * footers
	 * Contains the SiteMap & other similar links
	 */
	private function _footer_view(){
		//contact
		$this->load->model('contacts_model');
		$contacts = $this->contacts_model->render();
		$this->template->write('contacts',$contacts);		

		//userful links
		$this->load->model('usefullinks_model');
		$usefullinks = $this->usefullinks_model->render();
		$this->template->write('usefullinks',$usefullinks);		

		//network
		$this->load->model('networks_model');
		$networks = $this->networks_model->render();
		$this->template->write('network',$networks);

		//employments
		$this->load->model('news_model');
		$params = array('news_type'=>7,'active'=>1);
		$employments = $this->news_model->render($params);
		$this->template->write('employments',$employments);

		//counter
		$counter = get_count_visitors();
		$this->template->write('counter',$counter);
	}






	public function vote(){
echo 'u just voted';
print_r($_POST);
	}
}