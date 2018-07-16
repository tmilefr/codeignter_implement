<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__).'/Core_model.php');
class Users_model extends Core_model{
	
	protected $table = 'Users'; 	//table used in model
	protected $key = 'id'; 	//id used in model
	protected $order = 'id'; 	//sort used in model
	protected $direction = 'desc';//direction used in model
	protected $autorized_fields = array('id','name','surname','email','password','type','section');
	protected $datas = array(); // datas in model
	protected $filter = array();//filter for model
	
	protected $definitions = array();
	
	
	


}
?>

