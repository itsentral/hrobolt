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

class Inventory_1 extends Admin_Controller
{
    //Permission
    protected $viewPermission 	= 'Jenis_Produk_(LVL_1).View';
    protected $addPermission  	= 'Jenis_Produk_(LVL_1).Add';
    protected $managePermission = 'Jenis_Produk_(LVL_1).Manage';
    protected $deletePermission = 'Jenis_Produk_(LVL_1).Delete';

    public function __construct()
    {
        parent::__construct();

        $this->load->library(array('Mpdf', 'upload', 'Image_lib'));
        $this->load->model(array('Inventory_1/Inventory_1_model',
		                         'Crud/Crud_model',
                                 'Aktifitas/aktifitas_model',
                                ));
        $this->template->title('Manage Data Supplier');
        $this->template->page_icon('fa fa-building-o');

        date_default_timezone_set('Asia/Bangkok');
    }

    public function index()
    {
       $this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-users');
		$deleted = '0';
        $data = $this->Inventory_1_model->get_data('ms_inventory_type','deleted',$deleted);
        $this->template->set('results', $data);
        $this->template->title('Kategori Produk');
        $this->template->render('index');
    }

	public function addInventory()
    {
        $this->template->render('add_inventory');
    }

	public function saveNewinventory()
    {
        $this->auth->restrict($this->addPermission);

		$post = $this->input->post();
		// $code = $this->Inventory_1_model->generate_id();
		// $codeSKU = $this->Inventory_1_model->generateSKU();

		$this->db->trans_begin();
		$data = [
			// 'id_type'					=> $code,
			'nama'						=> $post['nm_inventory'],
			'aktif'						=> 'aktif',
			'sku_code' 					=> $post['kode_sku'],
			'code_category_marketplace' => $post['kode_kategory_marketplace'],
			'created_on'				=> date('Y-m-d H:i:s'),
			'created_by'				=> $this->auth->user_id(),
			'deleted'					=> '0'
		];
		
		$insert = $this->db->insert("ms_inventory_type", $data);
		$insert_id = $this->db->insert_id();

		$data2 = [
			'type'				=> "BrandProduk",
			'code'				=> "BP",
			'description'		=> "Brand Produk yang disediakan",
			'value' 			=> 64,
			'id_jenis_produk'	=> $insert_id,
			'range_start'		=> 65,
			'range_end'			=> 90
		];

		$insert = $this->db->insert("app_parameter", $data2);
		
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$status	= array(
			  'pesan'		=>'Gagal Save Item. Thanks ...',
			  'status'	=> 0
			);
		} else {
			$this->db->trans_commit();
			$status	= array(
			  'pesan'		=>'Success Save Item. Thanks ...',
			  'status'	=> 1
			);			
		}
		
  		echo json_encode($status);
    }
	
	public function editInventory($id)
	{
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-edit');
		$inven = $this->db->get_where('ms_inventory_type',array('id' => $id))->result();
		$data = [
			'inven' => $inven
		];
        $this->template->set('results', $data);
		$this->template->title('Inventory');
        $this->template->render('edit_inventory');	
	}

	public function saveEditInventory()
	{
		$this->auth->restrict($this->editPermission);
		$post = $this->input->post();
		$this->db->trans_begin();
		
		$data = [
			'sku_code' 					=> $post['kode_sku'],
			'code_category_marketplace' => $post['kode_kategory_marketplace'],
			'nama'		        		=> $post['nm_inventory'],
			'aktif'						=> $post['status'],
			'modified_on'				=> date('Y-m-d H:i:s'),
			'modified_by'				=> $this->auth->user_id()
		];
	 
		$this->db->where('id',$post['id_inventory'])->update("ms_inventory_type",$data);
		
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$status	= array(
			  'pesan'		=>'Gagal Save Item. Thanks ...',
			  'status'	=> 0
			);
		} else {
			$this->db->trans_commit();
			$status	= array(
			  'pesan'		=>'Success Save Item. Thanks ...',
			  'status'	=> 1
			);			
		}
		
  		echo json_encode($status);
	}

	public function viewInventory()
	{
		$this->auth->restrict($this->viewPermission);
		$id 	= $this->input->post('id');
		$cust 	= $this->Inventory_1_model->getById($id);
        $this->template->set('result', $cust);
		$this->template->render('view_inventory');
	}

	public function deleteInventory()
	{
		$this->auth->restrict($this->deletePermission);
		$id = $this->input->post('id');
		$codeSKU = $this->Inventory_1_model->regenerateSKU();

		$data = [
			'deleted' 		=> '1',
			'deleted_by' 	=> $this->auth->user_id(),
		];
		
		$this->db->trans_begin();
		$this->db->where('id',$id)->update("ms_inventory_type",$data);
		
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$status	= array(
			  'pesan'		=>'Gagal Save Item. Thanks ...',
			  'status'	=> 0
			);
		} else {
			$this->db->trans_commit();
			$status	= array(
			  'pesan'		=>'Success Save Item. Thanks ...',
			  'status'	=> 1
			);			
		}
		
  		echo json_encode($status);
	}
}
