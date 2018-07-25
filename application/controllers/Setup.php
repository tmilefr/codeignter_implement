<?php  if ( ! defined('BASEPATH')) exit("No direct script access allowed");

class Setup extends CI_Controller
{
	
	protected $json_path = APPPATH.'models/json/';
	
	public function Reset(){
		
	}
  
	public function index()
	{
		$this->load->library('migration');

		if($this->migration->latest() === FALSE)
		{
			show_error($this->migration->error_string());
		}
		else
		{
			echo 'The migration has concluded successfully.';
			$this->LoadData('Family_data.json','Family_model','Family');
			$this->LoadData('Users_data.json','Users_model','Users');
		}
		
		
	}
	
	public function LoadData($json,$model,$path){
		$this->load->model($model);
		$json = file_get_contents($this->json_path.$json);
		$json = json_decode($json);
		foreach($json->{$path} AS $family){
			$this->{$model}->post($family);
		}
		
	}	

}
