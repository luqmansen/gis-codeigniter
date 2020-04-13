<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Alter_photo extends CI_Migration
{

	public function up()
	{
		$fields = array(
			'photo' => array(
				'name' => 'photo_data',
				'type' => 'LONGTEXT'
			),
		);
		$this->dbforge->modify_column('photo', $fields);
	}
	public function down(){
		$this->dbforge->drop_table('photo');
	}
}

