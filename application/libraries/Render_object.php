<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Render_object{

	protected $CI 		= NULL; //Controller instance 
	protected $datamodel= NULL; //Name of datamodel
	protected $id 		= NULL; //id of active element
	protected $elements = ARRAY(); //all ORM object
	protected $dba_data = NULL; //Data from DATABASE from id element
	protected $_debug 	= TRUE;//Debug 
	
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
			if (isset($defs['rules']) AND $defs['rules']){
				$this->CI->form_validation->set_rules($field, $this->CI->lang->line($field) , $defs['rules']);
			}
			$elmt = new StdClass();	
			$elmt->name = $field;
			$elmt->visible = $defs['list'];
			$elmt->type = $defs['type'];
			$elmt->rules = ((isset($defs['rules'])) ? $defs['rules']:array());
			$elmt->value = set_value($field);
			
			switch($defs['type']){
				default:
					$elmt->values = ((isset($defs['values'])) ? $defs['values']:array());
				break;
				case 'select_database':
				    $execute = explode(':', $defs['values']);
				    echo '$this->CI->{'.$execute[0].'}->{'.$execute[1].'};';
				    
					echo '<pre>'.print_r($this->CI->{$execute[0]}->{$execute[1]},1).'</pre>';
				break;
			}
			
			$this->elements[$field] = $elmt;			
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
