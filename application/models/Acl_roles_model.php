<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(dirname(__FILE__).'/Core_model.php');
class Acl_roles_model extends Core_model{

	function __construct(){
		parent::__construct();
		$this->_set('_debug', FALSE);
		
		$this->_set('table'	, 'acl_roles');
		$this->_set('key'	, 'id');
		$this->_set('order'	, 'role_name');
		$this->_set('direction'	, 'desc');
		$this->_set('json'	, 'Acl_roles.json');
		$this->_init_def();
	}

	function GetRoles($id = null){
		if ($id){
			$this->db->set('id', $id_ctrl);
			$this->db->where('id_ctrl', 0);
			$this->db->update($this->table);	
			$this->_debug_array[] = $this->db->last_query();
		}
	}

}
?>

