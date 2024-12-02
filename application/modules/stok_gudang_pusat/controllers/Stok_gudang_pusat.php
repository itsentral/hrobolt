<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stok_gudang_pusat extends Admin_Controller
{
  //Permission
  protected $viewPermission   = 'Gudang_Pusat_Stok.View';
  protected $addPermission    = 'Gudang_Pusat_Stok.Add';
  protected $managePermission = 'Gudang_Pusat_Stok.Manage';
  protected $deletePermission = 'Gudang_Pusat_Stok.Delete';

  public function __construct()
  {
    parent::__construct();
    $this->load->model(array(
      'Stok_gudang_pusat/stok_gudang_pusat_model'
    ));
    $this->template->title('Manage Data Supplier');
    $this->template->page_icon('fa fa-building-o');

    date_default_timezone_set('Asia/Bangkok');
  }

  //==========================================================================================================
  //============================================STOCK=========================================================
  //==========================================================================================================

  public function index()
  {
    $this->auth->restrict($this->viewPermission);
    $session  = $this->session->userdata('app_session');

    history("View data gudang pusat");
    $this->template->title('Gudang Material / Gudang Pusat / Stok');
    $this->template->render('index');
  }

  public function data_side_stock()
  {
    $this->stok_gudang_pusat_model->get_json_stock();
  }

  public function modal_history()
  {
    $data     = $this->input->post();
    $gudang   = $data['gudang'];
    $material = $data['material'];

    $sql = "SELECT a.*, b.konversi FROM warehouse_history a LEFT JOIN new_inventory_4 b ON b.code_lv4 = a.id_material WHERE a.id_gudang='" . $gudang . "' AND a.id_material='" . $material . "' ORDER BY a.id ASC ";
    $data = $this->db->query($sql)->result_array();

    $dataArr = array(
      'gudang' => $gudang,
      'material' => $material,
      'data'  => $data
    );
    $this->load->view('modal_history', $dataArr);
  }
  public function modal_lot_detail()
  {
    $data     = $this->input->post();
    $gudang   = $data['gudang'];
    $material = $data['material'];

    // $sql = "SELECT a.* FROM warehouse_history a WHERE a.id_gudang='" . $gudang . "' AND a.id_material='" . $material . "' ORDER BY a.id ASC ";
    // $data = $this->db->query($sql)->result_array();

    $data = $this->db->select('a.*, b.nm_lengkap, c.konversi as nil_kon')
    ->from('tr_checked_incoming_detail a')
    ->join('users b', 'b.id_user = a.created_by', 'left')
    ->join('new_inventory_4 c', 'c.code_lv4 = a.id_material', 'left')
    ->where('a.id_material', $material)
    ->where('a.sts', '1')
    ->where('(a.qty_oke - a.qty_used) >', 0)
    ->get()
    ->result_array();

    // print_r($data);
    // exit;

    $dataArr = array(
      'gudang' => $gudang,
      'material' => $material,
      'data'  => $data
    );
    $this->load->view('modal_lot_detail', $dataArr);
  }

  public function export_excel($material, $gudang){

    $sql = "SELECT a.* FROM warehouse_history a WHERE a.id_gudang='" . $gudang . "' AND a.id_material='" . $material . "' ORDER BY a.id ASC ";
    $data = $this->db->query($sql)->result_array();

    $dataArr = array(
      'gudang' => $gudang,
      'material' => $material,
      'data'  => $data
    );
    $this->load->view('excel_history', $dataArr);
  }
}
