<?php

use function PHPSTORM_META\map;

defined('BASEPATH') OR exit('No direct script access allowed');

class Packing extends Admin_Controller
{
    //Permission
    protected $viewPermission 	= 'Packing.View';
    protected $addPermission  	= 'Packing.Add';
    protected $managePermission = 'Packing.Manage';
    protected $deletePermission = 'Packing.Delete';

    public function __construct()
    {
      parent::__construct();

      // $this->load->library(array( 'upload', 'Image_lib'));
      $this->load->model(array('Packing/packing_model'
                              ));
      $this->template->title('Manage Packing');
      $this->template->page_icon('fa fa-building-o');

      date_default_timezone_set('Asia/Bangkok');

      $this->id_user  = $this->auth->user_id();
      $this->datetime = date('Y-m-d H:i:s');
    }

    public function index()
    {
      $this->auth->restrict($this->viewPermission);
      $session = $this->session->userdata('app_session');
      $this->template->page_icon('fa fa-users');

      $data = $this->db->query("SELECT a.*, b.name AS nama_pengiriman FROM sales_marketplace_header a 
                                  LEFT JOIN master_pengiriman b 
                                  ON b.id = a.delivery_service_id 
                                  WHERE a.status IN(3,4,5) 
                                  AND a.customer_name IS NOT NULL 
                                  ORDER BY a.created_at DESC")->result();

      $data = [
        'data' => $data
      ];

      // return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));
      
      $this->template->title('Packing Index');
      $this->template->set('results', $data);
      $this->template->render('index');
    }

    public function scanbarcode()
    {
      $data = $this->input->post();

      $dataProduct = $this->db->query("SELECT 
                                        a.id AS id,
                                        a.product_id AS product_id, 
                                        a.qty AS qty_barang, 
                                        b.nama AS nama_produk,
                                        b.sku_varian AS sku 
                                        FROM sales_marketplace_detail a 
                                        LEFT JOIN ms_inventory_category3 b 
                                        ON b.id = a.product_id 
                                        WHERE b.sku_varian = '".$data['value']."' 
                                        AND a.code_order = '" .$data['code_order']. "'"
                                    )->row();

      if ($dataProduct) {
        $dataSave = [
          'qty_check' => $data['value']
        ];
  
        $this->db->where('code_order', $data['code_order']);
        $this->db->where('product_id', $dataProduct->product_id);
        $this->db->update('sales_marketplace_detail', $dataSave);

        $data = [
          'status' => 'OK',
          'code' => 200,
          'product' => $dataProduct
        ];
      } else {
        $data = [
          'status' => 'NOK',
          'code' => 404,
          'message' => 'Produk Tidak Ditemukan'
        ];
      }

      return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function savePacking()
    {
      $this->auth->restrict($this->addPermission);
      $session = $this->session->userdata('app_session');

      $codeOrder = $this->input->post('code_order');
      $productIds = $this->input->post('product_id');
      $qtyActuals = $this->input->post('produk_qty_aktual');

      $dataCodeOrder = $this->db->query("SELECT COUNT(*) AS totalOrder FROM sales_marketplace_detail WHERE code_order = '$codeOrder'")->row();

      foreach ($productIds as $key => $value) {
          if (!strlen($value)) {
            unset($productIds[$key]);
          }
      }

      $dataOrder = $this->db->query("SELECT * FROM sales_marketplace_header WHERE code_order = '$codeOrder'")->row();

      if (count($productIds) == $dataCodeOrder->totalOrder) {
        foreach($productIds AS $key => $productId) {
          $data = [
            'qty_check' => $qtyActuals[$key]
          ];

          $dataProduct = $this->db->query("SELECT * FROM ms_inventory_category3 WHERE id = $productId")->row();
          $dataAccessories = $this->db->query("SELECT a.*, b.kd_gudang AS kode_gudang, c.nm_category AS category_name FROM accessories a JOIN warehouse b ON b.id = a.id_gudang JOIN accessories_category c ON c.id = a.id_category WHERE a.id_stock = '" . $dataProduct->sku_varian . "'")->row();
          $dataWarehouseStock = $this->db->query("SELECT * FROM warehouse_stock WHERE id_material = '" .$dataAccessories->id . "'")->row();

          $dataMinusQtyStockWarehouse = [
            'outgoing' => $dataWarehouseStock->outgoing + $qtyActuals[$key], 
            'qty_stock' => $dataWarehouseStock->qty_stock - $qtyActuals[$key]
          ];

          $this->db->where('id', $dataWarehouseStock->id);
          $this->db->update('warehouse_stock', $dataMinusQtyStockWarehouse);

          $dataMinusQty = [
            'stok' => $dataProduct->stok - $qtyActuals[$key]
          ];

          $this->db->where('id', $dataProduct->id);
          $this->db->update('ms_inventory_category3', $dataMinusQty);
  
          $this->db->where('code_order', $codeOrder);
          $this->db->where('product_id', $productId);
          $this->db->update('sales_marketplace_detail', $data);

          $dataWarehouseHistory = [
            'id_material'     => $dataAccessories->id,
            'nm_material'     => $dataAccessories->stock_name,
            'id_category'     => $dataAccessories->id_category,
            'nm_category'     => $dataAccessories->category_name,
            'id_gudang'       => $dataAccessories->id_gudang,
            'kd_gudang'       => $dataAccessories->kode_gudang,
            'incoming_awal'   => $qtyActuals[$key],
            'incoming_akhir'  => $dataWarehouseStock->qty_stock - $qtyActuals[$key],
            'qty_stock_awal'  => $dataWarehouseStock->qty_stock,
            'qty_stock_akhir' => $dataWarehouseStock->qty_stock - $qtyActuals[$key],
            'status_stock'    => 'PENGURANGAN',
            'no_ipp'          => $codeOrder,
            'jumlah_mat'      => $qtyActuals[$key],
            'ket'             => "SALES ORDER MARKETPLACE",
            'surat_jalan'     => $dataOrder->delivery_label,
            'update_by'       => $this->id_user,
            'update_date'     => $this->datetime
          ];

          $this->db->insert("warehouse_history", $dataWarehouseHistory);
        }
  
        $data = [
          'status' => 4
        ];
  
        $this->db->where('code_order', $codeOrder);
        $this->db->update('sales_marketplace_header', $data);
  
        $data = [
          'status' => 'OK',
          'code' => 200,
          'message' => 'Sukses Menyimpan Data'        
        ];
      } else {
        $data = [
          'status' => 'NOK',
          'code' => 404,
          'message' => 'Data Produk Order Masih Kurang atau Berlebih'        
        ];
      }

      return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function printLabel()
    {
      $codeOrder = $this->input->post('codeOrder');

      $data = [
        'status' => 5
      ];

      $this->db->trans_start();

      $this->db->where('code_order', $codeOrder);
      $this->db->update('sales_marketplace_header', $data);

      $this->db->trans_complete();

      if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        $data = [
          'status' => 'NOK',
          'code' => 404,
          'message' => 'Data Gagal diupdate'        
        ];
      } else {
        $this->db->trans_commit();
        $data = [
          'status' => 'OK',
          'code' => 200,
          'message' => 'Sukses Mengupdate Data'        
        ];
      }

      return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));
    }
}
?>
