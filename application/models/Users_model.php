<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__).'/Core_model.php');
class Users_model extends Core_model{
	
	protected $table 	 = 'users'; 	//table used in model
	protected $key 		 = 'id'; 	//id used in model
	protected $order 	 = 'name'; 	//sort used in model
	protected $direction = 'desc';//direction used in model

	function __construct(){
		parent::__construct();
		$this->_set('_debug',FALSE);
		
		$defs['id'] 		=  ['type' => 'hidden',		'list'=>true, 'search'=>false];
		$defs['name'] 		=  ['type' => 'input' ,		'list'=>true, 'search'=>true,	'rules'=>'trim|required|min_length[5]|max_length[255]'];
		$defs['surname']	=  ['type' => 'input' ,		'list'=>true, 'search'=>true,	'rules'=>null];
		$defs['email'] 		=  ['type' => 'input' ,		'list'=>true, 'search'=>true,	'rules'=>'required']; //is_unique[users.email]
		$defs['password']	=  ['type' => 'password',	'list'=>true, 'search'=>false,	'rules'=>'trim|required|min_length[8]'];
		$defs['type'] 		=  ['type' => 'select',		'list'=>true, 'search'=>false,	'rules'=>null	,'values'=>array(1=>'famille',2=>'individuelle')];
		$defs['section']	=  ['type' => 'select',		'list'=>true, 'search'=>false,	'rules'=>null	,'values'=>array(1=>'Motonautisme',2=>'Ski',3=>'Voile',4=>'Wake')];
		$defs['family']		=  ['type' => 'select_database', 'list'=>true, 'search'=>false,	'rules'=>null	,'values'=>'distinct(family,id:name)'];
		$this->_set('defs',$defs);
		$this->_init_def();
		
	}
	


}
?>

