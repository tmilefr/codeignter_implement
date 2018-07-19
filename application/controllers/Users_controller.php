<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_controller extends MY_Controller {

	var $title = 'Users';
	
	public function __construct(){
		parent::__construct();
		$this->load->model('Users_model');
		
		$this->lang->load('users');
		
		$this->data_view['title'] = $this->title;
		$this->data_view['can_search'] = true;
		
		$this->_controller_name = 'users';
		$this->_model_name = 'Users_model';
		$this->_edit_view = 'edition/users_form';
		$this->data_view['_controller_name'] = $this->_controller_name;

		$this->render_object->_set('datamodel',	'Users_model');
		$this->render_object->create_elements();			
	}

	public function list()
	{
		
		$config = array();
		$config['per_page'] 	= '20';
		$config['base_url'] 	= $this->config->item('base_url').$this->_controller_name.'/list/page/';
		$config['total_rows'] 	= $this->{$this->_model_name}->get_pagination();
		$this->pagination->initialize($config);	
		
		$this->{$this->_model_name}->_set('sort'			, $this->session->userdata('order'));
		$this->{$this->_model_name}->_set('filter'			, $this->session->userdata('filter'));
		$this->{$this->_model_name}->_set('direction'		, $this->session->userdata('direction'));
		$this->{$this->_model_name}->_set('per_page'		, $config['per_page']);
		$this->{$this->_model_name}->_set('page'			, $this->session->userdata('page'));
		
		$defs = $this->render_object->_get('elements');
		
		//UI dropdown for search filter
		$datas_dropdown = array();
		$datas_dropdown['type'] 	= $this->{$this->_model_name}->get_distinct('type');
		$datas_dropdown['section'] 	= $this->{$this->_model_name}->get_distinct('section');
		
		$this->bootstrap_tools->_set('datas_dropdown', $datas_dropdown );
		$this->bootstrap_tools->_set('base_url', base_url($this->_controller_name.'/list'));
		
		//GET DATAS
		$this->data_view['fields'] 	= $this->{$this->_model_name}->_get('autorized_fields');
		$this->data_view['datas'] 	= $this->{$this->_model_name}->get();
		$this->data_view['add_link']= '<a href="'.base_url($this->_controller_name.'/add').'" class="btn btn-outline-success btn-sm"><span class="oi oi-plus"></span> '.$this->lang->line('menu_add_'.$this->router->class).'</a>';
		
		$this->_set('view_inprogress','list_view');
		$this->render_view();
	}
	
	function __destruct(){
		//echo '<pre><code>'.print_r($this , 1).'</code></pre>';
	}
}
