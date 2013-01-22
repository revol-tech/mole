<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Organizations extends CI_Controller {

	protected $data = array();
	protected $table = 'organizations'; 

	public function __construct(){

		parent::__construct();

		chk_admin();

	
		$this->load->model('organizations_model');


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

		$data['items'] = $this->list_organizations();
//echo '<pre>';
//print_r($data);
//echo '</pre>';

		//display
		$this->load->view('templates/admin_header');
		$this->load->view('admin/index.php');
		$this->load->view('admin/list_organizations.php',$data);
		$this->load->view('templates/admin_footer');
	}


	/**
	 * list all organizations
	 */
	public function list_organizations(){

		//initial configurations for pagination
		$config['base_url'] = site_url('admin/organizations/index');
		$config['total_rows'] = $this->organizations_model->record_count($this->table);
		$config['per_page'] = PAGEITEMS;

//print_r($data);
		//if there are no polls at present ...
		if($config['total_rows']==0){
			$item->id			='--';
			$item->title		='--';
			$item->title_link	='--';
			$item->disp_page	='--';
			$item->date_created	='--';
			$item->created_by	= '--';
			$item->date_published='--';
			$item->active		='--';
			$item->edit			='--';
			$item->del			='--';

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
		$data = $this->organizations_model->get(array(),$config['per_page'],$page);
		$this->load->helper('text');
		foreach($data as $key=>$val){

			$str =	'<a href="'.site_url('admin/organizations/view/'.$val->id).'">'.
						word_limiter($val->sub_title,5).

					'</a>';
			$data[$key]->sub_title_link = $str;


			$str =	'<a href="'.site_url('admin/organizations/edit/'.$val->id).'">edit</a>';
			$data[$key]->edit = $str;


			$str = 	form_open(site_url('admin/organizations/del/')).//'<form method="post" action="'.site_url('admin/acts/del/').'">'.
						'<input type="hidden" name="organizations_id" value="'.$val->id.'"/>'.
						'<input type="submit" name="del" value="Delete"/>'.
					'</form>';
			$data[$key]->del = $str;


			//to convert the userid into username
			$tmp_user = $data[$key]->created_by;
			$data[$key]->created_by = $this->ion_auth->get_user((int)$tmp_user)->username;


			//add activate/deactivate button
			$str = form_open(site_url('admin/organizations/active/')).
						'<input type="hidden" name="organizations_id" value="'.$data[$key]->id.'"/>';
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
	 * activate/deactivate organizations
	 */
	public function active(){
		$id = $this->input->post('organizations_id');
		$active = $this->input->post('activate');
		$this->acts_model->change_active($id,$active);

		redirect('admin/organizations');
	}


	/**
	 * organizations form
	 */
    public function create(){

		$title_dropdown = $this->organizations_model->get(null,null,null,true);

		if(count($title_dropdown)){
			$this->data['title_dropdown'] = '';
		$this->data['title_dropdown'] .= '<option></option>';
			foreach($title_dropdown as $key=>$val){
				$this->data['title_dropdown'] .= '<option>'.$val->title.'</option>';
				
			}
		}

		//generate username, current date if creating nu acts [not editing]
		if(!isset($this->data['date_created'])){
			$this->data['date_created'] = get_timestamp();
			$this->session->set_userdata('date_created',$this->data['date_created']);
		}
		if(!isset($this->data['created_by'])){
			$this->data['created_by'] = $this->ion_auth->get_user()->username;
		}else{

			//get the username of the person who created the acts
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
		$this->load->view('templates/admin_header');
		$this->load->view('admin/index.php');
		$this->load->view('admin/create_organizations.php', $this->data);
		$this->load->view('templates/admin_footer');
	}



	/**
	 * save/update organizations form
	 */
    public function save(){
		$data = $this->input->post();
		unset($data['submit']);
		
		//save the organizations & return the id of that acts
		$data['date_created'] = $this->session->userdata('date_created');
		$id = $this->organizations_model->save($data);

		//retrive that organization
		$this->get(array('id'=> $id));

//		$this->data['link'] = explode('/',$this->data['link']);
//		$this->data['link'] = $this->data['link'][1];

		//display that organizations
		redirect('admin/organizations');
	}



	/**
	 * view selected organizations
	 */
	public function view(){
		$get_id=array();
		//$get_acts = array('news_type'=>$this->type);

		foreach($this->uri->segment_array() as $key=>$val){
			if($val=='view'){
				$get_id['id'] = $this->uri->segment($key+1);
				break;
			}
		}

		$data = $this->organizations_model->get($get_id);

		if(count($data)!=1){
			show_404();
		}

//print_r($data[0]);

		//display
		$this->load->view('templates/admin_header');
		$this->load->view('admin/index.php');
		$this->load->view('admin/view_organizations.php',$data[0]);
		$this->load->view('templates/admin_footer');
	}


	/**
	 * edit selected organizations
	 */
	public function edit(){
		$id=false;
		foreach($this->uri->segment_array() as $key=>$val){
			if($val=='edit'){
				$id = $this->uri->segment($key+1);
				break;
			}
		}

		$data = $this->organizations_model->get(array('id'=>$id));
		if(count((array)$data)!=1){
			show_404();
		}

		$this->data = (array)$data[0];
//		$this->data['link'] = explode('/',$this->data['link']);
//		$this->data['link'] = $this->data['link'][1];

		$this->create();
	}


	/**
	 * get the [seleccted] organizations
	 */
	public function get($organizations_array=null){

		$data = $this->organizations_model->get($organizations_array);
//print_r(($data[0]));

		foreach($data[0] as $key=>$value){
			$this->data[$key] = $value;
		}
	}


	/**
	 * del selected organizations
	 */
	public function del(){
//echo 'in delete polll';
		$this->acts_model->del_poll($this->input->post('acts_id'));

		redirect('admin/acts');
	}
}
