<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class to be called when displaying "news" page , 
 * for a general web surfer.
 */
class News extends MY_MOLE_Controller {

	public function __construct(){
		parent::__construct();
	}


	public function index(){
		
		$this->load->library('render_library');
		
		$data = $this->links_model->get(array(
											'link'=>$this->uri->segment(1).
													'/'.
													$this->uri->segment(2)
											)
										);
										
		$this->load->model('news_model');
		$params = array(
						'news_type'	=> 1,
						//'link_type' => 'news'
					);
		($this->uri->segment(2))?$params['id']=$this->uri->segment(2):'';
		
		$page = $this->news_model->get($params);
echo $this->db->last_query();
		if ($this->uri->segment(2)){
			$params['id']=$this->uri->segment(2);
			$params['link_type'] = 'page';
		}
		
		
//		if(isset($page->content)){
//			$page = (array)$page;
//			$page['contents'] = $page['content'];
//			$page['contents_np'] = $page['content_np'];
//			$page['timestamp'] = '';
//			$page = (object)$page;
//		}
//echo '<pre>';
//print_r($page);
//echo '</pre>';
		//render it
		//$this->render_library->generate_innermain($page,($this->uri->segment(2))?'newsfull':'newslist');
		//$this->render_library->generate_inner();
		$this->render_library->generate_inner_event($page);
		$this->template->render();
		

		//$this->template->render();
	}
}

