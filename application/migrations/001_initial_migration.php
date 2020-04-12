<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_initial_migration extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'area_id' => array(
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'area_name' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
			),
			'area_code' => array(
				'type' => 'INT',
				'constraint' => 3,
				'null' => TRUE,
			),
			'geojson_data' => array(
				'type' => 'LONGTEXT',
				'null'=> FALSE,
			)
		));
		$this->dbforge->add_key('area_id', TRUE);
		$this->dbforge->create_table('area');
	}

	public function down()
	{
		$this->dbforge->drop_table('area');
	}
}
