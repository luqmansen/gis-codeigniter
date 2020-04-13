<?php


class Migrate extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('migration');
	}

	public function index(){

		if (!$this->migration->current())
		{
			echo 'Error' .$this->migration->error_string();
		} else{
			echo "Migration success";
		}

	}
}
