<?php
/*
 * element_checkboxdb.php
 * CHECKBOX Object in page
 * 
 */
require_once(APPPATH.'libraries/elements/element.php');

class element_checkboxdb extends element
{	

	protected $mode; //view, form.
	protected $name   	= null; //unique id ?
	protected $value  	= NULL;
	protected $values 	= [];
	protected $model	= '';
	protected $foreignkey = '';
    protected $ref = '';


	public function __construct(){
		parent::__construct();
		if ($this->model)
			$this->CI->load->model($this->model);
	}

	public function RenderFormElement(){
        $values = [];
        $id = $this->CI->render_object->_get('id');
        if ($id){
			$this->CI->{$this->model}->_set('filter', [$this->foreignkey => $id ]);
			$this->CI->{$this->model}->_set('order', $this->foreignkey);
			$dba_data = $this->CI->{$this->model}->get_all();
            foreach($dba_data AS $key=>$obj){
                $values[] = $obj->{$this->ref};
            }
        }
        $element = ''; 
        if (count($this->values)){
            foreach($this->values AS $key=>$value){
                $element .= '<div class="form-check">
                                <input class="form-check-input" type="checkbox" name="'.$this->name.'[]" id="'.$this->name.$key.'" value="'.$key.'" '.((in_array($key, $values)) ? "checked":"").'>
                                <label class="form-check-label" for="'.$this->name.$key.'">
                                '.$value.'
                                </label>
                            </div>';
                //$this->CI->bootstrap_tools->input_checkbox($this->name, $value);
            }
        }
		return $element;
	}
	
	public function PrepareForDBA($value){
        $src_post = json_encode($value);
        $id = $this->CI->render_object->_get('id');
		if (method_exists($this->CI->{$this->model},'DeleteLink'))
			$this->CI->{$this->model}->DeleteLink($id);
        foreach($value AS $key=>$value){
            $obj = new StdClass();
            $obj->{$this->foreignkey} = $id;
            $obj->{$this->ref} = $value;
            $obj->created = date('Y-m-d H:i:s');
            $this->CI->{$this->model}->post($obj);
        }
		return $src_post;
	}

	public function Render(){
		return (($this->value) ? LANG($this->name.'_'.$this->value):$this->name.'_NO');
	}

    public function AfterExec($datas){
        if ($this->CI->render_object->_get('form_mod') != 'edit')
		    $this->CI->{$this->model}->SetLink($this->foreignkey, $datas['id']);
	}

}

