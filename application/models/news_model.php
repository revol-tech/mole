<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News_model extends CI_Model{

	//the table to be used in the db
	private $table = 'news';

	public function __construct(){
		parent::__construct();
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
				->update($this->table);
	}


	/**
	 * update existing news
	 */
	private function update($data){

		$update = array(
					   'title' 		=> $data[0],
					   'content' 	=> $data[1],
					   'date_published' => $data[3],
					   'date_removed' => $data[4]
					);

		$this->db->where('id', $data['id']);
		$this->db->update($this->table, $update);

		return $data['id'];
	}


	/**
	 * store nu news
	 * returns the id
	 */
	public function save($type=1){
		$data = array(
					$this->input->post('title'),
					htmlentities($this->input->post('content')),
					$this->session->userdata('user_id'),
					$this->session->userdata('date_created'),
					$this->input->post('date_published'),
					$this->input->post('date_removed')
				);

		//update existing news
		if(($this->input->post('id'))){
			$data['id'] = $this->input->post('id');

			return $this->update($data);


		//insert new news
		}else{
			$sql =	'insert into '.$this->table.' ('.
						'title,			content,		news_type,'.
						'created_by,	date_created,	date_published,'.
						'date_removed'.
					')values ( ?, ?, '.$type.',?,?,?,?);';

			if(! $this->db->query($sql,$data)){
				return $this->db->_error_message();
			}

			return $this->db->insert_id();
		}
	}


	/**
	 * get news [of selected parameter]
	 */
	public function get($news,$limit=null,$start=null){

		if($limit){
			$this->db->limit($limit,$start);
		}
		if($news){
			foreach($news as $key=>$value){
				$this->db->where($key,$value);
			}
		}
		$res = $this->db->get($this->table);

		foreach($res->result() as $value){
			$value->created_by = $this->ion_auth->get_user($value->created_by)->username;
			$value->content = html_entity_decode($value->content,ENT_QUOTES, 'UTF-8');
		}
		return $res->result();
	}


	/**
	 * count records
	 */
	public function record_count($type){
		$this->db->where('news_type',$type);
		$x = $this->db->count_all_results($this->table);

		return $x;
	}



	/**
	 * delete news
	 *
	 * @param array of enws ids to be deleted
	 * 		  OR int
	 * @return boolean
	 */
	public function del_poll($ids){
		$this->db->where('id',$ids)
				->delete($this->table);

		return true;

	}
}

/* End of file news_model.php */
/* Location: ./application/models/news_model.php */