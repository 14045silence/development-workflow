<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Migration_First_migrate extends CI_Migration
{
	
	function up()
	{
		//user
		$this->dbforge->add_field(array(
			'id_user' => array(
				'type' => 'VARCHAR',
				'constraint' => '15',							
				),
			'id_school' => array(
				'type' => 'VARCHAR',
				'constraint' => '200',
				),
			'email' => array(
				'type' => 'VARCHAR',
				'constraint' => '200',
				),
			'role' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => FALSE,
				),
			'nama' => array(
				'type' => 'VARCHAR',
				'constraint' => '200',
				'null' => FALSE,
				),
			'dob' => array(
				'type' => 'VARCHAR',
				'constraint' => '200',
				'null' => FALSE,
				),
			'password' => array(
				'type' => 'VARCHAR',
				'constraint' => '200',
				'null' => FALSE,
				),
			'gender' => array(
				'type' => 'VARCHAR',
				'constraint' => '25',

				),
			'profile' => array(
				'type' => 'TEXT',				
				'null' => TRUE,
				),
			'last_login' => array(
				'type' => 'TIMESTAMP',				
				),
			'token_reg' => array(
				'type' => 'VARCHAR',
				'constraint' => '200',
				'null' => FALSE,
				),
			'token_forgot_pass' => array(
				'type' => 'VARCHAR',
				'constraint' => '200',
				'null' => FALSE,
				),
			'level' => array(
				'type' => 'VARCHAR',
				'constraint' => '15',

				),
			'address' => array(
				'type' => 'TEXT',				
				'null' => TRUE,
				),
			'facebook_url' => array(
				'type' => 'VARCHAR',
				'constraint' => '200',
				'null' => TRUE,
				),
			'pict_name' => array(
				'type' => 'VARCHAR',
				'constraint' => '200',
				'null' => TRUE,
				),
			'is_subscribe' => array(
				'type' => 'INT',
				'constraint' => 1,
				'default' => '1',
				),
			'is_valid' => array(
				'type' => 'INT',
				'constraint' => 1,
				'default' => '0',
				),
			));
		$this->dbforge->add_key('id_user', TRUE);
		$this->dbforge->create_table('user');


		
		$this->dbforge->add_field(array(
			'id_school' => array(
				'type' => 'VARCHAR',
				'constraint' => '15',							
				),
			'school_name' => array(
				'type' => 'VARCHAR',
				'constraint' => '200',
				),
			'address' => array(
				'type' => 'VARCHAR',
				'constraint' => '200',
				),
			'contact_person' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
				'null' => FALSE,
				),
			'email' => array(
				'type' => 'VARCHAR',
				'constraint' => '200',
				'null' => FALSE,
				),			
			'password' => array(
				'type' => 'VARCHAR',
				'constraint' => '200',
				'null' => FALSE,
				),			
			'update_at' => array(
				'type' => 'TIMESTAMP',				
				),
			'last_login' => array(
				'type' => 'TIMESTAMP',				
				),
			'headmaster' => array(
				'type' => 'VARCHAR',
				'constraint' => '200',
				'null' => FALSE,
				),
			'pic' => array(
				'type' => 'VARCHAR',
				'constraint' => '200',
				'default' => 'sch.jpg',
				),
			'reg_number_ministry' => array(
				'type' => 'VARCHAR',
				'constraint' => '200',
				'null' => FALSE,
				),
			'token_reg' => array(
				'type' => 'VARCHAR',
				'constraint' => '200',

				),
			'token_forgot_pass' => array(
				'type' => 'VARCHAR',
				'constraint' => '200',

				),			
			'is_subscribe' => array(
				'type' => 'INT',
				'constraint' => 1,
				'default' => '1',
				),
			'is_valid' => array(
				'type' => 'INT',
				'constraint' => 1,
				'default' => '1',
				),
			));
		$this->dbforge->add_key('id_school', TRUE);
		$this->dbforge->create_table('school');

		// TAG
		$this->dbforge->add_field(array(
			'id_tag' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',							
				),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => '200',
				),
			'slug' => array(
				'type' => 'VARCHAR',
				'constraint' => '200',
				),		
			'update_at' => array(
				'type' => 'TIMESTAMP',				
				),
			));
		$this->dbforge->add_key('id_tag', TRUE);
		$this->dbforge->create_table('tag');

		// COURSE TAG
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => '100',							
				 'auto_increment' => TRUE
				),
			'id_tag' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',							
				),
			'id_course' => array(
				'type' => 'VARCHAR',
				'constraint' => '200',
				),
			));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('course_tag');

		// COURSE
		$this->dbforge->add_field(array(
			'id_course' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',											 
				),
			'title' => array(
				'type' => 'VARCHAR',
				'constraint' => '200',							
				),
			'summary' => array(
				'type' => 'VARCHAR',
				'constraint' => '200',
				),
			'last_update' => array(
				'type' => 'TIMESTAMP',				
				),
			'duration' => array(
				'type' => 'INT',
				'constraint' => 10,
				),
			));
		$this->dbforge->add_key('id_course', TRUE);
		$this->dbforge->create_table('course');

		// COURSE TRANSAKSI
		$this->dbforge->add_field(array(
			'id_course_enrollment' => array(
				'type' => 'INT',				
				'auto_increment' => TRUE											 
				),
			'id_course' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',											 
				),
			'id_user' => array(
				'type' => 'VARCHAR',
				'constraint' => '15',
				),
			'date_enrollment' => array(
				'type' => 'TIMESTAMP',				
				),			
			));
		$this->dbforge->add_key('id_course_enrollment', TRUE);
		$this->dbforge->create_table('course_tr');

		// COURSE GALLERY
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',				
				'auto_increment' => TRUE											 
				),
			'id_course' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',											 
				),
			'meta' => array(
				'type' => 'VARCHAR',
				'constraint' => '1000',
				),			
			));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('course_gallery');

		// SILABUS
		$this->dbforge->add_field(array(
			'id_silabus' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',											 
				),
			'id_course' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',											 
				),
			'title_silabus' => array(
				'type' => 'VARCHAR',
				'constraint' => '1000',
				),
			'no_urut' => array(
				'type' => 'INT',				
				),			
			'last_update' => array(
				'type' => 'TIMESTAMP',				
				),			
			));
		$this->dbforge->add_key('id_silabus', TRUE);
		$this->dbforge->create_table('silabus');

		// MATERIAL
		$this->dbforge->add_field(array(
			'id_course_material' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',											 
				),
			'id_silabus' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',											 
				),
			
			'title_material' => array(
				'type' => 'VARCHAR',
				'constraint' => '1000',
				),
			'meta' => array(
				'type' => 'VARCHAR',
				'constraint' => '1000',
				),			
			));
		$this->dbforge->add_key('id_course_material', TRUE);
		$this->dbforge->create_table('course_material');

		// PLACE INFORMATION
		$this->dbforge->add_field(array(
			'id_course_material' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',											 
				),
			'id_silabus' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',											 
				),
			
			'title_material' => array(
				'type' => 'VARCHAR',
				'constraint' => '1000',
				),
			'meta' => array(
				'type' => 'VARCHAR',
				'constraint' => '1000',
				),			
			));
		$this->dbforge->add_key('id_course_material', TRUE);
		$this->dbforge->create_table('course_material');

	}
	function down()
	{
		//$this->dbforge->drop_table('blog');
	}
}