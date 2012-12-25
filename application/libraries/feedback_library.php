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

//echo $this->ci->session->flashdata('feedback_status');
		$html =	'<div class="item1 fl">
					<h2><span>Feedback</span> &amp; Suggestions</h2>
					<p class="textblock fl">
						Please fillup the form below to submit your valuable suggestion.
					</p>
					<p class="textblock fl">'.
						$this->ci->session->flashdata('feedback_status').
					'</p>'.
						$validation.
					form_open('submit_feedback',array('id'=>'feedback')).'
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
//echo $this->ci->config->config['ion_auth']['admin_email'];
		$this->ci->email->to($this->ci->config->config['ion_auth']['admin_email']);
		
		$this->ci->email->subject('Site Email');
		$this->ci->email->message($data['sender_comments']);

//		$this->ci->email->send();
		$this->ci->session->set_flashdata('feedback_status', 'Thank You for your feedback.');		
//		redirect('aboutus');
	}

	private function _validate($data=array()){
//echo '<pre>';
//print_r($data);
//echo '</pre>';
		$this->ci->load->library('form_validation');

		$this->ci->form_validation->set_rules('sender_name', 'Name', 'required|trim');
		$this->ci->form_validation->set_rules('sender_comments', 'Comments', 'required|trim');
		$this->ci->form_validation->set_rules('sender_email', 'Email', 'required|trim|valid_email');

		if (! $this->ci->form_validation->run()){
//echo form_error();			
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



	/**
	 * delete poll
	 *
	 * @param array of poll ids to be deleted
	 * 		  OR int
	 * @return boolean
	 */
	public function del_poll($ids){
		$this->ci->db->where('id',$ids)
					->delete($this->table);

	}


	/**
	 * list polls
	 *
	 * @param id
	 * @return polls
	 */
	public function list_poll($ids=false,$limit=null,$start=null,$active=false){
		if($active){
			$this->ci->db->where('active',1);
		}
		if($limit){
			$this->ci->db->limit($limit,$start);
		}
		$ids ? $this->ci->db->where('id',$ids) : '';

		$res = $this->ci->db->get($this->table);

		if($res->result()){
//			$data = ($res->result());
			$data = $this->result_compare($res->result());
//print_r($data);
			return $data;
		}else{
			false;
		}
	}



	/**
	 * disp. results of a poll
	 *
	 * @return array of html
	 */
	public function result_compare($items){
		$data = array();

		foreach($items as $key=>$value){
//print_r();
			$value->graph = '';
			$value->graph .= '<div>';
			$value->graph .= '<div><span>'.$value->option1.': </span>'.'<span>'.$value->count_option1.'</span></div>';
			$value->graph .= '<div><span>'.$value->option2.': </span>'.'<span>'.$value->count_option2.'</span></div>';
			$value->graph .= '<div><span>'.$value->option3.': </span>'.'<span>'.$value->count_option3.'</span></div>';
			$value->graph .= '<div><span>'.$value->option4.': </span>'.'<span>'.$value->count_option4.'</span></div>';
			$value->graph .= '</div>';
		}
//print_r($items);
		return $items;
	}


/**
 * fns below are not tested yet.
 */
	/**
	 * store vote count
	 *
	 * @param int user_id
	 * @param int poll_id
	 * @param int answer_id
	 * @returns boolean
	 */
	public function vote($user_id,$poll_id,$answer_id){
		//store user id & timestamp for historical purposes
		$this->ci->db->insert($this->history,array(
													'question_id'	=> $poll_id,
													'user_id'		=> $user_id,
													'date_submitted'=> get_timestamp()
													));

//		$this->ci->db->set( 'count_option'.$answer_id,
//							'count_option'.$answer_id + 1);
		$this->ci->db->update($this->table)
					->set(	'count_option'.$answer_id,
							'count_option'.$answer_id + 1)
					->where('id',$poll_id);

		return true;
	 }

	/**
	 * search poll
	 *
	 * @param array
	 * @returns result
	 */
	public function search($data=null){

		if($data==null){
			return $this->results();
		}

		$res = $this->get_where($this->table,$data);

		return $res->result() ? $res->result() : false ;
	}

}
