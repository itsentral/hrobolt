<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-09-02 08:17:18 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-02 08:17:19 --> 404 Page Not Found: /index
ERROR - 2024-09-02 08:56:29 --> 404 Page Not Found: /index
ERROR - 2024-09-02 09:09:49 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-02 09:09:52 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-02 09:09:52 --> 404 Page Not Found: /index
ERROR - 2024-09-02 09:15:42 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-02 09:15:43 --> 404 Page Not Found: /index
ERROR - 2024-09-02 10:51:23 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-02 10:51:23 --> 404 Page Not Found: /index
ERROR - 2024-09-02 11:01:04 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/inventory_4/views/form_inventory.php 105
ERROR - 2024-09-02 11:01:04 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/inventory_4/views/form_inventory.php 133
ERROR - 2024-09-02 13:58:11 --> Query error: Unknown column 'b.kode_barang' in 'field list' - Invalid query: SELECT a.*, b.nama as nama_produk, b.kode_barang, c.nama_category2 as nama_formula FROM ms_product_pricelist as a 
										INNER JOIN ms_inventory_category3 b on b.id_category3=a.id_category3
										INNER JOIN ms_product_costing c on c.id_category2 = a.id_formula
										WHERE a.deleted !='1'
										
ERROR - 2024-09-02 13:58:25 --> Query error: Unknown column 'b.kode_barang' in 'field list' - Invalid query: SELECT a.*, b.nama as nama_produk, b.kode_barang, c.nama_category2 as nama_formula FROM ms_product_pricelist as a 
										INNER JOIN ms_inventory_category3 b on b.id_category3=a.id_category3
										INNER JOIN ms_product_costing c on c.id_category2 = a.id_formula
										WHERE a.deleted !='1'
										
ERROR - 2024-09-02 13:58:31 --> Query error: Unknown column 'b.kode_barang' in 'field list' - Invalid query: SELECT a.*, b.nama as nama_produk, b.kode_barang, c.nama_category2 as nama_formula FROM ms_product_pricelist as a 
										INNER JOIN ms_inventory_category3 b on b.id_category3=a.id_category3
										INNER JOIN ms_product_costing c on c.id_category2 = a.id_formula
										WHERE a.deleted !='1'
										
ERROR - 2024-09-02 13:59:53 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-02 13:59:54 --> 404 Page Not Found: /index
ERROR - 2024-09-02 14:00:32 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-02 14:00:32 --> 404 Page Not Found: /index
ERROR - 2024-09-02 14:09:49 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'a.product_id AS product_id, 
                                        a.qty AS qt' at line 3 - Invalid query: SELECT 
                                        a.id AS id
                                        a.product_id AS product_id, 
                                        a.qty AS qty_barang, 
                                        b.nama AS nama_produk,
                                        b.sku_varian AS sku 
                                        FROM sales_marketplace_detail a 
                                        LEFT JOIN ms_inventory_category3 b 
                                        ON b.id = a.product_id 
                                        WHERE b.sku_varian = '1T2XA' 
                                        AND a.code_order = '240902085608028'
ERROR - 2024-09-02 14:10:08 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'a.product_id AS product_id, 
                                        a.qty AS qt' at line 3 - Invalid query: SELECT 
                                        a.id AS id
                                        a.product_id AS product_id, 
                                        a.qty AS qty_barang, 
                                        b.nama AS nama_produk,
                                        b.sku_varian AS sku 
                                        FROM sales_marketplace_detail a 
                                        LEFT JOIN ms_inventory_category3 b 
                                        ON b.id = a.product_id 
                                        WHERE b.sku_varian = '1T2XA' 
                                        AND a.code_order = '240902085608028'
ERROR - 2024-09-02 14:10:54 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'a.product_id AS product_id, 
                                        a.qty AS qt' at line 3 - Invalid query: SELECT 
                                        a.id AS id
                                        a.product_id AS product_id, 
                                        a.qty AS qty_barang, 
                                        b.nama AS nama_produk,
                                        b.sku_varian AS sku 
                                        FROM sales_marketplace_detail a 
                                        LEFT JOIN ms_inventory_category3 b 
                                        ON b.id = a.product_id 
                                        WHERE b.sku_varian = '1A3RRRH' 
                                        AND a.code_order = '240902101627030'
ERROR - 2024-09-02 14:13:22 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'a.product_id AS product_id, 
                                        a.qty AS qt' at line 3 - Invalid query: SELECT 
                                        a.id AS id
                                        a.product_id AS product_id, 
                                        a.qty AS qty_barang, 
                                        b.nama AS nama_produk,
                                        b.sku_varian AS sku 
                                        FROM sales_marketplace_detail a 
                                        LEFT JOIN ms_inventory_category3 b 
                                        ON b.id = a.product_id 
                                        WHERE b.sku_varian = 'xx' 
                                        AND a.code_order = '240902101627030'
ERROR - 2024-09-02 14:14:06 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'a.product_id AS product_id, 
                                        a.qty AS qt' at line 3 - Invalid query: SELECT 
                                        a.id AS id
                                        a.product_id AS product_id, 
                                        a.qty AS qty_barang, 
                                        b.nama AS nama_produk,
                                        b.sku_varian AS sku 
                                        FROM sales_marketplace_detail a 
                                        LEFT JOIN ms_inventory_category3 b 
                                        ON b.id = a.product_id 
                                        WHERE b.sku_varian = '2b1xx' 
                                        AND a.code_order = '240730020145002'
ERROR - 2024-09-02 14:14:13 --> Severity: Notice --> Undefined index: value /home/ssc/hirobolt/application/modules/packing/controllers/Packing.php 60
ERROR - 2024-09-02 14:14:13 --> Severity: Notice --> Undefined index: code_order /home/ssc/hirobolt/application/modules/packing/controllers/Packing.php 61
ERROR - 2024-09-02 14:14:13 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'a.product_id AS product_id, 
                                        a.qty AS qt' at line 3 - Invalid query: SELECT 
                                        a.id AS id
                                        a.product_id AS product_id, 
                                        a.qty AS qty_barang, 
                                        b.nama AS nama_produk,
                                        b.sku_varian AS sku 
                                        FROM sales_marketplace_detail a 
                                        LEFT JOIN ms_inventory_category3 b 
                                        ON b.id = a.product_id 
                                        WHERE b.sku_varian = '' 
                                        AND a.code_order = ''
ERROR - 2024-09-02 14:14:48 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'a.product_id AS product_id, 
                                        a.qty AS qt' at line 3 - Invalid query: SELECT 
                                        a.id AS id
                                        a.product_id AS product_id, 
                                        a.qty AS qty_barang, 
                                        b.nama AS nama_produk,
                                        b.sku_varian AS sku 
                                        FROM sales_marketplace_detail a 
                                        LEFT JOIN ms_inventory_category3 b 
                                        ON b.id = a.product_id 
                                        WHERE b.sku_varian = '2b1xx' 
                                        AND a.code_order = '240730020145002'
ERROR - 2024-09-02 14:15:11 --> Severity: Notice --> Undefined index: code_order /home/ssc/hirobolt/application/modules/packing/controllers/Packing.php 68
ERROR - 2024-09-02 14:15:40 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/packing/controllers/Packing.php 69
ERROR - 2024-09-02 14:17:31 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/packing/controllers/Packing.php 69
ERROR - 2024-09-02 14:21:40 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/packing/controllers/Packing.php 69
ERROR - 2024-09-02 14:24:31 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/packing/controllers/Packing.php 69
ERROR - 2024-09-02 14:27:49 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/packing/controllers/Packing.php 69
ERROR - 2024-09-02 14:28:34 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/packing/controllers/Packing.php 69
ERROR - 2024-09-02 14:29:29 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/packing/controllers/Packing.php 69
ERROR - 2024-09-02 14:31:05 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/packing/controllers/Packing.php 69
ERROR - 2024-09-02 14:46:39 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/packing/controllers/Packing.php 69
ERROR - 2024-09-02 14:47:10 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/packing/controllers/Packing.php 69
ERROR - 2024-09-02 14:53:21 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/packing/controllers/Packing.php 69
ERROR - 2024-09-02 14:54:01 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/packing/controllers/Packing.php 69
ERROR - 2024-09-02 14:54:21 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/packing/controllers/Packing.php 69
ERROR - 2024-09-02 15:15:23 --> 404 Page Not Found: ../modules/spk_gudang/controllers/Spk_gudang/index
ERROR - 2024-09-02 15:16:57 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'DAYS)' at line 1 - Invalid query: SELECT * FROM spk_gudang WHERE DATE(created_at) < DATE_SUB(NOW(), INTERVAL 30 DAYS)
ERROR - 2024-09-02 15:22:45 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')' at line 1 - Invalid query: SELECT * FROM spk_gudang WHERE DATEDIFF(CURDATE(), created_date) > 15)
ERROR - 2024-09-02 15:23:08 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')' at line 1 - Invalid query: SELECT * FROM spk_gudang WHERE DATEDIFF(CURDATE(), created_at) > 15)
ERROR - 2024-09-02 16:20:55 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-02 16:20:55 --> 404 Page Not Found: /index
ERROR - 2024-09-02 17:30:22 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-02 17:30:22 --> 404 Page Not Found: /index
ERROR - 2024-09-02 17:30:50 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-02 17:30:51 --> 404 Page Not Found: /index
