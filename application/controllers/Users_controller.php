<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_controller extends MY_Controller {

	var $title = 'Users';
	
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Users_model');
		$this->load->library('pagination');
		$this->lang->load('users');
		
		$this->data_view['title'] = $this->title;
		$this->data_view['can_search'] = true;
		$this->_controller_name = 'users';
		$this->data_view['_controller_name'] = $this->_controller_name;
		
	}

	public function index(){
		redirect($this->_controller_name.'/list');
	}

	public function delete($id = 0){
		if ($id){
			$this->Users_model->_set('key_value',$id);
			$this->Users_model->delete();
		}
		redirect($this->_controller_name.'/list');
	}
	
	public function edit($id = 0)
	{
		$forms_fields = array();
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->data_view['id'] 		= $id;
		$this->data_view['fields'] 	= $this->Users_model->_get('autorized_fields');
		
		$hidden_form = array('form_mod'=>(($id) ? 'edit':'add'));
		
		//$this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[password]');
		foreach($this->data_view['fields'] AS $field){
			$def = ((isset($this->Users_model->_get('defs')[$field])) ? $this->Users_model->_get('defs')[$field]:'');
			if ($def){
				if (isset($def['rules']) AND $def['rules']){
					$this->form_validation->set_rules($field, $this->lang->line($field) , $def['rules']);
				}
				$forms_fields[$field] = new StdClass();
				$forms_fields[$field]->label = $this->bootstrap_tools->label($field);
				switch($def['type']){
					case 'input':
						$forms_fields[$field]->form = $this->bootstrap_tools->input_text($field, $field, set_value($field) );
					break;
					case 'select':
						$forms_fields[$field]->form = $this->bootstrap_tools->input_select($field, $def['values'] , set_value($field));
					break;
					case 'hidden':
						$hidden_form[$field] = ${$field};
					break;
				}
			}			
		}
		$forms_fields['hidden_form'] 	 = $hidden_form;
		$this->data_view['forms_fields'] = $forms_fields;
		
		if ($this->form_validation->run() === FALSE){


		} else {
			$datas = array();
			foreach($this->data_view['fields']  AS $field){
				$datas[$field] 	= $this->input->post($field);
			}	
			if ($this->input->post('form_mod') == 'edit'){
				if ($id){
					$this->Users_model->_set('key_value', $id);	
					$this->Users_model->_set('datas', $datas);
					$this->Users_model->put();
				} 
			} else if ($this->input->post('form_mod') == 'add'){
					$datas['id'] = $this->Users_model->post($datas);
			}
			redirect($this->_controller_name.'/list');
		}			
		if ($id){
			$this->Users_model->_set('key_value',$id);
		}
		
		$this->_set('view_inprogress','edition/users_form');
		$this->render_view();
	}

	public function list()
	{
		
		$config = array();
		$config['per_page'] 	= '20';
		$config['base_url'] 	= $this->config->item('base_url').$this->_controller_name.'/list/page/';
		$config['total_rows'] 	= $this->Users_model->get_pagination();
		$this->pagination->initialize($config);	
		
		$this->Users_model->_set('sort'			, $this->session->userdata('order'));
		$this->Users_model->_set('filter'		, $this->session->userdata('filter'));
		$this->Users_model->_set('direction'	, $this->session->userdata('direction'));
		$this->Users_model->_set('per_page'		, $config['per_page']);
		$this->Users_model->_set('page'			, $this->session->userdata('page'));
		
		//UI dropdown for filter
		$datas_dropdown = array();
		$datas_dropdown['type'] 	= $this->Users_model->get_distinct('type');
		$datas_dropdown['section'] 	= $this->Users_model->get_distinct('section');
		
		$this->bootstrap_tools->_set('datas_dropdown', $datas_dropdown );
		$this->bootstrap_tools->_set('base_url', base_url($this->_controller_name.'/list'));
		
		//GET DATAS
		$this->data_view['fields'] 	= $this->Users_model->_get('autorized_fields');
		$this->data_view['datas'] 	= $this->Users_model->get();
		$this->data_view['add_link']= '<a href="'.base_url($this->_controller_name.'/add').'" class="btn btn-outline-success btn-sm"><span class="oi oi-medical-cross"></span> '.$this->lang->line('ADD_USER').'</a>';
		
		$this->_set('view_inprogress','list_view');
		$this->render_view();
	}
}
