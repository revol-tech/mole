<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

	protected $data = array();
	protected $type = 6;

	public function __construct(){

		parent::__construct();

		chk_admin();

		$this->load->helper('ckeditor');
		$this->load->model('news_model','pages_model');

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

		$data['items'] = $this->list_pages();
//echo '<pre>';
//print_r($data);
//echo '</pre>';

		//display
		$this->load->view('templates/admin_header');
		$this->load->view('admin/index.php');
		$this->load->view('admin/list_pages.php',$data);
		$this->load->view('templates/admin_footer');
	}


	/**
	 * list all pages
	 */
	public function list_pages(){

		//initial configurations for pagination
		$config['base_url'] = site_url('admin/pages/index');
		$config['total_rows'] = $this->pages_model->record_count($this->type);
		$config['per_page'] = PAGEITEMS;

//print_r($data);
		//if there are no pages at present ...
		if($config['total_rows']==0){
			$item->id			='--';
			$item->title		='--';
			$item->title_link	='--';
			$item->date_created	='--';
			//$item->pages_type	='--';
			$item->created_by	= '--';
			$item->date_published='--';
			$item->homepage		='--';
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
		$data = $this->pages_model->get(array('news_type'=>$this->type),$config['per_page'],$page);

		foreach($data as $key=>$val){

			$str =	'<a href="'.site_url('admin/pages/view/'.$val->id).'">'.
						$val->title.
					'</a>';
			$data[$key]->title_link = $str;


			$str =	'<a href="'.site_url('admin/pages/edit/'.$val->id).'">edit</a>';
			$data[$key]->edit = $str;


			$str = 	form_open(site_url('admin/pages/del/')).//'<form method="post" action="'.site_url('admin/pages/del/').'">'.
						'<input type="hidden" name="pages_id" value="'.$val->id.'"/>'.
						'<input type="submit" name="del" value="Delete"/>'.
					'</form>';
			$data[$key]->del = $str;


			//to convert the userid into username
			$tmp_user = $data[$key]->created_by;
			$data[$key]->created_by = $this->ion_auth->get_user((int)$tmp_user)->username;


			//add activate/deactivate button
			$str = form_open(site_url('admin/pages/active/')).
						'<input type="hidden" name="pages_id" value="'.$data[$key]->id.'"/>';
			if($data[$key]->active == 1){
				$str .=	'<input type="hidden" name="activate" value="false"/>';
				$str .=	'<input type="submit" name="active"   value="Deactivate"/>';
			}else{
				$str .=	'<input type="hidden" name="activate" value="true"/>';
				$str .=	'<input type="submit" name="active"   value="Activate"/>';
			}
			$str .= '</form>';

			//display-hide page on homepage
			$str = form_open(site_url('admin/pages/homepage/')).//'<form method="post" action='.site_url('admin/pages/homepage').'>'.
						'<input type="hidden" name="pages_id" value="'.$data[$key]->id.'"/>';
			if($data[$key]->homepage == 1){
				$str .=	'<input type="hidden" name="homepage" value="false"/>';
				$str .=	'<input type="submit" name="active"   value="Deactivate"/>';
			}else{
				$str .=	'<input type="hidden" name="homepage" value="true"/>';
				$str .=	'<input type="submit" name="active"   value="Activate"/>';
			}
			$str .= '</form>';

			$data[$key]->homepage = $str;
		}

		return array('data'=>$data,'links'=>$this->pagination->create_links());
	}


	/**
	 * display-hide page on mainpage
	 */
	public function homepage(){
		$id = $this->input->post('pages_id');
		$active = $this->input->post('active');
		$this->pages_model->change_homepage($id,$active,6);

		redirect('admin/pages');
	}


	/**
	 * activate/deactivate pages
	 */
	public function active(){
		$id = $this->input->post('notice_id');
		$active = $this->input->post('activate');
		$this->pages_model->change_active($id,$active);

		redirect('admin/pages');
	}


	/**
	 * pages form
	 */
    public function create(){
		//generate WYSIWYG editor
		$this->_ckeditor_conf();
		//$this->data['generated_editor'] = display_ckeditor($this->data['ckeditor']);
		//$this->data['generated_editor2'] = display_ckeditor($this->data['ckeditor2']);

		//generate username, current date if creating nu pages [not editing]
		if(!isset($this->data['date_created'])){
			$this->data['date_created'] = get_timestamp();
			$this->session->set_userdata('date_created',$this->data['date_created']);
		}
		if(!isset($this->data['created_by'])){
			$this->data['created_by'] = $this->ion_auth->get_user()->username;
		}else{

			//get the username of the person who created the pages
//			$this->data['created_by'] = $this->ion_auth->get_user($this->data['created_by'])->username;
		}
		if(!isset($this->data['output'])){
			$this->data = array_merge($this->data, 
							array(	'output' 	=> '' , 
									'js_files' 	=> array() , 
									'css_files' => array()
								)
							);
		}
//array_push($this->data,$this->data[0]);
//array_push($this->data,(array)$this->data[0]);
//array_merge($this->data[0],$this->data);
//echo '<pre>';
//print_r($this->data);
//echo '</pre>';


		//display
		$this->load->view('templates/admin_header');
		$this->load->view('admin/index.php');
		$this->load->view('admin/create_pages.php', $this->data);
		$this->load->view('templates/admin_footer');
	}



	/**
	 * save/update pages form
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

		//save the pages & return the id of that pages
		$this->data['date_created'] = $this->session->userdata('date_created');
		$this->data['id'] = $this->pages_model->save($this->type);

		//retrive that pages
		$this->get(array('id'=> $this->data['id']));

		$this->data['link'] = explode('/',$this->data['link']);
		$this->data['link'] = $this->data['link'][1];

		//display that pages
		redirect('admin/pages');
	}



	/**
	 * view selected pages
	 */
	public function view(){
		$id=false;
		$get_pages = array('news_type'=>$this->type);

		foreach($this->uri->segment_array() as $key=>$val){
			if($val=='view'){
				$get_pages['id'] = $this->uri->segment($key+1);
				break;
			}
		}

		$data = $this->pages_model->get($get_pages);

		if(count($data)!=1){
			show_404();
		}

		//display
		$this->load->view('templates/admin_header');
		$this->load->view('admin/index.php');
		$this->load->view('admin/view_pages.php',$data[0]);
		$this->load->view('templates/admin_footer');
}


	/**
	 * edit selected pages
	 */
	public function edit(){
		$id=false;
		foreach($this->uri->segment_array() as $key=>$val){
			if($val=='edit'){
				$id = $this->uri->segment($key+1);
				break;
			}
		}

		$data = $this->pages_model->get(array('id'=>$id));
		if(count((array)$data)!=1){
			show_404();
		}

		$this->data = (array)$data[0];
		$this->data['link'] = explode('/',$this->data['link']);
		$this->data['link'] = $this->data['link'][1];

		$this->create();
	}


	/**
	 * get the [seleccted] pages
	 */
	public function get($pages_array=null){

		$data = $this->pages_model->get($pages_array);
//print_r(($data[0]));

		foreach($data[0] as $key=>$value){
			$this->data[$key] = $value;
		}
	}


	/**
	 * del selected pages
	 */
	public function del(){
		$this->pages_model->del_poll($this->input->post('pages_id'));

		redirect('admin/pages');
	}



	/**
	 * ckEditor's configurations.
	 */
	private function _ckeditor_conf(){
		//Ckeditor's configuration
		$this->data['ckeditor'] = array(
			//ID of the textarea that will be replaced
			'id' 	=> 	'content',
			'path'	=>	CKEDITOR,
		);
		$this->data['ckeditor2'] = array(
			//ID of the textarea that will be replaced
			'id' 	=> 	'content_np',
			'path'	=>	CKEDITOR,
		);
	}
}
