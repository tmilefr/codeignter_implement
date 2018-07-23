<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	
	public function __construct(){
		$this->_controller_name = 'Home';  //controller name for routing
		parent::__construct();
		$this->title .= ' - '.$this->lang->line($this->_controller_name);
		$this->data_view['content'] = '<h1> Test </h1>';
	}

	public function index()
	{
		$this->_set('view_inprogress','home_page');
		$this->render_view();
	}
}
