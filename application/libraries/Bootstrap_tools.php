<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Bootstrap_tools{

	protected $datas_dropdown = array(); // items of datas 
	protected $CI = null; //base controller 
	
	public function __construct(){
		$this->CI =& get_instance();
	}
	
	public function _set($field,$value){
		$this->$field = $value;
	}

	public function _get($field){
		return $this->$field;
	}	
	
	public function render_dropdown($id){
		$filter = $this->CI->session->userdata('filter');
		$direction = $this->CI->session->userdata('direction');
		$add_string =  '';
		if (isset($filter[$id])){
			$add_string = '<span class="badge badge-success">'.$filter[$id].'</span>';
		}
		//Basic LINK
		$string_render_dropdown = '<div class="btn-group"><a class="nav-link " href="'.base_url().'/order/'.$id.'/direction/'.(($direction == 'desc') ? 'asc':'desc').'">'.$this->CI->lang->line($id).' '.$add_string.'</a>';
		//DROPDOWN FILTER
		if (isset($this->datas_dropdown[$id])){
			$string_render_dropdown .= '<ul class="navbar-nav mr-auto">
			<a class="nav-link dropdown-toggle dropdown-toggle-split" href="#" id="navbarDropdownFrom" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdown">';
				foreach($this->datas_dropdown[$id] AS $key => $value){
					$string_render_dropdown .= '<a class="dropdown-item" href="'.base_url().'/filter/'.$id.'/filter_value/'.$value->{$id}.'">'.$this->CI->lang->line($value->{$id}).'</a>';
				}
				$string_render_dropdown .= '<a class="dropdown-item" href="'.base_url().'/filter/'.$id.'/filter_value/all">'.$this->CI->lang->line('All').'</a>';
			$string_render_dropdown .= '</div>';
		}
		$string_render_dropdown .= '</div>';
		return $string_render_dropdown;
		
	}	
	
	function render_debug($messages){
		if (is_array($messages) AND count($messages)){
			echo '<a class="btn btn-warning btn-sm" data-toggle="collapse" href="#collapseDEBUG" role="button" aria-expanded="false" aria-controls="collapseExample">DEBUG</a>';
			echo '<div class="collapse" id="collapseDEBUG">';
			echo '<table class="table table-sm">';
			foreach($messages AS $message){
				echo '<tr><th scope="row">'.$message->from.'</th><td>'.$message->type.'</td><td>'.$message->file.'</td><td>'.$message->line.'</td><td>'.$message->message.'</td></tr>';
			}
			echo '</table></div>';
		}
	}
	
	public function render_link($id){
		return $this->render_dropdown($id);
	}
	
	public function render_menu_link($name,$icon = null){
		return  '<li class="nav-item '.(($this->CI->_get('_controller_name') == $name ) ? 'active':'').'"><a class="nav-link" href="'.base_url().''.$name.'">'.(($icon) ? '<span class="oi '.$icon.'"></span>':'').' '.$this->CI->lang->line($name).'<span class="sr-only">'.(($this->CI->_get('_controller_name') == $name) ? '(current)':'').'</span></a></li>';
	}
	
	public function label($name){
		return '<label for="input'.$name.'">'.$this->CI->lang->line($name).'</label>';
	}
	
	public function input_text($name,$placeholder = '',$value = ''){
		return '<input type="text" class="form-control" name="'.$name.'" id="input'.$name.'" placeholder="'.$placeholder.'" value="'.$value.'">';
	}
	
	public function input_select($name, $values, $selected = ''){
		$input_select = '<select id="input'.$name.'" name="'.$name.'" class="form-control">';
		$input_select .= '<option '.(($selected == '') ? 'selected="selected"':'').'>...</option>';
		foreach($values AS $key=>$value){
			$input_select .= '<option value="'.$key.'" '.(($key == $selected AND $selected) ? 'selected="selected"':'').'>'.$value.'</option>';
		}
		$input_select .= '</select>';
		return $input_select;
	}
	
}
