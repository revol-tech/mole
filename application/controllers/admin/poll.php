<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Poll extends CI_Controller {

	public $data = array();

	public function __construct(){

		parent::__construct();

		chk_admin();

		$this->load->library('poll_library');

		/**
		 * set headers to prevent back after logout
		 */
		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');

		//flashdata to redirect to the same page
		$this->session->set_flashdata('redirectToCurrent', current_url());
	}


	public function index(){
		$data['items'] = $this->list_poll();

		//display
		$this->load->view('templates/admin_header');
		$this->load->view('admin/index.php');
		$this->load->view('admin/list_poll.php',$data);
		$this->load->view('templates/admin_footer');
	}


	/**
	 * disp form for new/edit poll
	 */
	public function create($data=false){

		//display
		$this->load->view('templates/admin_header');
		$this->load->view('admin/index.php');

		if($data){
			$this->load->view('admin/create_poll.php',$data);
//print_r($data);
		}else{
			$this->load->view('admin/create_poll.php');
		}

		$this->load->view('templates/admin_footer');
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
						'active'		=> $this->input->post('publish')
					);


		//store new poll
		if($this->input->post('id')==null){
			$data['created_by']	= $this->ion_auth->get_user()->id;
			$data['date_created']= get_timestamp();

			$this->poll_library->new_poll($data);


		//update existing poll
		}else{
			$data['id']= $this->input->post('id');
			$this->poll_library->update_poll($data);
		}


		redirect('admin/poll');
	}


	/**
	 * list all polls
	 */
	public function list_poll(){

		//initial configurations for pagination
		$config['base_url'] = site_url('admin/poll/index');
		$config['total_rows'] = $this->poll_library->record_count();
		$config['per_page'] = PAGEITEMS;

		//if there are no polls at present ...
		if($config['total_rows']==0){
			$item->id		='--';
			$item->question	='--';
			$item->question_link='--';
			$item->date_created='--';
			$item->created_by='--';
			$item->option1	='--';
			$item->option2	='--';
			$item->option3	='--';
			$item->option4	='--';
			$item->graph	='--';
			$item->active	='--';
			$item->result	='--';
			$item->edit		= '--';
			$item->del		= '--';

			$data['items'] = $item;
			return array('data'=>array($item));
		}
//print_r($data);

		//get reqd page number
		foreach($this->uri->segment_array() as $key=>$val){
			if($val=='index'){
				$config['uri_segment'] = $key+1;
				break;
			}
		}
		$this->pagination->initialize($config);
		isset($config['uri_segment'])?'':$config['uri_segment']=$this->uri->total_segments();
		$page = ($this->uri->segment($config['uri_segment'])) ? $this->uri->segment($config['uri_segment']) : 0;
		//echo $page;

		//get reqd. page's data
		$data = $this->poll_library->list_poll(null,$config['per_page'],$page);

		foreach($data as $key=>$val){
			$str =	'<a href="'.site_url('admin/poll/view/'.$val->id).'">'.
						$val->question.
					'</a>';
			$data[$key]->question_link = $str;


			$str =	'<a href="'.site_url('admin/poll/edit/'.$val->id).'">edit</a>';
			$data[$key]->edit = $str;

			$str = 	form_open(site_url('admin/poll/del/')).//'<form method="post" action="'.site_url('admin/poll/del/').'">'.
						'<input type="hidden" name="poll_id" value="'.$val->id.'"/>'.
						'<input type="submit" name="del" value="Delete"/>'.
					'</form>';
			$data[$key]->del = $str;



			//to convert the userid into username
			$tmp_user = $data[$key]->created_by;
			$data[$key]->created_by = $this->ion_auth->get_user((int)$tmp_user)->username;


			//add activate/deactivate button
			$str = form_open(site_url('admin/poll/active/')).//'<form method="post" action='.site_url('admin/poll/active').'>'.
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

		return array('data'=>$data,'links'=>$this->pagination->create_links());
	}



	/**
	 * get 1 poll for editing
	 */
	public function edit(){

		$id=false;
		foreach($this->uri->segment_array() as $key=>$val){
			if($val=='edit'){
				$id = $this->uri->segment($key+1);
				break;
			}
		}

		$data = $this->poll_library->list_poll($id);

		if(count($data) != 1){
			show_404();
		}
		$this->create($data[0]);

	}


	/**
	 * view a poll for viewing
	 */
	public function view(){
		$id=false;
		foreach($this->uri->segment_array() as $key=>$val){
			if($val=='view'){
				$id = $this->uri->segment($key+1);
				break;
			}
		}

		$data = $this->poll_library->list_poll($id);

		if(count($data)!=1){
			show_404();
		}

//print_r($data[0]);
		//display
		$this->load->view('templates/admin_header');
		$this->load->view('admin/index.php');
		$this->load->view('admin/view_poll.php',$data[0]);
		$this->load->view('templates/admin_footer');
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
