<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__).'/Core_model.php');
class Family_model extends Core_model{
	
	protected $table 	 = 'family'; 	//table used in model
	protected $key 		 = 'id'; 	//id used in model
	protected $order 	 = 'name'; 	//sort used in model
	protected $direction = 'desc';//direction used in model
	
	protected $defs = array();
	
	function __construct(){
		parent::__construct();
		$this->_set('_debug',FALSE);
		
		$defs['id'] 		=  ['type' => 'hidden','list'=>true, 'search'=>false];
		$defs['name'] 		=  ['type' => 'input' ,'list'=>true, 'search'=>true, 'rules'=>null];
		$defs['adress'] 	=  ['type' => 'input' ,'list'=>true, 'search'=>true, 'rules'=>null];
		$defs['postalcode']	=  ['type' => 'input' ,'list'=>true, 'search'=>true, 'rules'=>null]; 
		$defs['town']		=  ['type' => 'input' ,'list'=>true, 'search'=>true, 'rules'=>null];
		$defs['country'] 	=  ['type' => 'select','list'=>true, 'search'=>true, 'rules'=>null	,'values'=>array('FR'=>'France','GE'=>'Allemagne','CH'=>'Suisse')];
		
		$this->_set('defs',$defs);
		$this->_init_def();
	}
	


}
?>

