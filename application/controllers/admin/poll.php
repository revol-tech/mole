<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Poll extends CI_Controller {

	public $data = array();

	public function __construct()
	{
		parent::__construct();

		chk_admin();

		$this->load->library('poll_library');
		$this->load->helper('utilites_helper');

		/**
		 * set headers to prevent back after logout
		 */
		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
	}


	public function index(){
		$data['items'] = $this->list_poll();

		//display
		$this->load->view('templates/header');
		$this->load->view('admin/index.php');
		$this->load->view('admin/list_poll.php',$data);
		$this->load->view('templates/footer');
	}


	/**
	 * disp form to create a new poll
	 */
	public function create(){

		//display
		$this->load->view('templates/header');
		$this->load->view('admin/index.php');
		$this->load->view('admin/create_poll.php');
		$this->load->view('templates/footer');
	}


	/**
	 * save nu poll
	 */
	public function save(){

		$data = array(
						'question' 		=> $this->input->post('question'),
						'option1'		=> $this->input->post('option1'),
						'option2'		=> $this->input->post('option2'),
						'option3'		=> $this->input->post('option3'),
						'option4'		=> $this->input->post('option4'),
						'created_by'	=> $this->ion_auth->get_user()->id,
						'date_created'	=> get_timestamp(),
						'active'		=> $this->input->post('publish')
					);

		$this->poll_library->new_poll($data);

		redirect('admin/poll');
	}


	/**
	 * list all polls
	 */
	public function list_poll(){

		$data = $this->poll_library->list_poll();

		//if there are no polls at present ...
		if(!count($data)){
			$item->id		='--';
			$item->question	='--';
			$item->date_created='--';
			$item->created_by='--';
			$item->option1	='--';
			$item->option2	='--';
			$item->option3	='--';
			$item->option4	='--';
			$item->results	='--';
			$item->active	='--';
			$item->result	='--';

			$data['items'] = $item;
			return $data;
		}
//print_r($data);

		foreach($data as $key=>$val){
			//to convert the userid into username
			$tmp_user = $data[$key]->created_by;
			$data[$key]->created_by = $this->ion_auth->get_user((int)$tmp_user)->username;


			//add activate/deactivate button
			$str = '<form method="post" action='.site_url('admin/poll/active').'>'.
						'<input type="hidden" name="poll_id" value="'.$data[$key]->id.'"/>';
			if($data[$key]->active == 1){
				$str .=	'<input type="hidden" name="activate" value="false"/>';
				$str .=	'<input type="submit" name="active"   value="Deactivate"/>';
			}else{
				$str .=	'<input type="hidden" name="activate" value="true"/>';
				$str .=	'<input type="submit" name="active"   value="Activate"/>';
			}
			$str .= '</form>';

			$data[$key]->active = $str;
		}

		return $data;
	}


	/**
	 * activate/deactivate a poll
	 *
	 * only one poll can be active.
	 */
	public function active(){
		$active = $this->input->post('active')=='Activate'?1:0;
		$ids = $this->input->post('poll_id');
//echo $active;
//echo $this->input->post('active');
		$this->poll_library->change_active($ids,$active);

		redirect('admin/poll');
	}

	/**
	 * del selected poll
	 */
	public function del(){
//echo 'in delete polll';
		$this->poll_library->del_poll($this->input->post('poll_id'));
		redirect('admin/poll');
	}

}