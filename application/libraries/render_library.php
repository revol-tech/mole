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
	public function generate_inner($cond = array()){
		//set template
		$this->ci->template->set_template('template_inner');

		//set header & footer
		$this->_generate_header();
		$this->_generate_footer();

		if(isset($cond['organization'])){
			$this->generate_organizations();
		}

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
							<h1 class="en" '.
								(($this->ci->session->userdata('lang')=='en')?'':'style="display:none;"').
									'>
								<strong class="spot"> Welome to </strong>
								 Ministry of Labour and Employment
							 </h1>
							<h1 class="np" '.
								(($this->ci->session->userdata('lang')=='np')?'':'style="display:none;"').
									'>
								<strong class="spot">ास ा ा </strong>
								 सउ हसउ हसउहस सउग सस तस
							 </h1>
							<p class="en" '.
								(($this->ci->session->userdata('lang')=='en')?'':'style="display:none;"').
								'>
								'.$data->title.'
							</p>
							<p class="en" '.
								(($this->ci->session->userdata('lang')=='np')?'':'style="display:none;"').
								'>
								'.$data->title_np.'
							</p>
							<div class="lower_block fl en" '.
									(($this->ci->session->userdata('lang')=='en')?'':'style="display:none;"').
									'>
								<div class="block_img4 fl">
									<img src="'.base_url().DOCUMENTS.$data->filename.'" 
										alt="'.$data->title.'" title="'.$data->title.'"
										width="150" height="140" />
								</div>
								<div class="text_box fr" >'.$data->content.'</div>
							</div>
									
							<div class="lower_block fl np" '.
									(($this->ci->session->userdata('lang')=='np')?'':'style="display:none;"').
									'>
								<div class="block_img4 fl">
									<img src="'.base_url().DOCUMENTS.$data->filename.'" 
										alt="'.$data->title_np.'" title="'.$data->title_np.'
										width="150" height="140" />
								</div>
								<div class="text_box fr" >'.$data->content_np.'</div>
							</div>
						</div>';
				break;
			case 'contacts':
				$this->ci->load->library('feedback_library');

				$str .= '<div class="grid_7 fl" style="float:right;">
							'.$this->ci->feedback_library->render().'
						</div>

						<div class="grid_7 address pad_alpha fl" style="width:275px;">'.
							
							'<div class="item1 fl en" '.
									(($this->ci->session->userdata('lang')=='en')?'':'style="display:none;"').' >
								<h3><span>Contact</span> Details</h3>
								<p>'.$data[0]->address.'</p>
								<div class="contact_holder">
									<div class="tel">
										<p><strong>T</strong><span id="tel_en">'.$data[0]->tel.'</span></p>
										<p><strong>F</strong><span id="fax_en">'.$data[0]->fax.'</span></p>
									</div>
								</div>
								<div class="contact_holder">
									<div class="email">
										<a href="mailto:'.$data[0]->email.'"</a>'.$data[0]->email.'</a>
									</div>
								</div>
							</div>
							
							
							<div class="item1 fl np" '.
								(($this->ci->session->userdata('lang')=='np')?'':'style="display:none;"').' >'.
								'<h3><span>सम्पर्क</span> ठेगाना</h3>
								<p>'.$data[0]->address_np.'</p>
								<div class="contact_holder">
									<div class="tel">
										<p><strong>फोन</strong><span id="tel_np"></span></p>
										<p><strong>फाक्स</strong><span id="fax_np"></span></p>
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
							<h3 class="en" '.(($this->ci->session->userdata('lang')=='en')?'':'style="display:none;"').'>'.
								$data[0]->title.
							'</h3>
							<h3 class="np" '.(($this->ci->session->userdata('lang')=='np')?'':'style="display:none;"').'>'.
								$data[0]->title_np.
							'</h3>
							<div class="articleinfo fl">
								<span class="date-posted fl">'.$data[0]->date_published.'</span>'.
								//'<span class="date-modified fl"> Last Updated on '.$data[0]->date_modified.'</span>'.
								'<span class="author fl">'.$data[0]->created_by.'</span>
								<a class="print fr" href="#"></a>
							</div>
							<div class="item1_content fl en" '.(($this->ci->session->userdata('lang')=='en')?'':'style="display:none;"').'>
								'.$data[0]->content.'
							</div>
							<div class="item1_content fl np" '.(($this->ci->session->userdata('lang')=='np')?'':'style="display:none;"').'>
								'.$data[0]->content_np.'
							</div>
						</div>';
				break;
			case 'actslist':
				//display acts previews ...

				foreach($data as $key=>$val){
					$str .=	'<div class="item1 fl">
								<h3 class="en" '.(($this->ci->session->userdata('lang')=='en')?'':'style="display:none;"').'>'.
									$val->title.
								'</h3>
								<h3 class="np" '.(($this->ci->session->userdata('lang')=='np')?'':'style="display:none;"').'>'.
									$val->title_np.
								'</h3>
								<div class="articleinfo fl en" '.(($this->ci->session->userdata('lang')=='en')?'':'style="display:none;"').'>
									<span class="date-posted fl">'.$val->date_created.'</span>
									<!--<span class="author fl">'.$val->created_by.'</span>-->
									<a class="fl" href="'.site_url('admin/files/download/'.$val->id).'" style="">Download</a>
									<a class="print fr" href="#"></a>
								</div>
								<div class="articleinfo fl np" '.(($this->ci->session->userdata('lang')=='np')?'':'style="display:none;"').'>
									<span class="date-posted fl">'.$val->date_created.'</span>
									<!--<span class="author fl">'.$val->created_by.'</span>-->
									<a class="fl" href="'.site_url('admin/files/download/'.$val->id).'" style="">डाउनलोड</a>
									<a class="print fr" href="#"></a>
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
					$str .=	'<div class="item1 fl">
								<h3 class="en" '.(($this->ci->session->userdata('lang')=='en')?'':'style="display:none;"').'>'.$val->title.'</h3>
								<h3 class="np" '.(($this->ci->session->userdata('lang')=='np')?'':'style="display:none;"').'>'.$val->title.'</h3>
								<div class="articleinfo fl">
									<span class="date-posted fl">'.$val->date_published.'</span>'.
									//'<span class="date-modified fl"> Last Updated on '.$val->date_modified.'</span>'.
									'<span class="author fl">'.$val->created_by.'</span>
									<a class="print fr" href="#"></a>
								</div>
								<div class="item1_content fl en" '.(($this->ci->session->userdata('lang')=='en')?'':'style="display:none;"').'>
									<p>
										'.word_limiter(strip_tags($val->content),20).'
										<a class="more" href="'.site_url('employments/'.$val->id).'">more</a> 
									</p>
								</div>
								<div class="item1_content fl np" '.(($this->ci->session->userdata('lang')=='np')?'':'style="display:none;"').'>
									<p>
										'.word_limiter(strip_tags($val->content_np),20).'
										<a class="more" href="'.site_url('employments/'.$val->id).'">अझै</a> 
									</p>
								</div>
							</div>';
				}
				break;
			case 'empsfull':

				//display full single news article

				$str .=	'<div class="item1 fl">
							<h3 class="en" '.(($this->ci->session->userdata('lang')=='ep')?'':'style="display:none;"').'>'.
								$data[0]->title.
							'</h3>
							<h3 class="np" '.(($this->ci->session->userdata('lang')=='np')?'':'style="display:none;"').'>'.
								$data[0]->title_np.
							'</h3>
							<div class="articleinfo fl">
								<span class="date-posted fl">'.$data[0]->date_published.'</span>'.
								//'<span class="date-modified fl"> Last Updated on '.$data[0]->date_modified.'</span>'.
								'<span class="author fl">'.$data[0]->created_by.'</span>
								<a class="print fr" href="#"></a>
							</div>
							<div class="item1_content fl en" '.(($this->ci->session->userdata('lang')=='en')?'':'style="display:none;"').'>
								'.$data[0]->content.'
							</div>
							<div class="item1_content fl np" '.(($this->ci->session->userdata('lang')=='np')?'':'style="display:none;"').'>
								'.$data[0]->content_np.'
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
							<h2 class="en" '.(($this->ci->session->userdata('lang')=='en')?'':'style="display:none;"').'>
								Frequently Asked Questions 
							</h2>
							<h2 class="np" '.(($this->ci->session->userdata('lang')=='np')?'':'style="display:none;"').'>
								धेरै सोधिने प्रश्नहरु 
							</h2>
							<ul>';
				foreach($data as $key=>$val){
					$str .=	'<li style="float:none;">
								<a 
									'.(($this->ci->session->userdata('lang')=='en')?'':'style="display:none;"').'
									title="'.$val->description.'" class="en">
									<h3>'.$val->title.'</h3>
									<span class="total_questions">
										( Total '.count($val->questions).' Questions )
									</span>
								</a>
								<a 
									'.(($this->ci->session->userdata('lang')=='np')?'':'style="display:none;"').'
									title="'.$val->description_np.'" class="np">
									<h3>'.$val->title_np.'</h3>
									<span class="total_questions">
										( जम्मा प्रश्न - '.count($val->questions).' )
									</span>
								</a>
								
								<br/>'; 
					if(($val->questions)){
					foreach($val->questions as $kk=>$vv){
						$str .=	'<div class="acc-item en" '.(($this->ci->session->userdata('lang')=='en')?'':'style="display:none;"').'>
									<a href="#" class="acc_trigger">
										<span class="question">'.$vv->question.'</span>
									</a>
									<div class="acc_container">
										<br/>'.$vv->answer.'
									</div>
								</div>';
						$str .=	'<div class="acc-item np" '.(($this->ci->session->userdata('lang')=='np')?'':'style="display:none;"').'>
									<a href="#" class="acc_trigger">
										<span class="question">'.$vv->question_np.'</span>
									</a>
									<div class="acc_container">
										<br/>'.$vv->answer_np.'
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
								<h3 class="en" '.(($this->ci->session->userdata('lang')=='en')?'style="display:none;"':'').'>'.
									$val->title.
								'</h3>
								<h3 class="np" '.(($this->ci->session->userdata('lang')=='np')?'style="display:none;"':'').'>'.
									$val->title_np.
								'</h3>
								<div class="articleinfo fl">
									<span class="date-posted fl">'.$val->date_published.'</span>'.
									//'<span class="date-modified fl"> Last Updated on '.$val->date_modified.'</span>'.
									'<span class="author fl">'.$val->created_by.'</span>
									<a class="print fr" href="#"></a>
								</div>
								<div class="item1_content fl en" '.(($this->ci->session->userdata('lang')=='en')?'style="display:none;"':'').'>
									<p>
										'.word_limiter(strip_tags($val->content),20).'
										<a class="more" href="'.site_url('notices/'.$val->id).'">more</a> 
									</p>
								</div>
								<div class="item1_content fl np" '.(($this->ci->session->userdata('lang')=='np')?'style="display:none;"':'').'>
									<p>
										'.word_limiter(strip_tags($val->content_np),20).'
										<a class="more" href="'.site_url('notices/'.$val->id).'">अझै</a> 
									</p>
								</div>
							</div>';
				}
				break;
			case 'noticesfull':

				//display full single news article
				$str .=	'<div class="item1 fl">
							<h3 class="en" '.(($this->ci->session->userdata('lang')=='en')?'':'style="display:none;"').'>'.
								$data[0]->title.
							'</h3>
							<h3 class="np" '.(($this->ci->session->userdata('lang')=='np')?'':'style="display:none;"').'>'.
								$data[0]->title_np.
							'</h3>
							<div class="articleinfo fl">
								<span class="date-posted fl">'.$data[0]->date_published.'</span>'.
								//'<span class="date-modified fl"> Last Updated on '.$data[0]->date_modified.'</span>'.
								'<span class="author fl">'.$data[0]->created_by.'</span>
								<a class="print fr" href="#"></a>
							</div>
							<div class="item1_content fl en" '.(($this->ci->session->userdata('lang')=='en')?'':'style="display:none;"').'>
								'.$data[0]->content.'
							</div>
							<div class="item1_content fl np" '.(($this->ci->session->userdata('lang')=='np')?'':'style="display:none;"').'>
								'.$data[0]->content_np.'
							</div>
						</div>';
				break;
			case 'presslist':
				//display health previews ...

				foreach($data as $key=>$val){
					$str .=	'<div class="item1 fl">
								<h3 class="en" '.(($this->ci->session->userdata('lang')=='en')?'':'style="display:none;"').'>'.
									$val->title.
								'</h3>
								<h3 class="np" '.(($this->ci->session->userdata('lang')=='np')?'':'style="display:none;"').'>'.
									$val->title_np.
								'</h3>
								<div class="articleinfo fl en" '.(($this->ci->session->userdata('lang')=='np')?'':'style="display:none;"').'>
									<span class="date-posted fl">'.$val->date_published.'</span>'.
									//'<span class="date-modified fl"> Last Updated on '.$val->date_modified.'</span>'.
									'<span class="author fl">'.$val->created_by.'</span>
									<a class="print fr" href="#"></a>
								</div>
								<div class="item1_content fl en" '.(($this->ci->session->userdata('lang')=='en')?'':'style="display:none;"').'>
									'.($val->content).'
									<a class="more fr" href="'.site_url('press/download/'.$val->id).'">Download</a> 
								</div>
								<div class="item1_content fl np" '.(($this->ci->session->userdata('lang')=='np')?'':'style="display:none;"').'>
									'.($val->content_np).'
									<a class="more fr" href="'.site_url('press/download/'.$val->id).'">डाउनलोड</a> 
								</div>
							</div>';
				}
				break;
			case 'pressfull':

				//display full single press	 article

				$str .=	'<div class="item1 fl">
							<h3 class="en" '.(($this->ci->session->userdata('lang')=='en')?'':'style="display:none;"').'>'.
								$data[0]->title.
							'</h3>
							<h3 class="np" '.(($this->ci->session->userdata('lang')=='np')?'':'style="display:none;"').'>'.
								$data[0]->title_np.
							'</h3>
							<div class="articleinfo fl">
								<span class="date-posted fl">'.$data[0]->date_published.'</span>'.
								//'<span class="date-modified fl"> Last Updated on '.$data[0]->date_modified.'</span>'.
								'<span class="author fl">'.$data[0]->created_by.'</span>
								<a class="print fr" href="#"></a>
							</div>
							<div class="item1_content fl en" '.(($this->ci->session->userdata('lang')=='en')?'':'style="display:none;"').'>
								'.word_limiter($data[0]->content,100).'
							</div>
							<div class="item1_content fl np" '.(($this->ci->session->userdata('lang')=='np')?'':'style="display:none;"').'>
								'.word_limiter($data[0]->content,100).'
							</div>
						</div>';
				break;
			case 'polls':
				//add poll's js/css requirements
				$str .= '<!--[if lt IE 9]> 
							<script language="javascript" type="text/javascript" src="'.
									base_url().JSPATH.'jqplot/excanvas.min.js"></script>
						>![endif]-->
						<script language="javascript" type="text/javascript" src="'.
										base_url().JSPATH.'jqplot/jquery.jqplot.js"></script>
						<script language="javascript" type="text/javascript" src="'.
										base_url().JSPATH.'jqplot/jqplot.barRenderer.js"></script>
						<script type="text/javascript" src="'.
										base_url().JSPATH.'jqplot/jqplot.categoryAxisRenderer.js"></script>
						<script type="text/javascript" src="'.
										base_url().JSPATH.'jqplot/jqplot.pointLabels.js"></script>
						<link rel="stylesheet" type="text/css" href="'.
										base_url().JSPATH.'jqplot/jquery.jqplot.css" />';

			
				$str .= $data;
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
		if(count($data)==0)
			return '';
		
		//english
		$str = '<div class="about en" ';
		$str.= (($this->ci->session->userdata('lang')=='en')?'':'style="display:none;"').' >';
		$str.= '<h1>'.$data[0]->title.'</h1>';
		$str.= '<p>'.word_limiter($data[0]->content,50).'</p>';
		$str.= '<a href="'.$data[0]->link.'" class="btn_red fr">read more</a>'; // <--- link not set properly
		$str.= '</div>';
	
		//nepali
		$str.= '<div class="about np" ';
		$str.= (($this->ci->session->userdata('lang')=='np')?'':'style="display:none;"').' >';
		$str.= '<h1>'.$data[0]->title_np.'</h1>';
		$str.= '<p>'.word_limiter($data[0]->content_np,50).'</p>';
		$str.= '<a href="'.$data[0]->link.'" class="btn_red fr">अझै पठ्नहोस्</a>';
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
					<div class="title1">'.
				'		<h2 class="en" '.(($this->ci->session->userdata('lang')=='en')?'':'style="display:none;"').'>'.
				'			<span>Latest</span> News '.
				'		</h2>'.
				'		<h2 class="np" '.(($this->ci->session->userdata('lang')=='np')?'':'style="display:none;"').'>'.
				'			<span>प्रमुख</span> समाचार '.
				'		</h2>'.
				'		<div class="piece"></div>
					</div>
					<div class="highlight_content fl">
						<ul>';
		foreach($news as $key=>$value){
			$str .= '<li>'.
						'<a href="'.site_url('news/'.$value->id).
							'" title="'.word_limiter(strip_tags($value->content),5).'" '.
							'class="en" '.(($this->ci->session->userdata('lang')=='en')?'':'style="display:none;"').'>'.
									$value->title.
						'</a>'.
						'<a href="'.site_url('news/'.$value->id).
							'" title="'.word_limiter(strip_tags($value->content_np),5).'" '.
							'class="np" '.(($this->ci->session->userdata('lang')=='np')?'':'style="display:none;"').'>'.
									$value->title_np.
						'</a>'.
					'</li>';
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
	
		//language bar
		$str =	'<div class="language fr">
					<a href="#" class="nepal '.
						(($this->ci->session->userdata('lang')=='np')?'active':'').
						' fl color">नेपाली</a>
					<a href="#" class="english '.
						(($this->ci->session->userdata('lang')=='en')?'active':'').
						' fl color">English</a>
				</div>';
		$this->ci->template->write('lang_menu',$str);

		
		//submenu
		$this->ci->load->model('submenu_model');
		$submenu_data = $this->ci->submenu_model->get(array('active'=>1));
		$str = '<div id="header_bottom">
					<div class="container_1">
						<ul class="sub_nav">';
		foreach($submenu_data as $key=>$val){
			$str .=	'<li>';
			$str .= '<a class="en" href="'.base_url().$val->link.'" title="'.$val->comments.'" '.
						(($this->ci->session->userdata('lang')=='en')?'':'style="display:none;"').'>'.$val->title.'</a>';
			$str .= '<a class="np" href="'.base_url().$val->link.'" title="'.$val->comments_np.'" '.
						(($this->ci->session->userdata('lang')=='np')?'':'style="display:none;"').'>'.$val->title_np.'</a>';
			$str .= '</li>';
		}
		$str .=	'</ul></div></div>';
		
		$this->ci->template->write('sub_menu',$str);
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
	 * fn to generate event.
	 * list or a single
	 */
	public function generate_inner_event($data){
		//set template
		$this->ci->template->set_template('template_inner_events');

		//set header & footer
		$this->_generate_header();
		$this->_generate_footer();

		$this->ci->load->model('events_model');
		$str = $this->ci->events_model->render_events_page($data);

		$this->ci->template->write('events',$str);
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
				//english
				$str.='	<a href="'.site_url($v->link).'" title="'.$v->comments.'" class="en" '.
						(($this->ci->session->userdata('lang')=='en')?'':'style="display:none;"').' >';
				$str.=$v->title;
				$str.='</a>';
				//nepali
				$str.='	<a href="'.site_url($v->link).'" title="'.$v->comments_np.'" class="np" '.
						(($this->ci->session->userdata('lang')=='np')?'':'style="display:none;"').' >';
				$str.=$v->title_np;
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
		$usefullinks = $this->ci->usefullinks_model->render(array('active'=>1),5);
		$this->ci->template->write('usefullinks',$usefullinks);	

		//network
		$this->ci->load->model('networks_model');
		$networks = $this->ci->networks_model->render(array('active'=>1),5);
		$this->ci->template->write('network',$networks);

		//employments
		$this->ci->load->model('news_model');
		$params = array('news_type'=>7,'active'=>1);
		$employments = $this->ci->news_model->render($params,5);
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
		//$this->ci->template->add_css(CSSPATH.'images/favicon.png','link');
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
		$this->ci->template->add_js(JSPATH.'functions.js?'.base_url());
	}
}
