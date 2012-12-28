<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contacts extends MY_MOLE_Controller {

	public function __construct(){

		parent::__construct();

		$this->template->set_template('template_inner');

		$this->_header_view();
		$this->_footer_view();
	}


	public function index(){

		$data = $this->links_model->get(array(
												'link'=>'contacts'.
														'/'.
														$this->uri->segment(2))
										);

//echo $this->db->last_query();
//print_r($data);
		$this->load->model('contacts_model');
		$params = array('id'=>$data[0]->row_id);
		$params['link_type'] = 'contacts';
print_r($params);
		$contacts = $this->contacts_model->render($params);
		$this->template->write('page',$contacts);

		$this->template->render();
	}


	/**
	 * headers.
	 * Contains the links & menus
	 */
	private function _header_view(){
		$this->_add_css();
		$this->_add_scripts();
		
		//menu
		$this->load->model('menu_model');
		$menu = $this->menu_model->render_menu(array('active'=>1));
		$this->template->write('menu',$menu);	
	}

	/**
	 * footers
	 * Contains the SiteMap & other similar links
	 */
	private function _footer_view(){
		//contact
		$this->load->model('contacts_model');
		$contacts = $this->contacts_model->render();
		$this->template->write('contacts',$contacts);		

		//userful links
		$this->load->model('usefullinks_model');
		$usefullinks = $this->usefullinks_model->render(array('active'=>1));
		$this->template->write('usefullinks',$usefullinks);		

		//network
		$this->load->model('networks_model');
		$networks = $this->networks_model->render(array('active'=>1));
		$this->template->write('network',$networks);

		//employments
		$this->load->model('news_model');
		$params = array('news_type'=>7,'active'=>1);
		$employments = $this->news_model->render($params);
		$this->template->write('employments',$employments);

		//counter
		$counter = get_count_visitors();
		$this->template->write('counter',$counter);
	}

	private function _add_css(){
		$this->template->add_css(CSSPATH.'reset.css','link');
		$this->template->add_css(CSSPATH.'grid.css','link');
		$this->template->add_css(CSSPATH.'styles.css','link');
		$this->template->add_css(CSSPATH.'superfish.css','link');
		$this->template->add_css(CSSPATH.'default.css','link');
		$this->template->add_css(CSSPATH.'tmp.css','link');
		$this->template->add_css(CSSPATH.'images/favicon.png.css','link');
	}
	
	private function _add_scripts(){
		$this->template->add_js(JSPATH.'jquery-1.8.2.min.js');
		$this->template->add_js(JSPATH.'jquery.jqprint-0.3.js');
		$this->template->add_js(JSPATH.'jquery.easing.1.3.js');
		$this->template->add_js(JSPATH.'jquery.superfish.js');
		$this->template->add_js(JSPATH.'jquery.supersubs.js');
		$this->template->add_js(JSPATH.'jquery.totop.js');
		$this->template->add_js(JSPATH.'functions.js');
	}
}
