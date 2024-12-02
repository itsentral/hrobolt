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

class Master_variasi extends Admin_Controller
{
    //Permission
    protected $viewPermission 	= 'Variasi.View';
    protected $addPermission  	= 'Variasi.Add';
    protected $managePermission = 'Variasi.Manage';
    protected $deletePermission = 'Variasi.Delete';

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

		$variasi = $this->db->query("SELECT * FROM master_variasi WHERE status = '1' AND parent_id IS NULL")->result();
		$varian = $this->db->query("SELECT a.name AS nama_variasi, b.name AS nama_varian, b.id AS id FROM master_variasi a, master_variasi b
									 	WHERE a.id = b.parent_id AND b.status = 1 AND b.parent_id IS NOT NULL")->result();

		$data = [
			'variasi' => $variasi,
			'varian' => $varian
		];

		// return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));

		$this->template->set('results', $data);
		$this->template->page_icon('fa fa-users');
        $this->template->title('Master Variasi');
        $this->template->render('index');
    }

	public function formVariasi()
    {
		$id = $this->input->post('id');
		$data = $this->db->query("SELECT * FROM master_variasi WHERE id = $id")->row();

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

	public function saveFormVariasi()
    {
        $this->auth->restrict($this->addPermission);
		$session = $this->session->userdata('app_session');

		$this->db->trans_begin();

		$id = $this->input->post('id');

		if ($id) {
			$data = array(
				'name'		    => $this->input->post('name'),
				'status'		=> 1,
				'updated_at'	=> date('Y-m-d H:i:s'),
				'updated_by'	=> $this->auth->user_id(),
			);

			//Update Data
			$this->db->where('id', $id);
			$this->db->update('master_variasi', $data);
		} else {
			$data = array(
				'name'		    => $this->input->post('name'),
				'status'		=> 1,
				'created_at'	=> date('Y-m-d H:i:s'),
				'created_by'	=> $this->auth->user_id(),
			);

			//Add Data
			$this->db->insert('master_variasi', $data);
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

	public function formVarian()
    {
		$id = $this->input->post('id');
		$variasi = $this->db->query("SELECT * FROM master_variasi WHERE status = 1 AND parent_id IS NULL")->result();

		if ($variasi) {
			if (isset($id)) {
				$varian = $this->db->query("SELECT * FROM master_variasi WHERE id = $id")->row();

				$data = [
					'status' => 'OK',
					'code' => 200,
					'variasi' => $variasi,
					'varian' => $varian
				];
			} else {
				$data = [
					'status' => 'OK',
					'code' => 200,
					'variasi' => $variasi
				];
			}
		} else {
			$data = [
				'status' => 'NOT OK',
				'code' => 404,
				// 'varian' => $varian
			];
		}

		return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));
    }

	public function saveFormVarian()
    {
        $this->auth->restrict($this->addPermission);
		$session = $this->session->userdata('app_session');

		$id = $this->input->post('id');

		$this->db->trans_begin();

		if ($id) {
			$data = array(
				'name'		    => $this->input->post('name'),
				'status'		=> 1,
				'parent_id' 	=> $this->input->post('variasi_id'),
				'updated_at'	=> date('Y-m-d H:i:s'),
				'updated_by'	=> $this->auth->user_id(),
			);

			//Update Data
			$this->db->where('id', $id);
			$this->db->update('master_variasi', $data);
		} else {
			$data = array(
				'name'		    => $this->input->post('name'),
				'status'		=> '1',
				'parent_id' 	=> $this->input->post('variasi_id'),
				'created_at'	=> date('Y-m-d H:i:s'),
				'created_by'	=> $this->auth->user_id(),
			);
	
			//Add Data
			$this->db->insert('master_variasi', $data);
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
			  'pesan'	=>'Success Save Item. invenThanks ...',
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
		$this->db->where('id', $id)->delete("master_variasi");
		
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
