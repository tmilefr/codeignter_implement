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
		$filter 	= $this->CI->session->userdata($this->CI->set_ref_field('filter'));
		$direction 	= $this->CI->session->userdata($this->CI->set_ref_field('direction'));
		
		$add_string =  '';
		if (isset($filter[$field])){
			$add_string = '<span class="badge badge-success">'.$this->elements[$field]->values[$filter[$field]].'</span>';
		}
		$string_render_link = '<div class="btn-group">';
		
		$string_render_link .= $this->CI->bootstrap_tools->render_head_link($field, $direction, $this->CI->_get('crud_url')->read, $add_string);
		if (isset($this->elements[$field]->values)){
			$string_render_link .= $this->CI->bootstrap_tools->render_dropdown($field, $this->elements[$field]->values, $this->CI->_get('crud_url')->read );
		}
		$string_render_link .= '</div>';
		return $string_render_link;
	}
	
	public function create_elements(){
		$model = $this->CI->{$this->datamodel};
		$hidden_form = array('form_mod'=>(($this->id) ? 'edit':'add'));
		foreach($model->_get('defs') AS $field=>$defs){
			if (isset($defs->rules) AND $defs->rules){
				$this->CI->form_validation->set_rules($field, $this->CI->lang->line($field) , $defs->rules);
			}
			/*$elmt = new StdClass();	
			$elmt->name = $field;
			$elmt->visible = $defs['list'];
			$elmt->type = $defs['type'];
			$elmt->rules = ((isset($defs['rules'])) ? $defs['rules']:array());*/
			$defs->value = set_value($field);
			switch($defs->type){
				default:
					$data = array();
					if (isset($defs->values)){
						foreach($defs->values AS $key=>$value){
							$data[$key] = $value;
						}
					}
					$defs->values = $data;
						
				break;
				case 'select_database':
				  $datas_select = array();
				  preg_match('/(\w+)\((\w+)\,(\w+)\:(\w+)\)/', $defs->values, $param);
				  if (method_exists($this->CI->GenericSql_model,$param[1])){
					  $datas = $this->CI->GenericSql_model->{$param[1]}($param[2],$param[3],$param[4]);
				  } 
				  foreach($datas AS $data){
					$datas_select[$data->{$param[3]}] = $data->{$param[4]};
				  }
				  $defs->values = $datas_select;
				break;
			}
			
			$this->elements[$field] = $defs;			
		}	
	}
	
	function RenderFormElement($field){
		$value = null;
		if ($value === set_value($field)){ //in first, POST data
			
		} else {
			if (isset($this->dba_data)){ // try to check database
				$value = $this->dba_data->{$field};
			}
		}
		
		switch($this->elements[$field]->type){
			default:
			case 'input':
				echo $this->CI->bootstrap_tools->input_text($field, $field, $value);
			break;
			case 'password':
				echo $this->CI->bootstrap_tools->password_text($field, $field, $value);
			break;
			case 'select_database':
			case 'select':
				echo $this->CI->bootstrap_tools->input_select($field, $this->elements[$field]->values, $value);
			break;
		}
	}
	
	function RenderElement($field,$value){
		switch($this->elements[$field]->type){
			case 'password':
				return '*********';
			break;
			default:
			case 'input':
				return $value;
			break;
			case 'select_database':
			case 'select':
				if (isset($this->elements[$field]->values[$value]))
					return $this->elements[$field]->values[$value];
				else
					return 'indef';
			
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
