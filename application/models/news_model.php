<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News_model extends CI_Model{
	public function __construct()
	{
		parent::__construct();
	}


	//store nu news
	public function save(){
		$data = array(
					$this->input->post('title'),
					htmlentities($this->input->post('content')),
					$this->session->userdata('user_id'),
					$this->input->post('date_published'),
					$this->input->post('date_removed')
				);

		$sql =	'insert into news ('.
					'title,			content,		news_type,'.
					'created_by,	date_created,	date_published,'.
					'date_removed'.
				')values ( ?, ?, 1,?,NOW(),?,?);';

		if(! $this->db->query($sql,$data)){
			return $this->db->_error_message();
		}

//echo $this->db->last_query();
		return 'true';
	}



	//get news
	public function get(){
/*
		->where('title',$this->data['title'])
		->where('content',$this->data['content'])
		->where('news_type',$this->data['news_type'])
		->where('created_by',$this->data['created_by'])
		->where('date_created',$this->data['date_created'])
		->where('date_published',$this->data['date_published'])
		->where('date_removed', $this->data['date_removed'])

		$res = $this->db->get('news')

//echo $this->db->last_query();
		return $res->result();
*/
	}
}

/* End of file news_model.php */
/* Location: ./application/models/n_model.php */