<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stok_gudang_produksi extends Admin_Controller
{
    //Permission
    protected $viewPermission 	= 'Gudang_Produksi.View';
    protected $addPermission  	= 'Gudang_Produksi.Add';
    protected $managePermission = 'Gudang_Produksi.Manage';
    protected $deletePermission = 'Gudang_Produksi.Delete';

   public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Stok_gudang_produksi/stok_gudang_produksi_model'
                                ));
        $this->template->title('Manage Data Supplier');
        $this->template->page_icon('fa fa-building-o');

        date_default_timezone_set('Asia/Bangkok');
    }

    //==========================================================================================================
    //============================================STOCK=========================================================
    //==========================================================================================================

    public function index(){
      $this->auth->restrict($this->viewPermission);
      $session  = $this->session->userdata('app_session');

      $listGudang     = $this->db->get_where('warehouse',array('desc'=>'costcenter'))->result_array();
      $data = [
        'listGudang' => $listGudang
      ];

      history("View data gudang produksi");
      $this->template->title('Gudang Material / Gudang Produksi / Stok');
      $this->template->render('index', $data);
    }

    public function data_side_stock(){
  		$this->stok_gudang_produksi_model->get_json_stock();
  	}

    public function modal_history(){
      $data     = $this->input->post();
      $gudang   = $data['gudang'];
      $material = $data['material'];
  
      $sql = "SELECT a.* FROM warehouse_history a WHERE a.id_gudang='".$gudang."' AND a.id_material='".$material."' ORDER BY a.id ASC ";
      $data = $this->db->query($sql)->result_array();
  
      $dataArr = array(
        'gudang' => $gudang,
        'material' => $material,
        'data'  => $data
      );
      $this->load->view('modal_history',$dataArr);
  
    }

    
}

?>
