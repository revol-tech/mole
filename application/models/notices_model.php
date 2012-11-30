<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notices_model extends CI_Model{
	public function __construct()
	{
		parent::__construct();
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
	 * store nu Notie
	 * returns the id
	 */
	public function save(){
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
					')values ( ?, ?, 1,?,?,?,?);';

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
		foreach($news as $key=>$value){
			$this->db->where($key,$value);
		}
		$res = $this->db->get('news');
//echo $this->db->last_query();
//print_r($res->result());
		return $res->result();
	}
}

/* End of file news_model.php */
/* Location: ./application/models/news_model.php */