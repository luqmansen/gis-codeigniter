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
		try {
			$data = array(
				'category_name' => 'Pemukiman',
				'color' => '#d8f70a',
			);
			$this->category->insert_data($data,'category');
			$data = array(
				'category_name' => 'Persawahan',
				'color' => '#00ff26',
			);
			$this->category->insert_data($data,'category');

			echo "Seed success";
		} catch (Exception $e) {

			echo 'Seed Failed: ',  $e->getMessage(), "\n";
		}

	}
}
