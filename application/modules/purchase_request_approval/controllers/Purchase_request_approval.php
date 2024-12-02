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

class Purchase_request_approval extends Admin_Controller
{
    //Permission
    protected $viewPermission 	= 'Purchase_Request_Approval.View';
    protected $addPermission  	= 'Purchase_Request_Approval.Add';
    protected $managePermission = 'Purchase_Request_Approval.Manage';
    protected $deletePermission = 'Purchase_Request_Approval.Delete';

    public function __construct()
    {
        parent::__construct(); 
        $this->load->library(array('Mpdf', 'upload', 'Image_lib'));
        $this->load->model(array('Purchase_request/Pr_model',
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
        $data = $this->db->query("SELECT tpr.*, mse.nm_karyawan, msd.nama AS nama_department, u.nm_lengkap
									FROM tr_purchase_request tpr 
									JOIN ms_employee mse ON mse.id = tpr.requestor 
									JOIN ms_department msd ON msd.id = tpr.departement_requestor
									LEFT JOIN users u ON u.id_user = tpr.approved_by
									ORDER BY created_on DESC")->result();
        $this->template->set('results', $data);
        $this->template->title('Purchase Request Approval');
        $this->template->render('index');
    }
	
	public function PrintHeader1($id)
	{
        $this->auth->restrict($this->managePermission);
        $id = $this->uri->segment(3);
		$data['header'] = $this->Pr_model->getHeaderPenawaran($id);
		$data['detail']  = $this->Pr_model->PrintDetail($id);
		$this->load->view('PrintHeader',$data);
	}

	public function PrintHeader($id)
	{
		ob_clean();
		ob_start();
        $this->auth->restrict($this->managePermission);
        $id = $this->uri->segment(3);
		$data['header'] = $this->Pr_model->getHeaderPenawaran($id);
		$data['detail']  = $this->Pr_model->PrintDetail($id);
		$this->load->view('PrintHeader',$data);
		$html = ob_get_contents();

		require_once('./assets/html2pdf/html2pdf/html2pdf.class.php');
		$html2pdf = new HTML2PDF('P','A4','en',true,'UTF-8',array(0, 0, 0, 0));
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($html);
		ob_end_clean();
		$html2pdf->Output('Penawaran.pdf', 'I');
	}
		
	public function EditHeader($id)
    {
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-pencil');
		$aktif = 'active';
		$deleted = '0';
		$head = $this->Pr_model->get_data('tr_penawaran','no_penawaran',$id);
		$customers = $this->Pr_model->get_data('master_customers','deleted',$deleted);
		$karyawan = $this->Pr_model->get_data('ms_karyawan','deleted',$deleted);
		$mata_uang = $this->Pr_model->get_data('mata_uang','deleted',$deleted);
		$data = [
			'customers' => $customers,
			'karyawan' => $karyawan,
			'head' => $head,
			'mata_uang' => $mata_uang,
		];
        $this->template->set('results', $data);
        $this->template->title('Add Penawaran');
        $this->template->render('EditHeader');
    }

	public function View($id)
    {
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-pencil');
		$header = $this->db->query("SELECT tpr.*, mse.nm_karyawan FROM tr_purchase_request tpr JOIN ms_employee mse ON mse.id = tpr.requestor  WHERE no_pr = '$id' ORDER BY created_on DESC")->result();
		$detail = $this->db->query("SELECT a.*,b.nama  FROM dt_trans_pr a
		  inner join  ms_inventory_category3 b ON a.idmaterial = b.id
		  WHERE a.no_pr = '$id' ")->result();
		$data = [
			'header' => $header,
			'detail' => $detail,
		];
        $this->template->set('results', $data);
        $this->template->title('View P.R');
        $this->template->render('View');
    }

	public function ApprovalView($id)
    {
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-pencil');
		$header = $this->db->query("SELECT tpr.*, mse.nm_karyawan FROM tr_purchase_request tpr JOIN ms_employee mse ON mse.id = tpr.requestor  WHERE no_pr = '$id' ORDER BY created_on DESC")->result();
		$detail = $this->db->query("SELECT a.*,b.nama  FROM dt_trans_pr a
		  inner join  ms_inventory_category3 b ON a.idmaterial = b.id
		  WHERE a.no_pr = '$id' ")->result();
		$data = [
			'header' => $header,
			'detail' => $detail,
		];

        $this->template->set('results', $data);
        $this->template->title('Approval View');
        $this->template->render('ApprovalView');
    }

	function CariSupplier()
    {
        $id_category3=$_GET['idmaterial'];
		$loop=$_GET['id'];
		$supplier	= $this->db->query("SELECT a.* FROM  master_supplier a")->result();
		echo "<select class='form-control select2' id='dt_suplier_".$loop."' name='dt[".$loop."][suplier]'>
		<option value=''>Pilih</option>";
		foreach($supplier as $supplier){
			echo"<option value='".$supplier->id_suplier ."'>".$supplier->name_suplier ."</option>";
		}
		echo"</select>";
	}


	function cari_inven1()
    {
        $id_category3=$_GET['id_category3'];
		$kategory3	= $this->db->query("SELECT * FROM ms_inventory_category3 WHERE id_category3 = '$id_category3' ")->result();
		$inven1 = $kategory3[0]->id_category1;
		echo "<input type='text' class='form-control' id='inven1' value='$inven1'  required name='inven1' placeholder='Bentuk Material'>";
	}

	public function delDetail()
	{
		$this->auth->restrict($this->deletePermission);
		$id = $this->input->post('id');
		// print_r($id);
		// exit();
		$data = [
			'deleted' 		=> '1',
			'deleted_by' 	=> $this->auth->user_id()
		];

		$this->db->trans_begin();
		$this->db->where('id_dimensi',$id)->update("ms_dimensi",$data);

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

	public function Approved()
	{
		$this->auth->restrict($this->deletePermission);
		$id = $this->input->post('id');
		$data = [
			'status' => '2',
			'approved_by' => $this->auth->user_id()
		];

		$this->db->trans_begin();
		$this->db->where('no_pr', $id)->update("tr_purchase_request", $data);

		if($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$status	= array(
			  'pesan'		=>'Gagal Approve Purchase Request Thanks ...',
			  'status'	=> 0
			);
		} else {
			$this->db->trans_commit();
			$status	= array(
			  'pesan'		=>'Success Approve Purchase Request Thanks ...',
			  'status'	=> 1
			);
		}

  		echo json_encode($status);
	}
}
