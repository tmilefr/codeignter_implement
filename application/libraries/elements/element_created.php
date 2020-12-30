<?php
/*
 * element_created.php
 * created Date Object in page
 * 
 */
require_once(APPPATH.'libraries/elements/element.php');

class element_created extends element
{	
	protected $form_mod;

	/**
	 * Generic set
	 * @return void
	 */
	public function _set($field,$value){
		$this->$field = $value;
		//echo debug($value);
	}

	public function RenderFormElement(){
		if ($this->form_mod == 'edit'){
			return  form_hidden($this->name , $this->value);
		} else {
			return form_hidden($this->name , date('Y-m-d h:i:s'));
		}
	}
	
	public function Render(){
		return ($this->value);
	}
}

