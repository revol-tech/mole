<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* library to render page beside the main page
*/
 
 
class Render_library{

	/**
	* __construct
	*
	* @return void
	**/
	public function __construct(){
		$this->ci =& get_instance();
		$this->ci->load->database();

		$this->ci->load->helper('text_helper');
	}

	/**
	* rendring header & footer for inner pages
	*/
	public function generate_inner(){
		//set template
		$this->ci->template->set_template('template_inner');

		//set header & footer
		$this->_generate_header();
		$this->_generate_footer();

		$this->generate_organizations();

//		$this->_right_view();
	}

	/**
	 * render the main contents of the inner page
	 */
	public function generate_innermain($data,$type){
		$this->_generate_right();

		if(count($data)==0){
			return '';
		}

		$str ='';

		switch($type){
			case 'about' :
				//display 'about' main content
				$str .=	'<div class="about_us fl">
							<h1>
								<span>Welcome to</span> '.$data->title.'
							</h1>
							<div class="text_box fr">'.$data->content.'</div>
						</div>';
				break;
			case 'newslist':
				//display news previews ...

				foreach($data as $key=>$val){
					$str .=	'<div class="item1 fl">
								<h3>'.$val->title.'</h3>
								<div class="articleinfo fl">
									<span class="date-posted fl">'.$val->date_published.'</span>'.
									//'<span class="date-modified fl"> Last Updated on '.$val->date_modified.'</span>'.
									'<span class="author fl">'.$val->created_by.'</span>
									<a class="print fr" href="#"></a>
								</div>
								<div class="item1_content fl">
									<p>
										'.word_limiter(strip_tags($val->content),20).'
										<a class="more" href="'.site_url('news/'.$val->id).'">more</a> 
									</p>
								</div>
							</div>';
				}
				break;
			case 'newsfull':
				//display full single news article

				$str .=	'<div class="item1 fl">
							<h3>'.$data[0]->title.'</h3>
							<div class="articleinfo fl">
								<span class="date-posted fl">'.$data[0]->date_published.'</span>'.
								//'<span class="date-modified fl"> Last Updated on '.$data[0]->date_modified.'</span>'.
								'<span class="author fl">'.$data[0]->created_by.'</span>
								<a class="print fr" href="#"></a>
							</div>
							<div class="item1_content fl">
								'.$data[0]->content.'
							</div>
						</div>';
				break;
			case 'actslist':
				//display acts previews ...

				foreach($data as $key=>$val){
					$str .=	'<div class="item1 fl">
								<h3>'.$val->title.'</h3>
								<div class="articleinfo fl">
									<span class="date-posted fl">'.$val->date_published.'</span>'.
									//'<span class="date-modified fl"> Last Updated on '.$val->date_modified.'</span>'.
									'<span class="author fl">'.$val->created_by.'</span>
									<a class="print fr" href="#"></a>
								</div>
								<div class="item1_content fl">
									<p>
										'.word_limiter(strip_tags($val->content),20).'
										<a class="more" href="'.site_url('acts/'.$val->id).'">more</a> 
									</p>
								</div>
							</div>';
				}
				break;
			case 'actsfull':

				//display full single news article

				$str .=	'<div class="item1 fl">
							<h3>'.$data[0]->title.'</h3>
							<div class="articleinfo fl">
								<span class="date-posted fl">'.$data[0]->date_published.'</span>'.
								//'<span class="date-modified fl"> Last Updated on '.$data[0]->date_modified.'</span>'.
								'<span class="author fl">'.$data[0]->created_by.'</span>
								<a class="print fr" href="#"></a>
							</div>
							<div class="item1_content fl">
								'.$data[0]->content.'
							</div>
						</div>';
				break;
			case 'empslist':
				//display acts previews ...

				foreach($data as $key=>$val){
//echo '<pre>';
//print_r($val);					
//echo '</pre>';					

					$str .=	'<div class="item1 fl">
								<h3>'.$val->title.'</h3>
								<div class="articleinfo fl">
									<span class="date-posted fl">'.$val->date_published.'</span>'.
									//'<span class="date-modified fl"> Last Updated on '.$val->date_modified.'</span>'.
									'<span class="author fl">'.$val->created_by.'</span>
									<a class="print fr" href="#"></a>
								</div>
								<div class="item1_content fl">
									<p>
										'.word_limiter(strip_tags($val->content),20).'
										<a class="more" href="'.site_url('employments/'.$val->id).'">more</a> 
									</p>
								</div>
							</div>';
				}
				break;
			case 'empsfull':

				//display full single news article

				$str .=	'<div class="item1 fl">
							<h3>'.$data[0]->title.'</h3>
							<div class="articleinfo fl">
								<span class="date-posted fl">'.$data[0]->date_published.'</span>'.
								//'<span class="date-modified fl"> Last Updated on '.$data[0]->date_modified.'</span>'.
								'<span class="author fl">'.$data[0]->created_by.'</span>
								<a class="print fr" href="#"></a>
							</div>
							<div class="item1_content fl">
								'.$data[0]->content.'
							</div>
						</div>';
				break;
			case 'eventslist':
				//display acts previews ...

				foreach($data as $key=>$val){
//echo '<pre>';
//print_r($val);					
//echo '</pre>';					

					$str .=	'<div class="item1 fl">
								<h3>'.$val->title.'</h3>
								<div class="articleinfo fl">
									<span class="date-posted fl">'.$val->date_published.'</span>'.
									//'<span class="date-modified fl"> Last Updated on '.$val->date_modified.'</span>'.
									'<span class="author fl">'.$val->created_by.'</span>
									<a class="print fr" href="#"></a>
								</div>
								<div class="item1_content fl">
									<p>
										'.word_limiter(strip_tags($val->content),20).'
										<a class="more" href="'.site_url('events/'.$val->id).'">more</a> 
									</p>
								</div>
							</div>';
				}
				break;
			case 'eventsfull':

				//display full single news article

				$str .=	'<div class="item1 fl">
							<h3>'.$data[0]->title.'</h3>
							<div class="articleinfo fl">
								<span class="date-posted fl">'.$data[0]->date_published.'</span>'.
								//'<span class="date-modified fl"> Last Updated on '.$data[0]->date_modified.'</span>'.
								'<span class="author fl">'.$data[0]->created_by.'</span>
								<a class="print fr" href="#"></a>
							</div>
							<div class="item1_content fl">
								'.$data[0]->content.'
							</div>
						</div>';
				break;

			case 'faqs':

				//display faqs in accordion
				$str .= '<div class="item2 fl" style="width:100%;">
							<h2>FAQ\'s</h2>
							<ul>';
				foreach($data as $key=>$val){
					$str .=	'<li style="float:none;">
								<a 
									title="'.$val->description.'">
									<h3>'.$val->title.'</h3>
									<span class="total_questions">
										( Total '.count($val->questions).' Questions )
									</span>
								</a>
								
								<br/>'; 
					if(($val->questions)){
					foreach($val->questions as $kk=>$vv){
						$str .=	'<div class="acc-item">
									<a href="#" class="acc_trigger">
										<span>'.$vv->question.'</span>
									</a>
									<div class="acc_container">
										'.$vv->answer.'
									</div>
								</div>';
					}
					}
					$str .= '</li>';
				}
				$str .= '	</ul>
						</div>';
				break;
			
			case 'healthlist':
				//display health previews ...

				foreach($data as $key=>$val){
					$str .=	'<div class="item1 fl">
								<h3>'.$val->title.'</h3>
								<div class="articleinfo fl">
									<span class="date-posted fl">'.$val->date_published.'</span>'.
									//'<span class="date-modified fl"> Last Updated on '.$val->date_modified.'</span>'.
									'<span class="author fl">'.$val->created_by.'</span>
									<a class="print fr" href="#"></a>
								</div>
								<div class="item1_content fl">
									<p>
										'.word_limiter(strip_tags($val->content),20).'
										<a class="more" href="'.site_url('health/'.$val->id).'">more</a> 
									</p>
								</div>
							</div>';
				}
				break;
			case 'healthfull':

				//display full single news article

				$str .=	'<div class="item1 fl">
							<h3>'.$data[0]->title.'</h3>
							<div class="articleinfo fl">
								<span class="date-posted fl">'.$data[0]->date_published.'</span>'.
								//'<span class="date-modified fl"> Last Updated on '.$data[0]->date_modified.'</span>'.
								'<span class="author fl">'.$data[0]->created_by.'</span>
								<a class="print fr" href="#"></a>
							</div>
							<div class="item1_content fl">
								'.$data[0]->content.'
							</div>
						</div>';
				break;
			case 'noticeslist':
				//display health previews ...

				foreach($data as $key=>$val){
					$str .=	'<div class="item1 fl">
								<h3>'.$val->title.'</h3>
								<div class="articleinfo fl">
									<span class="date-posted fl">'.$val->date_published.'</span>'.
									//'<span class="date-modified fl"> Last Updated on '.$val->date_modified.'</span>'.
									'<span class="author fl">'.$val->created_by.'</span>
									<a class="print fr" href="#"></a>
								</div>
								<div class="item1_content fl">
									<p>
										'.word_limiter(strip_tags($val->content),20).'
										<a class="more" href="'.site_url('notices/'.$val->id).'">more</a> 
									</p>
								</div>
							</div>';
				}
				break;
			case 'noticesfull':

				//display full single news article

				$str .=	'<div class="item1 fl">
							<h3>'.$data[0]->title.'</h3>
							<div class="articleinfo fl">
								<span class="date-posted fl">'.$data[0]->date_published.'</span>'.
								//'<span class="date-modified fl"> Last Updated on '.$data[0]->date_modified.'</span>'.
								'<span class="author fl">'.$data[0]->created_by.'</span>
								<a class="print fr" href="#"></a>
							</div>
							<div class="item1_content fl">
								'.$data[0]->content.'
							</div>
						</div>';
				break;
			case 'polls':
				$str .= $data;
				break;
			case 'contacts':
				$this->ci->load->library('feedback_library');

				$str .= '<div class="grid_7 fl" style="float:right;">
							'.$this->ci->feedback_library->render().'
						</div>

						<div class="grid_7 address pad_alpha fl" style="width:275px;">
							<div class="item1 fl">
								<h3><span>Contact</span> Details</h3>
								<p>'.$data[0]->address.'</p>
								<div class="contact_holder">
									<div class="tel">
										<p><strong>T</strong><span>'.$data[0]->tel.'</span></p>
										<p><strong>F</strong><span>'.$data[0]->fax.'</span></p>
									</div>
								</div>
								<div class="contact_holder">
									<div class="email">
										<a href="mailto:'.$data[0]->email.'"</a>'.$data[0]->email.'</a>
									</div>
								</div>
							</div>
						</div>';
				break;
		}
		$this->ci->template->write('page',$str);
	}

	/**
	* rendering heaer & footer for
	* landing page
	*/
	public function generate_landing(){
		//set template
		$this->ci->template->set_template('default');

		//set header & footer
		$this->_generate_header();
		$this->_generate_footer();
	}

	/**
	 * main contents for the homepage
	 */
	public function generate_mainpage($data){
		$str = '<div class="about">';
		$str.= '<h1>'.$data[0]->title.'</h1>';
		$str.= '<p>'.word_limiter($data[0]->content,100).'</p>';
		$str.= '<a href="'.$data[0]->link.'" class="btn_red fr">read more</a>'; // <--- link not set properly
		$str.= '</div>';

		$this->ci->template->write('page',$str);
	}

	/**
	* right grid
	* Currently, holds latest news list
	*/
	private function _generate_right(){
		//latest news links
		$this->ci->load->model('news_model');
		$data = array(	'news_type'	=> 1,
						'active'	=> 1,
					);
		$news = $this->ci->news_model->get($data);

		$str = '<div class="highlight fl">
					<div class="title1">
						<h2><span>Latest</span> News </h2>
						<div class="piece"></div>
					</div>
					<div class="highlight_content fl">
						<ul>';
		foreach($news as $key=>$value){
			$str .= '<li><a href="'.site_url('news/'.$value->id).
						'" title="'.word_limiter(strip_tags($value->content),5).'" >'.
								$value->title.
					'</a></li>';
		}
		$str .=	'</ul>
				</div>
			  </div>';
		
		$this->ci->template->write('news',$str);	
	}



	/**
	* headers.
	* Contains the links & menus
	*/
	private function _generate_header(){
		$this->_add_css();
		$this->_add_scripts();

		//menu
		$this->ci->load->model('menu_model');
		$menu_data = $this->ci->menu_model->get(array('active'=>1));
		$this->generate_menu($menu_data);
	}


	/**
	* render the links [droopdown menus]
	*/
	public function generate_menu($data){

		if(count($data)==0){
			return '';
		}
		$menu=$this->_generate_menu_recursive($data,0);
		$this->ci->template->write('menu',$menu);	
	}



	/**
	 * fn. to generate organizations 
	 */
	public function generate_organizations(){

		$this->ci->load->model('organizations_model');
		$data = array('active'	=> 1,);
		$str = $this->ci->organizations_model->render($data);
		
		$this->ci->template->write('organizations',$str);	
	}


	/**
	* for recursive rendering
	*/
	private function _generate_menu_recursive($data,$parent_id){
		if(!(count($data)>0))
			return '';

		$str = '<ul class="menu sf-menu">';
		
		foreach($data as $k=>$v){
			if($v->parent_id==$parent_id){

				$str.='<li>';
				$str.='	<a href="'.site_url($v->link).'" title="'.$v->comments.'">';
				$str.=$v->title;
				$str.='</a>';

				unset($data[$k]);

				$str .= $this->_generate_menu_recursive($data,$v->id);
				$str.='</li>';
			}
		}

		$str .= '</ul>';
		return $str;
	}


	/**
	* footers
	* Contains the SiteMap & other similar links
	*/
	private function _generate_footer(){
		//contact
		$this->ci->load->model('contacts_model');
		$contacts = $this->ci->contacts_model->render();
		$this->ci->template->write('contacts',$contacts);	

		//userful links
		$this->ci->load->model('usefullinks_model');
		$usefullinks = $this->ci->usefullinks_model->render(array('active'=>1));
		$this->ci->template->write('usefullinks',$usefullinks);	

		//network
		$this->ci->load->model('networks_model');
		$networks = $this->ci->networks_model->render(array('active'=>1));
		$this->ci->template->write('network',$networks);

		//employments
		$this->ci->load->model('news_model');
		$params = array('news_type'=>7,'active'=>1);
		$employments = $this->ci->news_model->render($params);
		$this->ci->template->write('employments',$employments);

		//counter
		$counter = get_count_visitors();
		$this->ci->template->write('counter',$counter);
	}

	/**
	* reqd. css
	*/
	private function _add_css(){
		$this->ci->template->add_css(CSSPATH.'reset.css','link');
		$this->ci->template->add_css(CSSPATH.'grid.css','link');
		$this->ci->template->add_css(CSSPATH.'styles.css','link');
		$this->ci->template->add_css(CSSPATH.'superfish.css','link');
		$this->ci->template->add_css(CSSPATH.'default.css','link');
		$this->ci->template->add_css(CSSPATH.'tmp.css','link');
		$this->ci->template->add_css(CSSPATH.'images/favicon.png.css','link');
	}

	/**
	* reqd. js
	*/
	private function _add_scripts(){
		$this->ci->template->add_js(JSPATH.'jquery-1.8.2.min.js');
		$this->ci->template->add_js(JSPATH.'jquery.jqprint-0.3.js');
		$this->ci->template->add_js(JSPATH.'jquery.easing.1.3.js');
		$this->ci->template->add_js(JSPATH.'jquery.superfish.js');
		$this->ci->template->add_js(JSPATH.'jquery.supersubs.js');
		$this->ci->template->add_js(JSPATH.'jquery.totop.js');
		$this->ci->template->add_js(JSPATH.'functions.js');
	}
}
