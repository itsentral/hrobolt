<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Spk_delivery_sj extends Admin_Controller
{
  //Permission
  protected $viewPermission   = 'Surat_Jalan_Delivery.View';
  protected $addPermission    = 'Surat_Jalan_Delivery.Add';
  protected $managePermission = 'Surat_Jalan_Delivery.Manage';
  protected $deletePermission = 'Surat_Jalan_Delivery.Delete';

  public function __construct()
  {
    parent::__construct();

    $this->load->library(array('upload', 'Image_lib'));
    $this->load->model(array(
      'Spk_delivery_sj/spk_delivery_sj_model'
    ));

    date_default_timezone_set('Asia/Bangkok');

    $this->id_user  = $this->auth->user_id();
    $this->datetime = date('Y-m-d H:i:s');
  }

  public function index()
  {
    $this->auth->restrict($this->viewPermission);
    $session  = $this->session->userdata('app_session');

    $listSO = $this->db->get_where('tr_sales_order', array('approve' => 1))->result_array();
    $data = [
      'listSO' => $listSO
    ];
    history("View data delivery surat jalan");
    $this->template->title('Delivery / Surat Jalan');
    $this->template->render('index', $data);
  }

  public function data_side_spk_material()
  {
    $this->spk_delivery_sj_model->data_side_spk_material();
  }

  public function add($no_spk = null)
  {
    if ($this->input->post()) {
      $data = $this->input->post();
      $session = $this->session->userdata('app_session');

      $no_spk_delivery = $data['no_spk_delivery'];
      $no_surat_jalan = $data['no_surat_jalan'];

      $getDetail = $this->db->get_where('spk_delivery_detail_sj_temp a', array('a.created_by' => $this->id_user))->result_array();

      $ArrDetail = [];

      foreach ($getDetail as $key => $value) {
        $ArrDetail[$key]['id_spk'] = $value['id_spk'];
        $ArrDetail[$key]['no_delivery'] = $value['no_delivery'];
        $ArrDetail[$key]['no_so'] = $value['no_so'];
        $ArrDetail[$key]['product_id'] = $value['product_id'];
        $ArrDetail[$key]['qty_order'] = $value['qty_order'];
        $ArrDetail[$key]['qty_spk'] = $value['qty_spk'];
        $ArrDetail[$key]['qty_delivery'] = $value['qty_delivery'];
        $ArrDetail[$key]['barcode_sku'] = $value['barcode_sku'];
        $ArrDetail[$key]['nm_product'] = $value['nm_product'];
        // $ArrDetail[$key]['created_by']   = $this->id_user;
      }

      $ArrHeader = [
        'no_surat_jalan' => $no_surat_jalan,
        'updated_by' => $this->id_user,
        'updated_date' => $this->datetime
      ];

      $this->db->trans_start();

      $this->db->where('no_delivery', $no_spk_delivery);
      $this->db->update('spk_delivery', $ArrHeader);

      $this->db->where('no_delivery', $no_spk_delivery);
      $this->db->delete('spk_delivery_detail_sj');

      if (!empty($ArrDetail)) {
        $this->db->insert_batch('spk_delivery_detail_sj', $ArrDetail);
      }

      $this->db->trans_complete();
      
      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $Arr_Data  = array(
          'pesan'    => 'Save gagal disimpan ...',
          'status'  => 0
        );
      } else {
        $this->db->trans_commit();
        
        $Arr_Data  = array(
          'pesan'    => 'Save berhasil disimpan. Thanks ...',
          'status'  => 1
        );

        $this->db->where('created_by', $this->id_user);
        $this->db->delete('spk_delivery_detail_sj_temp');

        history("Create spk delivery : " . $no_spk);
      }

      echo json_encode($Arr_Data);
    } else {
      $no_spk = $this->uri->segment(3) . "/" . $this->uri->segment(4) . "/" . $this->uri->segment(5) . "/" . $this->uri->segment(6) . "/" . $this->uri->segment(7);
      // return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($no_spk));

      $QUERY = "SELECT
                    a.no_so,
                    a.no_penawaran,
                    a.no_surat AS no_surat_so,
                    b.no_surat AS no_surat_penawaran,
                    c.nm_customer,
                    z.no_delivery,
                    z.no_surat_jalan,
                    z.created_date,
                    z.id,
                    z.status,
                    z.delivery_date,
                    z.delivery_address
                  FROM
                    spk_delivery z
                    LEFT JOIN tr_sales_order a ON a.no_so = z.no_so
                    LEFT JOIN tr_penawaran b ON a.no_penawaran = b.no_penawaran
                    LEFT JOIN master_customers c ON b.id_customer = c.id_customer
                  WHERE z.no_delivery = '" . $no_spk . "' ";

      $getData = $this->db->query($QUERY)->result_array();

      // return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($getData));

      $getDetail = $this->db
        ->select('a.*')
        ->get_where('spk_delivery_detail_sj a', array('a.no_delivery' => $no_spk))->result_array();

        $getDataDetail  = $this->db->select('a.*')->join('tr_sales_order_detail b','a.id_so_det=b.id_so_detail')->get_where('spk_delivery_detail a', array('a.no_delivery' => $no_spk))->result_array();


      $data = [
        'getData' => $getData,
        'getDataDetail' => $getDataDetail,
        'GET_DET_Lv4' => get_inventory_lv4(),
        'getDetail' => $getDetail,
        'no_surat' => $this->spk_delivery_sj_model->BuatNomor(date('d-m-Y')),
      ];

      $this->db->where('created_by', $this->id_user);
      $this->db->delete('spk_delivery_detail_sj_temp');

      $ArrDetail = [];
      foreach ($getDetail as $key => $value) {
        $ArrDetail[$key]['id_spk']      = $value['id_spk'];
        $ArrDetail[$key]['no_delivery'] = $value['no_delivery'];
        $ArrDetail[$key]['no_so']       = $value['no_so'];
        $ArrDetail[$key]['product_id']  = $value['product_id'];
        $ArrDetail[$key]['qty_order']   = $value['qty_order'];
        $ArrDetail[$key]['qty_spk']     = $value['qty_spk'];
        $ArrDetail[$key]['qty_delivery'] = $value['qty_delivery'];
        $ArrDetail[$key]['created_by']   = $this->id_user;
      }

      if (!empty($ArrDetail)) {
        $this->db->insert_batch('spk_delivery_detail_sj_temp', $ArrDetail);
      }

      $this->template->title('Add Surat Jalan');
      $this->template->render('add', $data);
    }
  }

  public function print_spk()
  {
    ob_clean();
		ob_start();

    $kode         = $this->uri->segment(3) . "/" . $this->uri->segment(4) . "/" . $this->uri->segment(5) . "/" . $this->uri->segment(6) . "/" . $this->uri->segment(7);
    $data_session = $this->session->userdata;
    $session      = $this->session->userdata('app_session');
    $printby      = $session['id_user'];

    $data_url     = base_url();
    $Split_Beda   = explode('/', $data_url);
    $Jum_Beda     = count($Split_Beda);
    $Nama_Beda    = $Split_Beda[$Jum_Beda - 2];

    $getData        = $this->db->get_where('spk_delivery', array('no_delivery' => $kode))->result_array();
    $getDataDetail  = $this->db->get_where('spk_delivery_detail_sj', array('no_delivery' => $kode))->result_array();

    $QUERY = "SELECT
                    a.no_surat AS no_surat_so,
                    b.no_surat AS no_surat_penawaran,
                    c.nm_customer,
                    z.no_delivery,
                    z.no_surat_jalan,
                    z.created_date,
                    z.id,
                    z.status,
                    z.delivery_date,
                    z.delivery_address,
                    d.nm_pic AS pic
                  FROM
                    spk_delivery z
                    LEFT JOIN tr_sales_order a ON a.no_so = z.no_so
                    LEFT JOIN tr_penawaran b ON a.no_penawaran = b.no_penawaran
                    LEFT JOIN master_customers c ON b.id_customer = c.id_customer
                    LEFT JOIN customer_pic d ON d.customer_id = c.id_customer
                  WHERE z.no_delivery = '" . $kode . "' ";
    $getData2 = $this->db->query($QUERY)->row_array();

    $data = array(
      'Nama_Beda' => $Nama_Beda,
      'printby' => $printby,
      'getData' => $getData,
      'getData2' => $getData2,
      'getDataDetail' => $getDataDetail,
      'GET_DET_Lv4' => get_inventory_lv4(),
      'kode' => $kode,
      'no_surat_jalan' => $getData[0]['no_surat_jalan'],
    );

    history('Print spk delivery ' . $kode);

    $this->load->view('print_spk', $data);
		$html = ob_get_contents();

		require_once('./assets/html2pdf/html2pdf/html2pdf.class.php');
		$html2pdf = new HTML2PDF('P','A4','en',true,'UTF-8',array(10, 5, 10, 5));
		$html2pdf->writeHTML($html);

    ob_end_clean();
		echo "<script> window.open(".$html2pdf->Output("Surat Jalan HiroBolt.pdf", 'I').", '_blank') </script>";
  }

  public function save_detail_delivery()
  {
    $post = $this->input->post();
    $no_delivery = $post['no_spk_delivery'];
    $username = $this->id_user;
    $datetime = $this->datetime;
    $qr_code = $post['qr_code'];
    $ArrDetail = [];

    $product = $this->db->query("SELECT * FROM ms_inventory_category3 WHERE sku_varian = '$qr_code'")->row();

    // return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($product));

    $getListSPK = $this->db->get_where('spk_delivery_detail', array('no_delivery' => $no_delivery, 'product_id' => $product->id))->result_array();
    
    if (!empty($getListSPK)) {
      $ArrDetail    = [
        'id_spk' => $getListSPK[0]['id'],
        'no_delivery' => $getListSPK[0]['no_delivery'],
        'no_so' => $getListSPK[0]['no_so'],
        'product_id' => $getListSPK[0]['product_id'],
        'qty_order' => $getListSPK[0]['qty_so'],
        'qty_spk' => $getListSPK[0]['qty_delivery'],
        'qty_delivery' => NULL,
        'created_by' => $username,
        'barcode_sku' => $qr_code,
        'nm_product' => $product->nama,
      ];
    }

    $check = $this->db->get_where('spk_delivery_detail_sj_temp', array('no_delivery' => $no_delivery, 'product_id' => $product->id))->row_array();

    $this->db->trans_start();
    
    if (!empty($ArrDetail) and empty($check)) {
      $this->db->insert('spk_delivery_detail_sj_temp', $ArrDetail);
    } else {
      $this->db->where('id', $check['id']);
      $this->db->update('spk_delivery_detail_sj_temp', $ArrDetail);
    }

    $this->db->trans_complete();

    if ($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      $Arr_Data  = array(
        'pesan'    => 'Save gagal disimpan ...',
        'status'  => 0,
        'no_spk' => $no_delivery
      );
    } else {
      $this->db->trans_commit();
      $Arr_Data  = array(
        'pesan'    => 'Save berhasil disimpan. Thanks ...',
        'status'  => 1,
        'no_spk' => $no_delivery
      );
    }

    echo json_encode($Arr_Data);
  }

  public function loadDataSS()
  {
    // return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode());
    $no_spk = $this->input->post('no_spk');
    $result   = $this->db->get_where('spk_delivery_detail_sj_temp', array('no_delivery' => $no_spk))->result_array();

    $data = array(
      'result'      => $result,
      'GET_DET_Lv4' => get_inventory_lv4(),
    );
    $this->template->render('temp_product', $data);
  }

  public function changeDeliveryTemp()
  {
    $post         = $this->input->post();
    $username      = $this->id_user;
    $datetime     = $this->datetime;
    $id_spk        = $post['id_spk'];
    $qty_delivery = $post['qty_delivery'];

    $ArrUpdate = [
      'qty_delivery' => $qty_delivery
    ];

    $this->db->trans_start();
    $this->db->where('id_spk', $id_spk);
    $this->db->where('created_by', $username);
    $this->db->update('spk_delivery_detail_sj_temp', $ArrUpdate);
    $this->db->trans_complete();

    if ($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      $Arr_Data  = array(
        'pesan'    => 'Save gagal disimpan ...',
        'status'  => 0
      );
    } else {
      $this->db->trans_commit();
      $Arr_Data  = array(
        'pesan'    => 'Save berhasil disimpan. Thanks ...',
        'status'  => 1
      );
    }
    echo json_encode($Arr_Data);
  }

  public function deleteDeliveryTemp()
  {
    $post         = $this->input->post();
    $username      = $this->id_user;
    $datetime     = $this->datetime;
    $id_spk        = $post['id_spk'];

    $this->db->trans_start();
    $this->db->where('id_spk', $id_spk);
    $this->db->where('created_by', $username);
    $this->db->delete('spk_delivery_detail_sj_temp');
    $this->db->trans_complete();

    if ($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      $Arr_Data  = array(
        'pesan'    => 'Save gagal disimpan ...',
        'status'  => 0
      );
    } else {
      $this->db->trans_commit();
      $Arr_Data  = array(
        'pesan'    => 'Save berhasil disimpan. Thanks ...',
        'status'  => 1
      );
    }
    echo json_encode($Arr_Data);
  }

  public function deliver_to_customer()
  {
    $post = $this->input->post();
    $username = $this->id_user;
    $datetime = $this->datetime;
    $no_delivery = $post['no_delivery'];

    $getProductSJ = $this->db
      ->select('a.*')
      ->join('spk_delivery_detail b', 'a.no_delivery=b.no_delivery AND a.product_id=b.product_id', 'left')
      ->join('tr_sales_order_detail c', 'b.id_so_det=c.id_so_detail', 'left')
      ->get_where('spk_delivery_detail_sj a', array('a.no_delivery' => $no_delivery))->result_array();
    // $ArrUpdateStokNew = [];

    foreach ($getProductSJ as $key => $value) {
      // $ArrUpdateStokNew[$key]['product_id'] = $value['product_id'];
      // $ArrUpdateStokNew[$key]['no_bom'] = $value['no_bom'];
      // $ArrUpdateStokNew[$key]['stok_aktual'] = $value['qty_delivery'];
      // $ArrUpdateStokNew[$key]['stok_booking'] = 0;
      // $ArrUpdateStokNew[$key]['stok_downgrade'] = $value['qty_delivery'];
      // $ArrUpdateStokNew[$key]['qty'] = $value['qty_delivery'];

      $dataProduct = $this->db->query("SELECT * FROM ms_inventory_category3 WHERE id = '".$value['product_id']."'")->row();
      $dataAccessories = $this->db->query("SELECT a.*, b.kd_gudang AS kode_gudang, c.nm_category AS category_name FROM accessories a JOIN warehouse b ON b.id = a.id_gudang JOIN accessories_category c ON c.id = a.id_category WHERE a.id_stock = '" . $dataProduct->sku_varian . "'")->row();
      $dataWarehouseStock = $this->db->query("SELECT * FROM warehouse_stock WHERE id_material = '" .$dataAccessories->id . "'")->row();

      $dataMinusQtyStockWarehouse = [
        'outgoing' => $dataWarehouseStock->outgoing + $value['qty_delivery'], 
        'qty_stock' => $dataWarehouseStock->qty_stock - $value['qty_delivery']
      ];

      $dataMinusQty = [
        'stok' => $dataProduct->stok -  $value['qty_delivery']
      ];

      $dataWarehouseHistory = [
        'id_material'     => $dataAccessories->id,
        'nm_material'     => $dataAccessories->stock_name,
        'id_category'     => $dataAccessories->id_category,
        'nm_category'     => $dataAccessories->category_name,
        'id_gudang'       => $dataAccessories->id_gudang,
        'kd_gudang'       => $dataAccessories->kode_gudang,
        'incoming_awal'   => $value['qty_delivery'],
        'incoming_akhir'  => $dataWarehouseStock->qty_stock - $value['qty_delivery'],
        'qty_stock_awal'  => $dataWarehouseStock->qty_stock,
        'qty_stock_akhir' => $dataWarehouseStock->qty_stock - $value['qty_delivery'],
        'status_stock'    => 'PENGURANGAN',
        'no_ipp'          => $no_delivery,
        'jumlah_mat'      => $value['qty_delivery'],
        'ket'             => "SALES ORDER B2B",
        // 'surat_jalan'     => $dataOrder->delivery_label,
        'update_by'       => $this->id_user,
        'update_date'     => $this->datetime
      ];
    }

    $this->db->trans_start();
    $this->db->where('no_delivery', $no_delivery);
    // $this->db->update('spk_delivery',array('status'=>'CHECK QC'));
    $this->db->update('spk_delivery', array('status' => 'ON DELIVER'));

    $this->db->where('id', $dataWarehouseStock->id);
    $this->db->update('warehouse_stock', $dataMinusQtyStockWarehouse);

    $this->db->where('id', $dataProduct->id);
    $this->db->update('ms_inventory_category3', $dataMinusQty);

    $this->db->insert("warehouse_history", $dataWarehouseHistory);

    $this->db->trans_complete();

    if ($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      $Arr_Data  = array(
        'pesan'    => 'Save gagal disimpan ...',
        'status'  => 0
      );
    } else {
      $this->db->trans_commit();

      // history_product($ArrUpdateStokNew, 'minus', $no_delivery, 'pengurangan fg dan booking (delivery)');
      $Arr_Data  = array(
        'pesan'    => 'Save berhasil disimpan. Thanks ...',
        'status'  => 1
      );
    }
    echo json_encode($Arr_Data);
  }

  public function confirm($no_spk = null, $tanda = null)
  {
    if ($this->input->post()) {
      $data = $this->input->post();
      $session = $this->session->userdata('app_session');

      $no_delivery = $data['no_delivery'];
      //DATA SPK
      $tgl_dikirim = (!empty($data['tgl_dikirim'])) ? date('Y-m-d', strtotime($data['tgl_dikirim'])) : NULL;
      $tgl_diterima = (!empty($data['tgl_diterima'])) ? date('Y-m-d', strtotime($data['tgl_diterima'])) : NULL;
      $ekspedisi = str_replace(',', '', $data['ekspedisi']);
      $diterima_oleh = str_replace(',', '', $data['diterima_oleh']);
      $file_name = '';

      $dateTime = date('Y-m-d H:i:s');

      $ArrEditHeader = [
        'tgl_dikirim' => $tgl_dikirim,
        'tgl_diterima' => $tgl_diterima,
        'ekspedisi' => $ekspedisi,
        'diterima_oleh' => $diterima_oleh,
        'status' => 'DELIVERY CONFIRMED',
        'confirm_by' => $this->id_user,
        'confirm_date' => $this->datetime
      ];

      //UPLOAD DOCUMENT
      if (!empty($_FILES["upload_spk"]["name"])) {
        $target_dir     = "assets/files/surat_jalan/";
        $target_dir_u   = $_SERVER['DOCUMENT_ROOT'] . "hirobolt_dev/assets/files/surat_jalan/";
        $name_file      = $no_delivery . '_delivery_' . date('Ymdhis');
        $target_file    = $target_dir . basename($_FILES["upload_spk"]["name"]);
        $name_file_ori  = basename($_FILES["upload_spk"]["name"]);
        $imageFileType  = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $nama_upload    = $target_dir_u . $name_file . "." . $imageFileType;
        $file_name      = $name_file . "." . $imageFileType;

        if (!empty($_FILES["upload_spk"]["tmp_name"])) {
          // if($imageFileType <> 'pdf'){
          // 	$Arr_Data	= array(
          // 		'pesan'		=>'Hanya file pdf yang diperbolehkan !!!',
          // 		'status'	=> 0
          // 	);
          // 	echo json_encode($Arr_Data);
          // 	return false;
          // }
          // if($imageFileType == 'pdf'){
          $terupload = move_uploaded_file($_FILES["upload_spk"]["tmp_name"], $nama_upload);
          // if ($terupload) {
          //     echo "Upload berhasil!<br/>";
          // } else {
          //     echo "Upload Gagal!";
          // }
          // }
        }

        $ArrEditHeader['upload_spk'] = $file_name;
      }

      $this->db->trans_start();
      $this->db->where('no_delivery', $no_delivery);
      $this->db->update('spk_delivery', $ArrEditHeader);
      $this->db->trans_complete();

      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $Arr_Data  = array(
          'pesan'    => 'Save gagal disimpan ...',
          'status'  => 0
        );
      } else {
        $this->db->trans_commit();
        $Arr_Data  = array(
          'pesan'    => 'Save berhasil disimpan. Thanks ...',
          'status'  => 1
        );
        history("Delivery receipt : " . $no_delivery);
      }
      echo json_encode($Arr_Data);
    } else {
      $no_spk = $this->uri->segment(3) . "/" . $this->uri->segment(4) . "/" . $this->uri->segment(5) . "/" . $this->uri->segment(6) . "/" . $this->uri->segment(7);
      $tanda = null;
      $QUERY = "SELECT
                    a.no_so,
                    a.no_penawaran,
                    a.no_surat AS no_surat_so,
                    b.no_surat AS no_surat_penawaran,
                    c.nm_customer,
                    z.no_delivery,
                    z.no_surat_jalan,
                    z.created_date,
                    z.id,
                    z.status,
                    z.delivery_date,
                    z.delivery_address,
                    z.tgl_dikirim,
                    z.tgl_diterima,
                    z.ekspedisi,
                    z.diterima_oleh
                  FROM
                    spk_delivery z
                    LEFT JOIN tr_sales_order a ON a.no_so = z.no_so
                    LEFT JOIN tr_penawaran b ON a.no_penawaran = b.no_penawaran
                    LEFT JOIN master_customers c ON b.id_customer = c.id_customer
                  WHERE z.no_delivery = '" . $no_spk . "' ";
      $getData = $this->db->query($QUERY)->result_array();

      $getDetail = $this->db
        ->select('a.*')
        ->get_where('spk_delivery_detail_sj a', array('a.no_delivery' => $no_spk))->result_array();

      $data = [
        'getData' => $getData,
        'GET_DET_Lv4' => get_inventory_lv4(),
        'getDetail' => $getDetail,
        'tanda' => $tanda
      ];

      $this->template->title('Delivery Receipt');
      $this->template->render('confirm', $data);
    }
  }

  public function request_to_subgudang()
  {
    $data         = $this->input->post();
    $session      = $this->session->userdata('app_session');

    $id        = $data['id'];
    $detail    = $data['detail'];
    $mix1      = str_replace(',', '', $data['mix1']);
    $mix2      = str_replace(',', '', $data['mix2']);
    $mix3      = str_replace(',', '', $data['mix3']);
    $mix4      = str_replace(',', '', $data['mix4']);
    $mix5      = str_replace(',', '', $data['mix5']);
    $mix6      = str_replace(',', '', $data['mix6']);
    $mix7      = str_replace(',', '', $data['mix7']);
    $getdata = $this->db->get_where('so_internal_spk', array('id' => $id))->result_array();

    $ArrUpdateMat = [];
    foreach ($detail as $key => $value) {
      $ArrUpdateMat[$key]['id'] = $value['id'];
      $ArrUpdateMat[$key]['mix1'] = (!empty($value['mix1'])) ? $value['mix1'] : null;
      $ArrUpdateMat[$key]['mix2'] = (!empty($value['mix2'])) ? $value['mix2'] : null;
      $ArrUpdateMat[$key]['mix3'] = (!empty($value['mix3'])) ? $value['mix3'] : null;
      $ArrUpdateMat[$key]['mix4'] = (!empty($value['mix4'])) ? $value['mix4'] : null;
      $ArrUpdateMat[$key]['mix5'] = (!empty($value['mix5'])) ? $value['mix5'] : null;
      $ArrUpdateMat[$key]['mix6'] = (!empty($value['mix6'])) ? $value['mix6'] : null;
      $ArrUpdateMat[$key]['mix7'] = (!empty($value['mix7'])) ? $value['mix7'] : null;
    }

    $ArrUpdate = array(
      'sts_request' => 'Y',
      'mix1' => $mix1,
      'mix2' => $mix2,
      'mix3' => $mix3,
      'mix4' => $mix4,
      'mix5' => $mix5,
      'mix6' => $mix6,
      'mix7' => $mix7,
      'request_by' => $this->id_user,
      'request_date' => $this->datetime
    );

    $this->db->where('id', $id);
    $this->db->update('so_internal_spk', $ArrUpdate);

    $this->db->update_batch('so_internal_spk_material', $ArrUpdateMat, 'id');

    $Arr_Data  = array(
      'status'    => 1,
      'id'    => $id,
      'kode_det'    => $getdata[0]['kode_det'],
    );
    echo json_encode($Arr_Data);
  }

  public function plan_mixing_add($id)
  {
    $this->auth->restrict($this->viewPermission);
    $session  = $this->session->userdata('app_session');

    $getDataSPK = $this->db->get_where('so_internal_spk', array('id' => $id))->result_array();
    $getData = $this->db->get_where('so_internal', array('id' => $getDataSPK[0]['id_so']))->result_array();
    $getMaterialMixing    = $this->db->select('code_material, weight AS berat, id')->where('kode_det', $getDataSPK[0]['kode_det'])->get_where('so_internal_spk_material', array('type_name' => 'mixing'))->result_array();


    $data = [
      'id' => $id,
      'getDataSPK' => $getDataSPK,
      'getData' => $getData,
      'GET_DET_Lv4' => get_inventory_lv4(),
      'getMaterialMixing' => $getMaterialMixing,
    ];

    $this->template->title('Plan Mixing');
    $this->template->render('plan_mixing', $data);
  }

  //Re-Print SPK
  public function reprint_spk()
  {
    $this->auth->restrict($this->viewPermission);
    $session  = $this->session->userdata('app_session');
    $this->template->page_icon('fa fa-users');

    $this->template->title('SPK Re-Print');
    $this->template->render('reprint_spk');
  }

  public function data_side_spk_reprint()
  {
    $this->spk_delivery_sj_model->data_side_spk_reprint();
  }
}
