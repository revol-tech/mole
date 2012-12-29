<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * library to render headers & footers
 */
 
class Render_library{

	protected $ci;

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
	 * rendring header & footer for inner pages
	 */
	public function render_inner(){
		//set template
		$this->ci->template->set_template('template_inner');

		//set header & footer
		$this->_header_view();
		$this->_footer_view();
		
		$this->_right_view();
	}
	
	
	/**
	 * rendering heaer & footer for 
	 * landing page
	 */
	public function render_landing(){
		//set template
		$this->ci->template->set_template('default');

		//set header & footer
		$this->_header_view();
		$this->_footer_view();
	}


	/**
	 * right grid
	 * Currently, holds latest news list
	 */
	private function _right_view(){
		//latest news links
		$this->ci->load->model('news_model');
		$data = array(	'news_type'	=> 1,
						'active'	=> 1,
						'link_type'	=> 'about'
					);
		$news = $this->ci->news_model->render($data);
		$this->ci->template->write('news',$news);		
	}



	/**
	 * headers.
	 * Contains the links & menus
	 */
	private function _header_view(){
		$this->_add_css();
		$this->_add_scripts();
		
		//menu
		$this->ci->load->model('menu_model');
		$menu = $this->ci->menu_model->render_menu(array('active'=>1));

		$this->ci->template->write('menu',$menu);	
	}


	/**
	 * footers
	 * Contains the SiteMap & other similar links
	 */
	private function _footer_view(){
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
