<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	var $data = array();
	var $title = 'WebAPP';
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->data_view['title'] = $this->title;
		$this->data_view['content'] = '<h1>Test</h1>';
		$this->_controller_name = 'home';
	}

	public function index()
	{
		$this->_set('view_inprogress','home_page');
		$this->render_view();
	}
}
