<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vip extends CI_Controller {

	public $data = array();

	public function __construct(){
		parent::__construct();

		chk_admin();

		$this->load->model('vip_model');

		/**
		 * set headers to prevent back after logout
		 */
		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
	}


	public function index(){

		$data['items'] = $this->list_vip();

		//display
		$this->load->view('templates/admin_header');
		$this->load->view('admin/index.php');
		$this->load->view('admin/list_vip.php',$data);
		$this->load->view('templates/admin_footer');
	}


	/**
	 * list all vip
	 */
	private function list_vip(){

		//initial configurations for pagination
		$config['base_url'] = site_url('admin/vip/index');
		$config['total_rows'] = $this->vip_model->record_count();
		$config['per_page'] = PAGEITEMS;


		//if no data, set then to display null
		if($config['total_rows']==0){
			$item->id			= '--';
			$item->filename		= '--';
			$item->title		= '--';
			$item->title_link	= '--';
			$item->description	= '--';
			$item->timestamp	=' --';
			$item->date_created	= '--';
			$item->press_type	=' --';
			$item->created_by	= '--';
			$item->date_published='--';
			$item->active		= '--';
			$item->edit			= '--';
			$item->del			= '--';

			return array('data'=>array($item));
		}

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
		$data = $this->vip_model->get(null,$config['per_page'],$page);

		//enhance data as reqd.
		foreach($data as $key=>$val){

			//href for the page
			$str =	'<a href="'.site_url('admin/vip/view/'.$val->id).'">'.
						$val->title.
					'</a>';
			$data[$key]->title_link = $str;

			//del for the data
			$str = 	form_open(site_url('admin/vip/del/')).//'<form method="post" action="'.site_url('admin/vip/del/').'">'.
						'<input type="hidden" name="vip_id" value="'.$val->id.'"/>'.
						'<input type="submit" name="del" value="Delete"/>'.
					'</form>';
			$data[$key]->del = $str;

			//edit
			$str =	'<a href="'.site_url('admin/vip/edit/'.$val->id).'">
						edit
					</a>';
			$data[$key]->edit = $str;


			//convert the userid into username
			$tmp_user = $data[$key]->created_by;
			$data[$key]->created_by = $this->ion_auth->get_user((int)$tmp_user)->username;

			//add activate/deactivate button
			$str = form_open(site_url('admin/vip/active/')).
						'<input type="hidden" name="vips_id" value="'.$data[$key]->id.'"/>';
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
		$id = $this->input->post('vips_id');
		$active = $this->input->post('activate');
		$this->vip_model->change_active($id,$active);

		redirect('admin/vip');
	}

	/**
	 * vip form
	 */
    public function upload(){

		if($this->input->post('upload')){
			//upload the file
			$result = $this->vip_model->upload();
			$result['status'] = 'file uploaded';

			//get uploaded file's info.
			$this->data = array_merge($this->data,array('result'=>$result));

			redirect('admin/vip');
		}


		//generate username, current date if creating nu vip [not editing]
		$this->data['date_created'] = get_timestamp();
		$this->session->set_userdata('date_created',$this->data['date_created']);
		$this->data['created_by'] = $this->ion_auth->get_user()->username;

		//display
		$this->load->view('templates/admin_header');
		$this->load->view('admin/index.php');
		$this->load->view('admin/upload_vip.php',$this->data);
		$this->load->view('templates/admin_footer');
	}

	/**
	 * edit selected vip
	 */
	public function edit(){
echo 'editing is not good yet ...';		
return ;
		$id=false;
		foreach($this->uri->segment_array() as $key=>$val){
			if($val=='edit'){
				$id = $this->uri->segment($key+1);
				break;
			}
//			show_error('Invalid link');
		}

		$data = $this->vip_model->get(array('id'=>$id));
		if(count((array)$data)!=1){
			show_404();
		}
		$this->data = (array)$data[0];
		$this->upload();
	}


	/**
	 * del selected vip
	 */
	public function del(){
		$this->vip_model->del(array('id'=>$this->input->post('vip_id')));

		redirect('admin/vip');
	}


	/**
	 * view uploaded file
	 */
	public function view(){
		$get_file = array();

		foreach($this->uri->segment_array() as $key=>$val){
			if($val=='view'){
				$get_file['id'] = $this->uri->segment($key+1);
				break;
			}
		}

		$data = $this->vip_model->get($get_file);

//print_r($this->input->post());
//print_r($data);
		//display
		$this->load->view('templates/admin_header');
		$this->load->view('admin/index.php');
		$this->load->view('admin/view_vip.php',@$data[0]);
		$this->load->view('templates/admin_footer');
	}


	/**
	 * download selected health
	 */
	public function download(){
		$id=false;
		$get_file = array();

		foreach($this->uri->segment_array() as $key=>$val){
			if($val=='download'){
				$get_file['id'] = $this->uri->segment($key+1);
				break;
			}
		}

		$data = $this->vip_model->get($get_file);

		if(count($data)!=1){
			show_404();
		}

		//print_r($data[0]);
		$this->load->helper('download');

		$file_data = file_get_contents(DOCUMENTS.$data[0]->timestamp); // Read the file's contents
		$file_name = $data[0]->filename;

		force_download($file_name, $file_data);
	}
}
