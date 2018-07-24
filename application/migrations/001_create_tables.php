<?php

/*CREATE DATABASE `app` 

CREATE TABLE `app`.`ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
*/

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_tables extends CI_Migration {

        public function up()
        {
			$this->dbforge->add_field(array(
					'id' => array(
							'type' => 'INT',
							'constraint' => 11,
							'unsigned' => TRUE,
							'auto_increment' => TRUE
					),
					'name' => array(
							'type' => 'VARCHAR',
							'constraint' => 255,
					),
					'adress' => array(
							'type' => 'VARCHAR',
							'constraint' => 255,
					),
					'postalcode' => array(
							'type' => 'VARCHAR',
							'constraint' => 5,
					), 
					'town' => array(
							'type' => 'VARCHAR',
							'constraint' => 255,
					),  
					'country' => array(
							'type' => 'VARCHAR',
							'constraint' => 255,
					),                                                                        
			));
			$this->dbforge->add_key('id', TRUE);
			$this->dbforge->create_table('family');
			
			$this->dbforge->add_field(array(
					'id' => array(
							'type' => 'INT',
							'constraint' => 11,
							'unsigned' => TRUE,
							'auto_increment' => TRUE
					),
					'name' => array(
							'type' => 'VARCHAR',
							'constraint' => 255,
					),
					'surname' => array(
							'type' => 'VARCHAR',
							'constraint' => 255,
					),
					'email' => array(
							'type' => 'VARCHAR',
							'constraint' => 255,
					), 
					'password' => array(
							'type' => 'VARCHAR',
							'constraint' => 255,
					),  
					'type' => array(
							'type' => 'INT',
							'constraint' => 5,
					),  
					'section' => array(
							'type' => 'INT',
							'constraint' => 5,
					),  					                                                                      
			));
			$this->dbforge->add_key('id', TRUE);
			$this->dbforge->create_table('users');                
                
        }

        public function down()
        {
			$this->dbforge->drop_table('users');
			$this->dbforge->drop_table('family');
        }
}

?>
