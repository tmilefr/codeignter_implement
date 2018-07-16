<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Super Class
 *
 * @package     WebApp
 * @subpackage  Core
 * @category    Factory
 * @author      Tmile
 * @link        http://24bis.com
 */
class MY_Controller extends CI_Controller {
	
	protected $data_view = array();
	protected $_debug_array  = array();
	protected $autorised_get_key = array('order','direction','filter','page','repertoire','search');
	protected $controller_inprogress = NULL;
	protected $method_inprogress = NULL;
	protected $_debug = FALSE;
	
	
	/**
	 * Generic Constructor
	 *
	 * @param       
	 * @return      void()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->library('bootstrap_tools');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('language');
		
		$this->process_url();
		$this->data_view['title'] = $this->title;
		$this->data_view['footer_line'] = '';	
		$this->data_view['can_search'] = false;
	}
	/**
	 * Generic Destructor
	 *
	 * @param       $this->_debug boolean
	 * @return      void()
	 */
	function __destruct(){
		if ($this->_debug)
			$this->bootstrap_tools->render_debug($this->_debug_array);
	}	
 
	function _debug($msg){
		$this->_debug_array[] = $msg;
	}
 
	public function process_url(){
		if ($this->input->post('global_search')){
			$this->session->set_userdata('global_search',$this->input->post('global_search'));
		}
		$array = $this->uri->uri_to_assoc(3);
		foreach($array AS $field=>$value){
			if (in_array($field,$this->autorised_get_key)){
				switch($field){
					case 'search':
						$this->session->set_userdata('global_search','');
					break;
					case 'filter':
						$filtered = $this->session->userdata('filter');
						if ($array['filter_value'] == 'all'){
							unset($filtered[$value]);
						} else {
							$filtered[$value] = $array['filter_value'];
						}
						$this->session->set_userdata($field, $filtered );
					break;
					default:
						$this->session->set_userdata($field, $value );
					break;
				}
			}
		}
	} 

	public function _set($field,$value){
		$this->$field = $value;
	}

	public function _get($field){
		return $this->$field;
	} 

}

?>
