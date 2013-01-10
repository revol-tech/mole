<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Events extends MY_MOLE_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('events_model');
	}

	/**
	 * generate the inner page
	 */
	public function index(){
		$this->load->library('render_library');
//		$this->render_library->generate_inner();
	
		//view a specific event
		if($redirect = $this->uri->segment(2)){
			$this->$redirect();

		//view all events
		}else{
			$this->list_events();
		}
	}
	
	public function list_events(){
		//get thre reqd. contents
		$page = $this->events_model->get(array('active'=>1));

		//render it
		$this->render_library->generate_inner_event($page);
		$this->template->render();
	}
	
	public function view(){
		//get thre reqd. contents
		$page = $this->events_model->get(array('id'=>$this->uri->segment(3)));

		//render it
		$this->render_library->generate_inner_event($page);

		$this->template->render();
	}



/*

		// get the reqd. parameters
		$data = $this->links_model->get(array(
											'link'=>$this->uri->segment(1).
													'/'.
													$this->uri->segment(2)
											)
										);

		$this->load->model('events_model');
		$params = array(
//						'id'		=> $data[0]->row_id,
						'news_type'	=> 3,
					);
		($this->uri->segment(2))?$params['id']=$this->uri->segment(2):'';

		//get thre reqd. contents
		$page = $this->events_model->get($params);
		
		if ($this->uri->segment(2)){
			$params['id']=$this->uri->segment(2);
			$params['link_type'] = 'events';
		}

		//render it
		$this->render_library->generate_innermain($page,($this->uri->segment(2))?'eventsfull':'eventslist');


		$this->template->render();
	}
*/
}
