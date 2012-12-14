<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usefullinks_model extends CI_Model{

	//the table to be used in the db
	private $table = 'usefullinks';

	public function __construct(){
		parent::__construct();
	}

	/**
	 * dispay-hide the usefullinks on homepage
	 *
	 * @param id int
	 * @param active boolean
	 */
	public function change_homepage($ids=false,$active=false,$type){

		$this->db->set(	'homepage',$active=='Activate'?1:0 )
				->where('id',$ids)
				->where('usefullinks_type',$type)
				->update($this->table);
//echo $this->db->last_query();echo '<br/>';
		$this->db->set(	'homepage',0 )
				->where('id !=',$ids)
				->where('usefullinks_type',$type)
				->update($this->table);
//echo $this->db->last_query();echo '<br/>';
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
	 * update existing usefullinks
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
	 * store nu usefullinks
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

		//update existing usefullinks
		if(($this->input->post('id'))){
			$data['id'] = $this->input->post('id');

			return $this->update($data);


		//insert new usefullinks
		}else{
			$sql =	'insert into '.$this->table.' ('.
						'title,			content,		usefullinks_type,'.
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
	 * get usefullinks [of selected parameter]
	 */
	public function get($usefullinks,$limit=null,$start=null){

		if($limit){
			$this->db->limit($limit,$start);
		}
		if($usefullinks){
			foreach($usefullinks as $key=>$value){
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
	 * render usefullinks for display
	 */
	public function render($params){
		$this->load->helper('text');
		$data = $this->get($params);

		$str = '<div class="about">';
		$str.= '<h1>'.$data[0]->title.'</h1>';
		$str.= '<p>'.word_limiter($data[0]->content,50).'</p>';
		$str.= '<a href="#" class="btn_red fr">read more</a>'; // <--- link not set properly
		$str.= '</div>';

		return $str;
	}

	/**
	 * count records
	 */
	public function record_count($type){
		$this->db->where('usefullinks_type',$type);
		$x = $this->db->count_all_results($this->table);

		return $x;
	}



	/**
	 * delete usefullinks
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

/* End of file usefullinks_model.php */
/* Location: ./application/models/usefullinks_model.php */
