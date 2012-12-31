<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Polls extends MY_MOLE_Controller {
	public function __construct(){
		parent::__construct();

		$this->load->library('poll_library');
	}

	/**
	 * disp. results of a poll
	 */
	public function results($poll_id=null){
		//if id is not passed, use the currently active poll
		if($poll_id==null){
			$poll = $this->poll_library->get(array('active'=>1));

		//else get the selected poll
		}else{
			$poll = $this->poll_library->get(array('id'=>$poll_id));
		}
		
		$pate = $this->poll_library->result_compare($poll);
		$this->template->write('page',$page);
	}

	/**
	 * vote for the active poll
	 */
	public function vote(){
		$user = $this->ion_auth->get_user();

		if(count($user)==0){
			$user['id'] = $this->input->ip_address();
		}
//	print_r($_POST);	die;
		$this->poll_library->vote($user['id'],$this->input->post('choice'));
				
		$this->view_results();
	}
	
	
	/**
	 * view results of the selected poll
	 */
	public function view_results($poll_id=null){
		$results = $this->poll_library->result_compare();
	
		$this->load->library('render_library');
		$this->render_library->generate_inner();

		//render it
		$this->render_library->generate_innermain($results[0]->graph,'polls');
		
		$this->template->render();
	}

	/**
	 * generate the inner page
	 */
	public function index(){
		$this->load->library('render_library');
	
		if($this->poll_library->chk_history()){
			$this->view_results();
			return;
		}


		$active_poll = $this->poll_library->render_poll();
		
		$this->render_library->generate_inner();

		$this->render_library->generate_innermain($active_poll,($this->uri->segment(1)=='polls')?'polls':'');

		$this->template->render();




/*
		// get the reqd. parameters
		$data = $this->links_model->get(array(
											'link'=>$this->uri->segment(1).
													'/'.
													$this->uri->segment(2)
											)
										);

		$this->load->model('polls_model');
		$params = array(
//						'id'		=> $data[0]->row_id,
//						'news_type'	=> 4,
					);
		($this->uri->segment(2))?$params['id']=$this->uri->segment(2):'';

		//get thre reqd. contents
		$page = $this->news_model->get($params);
		
		if ($this->uri->segment(2)){
			$params['id']=$this->uri->segment(2);
			$params['link_type'] = 'page';
		}

		//render it
		$this->render_library->generate_innermain($page,($this->uri->segment(2))?'healthfull':'healthlist');


		$this->template->render();
*/	}
}
