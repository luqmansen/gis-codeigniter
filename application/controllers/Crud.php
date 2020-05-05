<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Crud extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('area');
		$this->load->model('photo');
		$this->load->model('category');
		$this->load->helper('url');
		$this->load->library('upload');

	}

	function index()
	{
		$model = array('area', 'photo', 'category');
		$data = array();
		foreach ($model as $m) {
			$data[$m] = $this->$m->get_all();
		}
		foreach ($data["photo"] as $i) {
			$area = $this->area->get_row_by_id($i->area_id);
			$i->area_id = $area->area_name;
		}

		foreach ($data["area"] as $i) {
			$area = $this->category->get_row_by_id($i->id_category);
			$i->id_category = $area->category_name;
		}

		$this->load->view('management/v_show_data', $data);
	}

	function export_category()
	{
		$spreadsheet = new Spreadsheet();
		// EXPORT CATEGORY ON SHEET 0
		$sheet = $spreadsheet->setActiveSheetIndex(0);
		$sheet->setCellValue('A1', 'id'); 
        $sheet->setCellValue('B1', 'category_name');
		$sheet->setCellValue('C1', 'color');

		$category = $this->category->get_all();
		$i = 2; foreach ($category as $cat){
			$sheet->setCellValue('A'.$i, $cat->id);
			$sheet->setCellValue('B'.$i, $cat->category_name);
			$sheet->setCellValue('C'.$i, $cat->color);
		}

		// EXPORT AREA ON SHEET 1
		$spreadsheet->createSheet();
		$sheet = $spreadsheet->setActiveSheetIndex(1);
		$sheet->setCellValue('A1', 'id'); 
        $sheet->setCellValue('B1', 'name');
		$sheet->setCellValue('C1', 'description');
		$sheet->setCellValue('D1', 'data');

		$area = $this->area->get_all();
		$i = 2; foreach ($area as $a){
			$sheet->setCellValue('A'.$i, $a->id);
			$sheet->setCellValue('B'.$i, $a->area_name);
			$sheet->setCellValue('C'.$i, $a->area_description);
			$sheet->setCellValue('D'.$i, $a->geojson_data);
		}


		// EXPORT PHOTO ON SHEET 1
		$spreadsheet->createSheet();
		$sheet = $spreadsheet->setActiveSheetIndex(2);
		$sheet->setCellValue('A1', 'id'); 
        $sheet->setCellValue('B1', 'area_id');
		$sheet->setCellValue('C1', 'photo');

		$photo = $this->photo->get_all();
		$i = 2; foreach ($photo as $a){
			$sheet->setCellValue('A'.$i, $a->id);
			$sheet->setCellValue('B'.$i, $a->area_id);
			$sheet->setCellValue('C'.$i, $a->photo_data);
		}
		
		$filename = 'exported_data'; // set filename for excel file to be exported
 
        header('Content-Type: application/vnd.ms-excel'); // generate excel file
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
		$writer = new Xlsx($spreadsheet);
        $writer->save('php://output');

	}

	function new_geo()
	{
		$category = $this->category->get_all();
		$data = array('category' => $category);
		$this->load->view('management/v_upload_geo', $data);
	}
	function new_photo()
	{
		$area = $this->area->get_all();
		$data = array('area' => $area);
		$this->load->view('management/v_upload_photo', $data);
	}

	function add_geo(){

		$location = $_FILES['geojson_data']['tmp_name'];
		$geojson_data  = file_get_contents($location);

		$data = array(
			'area_name' => $this->input->post('area_name'),
			'area_description' => $this->input->post('area_name'),
			'id_category' => $this->input->post('id_category'),
			'geojson_data' => $geojson_data
		);

		$this->area->insert_data($data,'area');
		redirect('/home');

	}

	function add_photo(){
		$location = $_FILES['photo_data']['tmp_name'];
		$photo_data  = file_get_contents($location);

		$encoded = base64_encode($photo_data);

		$data = array(
			'area_id'  => $this->input->post('area_id'),
			'photo_data' => $encoded,
		);

		$this->photo->insert_data($data,'photo');
		redirect('/home');

	}
}
