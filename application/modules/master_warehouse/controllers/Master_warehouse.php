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

class Master_warehouse extends Admin_Controller
{
    //Permission
    protected $viewPermission 	= 'Warehouse.View';
    protected $addPermission  	= 'Warehouse.Add';
    protected $managePermission = 'Warehouse.Manage';
    protected $deletePermission = 'Warehouse.Delete';

    public function __construct()
    {
        parent::__construct();

        $this->load->library(array('Mpdf', 'upload', 'Image_lib'));
        $this->load->model(array('master_warehouse/Master_warehouse_model',
                                 'Aktifitas/aktifitas_model',
                                ));
        $this->template->title('Manage Data Warehouse');
        $this->template->page_icon('fa fa-building-o');

        date_default_timezone_set('Asia/Bangkok');
    }

    public function index()
    {
       	$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');

		$warehouses = $this->db->query("SELECT * FROM warehouse")->result();

		$data = [
			'warehouses' => $warehouses,
		];

		$this->template->set('results', $data);
		$this->template->page_icon('fa fa-users');
        $this->template->title('Master Variasi');
        $this->template->render('index');
    }

	public function formWarehouse()
    {
		$id = $this->input->post('id');
		$data = $this->db->query("SELECT * FROM warehouse WHERE id = $id")->row();

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

	public function saveFormWarehouse()
    {
        $this->auth->restrict($this->addPermission);
		$session = $this->session->userdata('app_session');

		$this->db->trans_begin();

		$id = $this->input->post('idWarehouse');

		if ($id) {
			$data = array(
				'kd_gudang'		=> $this->input->post('kodeGudang'),
				'nm_gudang'		=> $this->input->post('warehouseName'),
				'desc'			=> $this->input->post('deskripsi'),
				'status'		=> $this->input->post('status'),
				'created_date'	=> date('Y-m-d H:i:s'),
				'created_by'	=> $this->auth->user_id(),
			);

			//Update Data
			$this->db->where('id', $id);
			$this->db->update('warehouse', $data);
		} else {
			$data = array(
				'kd_gudang'		=> $this->input->post('kodeGudang'),
				'nm_gudang'		=> $this->input->post('warehouseName'),
				'desc'			=> $this->input->post('deskripsi'),
				'status'		=> $this->input->post('status'),
				'created_date'	=> date('Y-m-d H:i:s'),
				'created_by'	=> $this->auth->user_id(),
			);

			//Add Data
			$this->db->insert('warehouse', $data);
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
	
	public function delete()
	{
		$this->auth->restrict($this->deletePermission);
		$id = $this->input->post('id');
		
		$this->db->trans_begin();
		$this->db->where('id', $id)->delete("warehouse");
		
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
