<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Render_object{

	protected $CI = null; //base controller 
	protected $datamodel = null;
	protected $id = null;
	protected $elements = array();
	protected $dba_data = null;
	protected $_debug = FALSE;
	
	public function __construct(){
		$this->CI =& get_instance();
	}
	
	public function _set($field,$value){
		$this->$field = $value;
	}

	public function _get($field){
		return $this->$field;
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
		//echo '['.$field.'@'.$value.']';
		switch($this->elements[$field]->type){
			default:
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
