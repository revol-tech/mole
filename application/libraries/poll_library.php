<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Poll_library{

	protected $ci;

	/**
	 * db tables
	 */
	protected $table 		= 'poll';
//	protected $table_coln 	= array( 'question', 		'option1',
//									 'option2',  		'option3',
//									 'option4',  		'created_by',
//									 'date_created',	'date_published',
//									 'date_removed',	'count_option1',
//									 'count_option2',	'count_option3',
//									 'count_option4',	'id'
//									);
	protected $history 		= 'poll_history';
//	protected $history_coln	= array('question_id','user_id',
//									);


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
	public function result_compare($items=array()){
		$data = array();
		
		//get the active poll if no parameter is passed.
		if(count($items)==0){
			$this->ci->db->where('active',1);
			$data = $this->ci->db->get($this->table);
			$items = $data->result();
		}


		//generate the poll result.
		foreach($items as $key=>$value){
			$value->graph = '';
			$value->graph .= '<div>';
			$value->graph .= '<div><span>'.$value->option1.': </span>'.'<span>'.$value->count_option1.'</span></div>';
			$value->graph .= '<div><span>'.$value->option2.': </span>'.'<span>'.$value->count_option2.'</span></div>';
			$value->graph .= '<div><span>'.$value->option3.': </span>'.'<span>'.$value->count_option3.'</span></div>';
			$value->graph .= '<div><span>'.$value->option4.': </span>'.'<span>'.$value->count_option4.'</span></div>';
			$value->graph .= '</div>';
		}
		return $items;
	}

	/**
	 * render active poll
	 *
	 * @returns string html
	 */
	public function render_poll(){
		$poll = $this->list_poll(false,null,null,true);

		if(!$poll){
			return null;
		}

		$html = '<div class="item1 fl">
					<h2><span>Public </span>Poll</h2>
					<div class="poll_block">
						<p class="poll_topic">'.$poll[0]->question.'</p>
						<!--<form method="post" action="'.site_url('pages/vote').'">-->
						'.form_open(site_url('polls/vote')).'
							<div class="form_holder1 fl">
								<input id="radio-choice-1" type="radio" value="1" tabindex="2" name="choice">
								<label for="choice-1">'.$poll[0]->option1.'</label>
							</div>
							<div class="form_holder1 fl">
								<input id="radio-choice-2" type="radio" value="2" tabindex="3" name="choice">
								<label for="radio-choice-2">'.$poll[0]->option2.'</label>
							</div>
							<div class="form_holder1 fl">
								<input id="radio-choice-3" type="radio" value="3" tabindex="3" name="choice">
								<label for="radio-choice-3">'.$poll[0]->option3.'</label>
							</div>
							<div class="form_holder1 fl">
								<input id="radio-choice-4" type="radio" value="4" tabindex="3" name="choice">
								<label for="radio-choice-4">'.$poll[0]->option4.'</label>
							</div>
							<div class="form_holder1 fl mar_top">
								<a href="#" class="btn_red fr">Result</a>
								<input class="btn_red fr" type="submit" value="Vote"/>
							</div>
						</form>
					</div>
				</div>';


		return $html;
	}


	/**
	 * store vote count
	 *
	 * @param int user_id
	 * @param int poll_id
	 * @param int answer_id
	 * @returns boolean
	 */
	public function vote($user_id,$answer_id){
		
		//get the id of the active poll
		$poll = $this->ci->db->get($this->table,array('active',1))->result();
		
		//store user id & timestamp for historical purposes
		$this->ci->db->insert($this->history,array(
													'question_id'	=> $poll[0]->id,
													'user_id'		=> $user_id,
													'date_submitted'=> get_timestamp()
													));


		$data = array( 'count_option'.$answer_id => 'count_option'.$answer_id + 1	);

		$this->ci->db->where('id',$poll[0]->id);
		$this->ci->db->update($this->table,$data);

		return true;
	 }


	/**
	 * to check if the currently active poll is already voted 
	 * by the current user/ip-address
	 * 
	 * @return true if already voted, false if not voted
	 */
	public function chk_history(){
		$user = (array)$this->ci->ion_auth->get_user();

		if(count($user)==0){
			$user['id'] = $this->ci->input->ip_address();
		}
		
		$sql = 'SELECT * FROM `'.$this->history.'` INNER JOIN `'.$this->table.'`
				ON `'.$this->history.'`.`question_id` = `'.$this->table.'`.`id`

				WHERE `'.$this->table.'`.`active` = 1
				AND `'.$this->history.'`.`user_id` = "'.$user['id'].'";';

		$poll = $this->ci->db->query($sql);
//print_r(count($poll->result()));
//echo $this->ci->db->last_query();
//die;
		return count($poll->result());
	}
	







///not used anywhere yet

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
