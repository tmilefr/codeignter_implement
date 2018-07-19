<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Render_object{

	protected $CI 		= NULL; //Controller instance 
	protected $datamodel= NULL; //Name of datamodel
	protected $id 		= NULL; //id of active element
	protected $elements = ARRAY(); //all ORM object
	protected $dba_data = NULL; //Data from DATABASE from id element
	protected $_debug 	= FALSE;//Debug 
	
	public function __construct(){
		$this->CI =& get_instance();
	}
	
	public function _set($field,$value){
		$this->$field = $value;
	}

	public function _get($field){
		return $this->$field;
	}	
	
	public function render_link($field){
		$filter 	= $this->CI->session->userdata('filter');
		$direction 	= $this->CI->session->userdata('direction');
		$add_string =  '';
		if (isset($filter[$field])){
			$add_string = '<span class="badge badge-success">'.$elements[$id]->values[$filter[$field]].'</span>';
		}
		$string_render_dropdown = '<div class="btn-group"><a class="nav-link " href="'.$this->base_url.'/order/'.$id.'/direction/'.(($direction == 'desc') ? 'asc':'desc').'">'.$this->CI->lang->line($id).' '.$add_string.'</a>';
		if (isset($elements[$id]->values[$filter[$field]])){
			$string_render_dropdown .= $this->CI->bootstrap_tools->render_dropdown($field, $elements[$id]->values);
		}
		return $string_render_dropdown.'</div>';
	}
	
	public function create_elements(){
		$model = $this->CI->{$this->datamodel};
		$hidden_form = array('form_mod'=>(($this->id) ? 'edit':'add'));
		foreach($model->_get('defs') AS $field=>$defs){
			if (isset($defs['rules']) AND $defs['rules']){
				$this->CI->form_validation->set_rules($field, $this->CI->lang->line($field) , $defs['rules']);
			}
			$elmt = new StdClass();	
			$elmt->name = $field;
			$elmt->visible = $defs['list'];
			$elmt->type = $defs['type'];
			$elmt->values = ((isset($defs['values'])) ? $defs['values']:array());
			$elmt->rules = ((isset($defs['rules'])) ? $defs['rules']:array());
			$elmt->value = set_value($field);
			$this->elements[$field] = $elmt;			
		}	
	}
	
	function RenderFormElement($field){
		$value = null;
		if ($value === set_value($field)){
			
		} else {
			if (isset($this->dba_data)){
				$value = $this->dba_data->{$field};
			}
		}
		
		switch($this->elements[$field]->type){
			case 'input':
				echo $this->CI->bootstrap_tools->input_text($field, $field, $value);
			break;
			case 'select':
				echo $this->CI->bootstrap_tools->input_select($field, $this->elements[$field]->values, $value);
			break;
		}
	}
	
	function RenderElement($field,$value){
		switch($this->elements[$field]->type){
			default:
			case 'password':
				return '*********';
			break;
			case 'input':
				return $value;
			break;
			case 'select':
				return $this->elements[$field]->values[$value];
			break;
		}
	}
	
	function get_fields(){
		return array_keys($this->elements);
	}

	
	public function __destruct(){
		if ($this->_debug == TRUE){
			unset($this->CI);
			echo '<pre><code>'.print_r($this , 1).'</code></pre>';
		}
	}
	
}
