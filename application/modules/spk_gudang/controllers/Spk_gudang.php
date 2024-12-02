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

class Spk_gudang extends Admin_Controller
{
    //Permission
    protected $viewPermission 	= 'SPK_Gudang.View';
    protected $addPermission  	= 'SPK_Gudang.Add';
    protected $managePermission = 'SPK_Gudang.Manage';
    protected $deletePermission = 'SPK_Gudang.Delete';

    public function __construct()
    {
        parent::__construct();

        // $this->load->library("");
        $this->load->library(array('Mpdf', 'upload', 'Image_lib'));
        $this->load->model(array('spk_gudang/spk_gudang_model',
                                 'Aktifitas/aktifitas_model',
                                ));
        $this->template->title('Manage Data SPK Gudang');
        $this->template->page_icon('fa fa-building-o');

        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');

        $this->template->page_icon('fa fa-bank');

        $data = $this->db->query("SELECT 
						a.*,
						b.name AS delivery_name
						FROM 
						sales_marketplace_header a 
						LEFT JOIN master_pengiriman b ON b.id = a.delivery_service_id
                        WHERE a.status = 1 AND customer_name IS NOT NULL ORDER BY a.id DESC
						")->result_array();

        foreach ($data AS $key => $value) {
            $orderDetail = $this->db->query("SELECT b.nama AS product_name, a.price, a.qty, a.total_price, b.sku_varian FROM sales_marketplace_detail a LEFT JOIN ms_inventory_category3 b ON b.id = a.product_id WHERE a.code_order = '" . $value['code_order'] . "'")->result();
            foreach ($orderDetail AS $num => $value) {
                $dataProductDetail = [
                    'product_name' => $value->product_name,
                    'price' => $value->price,
                    'qty' => $value->qty,
                    'total_price' => $value->total_price,
                    'sku_varian' => $value->sku_varian
                ];

                $data[$key]['detail'][] = $dataProductDetail;
            }
        }

        // return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));

        // WHERE created_at between DATE_SUB( CURDATE() , INTERVAL 15 DAY ) AND CURDATE()
        $dataSPK = $this->db->query("SELECT * FROM spk_gudang ORDER BY created_at DESC")->result_array();

        $results = [
            'dataOrder' => $data,
            'dataSPK' => $dataSPK
        ];

        $this->template->title('SPK Gudang');
        $this->template->set('results', $results);
        $this->template->render('index');
    }

    public function serverSideDataTable()
    {
        $this->spk_gudang_model->getDataJson();
        // return $response;
        // return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function formSPKGudang()
    {
        $this->auth->restrict($this->addPermission);
        $session = $this->session->userdata('app_session');

        $data = $this->db->query("SELECT 
						a.*,
						b.name AS delivery_name
						FROM 
						sales_marketplace_header a 
						LEFT JOIN master_pengiriman b ON b.id = a.delivery_service_id
                        WHERE a.status = 1
						")->result_array();

        foreach ($data AS $key => $value) {
            $orderDetail = $this->db->query("SELECT b.nama AS product_name, a.price, a.qty, a.total_price FROM sales_marketplace_detail a JOIN ms_inventory_category3 b ON b.id = a.product_id WHERE a.code_order = '" . $value['code_order'] . "'")->result();
            foreach ($orderDetail AS $num => $value) {
                $dataProductDetail = [
                    'product_name' => $value->product_name,
                    'price' => $value->price,
                    'qty' => $value->qty,
                    'total_price' => $value->total_price
                ];

                $data[$key]['detail'] = $dataProductDetail;
            }
        }

        // return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));

        if ($data) {
            $data = [
                'dataOrder' => $data,
            ];

            $this->template->set('results', $data);
            $this->template->render('form');
        }
    }

    public function saveGudangSPK()
    {
        $this->auth->restrict($this->addPermission);
        $session = $this->session->userdata('app_session');

        $codeOrder = implode(",", $this->input->post('check_order'));
        $codeSPK = $this->spk_gudang_model->generateCodeSPK();

        $this->db->trans_begin();

        foreach($this->input->post('check_order') AS $orderCode) {
            $data = [
                'status' => 2
            ];

            $this->db->where('code_order', $orderCode);
            $this->db->update('sales_marketplace_header', $data);
        }

        $data = [
            'code_spk' => $codeSPK,
            'status' => 'Siap Diambil',
            'code_orders' => $codeOrder,
            'status_print' => "Belum Diprint",
            'count_print' => 0,
            'last_print_by' => "",
            'created_by' => $this->auth->user_id(),
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->db->insert('spk_gudang', $data);

        if($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
            $response = [
                'status' => 'OK',
                'code' => 200,
                'message' => 'Berhasil Simpan Data',
            ];
		}else {
			$this->db->trans_commit();
			$response = [
                'status' => 'NOK',
                'code' => 404,
                'message' => 'Gagal Simpan Data',
            ];			
		}
        
        return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function printSPK($codeSPK) 
    {
        $dataOrder = $this->db->query("SELECT * FROM spk_gudang WHERE code_spk = '$codeSPK'")->row_array();

        $dataDetailOrder = [];

        $orders = "";
        $count = substr_count($dataOrder['code_orders'], ',');

        if ($count > 0) {
            $orders = explode(",", $dataOrder['code_orders']);

            if ($orders != null) {
                foreach($orders AS $order) {
                    $details = $this->db->query("SELECT a.*, b.nama, b.sku_varian, c.name AS rak FROM sales_marketplace_detail a 
                                                    JOIN ms_inventory_category3 b ON b.id = a.product_id
                                                    LEFT JOIN master_rak c ON c.id = b.rak_id 
                                                    WHERE a.code_order = '$order'")->result();
                    
                    foreach ($details AS $detail) {
                        $headerOrder = $this->db->query("SELECT code_order_marketplace FROM sales_marketplace_header WHERE code_order = '" . $detail->code_order . "'")->row();

                        $dataDetailOrder[] = [
                            'product_name' => $detail->nama,
                            'code_order' => $detail->code_order,
                            'code_order_marketplace' => $headerOrder->code_order_marketplace,
                            'qty' => $detail->qty,
                            'price' => $detail->price,
                            'sku_varian' => $detail->sku_varian
                        ];
                    }
                }
            }
        } else {
            $details = $this->db->query("SELECT a.*, b.nama, b.sku_varian FROM sales_marketplace_detail a JOIN ms_inventory_category3 b ON b.id = a.product_id WHERE a.code_order = '" . $dataOrder['code_orders'] . "'")->result();
                
            foreach ($details AS $detail) {
                $headerOrder = $this->db->query("SELECT code_order_marketplace FROM sales_marketplace_header WHERE code_order = '" . $detail->code_order . "'")->row();

                $dataDetailOrder[] = [
                    'product_name' => $detail->nama,
                    'code_order' => $detail->code_order,
                    'code_order_marketplace' => $headerOrder->code_order_marketplace,
                    'qty' => $detail->qty,
                    'price' => $detail->price,
                    'sku_varian' => $detail->sku_varian
                ];
            }
        }

        $dataOrder['detail'] = $dataDetailOrder;

        $dataResult = [];
        foreach($dataOrder['detail'] AS $order) {
            $dataResult[$order['code_order']][] = $order;
        }

        $dataOrder['detail'] = $dataResult;

        // return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($dataOrder));

        // ob_clean();
        // ob_start();

        // $this->load->library("Mpdf");

        // $mpdf = new Mpdf();

        // $mpdf->SetHTMLHeader(
        //     '
        //     <div style="display:flex">
        //         <div>
        //             Code SPK : '.$codeSPK.'
        //         </div>
        //         <div style="text-align: right; font-weight: bold;">
        //             Hiro Bolt SPK
        //         </div>
        //     </div>
        //     '
        // );

        $barcode = $this->generateQRCode($codeSPK);

        $data = [
            'codeSPK' => $codeSPK,
            'dataOrder' => $dataOrder,
            'barcode' => $barcode
        ];

        // return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));

        $this->load->view('printSPK', $data);
        // $html = ob_get_contents();
        // $mpdf->WriteHTML($html);
        // ob_end_clean();

        // $mpdf->Output();
    }

    public function generateQRCode($code) 
    {
        // include APPPATH . "/libraries/phpqrcode/index.php";
        
        require_once APPPATH . "libraries/phpqrcode/phpqrcode.php";

        $baseURL = APPPATH . "../assets/temp/";

        //Nama file yang akan disimpan pada folder temp 
        $namafile1 = "barcode".$code.".png";
        //Kualitas dari QRCode 
        $quality1 = 'H'; 
        //Ukuran besar QRCode
        $ukuran1 = 8; 
        $padding1 = 0; 
        QRCode::png($code,$baseURL.$namafile1,$quality1,$ukuran1,$padding1);

        return $namafile1;
    }

    public function countPrintSPK()
    {
        $codeSPK = $this->input->post('spk');

        $dataSPK = $this->db->query("SELECT * FROM spk_gudang WHERE code_spk = '$codeSPK'")->row();

        $orders = "";
        $count = substr_count($dataSPK->code_orders, ',');

        $this->db->trans_begin();

        if ($count > 0) {
            $orders = explode(",", $dataSPK->code_orders);

            if ($orders != null) {
                foreach($orders AS $order) {
                    $dataOrder = [
                        'status' => 3
                    ];

                    $this->db->where('code_order', $order);
                    $this->db->update('sales_marketplace_header', $dataOrder);
                }
            }
        } else {
            $dataOrder = [
                'status' => 3
            ];

            $this->db->where('code_order', $dataSPK->code_orders);
            $this->db->update('sales_marketplace_header', $dataOrder);
        }
        
        $data = [
            'status' => 'Sudah Diambil',
            'count_print' => $dataSPK->count_print + 1,
            'status_print' => 'Sudah Print',
            'last_print_by' =>  $this->auth->user_id(),
        ];

        $this->db->where('code_spk', $codeSPK);
        $this->db->update('spk_gudang', $data);

        if($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
            $data = [
                'code' => 200,
                'status' => 'OK',
                'message' => 'Sukses'
            ];
		}else {
			$this->db->trans_commit();
			$data = [
                'status' => 'NOK',
                'code' => 404,
                'message' => 'Gagal Simpan Data',
            ];			
		}

        return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));
    }
}