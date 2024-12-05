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

class Sales_marketplace extends Admin_Controller
{
    //Permission
    protected $viewPermission 	= 'Marketplace.View';
    protected $addPermission  	= 'Marketplace.Add';
    protected $managePermission = 'Marketplace.Manage';
    protected $deletePermission = 'Marketplace.Delete';

    public function __construct()
    {
        parent::__construct();

        $this->load->library(array('Mpdf', 'upload', 'Image_lib'));
        $this->load->model(array('sales_marketplace/Sales_marketplace_model',
                                 'Aktifitas/aktifitas_model',
                                ));
        $this->template->title('Manage Data Sales Marketplace');
        $this->template->page_icon('fa fa-cart');

        date_default_timezone_set('Asia/Bangkok');
    }

    public function index()
    {
       	$this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');

		$data = [
			'dataMarketplace' => $this->db->query("SELECT * FROM master_marketplace WHERE status = 'Aktif'")->result(),
			'dataPengiriman' => $this->db->query("SELECT * FROM master_pengiriman WHERE status = 'Aktif'")->result(),
		];

		// return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($code));

		$this->template->set('results', $data);
		$this->template->page_icon('fa fa-money');
        $this->template->title('Manage Data Sales Marketplace');
        $this->template->render('index');
    }

	public function getDataJSON()
    {
        $ENABLE_ADD     = has_permission('Marketplace.Add');
        $ENABLE_MANAGE  = has_permission('Marketplace.Manage');
        $ENABLE_VIEW    = has_permission('Marketplace.View');
        $ENABLE_DELETE  = has_permission('Marketplace.Delete');

        $requestData    = $_REQUEST;
        $fetch            = $this->queryDataJSON(
            $requestData['search']['value'],
            $requestData['order'][0]['column'],
            $requestData['order'][0]['dir'],
            $requestData['start'],
            $requestData['length']
        );

        $totalData        = $fetch['totalData'];
        $totalFiltered    = $fetch['totalFiltered'];
        $query            = $fetch['query'];

        $data			  = array();
		$dataPacking 	  = $this->db->query("SELECT code_spk, code_orders FROM spk_gudang")->result_array();

        foreach ($query->result_array() as $row) {
            $total_data     = $totalData;
            $start_dari     = $requestData['start'];
            $asc_desc       = $requestData['order'][0]['dir'];

			foreach ($dataPacking AS $packing) {
				$dataPackingRow = explode("," , $packing['code_orders']);
				foreach ($dataPackingRow AS $pack) {
					if ($pack == $row['code_order']) {
						$row['code_spk'] = $packing['code_spk'];
					}
				}
			}

            if ($row['status'] == 1) {
                $badge = 'label-primary';
				$textStatus = 'Dipesan';
            } else if ($row['status'] == 2)  {
                $badge = 'label-warning';
				$textStatus = 'Proses Pengambilan';
            } else if ($row['status'] == 3)  {
                $badge = 'label-warning';
				$textStatus = 'Selesai Pengambilan';
            } else if ($row['status'] == 4)  {
                $badge = 'label-info';
				$textStatus = 'Selesai Packing';
            } else if ($row['status'] == 5)  {
                $badge = 'label-info';
				$textStatus = 'Sedang diKirim';
				$buttonSuccess = "<button class='btn btn-success btn-selesai-order' style='margin: 10px' data-code='" .$row['code_order']. "'>Selesaikan Order</button>";
            } else if ($row['status'] == 6)  {
                $badge = 'label-success';
				$textStatus = 'Selesai';
            } else if ($row['status'] == 9)  {
                $badge = 'label-danger';
				$textStatus = 'Batal';
            } else {
				$badge = 'label-success';
				$textStatus = 'Selesai';
			} 

            $nestedData     = array();
            $detail = "";
            $nestedData[]    = "<div align='center'>" . $row['code_order'] . "</div>";
			$nestedData[]    = "<div align='center' style='color: green; font-weight: 700'>" . $row['code_spk'] . "</div>";
            $nestedData[]    = "<div align='left'>" . strtoupper($row['code_order_marketplace']) . "</div>";
			$nestedData[]    = "<div align='left'>" . strtoupper($row['marketplace']) . "</div>";
            $nestedData[]    = "<div align='left'>" . strtoupper($row['customer_name']) . "</div>";
            $nestedData[]    = "<div>" . strtoupper($row['delivery_date']) . "</div>";
            $nestedData[]    = "<div>" . strtoupper($row['name_marketplace']) . "</div>";
            $nestedData[]    = "<div>" . strtoupper($row['sku']) . "</div>";
			$nestedData[]    = "<div>" . strtoupper($row['qty_pcs']) . "</div>";
			$nestedData[]    = "<div>" . strtoupper($row['delivery_name']) . "</div>";
			$nestedData[]    = "<div>Rp. " . number_format($row['total_price_pcs'], 2, ".", ",") . "</div>";
			if ($row['status'] == 5) {
				$nestedData[]    = "<div class='text-center'><span class='label " . $badge . "'>" . ucfirst($textStatus) . "</span>" . $buttonSuccess . "</div>";
			} else {
				$nestedData[]    = "<div class='text-center'><span class='label " . $badge . "'>" . ucfirst($textStatus) . "</span></div>";
			}
            if ($ENABLE_MANAGE) :
                $edit = "<a class='btn btn-sm btn-success edit' href='javascript:void(0)' title='Edit' data-id='" . $row['id_sales_order_detail'] . "' style='width:30px; display:inline-block; margin: 10px'><span class='glyphicon glyphicon-edit'></span></a>";
            endif;

            if ($ENABLE_VIEW) :
                $view = "<a class='btn btn-sm btn-primary detail' href='javascript:void(0)' title='Detail' data-id='" . $row['id_sales_order_detail'] . "' style='width:30px; display:inline-block; margin: 10px'><span class='glyphicon glyphicon-list'></span></a> ";
            endif;

			if ($ENABLE_MANAGE) :
                $editBarcodeResi = "<a class='btn btn-sm btn-info upload-barcode' href='javascript:void(0)' title='Upload Barcode' data-code= " . $row['code_order'] . " style='width:30px; display:inline-block; margin: 10px'><i class='fa fa-barcode'></i></a>";
            endif;
			
            if ($ENABLE_DELETE) :
                $cancel = "<a class='btn btn-sm btn-danger btn-batal' href='javascript:void(0)' title='Batal Order' data-code= " . $row['code_order'] . "  style='width:30px; display:inline-block; margin: 10px'>
					<i class='fa fa-remove'></i>
				</a>";
            endif;
            $nestedData[]    = "<div style='text-align:center'>" . $view . $edit . $editBarcodeResi . $cancel . "</div>";
            $data[] = $nestedData;
        }

        $json_data = array(
            "draw"                => intval($requestData['draw']),
            "recordsTotal"        => intval($totalData),
            "recordsFiltered"     => intval($totalFiltered),
            "data"                => $data
        );

        echo json_encode($json_data);
    }

	public function viewUploadBarcode()
	{
		$code = $this->input->post('code');
		$data = $this->db->query("SELECT * FROM sales_marketplace_header WHERE code_order = '$code'")->row();

		if (isset($data)) {
			$response = [
				'code' => 200,
				'status' => 'OK',
				'message' => 'Berhasil Ambil Data',
				'data' => $data
			];
		} else {
			$response = [
				'code' => 404,
				'status' => 'NOK',
				'message' => 'Gagal Ambil Data',
			];
		}

		return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($response));
	}

    public function queryDataJSON($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
    {
        $sql = "
  			SELECT
  				a.*,
				b.id AS id_sales_order_detail,
				b.qty AS qty_pcs,
				b.total_price AS total_price_pcs,
				a.another_price AS another_price,
				c.sku_varian AS sku, 
				c.nama_marketplace AS name_marketplace,
				c.nama AS name,
				d.name AS delivery_name
  			FROM
                  sales_marketplace_header a
				  LEFT JOIN sales_marketplace_detail b ON b.code_order = a.code_order
				  LEFT JOIN ms_inventory_category3 c ON c.id = b.product_id
				  LEFT JOIN master_pengiriman d ON d.id = a.delivery_service_id
  			WHERE 1=1 AND a.customer_name IS NOT NULL
  				AND (
  				a.code_order LIKE '%" . $this->db->escape_like_str($like_value) . "%'
  				OR a.code_order_marketplace LIKE '%" . $this->db->escape_like_str($like_value) . "%'
                OR a.customer_name LIKE '%" . $this->db->escape_like_str($like_value) . "%'
                OR c.nama_marketplace LIKE '%" . $this->db->escape_like_str($like_value) . "%'
				OR d.name LIKE '%" . $this->db->escape_like_str($like_value) . "%'
  	        )
  		";

        $data['totalData'] = $this->db->query($sql)->num_rows();
        $data['totalFiltered'] = $this->db->query($sql)->num_rows();
        $columns_order_by = array(
            0 => 'a.code_order',
            1 => 'a.code_order_marketplace',
			2 => 'a.marketplace',
            3 => 'a.customer_name',
            4 => 'a.delivery_date',
            5 => 'c.nama_marketplace',
            6 => 'c.sku_varian',
            7 => 'b.qty',
			8 => 'd.name',
			9 => 'b.total_price'
        );

        $sql .= " ORDER BY a.id DESC, " . $columns_order_by[$column_order] . " " . $column_dir . " ";
        $sql .= " LIMIT " . $limit_start . " ," . $limit_length . " ";

        $data['query'] = $this->db->query($sql);
        return $data;
    }

	public function getProductBySKU()
	{
		$sku = $this->input->post('sku');
		$product = $this->db->query("SELECT nama_marketplace AS name, price FROM ms_inventory_category3 WHERE sku_varian = '$sku' AND deleted = 0")->row();

		if ($product) {
			$data = [
				'code' => 200,
				'status' => 'OK',
				'product' => $product,
				'message' => 'Berhasil Ambil Data'
			];
		} else {
			$data = [
				'code' => 404,
				'status' => 'NOK',
				'message' => 'Gagal Ambil Data'
			];
		}

		return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function detail()
	{
		$id = $this->input->post('id');

		$data = $this->db->query("SELECT 
						a.*, 
						b.delivery_date AS delivery_date,
						b.customer_name AS customer_name,
						b.code_order_marketplace AS code_order_marketplace,
						b.delivery_date AS delivery_date,
						b.delivery_label AS delivery_label,
						c.nama AS product_name,
						c.sku_varian AS sku, 
						e.name AS delivery_name,
						d.foto_url AS fhoto_url,
						b.another_price AS another_price
						FROM 
						sales_marketplace_detail a 
						LEFT JOIN sales_marketplace_header b ON a.code_order = b.code_order
						LEFT JOIN ms_inventory_category3 c ON c.id = a.product_id
						LEFT JOIN ms_inventory_category3_images d ON d.id_product = c.id 
						LEFT JOIN master_pengiriman e ON e.id = b.delivery_service_id
						WHERE a.id = $id")->row();

		// return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));

		if ($data) {
			$data = [
				'code' => 200,
				'status' => 'OK',
				'data' => $data,
				'message' => 'Berhasil Ambil Data'
			];
		} else {
			$data = [
				'code' => 404,
				'status' => 'NOK',
				'message' => 'Gagal Ambil Data'
			];
		}

		return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function searchProductBySKU()
	{
		$dataProduct = $this->db->query("SELECT sku_varian, nama FROM ms_inventory_category3 WHERE deleted = 0")->result();

		$data = [
			'status' => 'OK',
			'code' => 200,
			'message' => 'Berhasil Ambil Data',
			'data' => $dataProduct
		];

		return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function searchDataProductBySKU()
	{
		$data = $this->input->post('sku');
		$dataProduct = $this->db->query("SELECT nama, deskripsi, price FROM ms_inventory_category3 WHERE sku_varian = '$data'")->row();

		$data = [
			'status' => 'OK',
			'code' => 200,
			'message' => 'Berhasil Ambil Data',
			'data' => $dataProduct
		];

		return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function edit($id)
	{
		$data = $this->db->query("SELECT 
						a.*, 
						b.delivery_date AS delivery_date,
						b.customer_name AS customer_name,
						b.code_order_marketplace AS code_order_marketplace,
						b.delivery_date AS delivery_date,
						b.delivery_service_id AS delivery_id,
						b.marketplace AS marketplace,
						c.nama AS product_name,
						c.sku_varian AS sku, 
						c.deskripsi AS product_description,
						c.price AS product_price, 
						e.name AS delivery_name,
						d.foto_url AS fhoto_url
						FROM 
						sales_marketplace_detail a 
						LEFT JOIN sales_marketplace_header b ON a.code_order = b.code_order
						LEFT JOIN ms_inventory_category3 c ON c.id = a.product_id
						LEFT JOIN ms_inventory_category3_images d ON d.id_product = c.id 
						LEFT JOIN master_pengiriman e ON e.id = b.delivery_service_id
						WHERE a.id = $id")->row();

		// return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));

		if ($data) {
			$data = [
				'detailProduct' => $data,
				'dataPengiriman' => $this->db->query("SELECT * FROM master_pengiriman WHERE status = 'Aktif'")->result(),
				'dataMarketplace' => $this->db->query("SELECT * FROM master_marketplace WHERE status = 'Aktif'")->result(),
			];

			$this->template->set('results', $data);
        	$this->template->render('edit');
		} else {
			$data = [
				'code' => 404,
				'status' => 'NOK',
				'message' => 'Gagal Ambil Data'
			];

			return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	public function saveFormOrder()
    {
        $this->auth->restrict($this->addPermission);
		$session = $this->session->userdata('app_session');

		$code = $this->Sales_marketplace_model->generate_code_order();
		$nomorOrderMarketplace = $this->input->post('nomor_order_marketplace');
		$customerName = $this->input->post('customer_name');
		$tanggalPengiriman = $this->input->post('tanggal_pengiriman');
		$jasaPengiriman = $this->input->post('jasa_pengiriman');
		$marketplace = $this->input->post('marketplace');
		$totalPrice = $this->input->post('total_price');
		$anotherPrice = $this->input->post('another_price');

		$numberOfUploads = count($_FILES['label_pengiriman']['name']);

		$barcodefilename = '';
		$filename = '';

		if ($numberOfUploads > 0) {
			$this->load->library('upload');
			$imagePath = realpath(APPPATH . '../assets/uploads/barcode_resi');

			$_FILES['userfile']['name'] = $_FILES['label_pengiriman']['name'];
			$_FILES['userfile']['type'] = $_FILES['label_pengiriman']['type'];
			$_FILES['userfile']['tmp_name'] = $_FILES['label_pengiriman']['tmp_name'];
			$_FILES['userfile']['error'] = $_FILES['label_pengiriman']['error'];
			$_FILES['userfile']['size'] = $_FILES['label_pengiriman']['size'];

			$config = array(
				'file_name' => 'labelbarcode'.date("dmYhis").uniqid(),
				'allowed_types' => 'jpg|jpeg|png|pdf',
				'max_size' => 5000,
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
				$barcodefilename = '/assets/uploads/barcode_resi/'.$filename['file_name'];
				$filename = $filename['file_name'];
				// return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($barcodefilename));
			}
		}

		// return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($barcodefilename));

		$this->db->trans_begin();

		$dataDetail = $this->input->post('data1');
		$countDataDetail = count($dataDetail);
		$totalQty = 0;
		$totalPrice = 0;
        $totalPriceHeader = 0;
        $totalPriceDetail = 0;

		for($i = 1; $i <= $countDataDetail; $i++) {
			$data = $this->db->query("SELECT * FROM ms_inventory_category3 WHERE sku_varian = '" . $dataDetail[$i]['sku_code'] . "'")->row();
			$totalQty += $dataDetail[$i]['qty'];
			$totalPrice += $dataDetail[$i]['price'];
            $totalPriceDetail = $dataDetail[$i]['qty'] * $dataDetail[$i]['price'];
            $totalPriceHeader += $totalPriceDetail;

			$insertDetail = [
				'code_order' => $code,
				'product_id' => $data->id,
				'price' => $data->price,
				'qty' => $dataDetail[$i]['qty'],
				'total_price' => $totalPriceDetail,
				'total_price_ppn' => $dataDetail[$i]['price_fix'],
				'created_at' => date('Y-m-d H:i:s'),
				'created_by' => $this->auth->user_id(),
			];

			$this->db->insert('sales_marketplace_detail', $insertDetail);
		}

		$data = array(
			'code_order'		    	=> $code,
			'code_order_marketplace'	=> $nomorOrderMarketplace,
			'marketplace'				=> $marketplace,
			'customer_name'				=> $customerName,
			'delivery_date'				=> $tanggalPengiriman,
			'delivery_service_id'		=> $jasaPengiriman,
			'delivery_label'			=> $barcodefilename,
			'delivery_label_filename' 	=> $filename,
			'status'					=> 1,
			'total_qty'					=> $totalQty,
			'total_price' 				=> $totalPriceHeader,
			'another_price'				=> $anotherPrice,
			'created_at'				=> date('Y-m-d H:i:s'),
			'created_by'				=> $this->auth->user_id(),
		);

		//Add Data
		$this->db->insert('sales_marketplace_header', $data);
		
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

	public function saveImage()
	{
		$image = $_FILES['file']['name'];
		$code = $this->input->post('code');

		// return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($code));

        if (!empty($image)) {
			$imagePath = realpath(APPPATH . '../assets/uploads/barcode_resi');

			$_FILES['userfile']['name'] = $_FILES['file']['name'];
			$_FILES['userfile']['type'] = $_FILES['file']['type'];
			$_FILES['userfile']['tmp_name'] = $_FILES['file']['tmp_name'];
			$_FILES['userfile']['error'] = $_FILES['file']['error'];
			$_FILES['userfile']['size'] = $_FILES['file']['size'];

			$config = array(
				'file_name' => 'labelbarcode'.date("dmYhis").uniqid(),
				'allowed_types' => 'jpg|jpeg|png|pdf',
				'max_size' => 5000,
				'overwrite' => false,
				'upload_path' => $imagePath
			);

			$this->upload->initialize($config);
			
			// $errCount = 0;

			if (!$this->upload->do_upload()) {
				$error = array('error' => $this->upload->display_errors());
				$theImages[] = array(
					'status' => 'NOK',
					'code' => 404,
					'errors' => $error
				);

				return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($theImages));
			} else {
				$filename = $this->upload->data();
				$barcodefilename = '/assets/uploads/barcode_resi/'.$filename['file_name'];

				$dataLabel = [
					'delivery_label' => $barcodefilename,
					'delivery_label_filename' => $filename['file_name']
				];

				$this->db->where('code_order', $code);
				$this->db->update('sales_marketplace_header', $dataLabel);

				$data = [
                    'success' => 'Upload Successfully',
                    'code' => 200,
                    'data' => [
						'url' => $barcodefilename,
						'filename' => $filename['file_name']
					],
                ];
                
                return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));
				// return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($barcodefilename));
			}
        }
	}
	
	public function saveEditOrder()
	{
		$codeOrderMarketplace = $this->input->post('nomor_order_marketplace');
		$customerName = $this->input->post('customer_name');
		$tanggalPengiriman = $this->input->post('tanggal_pengiriman');
		$qty = $this->input->post('qty');
		$pengiriman = $this->input->post('pengiriman');
		$marketplace = $this->input->post('marketplace');
		$totalPrice = $this->input->post('total_price');
		$anotherPrice = $this->input->post('another_price');
		$sku = $this->input->post('sku');

		$codeOrder = $this->input->post('code_order');
		$OrderDetailId = $this->input->post('code_order_detail_id');

		$this->db->trans_begin();

		$dataProduct = $this->db->query("SELECT * FROM ms_inventory_category3 WHERE sku_varian = '$sku'")->row();
		// return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($dataProduct));
		$dataOrder = $this->db->query("SELECT * FROM sales_marketplace_header WHERE code_order = '$codeOrder'")->row();
		$dataOrderDetail = $this->db->query("SELECT * FROM sales_marketplace_detail WHERE id = $OrderDetailId")->row();

		$qtyBefore = $dataOrder->total_qty - $dataOrderDetail->qty;
		$qtyAfter = $qtyBefore + $qty;

		$priceBefore = $dataOrder->total_price - $dataOrderDetail->total_price;
		$priceAfter = $priceBefore + $totalPrice;

		$dataDetail = [
			'qty' => $qty,
			'total_price' => $totalPrice
		];

		if ($dataProduct->id != $dataOrderDetail->product_id) {
			$dataDetail['product_id'] = $dataProduct->id;
			$dataDetail['price'] = $dataProduct->price;
		}

		$dataHeader = [
			'code_order_marketplace' => $codeOrderMarketplace,
			'customer_name' => $customerName,
			'marketplace' => $marketplace,
			'delivery_service_id' => $pengiriman,
			'delivery_date' => $tanggalPengiriman,
			'total_qty' => $qtyAfter,
			'total_price' => $priceAfter,
			'another_price' => $anotherPrice
		];

		$this->db->where("code_order", $codeOrder);
		$this->db->update("sales_marketplace_header", $dataHeader);

		$this->db->where("id", $OrderDetailId);
		$this->db->update("sales_marketplace_detail", $dataDetail);

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

    public function finish_order()
    {
        $code = $this->input->post('code');
        $biaya_layanan = $this->input->post('biaya_layanan');

		$data = [
            'biaya_layanan' => $biaya_layanan,
			'status' => 6,
			'updated_at' => date('Y-m-d H:i:s'),
			'updated_by' => $this->auth->user_id() 
		];
		
		$this->db->trans_begin();
		$this->db->where('code_order', $code);
		$this->db->update("sales_marketplace_header", $data);
		
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$status	= array(
			  'pesan'	=> 'Gagal Selesaikan Order. Thanks ...',
			  'status'	=> 0
			);
		} else {
			$this->db->trans_commit();
			$status	= array(
			  'pesan'	=> 'Success Selesaikan Order. Thanks ...',
			  'status'	=> 1
			);			
		}
		
		return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($status));
    }

	public function cancel_order()
	{
		$this->auth->restrict($this->deletePermission);
		$code = $this->input->post('code');

		$data = [
			'status' => 9,
			'updated_at' => date('Y-m-d H:i:s'),
			'updated_by' => $this->auth->user_id() 
		];
		
		$this->db->trans_begin();
		$this->db->where('code_order', $code);
		$this->db->update("sales_marketplace_header", $data);

		$dataOrder = $this->db->query("SELECT * FROM sales_marketplace_detail WHERE code_order = '$code'")->result();
		$dataOrderHeader = $this->db->query("SELECT * FROM sales_marketplace_header WHERE code_order = '$code'")->row();

		if ($dataOrderHeader->status >= 4) {
			foreach ($dataOrder AS $order) {
				$dataProduct = $this->db->query("SELECT * FROM ms_inventory_category3 WHERE id = $order->product_id")->row();
				$dataAccessories = $this->db->query("SELECT a.*, b.kd_gudang AS kode_gudang, c.nm_category AS category_name FROM accessories a JOIN warehouse b ON b.id = a.id_gudang JOIN accessories_category c ON c.id = a.id_category WHERE a.id_stock = '" . $dataProduct->sku_varian . "'")->row();
				$dataWarehouseStock = $this->db->query("SELECT * FROM warehouse_stock WHERE id_material = '" .$dataAccessories->id . "'")->row();
	
				$dataMinusQtyStockWarehouse = [
					'incoming' => $dataWarehouseStock->incoming + $order->qty, 
					'qty_stock' => $dataWarehouseStock->qty_stock + $order->qty
				];
		
				$this->db->where('id', $dataWarehouseStock->id);
				$this->db->update('warehouse_stock', $dataMinusQtyStockWarehouse);
		
				$dataMinusQty = [
					'stok' => $dataProduct->stok + $order->qty
				];
		
				$this->db->where('id', $dataProduct->id);
				$this->db->update('ms_inventory_category3', $dataMinusQty);
	
				$dataWarehouseHistory = [
					'id_material'     => $dataAccessories->id,
					'nm_material'     => $dataAccessories->stock_name,
					'id_category'     => $dataAccessories->id_category,
					'nm_category'     => $dataAccessories->category_name,
					'id_gudang'       => $dataAccessories->id_gudang,
					'kd_gudang'       => $dataAccessories->kode_gudang,
					'incoming_awal'   => $order->qty,
					'incoming_akhir'  => $dataWarehouseStock->qty_stock + $order->qty,
					'qty_stock_awal'  => $dataWarehouseStock->qty_stock,
					'qty_stock_akhir' => $dataWarehouseStock->qty_stock + $order->qty,
					'status_stock'    => 'PENAMBAHAN',
					'no_ipp'          => $order->code_order,
					'jumlah_mat'      => $order->qty,
					'ket'             => "SALES ORDER MARKETPLACE GAGAL",
					'surat_jalan'     => $dataOrder->delivery_label,
					'update_by'       => $this->auth->user_id(),
					'update_date'     => date('Y-m-d H:i:s')
				];
	
				$this->db->insert("warehouse_history", $dataWarehouseHistory);
			}
		}
		
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$status	= array(
			  'pesan'	=> 'Gagal Batal Order. Thanks ...',
			  'status'	=> 0
			);
		} else {
			$this->db->trans_commit();
			$status	= array(
			  'pesan'	=> 'Success Membatalkan Order. Thanks ...',
			  'status'	=> 1
			);			
		}
		
		return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($status));
	}

	protected function checkStatus($statusOrder)
	{
		switch ($statusOrder) {
			case 0:
				return "Dipesan";
			case 1:
				return "Dipesan";
			case 2: 
				return "Proses Pengambilan";
			case 4:
				return "Selesai Packing";
			case 5:
				return "Sedang diKirim";
			case 6:
				return "Selesai";
			case 9:
				return "Batal";
			default:
				return "Dipesan";
		}
	}

	public function exportExcel()
	{
		include APPPATH . 'libraries/PHPExcel.php';

		$excel = new PHPExcel();

		$excel->getProperties()->setCreator("Hiro Bolt")
							->setLastModifiedBy("Hiro Bolt")
							->setTitle("Data Export Order Marketplace")
							->setSubject("Data")
							->setDescription("Data Order Marketplace")
							->setKeywords("Data Produk");
		
		$style_col_header = [
			'font' => [
				'bold' => true,
				'color' => array('rgb' => '000000'),
				'size'  => 17,
				'name'  => 'Arial'
			],
			'alignment' => [
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
			],
		];
		
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
					'rgb' => 'F87A53'
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

		$excel->setActiveSheetIndex(0)->setCellValue('A1', "Data Order Marketplace HiroBolt");  

		$excel->setActiveSheetIndex(0)->setCellValue('A3', "Tanggal: " . date("d M Y / H:i:s"));

		$excel->setActiveSheetIndex(0)->setCellValue('A4', "Kode Order");     
		$excel->setActiveSheetIndex(0)->setCellValue('B4', "Kode Order Marketplace");     
		$excel->setActiveSheetIndex(0)->setCellValue('C4', "Marketplace");     
		$excel->setActiveSheetIndex(0)->setCellValue('D4', "Nama Customer");
		$excel->setActiveSheetIndex(0)->setCellValue('E4', "Tanggal Pengiriman");     
		$excel->setActiveSheetIndex(0)->setCellValue('F4', "Jasa Delivery");     
		$excel->setActiveSheetIndex(0)->setCellValue('G4', "Status");
		$excel->setActiveSheetIndex(0)->setCellValue('H4', "Detail Order");     
		$excel->setActiveSheetIndex(0)->setCellValue('L4', "Total Price");
		//$excel->setActiveSheetIndex(0)->setCellValue('M4', "Total Price");     

		$excel->getActiveSheet()->mergeCells('A1:I2');

		$excel->setActiveSheetIndex(0)->setCellValue('H5', "Nama Produk");
		$excel->setActiveSheetIndex(0)->setCellValue('I5', "SKU Produk");
		$excel->setActiveSheetIndex(0)->setCellValue('J5', "Quantity Produk");
		$excel->setActiveSheetIndex(0)->setCellValue('K5', "Total Price per Produk");

		$excel->getActiveSheet()->mergeCells('H4:K4');

		$excel->getActiveSheet()->mergeCells('A4:A5');
		$excel->getActiveSheet()->mergeCells('B4:B5');
		$excel->getActiveSheet()->mergeCells('C4:C5');
		$excel->getActiveSheet()->mergeCells('D4:D5');
		$excel->getActiveSheet()->mergeCells('E4:E5');
		$excel->getActiveSheet()->mergeCells('F4:F5');
		$excel->getActiveSheet()->mergeCells('G4:G5');

		$excel->getActiveSheet()->mergeCells('H4:K4');

		$excel->getActiveSheet()->mergeCells('L4:L5');
		//$excel->getActiveSheet()->mergeCells('M4:M5');

		$excel->getActiveSheet()->getStyle('A1:I2')->getAlignment()->setWrapText(true);

		$excel->getActiveSheet()->getStyle('A4:A5')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('B4:B5')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('C4:C5')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('D4:D5')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('E4:E5')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('F4:F5')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('G4:G5')->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle('L4:L5')->getAlignment()->setWrapText(true);
		//$excel->getActiveSheet()->getStyle('M4:M5')->getAlignment()->setWrapText(true);

		$excel->getActiveSheet()->getStyle('A1')->applyFromArray($style_col_header);

		$excel->getActiveSheet()->getStyle('A4')->applyFromArray($style_col);    
		$excel->getActiveSheet()->getStyle('B4')->applyFromArray($style_col);    
		$excel->getActiveSheet()->getStyle('C4')->applyFromArray($style_col);   
		$excel->getActiveSheet()->getStyle('D4')->applyFromArray($style_col);    
		$excel->getActiveSheet()->getStyle('E4')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('F4')->applyFromArray($style_col);    
		$excel->getActiveSheet()->getStyle('G4')->applyFromArray($style_col);    
		$excel->getActiveSheet()->getStyle('H4:K5')->applyFromArray($style_col);   
		$excel->getActiveSheet()->getStyle('L4')->applyFromArray($style_col);
		//$excel->getActiveSheet()->getStyle('M4')->applyFromArray($style_col);    

		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(27.86);    
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(27.86);    
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(27.86);    
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(28);   
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(28.14);
		$excel->getActiveSheet()->getColumnDimension('F')->setWidth(28);    
		$excel->getActiveSheet()->getColumnDimension('G')->setWidth(29.29);    
		$excel->getActiveSheet()->getColumnDimension('H')->setWidth(79.29);    
		$excel->getActiveSheet()->getColumnDimension('I')->setWidth(19.29);
		$excel->getActiveSheet()->getColumnDimension('J')->setWidth(19.29);    
		$excel->getActiveSheet()->getColumnDimension('K')->setWidth(19.29);   
		$excel->getActiveSheet()->getColumnDimension('L')->setWidth(19.29);    
		//$excel->getActiveSheet()->getColumnDimension('M')->setWidth(19.29);

		$dataSales = $this->db->query("SELECT a.*, b.name AS jasa_pengiriman FROM sales_marketplace_header a LEFT JOIN master_pengiriman b ON b.id = a.delivery_service_id")->result_array();

		// return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($dataSales));
		// $datas = $this->Inventory_4_model->getProductAll();

		$numrow = 6;
		foreach($dataSales AS $data) {
			$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $data["code_order"]);     
			$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data["code_order_marketplace"]);      
			$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data['marketplace']);      
			$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data['customer_name']);     
			$excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data['delivery_date']);
			$excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data['jasa_pengiriman']);
			$excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $this->checkStatus($data['status']));
			$dataSalesDetail = $this->db->query("SELECT a.*, b.nama AS product_name, b.sku_varian AS sku_varian 
													FROM sales_marketplace_detail a 
													JOIN ms_inventory_category3 b ON b.id = a.product_id 
													WHERE a.code_order = '" . $data["code_order"] . "'")->result_array();
			$countDataDetail = count($dataSalesDetail);
			// if ($numrow == 5) {
			// 	$numrow = $numrow + 1;
			// }
			foreach($dataSalesDetail AS $datadetail) {
				$excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $datadetail['product_name']);
				$excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow, $datadetail['sku_varian']);
				$excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow, $datadetail['qty']);
				$excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow, number_format($datadetail['total_price']));
				$numrow++;
			}
			$numrow -= $countDataDetail;
			$excel->setActiveSheetIndex(0)->setCellValue('L'.$numrow, $data['total_price']);
			//$excel->setActiveSheetIndex(0)->setCellValue('M'.$numrow, $data['total_price']);
			$numrow += $countDataDetail;
			// $numrow++;
		}

		$excel->getActiveSheet(0)->setTitle("Template");
		// $excel->setActiveSheetIndex(0);
		ob_end_clean();
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');    
		header('Content-Disposition: attachment; filename="HiroBolt - Data Export Order Excel Marketplace Hirobolt.xlsx"');   
		header('Cache-Control: max-age=0');

		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	}
}
