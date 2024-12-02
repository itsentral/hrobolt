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

class Master_pengiriman extends Admin_Controller
{
    //Permission
    protected $viewPermission 	= 'Jasa_Pengiriman.View';
    protected $addPermission  	= 'Jasa_Pengiriman.Add';
    protected $managePermission = 'Jasa_Pengiriman.Manage';
    protected $deletePermission = 'Jasa_Pengiriman.Delete';

    public function __construct()
    {
        parent::__construct();

        $this->load->library(array('Mpdf', 'upload', 'Image_lib'));
        $this->load->model(array('master_variasi/Master_variasi_model',
                                 'Aktifitas/aktifitas_model',
                                ));
        $this->template->title('Manage Data Variasi');
        $this->template->page_icon('fa fa-building-o');

        date_default_timezone_set('Asia/Bangkok');
    }

    public function index()
    {
       	$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');

		$masterPengiriman = $this->db->query("SELECT * FROM master_pengiriman")->result();
		
		$data = [
			'masterPengiriman' => $masterPengiriman,
		];

		// return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));

		$this->template->set('results', $data);
		$this->template->page_icon('fa fa-box');
        $this->template->title('Master Pengiriman');
        $this->template->render('index');
    }

	public function formPengiriman()
    {
		$id = $this->input->post('id');
		$data = $this->db->query("SELECT * FROM master_pengiriman WHERE id = $id")->row();

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

	public function saveFormPengiriman()
    {
        $this->auth->restrict($this->addPermission);
		$session = $this->session->userdata('app_session');

		$this->db->trans_begin();

		$id = $this->input->post('id');

		if ($id) {
			$data = array(
				'name'		    	=> $this->input->post('name'),
				'status'			=> $this->input->post('status'),
				'code_tokopedia'	=> $this->input->post('code_tokopedia'),
				'updated_at'		=> date('Y-m-d H:i:s'),
				'updated_by'		=> $this->auth->user_id(),
			);

			//Update Data
			$this->db->where('id', $id);
			$this->db->update('master_pengiriman', $data);
		} else {
			$data = array(
				'name'		    	=> $this->input->post('name'),
				'status'			=> $this->input->post('status'),
				'code_tokopedia'	=> $this->input->post('code_tokopedia'),
				'created_at'		=> date('Y-m-d H:i:s'),
				'created_by'		=> $this->auth->user_id(),
			);

			//Add Data
			$this->db->insert('master_pengiriman', $data);
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
		$this->db->where('id', $id)->delete("master_pengiriman");
		
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
