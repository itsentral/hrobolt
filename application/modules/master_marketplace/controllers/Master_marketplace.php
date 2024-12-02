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

class Master_marketplace extends Admin_Controller
{
    //Permission
    protected $viewPermission 	= 'Master_Marketplace.View';
    protected $addPermission  	= 'Master_Marketplace.Add';
    protected $managePermission = 'Master_Marketplace.Manage';
    protected $deletePermission = 'Master_Marketplace.Delete';

    public function __construct()
    {
        parent::__construct();

        $this->load->library(array('Mpdf', 'upload', 'Image_lib'));
        $this->load->model(array('master_marketplace/Master_marketplace_model',
                                 'Aktifitas/aktifitas_model',
                                ));
        $this->template->title('Manage Data Marketplace');
        $this->template->page_icon('fa fa-store');

        date_default_timezone_set('Asia/Bangkok');
    }

    public function index()
    {
       	$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');

		$masterMarketplace = $this->db->query("SELECT * FROM master_marketplace")->result();
		
		$data = [
			'masterMarketplace' => $masterMarketplace,
		];

		$this->template->set('results', $data);
		$this->template->page_icon('fa fa-store');
        $this->template->title('Master Marketplace');
        $this->template->render('index');
    }

	public function formMarketplace()
    {
		$id = $this->input->post('id');
		$data = $this->db->query("SELECT * FROM master_marketplace WHERE id = $id")->row();

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

	public function saveFormMarketplace()
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
			$this->db->update('master_marketplace', $data);
		} else {
			$data = array(
				'name'		    	=> $this->input->post('name'),
				'status'			=> $this->input->post('status'),
				'created_at'		=> date('Y-m-d H:i:s'),
				'created_by'		=> $this->auth->user_id(),
			);

			//Add Data
			$this->db->insert('master_marketplace', $data);
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
		$this->db->where('id', $id)->delete("master_marketplace");
		
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
