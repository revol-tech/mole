<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feedback_library{

	protected $ci;


	protected $history 		= 'poll_history';


	/**
	 * __construct
	 *
	 * @return void
	 **/
	public function __construct(){
		$this->ci =& get_instance();
		$this->ci->load->database();
	}



	/**
	 * render feedback form
	 *
	 * @returns string html
	 */
	public function render(){
		$validation = validation_errors();

		$html =	'<div class="item1 fl">
					<h2><span>Feedback</span> &amp; Suggestions</h2>
					<p class="textblock fl">
						Please fillup the form below to submit your valuable suggestion.
					</p>
					<p class="textblock fl">'.
						$this->ci->session->flashdata('feedback_status').
					'</p>'.
						$validation.
					form_open('contacts/submit_feedback',array('id'=>'feedback')).'
						<div class="form_holder2">
							<span class="text">Name</span>
							<input type="text" value="'.set_value('sender_name').'" name="sender_name" class="textbox fl" 
								onfocus="if(this.value==\'\')this.value=\'\';" 
								onblur="if(this.value==\'\')this.value=\'\';"
								selected="selected"/>
						</div> 
						<div class="form_holder2">
							<span class="text">Email</span>
							<input type="email" value="'.set_value('sender_email').'" name="sender_email" class="textbox fl" 
								onfocus="if(this.value==\'\')this.value=\'\';" 
								onblur="if(this.value==\'\')this.value=\'\';"/>
						</div> 
						<div class="form_holder2">
							<span class="text">Comments</span>
							<textarea value="'.set_value('sender_comments').'" name="sender_comments" class="textarea fl" 
								onfocus="if(this.value==\'\')this.value=\'\';" 
								onblur="if(this.value==\'\')this.value=\'\';">
							</textarea>
						</div> 
						<div class="form_holder2">
							<input class="btn_red fr" type="submit" value="Submit"/>
						</div>
					</form>
				</div>';
		if(($validation)){
			$html .= '<script>'.
						'$(function(){'.
							'$("#feedback").find("input[type=text]").first().focus();'.
						'})'.
					'</script>';
		}

		return $html;
	}


	/**
	 * send email feedback form
	 *
	 */
	public function send($data){

		if(!$this->_validate($data)){
			return false;
		}
		$this->ci->load->library('email');

		$this->ci->email->from($data['sender_email'], $data['sender_name']);
		$this->ci->email->to($this->ci->config->config['ion_auth']['admin_email']);
		
		$this->ci->email->subject('Site Email');
		$this->ci->email->message($data['sender_comments']);
	
		$this->ci->emal->send();

		$this->ci->session->set_flashdata('feedback_status', 'Thank You for your feedback.');		
	}

	/**
	 * validate email parameters
	 * sets reply information in flashdata "feedback_status"
	 * 
	 * @returns boolean
	 */
	private function _validate($data=array()){
		$this->ci->load->library('form_validation');
		$this->ci->form_validation->set_error_delimiters('<p style="color:red;">', '</p>');

		$this->ci->form_validation->set_rules('sender_name', 'Name', 'required|trim');
		$this->ci->form_validation->set_rules('sender_comments', 'Comments', 'required|trim');
		$this->ci->form_validation->set_rules('sender_email', 'Email', 'required|trim|valid_email');

		if (! $this->ci->form_validation->run()){
			$this->ci->session->set_flashdata('feedback_status',validation_errors());
			return false;
		}
		return true;
	}



























	/**
	 * create new poll
	 *
	 * @param associative array( question, option1,
	 * 							 option2,  option3,
	 * 							 option4,  created_by,
	 * 							 date_created
	 * 							)
	 * @return int poll id
	 **/
	public function new_poll($data){

		if($data['active']){
			$this->change_active();
		}

		$this->ci->db->insert($this->table,$data);

		return $this->ci->db->insert_id();
	}


	/**
	 * count records
	 */
	public function record_count(){
		return $this->ci->db->count_all($this->table);
	}



	/**
	 * update existing poll
	 *
	 * @param array -- udpated questionare
	 * @return boolean
	 */
	public function update_poll($data){
//print_r($data);
		$this->ci->db->where('id',$data['id'])
					->update($this->table,$data);

		return true;
	}


	/**
	 * change the active poll
	 *
	 * @param id int
	 * @param active boolean
	 */
	public function change_active($ids=false,$active=false){
		$this->ci->db->set(	'active',0 )
					->update($this->table);

		$ids ? $this->ci->db->where('id',$ids) : '';

		$this->ci->db->set(	'active',$active )
					->update($this->table);
	}
}
