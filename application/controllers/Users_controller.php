<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User Controller
 *
 * @package     WebApp
 * @subpackage  Core
 * @category    Factory
 * @author      Tmile
 * @link        http://www.24bis.com
 */
class Users_controller extends MY_Controller {

	var $title = 'Users';
	
	public function __construct(){
		parent::__construct();
		$this->_controller_name = 'users_controller';  //controller name for routing
		$this->_model_name 		= 'Users_model';	   //DataModel
		$this->_edit_view 		= 'edition/users_form';//template for editing
		
		$this->_set_crud_url();
		$this->_set('_debug', TRUE);
		
		$this->load->model('Users_model');
		$this->lang->load('users');
		
		$this->data_view['_controller_name'] = $this->_controller_name; 
		$this->data_view['title'] 			 = $this->title;
		$this->data_view['can_search'] 		 = true;
		
		$this->render_object->_set('datamodel',	'Users_model'); //init render object ( "ORM" Object )
		$this->render_object->create_elements();
		
	}

}
