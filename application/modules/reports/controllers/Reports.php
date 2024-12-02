<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends Admin_Controller {
/*
 * @author Syamsudin
 * @copyright Copyright (c) 2022, Syamsudin
 * 
 * This is controller for Reports
 */

		//Permission
		protected $viewPermission 	= 'Management.View';
		protected $addPermission  	= 'Management.Add';
		protected $managePermission = 'Management.Manage';
		protected $deletePermission = 'Management.Delete';
		
	public function __construct()
	{
		parent::__construct();

        $this->load->model('reports/Reports_model');
              
        $this->template->page_icon('fa fa-dashboard');
	}

	public function index()
	{
		$this->template->title('Reports');
		$sum_penawaran = $this->report_model->penawaran();
		$sum_salesorder = $this->report_model->salesorder();
		       
        $this->template->set('penawaran', $sum_penawaran);
        $this->template->set('salesorder', $sum_salesorder);
       
		$this->template->render('index');
		
	}
	
	public function penawaran()
	{
		
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-users');
        $data = $this->Reports_model->CariPenawaran();
        $this->template->set('results', $data);
		$this->template->title('Report Penawaran');
		$this->template->render('report_penawaran');
		
	}

	public function penawaran_so()
	{
		
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-users');
        $data = $this->Reports_model->CariPenawaranSo();
        $this->template->set('results', $data);
		$this->template->title('Report Penawaran Deal');
		$this->template->render('report_penawaran_so');
		
	}
	
	public function penawaran_dikirim()
	{
		
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-users');
        $data = $this->Reports_model->CariPenawaranDikirim();
        $this->template->set('results', $data);
		$this->template->title('Report Penawaran On Progress');
		$this->template->render('report_penawaran_dikirim');
		
	}
	
	public function penawaran_loss()
	{
		
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-users');
        $data = $this->Reports_model->CariPenawaranLoss();
        $this->template->set('results', $data);
		$this->template->title('Report Penawaran On Progress');
		$this->template->render('report_penawaran_loss');
		
	}

	public function salesorder()	{
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-users');
        $data = $this->Reports_model->cariSalesOrder();
        $this->template->set('results', $data);
        $this->template->title('Report Sales Order');
		$this->template->render('report_salesorder');
	}
	
	public function tampilkan_salesorder()	{
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-users');
        $data = $this->Reports_model->cariSalesOrderTgl($this->input->post("tanggal"));
        $this->template->set('results', $data);
        $this->template->title('Report Sales Order');
		$this->template->render('report_salesorder');
	}

	public function invoice()	{
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-users');
        $data = $this->Reports_model->CariInvoice();
        $this->template->set('results', $data);
        $this->template->title('Report Invoicing');
		$this->template->render('report_invoice');
	}
	
	public function tampilkan_invoice()	{
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-users');
        $data = $this->Reports_model->CariInvoiceTgl($this->input->post("tanggal"));
        $this->template->set('results', $data);
        $this->template->title('Report Invoicing');
		$this->template->render('report_invoice');
	}
	
	public function penerimaan()	{
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-users');
        $data = $this->Reports_model->CariPayment();
        $this->template->set('results', $data);
        $this->template->title('Report Penerimaan');
		$this->template->render('report_payment');
	}
	
	public function tampilkan_penerimaan()	{
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-users');
        $data = $this->Reports_model->CariPaymentTgl($this->input->post("tanggal"));
        $this->template->set('results', $data);
        $this->template->title('Report Penerimaan');
		$this->template->render('report_payment');
	}
	
		public function tampilkan_jurnal_invoice()	{
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-users');
        $data = $this->Reports_model->CariJurnalInvoiceTgl($this->input->post("tanggal"));
        $this->template->set('results', $data);
        $this->template->title('Report Jurnal Invoicing');
		$this->template->render('report_jurnal_invoice');
	}
	
	public function unlocated()	{
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-users');
        $data = $this->Reports_model->CariDeposit();
        $this->template->set('results', $data);
        $this->template->title('Report Deposit');
		$this->template->render('report_deposit');
	}
	
		public function revenue()	{
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-users');
        $data = $this->Reports_model->CariRevenue();
        $this->template->set('results', $data);
        $this->template->title('Report Revenue');
		$this->template->render('report_revenue');
	}
	public function tampilkan_revenue()	{
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-users');
        $data = $this->Reports_model->CariRevenueTgl($this->input->post("tanggal"));
        $this->template->set('results', $data);
        $this->template->title('Report Revenue');
		$this->template->render('report_revenue');
	}
	
		public function detailrevenue()	{
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-users');
        $data = $this->Reports_model->CariRevenuedetail();
        $this->template->set('results', $data);
        $this->template->title('Report Revenue');
		$this->template->render('report_revenue_detail');
	}
	public function detailrevenueso()	{
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-users');
        $data = $this->Reports_model->CariRevenuedetailDoSO();
        $this->template->set('results', $data);
        $this->template->title('Report Penjualan dan Pengiriman');
		$this->template->render('report_do_so');
	}
	public function tampilkan_do_so()	{
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-users');
        $data = $this->Reports_model->CariRevenuedetailDoSOTgl($this->input->post("tanggal"));
        $this->template->set('results', $data);
        $this->template->title('Report Penjualan dan Pengiriman');
		$this->template->render('report_do_so');
	}
	
	public function update_begining()	{
		$begining = $this->db->query("SELECT * FROM begining_stok_juni")->result();
		$no = 0;
		foreach ($begining as $dt){
		$id_category3 = $dt->id_category3;
		$qty		  = $dt->qty;
		$idstok		  = $dt->id;
		$costbook	  = $dt->harga_satuan;
		$no++;
		
		$update = $this->db->query("UPDATE ms_costbook SET nilai_costbook=$costbook WHERE id_category3='$id_category3'");	
		
		print_r($no);
		print_r($id_category3);
		print_r($idstok);
		echo"<br>";
		
			
		}
		
	}
	public function tampilkan_stock()	{
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-users');
        $data = $this->Reports_model->stock_value();
        $this->template->set('results', $data);
        $this->template->title('Report Value Inventory ');
		$this->template->render('report_stock');
	}
	
	
}
