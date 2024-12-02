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

class Purchase_request extends Admin_Controller 
{
    //Permission
    protected $viewPermission 	= 'Purchase_Request.View';
    protected $addPermission  	= 'Purchase_Request.Add';
    protected $managePermission = 'Purchase_Request.Manage';
    protected $deletePermission = 'Purchase_Request.Delete';

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
        $this->template->title('Purchase Request');
        $this->template->render('index');
    }

	public function add()
    {
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-pencil');

		$aktif = 'active';
		$deleted = '0';
		$status = '1';
		$customers = $this->Pr_model->get_data('master_customers','deleted',$deleted);
		$karyawan = $this->Pr_model->get_data('ms_employee','deleted',$deleted);
		$mata_uang = $this->Pr_model->get_data('mata_uang','deleted'.$deleted);
		$departements = $this->Pr_model->get_data('ms_department', 'status', $status);

		// return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($departements));
		
		$data = [
			'customers' => $customers,
			'karyawan' => $karyawan,
			'mata_uang' => $mata_uang,
			'departements' => $departements
		];

        $this->template->set('results', $data);
        $this->template->title('Purchase Request');
        $this->template->render('Add');
    }
	
	public function edit()
    {
		$id = $this->uri->segment(3);
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-pencil');
		$aktif = 'active';
		$deleted = '0';
		$status = '1';
		$head = $this->db->query("SELECT tpr.*, mse.nm_karyawan FROM tr_purchase_request tpr JOIN ms_employee mse ON mse.id = tpr.requestor  WHERE no_pr = '$id' ORDER BY created_on DESC")->result();
		$detail = $this->db->query("SELECT * FROM dt_trans_pr  WHERE no_pr = '$id' ")->result();
		$customers = $this->Pr_model->get_data('master_customers','deleted',$deleted);
		$karyawan = $this->Pr_model->get_data('ms_employee','deleted',$deleted);
		$mata_uang = $this->Pr_model->get_data('mata_uang','deleted'.$deleted);
		$departements = $this->Pr_model->get_data('ms_department', 'status', $status);
		$data = [
			'head' => $head,
			'detail' => $detail,
			'customers' => $customers,
			'karyawan' => $karyawan,
			'mata_uang' => $mata_uang,
			'departements' => $departements
		];
        $this->template->set('results', $data);
        $this->template->title('Purchase Request');
        $this->template->render('Edit');

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
		$karyawan = $this->Pr_model->get_data('ms_employee','deleted',$deleted);
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

	function AddMaterial()
    {
		$loop=$_GET['jumlah']+1;
		$materials = $this->db->query("SELECT a.* FROM ms_inventory_category3 as a")->result();
		echo "
		<tr id='tr_$loop'>
		<td><select class='form-control select2' id='dt_idmaterial_$loop' name='dt[$loop][idmaterial]'	onchange ='CariProperties($loop)'>
		<option value=''>Pilih</option>";
		foreach ($materials as $material){
			echo"<option value='$material->id'>$material->nama|$material->sku_varian</option>";
		};
		echo"</select></td>
		<td id='kodeproduk_".$loop."'><input readonly type='text' class='form-control' id='dt_kodeproduk_$loop' required name='dt[$loop][kodeproduk]' ></td>
		<td><input type='number' class='form-control' id='dt_qty_$loop' 			required name='dt[$loop][qty]' ></td>
		<td hidden><input type='hidden' class='form-control' id='dt_weight_$loop' value='' required name='dt[$loop][weight]'></td>
		<td hidden><input type='hidden' class='form-control' id='dt_width_$loop' value='' required name='dt[$loop][width]'></td>
		<td hidden><input type='hidden' class='form-control' id='dt_length_$loop' value='' required name='dt[$loop][length]'></td>
		<td id='supplier_".$loop."'><select class='form-control select3' id='dt_suplier_$loop' name='dt[$loop][suplier]'>
		<option value=''>Empty</option></select></td>
		<td><input type='text' class='form-control datepicker' readonly id='dt_tanggal_$loop' 	required name='dt[$loop][tanggal]' 	></td>
		<td><input type='text' class='form-control' id='dt_keterangan_$loop' 	required name='dt[$loop][keterangan]' 	></td>
		<td><button type='button' class='btn btn-sm btn-danger' title='Hapus Data' data-role='qtip' onClick='return HapusItem($loop);'><i class='fa fa-close'></i></button></td>
		</tr>
		";
	}

	function getKaryawan() 
	{
		$iddepartment = $_GET['iddepartement'];
		$employee	= $this->db->query("SELECT * FROM ms_employee WHERE department = '$iddepartment' AND deleted_by IS NULL")->result();

		$data = [
			'code' => 200,
			'status' => 'OK',
			'id' => 'width',
			'value' => $employee,
			'message' => 'Berhasil Get Data'
		];
		
		return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));
	}

	function getWidth() 
	{
		$id = $_GET['idmaterial'];
		$loop = $_GET['id'];
		$product	= $this->db->query("SELECT * FROM ms_inventory_category3 WHERE id = '$id' ")->row_array();
		$lebar = $product['lebar'];

		$data = [
			'code' => 200,
			'status' => 'OK',
			'id' => 'width',
			'value' => $lebar,
			'message' => 'Berhasil Get Data'
		];
		
		return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));
	}

	function getLength() 
	{
		$id = $_GET['idmaterial'];
		$loop = $_GET['id'];
		$product	= $this->db->query("SELECT * FROM ms_inventory_category3 WHERE id = '$id' ")->row_array();
		$panjang = $product['panjang'];

		$data = [
			'code' => 200,
			'status' => 'OK',
			'id' => 'width',
			'value' => $panjang,
			'message' => 'Berhasil Get Data'
		];
		
		return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));
	}

	function getWeight() 
	{
		$id = $_GET['idmaterial'];
		$loop = $_GET['id'];
		$product	= $this->db->query("SELECT * FROM ms_inventory_category3 WHERE id = '$id' ")->row_array();
		$berat = $product['berat'];

		$data = [
			'code' => 200,
			'status' => 'OK',
			'id' => 'width',
			'value' => $berat,
			'message' => 'Berhasil Get Data'
		];
		
		return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));
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

	function CariKodeproduk()
    {
        $id_category3=$_GET['idmaterial'];
		$loop=$_GET['id'];
		$kategory3	= $this->db->query("SELECT * FROM ms_inventory_category3 WHERE id = '$id_category3' ")->result();
		$id_bentuk = $kategory3[0]->sku_varian;
		echo "<input readonly type='text' class='form-control' value='".$id_bentuk."' id='dt_kodeproduk_".$loop."' required name='dt[".$loop."][kodeproduk]' >";
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
		
	function get_inven2()
    {
        $inventory_1=$_GET['inventory_1'];
        $data=$this->Pr_model->level_2($inventory_1);
        echo "<select id='inventory_2' name='hd1[1][inventory_2]' class='form-control onchange='get_inv3()'  input-sm select2'>";
        echo "<option value=''>--Pilih--</option>";
                foreach ($data as $key => $st) :
				      echo "<option value='$st->id_category1' set_select('inventory_2', $st->id_category1, isset($data->id_category1) && $data->id_category1 == $st->id_category1)>$st->nama
                    </option>";
                endforeach;
        echo "</select>";
    }
		
	function get_inven3()
    {
        $inventory_2=$_GET['inventory_2'];
        $data=$this->Pr_model->level_3($inventory_2);

        // print_r($data);
        // exit();
        echo "<select id='inventory_3' name='hd1[1][inventory_3]' class='form-control input-sm select2'>";
        echo "<option value=''>--Pilih--</option>";
                foreach ($data as $key => $st) :
				      echo "<option value='$st->id_category2' set_select('inventory_3', $st->id_category2, isset($data->id_category2) && $data->id_category2 == $st->id_category2)>$st->nama
                    </option>";
                endforeach;
        echo "</select>";
    }

	public function SaveNew()
    {
        $this->auth->restrict($this->addPermission);
		$post = $this->input->post();

		$tgl  = $post['tanggal'];
		
		$code = $this->Pr_model->generate_code($tgl);
		$no_surat = $this->Pr_model->BuatNomor($tgl);
		
		$this->db->trans_begin();

		$data = [
			'no_pr'					=> $code,
			'no_surat'				=> $no_surat,
			'tanggal'				=> $post['tanggal'],
			'requestor'				=> $post['requestor_employee'],
			'departement_requestor'	=> $post['requestor_departement'],
			'alasan'				=> $post['alasan_request'],
			'tingkat_kebutuhan'		=> $post['tingkat_kebutuhan'],
			'status'				=> '1',
			'created_on'			=> date('Y-m-d H:i:s'),
			'created_by'			=> $this->auth->user_id()
		];
		//Add Data
		$this->db->insert('tr_purchase_request', $data);
			 
		$numb1 = 0;
		foreach($_POST['dt'] as $used){
			$numb1++;

			$idmat  = $used['idmaterial'];
			$materials = $this->db->query("SELECT a.* FROM ms_inventory_category3 a WHERE a.id ='$idmat' ")->row();
			$dt = array(
				'no_pr'				=> $code,
				'id_dt_pr'			=> $code.'-'.$numb1,
				'idmaterial'		=> $used['idmaterial'],
				'nama_material'		=> $materials->nama,
				'qty'				=> $used['qty'],
				'weight'			=> $used['weight'],
				'totalweight'		=> $used['qty'] * $used['weight'],
				'width'				=> $used['width'],
				'length'			=> $used['length'],
				'suplier'			=> $used['suplier'],
				'tanggal'			=> $used['tanggal'],
				'keterangan'		=> $used['keterangan'],
				'kode_barang'		=> $used['kodeproduk'],
			);
            
			$this->db->insert('dt_trans_pr',$dt);	
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$status	= array(
			  'pesan'		=>'Gagal Save Item. Thanks ...',
			  'code' => $code,
			  'status'	=> 0
			);
		} else {
			$this->db->trans_commit();
			$status	= array(
			  'pesan'		=>'Success Save Item. invenThanks ...',
			  'code' => $code,
			  'status'	=> 1
			);
		}

  		echo json_encode($status);
    }
	
	public function SaveEdit()
    {
        $this->auth->restrict($this->addPermission); 
		$post = $this->input->post();
		
		// print_r($post);
		// exit;
		
		$code = $post['no_pr'];
		$no_surat = $post['no_surat'];
		
		$this->db->trans_begin();
		$data = [
			'no_pr'					=> $code,
			'no_surat'				=> $no_surat,
			'requestor'				=> $post['requestor_employee'],
			'departement_requestor'	=> $post['requestor_departement'],
			'alasan'				=> $post['alasan_request'],
			'tingkat_kebutuhan'		=> $post['tingkat_kebutuhan'],
			'tanggal'				=> $post['tanggal'],
			'status'				=> '1',
			'created_on'			=> date('Y-m-d H:i:s'),
			'created_by'			=> $this->auth->user_id()
		];

		//Add Data
		$this->db->where('no_pr',$code)->update("tr_purchase_request", $data);
		$this->db->delete('dt_trans_pr', array('no_pr' => $code));
			 
		$numb1 =0; 
		foreach($_POST['dt'] as $used) {
			$numb1++;
		
			$idmat  = $used['idmaterial'];
		    $matrial = $this->db->query("SELECT a.* FROM ms_inventory_category3 a WHERE a.id ='$idmat'")->row();
			// return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($used['weight']));
		
			$dt =  array(
				'no_pr'				=> $code,
				'id_dt_pr'			=> $code.'-'.$numb1,
				'idmaterial'		=> $used['idmaterial'],
				'nama_material'		=> $matrial->nama,
				'qty'				=> $used['qty'],
				'weight'			=> $used['weight'],
				'totalweight'		=> $used['qty'] * $used['weight'],
				'width'				=> $used['width'],
				'length'			=> $used['length'],
				'suplier'			=> $used['suplier'],
				'tanggal'			=> $used['tanggal'],
				'keterangan'		=> $used['keterangan'],
				'kode_barang'		=> $used['kodeproduk'],
			);

			$this->db->insert('dt_trans_pr', $dt);
		};

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$status	= array(
			  'pesan'		=>'Gagal Save Item. Thanks ...',
			  'code' => $code,
			  'status'	=> 0
			);
		} else {
			$this->db->trans_commit();
			$status	= array(
			  'pesan'		=>'Success Save Item. invenThanks ...',
			  'code' => $code,
			  'status'	=> 1
			);
		}

  		echo json_encode($status);
	}
}
