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
		
	}

	public function index()
	{
		$this->bootstrap_tools->_set('base_url', base_url('home/index'));
		
		$this->data['content'] = '';
		$this->load->view('template/head',		$this->data_view);
		$this->load->view('home_page',			$this->data_view);
		$this->load->view('template/footer',	$this->data_view);		
	}
}
