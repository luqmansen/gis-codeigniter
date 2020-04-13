<?php

require(APPPATH.'models/BaseModel.php');
class Area extends BaseModel
{
	public function get_area(){
		$q = $this->db->get('area');
		return $q->result();
	}
}
