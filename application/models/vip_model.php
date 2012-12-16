<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vip_model extends CI_Model{
	protected $table = 'vip';

	public function __construct(){
		parent::__construct();
		$this->load->library('upload');
	}


	/**
	 * get vip [of selected parameter]
	 */
	public function get($vip=null,$limit=null,$start=null){

		if($limit){
			$this->db->limit($limit,$start);
		}
		if(count($vip)>0){
			foreach($vip as $key=>$value){
				$this->db->where($key,$value);
			}
		}
		$res = $this->db->get($this->table);

		return $res->result();
	}


	/**
	 * render the slider images
	 *
	 * @return
	 */
	public function render_slider(){
		$data = $this->get(array('file_type'=>'slider'));

		$str=$this->_render_recursive($data,0);

		return $str;
	}

	/**
	 * for recursive rendering
	 */
	private function _render_recursive($data,$parent_id){
		$count = 1;

		$str = '<div id="slider" class="nivoSlider">';

		foreach($data as $k=>$v){

			$str.='<img src="'.DOCUMENTS.$v->timestamp.'"';
			$str.=' data-thumb="'.DOCUMENTS.$v->timestamp.'"';
			$str.=' alt="'.$v->title.'" title="#htmlcaption'.$count.'"';
			$str.=' />';

			$count++;
		}

		$str .= '</div>';

		$count = 1;
		foreach($data as $k=>$v){

			$str.='<div id="htmlcaption'.$count.'" class="nivo-html-caption">';
			$str.= $v->description;
			$str.='</div>';

			$count++;
		}

		return $str;
	}


	/**
	 * count records
	 */
	public function record_count(){
		return $this->db->count_all($this->table);
	}


	/**
	 * store & upload nu file
	 * returns the id
	 */
	public function upload($type=null){
//echo '<pre>';
//print_r($_FILES);
//print_r($_POST);
//echo '</pre>';

		$tmp = $_FILES['file']['name'];
		$ext =  end(explode('.',$tmp));
		$mtime = microtime(true).'.'.$ext;
//echo $mtime.'<br/>';
		$config = array(
					  'allowed_types' => 'jpg|jpeg|gif|png|txt|pdf|doc|docx',
					  'upload_path' => DOCUMENTS,
					  'maintain_ratio' => true,
					  'max-size' => 20000,
					  'width' => 2000,
					  'height' => 1500,
					  'overwrite' => true,
					  'file_name' => $mtime
					);
//echo '<pre>';
//print_r($config);
//echo '</pre>';


		$this->load->library('upload',$config);
		$this->upload->initialize($config);

		if(!$this->upload->do_upload('file')){
			echo $this->upload->display_errors();

		}else{


			$image_data = $this->upload->data();

			$data = array(
						'filename' 		=> $_FILES['file']['name'],
						'title' 		=> $this->input->post('title'),
						'description'	=> $this->input->post('description'),
						'timestamp'		=> $mtime,
						'created_by'	=> $this->ion_auth->get_user()->username,
						'date_created'	=> $this->session->userdata('date_created'),
						'file_type'		=> $type
					);

//print_r($_POST);
//print_r($data);die;
			$this->db->insert($this->table,$data);

			$data = array_merge($data,array('id'=>$this->db->insert_id()));

			return $data;
		}
	}



	/**
	 * delete vip
	 *
	 * @param array of enws ids to be deleted
	 * 		  OR int
	 * @return boolean
	 */
	public function del($ids){
		$vip = $this->get($ids);
//print_r($files);
		foreach($vip as $file){
			unlink(DOCUMENTS.$file->timestamp);
		}


		$this->db->where('id',$ids['id'])
				->delete($this->table);

		return true;
	}


	/**
	 * change the active poll
	 *
	 * @param id int
	 * @param active boolean
	 */
	public function change_active($ids=false,$active=false){

		$this->db->set(	'active',$active=='true'?1:0 )
				->where('id',$ids)
				->update('news');
	}


	/**
	 * download existing news
	 */
	private function download($data){

		$update = array(
					   'title' 		=> $data[0],
					   'content' 	=> $data[1],
					   'date_published' => $data[3],
					   'date_removed' => $data[4]
					);

		$this->db->where('id', $data['id']);
		$this->db->update('news', $update);

		return $data['id'];
	}
}

/* End of file news_model.php */
/* Location: ./application/models/news_model.php */