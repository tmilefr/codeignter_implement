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
class Collaborateur_controller extends MY_Controller {

	protected $csv_path = '';

	public function __construct(){
		parent::__construct();
		$this->_controller_name = 'Collaborateur_controller';  //controller name for routing
		$this->_model_name 		= 'Collaborateur_model';	   //DataModel
		$this->_edit_view 		= 'edition/Collaborateur_form';//template for editing
		$this->_list_view		= 'unique/Collaborateur_view.php';
		$this->_autorize 		= array('list'=>true,'add'=>true,'edit'=>true,'delete'=>true,'view'=>true);
		$this->title 			.= $this->lang->line('GESTION').$this->lang->line($this->_controller_name);
		
		$this->init();
		
		$this->{$this->_model_name}->_set('_debug', FALSE);

		$this->load->library('Pegase');

		$this->load->model('Projets_model');
		$this->render_object->Set_Rules_elements('Projets_model'); //loading Infos_model ELements	
		$this->load->model('Nf_model');
		$this->render_object->Set_Rules_elements('Nf_model'); //loading Infos_model ELements
	}

	public function view($id, $month = null){
		$this->_set('render_view', false);
		parent::view($id);

		/* gestiond des dates */
		if (!$month)
			$month = date('m');
		$maxday = cal_days_in_month(CAL_GREGORIAN, $month , date('Y') );
		$year 	= date('Y')-1;

		$DateDebut = $year."-".(($month < 10) ? "0":"").$month."-01T00:00+02:00";
		$DateFin = $year."-".(($month < 10) ? "0":"").$month."-".$maxday."T00:00+02:00";
		$dba_data 	= $this->render_object->_get('dba_data');

		$infopegase = $this->pegase->GetPegaseAgent($dba_data->registration_number );
		echo debug($infopegase);

		$this->pegase->getPegase($DateDebut, $DateFin , $dba_data->registration_number );
		$this->pegase->Parse();

		$this->data_view['month'] 	= (($month < 10) ? "0":"").$month;
		$this->data_view['results'] = $this->pegase->_get('results') ;
		$this->data_view['stats'] 	= $this->pegase->_get('stats') ;

		//$this->_set('view_inprogress','unique/'.$this->_controller_name.'_pegase');
		$this->render_view();	
	}

	public function pegase(){
		if (function_exists("set_time_limit") == TRUE AND @ini_get("safe_mode") == 0) /* directory process is long ! TODO : change the method*/
		{
			@set_time_limit(300);
		}

		$this->_set('view_inprogress','unique/'.$this->_controller_name.'_pegase');
		$this->data_view['results'] = [];
		$collabs = $this->{$this->_model_name}->get_all();
		$DateDebut = "2022-01-01T00:00+02:00";
		$DateFin   = "2022-12-31T00:00+02:00";

		foreach($collabs as $key=>$collab){

			$infopegase = $this->pegase->GetPegaseAgent($collab->registration_number );
			$this->Collaborateur_model->UpdateNumAgent($collab->registration_number,$infopegase['IDNUMAGENT']);
			/*$this->pegase->getPegase($DateDebut, $DateFin , $collab->registration_number );
			$this->pegase->_set('opt_no_stats', TRUE);
			$this->pegase->_set('opt_save_in_base', TRUE);
			$res = $this->pegase->Parse();*/
		}
		$this->data_view['results'] = [];
		$this->render_view();	
	}
}
