<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Links_model extends CI_Model{

	/**
	 * tablename in db which holds the menu/links info
	 */
	private $table = 'links';


	public function __construct(){
		parent::__construct();

		$this->load->library('form_validation');
	}


	/**
	 * store nu link
	 *
	 * @return int id
	 */
	public function save($data){
//print_r($data);die;
		if(isset($data['id'])){
		//update existing link

//print_r($data);
//print_r('asdf');
			return $this->update($data);

		}else{
		//insert new link

			if(! $this->db->insert($this->table,$data)){
				return $this->db->_error_message();
			}

//echo $this->db->last_query();
			return $this->db->insert_id();
		}
	}

	/**
	 * get link [of selected parameter]
	 */
	public function get($data=null,$limit=null,$start=null){

		if($limit){
			$this->db->limit($limit,$start);
		}
		if(count($data)){
			foreach($data as $key=>$value){
				$this->db->where($key,$value);
			}
		}

		$res = $this->db->get($this->table);

		return $res->result();
	}

	
	/**
	 * chk if a link exists.
	 * useful to check before storing nu/updated link
	 */
	public function link_chk($data){
		$test = $this->get($data);
		
		return (count($test)>0);
	}


	/**
	 * update existing link
	 *
	 * @param array updated item
	 * @return int
	 */
	public function update($data){

//print_r($data);
		$id = $data['id'];
		unset($data['id']);

		$this->db->where('id', $id);
//print_r($data);
		$this->db->update($this->table, $data);

		return $id;
	}













	/**
	 * chk for unique link & menu title
	 */
	private function _validate(){
		$arr = array();
		if($this->input->post('link') || $this->input->post('title')){
//print_r(array('link'=>$this->input->post('link',true)));
//echo 'asdf';
//print_r($this->get(array('link'=>$this->input->post('link',true))));

			array_merge($arr, $this->get(array('link'=>$this->input->post('link'))));
			array_merge($arr, $this->get(array('title'=>$this->input->post('title'))));
//print_r(count($arr));
			if(count($arr) > 0){
				return false;
			}
		}

		return true;
	}


	/**
	 * count records
	 */
	public function record_count(){
		return $this->db->count_all($this->table);
	}


	/**
	 * delete link
	 *
	 * @param array of ids to be deleted
	 * 		  OR int
	 * @return boolean
	 */
	public function del($ids){
		$this->db->where('id',$ids)
				->or_where('parent_id',$ids)
				->delete($this->table);

//echo $this->db->last_query();
		return true;
	}

}

/* End of file lniks_model.php */
/* Location: ./application/models/links_model.php */
