<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_controller extends MY_Controller {

	var $title = 'Users';
	
	public function __construct(){
		parent::__construct();
		$this->load->model('Users_model');
		$this->lang->load('users');

		$this->_controller_name = 'users_controller'; //controller name for routing
		$this->_model_name 		= 'Users_model';	  //DataModel
		$this->_edit_view 		= 'edition/users_form';//template for editing
		
		$this->data_view['_controller_name'] = $this->_controller_name; 
		$this->data_view['title'] = $this->title;
		$this->data_view['can_search'] = true;
		
		$this->render_object->_set('datamodel',	'Users_model'); //init render object ( "ORM" Object )
		$this->render_object->create_elements();
		
	}

}
