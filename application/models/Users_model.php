<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__).'/Core_model.php');
class Users_model extends Core_model{
	
	protected $table = 'users'; 	//table used in model
	protected $key = 'id'; 	//id used in model
	protected $order = 'id'; 	//sort used in model
	protected $direction = 'desc';//direction used in model
	protected $autorized_fields = array('id','name','surname','email','password','type','section');
	protected $autorized_fields_search = array('name','surname');
	protected $datas = array(); // datas in model
	protected $filter = array();//filter for model
	
	protected $defs = array();
	
	function __construct(){
		parent::__construct();
		$this->_set('_debug',FALSE);
		
		$defs['id'] 		=  ['type' => 'hidden','list'=>true];
		$defs['name'] 	=  ['type' => 'input' ,'list'=>true,'rules'=>'trim|required|min_length[5]|max_length[12]'];
		$defs['surname']	=  ['type' => 'input' ,'list'=>true,'rules'=>null];
		$defs['email'] 	=  ['type' => 'input' ,'list'=>true,'rules'=>'required']; //is_unique[users.email]
		$defs['password']	=  ['type' => 'password' ,'list'=>true,'rules'=>'trim|required|min_length[8]'];
		$defs['type'] 	=  ['type' => 'select','list'=>true,'rules'=>null	,'values'=>array(1=>'famille',2=>'individuelle')];
		$defs['section'] 	=  ['type' => 'select','list'=>true,'rules'=>null	,'values'=>array(1=>'Motonautisme',2=>'Ski',3=>'Voile',4=>'Wake')];
		
		$this->_set('defs',$defs);
	}
	


}
?>

