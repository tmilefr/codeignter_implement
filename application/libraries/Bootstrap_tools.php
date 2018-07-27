<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Bootstrap_tools{

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
	
	public function render_icon_link($url,$id,$icon, $color){
		return '<a class="btn btn-sm '.$color.'"  href="'.$url.'/'.$id.'"><span class="oi '.$icon.'"></span></a>&nbsp;';
	}
	
	public function render_dropdown($field,$values, $url){
		$string_render_dropdown = '';
		if (count($values)){
			$string_render_dropdown .= '<ul class="navbar-nav mr-auto">
			<a class="nav-link dropdown-toggle dropdown-toggle-split" href="#" id="navbarDropdownFrom" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdown">';
				foreach($values AS $key => $value){
					$string_render_dropdown .= '<a class="dropdown-item" href="'.$url.'/filter/'.$field.'/filter_value/'.$key.'">'.$this->CI->lang->line($value).'</a>';
				}
				$string_render_dropdown .= '<a class="dropdown-item" href="'.$url.'/filter/'.$field.'/filter_value/all">'.$this->CI->lang->line('All').'</a>';
			$string_render_dropdown .= '</div></ul>';
		}
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
	
	public function render_head_link($field, $direction, $url, $add_string ){
		return '<a class="nav-link " href="'.$url.'/order/'.$field.'/direction/'.(($direction == 'desc') ? 'asc':'desc').'">'.$this->CI->lang->line($field).' '.$add_string.'</a>';
	}

	public function label($name){
		return '<label for="input'.$name.'">'.$this->CI->lang->line($name).'</label>';
	}
	
	public function input_text($name,$placeholder = '',$value = ''){
		return '<input type="text" class="form-control" name="'.$name.'" id="input'.$name.'" placeholder="'.$placeholder.'" value="'.$value.'">';
	}
	public function password_text($name,$placeholder = '',$value = ''){
		return '<input type="password" class="form-control" name="'.$name.'" id="input'.$name.'" placeholder="'.$placeholder.'" value="'.$value.'">';
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
