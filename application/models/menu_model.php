<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu_model extends CI_Model{

	/**
	 * tablename in db which holds the menu/links info
	 */
	private $table = 'menu';


	public function __construct(){
		parent::__construct();

		$this->load->library('form_validation');
//$this->output->enable_profiler(true);
	}

	/**
	 * update existing link
	 *
	 * @param array updated item
	 * @return int
	 */
	public function update($data){

		$id = $data['id'];
		unset($data['id']);

		$this->db->where('id', $id);
		$this->db->update($this->table, $data);

		return $id;
	}


	/**
	 * chk for unique link & menu title
	 */
	private function _validate(){
		$arr = array();
		if($this->input->post('link') || $this->input->post('title')){

			array_merge($arr, $this->get(array('link'=>$this->input->post('link'))));
			array_merge($arr, $this->get(array('title'=>$this->input->post('title'))));
			if(count($arr) > 0){
				return false;
			}
		}

		return true;
	}


	/**
	 * store nu link
	 *
	 * @return int id
	 */
	public function save($data){
		if(($this->input->post('id'))){
		//update existing link

			$data['id'] = $this->input->post('id');
			return $this->update($data);


		}else{
		//insert new link
			$count = $this->db->select('count(*) AS COUNT')
						->where('parent_id',$data['parent_id'])
						->get($this->table);
			$tmp = $count->result();
			$data['sort_order']=$tmp[0]->COUNT;

			if(! $this->db->insert($this->table,$data)){
				return $this->db->_error_message();
			}


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
		$this->db->order_by('parent_id','asc');
		$this->db->order_by('sort_order','asc');
		$res = $this->db->get($this->table);

		return $res->result();
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

		return true;
	}

	/*
	 * change order of the two links 
	 */
	public function change($id1,$id2){
		$tmp = $this->db->select('sort_order')
				->where('id',$id1)
				->get($this->table);
		$tmp1 = $tmp->result();

		$tmp = $this->db->select('sort_order')
				->where('id',$id2)
				->get($this->table);
		$tmp2 = $tmp->result();

		$this->db->set('sort_order',$tmp1[0]->sort_order)
				->where('id',$id2)
				->update($this->table);

		$this->db->set('sort_order',$tmp2[0]->sort_order)
				->where('id',$id1)
				->update($this->table);
	}
}

/* End of file menu_model.php */
/* Location: ./application/models/menu_model.php */
