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

	public function __construct(){
		
		$this->_controller_name = 'users_controller';  //controller name for routing
		$this->_model_name 		= 'Users_model';	   //DataModel
		$this->_edit_view 		= 'edition/users_form';//template for editing
		parent::__construct();
		$this->title .= ' - '.$this->lang->line($this->_controller_name);
		
		$this->_set_crud_url();
		$this->_set('_debug', TRUE);
		
		$this->load->model($this->_model_name);
		$this->lang->load($this->_controller_name);
		
		$this->data_view['_controller_name'] = $this->_controller_name; 
		$this->data_view['_model_name'] 	 = $this->_model_name; 
		$this->data_view['title'] 			 = $this->title;
		$this->data_view['can_search'] 		 = TRUE;
		$this->data_view['can_edit'] 		 = TRUE;
		$this->data_view['can_delete'] 		 = TRUE;
	
		
		
		$this->render_object->_set('datamodel',	$this->_model_name); //init render object ( "ORM" Object )
		$this->render_object->create_elements();
		
	}

}
