<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-12-12 02:49:10 --> 404 Page Not Found: /index
ERROR - 2024-12-12 08:51:47 --> Severity: Warning --> Missing argument 1 for Sales_marketplace::edit() C:\xampp_5_6\htdocs\hrobolt\application\modules\sales_marketplace\controllers\Sales_marketplace.php 336
ERROR - 2024-12-12 08:51:47 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '' at line 21 - Invalid query: SELECT 
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
						WHERE a.id = 
ERROR - 2024-12-12 08:51:49 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '' at line 19 - Invalid query: SELECT 
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
						WHERE a.id = 
ERROR - 2024-12-12 02:51:58 --> 404 Page Not Found: /index
ERROR - 2024-12-12 02:51:58 --> 404 Page Not Found: /index
ERROR - 2024-12-12 02:51:58 --> 404 Page Not Found: /index
ERROR - 2024-12-12 02:51:58 --> 404 Page Not Found: /index
ERROR - 2024-12-12 02:51:58 --> 404 Page Not Found: /index
ERROR - 2024-12-12 02:52:07 --> 404 Page Not Found: /index
ERROR - 2024-12-12 02:52:07 --> 404 Page Not Found: /index
ERROR - 2024-12-12 02:52:07 --> 404 Page Not Found: /index
ERROR - 2024-12-12 02:52:07 --> 404 Page Not Found: /index
ERROR - 2024-12-12 02:52:07 --> 404 Page Not Found: /index
ERROR - 2024-12-12 02:52:09 --> 404 Page Not Found: /index
ERROR - 2024-12-12 02:52:09 --> 404 Page Not Found: /index
ERROR - 2024-12-12 08:52:39 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '' at line 19 - Invalid query: SELECT 
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
						WHERE a.id = 
ERROR - 2024-12-12 09:07:14 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp_5_6\htdocs\hrobolt\application\modules\API\controllers\API.php 293
ERROR - 2024-12-12 09:07:16 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp_5_6\htdocs\hrobolt\application\modules\API\controllers\API.php 293
ERROR - 2024-12-12 09:07:18 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp_5_6\htdocs\hrobolt\application\modules\API\controllers\API.php 293
ERROR - 2024-12-12 09:07:19 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp_5_6\htdocs\hrobolt\application\modules\API\controllers\API.php 293
ERROR - 2024-12-12 09:07:20 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp_5_6\htdocs\hrobolt\application\modules\API\controllers\API.php 293
ERROR - 2024-12-12 09:07:21 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp_5_6\htdocs\hrobolt\application\modules\API\controllers\API.php 293
ERROR - 2024-12-12 09:07:23 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp_5_6\htdocs\hrobolt\application\modules\API\controllers\API.php 293
ERROR - 2024-12-12 09:14:53 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp_5_6\htdocs\hrobolt\application\modules\API\controllers\API.php 293
ERROR - 2024-12-12 10:31:48 --> Severity: Notice --> Trying to get property of non-object C:\xampp_5_6\htdocs\hrobolt\application\modules\API\controllers\API.php 52
ERROR - 2024-12-12 10:32:49 --> Severity: Notice --> Trying to get property of non-object C:\xampp_5_6\htdocs\hrobolt\application\modules\API\controllers\API.php 52
ERROR - 2024-12-12 04:34:41 --> 404 Page Not Found: /index
ERROR - 2024-12-12 10:35:08 --> 404 Page Not Found: ../modules/API/controllers/API/user_id
ERROR - 2024-12-12 10:35:59 --> 404 Page Not Found: ../modules/API/controllers/API/user_id
ERROR - 2024-12-12 10:36:04 --> 404 Page Not Found: ../modules/API/controllers/API/user_id
ERROR - 2024-12-12 10:39:06 --> Severity: Notice --> Trying to get property of non-object C:\xampp_5_6\htdocs\hrobolt\application\modules\API\controllers\API.php 52
ERROR - 2024-12-12 10:51:01 --> Severity: Notice --> Trying to get property of non-object C:\xampp_5_6\htdocs\hrobolt\application\modules\API\controllers\API.php 52
ERROR - 2024-12-12 11:07:49 --> Severity: Notice --> Trying to get property of non-object C:\xampp_5_6\htdocs\hrobolt\application\modules\API\controllers\API.php 52
ERROR - 2024-12-12 11:07:52 --> Severity: Notice --> Undefined variable: data_login C:\xampp_5_6\htdocs\hrobolt\application\modules\API\controllers\API.php 75
ERROR - 2024-12-12 05:08:44 --> Severity: Parsing Error --> syntax error, unexpected 'print_r' (T_STRING) C:\xampp_5_6\htdocs\hrobolt\application\modules\API\controllers\API.php 76
ERROR - 2024-12-12 05:10:32 --> Severity: Parsing Error --> syntax error, unexpected 'print_r' (T_STRING) C:\xampp_5_6\htdocs\hrobolt\application\modules\API\controllers\API.php 77
ERROR - 2024-12-12 11:15:12 --> Severity: Notice --> Trying to get property of non-object C:\xampp_5_6\htdocs\hrobolt\application\modules\API\controllers\API.php 52
ERROR - 2024-12-12 11:37:00 --> Severity: Notice --> Undefined variable: curl C:\xampp_5_6\htdocs\hrobolt\application\modules\API\controllers\API.php 148
ERROR - 2024-12-12 11:37:00 --> Severity: Warning --> curl_exec() expects parameter 1 to be resource, null given C:\xampp_5_6\htdocs\hrobolt\application\modules\API\controllers\API.php 148
ERROR - 2024-12-12 11:37:49 --> Severity: Notice --> Undefined variable: curl C:\xampp_5_6\htdocs\hrobolt\application\modules\API\controllers\API.php 150
ERROR - 2024-12-12 11:37:49 --> Severity: Warning --> curl_error() expects parameter 1 to be resource, null given C:\xampp_5_6\htdocs\hrobolt\application\modules\API\controllers\API.php 150
ERROR - 2024-12-12 11:37:51 --> Severity: Notice --> Undefined variable: curl C:\xampp_5_6\htdocs\hrobolt\application\modules\API\controllers\API.php 150
ERROR - 2024-12-12 11:37:51 --> Severity: Warning --> curl_error() expects parameter 1 to be resource, null given C:\xampp_5_6\htdocs\hrobolt\application\modules\API\controllers\API.php 150
ERROR - 2024-12-12 11:44:29 --> Severity: Notice --> Undefined variable: ch C:\xampp_5_6\htdocs\hrobolt\application\modules\API\controllers\API.php 144
ERROR - 2024-12-12 11:44:29 --> Severity: Warning --> curl_setopt() expects parameter 1 to be resource, null given C:\xampp_5_6\htdocs\hrobolt\application\modules\API\controllers\API.php 144
ERROR - 2024-12-12 11:44:49 --> Severity: Notice --> Undefined index: access_token C:\xampp_5_6\htdocs\hrobolt\application\modules\API\controllers\API.php 157
ERROR - 2024-12-12 11:44:49 --> Severity: Notice --> Undefined index: refresh_token C:\xampp_5_6\htdocs\hrobolt\application\modules\API\controllers\API.php 158
ERROR - 2024-12-12 11:44:49 --> Severity: Notice --> Array to string conversion C:\xampp_5_6\htdocs\hrobolt\application\modules\API\controllers\API.php 159
ERROR - 2024-12-12 13:32:13 --> Severity: Notice --> Undefined index: access_token C:\xampp_5_6\htdocs\hrobolt\application\modules\API\controllers\API.php 158
ERROR - 2024-12-12 13:32:13 --> Severity: Notice --> Undefined index: refresh_token C:\xampp_5_6\htdocs\hrobolt\application\modules\API\controllers\API.php 159
ERROR - 2024-12-12 13:32:13 --> Severity: Notice --> Array to string conversion C:\xampp_5_6\htdocs\hrobolt\application\modules\API\controllers\API.php 160
ERROR - 2024-12-12 15:02:40 --> 404 Page Not Found: ../modules/API/controllers/API/get_shop_info
ERROR - 2024-12-12 15:08:50 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp_5_6\htdocs\hrobolt\application\modules\API\controllers\API.php 499
ERROR - 2024-12-12 15:08:50 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp_5_6\htdocs\hrobolt\application\modules\API\controllers\API.php 610
ERROR - 2024-12-12 09:08:51 --> 404 Page Not Found: /index
ERROR - 2024-12-12 15:09:04 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp_5_6\htdocs\hrobolt\application\modules\API\controllers\API.php 499
ERROR - 2024-12-12 15:09:04 --> Severity: Warning --> Invalid argument supplied for foreach() C:\xampp_5_6\htdocs\hrobolt\application\modules\API\controllers\API.php 610
