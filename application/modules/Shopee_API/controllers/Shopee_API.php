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

class Shopee_API extends Admin_Controller
{
	protected $user;

    protected $viewPermission 	= 'Shopee_API.View';
    protected $addPermission  	= 'Shopee_API.Add';
    protected $managePermission = 'Shopee_API.Manage';
    protected $deletePermission = 'Shopee_API.Delete';

    public function __construct()
	{
        parent::__construct();

        $this->load->library('session');
        $this->lang->load('users/users');
		$this->load->model(array('users/users_model',
                                    'users/user_groups_model',
                                    'sales_marketplace/Sales_marketplace_model'));

		$this->user = $this->session->userdata('app_session');
	}

    public function index()
    {
        $this->auth->restrict($this->viewPermission);
        $session = $this->session->userdata('app_session');

        $dataOrder = $this->db->query("SELECT * FROM sales_marketplace_header WHERE customer_name IS NULL AND marketplace = 'Shopee'")->result();
        $dataOrderDelivery = $this->db->query("SELECT * FROM sales_marketplace_header WHERE delivery_label IS NULL AND marketplace = 'Shopee'")->result();
        $dataProduct = $this->db->query("SELECT a.*, c.qty_stock AS qty_erp FROM products_shopee a 
                                                JOIN accessories b ON b.id_stock = a.sku_product 
                                                JOIN warehouse_stock c ON c.id_material = b.id  ORDER BY a.sku_product ASC")->result();

        $data = [
            'orders' => $dataOrder,
            'products' => $dataProduct,
            'orderdeliveries' => $dataOrderDelivery
        ];

        $this->template->set('results', $data);
		$this->template->page_icon('fa fa-store');
        $this->template->title('Shopee API');
        $this->template->render('index');
    }
}