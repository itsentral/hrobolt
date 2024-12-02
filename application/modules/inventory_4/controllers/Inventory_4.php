<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/*
 * @author Harboens
 * @copyright Copyright (c) 2022, Harboens
 *
 * This is controller for Master Deskripsi Produks
 */

class Inventory_4 extends Admin_Controller
{
    //Permission
    protected $viewPermission 	= 'Level_4.View';
    protected $addPermission  	= 'Level_4.Add';
    protected $managePermission = 'Level_4.Manage';
    protected $deletePermission = 'Level_4.Delete';

    public function __construct()
    {
        parent::__construct();

        $this->load->library(array('Mpdf', 'upload', 'Image_lib'));
        $this->load->model(array('Inventory_4/Inventory_4_model',
                                 'Aktifitas/aktifitas_model',
                                ));
        $this->template->title('Manage Data Supplier');
        $this->template->page_icon('fa fa-building-o');

        date_default_timezone_set('Asia/Bangkok');
    }
	
	public function index()
    {
		$id_bentuk = $this->uri->segment(3);
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-users');
		$deleted = '0';

        $data = $this->Inventory_4_model->get_data_category3();

        $this->template->set('results', $data);
        $this->template->title('Produk');
        $this->template->render('list');
    }

	public function addInventory()
    {
		$id = $this->input->post('id');

		if ($id) {
			$deleted = '0';
			$dataProduct = $this->db->query("SELECT * FROM ms_inventory_category3 WHERE id = $id")->row();
			$inventory_2 = $this->Inventory_4_model->get_data('ms_inventory_category1', ['deleted' => $deleted]);
			$inventory_3 = $this->Inventory_4_model->get_data('ms_inventory_category2', ['deleted' => $deleted]);
			$varian1 = $this->db->query("SELECT * FROM master_variasi WHERE parent_id IS NOT NULL AND name = '".$dataProduct->varian1 . "'")->row();
			$varian2 = $this->db->query("SELECT * FROM master_variasi WHERE parent_id IS NOT NULL AND name = '".$dataProduct->varian2 . "'")->row();
			$varian1 = $this->db->query("SELECT * FROM master_variasi WHERE parent_id = '".$varian1->parent_id."'")->result();
			$varian2 = $this->db->query("SELECT * FROM master_variasi WHERE parent_id = '".$varian2->parent_id."'")->result();
			$productImages = $this->Inventory_4_model->getProductImages($id);
		}	

		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-pencil');
		$deleted = '0';
		$inventory_1 = $this->Inventory_4_model->get_data('ms_inventory_type', ['deleted' => $deleted]);
		$satuanpacking = $this->Inventory_4_model->get_data('ms_satuan', ['deleted' => 'N', 'category' => 'packing']);
		$satuanmeasurement = $this->Inventory_4_model->get_data('ms_satuan', ['deleted' => 'N', 'category' => 'unit']);
		$variasi = $this->Inventory_4_model->get_data('master_variasi', ['parent_id' => null]);
		$rak = $this->Inventory_4_model->get_data('master_rak', ['status' => 'Aktif']);
		
		$data = [
			'inventory_1' => $inventory_1,
			'inventory_2' => $inventory_2,
			'inventory_3' => $inventory_3,
			'packings' => $satuanpacking,
			'measurements' => $satuanmeasurement,
			'variasi' => $variasi,
			'dataProduct' => $dataProduct,
			'varian1' => $varian1,
			'varian2' => $varian2,
			'productImages' => $productImages,
			'rak' => $rak
		];

		// return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($varian2));

        $this->template->set('results', $data);
        $this->template->title('Add Inventory');
        $this->template->render('form_inventory');
    }
	
	public function editInventory($id)
    {
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-pencil');
		$deleted = '0';
		$inventory_1 = $this->Inventory_4_model->get_data('ms_inventory_type', ['deleted' => $deleted]);
		$inventory_2 = $this->Inventory_4_model->get_data('ms_inventory_category1', ['deleted' => $deleted]);
		$inventory_3 = $this->Inventory_4_model->get_data('ms_inventory_category2', ['deleted' => $deleted]);
		$satuanpacking = $this->Inventory_4_model->get_data('ms_satuan', ['deleted' => 'N', 'category' => 'packing']);
		$satuanmeasurement = $this->Inventory_4_model->get_data('ms_satuan', ['deleted' => 'N', 'category' => 'unit']);
		$productdetail = $this->Inventory_4_model->getProduct($id);
		$productImages = $this->Inventory_4_model->getProductImages($id);
		$variasi = $this->Inventory_4_model->get_data('master_variasi', ['parent_id' => null]);
		$varian1 = $this->db->query("SELECT * FROM master_variasi WHERE parent_id IS NOT NULL AND name = '".$productdetail->varian1 . "'")->row();
		$varian2 = $this->db->query("SELECT * FROM master_variasi WHERE parent_id IS NOT NULL AND name = '".$productdetail->varian2 . "'")->row();
		$varian1 = $this->db->query("SELECT * FROM master_variasi WHERE parent_id = '".$varian1->parent_id."'")->result();
		$varian2 = $this->db->query("SELECT * FROM master_variasi WHERE parent_id = '".$varian2->parent_id."'")->result();
		$rak = $this->Inventory_4_model->get_data('master_rak', ['status' => 'Aktif']);
		$data = [
			'inventory_1' => $inventory_1,
			'inventory_2' => $inventory_2,
			'inventory_3' => $inventory_3,
			'product' => $productdetail,
			'productImages' => $productImages,
			'packings' => $satuanpacking,
			'measurements' => $satuanmeasurement,
			'variasi' => $variasi,
			'varian1' => $varian1,
			'varian2' => $varian2,
			'rak' => $rak
		];
        $this->template->set('results', $data);
        $this->template->title('Add Inventory');
		$this->template->render('edit_inventory');
    }

	public function viewInventory($id)
    {
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-pencil');
		$deleted = '0';
		$productdetail = $this->Inventory_4_model->getProduct($id);
		$data = [
			'product' => $productdetail,
		];
        $this->template->set('results', $data);
        $this->template->title('Add Inventory');
        $this->template->render('view_inventory');
    }

	public function tokopediaInventory($id)
    {
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-pencil');

		$productdetail = $this->Inventory_4_model->getProduct($id);
		$masterPengiriman = $this->db->query("SELECT * FROM master_pengiriman WHERE status = 'Aktif'")->result();
		$productTokopedia = $this->db->query("SELECT * FROM ms_inventory_category3_tokopedia WHERE product_id = $id")->row();

		$data['product'] = $productdetail;
		$data['pengiriman'] = $masterPengiriman;

		// return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($newDataKurir));

		if ($productTokopedia) {
			$dataPengiriman = explode(";", $productTokopedia->kurir_pengiriman);
			$dataPengirimanOrder = [];

			foreach ($masterPengiriman AS $value) {
				$dataPengirimanOrder[] = $value->code_tokopedia;
			}
			
			$dataKurirSynchronize = array_intersect($dataPengiriman, $dataPengirimanOrder);
			$dataKurir = implode(",", $dataKurirSynchronize);

			$newDataKurir = $this->db->query("SELECT * FROM master_pengiriman WHERE status = 'Aktif' AND code_tokopedia IN ($dataKurir)")->result();

			$data['dataKurir'] = $newDataKurir;
			$data['product_tokopedia'] = $productTokopedia;
		}

        $this->template->set('results', $data);
        $this->template->title('Tokopedia Inventory');
        $this->template->render('tokopedia_inventory');
    }

	public function barcodeSetting($id)
	{
		$dataProduct = $this->db->query("SELECT * FROM ms_inventory_category3 WHERE id = $id")->row();

		if ($dataProduct) {
			$response = [
				'code' => 200,
				'status' => 'OK',
				'data' => $dataProduct,
				'message' => 'Berhasil Ambil Data'
			];
		} else {
			$response = [
				'code' => 404,
				'status' => 'NOK',
				'message' => 'Gagal Ambil Data'
			];
		}

		return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($response));
	}

	public function saveImage()
	{
		$image = $_FILES['file']['name'];
		$id = $this->input->post('id');

        if (!empty($image)) {
			$imagePath = realpath(APPPATH . '../assets/uploads/barcode');

			$_FILES['userfile']['name'] = $_FILES['file']['name'];
			$_FILES['userfile']['type'] = $_FILES['file']['type'];
			$_FILES['userfile']['tmp_name'] = $_FILES['file']['tmp_name'];
			$_FILES['userfile']['error'] = $_FILES['file']['error'];
			$_FILES['userfile']['size'] = $_FILES['file']['size'];

			$config = array(
				'file_name' => $_FILES['file']['tmp_name'].time().uniqid(),
				'allowed_types' => 'jpg|jpeg|png|pdf',
				'max_size' => 5000,
				'overwrite' => false,
				'upload_path' => $imagePath
			);

			$this->upload->initialize($config);

			if (!$this->upload->do_upload()) {
				$error = array('error' => $this->upload->display_errors());
				$theImages[] = array(
					'code' => 404,
					'status' => 'NOK',
					'errors' => $error
				);

				return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($theImages));
			} else {
				$filename = $this->upload->data();
				$barcodefilename = '/assets/uploads/barcode/'.$filename['file_name'];

				$dataLabel = [
					'barcode' => $barcodefilename
				];

				$this->db->where('id', $id);
				$this->db->update('ms_inventory_category3', $dataLabel);

				$data = [
                    'success' => 'Upload Successfully',
                    'code' => 200,
                    'data' => $barcodefilename
                ];
                
                return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));
			}
        }
	}
		
	function get_inven2()
    {
        $inventory_1=$_GET['inventory_1'];
        $data=$this->Inventory_4_model->level_2($inventory_1);
        echo "<select id='inventory_2' name='hd1[1][inventory_2]' class='form-control onchange='get_inv3()'  input-sm select2'>";
        echo "<option value=''>--Pilih--</option>";
                foreach ($data as $key => $st) :
				      echo "<option value='$st->id|$st->nama|$st->sku_code' set_select('inventory_2', $st->id_category1, isset($data->id_category1) && $data->id_category1 == $st->id_category1)>$st->nama
                    </option>";
                endforeach;
        echo "</select>";
    }
		
	function get_inven3()
    {
        $id_type = $_GET['id_type'];
		$inventory_2 = $_GET['inventory_2'];
        $datalevel3 = $this->Inventory_4_model->level_3($id_type,$inventory_2);
		// $dataComposition = $this->Inventory_4_model->level_4($inventory_2);
		// print_r($data);
        // exit();
		
		$htmlDataLevel3 = "<select id='inventory_3' name='hd1[1][inventory_3]' class='form-control input-sm select2'>";
        $htmlDataLevel3 .= "<option value=''>--Pilih--</option>";
                foreach ($datalevel3 as $key => $st) :
				     $htmlDataLevel3 .= "<option value='$st->id|$st->nama|$st->sku_code' set_select('inventory_3', $st->id_category2, isset($st->id_category2) && $st->id_category2 == $st->id_category2)>$st->nama</option>";
                endforeach;
		$htmlDataLevel3 .= "</select>";

		// $htmlDataComposition = "<select id='inventory_4' name='hd1[1][inventory_4]' class='form-control input-sm select2'>";
		// $htmlDataComposition .= "<option value=''>--Pilih--</option>";
        //         foreach ($dataComposition as $key => $st) :
		// 		     $htmlDataComposition .= "<option value='$st->id' set_select('inventory_4', $st->id_category1, isset($st->id_category1) && $st->id_category1 == $st->id_category1)>$st->name_compotition</option>";
        //         endforeach;
		// $htmlDataComposition .= "</select>";

		$data = [
			'status' => 'OK',
			'code' => 200,
			'message' => 'Berhasil Ambil Data',
			'data' => [
				'htmllevel3' => $htmlDataLevel3,
				// 'htmldatacomposition' => $htmlDataComposition
			]
		];

		return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));
    }
	
	function get_inven4()
    {
        $inventory_3=$_GET['inventory_3'];
        $data=$this->Inventory_4_model->level_4($inventory_3);
		
        // print_r($data);
        // exit();
        echo "<select id='inventory_4' name='hd1[1][inventory_4]' class='form-control input-sm select2'>";
        echo "<option value=''>--Pilih--</option>";
                foreach ($data as $key => $st) :
				      echo "<option value='$st->varian' set_select('inventory_4', $st->varian, isset($data->varian) && $data->varian == $st->varian)>$st->nama
                    </option>";
                endforeach;
        echo "</select>";
    }

	public function get_varian1() 
	{
		$varian = $this->input->post('value');
		$id = $this->input->post('id');
		$data = $this->db->query("SELECT * FROM master_variasi WHERE parent_id='$id'")->result();

		$data = [
			'variasi' => $data
		];

		return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function saveInventory()
    {
        $this->auth->restrict($this->addPermission);
		$session = $this->session->userdata('app_session');

		$this->db->trans_begin();

		$id = $this->input->post("id");
		$varian1 = $this->input->post("varian1");
		$varian2 = $this->input->post("varian2");

		$id_type = explode('|', $this->input->post("id_type"));
		$id_category1 = explode('|', $this->input->post("id_category1"));
		$id_category2 = explode('|', $this->input->post("id_category2"));
		$id_type = $id_type[0];
		$id_category1 = $id_category1[0];
		$id_category2 = $id_category2[0];

		$nama = $this->input->post("nama");
		$namamarketplace = $this->input->post("nama_marketplace");
		$variasi1 = $this->input->post("variasi1");
		$variasi2 = $this->input->post("variasi2");
		$status = $this->input->post("status");
		$skuInduk = $this->input->post("sku_induk");
		$skuVarian = $this->input->post("sku_varian");
		$price = $this->input->post("harga");
		$deskripsi = $this->input->post("deskripsi");
		$panjang = $this->input->post("panjang");
		$tinggi = $this->input->post("tinggi");
		$lebar = $this->input->post("lebar");
		$berat = $this->input->post("berat");		
		$satuanberat = $this->input->post("beratsatuan");
		$satuanvolume = $this->input->post("satuanukur");
		$barangberbahaya = $this->input->post("barangberbahaya");
		$merk = $this->input->post("merk");
		$grade = $this->input->post("grade");
		$size = $this->input->post("size");
		$diameter = $this->input->post("diameter");
		$rak = $this->input->post("rak");
		// $barcode = $this->input->post("barcode");
		$sameday = ($this->input->post("sameday") == '') ? "Tidak Aktif" : $this->input->post("sameday");
		$nextday = ($this->input->post("nextday") == '') ? "Tidak Aktif" : $this->input->post("nextday");
		$reguler = ($this->input->post("reguler") == '') ? "Tidak Aktif" : $this->input->post("reguler");
		$hemat = ($this->input->post("hemat") == '') ? "Tidak Aktif" : $this->input->post("hemat");
		$kargo = ($this->input->post("kargo") == '') ? "Tidak Aktif" : $this->input->post("kargo");
		$preorder = ($this->input->post("preorder") == '') ? "Tidak Aktif" : $this->input->post("preorder");
		$idImages = $this->input->post("idproductimages");

		// return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($idImages));
		
		$numberOfUploads = count($_FILES['barcode']['name']);

		if ($numberOfUploads > 0) {
			$this->load->library('upload');
			$imagePath = realpath(APPPATH . '../assets/uploads/barcode');

			$_FILES['userfile']['name'] = $_FILES['barcode']['name'];
			$_FILES['userfile']['type'] = $_FILES['barcode']['type'];
			$_FILES['userfile']['tmp_name'] = $_FILES['barcode']['tmp_name'];
			$_FILES['userfile']['error'] = $_FILES['barcode']['error'];
			$_FILES['userfile']['size'] = $_FILES['barcode']['size'];

			$config = array(
				'file_name' => time().uniqid(),
				'allowed_types' => 'jpg|jpeg|png|pdf',
				'max_size' => 3000,
				'overwrite' => false,
				'upload_path' => $imagePath
			);

			$this->upload->initialize($config);
			
			// $errCount = 0;

			if (!$this->upload->do_upload()) {
				$error = array('error' => $this->upload->display_errors());
				$theImages[] = array(
					'errors' => $error
				);

				// return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($theImages));
			} else {
				$filename = $this->upload->data();
				$barcodefilename = '/assets/uploads/barcode/'.$filename['file_name'];
			}
		}
		
		$header1 =  array(
			'id_type'			=> $id_type,
			'id_category1'		=> $id_category1,
			'id_category2'		=> $id_category2,
			'varian1'			=> $varian1,
			'variasi1'			=> $variasi1,
			'varian2'			=> $varian2,
			'variasi2'			=> $variasi2,
			'nama'				=> $nama,
			'nama_marketplace'	=> $namamarketplace,
			'barcode'			=> $barcodefilename,
			'sku_induk'			=> $skuInduk,
			'sku_varian'		=> $skuVarian,
			'aktif'				=> $status,
			'price'				=> $price,
			'deskripsi'			=> $deskripsi,
			'panjang'			=> $panjang,
			'tinggi'			=> $tinggi,
			'lebar'				=> $lebar,
			'berat'				=> $berat,
			'diameter'			=> $diameter,
			'satuan_volume'		=> $satuanvolume,
			'satuan_berat'		=> $satuanberat,
			'barang_berbahaya'	=> $barangberbahaya,
			'sameday'			=> $sameday,
			'nextday'			=> $nextday,
			'reguler'			=> $reguler,
			'hemat'				=> $hemat,
			'kargo'				=> $kargo,
			'preorder'			=> $preorder,
			'size'				=> $size,
			'grade'				=> $grade,
			'merk'				=> $merk,
			'rak_id'			=> $rak,
			'created_on'		=> date('Y-m-d H:i:s'),
			'created_by'		=> $this->auth->user_id(),
			'deleted'			=> '0',
		);

		$this->db->insert('ms_inventory_category3', $header1);

		$productId = $this->db->insert_id();

		$numberOfUploads = count($_FILES['files']['name']);

		if ($numberOfUploads > 0) {
			$this->load->library('upload');
			$imagePath = realpath(APPPATH . '../assets/uploads');

			for ($i=0; $i < $numberOfUploads; $i++) {
				$_FILES['userfile']['name'] = $_FILES['files']['name'][$i];
				$_FILES['userfile']['type'] = $_FILES['files']['type'][$i];
				$_FILES['userfile']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
				$_FILES['userfile']['error'] = $_FILES['files']['error'][$i];
				$_FILES['userfile']['size'] = $_FILES['files']['size'][$i];

				$config = array(
					'file_name' => time().uniqid(),
					'allowed_types' => 'jpg|jpeg|png|gif',
					'max_size' => 3000,
					'overwrite' => false,
					'upload_path' => $imagePath
				);

				$this->upload->initialize($config);
				
				$errCount = 0;

				if (isset($idImages[$i])) {
					$dataImagesProduct = $this->db->query("SELECT * FROM ms_inventory_category3_images WHERE id = '" .$idImages[$i]. "'")->row();
					
					$params = [
						'foto_url' 		=> $dataImagesProduct->foto_url,
						'id_product' 	=> $productId,
						'created_at'	=> date('Y-m-d H:i:s'),
						'created_by'	=> $this->auth->user_id(),
					];

					// return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($params));
					$this->db->insert('ms_inventory_category3_images', $params);
				} else {
					if (!$this->upload->do_upload()) {
						$error = array('error' => $this->upload->display_errors());
						$theImages[] = array(
							'errors' => $error
						);
	
						break;
	
						// return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($theImages));
					} else {
						$filename = $this->upload->data();
						$theImages[] = array(
							'fileName' => $filename['file_name'],
						);
	
						$params = [
							'foto_url' 		=> '/assets/uploads/'.$filename['file_name'],
							'id_product' 	=> $productId,
							'created_at'	=> date('Y-m-d H:i:s'),
							'created_by'	=> $this->auth->user_id(),
						];
	
						// return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($params));
	
						$this->db->insert('ms_inventory_category3_images', $params);
					}
				}
			}
		}
			
			//  $stok =  array(
			// 		'varian'	 	=> $varian,
			// 		'qty'		        => 0,
			// 		'qty_book'		    => 0,
			// 		'qty_free'		    => 0,
			// 		'aktif'		        => 'Y',
			// 		'id_gudang'		    => 1,
			// 		'created_on'		=> date('Y-m-d H:i:s'),
			// 		'created_by'		=> $this->auth->user_id()
			// 	);
            
			// //Add Data
            // $this->db->insert('stock_material',$stok);
			
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$status	= array(
			  'pesan'		=>'Gagal Save Product. Thanks ...',
			  'code' => $id_bentuk,
			  'status'	=> 0
			);
		} else {
			$this->db->trans_commit();
			$status	= array(
			  'pesan'		=>'Success Save Product. Thanks ...',
			  'code' => $id_bentuk,
			  'status'	=> 1
			);			
		}		
  		echo json_encode($status);
    }

	public function saveEditInventory()
    {
        $this->auth->restrict($this->addPermission);
		$session = $this->session->userdata('app_session');

		$this->db->trans_begin();

		$id = $this->input->post("id");
		$varian1 = $this->input->post("varian1");
		$varian2 = $this->input->post("varian2");

		$dataProduct = $this->db->query("SELECT * FROM ms_inventory_category3 WHERE id = $id")->row();

		$id_type = explode('|', $this->input->post("id_type"));
		$id_category1 = explode('|', $this->input->post("id_category1"));
		$id_category2 = explode('|', $this->input->post("id_category2"));
		$id_type = $id_type[0];
		$id_category1 = $id_category1[0];
		$id_category2 = $id_category2[0];

		$nama = $this->input->post("nama");
		$namamarketplace = $this->input->post("nama_marketplace");
		// $barcode = $this->input->post("barcode");
		$variasi1 = $this->input->post("variasi1");
		$variasi2 = $this->input->post("variasi2");
		$status = $this->input->post("status");
		$skuInduk = $this->input->post("sku_induk");
		$skuVarian = $this->input->post("sku_varian");
		$price = $this->input->post("harga");
		$deskripsi = $this->input->post("deskripsi");
		$panjang = $this->input->post("panjang");
		$tinggi = $this->input->post("tinggi");
		$lebar = $this->input->post("lebar");		
		$berat = $this->input->post("berat");
		$merk = $this->input->post("merk");
		$grade = $this->input->post("grade");
		$size = $this->input->post("size");
		$diameter = $this->input->post("diameter");
		$satuanberat = $this->input->post("beratsatuan");
		$satuanvolume = $this->input->post("satuanukur");
		$barangberbahaya = $this->input->post("barangberbahaya");
		$sameday = ($this->input->post("sameday") == '') ? "Tidak Aktif" : $this->input->post("sameday");
		$nextday = ($this->input->post("nextday") == '') ? "Tidak Aktif" : $this->input->post("nextday");
		$reguler = ($this->input->post("reguler") == '') ? "Tidak Aktif" : $this->input->post("reguler");
		$hemat = ($this->input->post("hemat") == '') ? "Tidak Aktif" : $this->input->post("hemat");
		$kargo = ($this->input->post("kargo") == '') ? "Tidak Aktif" : $this->input->post("kargo");
		$preorder = ($this->input->post("preorder") == '') ? "Tidak Aktif" : $this->input->post("preorder");
		$idImages = $this->input->post("idproductimages");
		$rak = $this->input->post("rak");

		$barcodefilename = '';

		$dataAccessories = $this->db->query("SELECT * FROM accessories WHERE id_stock = '" . $dataProduct->sku_varian . "'")->row();
		
		if($id!=''){
			$numberOfUploads = count($_FILES['barcode']['name']);

			if ($numberOfUploads > 0) {
				$this->load->library('upload');
				$imagePath = realpath(APPPATH . '../assets/uploads/barcode');

				$_FILES['userfile']['name'] = $_FILES['barcode']['name'];
				$_FILES['userfile']['type'] = $_FILES['barcode']['type'];
				$_FILES['userfile']['tmp_name'] = $_FILES['barcode']['tmp_name'];
				$_FILES['userfile']['error'] = $_FILES['barcode']['error'];
				$_FILES['userfile']['size'] = $_FILES['barcode']['size'];

				$config = array(
					'file_name' => time().uniqid(),
					'allowed_types' => 'jpg|jpeg|png|gif',
					'max_size' => 3000,
					'overwrite' => false,
					'upload_path' => $imagePath
				);

				$this->upload->initialize($config);
				
				// $errCount = 0;

				if (!$this->upload->do_upload()) {
					$error = array('error' => $this->upload->display_errors());
					$theImages[] = array(
						'errors' => $error
					);

					// return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($theImages));
				} else {
					$filename = $this->upload->data();
					$barcodefilename = '/assets/uploads/barcode/'.$filename['file_name'];
				}
			}

			$barcodefilename = ($barcodefilename == '') ? $dataProduct->barcode : $barcodefilename;

			$header1 =  array(
				'id_type'			=> $id_type,
				'id_category1'		=> $id_category1,
				'id_category2'		=> $id_category2,
				'varian1'			=> $varian1,
				'variasi1'			=> $variasi1,
				'varian2'			=> $varian2,
				'variasi2'			=> $variasi2,
				'nama'				=> $nama,
				'nama_marketplace'	=> $namamarketplace,
				'sku_induk'			=> $skuInduk,
				'sku_varian'		=> $skuVarian,
				'barcode'			=> $barcodefilename,
				'aktif'				=> $status,
				'price'				=> $price,
				'deskripsi'			=> $deskripsi,
				'panjang'			=> $panjang,
				'tinggi'			=> $tinggi,
				'lebar'				=> $lebar,
				'berat'				=> $berat,
				'diameter'			=> $diameter,
				'satuan_volume'		=> $satuanvolume,
				'satuan_berat'		=> $satuanberat,
				'barang_berbahaya'	=> $barangberbahaya,
				'sameday'			=> $sameday,
				'nextday'			=> $nextday,
				'reguler'			=> $reguler,
				'hemat'				=> $hemat,
				'kargo'				=> $kargo,
				'merk'				=> $merk,
				'grade'				=> $grade,
				'size'				=> $size,
				'rak_id'			=> $rak,
				'preorder'			=> $preorder,
				'modified_on'		=> date('Y-m-d H:i:s'),
				'modified_by'		=> $this->auth->user_id(),
			);

			$this->db->where('id',$id)->update("ms_inventory_category3", $header1);

			$updateDataAccessories = [
				'id_stock' => $skuVarian
			];

			$this->db->where('id', $dataAccessories->id);
			$this->db->update('accessories', $updateDataAccessories);

			$numberOfUploads = count($_FILES['files']['name']);

			if ($numberOfUploads > 0) {
				$this->load->library('upload');
				$imagePath = realpath(APPPATH . '../assets/uploads');

				for ($i=0; $i < $numberOfUploads; $i++) {
					$_FILES['userfile']['name'] = $_FILES['files']['name'][$i];
					$_FILES['userfile']['type'] = $_FILES['files']['type'][$i];
					$_FILES['userfile']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
					$_FILES['userfile']['error'] = $_FILES['files']['error'][$i];
					$_FILES['userfile']['size'] = $_FILES['files']['size'][$i];

					$config = array(
						'file_name' => time().uniqid(),
						'allowed_types' => 'jpg|jpeg|png|gif',
						'max_size' => 3000,
						'overwrite' => false,
						'upload_path' => $imagePath
					);

					$this->upload->initialize($config);
					
					$errCount = 0;

					$idImage = ($idImages[$i] == '') ? 0 : $idImages[$i];

					if ($idImage) {
						if ($_FILES['userfile']['name'] && $_FILES['userfile']['type']) {
							if (!$this->upload->do_upload()) {
								$error = array('error' => $this->upload->display_errors());
								$theImages[] = array(
									'errors' => $error
								);
		
								break;
		
							} else {
								$filename = $this->upload->data();
								$theImages[] = array(
									'fileName' => $filename['file_name'],
								);

								$params = [
									'foto_url' 		=> '/assets/uploads/'.$filename['file_name'],
									'id_product' 	=> $id,
									'created_at'	=> date('Y-m-d H:i:s'),
									'created_by'	=> $this->auth->user_id(),
								];

								$this->db->update('ms_inventory_category3_images', $params, array('id' => $idImage));
							}
						}
					} else {
						if (!$this->upload->do_upload()) {
							$error = array('error' => $this->upload->display_errors());
							$theImages[] = array(
								'errors' => $error
							);
	
							break;
						} else {
							$filename = $this->upload->data();
							$theImages[] = array(
								'fileName' => $filename['file_name'],
							);
	
							$params = [
								'foto_url' 		=> '/assets/uploads/'.$filename['file_name'],
								'id_product' 	=> $id,
								'created_at'	=> date('Y-m-d H:i:s'),
								'created_by'	=> $this->auth->user_id(),
							];
	
							// return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($idImage));
	
							$this->db->insert('ms_inventory_category3_images', $params);
						}
					}
				}
			}

		} 
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$status	= array(
			  'pesan'		=>'Gagal Save Product. Thanks ...',
			  'code' => $id_bentuk,
			  'status'	=> 0
			);
		} else {
			$this->db->trans_commit();
			$status	= array(
			  'pesan'		=>'Success Save Product. Thanks ...',
			  'code' => $id_bentuk,
			  'status'	=> 1
			);			
		}

  		echo json_encode($status);
    }

	public function saveTokopediaInventory()
    {
        $this->auth->restrict($this->addPermission);
		$session = $this->session->userdata('app_session');

		$this->db->trans_begin();

		$product_id = $this->input->post("id");
		$product_tokopedia_id = $this->input->post("id_product_tokopedia");
		$minimum_order = $this->input->post("minimum_order");
		$kondisi = $this->input->post("kondisi");

		$waktu_proses_order = $this->input->post("waktu_proses_order");
		$asuransi_pengiriman = $this->input->post("asuransi_pengiriman");
		$kurir_pengiriman = $this->input->post("kurir_pengiriman");
		if ($kurir_pengiriman) {
			$kurir_pengiriman = implode(";", $kurir_pengiriman);
		}
		// return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($kurir_pengiriman));
		
		if ($product_tokopedia_id) {
			if ($kurir_pengiriman) {
				$header1 =  array(
					'product_id' 			=> $product_id,
					'minimum_order'			=> $minimum_order,
					'kondisi'				=> $kondisi,
					'waktu_proses_order'	=> $waktu_proses_order,
					'asuransi_pengiriman'	=> $asuransi_pengiriman,
					'kurir_pengiriman'		=> $kurir_pengiriman,
					'created_at'			=> date('Y-m-d H:i:s'),
					'created_by'			=> $this->auth->user_id(),
				);
			} else {
				$header1 =  array(
					'product_id' 			=> $product_id,
					'minimum_order'			=> $minimum_order,
					'kondisi'				=> $kondisi,
					'waktu_proses_order'	=> $waktu_proses_order,
					'asuransi_pengiriman'	=> $asuransi_pengiriman,
					'created_at'			=> date('Y-m-d H:i:s'),
					'created_by'			=> $this->auth->user_id(),
				);
			}

			$this->db->where('id', $product_tokopedia_id);
			$this->db->update('ms_inventory_category3_tokopedia', $header1);
		} else {
			$header1 =  array(
				'product_id' 			=> $product_id,
				'minimum_order'			=> $minimum_order,
				'kondisi'				=> $kondisi,
				'waktu_proses_order'	=> $waktu_proses_order,
				'asuransi_pengiriman'	=> $asuransi_pengiriman,
				'kurir_pengiriman'		=> $kurir_pengiriman,
				'created_at'			=> date('Y-m-d H:i:s'),
				'created_by'			=> $this->auth->user_id(),
			);
	
			$this->db->insert('ms_inventory_category3_tokopedia', $header1);	
		}
			
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$status	= array(
			  'pesan' =>'Gagal Save Product. Thanks ...',
			  'code' => 404,
			  'status'	=> 0
			);
		} else {
			$this->db->trans_commit();
			$status	= array(
			  'pesan' =>'Success Save Product. Thanks ...',
			  'code' => 200,
			  'status'	=> 1
			);
		}		
  		echo json_encode($status);
    }

	public function exportExcelShopee()
	{
		include APPPATH . 'libraries/PHPExcel.php';

		$excel = new PHPExcel();

		$excel->getProperties()->setCreator("Hiro Bolt")
							->setLastModifiedBy("Hiro Bolt")
							->setTitle("Data Import Produk Shopee")
							->setSubject("Data")
							->setDescription("Data yang akan di Import ke Shopee")
							->setKeywords("Data Produk");
		
		$style_col = [
			'font' => [
				'bold' => true,
				'color' => array('rgb' => 'FFFFFF'),
				'size'  => 10,
				'name'  => 'Arial'
			],
			'alignment' => [
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
			],
			'fill' => [
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => [
					'rgb' => 'ED7D31'
				]
			]
		];

		$style_row = [
			'alignment' => [
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
			],
			'borders' => [
				'top' => [
					'style' => PHPExcel_Style_Border::BORDER_THIN
				],
				'right' => [
					'style' => PHPExcel_Style_Border::BORDER_THIN
				],
				'bottom' => [
					'style' => PHPExcel_Style_Border::BORDER_THIN
				],
				'left' => [
					'style' => PHPExcel_Style_Border::BORDER_THIN
				],
			]
		];

		$excel->getActiveSheet()->getDefaultColumnDimension()->setWidth(12);
		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(20);
		$excel->getDefaultStyle()->applyFromArray(
			array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
				)
			)
		);

		$excel->setActiveSheetIndex(0)->setCellValue('A1', "Kategori");     
		$excel->setActiveSheetIndex(0)->setCellValue('B1', "Nama Produk");     
		$excel->setActiveSheetIndex(0)->setCellValue('C1', "Deskripsi Produk");     
		$excel->setActiveSheetIndex(0)->setCellValue('D1', "SKU Induk");
		$excel->setActiveSheetIndex(0)->setCellValue('E1', "Produk Berbahaya");     
		$excel->setActiveSheetIndex(0)->setCellValue('F1', "Kode Integrasi Variasi");     
		$excel->setActiveSheetIndex(0)->setCellValue('G1', "Nama Variasi 1");     
		$excel->setActiveSheetIndex(0)->setCellValue('H1', "Varian untuk Variasi 1");
		$excel->setActiveSheetIndex(0)->setCellValue('I1', "Foto Produk per Varian");     
		$excel->setActiveSheetIndex(0)->setCellValue('J1', "Nama Variasi 2");     
		$excel->setActiveSheetIndex(0)->setCellValue('K1', "Varian untuk Variasi 2");     
		$excel->setActiveSheetIndex(0)->setCellValue('L1', "Harga");
		$excel->setActiveSheetIndex(0)->setCellValue('M1', "Stok");     
		$excel->setActiveSheetIndex(0)->setCellValue('N1', "Kode Variasi");     
		$excel->setActiveSheetIndex(0)->setCellValue('O1', "Panduan Ukuran");     
		$excel->setActiveSheetIndex(0)->setCellValue('P1', "Foto Sampul");
		$excel->setActiveSheetIndex(0)->setCellValue('Q1', "Foto Produk 1");     
		$excel->setActiveSheetIndex(0)->setCellValue('R1', "Foto Produk 2");     
		$excel->setActiveSheetIndex(0)->setCellValue('S1', "Foto Produk 3");     
		$excel->setActiveSheetIndex(0)->setCellValue('T1', "Foto Produk 4");
		$excel->setActiveSheetIndex(0)->setCellValue('U1', "Foto Produk 5");     
		$excel->setActiveSheetIndex(0)->setCellValue('V1', "Foto Produk 6");
		$excel->setActiveSheetIndex(0)->setCellValue('W1', "Foto Produk 7");     
		$excel->setActiveSheetIndex(0)->setCellValue('X1', "Foto Produk 8");     
		$excel->setActiveSheetIndex(0)->setCellValue('Y1', "Berat");     
		$excel->setActiveSheetIndex(0)->setCellValue('Z1', "Panjang");
		$excel->setActiveSheetIndex(0)->setCellValue('AA1', "Lebar");
		$excel->setActiveSheetIndex(0)->setCellValue('AB1', "Tinggi");     
		$excel->setActiveSheetIndex(0)->setCellValue('AC1', "Same Day");     
		$excel->setActiveSheetIndex(0)->setCellValue('AD1', "Next Day");     
		$excel->setActiveSheetIndex(0)->setCellValue('AE1', "Reguler (Cashless)");
		$excel->setActiveSheetIndex(0)->setCellValue('AF1', "Hemat");     
		$excel->setActiveSheetIndex(0)->setCellValue('AG1', "Kargo");     
		$excel->setActiveSheetIndex(0)->setCellValue('AH1', "Dikirim Dalam Pre-order");

		$excel->getActiveSheet()->mergeCells('A1:A3');
		$excel->getActiveSheet()->mergeCells('B1:B3');
		$excel->getActiveSheet()->mergeCells('C1:C3');
		$excel->getActiveSheet()->mergeCells('D1:D3');
		$excel->getActiveSheet()->mergeCells('E1:E3');
		$excel->getActiveSheet()->mergeCells('F1:F3');
		$excel->getActiveSheet()->mergeCells('G1:G3');
		$excel->getActiveSheet()->mergeCells('H1:H3');
		$excel->getActiveSheet()->mergeCells('I1:I3');
		$excel->getActiveSheet()->mergeCells('J1:J3');
		$excel->getActiveSheet()->mergeCells('K1:K3');
		$excel->getActiveSheet()->mergeCells('L1:L3');
		$excel->getActiveSheet()->mergeCells('M1:M3');
		$excel->getActiveSheet()->mergeCells('N1:N3');
		$excel->getActiveSheet()->mergeCells('O1:O3');
		$excel->getActiveSheet()->mergeCells('P1:P3');
		$excel->getActiveSheet()->mergeCells('Q1:Q3');
		$excel->getActiveSheet()->mergeCells('R1:R3');
		$excel->getActiveSheet()->mergeCells('S1:S3');
		$excel->getActiveSheet()->mergeCells('T1:T3');
		$excel->getActiveSheet()->mergeCells('U1:U3');
		$excel->getActiveSheet()->mergeCells('V1:V3');
		$excel->getActiveSheet()->mergeCells('W1:W3');
		$excel->getActiveSheet()->mergeCells('X1:X3');
		$excel->getActiveSheet()->mergeCells('Y1:Y3');
		$excel->getActiveSheet()->mergeCells('Z1:Z3');
		$excel->getActiveSheet()->mergeCells('AA1:AA3');
		$excel->getActiveSheet()->mergeCells('AB1:AB3');
		$excel->getActiveSheet()->mergeCells('AC1:AC3');
		$excel->getActiveSheet()->mergeCells('AD1:AD3');
		$excel->getActiveSheet()->mergeCells('AE1:AE3');
		$excel->getActiveSheet()->mergeCells('AF1:AF3');
		$excel->getActiveSheet()->mergeCells('AG1:AG3');
		$excel->getActiveSheet()->mergeCells('AH1:AH3');

		$excel->getActiveSheet()->getStyle('A1:A3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('B1:B3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('C1:C3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('D1:D3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('E1:E3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('F1:F3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('G1:G3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('H1:H3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('I1:I3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('J1:J3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('K1:K3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('L1:L3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('M1:M3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('N1:N3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('O1:O3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('P1:P3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('Q1:Q3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('R1:R3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('S1:S3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('T1:T3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('U1:U3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('V1:V3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('W1:W3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('X1:X3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('Y1:Y3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('Z1:Z3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('AA1:AA3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('AB1:AB3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('AC1:AC3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('AD1:AD3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('AE1:AE3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('AF1:AF3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('AG1:AG3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('AH1:AH3')->getAlignment()->setWrapText(true);

		$excel->getActiveSheet()->getStyle('A1')->applyFromArray($style_col);    
		$excel->getActiveSheet()->getStyle('B1')->applyFromArray($style_col);    
		$excel->getActiveSheet()->getStyle('C1')->applyFromArray($style_col);   
		$excel->getActiveSheet()->getStyle('D1')->applyFromArray($style_col);    
		$excel->getActiveSheet()->getStyle('E1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('F1')->applyFromArray($style_col);    
		$excel->getActiveSheet()->getStyle('G1')->applyFromArray($style_col);    
		$excel->getActiveSheet()->getStyle('H1')->applyFromArray($style_col);   
		$excel->getActiveSheet()->getStyle('I1')->applyFromArray($style_col);    
		$excel->getActiveSheet()->getStyle('J1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('K1')->applyFromArray($style_col);    
		$excel->getActiveSheet()->getStyle('L1')->applyFromArray($style_col);    
		$excel->getActiveSheet()->getStyle('M1')->applyFromArray($style_col);   
		$excel->getActiveSheet()->getStyle('N1')->applyFromArray($style_col);    
		$excel->getActiveSheet()->getStyle('O1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('P1')->applyFromArray($style_col);    
		$excel->getActiveSheet()->getStyle('Q1')->applyFromArray($style_col);    
		$excel->getActiveSheet()->getStyle('R1')->applyFromArray($style_col);   
		$excel->getActiveSheet()->getStyle('S1')->applyFromArray($style_col);    
		$excel->getActiveSheet()->getStyle('T1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('U1')->applyFromArray($style_col);    
		$excel->getActiveSheet()->getStyle('V1')->applyFromArray($style_col);    
		$excel->getActiveSheet()->getStyle('W1')->applyFromArray($style_col);   
		$excel->getActiveSheet()->getStyle('X1')->applyFromArray($style_col);    
		$excel->getActiveSheet()->getStyle('Y1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('Z1')->applyFromArray($style_col);    
		$excel->getActiveSheet()->getStyle('AA1')->applyFromArray($style_col);    
		$excel->getActiveSheet()->getStyle('AB1')->applyFromArray($style_col);   
		$excel->getActiveSheet()->getStyle('AC1')->applyFromArray($style_col);    
		$excel->getActiveSheet()->getStyle('AD1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AE1')->applyFromArray($style_col);    
		$excel->getActiveSheet()->getStyle('AF1')->applyFromArray($style_col);    
		$excel->getActiveSheet()->getStyle('AG1')->applyFromArray($style_col);   
		$excel->getActiveSheet()->getStyle('AH1')->applyFromArray($style_col);    

		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(27.86);    
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(52.57);    
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(66);    
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(28);   
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(28.14);
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(28);    
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(19.29);    
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(19.29);    
		$excel->getActiveSheet()->getColumnDimension('I')->setWidth(19.29);   
		$excel->getActiveSheet()->getColumnDimension('J')->setWidth(19.29);
		$excel->getActiveSheet()->getColumnDimension('K')->setWidth(19.29);    
		$excel->getActiveSheet()->getColumnDimension('L')->setWidth(19.29);    
		$excel->getActiveSheet()->getColumnDimension('M')->setWidth(19.29);    
		$excel->getActiveSheet()->getColumnDimension('N')->setWidth(19.29);   
		$excel->getActiveSheet()->getColumnDimension('O')->setWidth(19.29);
		$excel->getActiveSheet()->getColumnDimension('P')->setWidth(47);    
		$excel->getActiveSheet()->getColumnDimension('Q')->setWidth(19.29);    
		$excel->getActiveSheet()->getColumnDimension('R')->setWidth(19.29);    
		$excel->getActiveSheet()->getColumnDimension('S')->setWidth(19.29);   
		$excel->getActiveSheet()->getColumnDimension('T')->setWidth(19.29);
		$excel->getActiveSheet()->getColumnDimension('U')->setWidth(19.29);    
		$excel->getActiveSheet()->getColumnDimension('V')->setWidth(19.29);    
		$excel->getActiveSheet()->getColumnDimension('W')->setWidth(19.29);    
		$excel->getActiveSheet()->getColumnDimension('X')->setWidth(19.29);   
		$excel->getActiveSheet()->getColumnDimension('Y')->setWidth(19.29);
		$excel->getActiveSheet()->getColumnDimension('Z')->setWidth(19.29);    
		$excel->getActiveSheet()->getColumnDimension('AA')->setWidth(19.29);    
		$excel->getActiveSheet()->getColumnDimension('AB')->setWidth(19.29);   
		$excel->getActiveSheet()->getColumnDimension('AC')->setWidth(19.29);
		$excel->getActiveSheet()->getColumnDimension('AD')->setWidth(19.29);    
		$excel->getActiveSheet()->getColumnDimension('AE')->setWidth(19.29);   
		$excel->getActiveSheet()->getColumnDimension('AF')->setWidth(19.29);
		$excel->getActiveSheet()->getColumnDimension('AG')->setWidth(19.29);   
		$excel->getActiveSheet()->getColumnDimension('AH')->setWidth(19.29);

		$datas = $this->Inventory_4_model->getProductAll();

		$numrow = 4;
		foreach($datas AS $data) {
			$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $data->marketplace_category);     
			$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->nama_marketplace);      
			$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->deskripsi);      
			$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->sku_induk);     
			$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, ($data->barang_berbahaya == 0) ? 'No (ID)' : 'Yes (ID)');
			$excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data->sku_varian);
			$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data->variasi1);
			$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data->varian1);
			$excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, "");
			$excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $data->variasi2);
			$excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, $data->varian2);
			$excel->setActiveSheetIndex(0)->setCellValue('L'.$numrow, $data->price);
			$excel->setActiveSheetIndex(0)->setCellValue('M'.$numrow, 0);
			$excel->setActiveSheetIndex(0)->setCellValue('N'.$numrow, "");
			$excel->setActiveSheetIndex(0)->setCellValue('O'.$numrow, "");
			
			$dataImages = $this->db->query("SELECT * FROM ms_inventory_category3_images WHERE id_product = $data->id")->result();
			$dataAbjad = 80;
			foreach ($dataImages AS $image) {
				$excel->setActiveSheetIndex(0)->setCellValue(chr($dataAbjad).$numrow, "https://sentral.dutastudy.com/hirobolt" . $image->foto_url);
				$dataAbjad++;
			}

			$excel->setActiveSheetIndex(0)->setCellValue('Y'.$numrow, $data->berat);
			$excel->setActiveSheetIndex(0)->setCellValue('Z'.$numrow, $data->panjang);
			$excel->setActiveSheetIndex(0)->setCellValue('AA'.$numrow, $data->lebar);
			$excel->setActiveSheetIndex(0)->setCellValue('AB'.$numrow, $data->tinggi);
			$excel->setActiveSheetIndex(0)->setCellValue('AC'.$numrow, $data->sameday);
			$excel->setActiveSheetIndex(0)->setCellValue('AD'.$numrow, $data->nextday);
			$excel->setActiveSheetIndex(0)->setCellValue('AE'.$numrow, $data->reguler);
			$excel->setActiveSheetIndex(0)->setCellValue('AF'.$numrow, $data->hemat);
			$excel->setActiveSheetIndex(0)->setCellValue('AG'.$numrow, $data->kargo);
			$excel->setActiveSheetIndex(0)->setCellValue('AH'.$numrow, $data->preorder);
			$numrow++;
		}

		$excel->getActiveSheet(0)->setTitle("Template");
		// $excel->setActiveSheetIndex(0);
		ob_end_clean();
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');    
		header('Content-Disposition: attachment; filename="HiroBolt - Data Import Produk Excel Shoope.xlsx"');   
		header('Cache-Control: max-age=0');

		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	}

	public function exportExcelTikTok()
	{
		include APPPATH . 'libraries/PHPExcel.php';

		$excel = new PHPExcel();

		$excel->getProperties()->setCreator("Hiro Bolt")
							->setLastModifiedBy("Hiro Bolt")
							->setTitle("Data Import Produk TikTok")
							->setSubject("Data")
							->setDescription("Data yang akan di Import ke TikTok")
							->setKeywords("Data Produk");
		
		$style_col = [
			'font' => [
				'bold' => true,
				'color' => array('rgb' => 'FFFFFF'),
				'size'  => 10,
				'name'  => 'Times New Roman'
			],
			'alignment' => [
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
			],
			'fill' => [
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => [
					'rgb' => '000000'
				]
			]
		];

		$style_row = [
			'alignment' => [
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
			],
			'borders' => [
				'top' => [
					'style' => PHPExcel_Style_Border::BORDER_THIN
				],
				'right' => [
					'style' => PHPExcel_Style_Border::BORDER_THIN
				],
				'bottom' => [
					'style' => PHPExcel_Style_Border::BORDER_THIN
				],
				'left' => [
					'style' => PHPExcel_Style_Border::BORDER_THIN
				],
			]
		];

		$excel->getActiveSheet()->getDefaultColumnDimension()->setWidth(12);
		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(20);
		$excel->getDefaultStyle()->applyFromArray(
			array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
				)
			)
		);

		$excel->setActiveSheetIndex(0)->setCellValue('A1', "Kategori");     
		$excel->setActiveSheetIndex(0)->setCellValue('B1', "Merek");     
		$excel->setActiveSheetIndex(0)->setCellValue('C1', "Nama Produk");     
		$excel->setActiveSheetIndex(0)->setCellValue('D1', "Deskripsi Produk");
		$excel->setActiveSheetIndex(0)->setCellValue('E1', "Gambar Produk Utama");     
		$excel->setActiveSheetIndex(0)->setCellValue('F1', "Gambar Produk 2");     
		$excel->setActiveSheetIndex(0)->setCellValue('G1', "Gambar Produk 3");     
		$excel->setActiveSheetIndex(0)->setCellValue('H1', "Gambar Produk 4");
		$excel->setActiveSheetIndex(0)->setCellValue('I1', "Gambar Produk 5");     
		$excel->setActiveSheetIndex(0)->setCellValue('J1', "Gambar Produk 6");     
		$excel->setActiveSheetIndex(0)->setCellValue('K1', "Gambar Produk 7");     
		$excel->setActiveSheetIndex(0)->setCellValue('L1', "Gambar Produk 8");
		$excel->setActiveSheetIndex(0)->setCellValue('M1', "Gambar Produk 9");     
		$excel->setActiveSheetIndex(0)->setCellValue('N1', "Varian 1");     
		$excel->setActiveSheetIndex(0)->setCellValue('O1', "Varian 2");     
		$excel->setActiveSheetIndex(0)->setCellValue('P1', "Gambar Varian");
		$excel->setActiveSheetIndex(0)->setCellValue('Q1', "Berat Paket(g)");     
		$excel->setActiveSheetIndex(0)->setCellValue('R1', "Panjang Paket(cm)");     
		$excel->setActiveSheetIndex(0)->setCellValue('S1', "Lebar Paket(cm)");     
		$excel->setActiveSheetIndex(0)->setCellValue('T1', "Tinggi Paket(cm)");
		$excel->setActiveSheetIndex(0)->setCellValue('U1', "Opsi Pengiriman");     
		$excel->setActiveSheetIndex(0)->setCellValue('V1', "Harga Ritel (Mata Uang Lokal)");
		$excel->setActiveSheetIndex(0)->setCellValue('W1', "Kuantitas");     
		$excel->setActiveSheetIndex(0)->setCellValue('X1', "SKU Penjual");     
		$excel->setActiveSheetIndex(0)->setCellValue('Y1', "Bagan Ukuran");     
		$excel->setActiveSheetIndex(0)->setCellValue('Z1', "Jenis Garansi");
		$excel->setActiveSheetIndex(0)->setCellValue('AA1', "Bentuk Produk");
		$excel->setActiveSheetIndex(0)->setCellValue('AB1', "Tipe Alat Suspensi & Kemudi");     
		$excel->setActiveSheetIndex(0)->setCellValue('AC1', "Tipe Alat Pengukur");     
		$excel->setActiveSheetIndex(0)->setCellValue('AD1', "Tipe Perkakas Tangan");     
		$excel->setActiveSheetIndex(0)->setCellValue('AE1', "Jenis Penerangan Lampu");
		$excel->setActiveSheetIndex(0)->setCellValue('AF1', "Tipe Semir & Lilin");     
		$excel->setActiveSheetIndex(0)->setCellValue('AG1', "Posisi");     
		$excel->setActiveSheetIndex(0)->setCellValue('AH1', "Display (Tampilan)");
		$excel->setActiveSheetIndex(0)->setCellValue('AI1', "Bahan");     
		$excel->setActiveSheetIndex(0)->setCellValue('AJ1', "Sertifikat SNI");

		$excel->getActiveSheet()->mergeCells('A1:A3');
		$excel->getActiveSheet()->mergeCells('B1:B3');
		$excel->getActiveSheet()->mergeCells('C1:C3');
		$excel->getActiveSheet()->mergeCells('D1:D3');
		$excel->getActiveSheet()->mergeCells('E1:E3');
		$excel->getActiveSheet()->mergeCells('F1:F3');
		$excel->getActiveSheet()->mergeCells('G1:G3');
		$excel->getActiveSheet()->mergeCells('H1:H3');
		$excel->getActiveSheet()->mergeCells('I1:I3');
		$excel->getActiveSheet()->mergeCells('J1:J3');
		$excel->getActiveSheet()->mergeCells('K1:K3');
		$excel->getActiveSheet()->mergeCells('L1:L3');
		$excel->getActiveSheet()->mergeCells('M1:M3');
		$excel->getActiveSheet()->mergeCells('N1:N3');
		$excel->getActiveSheet()->mergeCells('O1:O3');
		$excel->getActiveSheet()->mergeCells('P1:P3');
		$excel->getActiveSheet()->mergeCells('Q1:Q3');
		$excel->getActiveSheet()->mergeCells('R1:R3');
		$excel->getActiveSheet()->mergeCells('S1:S3');
		$excel->getActiveSheet()->mergeCells('T1:T3');
		$excel->getActiveSheet()->mergeCells('U1:U3');
		$excel->getActiveSheet()->mergeCells('V1:V3');
		$excel->getActiveSheet()->mergeCells('W1:W3');
		$excel->getActiveSheet()->mergeCells('X1:X3');
		$excel->getActiveSheet()->mergeCells('Y1:Y3');
		$excel->getActiveSheet()->mergeCells('Z1:Z3');
		$excel->getActiveSheet()->mergeCells('AA1:AA3');
		$excel->getActiveSheet()->mergeCells('AB1:AB3');
		$excel->getActiveSheet()->mergeCells('AC1:AC3');
		$excel->getActiveSheet()->mergeCells('AD1:AD3');
		$excel->getActiveSheet()->mergeCells('AE1:AE3');
		$excel->getActiveSheet()->mergeCells('AF1:AF3');
		$excel->getActiveSheet()->mergeCells('AG1:AG3');
		$excel->getActiveSheet()->mergeCells('AH1:AH3');
		$excel->getActiveSheet()->mergeCells('AI1:AI3');
		$excel->getActiveSheet()->mergeCells('AJ1:AJ3');

		$excel->getActiveSheet()->getStyle('A1:A3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('B1:B3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('C1:C3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('D1:D3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('E1:E3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('F1:F3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('G1:G3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('H1:H3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('I1:I3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('J1:J3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('K1:K3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('L1:L3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('M1:M3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('N1:N3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('O1:O3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('P1:P3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('Q1:Q3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('R1:R3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('S1:S3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('T1:T3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('U1:U3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('V1:V3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('W1:W3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('X1:X3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('Y1:Y3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('Z1:Z3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('AA1:AA3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('AB1:AB3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('AC1:AC3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('AD1:AD3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('AE1:AE3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('AF1:AF3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('AG1:AG3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('AH1:AH3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('AI1:AI3')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('AJ1:AJ3')->getAlignment()->setWrapText(true);

		$excel->getActiveSheet()->getStyle('A1')->applyFromArray($style_col);    
		$excel->getActiveSheet()->getStyle('B1')->applyFromArray($style_col);    
		$excel->getActiveSheet()->getStyle('C1')->applyFromArray($style_col);   
		$excel->getActiveSheet()->getStyle('D1')->applyFromArray($style_col);    
		$excel->getActiveSheet()->getStyle('E1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('F1')->applyFromArray($style_col);    
		$excel->getActiveSheet()->getStyle('G1')->applyFromArray($style_col);    
		$excel->getActiveSheet()->getStyle('H1')->applyFromArray($style_col);   
		$excel->getActiveSheet()->getStyle('I1')->applyFromArray($style_col);    
		$excel->getActiveSheet()->getStyle('J1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('K1')->applyFromArray($style_col);    
		$excel->getActiveSheet()->getStyle('L1')->applyFromArray($style_col);    
		$excel->getActiveSheet()->getStyle('M1')->applyFromArray($style_col);   
		$excel->getActiveSheet()->getStyle('N1')->applyFromArray($style_col);    
		$excel->getActiveSheet()->getStyle('O1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('P1')->applyFromArray($style_col);    
		$excel->getActiveSheet()->getStyle('Q1')->applyFromArray($style_col);    
		$excel->getActiveSheet()->getStyle('R1')->applyFromArray($style_col);   
		$excel->getActiveSheet()->getStyle('S1')->applyFromArray($style_col);    
		$excel->getActiveSheet()->getStyle('T1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('U1')->applyFromArray($style_col);    
		$excel->getActiveSheet()->getStyle('V1')->applyFromArray($style_col);    
		$excel->getActiveSheet()->getStyle('W1')->applyFromArray($style_col);   
		$excel->getActiveSheet()->getStyle('X1')->applyFromArray($style_col);    
		$excel->getActiveSheet()->getStyle('Y1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('Z1')->applyFromArray($style_col);    
		$excel->getActiveSheet()->getStyle('AA1')->applyFromArray($style_col);    
		$excel->getActiveSheet()->getStyle('AB1')->applyFromArray($style_col);   
		$excel->getActiveSheet()->getStyle('AC1')->applyFromArray($style_col);    
		$excel->getActiveSheet()->getStyle('AD1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AE1')->applyFromArray($style_col);    
		$excel->getActiveSheet()->getStyle('AF1')->applyFromArray($style_col);    
		$excel->getActiveSheet()->getStyle('AG1')->applyFromArray($style_col);   
		$excel->getActiveSheet()->getStyle('AH1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AI1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('AJ1')->applyFromArray($style_col);   

		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(27.86);    
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(52.57);    
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(66);    
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(28);   
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(28.14);
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(28);    
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(19.29);    
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(19.29);    
		$excel->getActiveSheet()->getColumnDimension('I')->setWidth(19.29);   
		$excel->getActiveSheet()->getColumnDimension('J')->setWidth(19.29);
		$excel->getActiveSheet()->getColumnDimension('K')->setWidth(19.29);    
		$excel->getActiveSheet()->getColumnDimension('L')->setWidth(19.29);    
		$excel->getActiveSheet()->getColumnDimension('M')->setWidth(19.29);    
		$excel->getActiveSheet()->getColumnDimension('N')->setWidth(19.29);   
		$excel->getActiveSheet()->getColumnDimension('O')->setWidth(19.29);
		$excel->getActiveSheet()->getColumnDimension('P')->setWidth(47);    
		$excel->getActiveSheet()->getColumnDimension('Q')->setWidth(19.29);    
		$excel->getActiveSheet()->getColumnDimension('R')->setWidth(19.29);    
		$excel->getActiveSheet()->getColumnDimension('S')->setWidth(19.29);   
		$excel->getActiveSheet()->getColumnDimension('T')->setWidth(19.29);
		$excel->getActiveSheet()->getColumnDimension('U')->setWidth(19.29);    
		$excel->getActiveSheet()->getColumnDimension('V')->setWidth(19.29);    
		$excel->getActiveSheet()->getColumnDimension('W')->setWidth(19.29);    
		$excel->getActiveSheet()->getColumnDimension('X')->setWidth(19.29);   
		$excel->getActiveSheet()->getColumnDimension('Y')->setWidth(19.29);
		$excel->getActiveSheet()->getColumnDimension('Z')->setWidth(19.29);    
		$excel->getActiveSheet()->getColumnDimension('AA')->setWidth(19.29);    
		$excel->getActiveSheet()->getColumnDimension('AB')->setWidth(19.29);   
		$excel->getActiveSheet()->getColumnDimension('AC')->setWidth(19.29);
		$excel->getActiveSheet()->getColumnDimension('AD')->setWidth(19.29);    
		$excel->getActiveSheet()->getColumnDimension('AE')->setWidth(19.29);   
		$excel->getActiveSheet()->getColumnDimension('AF')->setWidth(19.29);
		$excel->getActiveSheet()->getColumnDimension('AG')->setWidth(19.29);   
		$excel->getActiveSheet()->getColumnDimension('AH')->setWidth(19.29);
		$excel->getActiveSheet()->getColumnDimension('AI')->setWidth(19.29);
		$excel->getActiveSheet()->getColumnDimension('AJ')->setWidth(19.29);

		$datas = $this->Inventory_4_model->getProductAll();

		$numrow = 4;
		foreach($datas AS $data) {
			$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, "Aksesoris Interior Mobil/Pedals & Gear Sticks");     
			$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, "Tidak ada merek");      
			$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->nama_marketplace);
			$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->deskripsi);

			$dataImages = $this->db->query("SELECT * FROM ms_inventory_category3_images WHERE id_product = $data->id")->result();
			$dataAbjad = 69;
			foreach ($dataImages AS $image) {
				$excel->setActiveSheetIndex(0)->setCellValue(chr($dataAbjad).$numrow, "https://sentral.dutastudy.com/hirobolt" . $image->foto_url);
				$dataAbjad++;
			}

			$excel->setActiveSheetIndex(0)->setCellValue('N'.$numrow, $data->varian1);
			$excel->setActiveSheetIndex(0)->setCellValue('O'.$numrow, $data->varian2);
			$excel->setActiveSheetIndex(0)->setCellValue('P'.$numrow, "");
			$excel->setActiveSheetIndex(0)->setCellValue('Q'.$numrow, $data->berat);
			$excel->setActiveSheetIndex(0)->setCellValue('R'.$numrow, $data->panjang);
			$excel->setActiveSheetIndex(0)->setCellValue('S'.$numrow, $data->lebar);
			$excel->setActiveSheetIndex(0)->setCellValue('T'.$numrow, $data->tinggi);
			$excel->setActiveSheetIndex(0)->setCellValue('U'.$numrow, "");
			$excel->setActiveSheetIndex(0)->setCellValue('V'.$numrow, $data->price);
			$excel->setActiveSheetIndex(0)->setCellValue('W'.$numrow, 0);
			$excel->setActiveSheetIndex(0)->setCellValue('X'.$numrow, $data->sku_varian);
			$excel->setActiveSheetIndex(0)->setCellValue('Y'.$numrow, "");
			$excel->setActiveSheetIndex(0)->setCellValue('Z'.$numrow, "");
			$excel->setActiveSheetIndex(0)->setCellValue('AA'.$numrow, "");
			$excel->setActiveSheetIndex(0)->setCellValue('AB'.$numrow, "");
			$excel->setActiveSheetIndex(0)->setCellValue('AC'.$numrow, "");
			$excel->setActiveSheetIndex(0)->setCellValue('AD'.$numrow, "");
			$excel->setActiveSheetIndex(0)->setCellValue('AE'.$numrow, "");
			$excel->setActiveSheetIndex(0)->setCellValue('AF'.$numrow, "");
			$excel->setActiveSheetIndex(0)->setCellValue('AG'.$numrow, "");
			$excel->setActiveSheetIndex(0)->setCellValue('AH'.$numrow, "");
			$excel->setActiveSheetIndex(0)->setCellValue('AI'.$numrow, "");
			$excel->setActiveSheetIndex(0)->setCellValue('AJ'.$numrow, "");
			$numrow++;
		}

		$excel->getActiveSheet(0)->setTitle("Template");
		// $excel->setActiveSheetIndex(0);
		ob_end_clean();
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');    
		header('Content-Disposition: attachment; filename="HiroBolt - Data Import Produk Excel TikTok.xlsx"');   
		header('Cache-Control: max-age=0');

		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	}

	public function styleColoumnTokopedia($fontColor, $fillColor, $fontSize, $strikethrough = false)
	{
		return [
			'font' => [
				'bold' => true,
				'color' => array('rgb' => $fontColor),
				'size'  => $fontSize,
				'name'  => 'calibri',
				'strike' => $strikethrough
			],
			'alignment' => [
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
			],
			'fill' => [
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => [
					'rgb' => $fillColor
				]
			]
		];
	}

	public function exportExcelTokopedia()
	{
		include APPPATH . 'libraries/PHPExcel.php';

		$excel = new PHPExcel();

		$excel->getProperties()->setCreator("Hiro Bolt")
							->setLastModifiedBy("Hiro Bolt")
							->setTitle("Data Import Produk Tokopedia")
							->setSubject("Data")
							->setDescription("Data yang akan di Import ke Tokopedia")
							->setKeywords("Data Produk");

		$style_row = [
			'alignment' => [
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
			],
			'borders' => [
				'top' => [
					'style' => PHPExcel_Style_Border::BORDER_THIN
				],
				'right' => [
					'style' => PHPExcel_Style_Border::BORDER_THIN
				],
				'bottom' => [
					'style' => PHPExcel_Style_Border::BORDER_THIN
				],
				'left' => [
					'style' => PHPExcel_Style_Border::BORDER_THIN
				],
			]
		];

		$excel->getActiveSheet()->getDefaultColumnDimension()->setWidth(12);
		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(20);
		$excel->getDefaultStyle()->applyFromArray(
			array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
				)
			)
		);

		$excel->setActiveSheetIndex(0)->setCellValue('A1', "");

		$excel->setActiveSheetIndex(0)->setCellValue('B1', "Informasi Produk"); 
		$excel->setActiveSheetIndex(0)->setCellValue('O1', "Informasi SKU");

		$excel->setActiveSheetIndex(0)->setCellValue('A2', "Pesan Error"); 
		$excel->setActiveSheetIndex(0)->setCellValue('B2', "Nama Produk*");     
		$excel->setActiveSheetIndex(0)->setCellValue('C2', "Deskripsi Produk*");     
		$excel->setActiveSheetIndex(0)->setCellValue('D2', "Kode Kategori*");
		$excel->setActiveSheetIndex(0)->setCellValue('E2', "Berat* (Gram)");     
		$excel->setActiveSheetIndex(0)->setCellValue('F2', "Minimum Pemesanan*");     
		$excel->setActiveSheetIndex(0)->setCellValue('G2', "Nomor Etalase");     
		$excel->setActiveSheetIndex(0)->setCellValue('H2', "Waktu Proses Preorder");
		$excel->setActiveSheetIndex(0)->setCellValue('I2', "Kondisi*");     
		$excel->setActiveSheetIndex(0)->setCellValue('J2', "Foto Produk 1*");     
		$excel->setActiveSheetIndex(0)->setCellValue('K2', "Foto Produk 2");     
		$excel->setActiveSheetIndex(0)->setCellValue('L2', "Foto Produk 3");
		$excel->setActiveSheetIndex(0)->setCellValue('M2', "Foto Produk 4");     
		$excel->setActiveSheetIndex(0)->setCellValue('N2', "Foto Produk 5");     
		$excel->setActiveSheetIndex(0)->setCellValue('O2', "SKU Name");     
		$excel->setActiveSheetIndex(0)->setCellValue('P2', "Status*");
		$excel->setActiveSheetIndex(0)->setCellValue('Q2', "Jumlah Stok*");     
		$excel->setActiveSheetIndex(0)->setCellValue('R2', "Harga (Rp)*");     
		$excel->setActiveSheetIndex(0)->setCellValue('S2', "Kurir Pengiriman*");     
		$excel->setActiveSheetIndex(0)->setCellValue('T2', "Asuransi Pengiriman*");

		$excel->getActiveSheet()->mergeCells('B1:N1');
		$excel->getActiveSheet()->mergeCells('O1:T1');

		$excel->getActiveSheet()->getStyle('B1:N1')->applyFromArray($this->styleColoumnTokopedia("FFFFFF", "93C47D", 20));
		$excel->getActiveSheet()->getStyle('O1:T1')->applyFromArray($this->styleColoumnTokopedia("FFFFFF", "6D9EEB", 20));

		$excel->getActiveSheet()->getStyle('B1:N1')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('O1:T1')->getAlignment()->setWrapText(true);
		
		$excel->getActiveSheet()->getStyle('A1')->applyFromArray([
			'fill' => [
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => [
					'rgb' => '93C47D'
				]
			]
		]);

		$excel->getActiveSheet()->getStyle('A2')->applyFromArray($this->styleColoumnTokopedia('FFFFFF', '6AA84F', 14, true));
		$excel->getActiveSheet()->getStyle('B2')->applyFromArray($this->styleColoumnTokopedia('CC0000', '6AA84F', 14));    
		$excel->getActiveSheet()->getStyle('C2')->applyFromArray($this->styleColoumnTokopedia('CC0000', '6AA84F', 14));   
		$excel->getActiveSheet()->getStyle('D2')->applyFromArray($this->styleColoumnTokopedia('CC0000', '6AA84F', 14));    
		$excel->getActiveSheet()->getStyle('E2')->applyFromArray($this->styleColoumnTokopedia('CC0000', '6AA84F', 14));
		$excel->getActiveSheet()->getStyle('F2')->applyFromArray($this->styleColoumnTokopedia('CC0000', '6AA84F', 14));    
		$excel->getActiveSheet()->getStyle('G2')->applyFromArray($this->styleColoumnTokopedia('FFFFFF', '6AA84F', 14));    
		$excel->getActiveSheet()->getStyle('H2')->applyFromArray($this->styleColoumnTokopedia('FFFFFF', '6AA84F', 14));   
		$excel->getActiveSheet()->getStyle('I2')->applyFromArray($this->styleColoumnTokopedia('FFFFFF', '6AA84F', 14));    
		$excel->getActiveSheet()->getStyle('J2')->applyFromArray($this->styleColoumnTokopedia('FFFFFF', '6AA84F', 14));
		$excel->getActiveSheet()->getStyle('K2')->applyFromArray($this->styleColoumnTokopedia('000000', '6AA84F', 14));    
		$excel->getActiveSheet()->getStyle('L2')->applyFromArray($this->styleColoumnTokopedia('000000', '6AA84F', 14));    
		$excel->getActiveSheet()->getStyle('M2')->applyFromArray($this->styleColoumnTokopedia('000000', '6AA84F', 14));   
		$excel->getActiveSheet()->getStyle('N2')->applyFromArray($this->styleColoumnTokopedia('000000', '6AA84F', 14));    
		$excel->getActiveSheet()->getStyle('O2')->applyFromArray($this->styleColoumnTokopedia('FFFFFF', '3C78D8', 14));
		$excel->getActiveSheet()->getStyle('P2')->applyFromArray($this->styleColoumnTokopedia('CC0000', '3C78D8', 14));    
		$excel->getActiveSheet()->getStyle('Q2')->applyFromArray($this->styleColoumnTokopedia('CC0000', '3C78D8', 14));    
		$excel->getActiveSheet()->getStyle('R2')->applyFromArray($this->styleColoumnTokopedia('CC0000', '3C78D8', 14));   
		$excel->getActiveSheet()->getStyle('S2')->applyFromArray($this->styleColoumnTokopedia('CC0000', '3C78D8', 14));    
		$excel->getActiveSheet()->getStyle('T2')->applyFromArray($this->styleColoumnTokopedia('CC0000', '3C78D8', 14)); 

		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(27.86);    
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(52.57);    
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(66);    
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(28);   
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(28.14);
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(28);    
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(19.29);    
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(19.29);    
		$excel->getActiveSheet()->getColumnDimension('I')->setWidth(19.29);   
		$excel->getActiveSheet()->getColumnDimension('J')->setWidth(47);
		$excel->getActiveSheet()->getColumnDimension('K')->setWidth(19.29);    
		$excel->getActiveSheet()->getColumnDimension('L')->setWidth(19.29);    
		$excel->getActiveSheet()->getColumnDimension('M')->setWidth(19.29);    
		$excel->getActiveSheet()->getColumnDimension('N')->setWidth(19.29);   
		$excel->getActiveSheet()->getColumnDimension('O')->setWidth(19.29);
		$excel->getActiveSheet()->getColumnDimension('P')->setWidth(47);    
		$excel->getActiveSheet()->getColumnDimension('Q')->setWidth(19.29);    
		$excel->getActiveSheet()->getColumnDimension('R')->setWidth(19.29);    
		$excel->getActiveSheet()->getColumnDimension('S')->setWidth(47);   
		$excel->getActiveSheet()->getColumnDimension('T')->setWidth(47);

		$datas = $this->Inventory_4_model->getProductAll();

		$numrow = 4;
		foreach($datas AS $data) {
			$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->nama_marketplace);     
			$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->deskripsi);      
			$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, "");
			$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->berat);
			$excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data->minimum_order);
			$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, "");
			$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $data->waktu_proses_order);
			$excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $data->kondisi);

			$dataImages = $this->db->query("SELECT * FROM ms_inventory_category3_images WHERE id_product = $data->id")->result();
			$dataAbjad = 74;
			$loop = 1;
			$batas = 5;
			foreach ($dataImages AS $image) {
				$excel->setActiveSheetIndex(0)->setCellValue(chr($dataAbjad).$numrow, "https://sentral.dutastudy.com/hirobolt" . $image->foto_url);
				$dataAbjad++;
				$loop++;
				if ($loop == $batas) {
					break;
				}
			}

			$excel->setActiveSheetIndex(0)->setCellValue('O'.$numrow, $data->sku_varian);
			$excel->setActiveSheetIndex(0)->setCellValue('P'.$numrow, ucfirst($data->aktif));
			$excel->setActiveSheetIndex(0)->setCellValue('Q'.$numrow, 0);
			$excel->setActiveSheetIndex(0)->setCellValue('R'.$numrow, $data->price);
			$excel->setActiveSheetIndex(0)->setCellValue('S'.$numrow, $data->kurir_pengiriman);
			$excel->setActiveSheetIndex(0)->setCellValue('T'.$numrow, $data->asuransi_pengiriman);
			$numrow++;
		}

		$excel->getActiveSheet(0)->setTitle("ISI Template Impor Produk");
		// $excel->setActiveSheetIndex(0);
		ob_end_clean();
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');    
		header('Content-Disposition: attachment; filename="HiroBolt - Data Import Produk Excel Tokopedia.xlsx"');   
		header('Cache-Control: max-age=0');

		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	}

	public function exportExcelTokopediaWithVarian()
	{
		include APPPATH . 'libraries/PHPExcel.php';

		$excel = new PHPExcel();

		$excel->getProperties()->setCreator("Hiro Bolt")
							->setLastModifiedBy("Hiro Bolt")
							->setTitle("Data Import Produk Tokopedia with Varian")
							->setSubject("Data")
							->setDescription("Data yang akan di Import ke Tokopedia")
							->setKeywords("Data Produk");

		$style_row = [
			'alignment' => [
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
			],
			'borders' => [
				'top' => [
					'style' => PHPExcel_Style_Border::BORDER_THIN
				],
				'right' => [
					'style' => PHPExcel_Style_Border::BORDER_THIN
				],
				'bottom' => [
					'style' => PHPExcel_Style_Border::BORDER_THIN
				],
				'left' => [
					'style' => PHPExcel_Style_Border::BORDER_THIN
				],
			]
		];

		$excel->getActiveSheet()->getDefaultColumnDimension()->setWidth(12);
		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(20);
		$excel->getDefaultStyle()->applyFromArray(
			array(
				'alignment' => array(
					'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
					'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
				)
			)
		);

		$excel->setActiveSheetIndex(0)->setCellValue('A1', "");

		$excel->setActiveSheetIndex(0)->setCellValue('B1', "Informasi Produk"); 
		$excel->setActiveSheetIndex(0)->setCellValue('M1', "Spesifikasi");
		$excel->setActiveSheetIndex(0)->setCellValue('P1', "Informasi SKU"); 
		$excel->setActiveSheetIndex(0)->setCellValue('V1', "Informasi Varian");

		$excel->getActiveSheet()->mergeCells('B1:L1');
		$excel->getActiveSheet()->mergeCells('M1:O1');
		$excel->getActiveSheet()->mergeCells('P1:U1');
		$excel->getActiveSheet()->mergeCells('V1:Z1');

		$excel->getActiveSheet()->getStyle('B1:L1')->applyFromArray($this->styleColoumnTokopedia("FFFFFF", "93C47D", 20));
		$excel->getActiveSheet()->getStyle('M1:O1')->applyFromArray($this->styleColoumnTokopedia("FFFFFF", "B4A7D6", 20));
		$excel->getActiveSheet()->getStyle('P1:U1')->applyFromArray($this->styleColoumnTokopedia("FFFFFF", "6D9EEB", 20));
		$excel->getActiveSheet()->getStyle('V1:Z1')->applyFromArray($this->styleColoumnTokopedia("FFFFFF", "FF9900", 20));

		$excel->getActiveSheet()->getStyle('B1:L1')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('M1:O1')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('P1:U1')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('V1:Z1')->getAlignment()->setWrapText(true);

		$excel->setActiveSheetIndex(0)->setCellValue('A2', "Pesan Error"); 
		$excel->setActiveSheetIndex(0)->setCellValue('B2', "Nama Produk*");     
		$excel->setActiveSheetIndex(0)->setCellValue('C2', "Deskripsi Produk*");     
		$excel->setActiveSheetIndex(0)->setCellValue('D2', "Minimum Pemesanan*");
		$excel->setActiveSheetIndex(0)->setCellValue('E2', "Nomor Etalase");     
		$excel->setActiveSheetIndex(0)->setCellValue('F2', "Waktu Proses Preorder");     
		$excel->setActiveSheetIndex(0)->setCellValue('G2', "Kondisi*");          
		$excel->setActiveSheetIndex(0)->setCellValue('H2', "Foto Produk 1*");     
		$excel->setActiveSheetIndex(0)->setCellValue('I2', "Foto Produk 2");     
		$excel->setActiveSheetIndex(0)->setCellValue('J2', "Foto Produk 3");
		$excel->setActiveSheetIndex(0)->setCellValue('K2', "Foto Produk 4");     
		$excel->setActiveSheetIndex(0)->setCellValue('L2', "Foto Produk 5"); 
		$excel->setActiveSheetIndex(0)->setCellValue('M2', "Spesifikasi - Tipe Garansi"); 
		$excel->setActiveSheetIndex(0)->setCellValue('N2', "Spesifikasi - Tahun Produksi");      
		$excel->setActiveSheetIndex(0)->setCellValue('O2', "Spesifikasi - Merek");     
		$excel->setActiveSheetIndex(0)->setCellValue('P2', "SKU Produk");
		$excel->setActiveSheetIndex(0)->setCellValue('Q2', "Status*");     
		$excel->setActiveSheetIndex(0)->setCellValue('R2', "Jumlah Stok*");     
		$excel->setActiveSheetIndex(0)->setCellValue('S2', "Harga (Rp)*");     
		$excel->setActiveSheetIndex(0)->setCellValue('T2', "Kurir Pengiriman*");
		$excel->setActiveSheetIndex(0)->setCellValue('U2', "Asuransi Pengiriman*");     
		$excel->setActiveSheetIndex(0)->setCellValue('V2', "Ukuran Kemasan (54) - Family");     
		$excel->setActiveSheetIndex(0)->setCellValue('W2', "Ukuran Kemasan (54) - Value");
		$excel->setActiveSheetIndex(0)->setCellValue('X2', "Warna (1) - Value");     
		$excel->setActiveSheetIndex(0)->setCellValue('Y2', "Berat* (Gram)");
		$excel->setActiveSheetIndex(0)->setCellValue('Z2', "Gambar (Warna)");
		
		$excel->getActiveSheet()->getStyle('A1')->applyFromArray([
			'fill' => [
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'color' => [
					'rgb' => '93C47D'
				]
			]
		]);

		$excel->getActiveSheet()->getStyle('A2')->applyFromArray($this->styleColoumnTokopedia('FFFFFF', '6AA84F', 14, true));
		$excel->getActiveSheet()->getStyle('B2')->applyFromArray($this->styleColoumnTokopedia('CC0000', '6AA84F', 14));    
		$excel->getActiveSheet()->getStyle('C2')->applyFromArray($this->styleColoumnTokopedia('CC0000', '6AA84F', 14));   
		$excel->getActiveSheet()->getStyle('D2')->applyFromArray($this->styleColoumnTokopedia('CC0000', '6AA84F', 14));    
		$excel->getActiveSheet()->getStyle('E2')->applyFromArray($this->styleColoumnTokopedia('FFFFFF', '6AA84F', 14));
		$excel->getActiveSheet()->getStyle('F2')->applyFromArray($this->styleColoumnTokopedia('FFFFFF', '6AA84F', 14));    
		$excel->getActiveSheet()->getStyle('G2')->applyFromArray($this->styleColoumnTokopedia('CC0000', '6AA84F', 14));    
		$excel->getActiveSheet()->getStyle('H2')->applyFromArray($this->styleColoumnTokopedia('CC0000', '6AA84F', 14));   
		$excel->getActiveSheet()->getStyle('I2')->applyFromArray($this->styleColoumnTokopedia('FFFFFF', '6AA84F', 14));    
		$excel->getActiveSheet()->getStyle('J2')->applyFromArray($this->styleColoumnTokopedia('FFFFFF', '6AA84F', 14));
		$excel->getActiveSheet()->getStyle('K2')->applyFromArray($this->styleColoumnTokopedia('FFFFFF', '6AA84F', 14));    
		$excel->getActiveSheet()->getStyle('L2')->applyFromArray($this->styleColoumnTokopedia('FFFFFF', '6AA84F', 14));    
		$excel->getActiveSheet()->getStyle('M2')->applyFromArray($this->styleColoumnTokopedia('FFFFFF', 'B4A7D6', 14));   
		$excel->getActiveSheet()->getStyle('N2')->applyFromArray($this->styleColoumnTokopedia('FFFFFF', 'B4A7D6', 14));    
		$excel->getActiveSheet()->getStyle('O2')->applyFromArray($this->styleColoumnTokopedia('FFFFFF', 'B4A7D6', 14));
		$excel->getActiveSheet()->getStyle('P2')->applyFromArray($this->styleColoumnTokopedia('FFFFFF', '6D9EEB', 14));    
		$excel->getActiveSheet()->getStyle('Q2')->applyFromArray($this->styleColoumnTokopedia('CC0000', '6D9EEB', 14));    
		$excel->getActiveSheet()->getStyle('R2')->applyFromArray($this->styleColoumnTokopedia('CC0000', '6D9EEB', 14));   
		$excel->getActiveSheet()->getStyle('S2')->applyFromArray($this->styleColoumnTokopedia('CC0000', '6D9EEB', 14));    
		$excel->getActiveSheet()->getStyle('T2')->applyFromArray($this->styleColoumnTokopedia('CC0000', '6D9EEB', 14));
		$excel->getActiveSheet()->getStyle('U2')->applyFromArray($this->styleColoumnTokopedia('CC0000', '6D9EEB', 14));
		$excel->getActiveSheet()->getStyle('V2')->applyFromArray($this->styleColoumnTokopedia('FFFFFF', 'FF9900', 14));   
		$excel->getActiveSheet()->getStyle('W2')->applyFromArray($this->styleColoumnTokopedia('FFFFFF', 'FF9900', 14));    
		$excel->getActiveSheet()->getStyle('X2')->applyFromArray($this->styleColoumnTokopedia('FFFFFF', 'FF9900', 14));
		$excel->getActiveSheet()->getStyle('Y2')->applyFromArray($this->styleColoumnTokopedia('CC0000', 'FF9900', 14));
		$excel->getActiveSheet()->getStyle('Z2')->applyFromArray($this->styleColoumnTokopedia('FFFFFF', 'FF9900', 14));

		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(27.86);    
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(52.57);    
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(66);    
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(28);   
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(28.14);
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(28);    
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(29.29);    
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(29.29);    
		$excel->getActiveSheet()->getColumnDimension('I')->setWidth(29.29);   
		$excel->getActiveSheet()->getColumnDimension('J')->setWidth(47);
		$excel->getActiveSheet()->getColumnDimension('K')->setWidth(29.29);    
		$excel->getActiveSheet()->getColumnDimension('L')->setWidth(29.29);    
		$excel->getActiveSheet()->getColumnDimension('M')->setWidth(29.29);    
		$excel->getActiveSheet()->getColumnDimension('N')->setWidth(29.29);   
		$excel->getActiveSheet()->getColumnDimension('O')->setWidth(29.29);
		$excel->getActiveSheet()->getColumnDimension('P')->setWidth(47);    
		$excel->getActiveSheet()->getColumnDimension('Q')->setWidth(29.29);    
		$excel->getActiveSheet()->getColumnDimension('R')->setWidth(29.29);    
		$excel->getActiveSheet()->getColumnDimension('S')->setWidth(47);   
		$excel->getActiveSheet()->getColumnDimension('T')->setWidth(47);
		$excel->getActiveSheet()->getColumnDimension('U')->setWidth(47);   
		$excel->getActiveSheet()->getColumnDimension('V')->setWidth(47);
		$excel->getActiveSheet()->getColumnDimension('W')->setWidth(47);   
		$excel->getActiveSheet()->getColumnDimension('X')->setWidth(47);
		$excel->getActiveSheet()->getColumnDimension('Y')->setWidth(47);
		$excel->getActiveSheet()->getColumnDimension('Z')->setWidth(47);

		$datas = $this->Inventory_4_model->getProductAll();

		$numrow = 4;
		foreach($datas AS $data) {
			$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->nama_marketplace);     
			$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->deskripsi);      
			$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->minimum_order);
			$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->nomor_etalase);
			$excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data->waktu_proses_order);
			$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data->kondisi);

			$dataImages = $this->db->query("SELECT * FROM ms_inventory_category3_images WHERE id_product = $data->id")->result();
			$dataAbjad = 72;
			$loop = 1;
			$batas = 5;
			foreach ($dataImages AS $image) {
				$excel->setActiveSheetIndex(0)->setCellValue(chr($dataAbjad).$numrow, "https://sentral.dutastudy.com/hirobolt" . $image->foto_url);
				$dataAbjad++;
				$loop++;
				if ($loop == $batas) {
					break;
				}
			}

			$excel->setActiveSheetIndex(0)->setCellValue('M'.$numrow, "");
			$excel->setActiveSheetIndex(0)->setCellValue('N'.$numrow, "");
			$excel->setActiveSheetIndex(0)->setCellValue('O'.$numrow, "");
			$excel->setActiveSheetIndex(0)->setCellValue('P'.$numrow, $data->sku_varian);
			$excel->setActiveSheetIndex(0)->setCellValue('Q'.$numrow, ucfirst($data->aktif));
			$excel->setActiveSheetIndex(0)->setCellValue('R'.$numrow, 0);
			$excel->setActiveSheetIndex(0)->setCellValue('S'.$numrow, $data->price);
			$excel->setActiveSheetIndex(0)->setCellValue('T'.$numrow, $data->kurir_pengiriman);
			$excel->setActiveSheetIndex(0)->setCellValue('U'.$numrow, $data->asuransi_pengiriman);
			$excel->setActiveSheetIndex(0)->setCellValue('V'.$numrow, "");
			$excel->setActiveSheetIndex(0)->setCellValue('W'.$numrow, "");
			$excel->setActiveSheetIndex(0)->setCellValue('X'.$numrow, "");
			$excel->setActiveSheetIndex(0)->setCellValue('Y'.$numrow, $data->berat);
			$excel->setActiveSheetIndex(0)->setCellValue('Z'.$numrow, "");
			$numrow++;
		}

		$excel->getActiveSheet(0)->setTitle("ISI Template Impor Produk");
		// $excel->setActiveSheetIndex(0);
		ob_end_clean();
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');    
		header('Content-Disposition: attachment; filename="HiroBolt - Data Import Produk Excel Tokopedia with Varian.xlsx"');   
		header('Cache-Control: max-age=0');

		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	}

	public function deleteInventory()
	{
		$this->auth->restrict($this->deletePermission);
		$id = $this->input->post('id');
		// $data = [
		// 	'deleted' 		=> '1',
		// 	'deleted_by' 	=> $this->auth->user_id()
		// ];
		
		$this->db->trans_begin();
		// $this->db->where('id',$id)->update("ms_inventory_category3", $data);
		$this->db->where('id',$id)->delete("ms_inventory_category3");
		
		// $stock = $this->db->query("SELECT varian FROM stock_material WHERE id_stock=$id")->row();
		// $kategori = $stock->varian;
		
		
		// $datastock = [
		//     'aktif' 		=> 'N',
		// 	'deleted' 		=> '1',
		// 	'deleted_by' 	=> $this->auth->user_id()
		// ];
		
		// $this->db->where('varian',$kategori)->update("stock_material",$datastock);
		
		
		// $costbook = $this->db->query("SELECT * FROM ms_costbook WHERE varian='$kategori'")->row();
		
		//  $header1 =  array(
		// 					'id_costbook'	 		=> $costbook->id_costbook,
		// 					'varian'		    => $costbook->varian,
		// 					'nilai_costbook'		=> $costbook->nilai_costbook,
		// 					'created_by'		    => $costbook->created_by,
		// 					'created_on'		    => $costbook->created_on,
		// 					'modified_by'		    => $this->auth->user_id(),
		// 					'modified_on'		    => date('Y-m-d H:i:s')
		// 					);
        //  //Add Data
        //  $this->db->insert('ms_costbook_history',$header1);
		 
		// $this->db_query("DELETE FROM ms_costbook WHERE varian=$kategori")->row();
		
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
