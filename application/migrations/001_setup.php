<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_setup extends CI_Migration {

		protected $json = null;
		protected $json_path = APPPATH.'models/json/';

		public function _get_json($json){
			$json = file_get_contents($this->json_path.$json);
			$json = json_decode($json);
			$fields = array();
			foreach($json AS $field => $define){
				$def = array();
				foreach($define->dbforge AS $key=>$value){
					$def[$key] = $value;
				}
				$fields[$field] = $def;
			}
			return $fields;
		}
        
        public function up()
        {		
			$this->dbforge->add_field( $this->_get_json('Users.json') );
			$this->dbforge->add_key('id', TRUE);
			$this->dbforge->create_table('users');  
			
			$this->dbforge->add_field( $this->_get_json('Family.json') );
			$this->dbforge->add_key('id', TRUE);
			$this->dbforge->create_table('family');    
        }

        public function down()
        {
			$this->dbforge->drop_table('users');
			$this->dbforge->drop_table('family');
        }
}

?>
