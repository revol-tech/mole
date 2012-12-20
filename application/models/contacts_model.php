<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contacts_model extends CI_Model{

	//the table to be used in the db
	private $table = 'contacts';

	public function __construct(){
		parent::__construct();
	}

	/**
	 * dispay-hide the contacts on homepage
	 *
	 * @param id int
	 * @param active boolean
	 */
	public function change_homepage($ids=false,$active=false,$type){

		$this->db->set(	'homepage',$active=='Activate'?1:0 )
				->where('id',$ids)
				->where('contacts_type',$type)
				->update($this->table);
//echo $this->db->last_query();echo '<br/>';
		$this->db->set(	'homepage',0 )
				->where('id !=',$ids)
				->where('contacts_type',$type)
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
	 * update existing contacts
	 */
	private function update($data){
		$this->db->where('id', $data['id']);
		$this->db->update($this->table, $data);
	}


	/**
	 * store nu contacts
	 * returns the id
	 */
	public function save($type=1){
		$data = array(
					'address'	=> htmlentities($this->input->post('address')),
					'tel'		=> $this->input->post('tel'),
					'fax'		=> $this->input->post('fax'),
					'email'		=> $this->input->post('email'),
					'created_by'=> $this->session->userdata('user_id'),
					'date_created'=>$this->session->userdata('date_created'),
					'date_published'=>$this->input->post('date_published'),
					'date_removed'	=> $this->input->post('date_removed'),
					'active'	=>$this->input->post('active'),
					'homepage' => $this->input->post('homepage'),
				);

		//update existing contacts
		if(strlen($this->input->post('id'))){
			$data['id'] = $this->input->post('id');

			return $this->update($data);


		//insert new contacts
		}else{

			if(! $this->db->insert($this->table,$data)){
				return $this->db->_error_message();
			}

			return $this->db->insert_id();
		}
	}


	/**
	 * get contacts [of selected parameter]
	 */
	public function get($contacts=null,$limit=null,$start=null){
		$res = $this->db->get($this->table);

		foreach($res->result() as $value){
			$value->created_by = $this->ion_auth->get_user($value->created_by)->username;
		}
		return $res->result();
	}

	/**
	 * render contacts for display
	 */
	public function render(){
		$data = $this->contacts_model->get();
//print_r($data);		die;
		if(!(count($data)>0))
			return '';
		
		$str = 	'<div class="grid_7 address pad_alpha border_rt_gray">
					<h3><span>Contact</span> Details</h3>'.
					$data[0]->address.
					'<div class="contact_holder">
						<div class="tel">
							<p><strong>T</strong><span>'.$data[0]->tel.'</span></p>
							<p><strong>F</strong><span>'.$data[0]->fax.'</span></p>
						</div>
					</div>
					<div class="contact_holder">
						<div class="email"><a href="mailto:'.$data[0]->email.'">'.$data[0]->email.'</a></div>
					</div>
				</div>';

		return $str;
	}

	/**
	 * count records
	 */
	public function record_count($type){
		//$this->db->where('contacts_type',$type);	// <<---- invalid .......????!!!!!
		$x = $this->db->count_all_results($this->table);

		return $x;
	}



	/**
	 * delete contacts
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

/* End of file contacts_model.php */
/* Location: ./application/models/contacts_model.php */
