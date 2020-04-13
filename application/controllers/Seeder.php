<?php


class Seeder extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('category');
	}

	function index()
	{

		$data = array(
			array(
				'category_name' => 'Pemukiman',
				'color' => '#d8f70a',
			),
			array(
				'category_name' => 'Persawahan',
				'color' => '#00ff26',
			)
		);

		if (! $this->db->insert_batch('category', $data)){
			if (getenv("ENV") != 'production'){
				echo json_encode($this->db->error());
			} else {
				echo "Seed Failed";
			}
		} else {

			echo "Seed success";
		}


	}
}
