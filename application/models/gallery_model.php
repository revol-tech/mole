<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery_model extends CI_Model{
	protected $table_album= 'album';
	protected $table_imgs = 'imgs';

	public function __construct(){
		parent::__construct();
		$this->load->library('upload');
	}


	/**
	 * get album(s) [of selected id]
	 */
	public function get($album_id=null,$limit=null,$start=null){

		if($limit){
			$this->db->limit($limit,$start);
		}
		if($album_id){
			$this->db->where('id',$album_id);
		}
		$res = $this->db->get($this->table_album);

		return $res->result();
	}

	/**
	 * render acivities album for landing page
	 */
	public function render(){
		$str = '<div class="gallery_thumnail fl">';
		$data = $this->get();

		if(count($data)>0){
			foreach($data as $key=>$val){
				$str.='<div class="block_img3 fl alpha">;';
				$str.='	<a href="#">';
				$str.='		<img src="'.IMGPATH.'gallery/gallery_1.png" alt="labour day" title="" width="140" height="100"/>';
				//$str.='		<span>'.$key->title.'</span>';
				$str.='	</a>';
				$str.='</div>';
			}
		}
		$str.= '</div><a href="#" class="view_all">View All Gallery +</a>';
	}

	/**
	 * count records
	 */
	public function record_count(){
		return $this->db->count_all($this->table_album);
	}

	/**
	 * count photos in the given album
	 */
	public function count_photos($id){
		$this->db->where('album_id');
		$this->db->get($this->table_imgs);
	}

	/**
	 * save nu album
	 */
	public function save_album($album=null){
		if((count($album))<1)
			return false;
echo 'a';
		if($this->db->insert($this->table_album,$album)){
echo $this->db->last_query();
echo 'b';
			return $this->db->insert_id();
		}
echo 'c';

		return false;
	}


	/**
	 * delete album
	 *
	 * @param int
	 * @return boolean
	 */
	public function del($id){

		//del photos of that album
		$this->del_imgs($id);

		$this->db->where('id',$id)
				->delete($this->table_album);

		return true;
	}






	/**
	 * store & upload nu imgs
	 * returns the id
	 */
	public function upload(){
//echo '<pre>';
//print_r($_FILES);
//print_r($_POST);
//echo '</pre>';

		$tmp = $_FILES['file']['name'];
		$ext =  end(explode('.',$tmp));
		$mtime = microtime(true).'.'.$ext;
//echo $mtime.'<br/>';
		$config = array(
					  'allowed_types' => 'jpg|jpeg|gif|png',
					  'upload_path'   => DOCUMENTS,
					  'maintain_ratio'=> true,
					  'max-size' 	  => 20000,
					  'width' 		  => 2000,
					  'height' 		  => 1500,
					  'overwrite' 	  => true,
					  'file_name' 	  => $mtime
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
						'date_created'	=> $this->session->userdata('date_created')
					);

//print_r($_POST);
//print_r($data);die;
			$this->db->insert($this->table,$data);

			$data = array_merge($data,array('id'=>$this->db->insert_id()));

			return $data;
		}
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
