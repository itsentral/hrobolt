<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-10-30 02:51:29 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-10-30 02:51:29 --> 404 Page Not Found: /index
ERROR - 2024-10-30 08:36:17 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-10-30 08:36:18 --> 404 Page Not Found: /index
ERROR - 2024-10-30 08:58:20 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-10-30 08:58:20 --> 404 Page Not Found: /index
ERROR - 2024-10-30 09:55:06 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-10-30 09:55:07 --> 404 Page Not Found: /index
ERROR - 2024-10-30 10:46:14 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-10-30 10:46:16 --> 404 Page Not Found: /index
ERROR - 2024-10-30 11:13:34 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-10-30 11:13:35 --> 404 Page Not Found: /index
ERROR - 2024-10-30 13:06:52 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-10-30 13:06:52 --> 404 Page Not Found: /index
ERROR - 2024-10-30 13:07:43 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/API/controllers/API.php 293
ERROR - 2024-10-30 13:08:20 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/API/controllers/API.php 380
ERROR - 2024-10-30 13:08:20 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/API/controllers/API.php 381
ERROR - 2024-10-30 13:08:20 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/API/controllers/API.php 383
ERROR - 2024-10-30 13:08:20 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/API/controllers/API.php 384
ERROR - 2024-10-30 13:08:20 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/API/controllers/API.php 380
ERROR - 2024-10-30 13:08:20 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/API/controllers/API.php 381
ERROR - 2024-10-30 13:08:20 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/API/controllers/API.php 383
ERROR - 2024-10-30 13:08:20 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/API/controllers/API.php 384
ERROR - 2024-10-30 13:08:20 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/API/controllers/API.php 380
ERROR - 2024-10-30 13:08:20 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/API/controllers/API.php 381
ERROR - 2024-10-30 13:08:20 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/API/controllers/API.php 383
ERROR - 2024-10-30 13:08:20 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/API/controllers/API.php 384
ERROR - 2024-10-30 13:08:20 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/ssc/hirobolt/system/core/Exceptions.php:272) /home/ssc/hirobolt/system/helpers/url_helper.php 562
ERROR - 2024-10-30 13:08:54 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'asc  LIMIT 0 ,50' at line 24 - Invalid query: 
  			SELECT
  				a.*,
				b.id AS id_sales_order_detail,
				b.qty AS qty_pcs,
				b.total_price AS total_price_pcs,
				a.another_price AS another_price,
				c.sku_varian AS sku, 
				c.nama_marketplace AS name_marketplace,
				c.nama AS name,
				d.name AS delivery_name
  			FROM
                  sales_marketplace_header a
				  LEFT JOIN sales_marketplace_detail b ON b.code_order = a.code_order
				  LEFT JOIN ms_inventory_category3 c ON c.id = b.product_id
				  LEFT JOIN master_pengiriman d ON d.id = a.delivery_service_id
  			WHERE 1=1 AND a.customer_name IS NOT NULL
  				AND (
  				a.code_order LIKE '%%'
  				OR a.code_order_marketplace LIKE '%%'
                OR a.customer_name LIKE '%%'
                OR c.nama_marketplace LIKE '%%'
				OR d.name LIKE '%%'
  	        )
  		 ORDER BY a.id DESC,  asc  LIMIT 0 ,50 
ERROR - 2024-10-30 13:08:55 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'desc  LIMIT 0 ,50' at line 24 - Invalid query: 
  			SELECT
  				a.*,
				b.id AS id_sales_order_detail,
				b.qty AS qty_pcs,
				b.total_price AS total_price_pcs,
				a.another_price AS another_price,
				c.sku_varian AS sku, 
				c.nama_marketplace AS name_marketplace,
				c.nama AS name,
				d.name AS delivery_name
  			FROM
                  sales_marketplace_header a
				  LEFT JOIN sales_marketplace_detail b ON b.code_order = a.code_order
				  LEFT JOIN ms_inventory_category3 c ON c.id = b.product_id
				  LEFT JOIN master_pengiriman d ON d.id = a.delivery_service_id
  			WHERE 1=1 AND a.customer_name IS NOT NULL
  				AND (
  				a.code_order LIKE '%%'
  				OR a.code_order_marketplace LIKE '%%'
                OR a.customer_name LIKE '%%'
                OR c.nama_marketplace LIKE '%%'
				OR d.name LIKE '%%'
  	        )
  		 ORDER BY a.id DESC,  desc  LIMIT 0 ,50 
ERROR - 2024-10-30 13:33:20 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-10-30 13:33:20 --> 404 Page Not Found: /index
ERROR - 2024-10-30 13:33:54 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-10-30 13:33:54 --> 404 Page Not Found: /index
ERROR - 2024-10-30 13:41:15 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'asc  LIMIT 0 ,5' at line 24 - Invalid query: 
  			SELECT
  				a.*,
				b.id AS id_sales_order_detail,
				b.qty AS qty_pcs,
				b.total_price AS total_price_pcs,
				a.another_price AS another_price,
				c.sku_varian AS sku, 
				c.nama_marketplace AS name_marketplace,
				c.nama AS name,
				d.name AS delivery_name
  			FROM
                  sales_marketplace_header a
				  LEFT JOIN sales_marketplace_detail b ON b.code_order = a.code_order
				  LEFT JOIN ms_inventory_category3 c ON c.id = b.product_id
				  LEFT JOIN master_pengiriman d ON d.id = a.delivery_service_id
  			WHERE 1=1 AND a.customer_name IS NOT NULL
  				AND (
  				a.code_order LIKE '%%'
  				OR a.code_order_marketplace LIKE '%%'
                OR a.customer_name LIKE '%%'
                OR c.nama_marketplace LIKE '%%'
				OR d.name LIKE '%%'
  	        )
  		 ORDER BY a.id DESC,  asc  LIMIT 0 ,5 
ERROR - 2024-10-30 13:41:16 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'desc  LIMIT 0 ,5' at line 24 - Invalid query: 
  			SELECT
  				a.*,
				b.id AS id_sales_order_detail,
				b.qty AS qty_pcs,
				b.total_price AS total_price_pcs,
				a.another_price AS another_price,
				c.sku_varian AS sku, 
				c.nama_marketplace AS name_marketplace,
				c.nama AS name,
				d.name AS delivery_name
  			FROM
                  sales_marketplace_header a
				  LEFT JOIN sales_marketplace_detail b ON b.code_order = a.code_order
				  LEFT JOIN ms_inventory_category3 c ON c.id = b.product_id
				  LEFT JOIN master_pengiriman d ON d.id = a.delivery_service_id
  			WHERE 1=1 AND a.customer_name IS NOT NULL
  				AND (
  				a.code_order LIKE '%%'
  				OR a.code_order_marketplace LIKE '%%'
                OR a.customer_name LIKE '%%'
                OR c.nama_marketplace LIKE '%%'
				OR d.name LIKE '%%'
  	        )
  		 ORDER BY a.id DESC,  desc  LIMIT 0 ,5 
ERROR - 2024-10-30 13:41:17 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'asc  LIMIT 0 ,5' at line 24 - Invalid query: 
  			SELECT
  				a.*,
				b.id AS id_sales_order_detail,
				b.qty AS qty_pcs,
				b.total_price AS total_price_pcs,
				a.another_price AS another_price,
				c.sku_varian AS sku, 
				c.nama_marketplace AS name_marketplace,
				c.nama AS name,
				d.name AS delivery_name
  			FROM
                  sales_marketplace_header a
				  LEFT JOIN sales_marketplace_detail b ON b.code_order = a.code_order
				  LEFT JOIN ms_inventory_category3 c ON c.id = b.product_id
				  LEFT JOIN master_pengiriman d ON d.id = a.delivery_service_id
  			WHERE 1=1 AND a.customer_name IS NOT NULL
  				AND (
  				a.code_order LIKE '%%'
  				OR a.code_order_marketplace LIKE '%%'
                OR a.customer_name LIKE '%%'
                OR c.nama_marketplace LIKE '%%'
				OR d.name LIKE '%%'
  	        )
  		 ORDER BY a.id DESC,  asc  LIMIT 0 ,5 
ERROR - 2024-10-30 13:41:17 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'desc  LIMIT 0 ,5' at line 24 - Invalid query: 
  			SELECT
  				a.*,
				b.id AS id_sales_order_detail,
				b.qty AS qty_pcs,
				b.total_price AS total_price_pcs,
				a.another_price AS another_price,
				c.sku_varian AS sku, 
				c.nama_marketplace AS name_marketplace,
				c.nama AS name,
				d.name AS delivery_name
  			FROM
                  sales_marketplace_header a
				  LEFT JOIN sales_marketplace_detail b ON b.code_order = a.code_order
				  LEFT JOIN ms_inventory_category3 c ON c.id = b.product_id
				  LEFT JOIN master_pengiriman d ON d.id = a.delivery_service_id
  			WHERE 1=1 AND a.customer_name IS NOT NULL
  				AND (
  				a.code_order LIKE '%%'
  				OR a.code_order_marketplace LIKE '%%'
                OR a.customer_name LIKE '%%'
                OR c.nama_marketplace LIKE '%%'
				OR d.name LIKE '%%'
  	        )
  		 ORDER BY a.id DESC,  desc  LIMIT 0 ,5 
ERROR - 2024-10-30 13:41:20 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'desc  LIMIT 0 ,150' at line 24 - Invalid query: 
  			SELECT
  				a.*,
				b.id AS id_sales_order_detail,
				b.qty AS qty_pcs,
				b.total_price AS total_price_pcs,
				a.another_price AS another_price,
				c.sku_varian AS sku, 
				c.nama_marketplace AS name_marketplace,
				c.nama AS name,
				d.name AS delivery_name
  			FROM
                  sales_marketplace_header a
				  LEFT JOIN sales_marketplace_detail b ON b.code_order = a.code_order
				  LEFT JOIN ms_inventory_category3 c ON c.id = b.product_id
				  LEFT JOIN master_pengiriman d ON d.id = a.delivery_service_id
  			WHERE 1=1 AND a.customer_name IS NOT NULL
  				AND (
  				a.code_order LIKE '%%'
  				OR a.code_order_marketplace LIKE '%%'
                OR a.customer_name LIKE '%%'
                OR c.nama_marketplace LIKE '%%'
				OR d.name LIKE '%%'
  	        )
  		 ORDER BY a.id DESC,  desc  LIMIT 0 ,150 
ERROR - 2024-10-30 13:41:21 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'asc  LIMIT 0 ,150' at line 24 - Invalid query: 
  			SELECT
  				a.*,
				b.id AS id_sales_order_detail,
				b.qty AS qty_pcs,
				b.total_price AS total_price_pcs,
				a.another_price AS another_price,
				c.sku_varian AS sku, 
				c.nama_marketplace AS name_marketplace,
				c.nama AS name,
				d.name AS delivery_name
  			FROM
                  sales_marketplace_header a
				  LEFT JOIN sales_marketplace_detail b ON b.code_order = a.code_order
				  LEFT JOIN ms_inventory_category3 c ON c.id = b.product_id
				  LEFT JOIN master_pengiriman d ON d.id = a.delivery_service_id
  			WHERE 1=1 AND a.customer_name IS NOT NULL
  				AND (
  				a.code_order LIKE '%%'
  				OR a.code_order_marketplace LIKE '%%'
                OR a.customer_name LIKE '%%'
                OR c.nama_marketplace LIKE '%%'
				OR d.name LIKE '%%'
  	        )
  		 ORDER BY a.id DESC,  asc  LIMIT 0 ,150 
ERROR - 2024-10-30 13:41:22 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'desc  LIMIT 0 ,150' at line 24 - Invalid query: 
  			SELECT
  				a.*,
				b.id AS id_sales_order_detail,
				b.qty AS qty_pcs,
				b.total_price AS total_price_pcs,
				a.another_price AS another_price,
				c.sku_varian AS sku, 
				c.nama_marketplace AS name_marketplace,
				c.nama AS name,
				d.name AS delivery_name
  			FROM
                  sales_marketplace_header a
				  LEFT JOIN sales_marketplace_detail b ON b.code_order = a.code_order
				  LEFT JOIN ms_inventory_category3 c ON c.id = b.product_id
				  LEFT JOIN master_pengiriman d ON d.id = a.delivery_service_id
  			WHERE 1=1 AND a.customer_name IS NOT NULL
  				AND (
  				a.code_order LIKE '%%'
  				OR a.code_order_marketplace LIKE '%%'
                OR a.customer_name LIKE '%%'
                OR c.nama_marketplace LIKE '%%'
				OR d.name LIKE '%%'
  	        )
  		 ORDER BY a.id DESC,  desc  LIMIT 0 ,150 
ERROR - 2024-10-30 13:41:22 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'asc  LIMIT 0 ,150' at line 24 - Invalid query: 
  			SELECT
  				a.*,
				b.id AS id_sales_order_detail,
				b.qty AS qty_pcs,
				b.total_price AS total_price_pcs,
				a.another_price AS another_price,
				c.sku_varian AS sku, 
				c.nama_marketplace AS name_marketplace,
				c.nama AS name,
				d.name AS delivery_name
  			FROM
                  sales_marketplace_header a
				  LEFT JOIN sales_marketplace_detail b ON b.code_order = a.code_order
				  LEFT JOIN ms_inventory_category3 c ON c.id = b.product_id
				  LEFT JOIN master_pengiriman d ON d.id = a.delivery_service_id
  			WHERE 1=1 AND a.customer_name IS NOT NULL
  				AND (
  				a.code_order LIKE '%%'
  				OR a.code_order_marketplace LIKE '%%'
                OR a.customer_name LIKE '%%'
                OR c.nama_marketplace LIKE '%%'
				OR d.name LIKE '%%'
  	        )
  		 ORDER BY a.id DESC,  asc  LIMIT 0 ,150 
ERROR - 2024-10-30 13:41:23 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'desc  LIMIT 0 ,150' at line 24 - Invalid query: 
  			SELECT
  				a.*,
				b.id AS id_sales_order_detail,
				b.qty AS qty_pcs,
				b.total_price AS total_price_pcs,
				a.another_price AS another_price,
				c.sku_varian AS sku, 
				c.nama_marketplace AS name_marketplace,
				c.nama AS name,
				d.name AS delivery_name
  			FROM
                  sales_marketplace_header a
				  LEFT JOIN sales_marketplace_detail b ON b.code_order = a.code_order
				  LEFT JOIN ms_inventory_category3 c ON c.id = b.product_id
				  LEFT JOIN master_pengiriman d ON d.id = a.delivery_service_id
  			WHERE 1=1 AND a.customer_name IS NOT NULL
  				AND (
  				a.code_order LIKE '%%'
  				OR a.code_order_marketplace LIKE '%%'
                OR a.customer_name LIKE '%%'
                OR c.nama_marketplace LIKE '%%'
				OR d.name LIKE '%%'
  	        )
  		 ORDER BY a.id DESC,  desc  LIMIT 0 ,150 
ERROR - 2024-10-30 13:41:23 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'asc  LIMIT 0 ,150' at line 24 - Invalid query: 
  			SELECT
  				a.*,
				b.id AS id_sales_order_detail,
				b.qty AS qty_pcs,
				b.total_price AS total_price_pcs,
				a.another_price AS another_price,
				c.sku_varian AS sku, 
				c.nama_marketplace AS name_marketplace,
				c.nama AS name,
				d.name AS delivery_name
  			FROM
                  sales_marketplace_header a
				  LEFT JOIN sales_marketplace_detail b ON b.code_order = a.code_order
				  LEFT JOIN ms_inventory_category3 c ON c.id = b.product_id
				  LEFT JOIN master_pengiriman d ON d.id = a.delivery_service_id
  			WHERE 1=1 AND a.customer_name IS NOT NULL
  				AND (
  				a.code_order LIKE '%%'
  				OR a.code_order_marketplace LIKE '%%'
                OR a.customer_name LIKE '%%'
                OR c.nama_marketplace LIKE '%%'
				OR d.name LIKE '%%'
  	        )
  		 ORDER BY a.id DESC,  asc  LIMIT 0 ,150 
ERROR - 2024-10-30 13:41:27 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'asc  LIMIT 150 ,150' at line 24 - Invalid query: 
  			SELECT
  				a.*,
				b.id AS id_sales_order_detail,
				b.qty AS qty_pcs,
				b.total_price AS total_price_pcs,
				a.another_price AS another_price,
				c.sku_varian AS sku, 
				c.nama_marketplace AS name_marketplace,
				c.nama AS name,
				d.name AS delivery_name
  			FROM
                  sales_marketplace_header a
				  LEFT JOIN sales_marketplace_detail b ON b.code_order = a.code_order
				  LEFT JOIN ms_inventory_category3 c ON c.id = b.product_id
				  LEFT JOIN master_pengiriman d ON d.id = a.delivery_service_id
  			WHERE 1=1 AND a.customer_name IS NOT NULL
  				AND (
  				a.code_order LIKE '%%'
  				OR a.code_order_marketplace LIKE '%%'
                OR a.customer_name LIKE '%%'
                OR c.nama_marketplace LIKE '%%'
				OR d.name LIKE '%%'
  	        )
  		 ORDER BY a.id DESC,  asc  LIMIT 150 ,150 
ERROR - 2024-10-30 13:41:31 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'asc  LIMIT 0 ,5' at line 24 - Invalid query: 
  			SELECT
  				a.*,
				b.id AS id_sales_order_detail,
				b.qty AS qty_pcs,
				b.total_price AS total_price_pcs,
				a.another_price AS another_price,
				c.sku_varian AS sku, 
				c.nama_marketplace AS name_marketplace,
				c.nama AS name,
				d.name AS delivery_name
  			FROM
                  sales_marketplace_header a
				  LEFT JOIN sales_marketplace_detail b ON b.code_order = a.code_order
				  LEFT JOIN ms_inventory_category3 c ON c.id = b.product_id
				  LEFT JOIN master_pengiriman d ON d.id = a.delivery_service_id
  			WHERE 1=1 AND a.customer_name IS NOT NULL
  				AND (
  				a.code_order LIKE '%%'
  				OR a.code_order_marketplace LIKE '%%'
                OR a.customer_name LIKE '%%'
                OR c.nama_marketplace LIKE '%%'
				OR d.name LIKE '%%'
  	        )
  		 ORDER BY a.id DESC,  asc  LIMIT 0 ,5 
ERROR - 2024-10-30 13:41:33 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'asc  LIMIT 0 ,20' at line 24 - Invalid query: 
  			SELECT
  				a.*,
				b.id AS id_sales_order_detail,
				b.qty AS qty_pcs,
				b.total_price AS total_price_pcs,
				a.another_price AS another_price,
				c.sku_varian AS sku, 
				c.nama_marketplace AS name_marketplace,
				c.nama AS name,
				d.name AS delivery_name
  			FROM
                  sales_marketplace_header a
				  LEFT JOIN sales_marketplace_detail b ON b.code_order = a.code_order
				  LEFT JOIN ms_inventory_category3 c ON c.id = b.product_id
				  LEFT JOIN master_pengiriman d ON d.id = a.delivery_service_id
  			WHERE 1=1 AND a.customer_name IS NOT NULL
  				AND (
  				a.code_order LIKE '%%'
  				OR a.code_order_marketplace LIKE '%%'
                OR a.customer_name LIKE '%%'
                OR c.nama_marketplace LIKE '%%'
				OR d.name LIKE '%%'
  	        )
  		 ORDER BY a.id DESC,  asc  LIMIT 0 ,20 
ERROR - 2024-10-30 13:41:38 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-10-30 13:41:38 --> 404 Page Not Found: /index
ERROR - 2024-10-30 13:41:49 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'asc  LIMIT 0 ,5' at line 24 - Invalid query: 
  			SELECT
  				a.*,
				b.id AS id_sales_order_detail,
				b.qty AS qty_pcs,
				b.total_price AS total_price_pcs,
				a.another_price AS another_price,
				c.sku_varian AS sku, 
				c.nama_marketplace AS name_marketplace,
				c.nama AS name,
				d.name AS delivery_name
  			FROM
                  sales_marketplace_header a
				  LEFT JOIN sales_marketplace_detail b ON b.code_order = a.code_order
				  LEFT JOIN ms_inventory_category3 c ON c.id = b.product_id
				  LEFT JOIN master_pengiriman d ON d.id = a.delivery_service_id
  			WHERE 1=1 AND a.customer_name IS NOT NULL
  				AND (
  				a.code_order LIKE '%%'
  				OR a.code_order_marketplace LIKE '%%'
                OR a.customer_name LIKE '%%'
                OR c.nama_marketplace LIKE '%%'
				OR d.name LIKE '%%'
  	        )
  		 ORDER BY a.id DESC,  asc  LIMIT 0 ,5 
ERROR - 2024-10-30 13:41:51 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'asc  LIMIT 5 ,5' at line 24 - Invalid query: 
  			SELECT
  				a.*,
				b.id AS id_sales_order_detail,
				b.qty AS qty_pcs,
				b.total_price AS total_price_pcs,
				a.another_price AS another_price,
				c.sku_varian AS sku, 
				c.nama_marketplace AS name_marketplace,
				c.nama AS name,
				d.name AS delivery_name
  			FROM
                  sales_marketplace_header a
				  LEFT JOIN sales_marketplace_detail b ON b.code_order = a.code_order
				  LEFT JOIN ms_inventory_category3 c ON c.id = b.product_id
				  LEFT JOIN master_pengiriman d ON d.id = a.delivery_service_id
  			WHERE 1=1 AND a.customer_name IS NOT NULL
  				AND (
  				a.code_order LIKE '%%'
  				OR a.code_order_marketplace LIKE '%%'
                OR a.customer_name LIKE '%%'
                OR c.nama_marketplace LIKE '%%'
				OR d.name LIKE '%%'
  	        )
  		 ORDER BY a.id DESC,  asc  LIMIT 5 ,5 
ERROR - 2024-10-30 13:41:53 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'asc  LIMIT 5 ,5' at line 24 - Invalid query: 
  			SELECT
  				a.*,
				b.id AS id_sales_order_detail,
				b.qty AS qty_pcs,
				b.total_price AS total_price_pcs,
				a.another_price AS another_price,
				c.sku_varian AS sku, 
				c.nama_marketplace AS name_marketplace,
				c.nama AS name,
				d.name AS delivery_name
  			FROM
                  sales_marketplace_header a
				  LEFT JOIN sales_marketplace_detail b ON b.code_order = a.code_order
				  LEFT JOIN ms_inventory_category3 c ON c.id = b.product_id
				  LEFT JOIN master_pengiriman d ON d.id = a.delivery_service_id
  			WHERE 1=1 AND a.customer_name IS NOT NULL
  				AND (
  				a.code_order LIKE '%%'
  				OR a.code_order_marketplace LIKE '%%'
                OR a.customer_name LIKE '%%'
                OR c.nama_marketplace LIKE '%%'
				OR d.name LIKE '%%'
  	        )
  		 ORDER BY a.id DESC,  asc  LIMIT 5 ,5 
ERROR - 2024-10-30 13:41:53 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'asc  LIMIT 10 ,5' at line 24 - Invalid query: 
  			SELECT
  				a.*,
				b.id AS id_sales_order_detail,
				b.qty AS qty_pcs,
				b.total_price AS total_price_pcs,
				a.another_price AS another_price,
				c.sku_varian AS sku, 
				c.nama_marketplace AS name_marketplace,
				c.nama AS name,
				d.name AS delivery_name
  			FROM
                  sales_marketplace_header a
				  LEFT JOIN sales_marketplace_detail b ON b.code_order = a.code_order
				  LEFT JOIN ms_inventory_category3 c ON c.id = b.product_id
				  LEFT JOIN master_pengiriman d ON d.id = a.delivery_service_id
  			WHERE 1=1 AND a.customer_name IS NOT NULL
  				AND (
  				a.code_order LIKE '%%'
  				OR a.code_order_marketplace LIKE '%%'
                OR a.customer_name LIKE '%%'
                OR c.nama_marketplace LIKE '%%'
				OR d.name LIKE '%%'
  	        )
  		 ORDER BY a.id DESC,  asc  LIMIT 10 ,5 
ERROR - 2024-10-30 13:41:54 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'asc  LIMIT 15 ,5' at line 24 - Invalid query: 
  			SELECT
  				a.*,
				b.id AS id_sales_order_detail,
				b.qty AS qty_pcs,
				b.total_price AS total_price_pcs,
				a.another_price AS another_price,
				c.sku_varian AS sku, 
				c.nama_marketplace AS name_marketplace,
				c.nama AS name,
				d.name AS delivery_name
  			FROM
                  sales_marketplace_header a
				  LEFT JOIN sales_marketplace_detail b ON b.code_order = a.code_order
				  LEFT JOIN ms_inventory_category3 c ON c.id = b.product_id
				  LEFT JOIN master_pengiriman d ON d.id = a.delivery_service_id
  			WHERE 1=1 AND a.customer_name IS NOT NULL
  				AND (
  				a.code_order LIKE '%%'
  				OR a.code_order_marketplace LIKE '%%'
                OR a.customer_name LIKE '%%'
                OR c.nama_marketplace LIKE '%%'
				OR d.name LIKE '%%'
  	        )
  		 ORDER BY a.id DESC,  asc  LIMIT 15 ,5 
ERROR - 2024-10-30 13:41:55 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'asc  LIMIT 20 ,5' at line 24 - Invalid query: 
  			SELECT
  				a.*,
				b.id AS id_sales_order_detail,
				b.qty AS qty_pcs,
				b.total_price AS total_price_pcs,
				a.another_price AS another_price,
				c.sku_varian AS sku, 
				c.nama_marketplace AS name_marketplace,
				c.nama AS name,
				d.name AS delivery_name
  			FROM
                  sales_marketplace_header a
				  LEFT JOIN sales_marketplace_detail b ON b.code_order = a.code_order
				  LEFT JOIN ms_inventory_category3 c ON c.id = b.product_id
				  LEFT JOIN master_pengiriman d ON d.id = a.delivery_service_id
  			WHERE 1=1 AND a.customer_name IS NOT NULL
  				AND (
  				a.code_order LIKE '%%'
  				OR a.code_order_marketplace LIKE '%%'
                OR a.customer_name LIKE '%%'
                OR c.nama_marketplace LIKE '%%'
				OR d.name LIKE '%%'
  	        )
  		 ORDER BY a.id DESC,  asc  LIMIT 20 ,5 
ERROR - 2024-10-30 13:41:56 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'asc  LIMIT 150 ,5' at line 24 - Invalid query: 
  			SELECT
  				a.*,
				b.id AS id_sales_order_detail,
				b.qty AS qty_pcs,
				b.total_price AS total_price_pcs,
				a.another_price AS another_price,
				c.sku_varian AS sku, 
				c.nama_marketplace AS name_marketplace,
				c.nama AS name,
				d.name AS delivery_name
  			FROM
                  sales_marketplace_header a
				  LEFT JOIN sales_marketplace_detail b ON b.code_order = a.code_order
				  LEFT JOIN ms_inventory_category3 c ON c.id = b.product_id
				  LEFT JOIN master_pengiriman d ON d.id = a.delivery_service_id
  			WHERE 1=1 AND a.customer_name IS NOT NULL
  				AND (
  				a.code_order LIKE '%%'
  				OR a.code_order_marketplace LIKE '%%'
                OR a.customer_name LIKE '%%'
                OR c.nama_marketplace LIKE '%%'
				OR d.name LIKE '%%'
  	        )
  		 ORDER BY a.id DESC,  asc  LIMIT 150 ,5 
ERROR - 2024-10-30 13:41:57 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'asc  LIMIT 150 ,5' at line 24 - Invalid query: 
  			SELECT
  				a.*,
				b.id AS id_sales_order_detail,
				b.qty AS qty_pcs,
				b.total_price AS total_price_pcs,
				a.another_price AS another_price,
				c.sku_varian AS sku, 
				c.nama_marketplace AS name_marketplace,
				c.nama AS name,
				d.name AS delivery_name
  			FROM
                  sales_marketplace_header a
				  LEFT JOIN sales_marketplace_detail b ON b.code_order = a.code_order
				  LEFT JOIN ms_inventory_category3 c ON c.id = b.product_id
				  LEFT JOIN master_pengiriman d ON d.id = a.delivery_service_id
  			WHERE 1=1 AND a.customer_name IS NOT NULL
  				AND (
  				a.code_order LIKE '%%'
  				OR a.code_order_marketplace LIKE '%%'
                OR a.customer_name LIKE '%%'
                OR c.nama_marketplace LIKE '%%'
				OR d.name LIKE '%%'
  	        )
  		 ORDER BY a.id DESC,  asc  LIMIT 150 ,5 
ERROR - 2024-10-30 13:41:57 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'asc  LIMIT 150 ,5' at line 24 - Invalid query: 
  			SELECT
  				a.*,
				b.id AS id_sales_order_detail,
				b.qty AS qty_pcs,
				b.total_price AS total_price_pcs,
				a.another_price AS another_price,
				c.sku_varian AS sku, 
				c.nama_marketplace AS name_marketplace,
				c.nama AS name,
				d.name AS delivery_name
  			FROM
                  sales_marketplace_header a
				  LEFT JOIN sales_marketplace_detail b ON b.code_order = a.code_order
				  LEFT JOIN ms_inventory_category3 c ON c.id = b.product_id
				  LEFT JOIN master_pengiriman d ON d.id = a.delivery_service_id
  			WHERE 1=1 AND a.customer_name IS NOT NULL
  				AND (
  				a.code_order LIKE '%%'
  				OR a.code_order_marketplace LIKE '%%'
                OR a.customer_name LIKE '%%'
                OR c.nama_marketplace LIKE '%%'
				OR d.name LIKE '%%'
  	        )
  		 ORDER BY a.id DESC,  asc  LIMIT 150 ,5 
ERROR - 2024-10-30 13:41:58 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'asc  LIMIT 150 ,5' at line 24 - Invalid query: 
  			SELECT
  				a.*,
				b.id AS id_sales_order_detail,
				b.qty AS qty_pcs,
				b.total_price AS total_price_pcs,
				a.another_price AS another_price,
				c.sku_varian AS sku, 
				c.nama_marketplace AS name_marketplace,
				c.nama AS name,
				d.name AS delivery_name
  			FROM
                  sales_marketplace_header a
				  LEFT JOIN sales_marketplace_detail b ON b.code_order = a.code_order
				  LEFT JOIN ms_inventory_category3 c ON c.id = b.product_id
				  LEFT JOIN master_pengiriman d ON d.id = a.delivery_service_id
  			WHERE 1=1 AND a.customer_name IS NOT NULL
  				AND (
  				a.code_order LIKE '%%'
  				OR a.code_order_marketplace LIKE '%%'
                OR a.customer_name LIKE '%%'
                OR c.nama_marketplace LIKE '%%'
				OR d.name LIKE '%%'
  	        )
  		 ORDER BY a.id DESC,  asc  LIMIT 150 ,5 
ERROR - 2024-10-30 13:42:00 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'asc  LIMIT 150 ,50' at line 24 - Invalid query: 
  			SELECT
  				a.*,
				b.id AS id_sales_order_detail,
				b.qty AS qty_pcs,
				b.total_price AS total_price_pcs,
				a.another_price AS another_price,
				c.sku_varian AS sku, 
				c.nama_marketplace AS name_marketplace,
				c.nama AS name,
				d.name AS delivery_name
  			FROM
                  sales_marketplace_header a
				  LEFT JOIN sales_marketplace_detail b ON b.code_order = a.code_order
				  LEFT JOIN ms_inventory_category3 c ON c.id = b.product_id
				  LEFT JOIN master_pengiriman d ON d.id = a.delivery_service_id
  			WHERE 1=1 AND a.customer_name IS NOT NULL
  				AND (
  				a.code_order LIKE '%%'
  				OR a.code_order_marketplace LIKE '%%'
                OR a.customer_name LIKE '%%'
                OR c.nama_marketplace LIKE '%%'
				OR d.name LIKE '%%'
  	        )
  		 ORDER BY a.id DESC,  asc  LIMIT 150 ,50 
ERROR - 2024-10-30 13:42:05 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'asc  LIMIT 50 ,50' at line 24 - Invalid query: 
  			SELECT
  				a.*,
				b.id AS id_sales_order_detail,
				b.qty AS qty_pcs,
				b.total_price AS total_price_pcs,
				a.another_price AS another_price,
				c.sku_varian AS sku, 
				c.nama_marketplace AS name_marketplace,
				c.nama AS name,
				d.name AS delivery_name
  			FROM
                  sales_marketplace_header a
				  LEFT JOIN sales_marketplace_detail b ON b.code_order = a.code_order
				  LEFT JOIN ms_inventory_category3 c ON c.id = b.product_id
				  LEFT JOIN master_pengiriman d ON d.id = a.delivery_service_id
  			WHERE 1=1 AND a.customer_name IS NOT NULL
  				AND (
  				a.code_order LIKE '%%'
  				OR a.code_order_marketplace LIKE '%%'
                OR a.customer_name LIKE '%%'
                OR c.nama_marketplace LIKE '%%'
				OR d.name LIKE '%%'
  	        )
  		 ORDER BY a.id DESC,  asc  LIMIT 50 ,50 
ERROR - 2024-10-30 13:42:24 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/API/controllers/API.php 293
ERROR - 2024-10-30 13:49:02 --> 404 Page Not Found: ../modules/sales_marketplace/controllers/Sales_marketplace/export_excel
ERROR - 2024-10-30 13:49:10 --> 404 Page Not Found: ../modules/sales_marketplace/controllers/Sales_marketplace/export_excel
ERROR - 2024-10-30 14:19:11 --> Severity: Parsing Error --> syntax error, unexpected '}', expecting endswitch (T_ENDSWITCH) or case (T_CASE) or default (T_DEFAULT) /home/ssc/hirobolt/application/modules/sales_marketplace/controllers/Sales_marketplace.php 790
ERROR - 2024-10-30 14:19:13 --> Severity: Parsing Error --> syntax error, unexpected '}', expecting endswitch (T_ENDSWITCH) or case (T_CASE) or default (T_DEFAULT) /home/ssc/hirobolt/application/modules/sales_marketplace/controllers/Sales_marketplace.php 790
ERROR - 2024-10-30 14:26:57 --> Query error: Table 'hirobolt.master_pangiriman' doesn't exist - Invalid query: SELECT a.*, b.name AS jasa_pengiriman FROM sales_marketplace_header a LEFT JOIN master_pangiriman b ON b.id = a.delivery_service_id
ERROR - 2024-10-30 14:27:19 --> Severity: Compile Error --> Cannot redeclare class PHPExcel /home/ssc/hirobolt/application/libraries/PHPExcel.php 35
ERROR - 2024-10-30 14:28:13 --> Severity: Compile Error --> Cannot redeclare class PHPExcel /home/ssc/hirobolt/application/libraries/PHPExcel.php 35
ERROR - 2024-10-30 14:29:11 --> Severity: Compile Error --> Cannot redeclare class PHPExcel /home/ssc/hirobolt/application/libraries/PHPExcel.php 35
ERROR - 2024-10-30 14:42:48 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-10-30 14:42:48 --> 404 Page Not Found: /index
ERROR - 2024-10-30 14:57:19 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/packing/controllers/Packing.php 69
ERROR - 2024-10-30 14:57:21 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/packing/controllers/Packing.php 69
ERROR - 2024-10-30 15:33:49 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-10-30 15:33:50 --> 404 Page Not Found: /index
ERROR - 2024-10-30 15:37:29 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/packing/controllers/Packing.php 69
ERROR - 2024-10-30 15:38:07 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/packing/controllers/Packing.php 69
ERROR - 2024-10-30 15:38:12 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/packing/controllers/Packing.php 69
ERROR - 2024-10-30 15:38:21 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/packing/controllers/Packing.php 69
ERROR - 2024-10-30 15:40:39 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/packing/controllers/Packing.php 69
ERROR - 2024-10-30 15:40:45 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/packing/controllers/Packing.php 69
ERROR - 2024-10-30 15:40:50 --> Query error: Table 'hirobolt.ms_inventory_category_3' doesn't exist - Invalid query: SELECT a.*, b.nama AS product_name, b.sku_varian AS sku_varian 
													FROM sales_marketplace_detail a 
													JOIN ms_inventory_category_3 b ON b.id = a.product_id 
													WHERE a.code_order = '240730015947001'
ERROR - 2024-10-30 15:41:34 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/packing/controllers/Packing.php 69
ERROR - 2024-10-30 15:41:36 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/packing/controllers/Packing.php 69
ERROR - 2024-10-30 15:41:50 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/packing/controllers/Packing.php 69
ERROR - 2024-10-30 16:05:14 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/packing/controllers/Packing.php 69
ERROR - 2024-10-30 18:56:47 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-10-30 18:56:48 --> 404 Page Not Found: /index
ERROR - 2024-10-30 19:07:55 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-10-30 19:07:57 --> 404 Page Not Found: /index
