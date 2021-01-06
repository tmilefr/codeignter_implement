<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User Controller
 *
 * @package     WebApp
 * @subpackage  Core
 * @category    Factory
 * @author      Tmile
 * @link        http://www.24bis.com
 */
class Acl_roles_controller extends MY_Controller {

	public function __construct(){
		parent::__construct();
		
		$this->_controller_name = 'Acl_roles_controller';  //controller name for routing
		$this->_model_name 		= 'Acl_roles_model';	   //DataModel
		$this->_edit_view 		= 'edition/Acl_roles_form';//template for editing
		$this->_list_view		= 'unique/Acl_roles_view.php';
		$this->_autorize 		= array('add'=>true,'edit'=>true,'list'=>true,'delete'=>true,'view'=>true,'set_rules'=>true);
		
		
		$this->title .= ' - '.$this->lang->line($this->_controller_name);
		
		$this->_set('_debug', TRUE);
		$this->init();
		
		$this->load->model('Acl_controllers_model');
		$this->load->model('Acl_roles_controllers_model');
		$this->load->model('Acl_actions_model');
	}

	public function set_rules($id){
		
		$this->_set('view_inprogress','edition/set_rules_view');
		
		if ($this->input->post('form_mod') == 'roles'){
			if ($this->input->post('rules')){
				$this->Acl_roles_controllers_model->DelRole($id);
				foreach($this->input->post('rules') AS $rule){
					list($id_ctrl,$id_act) = explode('_', $rule);
					$acl_rca = new StdClass();
					$acl_rca->id_role = $id;
					$acl_rca->id_ctrl = $id_ctrl;
					$acl_rca->id_act = $id_act;
					$acl_rca->allow = 1;
					$this->Acl_roles_controllers_model->post($acl_rca);
				}
			}
		}

		$this->data_view['ctrls'] 	= $this->Acl_controllers_model->get_all();
		
		$acl_rca = $this->Acl_roles_controllers_model->get_all();
		$this->data_view['acl_rc'] = [];
		foreach($acl_rca AS $rca){
			$this->data_view['acl_rc'][$rca->id_ctrl.'_'.$rca->id_act] = $rca->allow;
		}

		$this->data_view['id'] 	= $id;
		foreach($this->data_view['ctrls'] AS $key=>$ctrl){
			$this->Acl_actions_model->_set('filter',['id_ctrl'=>$ctrl->id]);
			$this->data_view['ctrls'][$key]->actions = $this->Acl_actions_model->get_all();
		}

		$this->render_view();
	}

}
