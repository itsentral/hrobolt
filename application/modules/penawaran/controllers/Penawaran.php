<?php
if (!defined('BASEPATH')){
    exit('No direct script access allowed');
}

/*
 * @author Syamsudin
 * @Copyright (c) 2022, Syamsudin
 *
 * This is controller for Wt_penawaran
 */

class Penawaran extends Admin_Controller
{
    //Permission
    protected $viewPermission 	= 'Penawaran.View'; 
    protected $addPermission  	= 'Penawaran.Add';
    protected $managePermission = 'Penawaran.Manage';
    protected $deletePermission = 'Penawaran.Delete';

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('Mpdf', 'upload', 'Image_lib'));
        $this->load->model(array('penawaran/penawaran_model',
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

        $data = $this->penawaran_model->CariPenawaran();

        $this->template->set('results', $data);
        $this->template->title('Penawaran');
        $this->template->render('index');
    }

    public function AddPenawaran()
    {
        $this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-pencil');
		$aktif = 'active';
		$deleted = null;
		$customers = $this->penawaran_model->get_data('master_customers','deleted',$deleted);
		$karyawan = $this->penawaran_model->get_data('ms_employee','deleted',$deleted);
		$mata_uang = $this->penawaran_model->get_data('mata_uang','deleted'.$deleted);
        $top       = $this->penawaran_model->get_data('list_help', 'group_by', 'top invoice');
		$data = [
			'customers' => $customers,
			'karyawan' => $karyawan,
			'mata_uang' => $mata_uang,
            'top' => $top,
		];
        $this->template->set('results', $data);
        $this->template->title('Add Penawaran');
        $this->template->render('addpenawaran');
    }

	public function editPenawaran($id)
    {
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-pencil');
		$aktif = 'active';
		$deleted = null;
		$customers = $this->penawaran_model->get_data('master_customers','deleted',$deleted);
		$karyawan  = $this->penawaran_model->get_data('ms_employee','deleted',$deleted);
		$mata_uang = $this->penawaran_model->get_data('mata_uang','deleted'.$deleted);
        $top       = $this->penawaran_model->get_data('list_help', 'group_by', 'top invoice');
		$header    = $this->penawaran_model->get_data('tr_penawaran','no_penawaran',$id);
		$detail    = $this->penawaran_model->get_data('tr_penawaran_detail','no_penawaran',$id);
		$data = [
			'customers' => $customers,
			'karyawan' => $karyawan,
			'mata_uang' => $mata_uang,
            'top' => $top,
			'header'=>$header,
			'detail'=>$detail,
		];

        $this->template->set('results', $data);
        $this->template->title('Edit Penawaran');
        $this->template->render('editpenawaran');
    }

    function GetProduk()
    {
		$loop=$_GET['jumlah']+1;
		
		$customers = $this->penawaran_model->get_data('master_customers','deleted',$deleted);
		
		
		$material = $this->db->query("SELECT a.* FROM ms_inventory_category3 a WHERE a.deleted !=1 ")->result();
		
		echo "
		<tr id='tr_$loop'>
			
			<td style='width: 200px;'>
				<select id='used_no_surat_$loop' name='dt[$loop][id_product]' data-no='$loop' onchange='CariDetail($loop)' class='form-control select' required>
					<option value=''>-Pilih-</option>";					
					foreach($material as $produk){
					echo"<option value='$produk->id'>$produk->nama|$produk->sku_varian</option>";
					}
		echo	"</select>
			</td>
			<td id='spesifikasi_$loop'></td>
			<td id='nama_produk_$loop' hidden><input type='text' class='form-control input-sm' readonly id='used_nama_produk_$loop' required name='dt[$loop][nama_produk]'></td>
			<td id='qty_$loop'><input type='text' class='form-control input-sm' id='used_qty_$loop' required name='dt[$loop][qty]' onkeyup='HitungTotal($loop)'></td>
			<td id='qty_actual_$loop'></td>
			<td id='harga_satuan_$loop'><input type='text' class='form-control input-sm' id='used_harga_satuan_$loop' required name='dt[$loop][harga_satuan]'></td>
			<td id='diskon_$loop'><input type='text' class='form-control'  id='used_diskon_$loop' required name='dt[$loop][diskon]' onblur='HitungTotal($loop)'></td>
			<td id='nilai_diskon_$loop'><input type='text' class='form-control'  id='used_nilai_diskon_$loop' required name='dt[$loop][nilai_diskon]'></td>
			<td id='total_harga_$loop'><input type='text' class='form-control input-sm total' id='used_total_harga_$loop' required name='dt[$loop][total_harga]' readonly></td>
			<td align='center'>
				<button type='button' class='btn btn-sm btn-danger' title='Hapus Data' data-role='qtip' onClick='return HapusItem($loop);'><i class='fa fa-close'></i></button>
			</td>
			
		</tr>
		";
	}

    public function SaveNewPenawaran()
    {
        $this->auth->restrict($this->addPermission);
		$post = $this->input->post();
		
		$tgl = $post['tanggal'];
		
        $code = $this->penawaran_model->generate_code($tgl);
		$no_surat = $this->penawaran_model->BuatNomor($tgl);
		
		$this->db->trans_begin();

		// $config['upload_path'] = './assets/file_po/'; //path folder
	    // $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|doc|docx|xls|xlsx|ppt|pptx|pdf|rar|zip|vsd'; //type yang dapat diakses bisa anda sesuaikan
	    // $config['encrypt_name'] = false; //Enkripsi nama yang terupload

	    // $this->upload->initialize($config);
	    //     if ($this->upload->do_upload('upload_skb')){
	    //         $gbr = $this->upload->data();
	    //         //Compress Image
	    //         $config['image_library']='gd2';
	    //         $config['source_image']='./assets/file_po/'.$gbr['file_name'];
	    //         $config['create_thumb']= FALSE;
	    //         $config['maintain_ratio']= FALSE;
	    //         $config['umum']= '50%';
	    //         $config['width']= 260;
	    //         $config['height']= 350;
	    //         $config['new_image']= './assets/file_po/'.$gbr['file_name'];
	    //         $this->load->library('image_lib', $config);
	    //         $this->image_lib->resize();

	    //         $gambar  =$gbr['file_name'];
		// 		$type    =$gbr['file_type'];
		// 		$ukuran  =$gbr['file_size'];
		// 		$ext1    =explode('.', $gambar);
		// 		$ext     =$ext1[1];
		// 		$lokasi = './assets/file_po/'.$gbr['file_name'];
				
		// 	}

		$diskonTotal = 0;
		$numb1 = 0;
		foreach($_POST['dt'] as $used){
			$diskonTotal = $diskonTotal + str_replace(',','',$used['nilai_diskon']);

			if(!empty($used['id_product'])){
				$numb1++;   
				$dt[] =  array(
					'no_penawaran'		=> $code,
					'id_product'		=> $used['id_product'],
					'nama_produk'	    => $used['nama_produk'],
					'qty'			    => $used['qty'],
					'harga_satuan'		=> str_replace(',','',$used['harga_satuan']),
					'diskon'		    => $used['diskon'],
					'total_harga'	    => str_replace(',','',$used['total_harga']),
					'nilai_diskon'	    => str_replace(',','',$used['nilai_diskon']),
					'created_on'		=> date('Y-m-d H:i:s'),
					'created_by'		=> $this->auth->user_id(),		   
				);
			}
		}

		$this->db->insert_batch('tr_penawaran_detail',$dt);

		$data = [
			'no_penawaran'			=> $code,
			'no_surat'				=> $no_surat,
			'tgl_penawaran'			=> $post['tanggal'],
			'id_customer'			=> $post['id_customer'],
			'pic_customer'			=> $post['pic_customer'],
			'email_customer'		=> $post['email_customer'],
			'top'			        => $post['top'],
			'order_status'			=> $post['order_sts'],
			'id_sales'				=> $post['id_sales'],
			'nama_sales'			=> $post['nama_sales'],
			'nilai_penawaran'		=> str_replace(',','',$post['totalproduk']),
			'created_on'			=> date('Y-m-d H:i:s'),
			'created_by'			=> $this->auth->user_id(),
			'pilihppn'			    => $post['ppn_nonppn'],
			'ppn'					=> str_replace(',','',$post['ppn']),
			'nilai_ppn'				=> str_replace(',','',$post['totalppn']),
			'grand_total'			=> str_replace(',','',$post['grandtotal']),
			'diskon_total'			=> $diskonTotal
		];

		//Add Data
		$this->db->insert('tr_penawaran',$data);


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

	public function SaveEditPenawaran()
    {
        $this->auth->restrict($this->addPermission);
		$post = $this->input->post();
		$code		= $post['no_penawaran'];
		$no_surat	= $post['no_surat'];
		$this->db->trans_begin();
		$data = [
			'no_penawaran'			=> $code,
			'no_surat'				=> $no_surat,
			'tgl_penawaran'			=> $post['tanggal'],
			'id_customer'			=> $post['id_customer'],
			'pic_customer'			=> $post['pic_customer'],
			'email_customer'		=> $post['email_customer'],
			'top'			        => $post['top'],
			'order_status'			=> $post['order_sts'],
			'id_sales'				=> $post['id_sales'],
			'nama_sales'			=> $post['nama_sales'],
			'nilai_penawaran'		=> str_replace(',','',$post['totalproduk']),
			'modified_on'			=> date('Y-m-d H:i:s'),
			'modified_by'			=> $this->auth->user_id(),
			'ppn'					=> str_replace(',','',$post['ppn']),
			'nilai_ppn'				=> str_replace(',','',$post['totalppn']),
			'grand_total'			=> str_replace(',','',$post['grandtotal'])
		];
			//Edit Data
          	$this->db->where('no_penawaran',$code)->update("tr_penawaran",$data);			

			$numb1 =0;
			foreach($_POST['dt'] as $used){
				if(!empty($used['no_surat'])){
					$numb1++;   
					$dt[] =  array(
							'no_penawaran'		=> $code,
							'id_product'		=> $used['no_surat'],
							'nama_produk'	    => $used['nama_produk'],
							'qty'			    => $used['qty'],
							'harga_satuan'		=> str_replace(',','',$used['harga_satuan']),
							'stok_tersedia'		=> $used['stok_tersedia'],
							'potensial_loss'	=> $used['potensial_loss'],
							'diskon'		    => $used['diskon'],
							'freight_cost'		=> str_replace(',','',$used['freight_cost']),
							'total_harga'	    => str_replace(',','',$used['total_harga']),
							'created_on'		=> date('Y-m-d H:i:s'),
							'created_by'		=> $this->auth->user_id(),
							'nilai_diskon'		=> str_replace(',','',$used['nilai_diskon']),
							'diskon_compare'	=> $used['compare_diskon']							
						);
				}
			}
		 //    print_r($dt);
		 //    exit();
		 $this->db->delete('tr_penawaran_detail',array('no_penawaran'=>$code));
		 $this->db->insert_batch('tr_penawaran_detail',$dt);

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

    function getemail()
    {
        $id_customer = $_GET['id_customer'];
		$kategory3	= $this->db->query("SELECT * FROM master_customers WHERE id_customer = '$id_customer' ")->result();
		$thickness = $kategory3[0]->email;
		echo "<input type='email' class='form-control' id='email_customer' value='$thickness' required name='email_customer' >";
	}

    function getsales()
    {
        $id_customer = $_GET['id_customer'];
		// $kategory3 = $this->db->query("SELECT * FROM master_customers WHERE id_customer = '$id_customer' ")->result();
		// $id_karyawan = $kategory3[0]->id_karyawan;

		$idUser = $this->auth->user_id();
		$user = $this->db->query("SELECT * FROM users WHERE id_user = $idUser")->row();
		$userName = $user->nm_lengkap;

		// $karyawan = $this->db->query("SELECT * FROM ms_karyawan WHERE id_karyawan = '$id_karyawan' ")->result();
		// $nama_karyawan = $karyawan[0]->nama_karyawan;
		echo "	<div class='col-md-8' >
					<input type='text' class='form-control' id='name_sales' value='$userName' required name='nama_sales' readonly placeholder='Sales Marketing'>
				</div>
				<div class='col-md-8' hidden>
					<input type='text' class='form-control' id='id_sales' value='$idUser'  required name='id_sales' readonly placeholder='Sales Marketing'>
				</div>";
	}

    function getpic()
    {
        $id_customer = $_GET['id_customer'];
		// $customer = $this->db->query("SELECT * FROM master_customers WHERE id_customer = '" . $id_customer . "'")->row();
		$pic = $this->db->query("SELECT * FROM customer_pic WHERE customer_id = '" . $id_customer . "'")->result();

		echo "<select class='form-control select' id='pic_customer' name='pic_customer' required>";
		foreach ($pic AS $value) {
			echo "<option value='" . $value->nm_pic . "'>" . $value->nm_pic . "</option>";
		}
		echo "</select>";
		// echo "<input type='text' id='pic_customer' name='pic_customer' class='form-control select' value='" . $pic->nm_pic . "'  required />";
	}

    function CariNamaProduk()
    {
        $loop = $_GET['id'];
		$id_category3 = $_GET['id_category3'];
		$material = $this->db->query("SELECT a.*, b.qty_actual AS qty_actual FROM ms_inventory_category3 a JOIN view_stok_actual b ON b.sku_varian = a.sku_varian WHERE a.id = '$id_category3' ")->result();
		$produk = $material[0]->nama;
	
		$nameProduk = "<input type='text' class='form-control input-sm' readonly id='used_nama_produk_$loop' required name='dt[$loop][nama_produk]' value='$produk'>";
		$spesifikasiProduk = "
			<ul>
				<li>Panjang : " . $material[0]->panjang . " " . $material[0]->satuan_volume . "
				<li>Grade : " . $material[0]->grade . "
				<li>Merk : " . $material[0]->merk . "
				<li>Diameter : " . $material[0]->diameter . " 
			</ul>
		";

		$qtyActual = "<input type='text' class='form-control' id='qty_actual_field_$loop' required name='dt[$loop][qty_actual]' value='".$material[0]->qty_actual."' readonly>";

		$data = [
			'status' => 'OK',
			'code' => 200,
			'nama_produk' => $nameProduk,
			'spesifikasi' => $spesifikasiProduk,
			'qty_actual' => $qtyActual
		];

		return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));
	}

	function CariHarga()
    {
        $loop = $_GET['id'];
		$id_category3 = $_GET['id_category3'];
		$material = $this->db->query("SELECT * FROM ms_inventory_category3 WHERE id = '$id_category3' ")->result();
		$produk= number_format($material[0]->price, 2, '.', ',');					

		echo "<input type='text' class='form-control input-sm' readonly id='used_harga_satuan_$loop' required name='dt[$loop][harga_satuan]' value='$produk'>";
	}

	function CariDiskon()
    {
        $loop=$_GET['id'];
		$id_category3=$_GET['id_category3'];
		$idtop       =$_GET['top'];
		$material	= $this->db->query("SELECT * FROM ms_inventory_category3 WHERE id = '$id_category3' ")->result();
		$produk= $material[0]->id_type;		
		$diskon	= $this->db->query("SELECT * FROM ms_diskon WHERE id_type = '$produk' AND id_top='$idtop' ")->result();	
		$diskonvalue= $diskon[0]->nilai_diskon;	

		echo "<input type='text' class='form-control input-sm' id='used_diskon_$loop' required name='dt[$loop][diskon]' value='$diskonvalue' onblur='HitungTotal($loop)'>";
		
	}
	
	function CariDiskonCompare()
    {
        $loop=$_GET['id'];
		$id_category3=$_GET['id_category3'];
		$idtop       =$_GET['top'];
		$material	= $this->db->query("SELECT * FROM ms_inventory_category3 WHERE id = '$id_category3' ")->result();
		$produk= $material[0]->id_type;		
		$diskon	= $this->db->query("SELECT * FROM ms_diskon WHERE id_type = '$produk' AND id_top='$idtop' ")->result();	
		$diskonvalue2= $diskon[0]->nilai_diskon;			
		echo"<input type='text' class='form-control'  id='used_compare_diskon_$loop' required name='dt[$loop][compare_diskon]' value='$diskonvalue2'>";
		
	}

	function CariStokFree()
    {
        $loop=$_GET['id'];
		$id_category3=$_GET['id_category3'];
		$idtop       =$_GET['top'];
		$stok	= $this->db->query("SELECT * FROM stock_material WHERE id_category3 = '$id_category3' ")->result();	
		$stokfree= $stok[0]->qty_free;			
		echo"<input type='text' class='form-control input-sm' id='used_stok_tersedia_$loop' required name='dt[$loop][stok_tersedia]' onblur='HitungLoss($loop)' value='$stokfree' readonly>
		";
		
	}

	public function PrintPenawaran($id)
	{
		ob_clean();
		ob_start();
        $this->auth->restrict($this->managePermission);
        $id = $this->uri->segment(3);		

		$dataDetail = $this->db->query("SELECT a.*, b.nama AS name, b.panjang AS panjang, b.grade AS grade, b.merk AS merk, b.diameter AS diameter
											FROM tr_penawaran_detail a 
											JOIN ms_inventory_category3 b ON b.id = a.id_product 
											WHERE a.no_penawaran = '$id'")->result();

		$dataDiscount = $this->db->query("SELECT sum(diskon) AS discount FROM tr_penawaran_detail WHERE no_penawaran = '$id'")->row();

		$data['isDiscount'] = ($dataDiscount->discount != 0) ? true : false;
		$data['header']   = $this->penawaran_model->get_data('tr_penawaran','no_penawaran',$id);
		$data['detail']   = $dataDetail;
		$data['pernyataan'] = [
			'pernyataan1' => $this->input->get('pernyataan1'),
			'pernyataan2' => $this->input->get('pernyataan2'),
			'pernyataan3' => $this->input->get('pernyataan3'),
			'pernyataan4' => $this->input->get('pernyataan4'),
			'pernyataan5' => $this->input->get('pernyataan5'),
			'pernyataan6' => $this->input->get('pernyataan6'),
		];
		$data['marketing_manager'] = $this->db->query("SELECT * FROM ms_employee WHERE role = 'Marketing Manager'")->row();

		$this->load->view('PrintPenawaran', $data);
		$html = ob_get_contents();

		require_once('./assets/html2pdf/html2pdf/html2pdf.class.php');
		$html2pdf = new HTML2PDF('P','A4','en',true,'UTF-8',array(10, 5, 10, 5));
		$html2pdf->writeHTML($html);
		ob_end_clean();

		$namePdf = 'Penawaran - Hiro Bolt (' .$id. ').pdf';

		$data = [
			'status'		        => 3,
			'printed_on'			=> date('Y-m-d H:i:s'),
			'printed_by'			=> $this->auth->user_id(),
			'path_file'				=> 'assets/files/penawaran/' . $namePdf
		];
			
		//Edit Data
		$this->db->where('no_penawaran', $id)->update("tr_penawaran", $data);

		$path = APPPATH . '../assets/files/penawaran/';
		
		$html2pdf->Output($path.$namePdf, 'F');
		$html2pdf->Output($namePdf, 'I');

		// return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($savePdf));

		// echo "<script> window.open(".$html2pdf->Output($namePdf, 'I').", '_blank') </script>";
	}

	public function ajukanApprove($id)
    {
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-pencil');
		$aktif = 'active';
		$deleted = null;
		$customers = $this->penawaran_model->get_data('master_customers','deleted',$deleted);
		$karyawan = $this->penawaran_model->get_data('ms_employee','deleted',$deleted);
		$mata_uang = $this->penawaran_model->get_data('mata_uang','deleted'.$deleted);
        $top       = $this->penawaran_model->get_data('list_help', 'group_by', 'top invoice');
		$header    = $this->penawaran_model->get_data('tr_penawaran','no_penawaran',$id);
		$detail    = $this->penawaran_model->get_data('tr_penawaran_detail','no_penawaran',$id);
		$data = [
			'customers' => $customers,
			'karyawan' => $karyawan,
			'mata_uang' => $mata_uang,
            'top' => $top,
			'header'=>$header,
			'detail'=>$detail,
		];

        $this->template->set('results', $data);
        $this->template->title('Ajukan Penawaran');
        $this->template->render('ajukanpenawaran');

    }

	public function FormApproval($id)
    {
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-pencil');
	
		$data = [
			'id' => $id,
		];

        $this->template->set('results', $data);
        $this->template->title('Ajukan Approve');
        $this->template->render('formapproval');
    }

	public function SaveAprrovePenawaran()
    {
        $this->auth->restrict($this->addPermission);
		$post = $this->input->post();
		$code = $post['no_penawaran'];
		$this->db->trans_begin();
		$data = [
			'no_penawaran'			=> $code,
			'status'				=> 1,
			'keterangan'			=> $post['keterangan'],
			'approved_on'			=> date('Y-m-d H:i:s'),
			'approved_by'			=> $this->auth->user_id()
		];
		
		//Edit Data
		$this->db->where('no_penawaran',$code)->update("tr_penawaran",$data);			

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

	public function index_approval()
    {
        $this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$status =1;
		$this->template->page_icon('fa fa-users');
        $data = $this->penawaran_model->CariPenawaranApproval();
        $this->template->set('results', $data);
        $this->template->title('Request Approval');
        $this->template->render('index_approval');
    }

	public function index_so()
    {
        $this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$status =6;
		$this->template->page_icon('fa fa-users');
        $data = $this->penawaran_model->CariPenawaranSo();
        $this->template->set('results', $data);
        $this->template->title('Sales Order');
        $this->template->render('index_so');
    }

	public function index_loss()
    {
        $this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$status =7;
		$this->template->page_icon('fa fa-users');
        $data = $this->penawaran_model->CariPenawaranLoss();
        $this->template->set('results', $data);
        $this->template->title('Loss Penawaran');
        $this->template->render('index_loss');
    }

	public function history()
    {
        $this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-users');
        $data = $this->penawaran_model->CariPenawaranHistory();
        $this->template->set('results', $data);
        $this->template->title('History Penawaran');
        $this->template->render('history');
    }

	public function ProsesApproval($id)
    {
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-pencil');
		$aktif = 'active';
		$deleted = null;
		$customers = $this->penawaran_model->get_data('master_customers','deleted',$deleted);
		$karyawan  = $this->penawaran_model->get_data('ms_employee','deleted',$deleted);
		$mata_uang = $this->penawaran_model->get_data('mata_uang','deleted'.$deleted);
        $top       = $this->penawaran_model->get_data('list_help', 'group_by', 'top invoice');
		$header    = $this->penawaran_model->get_data('tr_penawaran','no_penawaran',$id);
		$detail    = $this->penawaran_model->get_data('tr_penawaran_detail','no_penawaran',$id);
		$data = [
			'customers' => $customers,
			'karyawan' => $karyawan,
			'mata_uang' => $mata_uang,
            'top' => $top,
			'header'=>$header,
			'detail'=>$detail,
		];


        $this->template->set('results', $data);
        $this->template->title('Proses Approval');
        $this->template->render('formprosesapproval');

    }

	public function SaveApprovePenawaran()
    {
        $this->auth->restrict($this->addPermission);
		$post 		= $this->input->post();
		$code		= $post['no_penawaran'];
		$no_surat	= $post['no_surat'];
		$this->db->trans_begin();
		$data = [
			'no_penawaran'			=> $code,
			'no_surat'				=> $no_surat,
			'tgl_penawaran'			=> date('Y-m-d'),
			'id_customer'			=> $post['id_customer'],
			'pic_customer'			=> $post['pic_customer'],
			'email_customer'		=> $post['email_customer'],
			'top'			        => $post['top'],
			'order_status'			=> $post['order_sts'],
			'id_sales'				=> $post['id_sales'],
			'nama_sales'			=> $post['nama_sales'],
			'nilai_penawaran'		=> str_replace(',','',$post['totalproduk']),
			'status'		        => $post['status'],
			'created_on'			=> date('Y-m-d H:i:s'),
			'created_by'			=> $this->auth->user_id(),
			'ppn'					=> str_replace(',','',$post['ppn']),
			'nilai_ppn'				=> str_replace(',','',$post['totalppn']),
			'grand_total'			=> str_replace(',','',$post['grandtotal']),
			'keterangan_approve'	=> $post['keterangan_approve']
			
			];
			//Edit Data
          	$this->db->where('no_penawaran',$code)->update("tr_penawaran",$data);			

			$numb1 =0;
			foreach($_POST['dt'] as $used){
				if(!empty($used['no_surat'])){
					$numb1++;   
					$dt[] =  array(
							'no_penawaran'		=> $code,
							'id_product'		=> $used['no_surat'],
							'nama_produk'	    => $used['nama_produk'],
							'qty'			    => $used['qty'],
							'harga_satuan'		=> str_replace(',','',$used['harga_satuan']),
							'stok_tersedia'		=> $used['stok_tersedia'],
							'potensial_loss'	=> $used['potensial_loss'],
							'diskon'		    => $used['diskon'],
							'freight_cost'		=> str_replace(',','',$used['freight_cost']),
							'total_harga'	    => str_replace(',','',$used['total_harga']),
							'created_on'		=> date('Y-m-d H:i:s'),
							'created_by'		=> $this->auth->user_id(),
							'nilai_diskon'      => str_replace(',','',$used['nilai_diskon']),
							'diskon_compare'	=> $used['compare_diskon']    
							);
				}
			}
		 //    print_r($dt);
		 //    exit();
		 $this->db->delete('tr_penawaran_detail',array('no_penawaran'=>$code));
		 $this->db->insert_batch('tr_penawaran_detail',$dt);

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

	public function statusTerkirim($id)
    {
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-pencil');
		$aktif = 'active';
		$deleted = null;
		$customers = $this->penawaran_model->get_data('master_customers','deleted',$deleted);
		$karyawan = $this->penawaran_model->get_data('ms_employee','deleted',$deleted);
		$mata_uang = $this->penawaran_model->get_data('mata_uang','deleted'.$deleted);
        $top       = $this->penawaran_model->get_data('list_help', 'group_by', 'top invoice');
		$header    = $this->penawaran_model->get_data('tr_penawaran','no_penawaran',$id);
		$detail    = $this->penawaran_model->get_data('tr_penawaran_detail','no_penawaran',$id);
		$data = [
			'customers' => $customers,
			'karyawan' => $karyawan,
			'mata_uang' => $mata_uang,
            'top' => $top,
			'header'=>$header,
			'detail'=>$detail,
		];

        $this->template->set('results', $data);
        $this->template->title('Ubah Status Penawaran');
        $this->template->render('statusterkirim');
    }


	public function SaveStatusTerkirim()
    {
        $this->auth->restrict($this->addPermission);
		$post = $this->input->post();
		$code		= $post['no_penawaran'];
		$no_surat	= $post['no_surat'];
		$this->db->trans_begin();
		$data = [
			'status'				=> 4,
			'delivered_on'			=> date('Y-m-d H:i:s'),
			'delivered_by'			=> $this->auth->user_id()
			];
			//Edit Data
          	$this->db->where('no_penawaran',$code)->update("tr_penawaran",$data);			

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

	public function revisiPenawaran($id)
    {
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-pencil');
		$aktif = 'active';
		$deleted = '0';
		$customers = $this->penawaran_model->get_data('master_customers','deleted', null);
		$karyawan  = $this->penawaran_model->get_data('ms_employee','deleted',$deleted);
		$mata_uang = $this->penawaran_model->get_data('mata_uang','deleted'.$deleted);
        $top       = $this->penawaran_model->get_data('list_help', 'group_by', 'top invoice');
		$header    = $this->penawaran_model->get_data('tr_penawaran','no_penawaran',$id);
		$detail    = $this->penawaran_model->get_data('tr_penawaran_detail','no_penawaran',$id);
		$data = [
			'customers' => $customers,
			'karyawan' => $karyawan,
			'mata_uang' => $mata_uang,
            'top' => $top,
			'header'=>$header,
			'detail'=>$detail,
		];

        $this->template->set('results', $data);
        $this->template->title('Revisi Penawaran');
        $this->template->render('revisipenawaran');

    }

	public function SaveRevisiPenawaran()
    {
        $this->auth->restrict($this->addPermission);
		$post = $this->input->post();
		$tgl = ($post['tanggal']);
		$code		= $post['no_penawaran'];
		$no_surat	= $post['no_surat'];
		$nomor      = $this->penawaran_model->BuatNomor($tgl);
		$this->db->trans_begin();

		$select1 = $this->db->select('
		no_penawaran,
		no_surat,
		tgl_penawaran,
		id_customer,
		pic_customer,
		mata_uang,
		email_customer,
		valid_until,
		top,
		nilai_penawaran,
		order_status,
		id_sales,
		nama_sales,
		pengiriman,
		status,
		revisi,
		keterangan,
		created_by,
		created_on,
		modified_by,
		modified_on,
		printed_by,
		printed_on,
		delivered_by,
		delivered_on,
		approved_by,
		approved_on,
		revisi_by,
		revisi_on,
		ppn,
		nilai_ppn,
		grand_total,
		no_revisi' )->where('no_penawaran',$code)->get('tr_penawaran');
		if($select1->num_rows())
		{
			$insert = $this->db->insert_batch('tr_penawaran_history', $select1->result_array());
		}


		$select2 = $this->db->select('
		id_penawaran_detail,
		no_penawaran,
		id_category3,
		nama_produk,
		id_bentuk,
		qty,
		harga_satuan,
		stok_tersedia,
		potensial_loss,
		diskon,
		freight_cost,
		total_harga,
		keterangan,
		revisi,
		created_by,
		created_on,
		modified_by,
		modified_on,
		nilai_diskon,
		diskon_compare
		')->where('no_penawaran',$code)->get('tr_penawaran_detail');	
		

		$rev = $select1->row();
		$norev = $rev->revisi+1;
		$data = [
			'no_penawaran'			=> $code,
			'tgl_penawaran'			=> $post['tanggal'],
			'id_customer'			=> $post['id_customer'],
			'pic_customer'			=> $post['pic_customer'],
			'email_customer'		=> $post['email_customer'],
			'top'			        => $post['top'],
			'order_status'			=> $post['order_sts'],
			'id_sales'				=> $post['id_sales'],
			'nama_sales'			=> $post['nama_sales'],
			'nilai_penawaran'		=> str_replace(',','',$post['totalproduk']),
			'status'			    => 0,
			'revisi'			    => $norev,
			'revisi_on'				=> date('Y-m-d H:i:s'),
			'revisi_by'				=> $this->auth->user_id(),
			'ppn'					=> str_replace(',','',$post['ppn']),
			'nilai_ppn'				=> str_replace(',','',$post['totalppn']),
			'grand_total'			=> str_replace(',','',$post['grandtotal']),
			'no_revisi'				=> $no_surat,
			];
			//Edit Data
          	$this->db->where('no_penawaran',$code)->update("tr_penawaran",$data);			


			$numb1 =0;
			foreach($_POST['dt'] as $used){
				if(!empty($used['no_surat'])){
					$numb1++;   
					$dt[] =  array(
							'no_penawaran'		=> $code,
							'id_product'		=> $used['no_surat'],
							'nama_produk'	    => $used['nama_produk'],
							'qty'			    => $used['qty'],
							'harga_satuan'		=> str_replace(',','',$used['harga_satuan']),
							'stok_tersedia'		=> $used['stok_tersedia'],
							'potensial_loss'	=> $used['potensial_loss'],
							'diskon'		    => $used['diskon'],
							'freight_cost'		=> str_replace(',','',$used['freight_cost']),
							'total_harga'	    => str_replace(',','',$used['total_harga']),
							'revisi'			=> $norev,
							'created_on'		=> date('Y-m-d H:i:s'),
							'created_by'		=> $this->auth->user_id(),
							'nilai_diskon'      => str_replace(',','',$used['nilai_diskon']) ,
							'diskon_compare'    => $used['compare_diskon']							
							);
				}
			}
		 //    print_r($dt);
		 //    exit();
		 if($select2->num_rows())
		{
			$insert2 = $this->db->insert_batch('tr_penawaran_detail_history', $select2->result_array());

			$this->db->delete('tr_penawaran_detail',array('no_penawaran'=>$code));
			$this->db->insert_batch('tr_penawaran_detail',$dt);
		}

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

	public function statusSo($id)
    {
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-pencil');
		$aktif = 'active';
		$deleted = '0';
		$customers = $this->penawaran_model->get_data('master_customers','deleted',$deleted);
		$karyawan = $this->penawaran_model->get_data('ms_karyawan','deleted',$deleted);
		$mata_uang = $this->penawaran_model->get_data('mata_uang','deleted'.$deleted);
        $top       = $this->penawaran_model->get_data('ms_top','deleted'.$deleted);
		$header    = $this->penawaran_model->get_data('tr_penawaran','no_penawaran',$id);
		$detail    = $this->penawaran_model->get_data('tr_penawaran_detail','no_penawaran',$id);
		$data = [
			'customers' => $customers,
			'karyawan' => $karyawan,
			'mata_uang' => $mata_uang,
            'top' => $top,
			'header'=>$header,
			'detail'=>$detail,
		];

        $this->template->set('results', $data);
        $this->template->title('Ubah Status Penawaran');
        $this->template->render('statusso');

    }


	public function SaveStatusSo()
    {
        $this->auth->restrict($this->addPermission);
		$post = $this->input->post();
		$code		= $post['no_penawaran'];
		$no_surat	= $post['no_surat'];
		$this->db->trans_begin();
		$data = [
			'status'				=> 6,
			'delivered_on'			=> date('Y-m-d H:i:s'),
			'delivered_by'			=> $this->auth->user_id()
			];
			//Edit Data
          	$this->db->where('no_penawaran',$code)->update("tr_penawaran",$data);			


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

	public function statusLoss($id)
    {
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-pencil');
		$aktif = 'active';
		$deleted = '0';
		$customers = $this->penawaran_model->get_data('master_customers','deleted', Null);
		$karyawan = $this->penawaran_model->get_data('ms_employee','deleted',Null);
		$mata_uang = $this->penawaran_model->get_data('mata_uang','deleted'.$deleted);
        $top       = $this->penawaran_model->get_data('list_help', 'group_by', 'top invoice');
		$header    = $this->penawaran_model->get_data('tr_penawaran','no_penawaran',$id);
		$detail    = $this->penawaran_model->get_data('tr_penawaran_detail','no_penawaran',$id);
		$data = [
			'customers' => $customers,
			'karyawan' => $karyawan,
			'mata_uang' => $mata_uang,
            'top' => $top,
			'header'=>$header,
			'detail'=>$detail,
		];

        $this->template->set('results', $data);
        $this->template->title('Ubah Status Penawaran');
        $this->template->render('statusloss');

    }

	public function SaveStatusLoss()
    {
        $this->auth->restrict($this->addPermission);
		$post = $this->input->post();
		$code		= $post['no_penawaran'];
		$no_surat	= $post['no_surat'];

		
		$this->db->trans_begin();
		$data = [
			'status'				=> 7,
			'keterangan_loss'	    => $post['keterangan'],
			'delivered_on'			=> date('Y-m-d H:i:s'),
			'delivered_by'			=> $this->auth->user_id()
			];
			//Edit Data
          	$this->db->where('no_penawaran',$code)->update("tr_penawaran",$data);			


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
	public function viewhistory()
    {
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-pencil');
		$id = $this->uri->segment(3);
		$revisi = $this->uri->segment(4);
		$aktif = 'active';
		$deleted = '0';
		$customers = $this->penawaran_model->get_data('master_customers','deleted',$deleted);
		$karyawan = $this->penawaran_model->get_data('ms_employee','deleted',null);
		$mata_uang = $this->penawaran_model->get_data('mata_uang','deleted'.$deleted);
        $top       = $this->penawaran_model->get_data('ms_top','deleted'.$deleted);
		$header    = $this->penawaran_model->CariHeaderHistory($id,$revisi);
		$detail    = $this->penawaran_model->CariDetailHistory($id,$revisi);
		
				
		$data = [
			'customers' => $customers,
			'karyawan' => $karyawan,
			'mata_uang' => $mata_uang,
            'top' => $top,
			'header'=>$header,
			'detail'=>$detail,
		];

        $this->template->set('results', $data);
        $this->template->title('History Penawaran');
        $this->template->render('viewhistory');

    }

	public function viewhistoryso()
    {
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-pencil');
		$id = $this->uri->segment(3);
		$revisi = $this->uri->segment(4);
		$aktif = 'active';
		$deleted = '0';
		$customers = $this->penawaran_model->get_data('master_customers','deleted',null);
		$karyawan = $this->penawaran_model->get_data('ms_employee','deleted',null);
		$mata_uang = $this->penawaran_model->get_data('mata_uang','deleted'.$deleted);
        $top       = $this->penawaran_model->get_data('list_help', 'group_by', 'top invoice');
		$header    = $this->penawaran_model->CariHeaderHistoryso($id,$revisi);
		$detail    = $this->penawaran_model->CariDetailHistoryso($id,$revisi);
		
				
		$data = [
			'customers' => $customers,
			'karyawan' => $karyawan,
			'mata_uang' => $mata_uang,
            'top' => $top,
			'header'=>$header,
			'detail'=>$detail,
		];

        $this->template->set('results', $data);
        $this->template->title('History Penawaran');
        $this->template->render('viewhistory');

    }


	
	public function FormLoss($id)
    {
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-pencil');
	
		$data = [
			'id' => $id,
		];

        $this->template->set('results', $data);
        $this->template->title('Ubah Status');
        $this->template->render('formloss');

    }
	
	public function editPenawaranApprove($id)
    {
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-pencil');
		$aktif = 'active';
		$deleted = '0';
		$customers = $this->penawaran_model->get_data('master_customers','deleted',$deleted);
		$karyawan = $this->penawaran_model->get_data('ms_karyawan','deleted',$deleted);
		$mata_uang = $this->penawaran_model->get_data('mata_uang','deleted'.$deleted);
        $top       = $this->penawaran_model->get_data('ms_top','deleted'.$deleted);
		$header    = $this->penawaran_model->get_data('tr_penawaran','no_penawaran',$id);
		$detail    = $this->penawaran_model->get_data('tr_penawaran_detail','no_penawaran',$id);
		$data = [
			'customers' => $customers,
			'karyawan' => $karyawan,
			'mata_uang' => $mata_uang,
            'top' => $top,
			'header'=>$header,
			'detail'=>$detail,
		];

        $this->template->set('results', $data);
        $this->template->title('Edit Penawaran');
        $this->template->render('editpenawaranapprove');

    }
	
	public function lihatPenawaran($id)
    {
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-pencil');
		$aktif = 'active';
		$deleted = '0';
		$customers = $this->penawaran_model->get_data('master_customers','deleted',$deleted);
		$karyawan = $this->penawaran_model->get_data('ms_karyawan','deleted',$deleted);
		$mata_uang = $this->penawaran_model->get_data('mata_uang','deleted'.$deleted);
        $top       = $this->penawaran_model->get_data('ms_top','deleted'.$deleted);
		$header    = $this->penawaran_model->get_data('tr_penawaran','no_penawaran',$id);
		$detail    = $this->penawaran_model->get_data('tr_penawaran_detail','no_penawaran',$id);
		$data = [
			'customers' => $customers,
			'karyawan' => $karyawan,
			'mata_uang' => $mata_uang,
            'top' => $top,
			'header'=>$header,
			'detail'=>$detail,
		];

        $this->template->set('results', $data);
        $this->template->title('View Penawaran');
        $this->template->render('lihatpenawaran');

    }
}