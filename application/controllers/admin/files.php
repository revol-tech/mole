<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Files extends CI_Controller {

	public $data = array();

	public function __construct(){
		parent::__construct();

		chk_admin();

		$this->load->model('files_model');

		/**
		 * set headers to prevent back after logout
		 */
		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
	}


	public function index(){

		$data['items'] = $this->list_files();

		//display
		$this->load->view('templates/admin_header');
		$this->load->view('admin/index.php');
		$this->load->view('admin/list_files.php',$data);
		$this->load->view('templates/admin_footer');
	}


	/**
	 * list all files
	 */
	private function list_files(){

		//initial configurations for pagination
		$config['base_url'] = site_url('admin/files/index');
		$config['total_rows'] = $this->files_model->record_count(array('file_type is null'=>null));
//echo $this->db->last_query();		
		$config['per_page'] = PAGEITEMS;


		//if no data, set then to display null
		if($config['total_rows']==0){
			$item->id			='--';
			$item->filename		='--';
			$item->title		='--';
			$item->title_link	='--';
			$item->description	='--';
			$item->timestamp	='--';
			$item->date_created	='--';
			$item->press_type	='--';
			$item->created_by	= '--';
			$item->date_published='--';
			$item->download		='--';
			$item->del			='--';

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
		$data = $this->files_model->get(array('file_type is null'=>null),$config['per_page'],$page);

		//enhance data as reqd.
		foreach($data as $key=>$val){

			//href for the page
			$str =	'<a href="'.site_url('admin/files/view/'.$val->id).'">'.
						$val->title.
					'</a>';
			$data[$key]->title_link = $str;

			//del for the data
			$str = 	form_open(site_url('admin/files/del/')).//'<form method="post" action="'.site_url('admin/files/del/').'">'.
						'<input type="hidden" name="files_id" value="'.$val->id.'"/>'.
						'<input type="submit" name="del" value="Delete"/>'.
					'</form>';
			$data[$key]->del = $str;

			//download the file
			$str =	'<a href="'.site_url('admin/files/download/'.$val->id).'">
						download
					</a>';
			$data[$key]->download = $str;


			//convert the userid into username
			$tmp_user = $data[$key]->created_by;
			$data[$key]->created_by = $this->ion_auth->get_user((int)$tmp_user)->username;
		}

		return array('data'=>$data,'links'=>$this->pagination->create_links());
	}


	/**
	 * files form
	 */
    public function upload(){

		if($this->input->post('upload')){
			//upload the file
			$result = $this->files_model->upload();
			$result['status'] = 'file uploaded';

			//get uploaded file's info.
			$this->data = array_merge($this->data,array('result'=>$result));

			redirect('admin/files');
		}


		//generate username, current date if creating nu files [not editing]
		$this->data['date_created'] = get_timestamp();
		$this->session->set_userdata('date_created',$this->data['date_created']);
		$this->data['created_by'] = $this->ion_auth->get_user()->username;

		//display
		$this->load->view('templates/admin_header');
		$this->load->view('admin/index.php');
		$this->load->view('admin/upload_files.php',$this->data);
		$this->load->view('templates/admin_footer');
	}


	/**
	 * del selected files
	 */
	public function del(){
		$this->files_model->del(array('id'=>$this->input->post('files_id')));

		redirect('admin/files');
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

		$data = $this->files_model->get($get_file);

//print_r($this->input->post());
//print_r($data);
		//display
		$this->load->view('templates/admin_header');
		$this->load->view('admin/index.php');
		$this->load->view('admin/view_files.php',$data[0]);
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

		$data = $this->files_model->get($get_file);

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
