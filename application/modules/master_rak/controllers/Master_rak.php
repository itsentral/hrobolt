<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/*
 * @author Ichsan
 * @copyright Copyright (c) 2019, Ichsan
 *
 * This is controller for Master Supplier
 */

class Master_rak extends Admin_Controller
{
    //Permission
    protected $viewPermission 	= 'Data_rak.View';
    protected $addPermission  	= 'Data_rak.Add';
    protected $managePermission = 'Data_rak.Manage';
    protected $deletePermission = 'Data_rak.Delete';

    public function __construct()
    {
        parent::__construct();

        $this->load->library(array('Mpdf', 'upload', 'Image_lib'));
        $this->load->model(array('master_rak/Master_rak_model',
                                 'Aktifitas/aktifitas_model',
                                ));
        $this->template->title('Manage Data Rak');
        $this->template->page_icon('fa fa-building-o');

        date_default_timezone_set('Asia/Bangkok');
    }

    public function index()
    {
       	$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');

		$masterRak = $this->db->query("SELECT * FROM master_rak")->result();
		
		$data = [
			'masterRak' => $masterRak,
		];

		// return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));

		$this->template->set('results', $data);
		$this->template->page_icon('fa fa-box');
        $this->template->title('Master Rak');
        $this->template->render('index');
    }

	public function formRak()
    {
		$id = $this->input->post('id');
		$data = $this->db->query("SELECT * FROM master_rak WHERE id = $id")->row();

		if ($data) {
			$data = [
				'status' => 'OK',
				'code' => 200,
				'data' => $data
			];
		} else {
			$data = [
				'status' => 'NOT OK',
				'code' => 404,
			];
		}

		return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));
    }

	public function saveFormRak()
    {
        $this->auth->restrict($this->addPermission);
		$session = $this->session->userdata('app_session');

		$this->db->trans_begin();

		$id = $this->input->post('id');

		if ($id) {
			$data = array(
				'name'		    	=> $this->input->post('name'),
				'status'			=> $this->input->post('status'),
				'updated_at'		=> date('Y-m-d H:i:s'),
				'updated_by'		=> $this->auth->user_id(),
			);

			//Update Data
			$this->db->where('id', $id);
			$this->db->update('master_rak', $data);
		} else {
			$data = array(
				'name'		    	=> $this->input->post('name'),
				'status'			=> $this->input->post('status'),
				'created_at'		=> date('Y-m-d H:i:s'),
				'created_by'		=> $this->auth->user_id(),
			);

			//Add Data
			$this->db->insert('master_rak', $data);
		}
		
		if($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$status	= array(
			  'pesan'	=>'Gagal Save Item. Thanks ...',
			  'status'	=> 0
			);
		} else {
			$this->db->trans_commit();
			$status	= array(
			  'pesan'	=>'Success Save Item. Thanks ...',
			  'status'	=> 1
			);			
		}
		
		return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($status));
    }

	public function saveExcelRak()
	{
		include APPPATH . 'libraries/PHPExcel.php';

		if (isset($_FILES['excel_rak']['name'])) {
			// $date = date("Y-m-d h:i:s");
			// $filename = 'data' . $date . '.xlsx';

			// // print_r($filename);

			// if (is_file(base_url('assets/files/tmp/') . $filename)) {
			// 	unlink(base_url('assets/files/tmp/') . $filename);
			// }

			$ext = pathinfo($_FILES['excel_rak']['name'], PATHINFO_EXTENSION);
			
			$tmpfile = $_FILES['excel_rak']['tmp_name'];

			if ($ext == 'xlsx') {
				$object = PHPExcel_IOFactory::load($tmpfile);
            
                foreach($object->getWorksheetIterator() as $worksheet){
					$highestRow = $worksheet->getHighestRow();
                        // $highestColumn = $worksheet->getHighestColumn();
					for($row=2; $row<=$highestRow; $row++){
		
						$no_rak = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
						// $code = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
						print_r($no_rak);

						$data[] = [
							'name' => $no_rak,
							'status' => 'Aktif',
							'created_at' => date('Y-m-d H:i:s'),
							'created_by' => $this->auth->user_id()
						];
					}
				}

				$this->db->insert_batch('master_rak', $data);

				return redirect('master_rak');
			}
		}
	}
	
	public function delete()
	{
		$this->auth->restrict($this->deletePermission);
		$id = $this->input->post('id');
		
		$this->db->trans_begin();
		$this->db->where('id', $id)->delete("master_rak");
		
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$status	= array(
			  'pesan'	=> 'Gagal Save Item. Thanks ...',
			  'status'	=> 0
			);
		} else {
			$this->db->trans_commit();
			$status	= array(
			  'pesan'	=> 'Success Save Item. Thanks ...',
			  'status'	=> 1
			);			
		}
		
		return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($status));
	}
}
