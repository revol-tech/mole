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
		$nu_data_links = array(
			'table' => $this->table,
			'row_id'=> $data['id']
		);

		$old_data_links = $this->links_model->get($nu_data_links);

		$nu_data_links['id']   = $old_data_links[0]->id ;
		$nu_data_links['link'] = $this->input->post('linktype').'/'.$this->input->post('link');

		$this->links_model->save($nu_data_links);

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
					'address_np'=> ($this->input->post('address_np')),
					'tel'		=> $this->input->post('tel'),
					'fax'		=> $this->input->post('fax'),
					'email'		=> $this->input->post('email'),
					'created_by'=> $this->session->userdata('user_id'),
					'date_created'=>$this->session->userdata('date_created'),
					'date_published'=>$this->input->post('date_published'),
					'date_removed'=>$this->input->post('date_removed'),
					'active'	=>$this->input->post('active'),
					'homepage'	=> $this->input->post('homepage'),
				);
				
		$this->load->library('form_validation');
		$this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[5]|xss_clean');
		$this->form_validation->set_rules('address_np', 'Address Nepali', 'trim|required|min_length[5]|xss_clean');
		if($this->form_validation->run()==false){
			redirect('admin/contacts/edit');
		}

		//update existing contacts
		if(strlen($this->input->post('id'))){
			$data['id'] = $this->input->post('id');

			return $this->update($data);


		//insert new contacts
		}else{

			if(! $this->db->insert($this->table,$data)){
				return $this->db->_error_message();
			}

			$id = $this->db->insert_id();
			
			$data_links = array(
				'link'	=> $this->input->post('linktype').'/'.$this->input->post('link'),
				'table' => $this->table,
				'row_id'=> $id
			);
			
			$this->links_model->save($data_links);

			return $this->db->insert_id();
		}
	}


	/**
	 * get contacts [of selected parameter]
	 */
	public function get($contacts=null,$limit=null,$start=null){
		$res = $this->db->get($this->table);
//echo '<pre>';
//print_r($res->result());
//echo $this->db->last_query();
//echo '</pre>';
		foreach($res->result() as $value){
			$value->created_by = $this->ion_auth->get_user($value->created_by)->username;

			$tmp_link = $this->links_model->get(array('table'=>'contacts','row_id'=>$value->id));

			$value->link = isset($tmp_link[0]->link)?$tmp_link[0]->link:'';
//print_r($value);
//			$value->created_by = $this->ion_auth->get_user($value->created_by)->username;
//			$value->content = html_entity_decode($value->content,ENT_QUOTES, 'UTF-8');
		}
		return $res->result();
	}

	/**
	 * render contacts for display
	 */
	public function render($link_type=null){
		$data = $this->contacts_model->get();
		if(!(count($data)>0))
			return '';
		if($link_type!=null){
			$str =	'<div class="about_us fl">
						<h1>
							<span>Contact</span> Details
						</h1>
						<p>'.$data[0]->address.'</p>
						<div class="contact_holder">
							<div class="tel">
								<p><strong>T</strong><span>'.$data[0]->tel.'</span></p>
								<p><strong>F</strong><span>'.$data[0]->fax.'</span></p>
							</div>
						</div>
						<div class="contact_holder">
							<div class="email"><a href="mailto:'.$data[0]->email.'">'.$data[0]->email.'</a></div>
						</div>
					</div>';

			$str .=	'<div class="item1 fl">
						<h2><span>Feedback</span> &amp; Suggestions</h2>
						<p class="textblock fl">
							Please fillup the form below to submit your valuable suggestion.
						</p>
						<form>
							<div class="form_holder2">
								<span class="text">Name</span>
								<input type="text" value="" name="" class="textbox fl" 
									onfocus="if(this.value==\'\')this.value=\'\';" 
									onblur="if(this.value==\'\')this.value=\'\';"/>
							</div> 
							<div class="form_holder2">
								<span class="text">Email</span>
								<input type="email" value="" name="" 
									class="textbox fl" onfocus="if(this.value==\'\')this.value=\'\';" 
									onblur="if(this.value==\'\')this.value=\'\';"/>
							</div> 
							<div class="form_holder2">
								<span class="text">Comments</span>
								<!--set textarea resizable none ???-->
								<textarea value="" name="" class="textarea fl" 
									onfocus="if(this.value==\'\')this.value=\'\';" 
									onblur="if(this.value==\'\')this.value=\'\';"></textarea>
							</div> 
							<div class="form_holder2">
								<input class="btn_red fr" type="submit" value="Submit"/>
							</div>
						</form>
					</div>';
					
			return $str;
		}
		
		$str = 	'<div class="grid_7 address pad_alpha border_rt_gray en" '.
						(($this->session->userdata('lang')=='en')?'':'style="display:none;"').' >
					<h3><span>Contact</span> Details</h3>'.
					'<p>'.$data[0]->address.'</p>'.
					'<div class="contact_holder">
						<div class="tel">
							<p><strong>T</strong><span id="tel_en">'.$data[0]->tel.'</span></p>
							<p><strong>F</strong><span id="fax_en">'.$data[0]->fax.'</span></p>
						</div>
					</div>
					<div class="contact_holder">
						<div class="email"><a href="mailto:'.$data[0]->email.'">'.$data[0]->email.'</a></div>
					</div>
				</div>
				
				
				<div class="grid_7 address pad_alpha border_rt_gray np" '.
						(($this->session->userdata('lang')=='np')?'':'style="display:none;"').' >
					<h3><span>सम्पर्क</span> ठेगाना</h3>'.
					'<p>'.$data[0]->address_np.'</p>'.
					'<div class="contact_holder">
						<div class="tel">
							<p><strong>फोन</strong><span id="tel_np"></span></p>
							<p><strong>फाक्स</strong><span id="fax_np"></span></p>
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
