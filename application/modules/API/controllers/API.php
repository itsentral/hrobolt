<?php

use function PHPSTORM_META\map;

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/*
 * @author Ichsan
 * @copyright Copyright (c) 2019, Ichsan
 *
 * This is controller for Master Supplier
 */

class API extends Base_Controller
{
    protected $partnerId = 2009718;
    protected $partnerKey = '514276544e68744c684a445648506d4c686b6741435870736b4e4e704f714167';
    protected $url = 'https://partner.shopeemobile.com';

    protected $usernameLoginHiroBolt = "fadli";
    protected $passwordLoginHiroBolt = "123rty321";

    protected $shopCode = '5558536c594a6276524b6871456e6977';
    protected $shopId = 1275737948;

    protected $ci;
	protected $user;

    public function __construct()
	{
		$this->ci = &get_instance();
        $this->ci->load->library('session');
        $this->ci->lang->load('users/users');
		$this->ci->load->model(array('users/users_model',
                                    'users/user_groups_model',
                                    'sales_marketplace/Sales_marketplace_model'));

		$this->user = $this->ci->session->userdata('app_session');
	}

    protected function user_id()
    {
        return $this->user['id_user'];
    }

    public function login()
    {
        $user = $this->ci->users_model->find_by(array('username' => $this->usernameLoginHiroBolt));

        if(password_verify($this->passwordLoginHiroBolt, $user->password))
    	{
    		//Buat Session
    		$array = array();
    		foreach ($user as $key => $usr) {
    			$array[$key] = $usr;
    		}

    		$this->ci->session->set_userdata('app_session', $array);
            //Set User Data
            $this->user = $this->ci->session->userdata('app_session');
            //Update Login Terakhir
            $ip_address = ($this->ci->input->ip_address()) == "::1" ? "127.0.0.1" : $this->ci->input->ip_address();
            $this->ci->users_model->update($this->user_id(), array('login_terakhir' => date('Y-m-d H:i:s'), 'ip' => $ip_address));

            return true;
    	}
    }

    public function logins(){
        // print_r($this->auth->is_login());die();
        if($this->auth->is_login() == true)
        {
            $data_session	= $this->session->userdata;
            $app_session = $this->session->userdata('app_session');
            $username = $this->session->userdata['app_session']['username'];
            $ip_address = ($this->ci->input->ip_address()) == "::1" ? "127.0.0.1" : $this->ci->input->ip_address();
            $this->ci->users_model->update($this->user_id(), array('login_terakhir' => date('Y-m-d H:i:s'), 'ip' => $ip_address));
            // print_r($username);die();
            redirect('/');
			// redirect('https://sentral.dutastudy.com/metalsindo_dev/');
        }
        // else{
        //     print_r('Gagal Login');
        // }
    }

    protected function logout()
    {
        $this->ci->session->sess_destroy();
        return true;
    }

    protected function makeSign($path)
    {
        $timestamp = time();
        $baseString = sprintf("%s%s%s", $this->partnerId, $path, $timestamp);
        $sign = hash_hmac('sha256', $baseString, $this->partnerKey);

        return $sign;
    }

    public function authShop()
    {
        // $this->login();//version old
        $this->logins();//version new

        $path = "/api/v2/shop/auth_partner";
        $redirectURL = "https://sentral.dutastudy.com/";
        
        $timestamp = time();
        $sign = $this->makeSign($path);
        $url = sprintf("%s%s?partner_id=%s&timestamp=%s&sign=%s&redirect=%s", $this->url, $path, $this->partnerId, $timestamp, $sign, $redirectURL);

        $this->logout();

        echo $url;
    }

    public function getTokenShopLevel()
    {
        $path = '/api/v2/auth/token/get';

        $timestamp = time();
        // print_r($timestamp);die();
        $body = [
            "code" => $this->shopCode,
            "shop_id" => $this->shopId,
            "partner_id" => $this->partnerId,
        ];

        $sign = $this->makeSign($path);
        $url = sprintf("%s%s?timestamp=%s&partner_id=%s&sign=%s", $this->url, $path, $timestamp, $this->partnerId, $sign);

        //echo $sign;echo "<br>";
        //echo $url;echo "<br>";
        // die();

        $c = curl_init($url);
        curl_setopt($c, CURLOPT_POST, 1);
        curl_setopt($c, CURLOPT_POSTFIELDS, json_encode($body));
        curl_setopt($c, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_CAINFO, "C:/xampp_5_6/php/extras/ssl/cacert.pem");
        $resp = curl_exec($c);

        $ret = json_decode($resp, true);
        //print_r($ret);
        $response = curl_exec($c);
        //print_r($response);
        // if ($response === false) {
        //     echo 'Kesalahan: ' . curl_error($c);
        // } else {
        //     echo 'done';
        //     // Olah data yang diterima dari API
        // }
        //die();
        $accessToken = $ret["access_token"];
        $newRefreshToken = $ret["refresh_token"];
        //echo "\naccess_token: $accessToken, refresh_token: $newRefreshToken raw: $ret"."\n";
        //die();
        if (isset($accessToken)) {
            $dataAccessToken = [
                'value' => $accessToken,
                'expire' => $ret['expire_in'],
            ];
    
            $this->db->where('code', 'SAT');
            $this->db->update('app_parameter', $dataAccessToken);
        }

        if (isset($newRefreshToken)) {
            $dataAccessTokenRefresh = [
                'value' => $newRefreshToken,
                'expire' => 30,
            ];
    
            $this->db->where('code', 'SRT');
            $this->db->update('app_parameter', $dataAccessTokenRefresh);
        }

        return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($ret));
    }

    public function getAccessTokenShopLevel()
    {
        $path = "/api/v2/auth/access_token/get";

        $refreshToken = $this->db->query("SELECT * FROM app_parameter WHERE code = 'SRT'")->row();

        $timestamp = time();

        $body = [
            'partner_id' => $this->partnerId,
            'shop_id' => $this->shopId,
            'refresh_token' => $refreshToken->value
        ];

        $sign = $this->makeSign($path);
        $url = sprintf("%s%s?timestamp=%s&partner_id=%s&sign=%s", $this->url, $path, $timestamp, $this->partnerId, $sign);

        // return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($url));

        $c = curl_init($url);
        curl_setopt($c, CURLOPT_POST, 1);
        curl_setopt($c, CURLOPT_POSTFIELDS, json_encode($body));
        curl_setopt($c, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($c);
        // echo "\nraw result ".$result."\n";
        $ret = json_decode($result, true);

        $accessToken = $ret["access_token"];
        $newRefreshToken = $ret["refresh_token"];

        if ($accessToken) {
            $dataAccessToken = [
                'value' => $accessToken,
                'expire' => $ret['expire_in'],
            ];
    
            $this->db->where('code', 'SAT');
            $this->db->update('app_parameter', $dataAccessToken);
        }

        if ($newRefreshToken) {
            $dataAccessTokenRefresh = [
                'value' => $newRefreshToken,
                'expire' => 30,
            ];
    
            $this->db->where('code', 'SRT');
            $this->db->update('app_parameter', $dataAccessTokenRefresh);
        }

        // return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($ret));

        // echo "\naccess_token: ".$accessToken.", refresh_token: ".$newRefreshToken."\n";
        // return $ret;
        if ($accessToken) {
            return true;
        }
    }

    public function getIp()
    {
        $curl = curl_init();

        $time = time();

        $path = '/api/v2/public/get_shopee_ip_ranges';
        $baseString = sprintf("%s%s%s", $this->partnerId, $path, $time);
        $sign = hash_hmac('sha256', $baseString, $this->partnerKey);

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://partner.test-stable.shopeemobile.com'.$path.'?partner_id='.$this->partnerId.'&sign='.$sign.'&timestamp='.$time,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }

    public function getOrderList()
    {
        $this->getAccessTokenShopLevel();

        $accessToken = $this->db->query("SELECT * FROM app_parameter WHERE code = 'SAT'")->row();

        $path = "/api/v2/order/get_order_list";

        $timeFrom = strtotime($this->input->post('date_form'));
        $timeTo = strtotime($this->input->post('date_to'));

        $time = time();
        $timeFrom = strtotime(date("d M Y", $timeFrom)); // dynamic
        $timeTo = strtotime(date("d M Y", $timeTo)); // dynamic
        $orderStatus = $this->input->post('status_order'); // dynamic
        $pageSize = 20;
        $baseString = sprintf("%s%s%s%s%s", $this->partnerId, $path, $time, $accessToken->value, $this->shopId);
        $sign = hash_hmac('sha256', $baseString, $this->partnerKey);

        $parameter = sprintf("?timestamp=%s&access_token=%s&order_status=%s&page_size=%s&partner_id=%s&response_optional_fields=order_status&shop_id=%s&sign=%s&time_from=%s&time_range_field=create_time&time_to=%s", 
                            $time, $accessToken->value, $orderStatus, $pageSize, $this->partnerId, $this->shopId, $sign, $timeFrom, $timeTo);
        
        $url = $this->url . $path . $parameter;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $response = json_decode($response, true);

        $status = (($orderStatus == 'SHIPPED' || $orderStatus == 'COMPLETED') ? 5 : (($orderStatus == 'IN_CANCEL' || $orderStatus == 'CANCELLED') ? 9 : 1)); 

        foreach($response['response']['order_list'] AS $order) {
            $getCodeOrder = $this->db->query("SELECT code_order_marketplace FROM sales_marketplace_header WHERE code_order_marketplace = '".$order['order_sn']."'")->row();
            if (!$getCodeOrder) {
                $code = $this->Sales_marketplace_model->generate_code_order();
                $data = array(
                    'code_order'		    	=> $code,
                    'code_order_marketplace'	=> $order['order_sn'],
                    'marketplace'				=> "Shopee",
                    'status'					=> $status,
                    'created_at'				=> date('Y-m-d H:i:s'),
                    'updated_at'				=> date('Y-m-d H:i:s'),
                    'created_by'				=> 0,
                );
        
                //Add Data
                $this->db->insert('sales_marketplace_header', $data);
            }
        }

        // return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($response));
        return redirect('/Shopee_API', 'refresh');
    }

    public function getOrderListDetail()
    {
        $this->getAccessTokenShopLevel();

        $accessToken = $this->db->query("SELECT * FROM app_parameter WHERE code = 'SAT'")->row();
        $path = "/api/v2/order/get_order_detail";
        $time = time();
        $orderSN = $this->input->post('code_order'); // dynammic
        $orderSNImplode = implode(",", $orderSN);
        // $orderSNComma = str_replace(",", "2%C", implode(",", $orderSN));
        $orderOptional = "buyer_user_id,buyer_username,estimated_shipping_fee,recipient_address,actual_shipping_fee,item_list,pay_time,actual_shipping_fee_confirmed,fulfillment_flag,pickup_done_time,package_list,shipping_carrier,payment_method,total_amount,buyer_username,invoice_data";

        $baseString = sprintf("%s%s%s%s%s", $this->partnerId, $path, $time, $accessToken->value, $this->shopId);
        $sign = hash_hmac('sha256', $baseString, $this->partnerKey);
        $parameter = sprintf("?timestamp=%s&access_token=%s&order_sn_list=%s&partner_id=%s&response_optional_fields=%s&shop_id=%s&sign=%s", 
                            $time, $accessToken->value, $orderSNImplode, $this->partnerId, $orderOptional, $this->shopId, $sign);
        $url = $this->url . $path . $parameter;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $response = json_decode($response, true);

        // return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($response));

        $orderSNImplode = '"' . implode('","', $orderSN) . '"';

        $dataOrder = $this->db->query("SELECT * FROM sales_marketplace_header WHERE code_order_marketplace IN($orderSNImplode)")->result();

        // return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($dataOrder));
        
        $data = [];
        foreach($response['response']['order_list'] AS $order) {
            foreach ($dataOrder AS $dataorder) {
                if ($dataorder->code_order_marketplace == $order['order_sn']) {
                    $totalOrder = 0;

                    // return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($this->getDelivery($order['shipping_carrier'])));

                    foreach($order['item_list'] AS $product) {
                        $totalOrder += $product['model_quantity_purchased'];
                        $sku = $product['model_sku'];

                        $itemProduct = $this->db->query("SELECT * FROM ms_inventory_category3 WHERE sku_varian = '$sku'")->row();
                        // return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($itemProduct));

                        $dataDetail = [
                            'code_order' => $dataorder->code_order,
                            'product_id' => $itemProduct->id,
                            'price' => $itemProduct->price,
                            'qty' => $product['model_quantity_purchased'],
                            'total_price' => $itemProduct->price * $product['model_quantity_purchased'],
                            'total_price_ppn' => ($product['model_original_price'] * 11/100) + ($itemProduct->price * $product['model_quantity_purchased']),
                            'created_at' => date('Y-m-d H:i:s'),
                            'created_by' => 0
                        ];

                        $this->db->insert('sales_marketplace_detail', $dataDetail);
                    }

                    $data = [
                        'customer_name' => $order['buyer_username'],
                        'delivery_date' => date('Y-m-d', $order['ship_by_date']),
                        'delivery_service_id' => $this->getDelivery($order['shipping_carrier']),
                        'total_price' => $order['total_amount'],
                        'updated_at' => date('Y-m-d H:i:s'),
                        'updated_by' => 0,
                        'status' => 1,
                        'total_qty' => $totalOrder
                    ];

                    $this->db->where("code_order", $dataorder->code_order);
                    $this->db->update("sales_marketplace_header", $data);
                }
            }
        }

        // return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($response));
        return redirect('/Shopee_API', 'refresh');
    }

    protected function str_contains($haystack, $needle) {
        return $needle !== '' && mb_strpos($haystack, $needle) !== false;
    }

    protected function getDelivery($deliveryString) 
    {
        $deliveries = $this->db->query("SELECT id, name FROM master_pengiriman WHERE status = 'Aktif'")->result();

        foreach($deliveries AS $delivery) {
            if ($this->str_contains(strtolower($delivery->name), strtolower($deliveryString))) {
                return $delivery->id;
            }
        }
    }

    public function getDataProduct()
    {
        $this->getAccessTokenShopLevel();

        $accessToken = $this->db->query("SELECT * FROM app_parameter WHERE code = 'SAT'")->row();
        $path = '/api/v2/product/get_item_list';
        $time = time();

        $baseString = sprintf("%s%s%s%s%s", $this->partnerId, $path, $time, $accessToken->value, $this->shopId);
        $sign = hash_hmac('sha256', $baseString, $this->partnerKey);
        $parameter = sprintf("?timestamp=%s&access_token=%s&item_status=NORMAL&offset=0&page_size=30&partner_id=%s&shop_id=%s&sign=%s", 
                            $time, $accessToken->value, $this->partnerId, $this->shopId, $sign);
        $url = $this->url . $path . $parameter;

        // echo $sign;echo "<br>";
        //echo $url;echo "<br>";
        //die();
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        $response = json_decode($response, true);

        curl_close($curl);
        
        foreach ($response['response']['item'] AS $product) {
            // return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($product));
            $checkData = $this->db->query("SELECT * FROM products_shopee WHERE item_id = '" . $product['item_id'] . "'")->row_array();

            $data = array(
                'item_id' => $product['item_id'],
                'status' => $product['item_status']
            );

            if (count($checkData) > 0) {
                $this->db->where('item_id', $checkData['item_id']);
                $this->db->update('products_shopee', $data);
            } else {
                $this->db->insert('products_shopee', $data);
            }
        }

        // return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));
        $data = $this->db->query("SELECT * FROM products_shopee WHERE status = 'NORMAL'")->result_array();

        $itemId = [];
        foreach ($data AS $value) {
            $itemId[] = $value['item_id'];    
        }

        $this->getDataProductDetail($itemId);

        return redirect('/Shopee_API', 'refresh');
    }

    //start functon hanya tes data api
    public function shop_info()
    {
        $this->getAccessTokenShopLevel();

        $accessToken = $this->db->query("SELECT * FROM app_parameter WHERE code = 'SAT'")->row();
        $path = '/api/v2/shop/get_shop_info';
        $time = time();

        $baseString = sprintf("%s%s%s%s%s", $this->partnerId, $path, $time, $accessToken->value, $this->shopId);
        $sign = hash_hmac('sha256', $baseString, $this->partnerKey);
        $parameter = sprintf("?timestamp=%s&access_token=%s&item_status=NORMAL&offset=0&page_size=30&partner_id=%s&shop_id=%s&sign=%s", 
                            $time, $accessToken->value, $this->partnerId, $this->shopId, $sign);
        $url = $this->url . $path . $parameter;

        // echo $sign;echo "<br>";
        //echo $url;echo "<br>";
        //die();

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        $response = json_decode($response, true);

        curl_close($curl);
        //contoh pemanggilan untuk data by one
        print_r($response['shop_name']);
        echo "<br>";
        print_r($response);
        die();
    }

    public function getDataCategory(){
        $this->getAccessTokenShopLevel();

        $accessToken = $this->db->query("SELECT * FROM app_parameter WHERE code = 'SAT'")->row();
        $path = '/api/v2/product/get_category';
        $time = time();

        $baseString = sprintf("%s%s%s%s%s", $this->partnerId, $path, $time, $accessToken->value, $this->shopId);
        $sign = hash_hmac('sha256', $baseString, $this->partnerKey);
        $parameter = sprintf("?timestamp=%s&access_token=%s&item_status=NORMAL&offset=0&page_size=30&partner_id=%s&shop_id=%s&sign=%s", 
                            $time, $accessToken->value, $this->partnerId, $this->shopId, $sign);
        $url = $this->url . $path . $parameter;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        $response = json_decode($response, true);

        curl_close($curl);

        foreach ($response['response']['category_list'] AS $category) {
            echo "<pre>";
            print_r($category);
            echo "</pre>";
        }        

        // echo $sign;echo "<br>";
        // echo $url;echo "<br>";
        die(); 
        
    }
    //end function hanya tes data api

    public function getDataProductDetail(array $itemId)
    {
        $this->getAccessTokenShopLevel();

        $itemId = implode(",", $itemId);
        $accessToken = $this->db->query("SELECT * FROM app_parameter WHERE code = 'SAT'")->row();
        $path = '/api/v2/product/get_item_base_info';
        $time = time();

        $baseString = sprintf("%s%s%s%s%s", $this->partnerId, $path, $time, $accessToken->value, $this->shopId);
        $sign = hash_hmac('sha256', $baseString, $this->partnerKey);
        $parameter = sprintf("?timestamp=%s&access_token=%s&item_id_list=%s&partner_id=%s&shop_id=%s&sign=%s", 
                            $time, $accessToken->value, $itemId, $this->partnerId, $this->shopId, $sign);
        $url = $this->url . $path . $parameter;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        $response = json_decode($response, true);

        // return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($response['response']));

        foreach($response['response']['item_list'] AS $model) {
            // return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($model));
            
            if (array_key_exists('stock_info_v2', $model)){
                $data = [
                    // 'model_id' => $model['model_id'],
                    'model_name' => $model['item_name'],
                    'sku_product' => $model['item_sku'],
                    // 'parent_id' => $itemId,
                    'status' => $model['item_status'],
                    'stok' => $model['stock_info_v2']['seller_stock'][0]['stock']
                ];

                // return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));
    
                $this->db->where('item_id', $model['item_id']);
                $this->db->update("products_shopee", $data);
            } else {
                $data = [
                    // 'model_id' => $model['model_id'],
                    'model_name' => $model['item_name'],
                    'sku_product' => $model['item_sku'],
                    // 'parent_id' => $itemId,
                    'status' => $model['item_status']
                ];

                // return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($data));
    
                $this->db->where('item_id', $model['item_id']);
                $this->db->update("products_shopee", $data);

                $this->getDataProductModel($model['item_id']);
            }
        }

        curl_close($curl);

        // return redirect('/Shopee_API', 'refresh');
        return true;
        // redirect($this->uri->uri_string()); 
        // return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function updateStockProduct()
    {
        $this->getAccessTokenShopLevel();

        $accessToken = $this->db->query("SELECT * FROM app_parameter WHERE code = 'SAT'")->row();
        $path = '/api/v2/product/update_stock';
        $time = time();

        $baseString = sprintf("%s%s%s%s%s", $this->partnerId, $path, $time, $accessToken->value, $this->shopId);
        $sign = hash_hmac('sha256', $baseString, $this->partnerKey);
        $parameter = sprintf("?timestamp=%s&access_token=%s&partner_id=%s&shop_id=%s&sign=%s", 
                            $time, $accessToken->value, $this->partnerId, $this->shopId, $sign);
        $url = $this->url . $path . $parameter;
    }

    public function getDataProductModel($itemId)
    {
        $this->getAccessTokenShopLevel();

        $itemId = intval($itemId);
        $accessToken = $this->db->query("SELECT * FROM app_parameter WHERE code = 'SAT'")->row();
        $path = '/api/v2/product/get_model_list';
        $time = time();

        $baseString = sprintf("%s%s%s%s%s", $this->partnerId, $path, $time, $accessToken->value, $this->shopId);
        $sign = hash_hmac('sha256', $baseString, $this->partnerKey);
        $parameter = sprintf("?timestamp=%s&access_token=%s&item_id=%s&partner_id=%s&shop_id=%s&sign=%s", 
                            $time, $accessToken->value, $itemId, $this->partnerId, $this->shopId, $sign);
        $url = $this->url . $path . $parameter;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        $response = json_decode($response, true);

        // return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($response));

        curl_close($curl);

        foreach($response['response']['model'] AS $model) {
            $data = [
                'model_id' => $model['model_id'],
                'model_name' => $model['model_name'],
                'sku_product' => $model['model_sku'],
                'parent_id' => $itemId,
                'status' => $model['model_status'],
                'stok' => $model['stock_info_v2']['seller_stock'][0]['stock']
            ];

            $dataSKU = $this->db->query("SELECT * FROM products_shopee WHERE sku_product = '" . $model['model_sku'] . "'")->row();
            if (isset($dataSKU)){
                $this->db->where("sku_product", $model['model_sku']);
                $this->db->update("products_shopee", $data);
            } else {
                $this->db->insert("products_shopee", $data);
            }
        }

        // return redirect('/Shopee_API', 'refresh');
        return true;
        // redirect($this->uri->uri_string()); 
        // return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function createShippingDocument($orderSN)
    {
        $this->getAccessTokenShopLevel();

        // $orderSN = $this->input->post('orderSN');
        $accessToken = $this->db->query("SELECT * FROM app_parameter WHERE code = 'SAT'")->row();
        $path = '/api/v2/logistics/create_shipping_document';
        $time = time();

        $baseString = sprintf("%s%s%s%s%s", $this->partnerId, $path, $time, $accessToken->value, $this->shopId);
        $sign = hash_hmac('sha256', $baseString, $this->partnerKey);
        $parameter = sprintf("?timestamp=%s&access_token=%s&partner_id=%s&shop_id=%s&sign=%s", 
                            $time, $accessToken->value, $this->partnerId, $this->shopId, $sign);
        $url = $this->url . $path . $parameter;

        $curl = curl_init();

        $data = [
            "order_list" => [[
                "order_sn" => $orderSN,
            ]],
            "shipping_document_type" => "NORMAL_AIR_WAYBILL"
        ];

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $this->downloadAirWayBill($orderSN);
        // return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($response));
        // echo $response;
    }

    public function downloadAirWayBill($orderSN)
    {
        $this->getAccessTokenShopLevel();

        // $orderSN = $this->input->post('orderSN');
        // return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($orderSN));
        $accessToken = $this->db->query("SELECT * FROM app_parameter WHERE code = 'SAT'")->row();
        $path = '/api/v2/logistics/download_shipping_document';
        $time = time();

        $baseString = sprintf("%s%s%s%s%s", $this->partnerId, $path, $time, $accessToken->value, $this->shopId);
        $sign = hash_hmac('sha256', $baseString, $this->partnerKey);
        $parameter = sprintf("?timestamp=%s&access_token=%s&partner_id=%s&shop_id=%s&sign=%s", 
                            $time, $accessToken->value, $this->partnerId, $this->shopId, $sign);
        $url = $this->url . $path . $parameter;

        $curl = curl_init();

        $data = [
            "order_list" => [[
                "order_sn" => $orderSN,
            ]],
            "shipping_document_type" => "NORMAL_AIR_WAYBILL"
        ];

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        return $this->output->set_status_header(200)->set_content_type('application/json')->set_output(json_encode($response));

        curl_close($curl);
        // echo $response;
    }

    public function webHookShopee()
    {
        header("HTTP/1.1 200 OK");

        http_response_code(200);
        echo "";
    }
}