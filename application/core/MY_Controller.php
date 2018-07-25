<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * MY_Controller
 *
 * @package     WebApp
 * @subpackage  Core
 * @category    Factory
 * @author      Tmile
 * @link        http://www.24bis.com
 */
class MY_Controller extends CI_Controller {
	
	protected $autorised_get_key 	= array('order','direction','filter','page','repertoire','search','id'); //key in url
	protected $controller_inprogress= NULL;
	protected $method_inprogress 	= NULL;
	protected $_debug_array  		= array();
	protected $_debug 				= TRUE;
	protected $_controller_name 	= null;
	protected $view_inprogress 		= null;
	protected $data_view 			= array();
	protected $crud_url	 			= null;
	protected $title 				= 'SASGWA';
	protected $slogan 				= 'Simple And Stupid Generic Web App';
			
	/**
	 * Generic Constructor
	 *
	 * @param       
	 * @return      void()
	 */
	public function __construct()
	{
		parent::__construct();
		
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('language');
		$this->load->helper('tools');
		$this->load->library('pagination');
		$this->load->library('Render_object');
		$this->load->library('bootstrap_tools');
		$this->load->library('form_validation');
		
		$this->load->model('GenericSql_model'); //model for render Object
		
		$this->process_url();
		$this->data_view['title'] 		= $this->title;
		$this->data_view['slogan'] 		= $this->slogan;
		$this->data_view['footer_line'] = '';	
		$this->data_view['can_search'] 	= FALSE;
		
		$this->data_view['can_edit'] 	= FALSE;
		$this->data_view['can_delete'] 	= FALSE;
		$this->data_view['can_list'] 	= FALSE;
		$this->data_view['global_search'] = $this->session->userdata($this->set_ref_field('global_search'));
		
	}
	
	 /**
	 * Url Used in app
	 *
	 * @param       $this->_debug boolean
	 * @return      void()
	 */
	public function _set_crud_url(){
		$this->crud_url = new Stdclass();
		$this->crud_url->create = base_url($this->_controller_name.'/add');
		$this->crud_url->edit 	= base_url($this->_controller_name.'/edit');
		$this->crud_url->read 	= base_url($this->_controller_name.'/list');
		$this->crud_url->delete = base_url($this->_controller_name.'/delete');	
	}
	
	/**
	 * Generic Destructor
	 *
	 * @param       $this->_debug boolean
	 * @return      void()
	 */
	function __destruct(){
		if ($this->_debug){
			$this->bootstrap_tools->render_debug($this->_debug_array);
		}
	}	
	
	/**
	 * RenderView
	 *
	 * @param       $this->view_inprogress
	 * @param		$this->data_view
	 * @return      void()
	 */
	function render_view(){
		if ($this->input->is_ajax_request()){
			$this->load->view($this->view_inprogress,	$this->data_view);
		} else {
			$this->load->view('template/head',			$this->data_view);
			$this->load->view($this->view_inprogress,	$this->data_view);
			$this->load->view('template/footer',		$this->data_view);	
		}
	}
	/**
	 * _debug : Set Debug Array
	 *
	 * @param       $this->_debug_array
	 * @param		$msg (string)
	 * @return      void()
	 */
	function _debug($msg){
		$this->_debug_array[] = $msg;
	}
 
	public function process_url(){
		if ($this->input->post('global_search')){
			$this->session->set_userdata( $this->set_ref_field('global_search') ,$this->input->post('global_search'));
		}
		$array = $this->uri->uri_to_assoc(3);
		foreach($array AS $field=>$value){
			if (in_array($field,$this->autorised_get_key)){
				switch($field){
					case 'search':
						$this->session->set_userdata( $this->set_ref_field('global_search') ,'');
					break;
					case 'filter':
						$filtered = $this->session->userdata( $this->set_ref_field('filter') );
						if ($array['filter_value'] == 'all'){
							unset($filtered[$value]);
						} else {
							$filtered[$value] = $array['filter_value'];
						}
						$this->session->set_userdata( $this->set_ref_field('filter') , $filtered );
						
					break;
					default:
						$this->session->set_userdata( $this->set_ref_field($field) , $value );
					break;
				}
			}
		}
	} 
	
	public function set_ref_field($name){
		return $name.'_'.$this->_controller_name;
	}
	
	public function delete($id = 0){
		if ($id){
			$this->{$this->_model_name}->_set('key_value',$id);
			$this->{$this->_model_name}->delete();
		}
		redirect($this->crud_url->read);
	}
	
	public function add(){
		$this->edit();
	}
	
	public function edit($id = 0)
	{		
		$this->data_view['form_mod'] = 'add';
		$this->data_view['id'] = '';
		if ($id){
			$this->render_object->_set('id',		$id);
			$this->{$this->_model_name}->_set('key_value',$id);
			$dba_data = $this->{$this->_model_name}->get_one();
			$this->render_object->_set('dba_data',$dba_data);
			$this->data_view['form_mod'] = 'edit';
			$this->data_view['id'] = $id;
		}
		
		//$this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[password]');
		if ($this->form_validation->run() === FALSE){


		} else {
			$datas = array();
			foreach($this->{$this->_model_name}->_get('autorized_fields') AS $field){
				$datas[$field] 	= $this->input->post($field);
			}
			if ($this->input->post('form_mod') == 'edit'){
				if (isset($datas['id']) AND $id = $datas['id']){
					$this->{$this->_model_name}->_set('key_value', $id);	
					$this->{$this->_model_name}->_set('datas', $datas);
					$this->{$this->_model_name}->put();
				} 
			} else if ($this->input->post('form_mod') == 'add'){
				$datas['id'] = $this->{$this->_model_name}->post($datas);
			}
			redirect($this->crud_url->read);
		}			

		
		$this->_set('view_inprogress',$this->_edit_view);
		$this->render_view();
	}

	public function list()
	{
		
		$config = array();
		$config['per_page'] 	= '20';
		$config['base_url'] 	= $this->config->item('base_url').$this->_controller_name.'/list/page/';
		$config['total_rows'] 	= $this->{$this->_model_name}->get_pagination();
		$this->pagination->initialize($config);	
		
		$this->{$this->_model_name}->_set('global_search'	, $this->session->userdata($this->set_ref_field('global_search')));
		$this->{$this->_model_name}->_set('order'			, $this->session->userdata($this->set_ref_field('order')));
		$this->{$this->_model_name}->_set('filter'			, $this->session->userdata($this->set_ref_field('filter')));
		$this->{$this->_model_name}->_set('direction'		, $this->session->userdata($this->set_ref_field('direction')));
		$this->{$this->_model_name}->_set('per_page'		, $config['per_page']);
		$this->{$this->_model_name}->_set('page'			, $this->session->userdata($this->set_ref_field('page')));
		
		$this->bootstrap_tools->_set('base_url',$this->_get('crud_url')->read);
		
		//GET DATAS
		$this->data_view['fields'] 	= $this->{$this->_model_name}->_get('autorized_fields');
		$this->data_view['datas'] 	= $this->{$this->_model_name}->get();
		
		
		$this->_set('view_inprogress','list_view');
		$this->render_view();
	}

	public function index(){
		redirect($this->crud_url->read);
	}

	
	public function _set($field,$value){
		$this->$field = $value;
	}

	public function _get($field){
		return $this->$field;
	} 

}

?>
