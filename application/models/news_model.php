<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News_model extends CI_Model{
	public function __construct()
	{
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
				->update('news');
	}


	/**
	 * update existing news
	 */
	private function update($data){
//		$sql = 'UPDATE `news` SET'.
//					'`title`="'.$data[0].'",		`content`="'.$data[1].'",'.
//					'`date_published`='.$data[3].',	`date_removed`='.$data[4].''.
//				'WHERE `id`='.$data['id'].';';


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
			$sql =	'insert into news ('.
						'title,			content,		news_type,'.
						'created_by,	date_created,	date_published,'.
						'date_removed'.
					')values ( ?, ?, '.$type.',?,?,?,?);';

			if(! $this->db->query($sql,$data)){
				return $this->db->_error_message();
			}

//echo $this->db->last_query();
			return $this->db->insert_id();
		}
	}



	/**
	 * get news [of selected parameter]
	 */
	public function get($news){
//print_r($news);
		foreach($news as $key=>$value){
			$this->db->where($key,$value);
		}
		$res = $this->db->get('news');
//echo $this->db->last_query();

		foreach($res->result() as $value){
//print_r($value->created_by);
$value->created_by = $this->ion_auth->get_user($value->created_by)->username;


			$value->content = html_entity_decode($value->content,ENT_QUOTES, 'UTF-8');
		}
//print_r($res->result());
		return $res->result();
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
				->delete('news');

		return true;

	}
}

/* End of file news_model.php */
/* Location: ./application/models/news_model.php */