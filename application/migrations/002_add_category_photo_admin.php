<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_add_category_photo_admin extends CI_Migration {

	public function up()
	{
		// CATEGORY TABLE
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'auto_increment' => TRUE
			),
			'category_name' => array(
				'type' => 'VARCHAR',
				'constraint' => '100'
			),
			'color' => array(
				'type' => 'VARCHAR',
				'constraint' => '7'
			),

		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('category');

//		ADMIN TABLE
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'auto_increment' => TRUE
			),
			'username' => array(
				'type' => 'VARCHAR',
				'constraint' => '200'
			),
			'password' => array(
				'type' => 'VARCHAR',
				'constraint' => '300'

			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('user');

		//	MODIFY AREA TABLE
		$fields = array(
			'area_id' => array(
				'name' => 'id',
				'type' => 'INT'
			),
		);
		$this->dbforge->modify_column('area', $fields);
		$this->dbforge->drop_column('area', 'area_code');
		$area_new_fields = array(
			'area_description' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
			),
			'id_category' => array(
				'type' => 'INT',
				'constraint' => 3,
				'null' => TRUE,
			),
		);
		$this->dbforge->add_column('area', $area_new_fields);
		$this->dbforge->add_column('area',[
			'CONSTRAINT fk_id FOREIGN KEY(id) REFERENCES category(id)',
		]);

		// PHOTO TABLE
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'auto_increment' => TRUE
			),
			'area_id' => array(
				'type' => 'INT',
			),
			'photo' => array(
				'type' => 'LONGBLOB',
			)
		));
		$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (id) REFERENCES area(id)');
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('photo');
	}

	public function down()
	{
		$this->dbforge->drop_table('area');
		$this->dbforge->drop_table('user');
		$this->dbforge->drop_table('category');
		$this->dbforge->drop_table('photo');
	}
}
