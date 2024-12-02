<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * @author Harboens
 * @copyright Copyright (c) 2022, Harboens
 *
 * This is model class for table "ms_inventory_category3"
 */

 class Spk_gudang_model extends BF_Model
{
    /**
     * @var string  User Table Name
     */
    protected $table_name = 'spk_gudang';
    protected $key        = 'id';

    /**
     * @var string Field name to use for the created time column in the DB table
     * if $set_created is enabled.
     */
    protected $created_field = 'created_at';

    /**
     * @var string Field name to use for the modified time column in the DB
     * table if $set_modified is enabled.
     */
    protected $modified_field = 'updated_at';

    /**
     * @var bool Set the created time automatically on a new record (if true)
     */
    protected $set_created = true;

    /**
     * @var bool Set the modified time automatically on editing a record (if true)
     */
    protected $set_modified = true;
    /**
     * @var string The type of date/time field used for $created_field and $modified_field.
     * Valid values are 'int', 'datetime', 'date'.
     */
    /**
     * @var bool Enable/Disable soft deletes.
     * If false, the delete() method will perform a delete of that row.
     * If true, the value in $deleted_field will be set to 1.
     */
    protected $soft_deletes = false;

    protected $date_format = 'date';

    /**
     * @var bool If true, will log user id in $created_by_field, $modified_by_field,
     * and $deleted_by_field.
     */
    protected $log_user = true;

    /**
     * Function construct used to load some library, do some actions, etc.
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    public function generateCodeSPK()
	{
		$query = $this->db->query("SELECT MAX(code_spk) as code_spk FROM spk_gudang");
		$row = $query->row_array();
		$thn = date('ymd');
		$max_id = $row['code_spk'];
		$max_id1 =(int) substr($max_id, 25, 3);
		$counter = $max_id1 + 1;
		$codeSPK = "SuratPerintahKerja" . $thn . str_pad($counter, 3, "0", STR_PAD_LEFT);
		return $codeSPK;
	}

    private function lookForArray($var)
    {
        if (is_array($var)) {
            return false;
        } else {
            foreach ($var AS $key => $value) {
                if (is_array($value)) {
                    return $key;
                }
            }
        }

        return null;
    }

    public function getDataJson()
    {
        $requestData    = $_REQUEST;
        $fetch          = $this->queryData(
            $requestData['search']['value'],
            $requestData['order'][0]['column'],
            $requestData['order'][0]['dir'],
            $requestData['start'],
            $requestData['length']
        );

        $totalData      = $fetch['totalData'];
        $totalFiltered  = $fetch['totalFiltered'];
        $query          = $fetch['query'];

        $data   = array();
        $urut1  = 1;
        $urut2  = 0;
        $nomor  = 1;
        foreach ($query as $row) {
            $total_data     = $totalData;
            $start_dari     = $requestData['start'];
            $asc_desc       = $requestData['order'][0]['dir'];

            $nestedData   = array();
            // return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($row));

            $nestedData[0] = "<div align='center'>" . $row['code_spk'] . "</div>";

            // $totalQty = 0;
            // $nestedData[2] = "";
            // if (is_array($value['detail'])) {
            //     $data = [];
            //     foreach ($value['detail'] as $key => $item) {
            //         // return $item;
            //         // $data[] = $item;
            //         if (isset($item['qty'])) {
            //             $totalQty += (int)$item['qty'];
            //             $nestedData[2] .= "<ul>"; 
            //             $nestedData[2] .= "<li><b>Nama Produk</b> : " . $item['product_name'] . "</li>";
            //             $nestedData[2] .= "<li><b>Harga Produk</b> : " . $item['price'] . "</li>";
            //             $nestedData[2] .= "<li><b>Qty Produk</b> : " . $item['qty'] .  "</li>";
            //             $nestedData[2] .= "</ul>";
            //         }
            //     }
            //     // return $data;
            // } else {
            //     $totalQty += (int)$value['detail']['qty'];
            //     // return $value['detail']['qty'];
            //     $nestedData[2] .= "<ul>"; 
            //     $nestedData[2] .= "<li><b>Nama Produk</b> : " . $value['detail']['product_name'] . "</li>";
            //     $nestedData[2] .= "<li><b>Harga Produk</b> : " . $value['detail']['price'] . "</li>";
            //     $nestedData[2] .= "<li><b>Qty Produk</b> : " . $value['detail']['qty'] .  "</li>";
            //     $nestedData[2] .= "</ul>";
            // }
            
            $nestedData[1] = "<div align='left'>" . $row['created_at'] . "</div>";
            $nestedData[2] = "<div align='left'>" . $row['status'] . "</div>";

            $approve  = "";
            // $view  = "<a href='" . site_url($this->uri->segment(1)) . '/detail_planning/' . $row['so_number'] . "' class='btn btn-sm btn-warning' title='Detail PR' data-role='qtip'><i class='fa fa-eye'></i></a>";
            // $edit   = "";

            // if ($this->ENABLE_MANAGE and COUNT($getCheck) > 0) {
            //     $edit   = "<a href='" . site_url($this->uri->segment(1)) . '/edit_planning/' . $row['so_number'] . "' class='btn btn-sm btn-info' title='Edit PR' data-role='qtip'><i class='fa fa-edit'></i></a>";
            // }

            $print = '<a href="' . site_url($this->uri->segment(1)) . "/printSPK/" . $row['code_spk'] . '" class="btn btn-sm btn-info" title="Print SPK" target="_blank"><i class="fa fa-download"></i></a>
                        <br />
                        '. $row['status_print'] . ' : ' . $row['count_print'] . ' Kali';

            $nestedData[3]  = "<div align='left' style='margin: 5px;'>" . $view . " " . $edit . " " . $approve . " " . $print . "</div>";
            $data[] = $nestedData;
            // $urut1++;
            // $urut2++;
            $nomor++;

            // foreach ($row AS $value) {
            //     // $nestedData[0] = $nomor;
                
            // }
        }

        $json_data = array(
            "draw"              => intval($requestData['draw']),
            "recordsTotal"      => intval($totalData),
            "recordsFiltered"   => intval($totalFiltered),
            "data"              => $data
        );

        echo json_encode($json_data);
    }

    public function queryData($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
    {
        $dataOrder = $this->db->query("SELECT * FROM spk_gudang WHERE status = 'Siap Diambil'")->result_array();

        // return $dataOrder;

        // return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($dataOrder));

        // $dataDetailOrder = [];

        // $num = 0;
        // foreach ($dataOrder AS $key => $data) {
        //     $orders = "";
        //     $count = substr_count($data['code_orders'], ',');

        //     if ($count > 0) {
        //         $orders = explode(",", $data['code_orders']);

        //         foreach($orders AS $key2 => $order) {
        //             $details = $this->db->query("SELECT a.*, b.nama FROM sales_marketplace_detail a JOIN ms_inventory_category3 b ON b.id = a.product_id WHERE a.code_order = '$order'")->result();
        //             // return $detail;

        //             if (count($details) > 1) {
        //                 foreach($details AS $k => $orderdetail) {
        //                     $dataDetailOrders[$key2][$k] = [
        //                         'product_name' => $orderdetail->nama,
        //                         'qty' => $orderdetail->qty,
        //                         'price' => $orderdetail->price
        //                     ];
    
        //                     $dataOrder[$key]['detail'] = $dataDetailOrders;
        //                 }
    
        //                 $num = ++$k;
        //             } else {
        //                 $detail = $this->db->query("SELECT a.*, b.nama FROM sales_marketplace_detail a JOIN ms_inventory_category3 b ON b.id = a.product_id WHERE a.code_order = ".$order."")->row();
                    
        //                 $dataDetailOrder[$key2] = [
        //                     'product_name' => $detail->nama,
        //                     'qty' => $detail->qty,
        //                     'price' => $detail->price
        //                 ];
        //                 $dataOrder[$key]['detail'] = $dataDetailOrder;
        //             }
        //         }
        //     } else {
        //         $detail = $this->db->query("SELECT a.*, b.nama FROM sales_marketplace_detail a JOIN ms_inventory_category3 b ON b.id = a.product_id WHERE a.code_order = ".$data['code_orders']."")->row();

        //         $dataDetailOrder[$num] = [
        //             'product_name' => $detail->nama,
        //             'qty' => $detail->qty,
        //             'price' => $detail->price
        //         ];

        //         // return $dataDetailOrder[$num];
        //         $dataOrder[$key]['detail'] = $dataDetailOrder[$num];
        //     }
        // }

        // return $dataOrder;

        $dataOrderReal = $dataOrder;

        foreach ($dataOrder AS $key => $order) {
            ++$key;
            $dataOrderReal[$key]["dataSPK{$key}"] = $order;
        }

        if (isset($like_value)) {
            foreach ($dataOrderReal AS $key => $order) {
                $dataSearch = array_search($like_value, $order);
            }
        }

        if ($dataSearch) {
            $dataOrderReal = $dataSearch;
        }

        $dataFix['totalData'] = count($dataOrderReal);
        $dataFix['totalFiltered'] = count($dataOrderReal);
        $columns_order_by = array(
            0 => 'so_number',
            1 => 'so_number',
            2 => 'so_number',
            3 => 'no_pr',
            4 => 'so_number'
        );

        $dataFix['query'] = $dataOrderReal;
        return $dataFix;
    }
}