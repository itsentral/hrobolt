<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Incoming_stok extends Admin_Controller
{
  //Permission
  protected $viewPermission   = 'Incoming_Stock.View';
  protected $addPermission    = 'Incoming_Stock.Add';
  protected $managePermission = 'Incoming_Stock.Manage';
  protected $deletePermission = 'Incoming_Stock.Delete';

  public function __construct()
  {
    parent::__construct();

    $this->load->library(array('upload', 'Image_lib'));
    $this->load->model(array(
      'Incoming_stok/incoming_stok_model'
    ));
    // $this->template->title('Manage Data Supplier');

    date_default_timezone_set('Asia/Bangkok');

    $this->id_user  = $this->auth->user_id();
    $this->datetime = date('Y-m-d H:i:s');
  }

  public function index()
  {
    $this->auth->restrict($this->viewPermission);
    $session  = $this->session->userdata('app_session');

    history("View data incoming stok");
    $this->template->title('Gudang Stok / Incoming Stok');
    $this->template->render('index');
  }

  public function data_side_request_material()
  {
    $this->incoming_stok_model->data_side_request_material();
  }

  public function draft()
  {
    if ($this->input->post()) {
      $data           = $this->input->post();
      $session        = $this->session->userdata('app_session');

      if (!empty($data['Detail'])) {
        $detail = $data['Detail'];
      }

      $ArrUpdatePO      = [];

      if (!empty($data['Detail'])) {
        foreach ($detail as $val => $valx) {
          $qty_incoming   = str_replace(',', '', $valx['qty_in']);

          if ($qty_incoming > 0) {
            $getIncoming  = $this->db->get_where('dt_trans_po', array('id' => $valx['id']))->result_array();
            $ArrUpdatePO[$val]['id']       = $valx['id'];
            // if ($qtyIn == 0) {
            //   $ArrUpdatePO[$val]['qty_in']   = $qtyIn + $qty_incoming;
            // } else {
              
            // }
            $ArrUpdatePO[$val]['qty_in']   = $qty_incoming;
          }
        }
      }

      $this->db->trans_start();

      if (!empty($ArrUpdatePO)) {
        $this->db->update_batch('dt_trans_po', $ArrUpdatePO, 'id');
      }

      $this->db->trans_complete();

      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $Arr_Data  = array(
          'pesan'    => 'Drat gagal disimpan ...',
          'status'  => 0
        );
      } else {
        $this->db->trans_commit();
        $Arr_Data  = array(
          'pesan'    => 'Draft berhasil disimpan. Thanks ...',
          'status'  => 1,
        );
      }

      return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($Arr_Data));
      // echo json_encode($Arr_Data);
    } else {

    }
  }

  public function request_stok($id = null)
  {
    if ($this->input->post()) {
      $data           = $this->input->post();
      $session        = $this->session->userdata('app_session');
      $no_po          = $data['no_po'];
      $no_po          = implode(',', $no_po);
      $id_gudang      = $data['id_gudang'];
      $pic            = $data['pic'];
      $keterangan     = $data['keterangan'];
      $tanggal        = date('Y-m-d', strtotime($data['tanggal']));

      if (!empty($data['Detail'])) {
        $detail = $data['Detail'];
      }
      // exit;
      $kode_trans = generateNoTransaksiLainnya();
      $GET_ACC    = get_accessories();

      $ArrInsertDetail  = array();
      $ArrStock         = [];
      $ArrUpdatePO      = [];
      $SUM_MAT          = 0;

      if (!empty($data['Detail'])) {
        foreach ($detail as $val => $valx) {
          $qty_incoming   = str_replace(',', '', $valx['qty_in']);
          if ($qty_incoming > 0) {
            $SUM_MAT  += $qty_incoming;
            //detail adjustment
            $ArrInsertDetail[$val]['kode_trans']    = $kode_trans;
            $ArrInsertDetail[$val]['no_ipp']        = $valx['id'];
            $ArrInsertDetail[$val]['id_material']   = $valx['id_barang'];
            $ArrInsertDetail[$val]['nm_material']   = $valx['nm_barang'];
            $ArrInsertDetail[$val]['qty_order']     = $valx['qty_in'];
            $ArrInsertDetail[$val]['qty_oke']       = $qty_incoming;
            $ArrInsertDetail[$val]['keterangan']    = $valx['ket'];
            $ArrInsertDetail[$val]['update_by']     = $this->id_user;
            $ArrInsertDetail[$val]['update_date']   = $this->datetime;

            // menambahkan stock ke table product
            $dataProduk = $this->db->query("SELECT a.id AS id, a.stok AS stok FROM ms_inventory_category3 a JOIN accessories b ON b.id_stock = a.sku_varian WHERE b.id = " .$valx['id_barang'])->row();
            $this->db->where('id', $dataProduk->id);
            $this->db->update('ms_inventory_category3', [
              'stok' => $dataProduk->stok + $qty_incoming
            ]);

            $dataWarehouseStock = $this->db->query("SELECT * FROM warehouse_stock WHERE id_material = '" . $valx['id_barang'] . "'")->row();

            if (isset($dataWarehouseStock)) {
              $dataStock = [
                'begining' => $dataWarehouseStock->qty_stock,
                'incoming' => $dataWarehouseStock->incoming + $qty_incoming,
                'qty_stock' => $dataWarehouseStock->qty_stock + $qty_incoming,
                'update_by' => $this->id_user,
                'update_date' => $this->datetime,
              ];

              $this->db->where('id', $dataWarehouseStock->id);
              $this->db->update('warehouse_stock', $dataStock);
            } else {
              $dataFinishGoods = $this->db->query("SELECT a.id, b.id AS category_id, b.nm_category AS name_category FROM accessories 
                                                    a JOIN accessories_category b ON b.id = a.id_category WHERE a.id = '" . $valx['id_barang'] . "'")->row();

              $warehouseData = $this->db->query("SELECT * FROM warehouse WHERE id = $id_gudang")->row();

              $dataStock = [
                'id_material' => $valx['id_barang'],
                'nm_material' => $valx['nm_barang'],
                'id_gudang'   => $id_gudang,
                'kd_gudang'   => $warehouseData->nm_gudang,
                'id_category' => $dataFinishGoods->category_id,
                'nm_category' => $dataFinishGoods->name_category,
                'begining'    => $qty_incoming,
                'incoming'    => $qty_incoming,
                'qty_stock'   => $qty_incoming,
                'update_by'   => $this->id_user,
                'update_date' => $this->datetime,
              ];

              $this->db->insert('warehouse_stock', $dataStock);
            }

            $dataAccessories = $this->db->query("SELECT a.*, b.kd_gudang AS kode_gudang, c.nm_category AS category_name FROM accessories a JOIN warehouse b ON b.id = a.id_gudang JOIN accessories_category c ON c.id = a.id_category WHERE a.id = '" . $valx['id_barang'] . "'")->row();

            $dataWarehouseHistory = [
              'id_material'     => $dataAccessories->id,
              'nm_material'     => $dataAccessories->stock_name,
              'id_category'     => $dataAccessories->id_category,
              'nm_category'     => $dataAccessories->category_name,
              'id_gudang'       => $dataAccessories->id_gudang,
              'kd_gudang'       => $dataAccessories->kode_gudang,
              'incoming_awal'   => $qty_incoming,
              'incoming_akhir'  => $dataWarehouseStock->qty_stock + $qty_incoming,
              'qty_stock_awal'  => $dataWarehouseStock->qty_stock,
              'qty_stock_akhir' => $dataWarehouseStock->qty_stock + $qty_incoming,
              'status_stock'    => 'PENAMBAHAN',
              'no_ipp'          => $kode_trans,
              'jumlah_mat'      => $qty_incoming,
              'ket'             => "INCOMING STOCK WAREHOUSE",
              'update_by'       => $this->id_user,
              'update_date'     => $this->datetime
            ];
  
            $this->db->insert("warehouse_history", $dataWarehouseHistory);
          }
        }
      }
      // exit;

      $ArrInsert = array(
        'kode_trans'       => $kode_trans,
        'tanggal'          => $tanggal,
        'no_ipp'           => $no_po,
        'category'         => 'incoming stok',
        'jumlah_mat'       => $SUM_MAT,
        'pic'              => $pic,
        'note'             => $keterangan,
        'kd_gudang_dari'   => 'PURCHASE',
        'id_gudang_ke'     => $id_gudang,
        'kd_gudang_ke'     => strtoupper(get_name('warehouse', 'kd_gudang', 'id', $id_gudang)),
        'created_by'       => $this->id_user,
        'created_date'     => $this->datetime
      );

      $this->db->trans_start();

      $updatePO = [
        'status' => 3
      ];

      $this->db->where('no_po', $no_po);
      $this->db->update('tr_purchase_order', $updatePO);

      if (!empty($ArrInsertDetail)) {
        $this->db->insert('warehouse_adjustment', $ArrInsert);
        $this->db->insert_batch('warehouse_adjustment_detail', $ArrInsertDetail);
      }

      if (!empty($ArrUpdatePO)) {
        $this->db->update_batch('dt_trans_po', $ArrUpdatePO, 'id');
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
          'status'  => 1,
        );
        move_warehouse_stok($ArrStock, NULL, $id_gudang, $kode_trans, null);
        history("Incoming barang stok : " . $kode_trans);
      }

      echo json_encode($Arr_Data);
    } else {

      $listGudang     = $this->db->get_where('warehouse', array('desc' => 'Stok'))->result_array();
      $listGudangKe   = $this->db->order_by('urut', 'ASC')->get_where('warehouse', array('desc' => 'costcenter'))->result_array();

      $countListNomorPO = $this->db
        ->select('b.no_surat, b.no_po')
        ->group_by('a.no_po')
        ->order_by('b.no_surat', 'ASC')
        ->join('tr_purchase_order b', 'a.no_po=b.no_po', 'left')
        ->where('a.qty_in < a.qty')
        ->get_where(
          'dt_trans_po a',
          array(
            'b.status' => '2',
            'a.idmaterial !=' => '',
            'SUBSTRING(a.idmaterial, 1, 1) !=' => 'M'
          )
        )
        ->num_rows();
      if ($countListNomorPO > 0) {
        $listNomorPO = $this->db
          ->select('b.no_surat, b.no_po')
          ->group_by('a.no_po')
          ->order_by('b.no_surat', 'ASC')
          ->join('tr_purchase_order b', 'a.no_po=b.no_po', 'left')
          ->where('a.qty_in < a.qty')
          ->get_where(
            'dt_trans_po a',
            array(
              'b.status' => '2',
              'a.idmaterial !=' => '',
              'SUBSTRING(a.idmaterial, 1, 1) !=' => 'M'
            )
          )
          ->result_array();
      } else {
        $listNomorPO = '';
      }
      // echo $this->db->last_query();
      // exit;

      $get_list_supplier = $this->db->select('code_supplier, name_suplier')->get_where('master_supplier', ['deleted_by' => null])->result();

      $data = [
        'listGudang' => $listGudang,
        'listGudangKe' => $listGudangKe,
        'listNomorPO' => $listNomorPO,
        'GET_MATERIAL' => get_inventory_lv4(),
        'listSupplier' => $get_list_supplier
      ];
      $this->template->title('Incoming Stok');
      $this->template->render('request', $data);
    }
  }

  public function print_incoming_stok()
  {
    $kode_trans  = $this->uri->segment(3);
    $data_session  = $this->session->userdata;
    $session        = $this->session->userdata('app_session');
    $printby    = get_name('users', 'nm_lengkap', 'id_user', $session['id_user']);

    $data_url    = base_url();
    $Split_Beda    = explode('/', $data_url);
    $Jum_Beda    = count($Split_Beda);
    $Nama_Beda    = $Split_Beda[$Jum_Beda - 2];

    $getData = $this->db->get_where('warehouse_adjustment a', array(
      'a.kode_trans' => $kode_trans
    ))
      ->result_array();

    $getDataDetail  = $this->db->get_where('warehouse_adjustment_detail a', array(
      'a.kode_trans' => $kode_trans
    ))
      ->result_array();


    $no_po = [];
    $get_no_po = $this->db->query("SELECT a.no_surat FROM tr_purchase_order a WHERE a.no_po IN ('" . str_replace(",", "','", $getData[0]['no_ipp']) . "')")->result();
    foreach ($get_no_po as $item) {
      $no_po[] = $item->no_surat;
    }
    $no_po = implode(', ', $no_po);

    $data = array(
      'Nama_Beda' => $Nama_Beda,
      'printby' => $printby,
      'getData' => $getData,
      'getDataDetail' => $getDataDetail,
      'GET_MATERIAL' => get_accessories(),
      'GET_SATUAN' => get_list_satuan(),
      'kode' => $kode_trans,
      'no_po' => $no_po
    );

    history('Print spk request material ' . $kode_trans);
    $this->load->view('print_incoming_stok', $data);
  }

  public function detail($kode_trans)
  {
    // $kode_trans  = $this->uri->segment(3);

    $data_url    = base_url();
    $Split_Beda  = explode('/', $data_url);
    $Jum_Beda    = count($Split_Beda);
    $Nama_Beda   = $Split_Beda[$Jum_Beda - 2];

    $getData = $this->db->get_where('warehouse_adjustment a', array(
      'a.kode_trans' => $kode_trans
    ))
      ->result_array();

    $getDataDetail  = $this->db->get_where('warehouse_adjustment_detail a', array(
      'a.kode_trans' => $kode_trans
    ))
      ->result_array();

    $no_po = [];
    $get_no_po = $this->db->query("SELECT a.no_surat FROM tr_purchase_order a WHERE a.no_po IN ('" . str_replace(",", "','", $getData[0]['no_ipp']) . "')")->result();
    foreach ($get_no_po as $item) {
      $no_po[] = $item->no_surat;
    }
    $no_po = implode(', ', $no_po);

    $data = array(
      'getData' => $getData,
      'getDataDetail' => $getDataDetail,
      'GET_MATERIAL' => get_accessories(),
      'GET_SATUAN' => get_list_satuan(),
      'kode' => $kode_trans,
      'no_po' => $no_po
    );

    $this->load->view('detail', $data);
  }

  public function detail_purchasing_order()
  {
    $no_po        = $this->input->post('no_po');
    $no_po        = implode(',', $no_po);
    $id_gudang    = $this->input->post('id_gudang');

    $categoryGudang = getPembedaAccessories($id_gudang);

    // AND a.qty_in < a.qty

    $detail = $this->db->query("
                  SELECT 
                    a.id,
                    a.idmaterial as idmaterial,
                    a.namamaterial as namamaterial,
                    b.konversi as konversi,
                    a.qty as qty_po,
                    a.qty_in as qty_in,
                    b.id_stock,
                    d.code as satuan_unit
                  FROM
                    dt_trans_po a
                    LEFT JOIN accessories b ON a.idmaterial = b.id
                    LEFT JOIN accessories_category c ON b.id_category = c.id
                    LEFT JOIN ms_satuan d ON d.id = b.id_unit
                  WHERE
                    a.no_po IN ('" . str_replace(",", "','", $no_po) . "')
                    AND c.outgoing = '" . $categoryGudang . "'
                ")->result_array();
    // print_r($detail);
    // echo $this->db->last_query();
    $d_Header = "";
    // $d_Header .= "<tr>";
    $id = 0;
    if (!empty($detail)) {
      foreach ($detail as $key => $value) {
        $id++;
        $d_Header .= "<tr>";
        $d_Header .= "<td align='center'>" . $id . "</td>";
        $d_Header .= "<td align='center'>" . $value['idmaterial'] . "</td>";
        $d_Header .= "<td align='left'>" . $value['id_stock'] . "</td>";
        $d_Header .= "<td align='left'>" . $value['namamaterial'] . "</td>";
        $d_Header .= "<td align='center'>" . number_format($value['qty_po'], 2) . "</td>";
        $d_Header .= "<td align='center'>" . strtoupper($value['satuan_unit']) . "</td>";
        $d_Header .= "<td align='center'>" . number_format($value['qty_in'], 2) . "</td>";
        $d_Header .= "<td align='center' class='qty_max'>" . number_format($value['qty_po'] - $value['qty_in'], 2) . "</td>";
        $d_Header .= "<td align='left'>";
        $d_Header .= "<input type='text' name='Detail[" . $id . "][qty_in]' id='qty_in_stok_incoming".$value['idmaterial']."' class='form-control text-center input-md autoNumeric4 qty_in' value='" . $value['qty_in'] . "' />";
        $d_Header .= "<input type='hidden' name='Detail[" . $id . "][id]' value='" . $value['id'] . "'>";
        $d_Header .= "<input type='hidden' name='Detail[" . $id . "][qty_po]' value='" . $value['qty_po'] . "'>";
        $d_Header .= "<input type='hidden' name='Detail[" . $id . "][id_barang]' value='" . $value['idmaterial'] . "'>";
        $d_Header .= "<input type='hidden' name='Detail[" . $id . "][nm_barang]' value='" . $value['namamaterial'] . "'>";
        $d_Header .= "</td>";
        $d_Header .= "<td align='left'>";
        $d_Header .= "<input type='text' name='Detail[" . $id . "][ket]' class='form-control input-md'>";
        $d_Header .= "</td>";
        $d_Header .= "</tr>";
      }
    } else {
      $d_Header .= "<tr>";
      $d_Header .= "<td colspan='8'><b>Data tidak ada atau <span class='text-red'>gudang yang dipilih tidak sesuai</span> !!!</b></td>";
      $d_Header .= "</tr>";
    }

    echo json_encode(array(
      'header' => $d_Header,
    ));
  }

  public function pilih_supplier()
  {
    $kode_supplier = $this->input->post('kode_supplier');

    $countListNomorPO = $this->db
                              ->select('b.no_surat, b.no_po')
                              ->group_by('a.no_po')
                              ->order_by('b.no_surat', 'ASC')
                              ->join('tr_purchase_order b', 'a.no_po=b.no_po', 'left')
                              // ->where('a.qty_in < a.qty')
                              ->get_where(
                                'dt_trans_po a',
                                array(
                                  'b.status' => '2',
                                  'a.idmaterial !=' => '',
                                  'SUBSTRING(a.idmaterial, 1, 1) !=' => 'M',
                                  'b.id_suplier' => $kode_supplier
                                )
                              )
                              ->num_rows();
    
    if ($countListNomorPO > 0) {
        $listNomorPO = $this->db
          ->select('b.no_surat, b.no_po')
          ->group_by('a.no_po')
          ->order_by('b.no_surat', 'ASC')
          ->join('tr_purchase_order b', 'a.no_po=b.no_po', 'left')
          // ->where('a.qty_in < a.qty')
          ->get_where(
            'dt_trans_po a',
            array(
              'b.status' => '2',
              'a.idmaterial !=' => '',
              'SUBSTRING(a.idmaterial, 1, 1) !=' => 'M',
              'b.id_suplier' => $kode_supplier
            )
          )
          ->result();
    } else {
      $listNomorPO = '';
    }

    $hasil = '';
    if (!empty($listNomorPO)) {
      foreach ($listNomorPO as $item) {

        $no_pr = [];
        $get_no_pr = $this->db->query("
          SELECT
            b.no_pr
          FROM
            material_planning_base_on_produksi_detail a
            JOIN material_planning_base_on_produksi b ON b.so_number = a.so_number
          WHERE
            a.id IN (SELECT aa.idpr FROM dt_trans_po aa WHERE aa.no_po = '" . $item->no_po . "' AND (aa.tipe IS NULL OR aa.tipe = ''))
          GROUP BY b.no_pr

          UNION ALL

          SELECT
            b.no_pr
          FROM
            non_rutin_planning_detail a
            JOIN non_rutin_planning_header b ON b.no_pengajuan = a.no_pengajuan
          WHERE
            a.id IN (SELECT aa.idpr FROM dt_trans_po aa WHERE aa.no_po = '" . $item->no_po . "' AND aa.tipe = 'pr depart')
          GROUP BY b.no_pr
        ")->result();
        foreach ($get_no_pr as $item_pr) {
          $no_pr[] = $item_pr->no_pr;
        }

        $no_pr = implode(', ', $no_pr);

        $hasil .= '<tr>';
        $hasil .= '<td class="text-center">' . $item->no_po . '</td>';
        $hasil .= '<td class="text-center">' . $no_pr . '</td>';
        $hasil .= '<td class="text-center"><input type="checkbox" name="no_po[]" class="check_po" value="' . $item->no_po . '"></td>';
        $hasil .= '</tr>';
      }
    }

    echo $hasil;
  }

  public function getDataStockbyBarcode()
  {
    $sku = $this->input->post('value');

    $data = $this->db->query("SELECT id AS id_material, id_stock FROM accessories WHERE id_stock = '$sku'")->row();

    if ($data) {
      $data = [
        'status' => 'OK',
        'code' => 200,
        'message' => 'Berhasil Ambil Data',
        'data' => $data
      ];
    } else {
      $data = [
        'status' => 'NOK',
        'code' => 404,
        'message' => 'Gagal Ambil Data',
      ];
    }

    return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));
  }
}
