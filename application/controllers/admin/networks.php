<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Networks extends CI_Controller {

	protected $data = array();
	protected $type = 1;

	public function __construct(){
		parent::__construct();

		chk_admin();

		$this->load->model('networks_model');

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

		$data['items'] = $this->list_networks();
//echo '<pre>';
//print_r($data);
//echo '</pre>';

		//display
		$this->load->view('templates/header');
		$this->load->view('admin/index.php');
		$this->load->view('admin/list_networks.php',$data);
		$this->load->view('templates/footer');
	}


	/**
	 * list all networks
	 */
	public function list_networks(){

		//initial configurations for pagination
		$config['base_url'] = site_url('admin/networks/index');
		$config['total_rows'] = $this->networks_model->record_count($this->type);
		$config['per_page'] = PAGEITEMS;

		//if there are no networks at present ...
		if($config['total_rows']==0){
			$item->id				= '--';
			$item->title			= '--';
			$item->title_link		= '--';
			$item->link				= '--';
			$item->description		= '--';
			$item->created_by		= '--';
			$item->date_created		= '--';
			$item->date_published	= '--';
			$item->date_removed		= '--';
			$item->active			= '--';
			$item->homepage			= '--';
			$item->edit				= '--';
			$item->del				= '--';

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
		$data = $this->networks_model->get(array(),$config['per_page'],$page);

		foreach($data as $key=>$val){

			$str =	'<a href="'.site_url('admin/networks/view/'.$val->id).'">'.
						$val->title.
					'</a>';
			$data[$key]->title_link = $str;


			$str =	'<a href="'.site_url('admin/networks/edit/'.$val->id).'">edit</a>';
			$data[$key]->edit = $str;


			$str = 	'<form method="post" action="'.site_url('admin/networks/del/').'">'.
						'<input type="hidden" name="networks_id" value="'.$val->id.'"/>'.
						'<input type="submit" name="del" value="Delete"/>'.
					'</form>';
			$data[$key]->del = $str;


			//to convert the userid into username
			$tmp_user = $data[$key]->created_by;
			$data[$key]->created_by = $this->ion_auth->get_user((int)$tmp_user)->username;


			//add activate/deactivate button
			$str = '<form method="post" action='.site_url('admin/networks/active').'>'.
						'<input type="hidden" name="networks_id" value="'.$data[$key]->id.'"/>';
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
	 * activate/deactivate networks
	 */
	public function active(){
		$id = $this->input->post('networks');
		$active = $this->input->post('activate');
		$this->networks_model->change_active($id,$active);

		redirect('admin/networks');
	}


	/**
	 * networks form
	 */
    public function create(){

//print_r($this->data);
		$this->load->helper('utilites_helper');

		//generate username, current date if creating nu networks [not editing]
		if(!isset($this->data['date_created'])){
			$this->data['date_created'] = get_timestamp();
			$this->session->set_userdata('date_created',$this->data['date_created']);
		}
		if(!isset($this->data['created_by'])){
			$this->data['created_by'] = $this->ion_auth->get_user()->username;
//		}else{
//
//			//get the username of the person who created the networks
//			$this->data['created_by'] = $this->ion_auth->get_user($this->data['created_by'])->username;
		}

//print_r($this->data[0]);
//array_push($this->data,$this->data[0]);
//array_push($this->data,(array)$this->data[0]);
//array_merge($this->data[0],$this->data);
//echo '<pre>';
//print_r($this->data);
//echo '</pre>';
		//display
		$this->load->view('templates/header');
		$this->load->view('admin/index.php');
		$this->load->view('admin/create_networks.php', $this->data);
		$this->load->view('templates/footer');
	}



	/**
	 * save/update networks form
	 */
    public function save(){
		//save the neworks & return the id of that usefullinks
		$this->data['date_created'] = $this->session->userdata('date_created');
		$this->data['id'] = $this->networks_model->save($this->type);

		redirect('admin/networks');
/*
		//retrive that networks
		$this->get(array('id'=> $this->data['id']));

		//display that networks
		$this->create();
*/	}



	/**
	 * view selected networks
	 */
	public function view(){
		$id=false;
		$get_networks = array();

		foreach($this->uri->segment_array() as $key=>$val){
			if($val=='view'){
				$get_networks['id'] = $this->uri->segment($key+1);
				break;
			}
		}

		$data = $this->networks_model->get($get_networks);

		if(count($data)!=1){
			show_404();
		}

//print_r($data[0]);

		//display
		$this->load->view('templates/header');
		$this->load->view('admin/index.php');
		$this->load->view('admin/view_networks.php',$data[0]);
		$this->load->view('templates/footer');
	}


	/**
	 * edit selected networks
	 */
	public function edit(){
		$id=false;
		foreach($this->uri->segment_array() as $key=>$val){
			if($val=='edit'){
				$id = $this->uri->segment($key+1);
				break;
			}
		}

		$data = $this->networks_model->get(array('id'=>$id));

		if(count($data)!=1){
			show_404();
		}
		$this->data = (array)$data[0];
		$this->create();
	}


	/**
	 * get the [seleccted] networks
	 */
	public function get($networks_array=null){

		$data = $this->networks_model->get($networks_array);
//print_r(($data[0]));

		foreach($data[0] as $key=>$value){
			$this->data[$key] = $value;
		}
	}


	/**
	 * del selected networks
	 */
	public function del(){
//echo 'in delete polll';
		$this->networks_model->del_poll($this->input->post('networks_id'));

		redirect('admin/networks');
	}
}
