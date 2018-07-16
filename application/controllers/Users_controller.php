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
	}

	public function index(){
		redirect('users/list');
	}

	public function edit($id = 0)
	{
		$this->load->helper('form');
		
		if ($id){
			
		}
		$this->data_view['fields'] = $this->Users_model->_get('autorized_fields');
		foreach($this->data_view['fields']  AS $field){
			$this->data_view[$field] 	= $this->input->post($field);
		}
		
		$this->load->view('template/head',		$this->data_view);
		$this->load->view('edition/users_form',	$this->data_view);
		$this->load->view('template/footer',	$this->data_view);	
	}

	public function list()
	{
		
		$config = array();
		$config['per_page'] 	= '20';
		
		$this->Users_model->_set('sort'			, $this->session->userdata('order'));
		$this->Users_model->_set('filter'		, $this->session->userdata('filter'));
		$this->Users_model->_set('direction'	, $this->session->userdata('direction'));
		$this->Users_model->_set('per_page'		, $config['per_page']);
		$this->Users_model->_set('page'			, $this->session->userdata('page'));

		$config['base_url'] 	= $this->config->item('base_url').'users_controller/list/page/';
		$config['total_rows'] 	= $this->Users_model->get_pagination();
		$this->pagination->initialize($config);	

		//UI dropdown for filter
		$datas_dropdown = array();
		$datas_dropdown['type'] = $this->Users_model->get_distinct('type');
		$datas_dropdown['section'] = $this->Users_model->get_distinct('section');
		
		$this->bootstrap_tools->_set('datas_dropdown', $datas_dropdown );
		$this->bootstrap_tools->_set('base_url', base_url('users_controller/list'));

		$this->data_view['fields'] = $this->Users_model->_get('autorized_fields');
		$this->data_view['datas'] = $this->Users_model->get();
		$this->load->view('template/head',	$this->data_view);
		$this->load->view('list_view',		$this->data_view);
		$this->load->view('template/footer',$this->data_view);	
			
	}
}
