<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notices extends CI_Controller {

	protected $data = array();
	protected $type = 2;

	public function __construct(){

		parent::__construct();

		chk_admin();

		$this->load->helper('ckeditor');
		$this->load->model('news_model','notices_model');

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

		$data['items'] = $this->list_notices();
//echo '<pre>';
//print_r($data);
//echo '</pre>';

		//display
		$this->load->view('templates/admin_header');
		$this->load->view('admin/index.php');
		$this->load->view('admin/list_notices.php',$data);
		$this->load->view('templates/admin_footer');
	}


	/**
	 * list all notices
	 */
	public function list_notices(){

		//initial configurations for pagination
		$config['base_url'] = site_url('admin/notices/index');
		$config['total_rows'] = $this->notices_model->record_count($this->type);
		$config['per_page'] = PAGEITEMS;

		//if there are no polls at present ...
		if($config['total_rows']==0){
			$item->id			='--';
			$item->title		='--';
			$item->title_link	= '--';
			$item->date_created	='--';
			$item->notices_type	='--';
			$item->created_by	= '--';
			$item->date_published='--';
			$item->edit			= '--';
			$item->del			= '--';
			$item->active		= '--';

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
		$data = $this->notices_model->get(array('news_type'=>$this->type),$config['per_page'],$page);


		foreach($data as $key=>$val){
			$str =	'<a href="'.site_url('admin/notices/view/'.$val->id).'">'.
						$val->title.
					'</a>';
			$data[$key]->title_link = $str;


			$str =	'<a href="'.site_url('admin/notices/edit/'.$val->id).'">edit</a>';
			$data[$key]->edit = $str;


			$str = 	form_open(site_url('admin/notices/del/')).//'<form method="post" action="'.site_url('admin/notices/del/').'">'.
						'<input type="hidden" name="notices_id" value="'.$val->id.'"/>'.
						'<input type="submit" name="del" value="Delete"/>'.
					'</form>';
			$data[$key]->del = $str;


			//to convert the userid into username
			$tmp_user = $data[$key]->created_by;
			$data[$key]->created_by = $this->ion_auth->get_user((int)$tmp_user)->username;


			//add activate/deactivate button
			$str = form_open(site_url('admin/notices/active/')).//'<form method="post" action='.site_url('admin/notices/active').'>'.
						'<input type="hidden" name="notices_id" value="'.$data[$key]->id.'"/>';
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
	 * activate/deactivate notices
	 */
	public function active(){
		$id = $this->input->post('notices_id');
		$active = $this->input->post('activate');
		$this->notices_model->change_active($id,$active);

		redirect('admin/notices');
	}


	/**
	 * notices form
	 */
    public function create(){
		//generate WYSIWYG editor
		$this->_ckeditor_conf();
		$this->data['generated_editor'] = display_ckeditor($this->data['ckeditor']);
		$this->data['generated_editor2'] = display_ckeditor($this->data['ckeditor2']);

		//generate username, current date if creating nu notices [not editing]
		if(!isset($this->data['date_created'])){
			$this->data['date_created'] = get_timestamp();
			$this->session->set_userdata('date_created',$this->data['date_created']);
		}
		if(!isset($this->data['created_by'])){
			$this->data['created_by'] = $this->ion_auth->get_user()->username;
		}else{

			//get the username of the person who created the notices
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
		$this->load->view('admin/create_notices.php', $this->data);
		$this->load->view('templates/admin_footer');
	}



	/**
	 * save/update notices form
	 */
    public function save(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[5]|xss_clean');
		$this->form_validation->set_rules('title_np', 'Nepali Title', 'trim|required|min_length[5]|xss_clean');
		$this->form_validation->set_rules('content', 'Content', 'trim|required|min_length[5]|xss_clean');
		$this->form_validation->set_rules('content_np', 'Nepali Content', 'trim|required|min_length[5]|xss_clean');
		if($this->form_validation->run()==false){
			//$this->data = $data;
			return $this->create();
		}

		//save the notices & return the id of that notices
		$this->data['date_created'] = $this->session->userdata('date_created');
		$this->data['id'] = $this->notices_model->save($this->type);

		//retrive that notices
		$this->get(array('id'=> $this->data['id']));

		////display that notices
		//$this->create();\
		redirect('admin/notices');
	}



	/**
	 * view selected notices
	 */
	public function view(){
		$id=false;
		$get_notices = array('news_type'=>$this->type);

		foreach($this->uri->segment_array() as $key=>$val){
			if($val=='view'){
				$get_notices['id'] = $this->uri->segment($key+1);
				break;
			}
		}

		$data = $this->notices_model->get($get_notices);

		if(count($data)!=1){
			show_404();
		}

//print_r($data[0]);

		//display
		$this->load->view('templates/admin_header');
		$this->load->view('admin/index.php');
		$this->load->view('admin/view_notices.php',$data[0]);
		$this->load->view('templates/admin_footer');
}


	/**
	 * edit selected notices
	 */
	public function edit(){
		$id=false;
		foreach($this->uri->segment_array() as $key=>$val){
			if($val=='edit'){
				$id = $this->uri->segment($key+1);
				break;
			}
		}

		$data = $this->notices_model->get(array('id'=>$id));

		if(count((array)$data)!=1){
			show_404();
		}

		$this->data = (array)$data[0];
		$this->create();
	}


	/**
	 * get the [seleccted] notices
	 */
	public function get($notices_array=null){

		$data = $this->notices_model->get($notices_array);
//print_r(($data[0]));

		foreach($data[0] as $key=>$value){
			$this->data[$key] = $value;
		}
	}


	/**
	 * del selected notices
	 */
	public function del(){
//echo 'in delete polll';
		$this->notices_model->del_poll($this->input->post('notices_id'));

		redirect('admin/notices');
	}



	/**
	 * ckEditor's configurations.
	 */
	private function _ckeditor_conf(){
		//Ckeditor's configuration
		$this->config->load('ckeditor');

		$this->data['ckeditor'] = array(
			//ID of the textarea that will be replaced
			'id' 	=> 	'content',
			'path'	=>	CKEDITOR,
			'config'=>	array(
							'toolbar' 	=> 	$this->config->item('ck_toolbar'),
						),
		);
		$this->data['ckeditor2'] = array(
			//ID of the textarea that will be replaced
			'id' 	=> 	'content_np',
			'path'	=>	CKEDITOR,
			'config'=>	array(
							'toolbar' 	=> 	$this->config->item('ck_toolbar'),
						),
		);
	}
}
