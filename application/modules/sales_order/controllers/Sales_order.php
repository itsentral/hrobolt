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

class Sales_order extends Admin_Controller
{
    //Permission
    protected $viewPermission 	= 'Sales_Order.View';
    protected $addPermission  	= 'Sales_Order.Add';
    protected $managePermission = 'Sales_Order.Manage';
    protected $deletePermission = 'Sales_Order.Delete';

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('Mpdf', 'upload', 'Image_lib'));
        $this->load->model(array('Penawaran/penawaran_model',
								 'Sales_order/sales_order_model',
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
        $data = $this->sales_order_model->cariSalesOrder();
        $this->template->set('results', $data);
        $this->template->title('Sales Order');
        $this->template->render('index');
    }

	 public function index_nodeal()
    {
        $this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-users');
        $data = $this->sales_order_model->cariSalesOrderNodeal();
        $this->template->set('results', $data);
        $this->template->title('Sales Order');
        $this->template->render('index_belum_deal');
    }

    public function AddPenawaran()
    {
        $this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-pencil');
		$aktif = 'active';
		$deleted = '0';
		$customers = $this->penawaran_model->get_data('master_customers','deleted',$deleted);
		$karyawan = $this->penawaran_model->get_data('ms_employee','deleted',$deleted);
		$mata_uang = $this->penawaran_model->get_data('mata_uang','deleted'.$deleted);
        $top       = $this->penawaran_model->get_data('ms_top','deleted'.$deleted);
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
	
	public function createSO($id)
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
        $this->template->title('Create Sales Order');
        $this->template->render('create_so');

    }

	public function dealSO($id)
    {
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-pencil');
		$aktif = 'active';
		$deleted = '0';
		$customers = $this->penawaran_model->get_data('master_customers','deleted',$deleted);
		$karyawan = $this->penawaran_model->get_data('ms_employee','deleted',$deleted);
		$mata_uang = $this->penawaran_model->get_data('mata_uang','deleted'.$deleted);
        $top       = $this->penawaran_model->get_data('ms_top','deleted'.$deleted);
		$header    = $this->penawaran_model->get_data('tr_sales_order','id_so',$id);
		$detail    = $this->penawaran_model->get_data('tr_sales_order_detail','id_so',$id);
		$data = [
			'customers' => $customers,
			'karyawan' => $karyawan,
			'mata_uang' => $mata_uang,
            'top' => $top,
			'header'=>$header,
			'detail'=>$detail,
		];

        $this->template->set('results', $data);
        $this->template->title('Deal Sales Order');
        $this->template->render('deal_so');

    }

    function GetProduk()
    {
		$loop=$_GET['jumlah']+1;
		
		$customers = $this->penawaran_model->get_data('master_customers','deleted',$deleted);
		
		
		$material = $this->db->query("SELECT a.*, b.nama as nama_produk, b.kode_barang, c.nama_category2 as nama_formula FROM ms_product_pricelist as a 
										INNER JOIN ms_inventory_category3 b on b.id_category3=a.id_category3
										INNER JOIN ms_product_costing c on c.id_category2 = a.id_formula
										")->result();
		
		
		
		echo "
		<tr id='tr_$loop'>
			<td>$loop</td>
			<td>
				<select id='used_no_surat_$loop' name='dt[$loop][no_surat]' data-no='$loop' onchange='CariDetail($loop)' class='form-control select' required>
					<option value=''>-Pilih-</option>";					
					foreach($material as $produk){
					echo"<option value='$produk->id_category3'>$produk->nama_formula|$produk->nama_produk|$produk->kode_barang</option>";
					}
		echo	"</select>
			</td>
			<td id='nama_produk_$loop' hidden><input type='text' class='form-control input-sm' readonly id='used_nama_produk_$loop' required name='dt[$loop][nama_produk]'></td>
			<td id='date_$loop'><input type='date' class='form-control input-sm' id='used_date_$loop' required name='dt[$loop][date]'></td>
			<td id='qty_so_$loop'><input type='text' class='form-control input-sm' id='used_qty_so_$loop' required name='dt[$loop][qty_so]' onblur='HitungTotal($loop)'></td>
			<td id='qty_$loop'><input type='text' class='form-control input-sm' id='used_qty_$loop' required name='dt[$loop][qty]' onblur='HitungTotal($loop)'></td>
			<td id='harga_satuan_$loop'><input type='text' class='form-control input-sm' id='used_harga_satuan_$loop' required name='dt[$loop][harga_satuan]'></td>
			<td id='stok_tersedia_$loop'><input type='text' class='form-control input-sm' id='used_stok_tersedia_$loop' required name='dt[$loop][stok_tersedia]' onblur='HitungLoss($loop)'></td>
			<td id='potensial_loss_$loop'><input type='text' class='form-control input-sm' id='used_potensial_loss_$loop' required name='dt[$loop][potensial_loss]' readonly></td>
			<td id='diskon_$loop'><input type='text' class='form-control'  id='used_diskon_$loop' required name='dt[$loop][diskon]' onblur='HitungTotal($loop)'></td>
			<td id='nilai_diskon_$loop' hidden><input type='text' class='form-control'  id='used_nilai_diskon_$loop' required name='dt[$loop][nilai_diskon]'></td>
			<td id='freight_cost_$loop'><input type='text' class='form-control input-sm' id='used_freight_cost_$loop' value='0' required name='dt[$loop][freight_cost]' onblur='Freight($loop)'></td>
			<td id='total_harga_$loop'><input type='text' class='form-control input-sm total' id='used_total_harga_$loop' required name='dt[$loop][total_harga]' readonly></td>
			<td align='center'>
				<button type='button' class='btn btn-sm btn-danger' title='Hapus Data' data-role='qtip' onClick='return HapusItem($loop);'><i class='fa fa-close'></i></button>
			</td>
			
		</tr>
		";
	}

    public function SaveNewSalesOrder()
    {
        $this->auth->restrict($this->addPermission);
		$post = $this->input->post();
       
        $code = $this->sales_order_model->generate_id();
		$no_surat = $this->sales_order_model->BuatNomor();
		$this->db->trans_begin();

		$config['upload_path'] = './assets/file_po/'; //path folder
	    $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|doc|docx|xls|xlsx|ppt|pptx|pdf|rar|zip|vsd'; //type yang dapat diakses bisa anda sesuaikan
	    $config['encrypt_name'] = false; //Enkripsi nama yang terupload
		

	    $this->upload->initialize($config);

		if ($this->upload->do_upload('upload_po')){
			$gbr = $this->upload->data();
			//Compress Image
			$config['image_library']='gd2';
			$config['source_image']='./assets/file_po/'.$gbr['file_name'];
			$config['create_thumb']= FALSE;
			$config['maintain_ratio']= FALSE;
			$config['umum']= '50%';
			$config['width']= 260;
			$config['height']= 350;
			$config['new_image']= './assets/file_po/'.$gbr['file_name'];
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();

			$gambar  =$gbr['file_name'];
			$type    =$gbr['file_type'];
			$ukuran  =$gbr['file_size'];
			$ext1    =explode('.', $gambar);
			$ext     =$ext1[1];
			$lokasi = './assets/file_po/'.$gbr['file_name'];
			
		}

		// print_r($lokasi);
		// exit;

		$config1['upload_path'] = './assets/file_do/'; //path folder
		$config1['allowed_types'] = 'gif|jpg|png|jpeg|bmp|doc|docx|xls|xlsx|ppt|pptx|pdf|rar|zip|vsd'; //type yang dapat diakses bisa anda sesuaikan
		$config1['encrypt_name'] = false; //Enkripsi nama yang terupload
		
	
		$this->upload->initialize($config1);
		if ($this->upload->do_upload('upload_so')){
			$gbr2 = $this->upload->data();
			//Compress Image
			$config1['image_library']='gd2';
			$config1['source_image']='./assets/file_do/'.$gbr2['file_name'];
			$config1['create_thumb']= FALSE;
			$config1['maintain_ratio']= FALSE;
			$config1['umum']= '50%';
			$config1['width']= 260;
			$config1['height']= 350;
			$config1['new_image']= './assets/file_do/'.$gbr2['file_name'];
			$this->load->library('image_lib', $config1);
			$this->image_lib->resize();

			$gambar1  =$gbr2['file_name'];
			$type1    =$gbr2['file_type'];
			$ukuran1  =$gbr2['file_size'];
			$ext2    =explode('.', $gambar1);
			$ext3     =$ext2[1];
			$lokasi2 = './assets/file_do/'.$gbr2['file_name'];
		}

		$data = [
			'id_so'			        => $code,							
			'tgl_so'			    => $post['tanggal'],
			'no_penawaran'		    => $post['no_penawaran'],
			'id_customer'			=> $post['id_customer'],
			'pic_customer'			=> $post['pic_customer'],
			'email_customer'		=> $post['email_customer'],
			'top'			        => $post['top'],
			'order_status'			=> $post['order_sts'],
			'id_sales'				=> $post['id_sales'],
			'nama_sales'			=> $post['nama_sales'],
			'nilai_so'				=> str_replace(',','',$post['totalproduk']),
			'created_on'			=> date('Y-m-d H:i:s'),
			'created_by'			=> $this->auth->user_id(),
			'ppn'					=> str_replace(',','',$post['ppn']),
			'nilai_ppn'				=> str_replace(',','',$post['totalppn']),
			'grand_total'			=> str_replace(',','',$post['grandtotal']),
			'upload_po'				=> $lokasi,
			'upload_so'				=> $lokasi2,
			'reff'				    => $post['reff'],
        ];

        //Add Data
    	$this->db->insert('tr_sales_order',$data);

		$numb1 =0;
		foreach($_POST['dt'] as $used){
			if(!empty($used['no_surat'])){
				$numb1++;   
				$dt[] =  array(
					'id_so'				=> $code,
					'id_penawaran_detail'=> $used['id_penawaran'],
					'no_penawaran'		=> $post['no_penawaran'],
					'id_category3'		=> $used['no_surat'],
					'nama_produk'	    => $used['nama_produk'],
					'qty_so'			=> $used['qty'],
					'qty'			    => $used['qty'],
					'harga_satuan'		=> str_replace(',','',$used['harga_satuan']),
					'stok_tersedia'		=> $used['stok_tersedia'],
					'potensial_loss'	=> $used['potensial_loss'],
					'diskon'		    => $used['diskon'],
					'freight_cost'		=> str_replace(',','',$used['freight_cost']),
					'total_harga'	    =>  str_replace(',','',$used['total_harga']),
					'tgl_delivery'	    => $used['tgl_delivery'],
					'created_on'		=> date('Y-m-d H:i:s'),
					'created_by'		=> $this->auth->user_id(),
					'nilai_diskon'		=> str_replace(',','',$used['nilai_diskon'])                
				);

				// $material =$used[no_surat];
				// $qtyso    = $used[qty_so];

				// $this->db->query("UPDATE stock_material SET qty_free=qty_free - $qtyso , qty_book=qty_book + $qtyso  WHERE id_category3='$material'");
			}
		}

		$this->db->insert_batch('tr_sales_order_detail',$dt);

		$data2 = [
			'status_so'	=> 1,				
		];

		//Edit Data
		$this->db->where('no_penawaran', $post['no_penawaran'])->update("tr_penawaran",$data2);		

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

	protected function saveDokumen($data, $type)
	{
        if (!empty($data)) {
			$filename = 'Dokumen'.strtoupper($type).date("dmYhis").uniqid();
			$imagePath = realpath(APPPATH . '../assets/file_po');

			$_FILES['userfile']['name'] = $data['name'];
			$_FILES['userfile']['type'] = $data['type'];
			$_FILES['userfile']['tmp_name'] = $data['tmp_name'];
			$_FILES['userfile']['error'] = $data['error'];
			$_FILES['userfile']['size'] = $data['size'];

			$config = array(
				'file_name' => $filename,
				'allowed_types' => 'jpg|jpeg|png|pdf',
				'max_size' => 5000,
				'overwrite' => false,
				'upload_path' => $imagePath
			);

			$this->upload->initialize($config);
			
			// $errCount = 0;

			if (!$this->upload->do_upload()) {
				$error = array('error' => $this->upload->display_errors());
				$theImages = array(
					'status' => 'NOK',
					'code' => 404,
					'errors' => $error
				);

				return $theImages;
				// return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($theImages));
			} else {
				$filename = $this->upload->data();
				$barcodefilename = '/assets/file_po/'.$filename['file_name'];

				$data = [
                    'success' => 'Upload Successfully',
                    'code' => 200,
                    'data' => [
						'url' => $barcodefilename,
						'filename' => $filename['file_name']
					],
                ];
                
				return $data;
                // return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));
				// return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($barcodefilename));
			}
        }
	}


	public function SaveDealNewSalesOrder()
    {
        $this->auth->restrict($this->addPermission);
		$post = $this->input->post();
        $id	= $post['id_so'];
		$tanggal = date("Y-m-d");
        $code = $this->sales_order_model->generate_code();
		$no_surat = $this->sales_order_model->BuatNomor($tanggal);

		$this->db->trans_begin();

		$uploadPo = $this->saveDokumen($_FILES['upload_po'], 'po');
		$uploadSo = $this->saveDokumen($_FILES['upload_so'], 'so');

		if ($uploadPo['code'] == 200) {
			$dokumenPo = $uploadPo['data']['url'];
		}

		if ($uploadSo['code'] == 200) {
			$dokumenSo = $uploadSo['data']['url'];
		}
 
		// return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($post));

		$dt = [];
		$numb1 = 0;
		$totalcostbook = 0;
		foreach($_POST['dt'] as $used){
			if(!empty($no_surat)){
				$numb1++;   
				$qtyso   	= $used['qty_so'];
				$idmaterial = $used['product_id'];	
				$cost 		= $this->db->query("SELECT * FROM ms_costbook WHERE id_category3='$idmaterial'")->row();
				$costbook 	= $cost->nilai_costbook*$qtyso;
				
				$totalcostbook += $costbook;

				$dt[] =  array(
						'no_so'					=> $code,
						'id_penawaran_detail'	=> $used['id_penawaran'],
						'no_penawaran'			=> $post['no_penawaran'],
						'id_category3'			=> $used['product_id'],
						'nama_produk'	    	=> $used['nama_produk'],
						'qty_so'			    => $used['qty'],
						'qty'			    	=> $used['qty'],
						'harga_satuan'			=> str_replace(".", "", $used['harga_satuan']),
						'stok_tersedia'			=> $used['stok_tersedia'],
						'potensial_loss'		=> $used['potensial_loss'],
						'diskon'		        => str_replace(".", "", $used['diskon']),
						'freight_cost'			=> str_replace(".", "", $used['freight_cost']),
						'total_harga'	    	=> str_replace(".", "", $used['total_harga']),
						'tgl_delivery'	    	=> $used['tgl_delivery'],
						'created_on'			=> date('Y-m-d H:i:s'),
						'created_by'			=> $this->auth->user_id(),
						'nilai_diskon'			=> $used['nilai_diskon'],
						'costbook_so'	    	=> $costbook							   
					);

				$material = $used['no_surat'];
				$qtyso    = (int) $used['qty_so'];

				$this->kartu_stok($material,$qtyso,$code,$no_surat);
			}
		}
        
		// return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($dt));
        $this->db->insert_batch('tr_sales_order_detail', $dt);
			
		$data = [
				'no_so'			        => $code,
				'no_surat'				=> $no_surat,
				'tgl_so'			    => $tanggal,
				'no_penawaran'		    => $post['no_penawaran'],
				'id_customer'			=> $post['id_customer'],
				'pic_customer'			=> $post['pic_customer'],
				'email_customer'		=> $post['email_customer'],
				'top'			        => $post['top'],
				'order_status'			=> $post['order_sts'],
				'id_sales'				=> $post['id_sales'],
				'nama_sales'			=> $post['nama_sales'],
				// 'delivery_date'			=> $post['tanggal_pengiriman'],
				'status'			    => 1,
				'nilai_so'				=> str_replace(".", "", $post['totalproduk']),
				'created_on'			=> date('Y-m-d H:i:s'),
				'created_by'			=> $this->auth->user_id(),
				'ppn'					=> str_replace(".", "", $post['ppn']),
				'nilai_ppn'				=> str_replace(".", "", $post['totalppn']),
				'grand_total'			=> str_replace(".", "", $post['grandtotal']),
				'upload_po'				=> $dokumenPo,
				'upload_so'				=> $dokumenSo,
				'reff'				    => $post['reff'],
				'total_costbook_so'		=> $totalcostbook,
			];
            //Add Data

            $this->db->insert('tr_sales_order',$data);

			$data = [
				'status_so'	=> 1,				
			];

			//Edit Data
		    $this->db->where('no_penawaran', $post['no_penawaran'])->update("tr_penawaran", $data);


			$data2 = [
				'status'				=> 6,
				'delivered_on'			=> date('Y-m-d H:i:s'),
				'delivered_by'			=> $this->auth->user_id()
			];
		
		//Edit Data
		$this->db->where('no_penawaran',$post['no_penawaran'])->update("tr_penawaran",$data2);

		$id_top = $post['top'];		  
		$top  = $this->db->query("SELECT * FROM ms_top_planning WHERE id_top='$id_top'")->result_array();

		 foreach($top as $det){
			$nilai  = str_replace(',','',$post['grandtotal']);

			$datatop = [
				'id_top'			    => $det['id_top'],
				'id_top_planning'		=> $det['id_top_planning'],
				'payment'			    => $det['payment'],
				'keterangan'		    => $det['keterangan'],
				'persentase'			=> $det['persentase'],
				'nilai'					=> $nilai,
				'nilai_tagih'			=> round(($det['persentase']*$nilai)/100,2),
				'no_so'			        => $code,
				'created_on'			=> date('Y-m-d H:i:s'),
				'created_by'			=> $this->auth->user_id(),				
				];

			// $this->db->insert('wt_plan_tagih',$datatop);
		}

		if ($this->db->trans_status() === FALSE){
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

	public function kartu_stok($material,$qtyso,$notr,$no_surat)
	{
		$mat = $this->db->query("SELECT * FROM stock_material WHERE id_category3='$material' ")->row();

		

		$book  = (int) $mat->qty_book + (int) $qtyso;
		$free  = (int) $mat->qty_free - (int)$qtyso;

		// print_r($free);
		// exit;
		$kartu = [
			'id_category3'		    => $material,
			'qty'		            => $mat->qty,
			'qty_book'			    => $mat->qty_book,
			'qty_free'		        => $mat->qty_free,
			'transaksi'			    => 'sales order',
			'tgl_transaksi'			=> date('Y-m-d'),
			'no_transaksi'			=> $notr,
			'id_gudang'             => $mat->id_gudang,
			'created_on'			=> date('Y-m-d H:i:s'),
			'created_by'			=> $this->auth->user_id(),
			'qty_transaksi'         => $qtyso,
			'qty_akhir'		        => $mat->qty,
			'qty_book_akhir'	    => $book,
			'qty_free_akhir'		=> $free,	
			'status_transaksi'		=> 'out',			
			'no_surat'		        => $no_surat,
			];

		$this->db->insert('kartu_stok',$kartu);	   

		$this->db->query("UPDATE stock_material SET qty_free=qty_free-$qtyso , qty_book=qty_book+$qtyso  WHERE id_category3='$material'");
	}


	public function SaveDealSalesOrder()
    {
        $this->auth->restrict($this->addPermission);
		$post = $this->input->post();
		
		$tgl = $post['tanggal'];
		print_r($post);
		exit;

        $id	= $post['id_so'];
        $code = $this->sales_order_model->generate_code();
		$no_surat = $this->sales_order_model->BuatNomor($tanggal);
		$this->db->trans_begin();

		$config['upload_path'] = './assets/file_po/'; //path folder
	    $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|doc|docx|xls|xlsx|ppt|pptx|pdf|rar|zip|vsd'; //type yang dapat diakses bisa anda sesuaikan
	    $config['encrypt_name'] = false; //Enkripsi nama yang terupload
		

	    $this->upload->initialize($config);
	        if ($this->upload->do_upload('upload_po')){
	            $gbr = $this->upload->data();
	            //Compress Image
	            $config['image_library']='gd2';
	            $config['source_image']='./assets/file_po/'.$gbr['file_name'];
	            $config['create_thumb']= FALSE;
	            $config['maintain_ratio']= FALSE;
	            $config['umum']= '50%';
	            $config['width']= 260;
	            $config['height']= 350;
	            $config['new_image']= './assets/file_po/'.$gbr['file_name'];
	            $this->load->library('image_lib', $config);
	            $this->image_lib->resize();

	            $gambar  =$gbr['file_name'];
				$type    =$gbr['file_type'];
				$ukuran  =$gbr['file_size'];
				$ext1    =explode('.', $gambar);
				$ext     =$ext1[1];
				$lokasi = './assets/file_po/'.$gbr['file_name'];
				
			}

			// print_r($lokasi);
			// exit;

			$config1['upload_path'] = './assets/file_do/'; //path folder
			$config1['allowed_types'] = 'gif|jpg|png|jpeg|bmp|doc|docx|xls|xlsx|ppt|pptx|pdf|rar|zip|vsd'; //type yang dapat diakses bisa anda sesuaikan
			$config1['encrypt_name'] = false; //Enkripsi nama yang terupload
			
	
			$this->upload->initialize($config1);
				if ($this->upload->do_upload('upload_so')){
					$gbr2 = $this->upload->data();
					//Compress Image
					$config1['image_library']='gd2';
					$config1['source_image']='./assets/file_do/'.$gbr2['file_name'];
					$config1['create_thumb']= FALSE;
					$config1['maintain_ratio']= FALSE;
					$config1['umum']= '50%';
					$config1['width']= 260;
					$config1['height']= 350;
					$config1['new_image']= './assets/file_do/'.$gbr2['file_name'];
					$this->load->library('image_lib', $config1);
					$this->image_lib->resize();
	
					$gambar1  =$gbr2['file_name'];
					$type1    =$gbr2['file_type'];
					$ukuran1  =$gbr2['file_size'];
					$ext2    =explode('.', $gambar1);
					$ext3     =$ext2[1];
					$lokasi2 = './assets/file_do/'.$gbr2['file_name'];
					
				}


               $numb1 =0;
			   $totalcostbook = 0;
               foreach($_POST['dt'] as $used){
                   if(!empty($used[no_surat])){
                       $numb1++;   
					   
					   $idmaterial 	= $used[no_surat];	
					   $qtyso       = $used[qty_so];
					   $cost = $this->db->query("SELECT * FROM ms_costbook WHERE id_category3='$idmaterial'")->row();
					   $costbook = $cost->nilai_costbook*$qtyso;
					   
					   
					   $totalcostbook += $cost->nilai_costbook;

					//    print_r($used);
					//    exit;
                       $dt[] =  array(
                               'no_so'		=> $code,
							   'id_penawaran_detail'=> $used[id_penawaran],
							   'no_penawaran'		=> $post['no_penawaran'],
                               'id_category3'		=> $used[no_surat],
                               'nama_produk'	    => $used[nama_produk],
							   'qty_so'			    => $used[qty_so],
                               'qty'			    => $used[qty],
                               'harga_satuan'		=> str_replace(',','',$used[harga_satuan]),
                               'stok_tersedia'		=> $used[stok_tersedia],
                               'potensial_loss'		=> $used[potensial_loss],
                               'diskon'		        => $used[diskon],
                               'freight_cost'		=> str_replace(',','',$used[freight_cost]),
                               'total_harga'	    =>  str_replace(',','',$used[total_harga]),
							   'tgl_delivery'	    => $used[tgl_delivery],
                               'created_on'			=> date('Y-m-d H:i:s'),
                               'created_by'			=> $this->auth->user_id(),
							   'nilai_diskon'		=> str_replace(',','',$used[nilai_diskon]),
							   'costbook_so'		=> $costbook						   
                               );
                   }
               }
               // print_r($dt);
               // exit();

			$this->db->delete('tr_sales_order_detail',array('id_so'=>$id));
            $this->db->insert_batch('tr_sales_order_detail',$dt);
			
			
			
			
		$data = [
							'no_so'			        => $code,
							'no_surat'				=> $no_surat,
							'tgl_so'			    => $post['tanggal'],
							'no_penawaran'		    => $post['no_penawaran'],
							'id_customer'			=> $post['id_customer'],
							'pic_customer'			=> $post['pic_customer'],
							'email_customer'		=> $post['email_customer'],
							'top'			        => $post['top'],
							'order_status'			=> $post['order_sts'],
							'id_sales'				=> $post['id_sales'],
							'nama_sales'			=> $post['nama_sales'],
							'status'			    => 1,
                            'nilai_so'				=> str_replace(',','',$post['totalproduk']),
							'created_on'			=> date('Y-m-d H:i:s'),
							'created_by'			=> $this->auth->user_id(),
							'ppn'					=> str_replace(',','',$post['ppn']),
							'nilai_ppn'				=> str_replace(',','',$post['totalppn']),
							'grand_total'			=> str_replace(',','',$post['grandtotal']),
							'upload_po'				=> $lokasi,
							'upload_so'				=> $lokasi2,
							'total_costbook_so'		=> $totalcostbook,
                            ];
            //Add Data

			   $this->db->delete('tr_sales_order',array('id_so'=>$id));
               $this->db->insert('tr_sales_order',$data);
			   


			$data = [
				'status_so'				=> 1,				
				];
				//Edit Data
				  $this->db->where('no_penawaran', $post['no_penawaran'])->update("tr_penawaran",$data);
		 $id_top=$post['top'];		  
		 $top  = $this->db->query("SELECT * FROM ms_top_planning WHERE id_top='$id_top'")->result_array();

		 foreach($top as $det){
			$nilai  = str_replace(',','',$post['totalproduk']);

			
			$datatop = [
				'id_top'			    => $det[id_top],
				'id_top_planning'		=> $det[id_top_planning],
				'payment'			    => $det[payment],
				'keterangan'		    => $det[keterangan],
				'persentase'			=> $det[persentase],
				'nilai'					=> $nilai,
				'nilai_tagih'			=> round(($det[persentase]*$nilai)/100,2),
				'no_so'			        => $code,
				'created_on'			=> date('Y-m-d H:i:s'),
				'created_by'			=> $this->auth->user_id(),				
				];

			// $this->db->insert('wt_plan_tagih',$datatop);

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
			'tgl_penawaran'			=> date('Y-m-d'),
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
				if(!empty($used[no_surat])){
					$numb1++;   
					$dt[] =  array(
							'no_penawaran'		=> $code,
							'id_category3'		=> $used[no_surat],
							'nama_produk'	    => $used[nama_produk],
							'qty'			    => $used[qty],
							'harga_satuan'		=> str_replace(',','',$used[harga_satuan]),
							'stok_tersedia'		=> $used[stok_tersedia],
							'potensial_loss'	=> $used[potensial_loss],
							'diskon'		    => $used[diskon],
							'freight_cost'		=> str_replace(',','',$used[freight_cost]),
							'total_harga'	    => str_replace(',','',$used[total_harga]),
							'created_on'		=> date('Y-m-d H:i:s'),
							'created_by'		=> $this->auth->user_id(),
							'nilai_diskon'		=> str_replace(',','',$used[nilai_diskon])                   
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
        $id_customer=$_GET['id_customer'];
		$kategory3	= $this->db->query("SELECT * FROM master_customers WHERE id_customer = '$id_customer' ")->result();
		$thickness = $kategory3[0]->email;
		echo "<input type='email' class='form-control' id='email_customer' value='$thickness' required name='email_customer' >";
	}
    function getsales()
    {
        $id_customer=$_GET['id_customer'];
		$kategory3	= $this->db->query("SELECT * FROM master_customers WHERE id_customer = '$id_customer' ")->result();
		$id_karyawan = $kategory3[0]->id_karyawan;
		$karyawan	= $this->db->query("SELECT * FROM ms_employee WHERE id_karyawan = '$id_karyawan' ")->result();
		$nama_karyawan = $karyawan[0]->nama_karyawan;
		echo "	<div class='col-md-8' >
					<input type='text' class='form-control' id='nama_sales' value='$nama_karyawan' required name='nama_sales' readonly placeholder='Sales Marketing'>
				</div>
				<div class='col-md-8' hidden>
					<input type='text' class='form-control' id='id_sales' value='$id_karyawan'  required name='id_sales' readonly placeholder='Sales Marketing'>
				</div>";
	}
    function getpic()
    {
        $id_customer=$_GET['id_customer'];
		$kategory3	= $this->db->query("SELECT * FROM child_customer_pic WHERE id_customer = '$id_customer' ")->result();
		echo "<select id='pic_customer' name='pic_customer' class='form-control select' required>
				<option value=''>--Pilih--</option>";
				foreach($kategory3 as $pic){
		echo "<option value='$pic->name_pic'>$pic->name_pic</option>";
				}
		echo "</select>";
	}

    function CariNamaProduk()
    {
        $loop=$_GET['id'];
		$id_category3=$_GET['id_category3'];
		$material	= $this->db->query("SELECT * FROM ms_inventory_category3 WHERE id_category3 = '$id_category3' ")->result();
		$produk= $material[0]->nama;
	
		echo "<input type='text' class='form-control input-sm' readonly id='used_nama_produk_$loop' required name='dt[$loop][nama_produk]' value='$produk'>";
	}

	function CariHarga()
    {
        $loop=$_GET['id'];
		$id_category3=$_GET['id_category3'];
		$material	= $this->db->query("SELECT * FROM ms_product_pricelist WHERE id_category3 = '$id_category3' ")->result();
		$produk= $material[0]->total_pricelist;			


		echo "<input type='text' class='form-control input-sm' readonly id='used_harga_satuan_$loop' required name='dt[$loop][harga_satuan]' value='$produk'>";
	}

	function CariDiskon()
    {
        $loop=$_GET['id'];
		$id_category3=$_GET['id_category3'];
		$idtop       =$_GET['top'];
		$material	= $this->db->query("SELECT * FROM ms_inventory_category3 WHERE id_category3 = '$id_category3' ")->result();
		$produk= $material[0]->id_type;		
		$diskon	= $this->db->query("SELECT * FROM ms_diskon WHERE id_type = '$produk' AND id_top='$idtop' ")->result();	
		$diskonvalue= $diskon[0]->nilai_diskon;	

		echo "<input type='text' class='form-control input-sm' id='used_diskon_$loop' required name='dt[$loop][diskon]' value='$diskonvalue' onblur='HitungTotal($loop)'>";
	}

	public function PrintSO($id)
	{
		ob_clean();
		ob_start();
        $this->auth->restrict($this->managePermission);
        $id = $this->uri->segment(3);

		$data['header']   = $this->sales_order_model->cariSalesOrderId($id);
		$data['detail']   = $this->penawaran_model->get_data('tr_sales_order_detail','no_so',$id);

		$this->load->view('PrintSO',$data);
		$html = ob_get_contents();

		require_once('./assets/html2pdf/html2pdf/html2pdf.class.php');
		$html2pdf = new HTML2PDF('P','A4','en',true,'UTF-8',array(10, 5, 10, 5));
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($html);
		ob_end_clean();
		$html2pdf->Output("Sales Order $id.pdf", 'I');
	}

	public function ajukanApprove($id) 
    {
		$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');
		$this->template->page_icon('fa fa-pencil');
		$aktif = 'active';
		$deleted = '0';
		$customers = $this->penawaran_model->get_data('master_customers','deleted',$deleted);
		$karyawan = $this->penawaran_model->get_data('ms_employee','deleted',$deleted);
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
		$code		= $post['no_penawaran'];
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
		$deleted = '0';
		$customers = $this->penawaran_model->get_data('master_customers','deleted',$deleted);
		$karyawan = $this->penawaran_model->get_data('ms_employee','deleted',$deleted);
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
        $this->template->title('Proses Approval');
        $this->template->render('formprosesapproval');

    }

	public function SaveApprovePenawaran()
    {
        $this->auth->restrict($this->addPermission);
		$post = $this->input->post();
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
			'grand_total'			=> str_replace(',','',$post['grandtotal'])
			
			];
			//Edit Data
          	$this->db->where('no_penawaran',$code)->update("tr_penawaran",$data);		


			

			$numb1 =0;
			foreach($_POST['dt'] as $used){
				if(!empty($used[no_surat])){
					$numb1++;   
					$dt[] =  array(
							'no_penawaran'		=> $code,
							'id_category3'		=> $used[no_surat],
							'nama_produk'	    => $used[nama_produk],
							'qty'			    => $used[qty],
							'harga_satuan'		=> str_replace(',','',$used[harga_satuan]),
							'stok_tersedia'		=> $used[stok_tersedia],
							'potensial_loss'	=> $used[potensial_loss],
							'diskon'		    => $used[diskon],
							'freight_cost'		=> str_replace(',','',$used[freight_cost]),
							'total_harga'	    => str_replace(',','',$used[total_harga]),
							'created_on'		=> date('Y-m-d H:i:s'),
							'created_by'		=> $this->auth->user_id(),
							'nilai_diskon'      => str_replace(',','',$used[nilai_diskon])             
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
		$deleted = '0';
		$customers = $this->penawaran_model->get_data('master_customers','deleted',$deleted);
		$karyawan = $this->penawaran_model->get_data('ms_employee','deleted',$deleted);
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
		$customers = $this->penawaran_model->get_data('master_customers','deleted',$deleted);
		$karyawan = $this->penawaran_model->get_data('ms_employee','deleted',$deleted);
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
        $this->template->title('Revisi Penawaran');
        $this->template->render('revisipenawaran');

    }

	public function SaveRevisiPenawaran()
    {
        $this->auth->restrict($this->addPermission);
		$post = $this->input->post();
		$code		= $post['no_penawaran'];
		$no_surat	= $post['no_surat'];
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
		grand_total')->where('no_penawaran',$code)->get('tr_penawaran');
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
		nilai_diskon
		')->where('no_penawaran',$code)->get('tr_penawaran_detail');	
		

		$rev = $select1->row();
		$norev = $rev->revisi+1;
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
			'status'			    => 0,
			'revisi'			    => $norev,
			'revisi_on'				=> date('Y-m-d H:i:s'),
			'revisi_by'				=> $this->auth->user_id(),
			'ppn'					=> str_replace(',','',$post['ppn']),
			'nilai_ppn'				=> str_replace(',','',$post['totalppn']),
			'grand_total'			=> str_replace(',','',$post['grandtotal'])
			];
			//Edit Data
          	$this->db->where('no_penawaran',$code)->update("tr_penawaran",$data);			


			

			$numb1 =0;
			foreach($_POST['dt'] as $used){
				if(!empty($used[no_surat])){
					$numb1++;   
					$dt[] =  array(
							'no_penawaran'		=> $code,
							'id_category3'		=> $used[no_surat],
							'nama_produk'	    => $used[nama_produk],
							'qty'			    => $used[qty],
							'harga_satuan'		=> str_replace(',','',$used[harga_satuan]),
							'stok_tersedia'		=> $used[stok_tersedia],
							'potensial_loss'	=> $used[potensial_loss],
							'diskon'		    => $used[diskon],
							'freight_cost'		=> str_replace(',','',$used[freight_cost]),
							'total_harga'	    => str_replace(',','',$used[total_harga]),
							'revisi'			=> $norev,
							'created_on'		=> date('Y-m-d H:i:s'),
							'created_by'		=> $this->auth->user_id(),
							'nilai_diskon'      => str_replace(',','',$used[nilai_diskon])            
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
		$karyawan = $this->penawaran_model->get_data('ms_employee','deleted',$deleted);
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
		$customers = $this->penawaran_model->get_data('master_customers','deleted',$deleted);
		$karyawan = $this->penawaran_model->get_data('ms_employee','deleted',$deleted);
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
		$karyawan = $this->penawaran_model->get_data('ms_employee','deleted',$deleted);
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

}