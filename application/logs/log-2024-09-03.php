<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-09-03 08:32:03 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-03 08:32:03 --> 404 Page Not Found: /index
ERROR - 2024-09-03 13:35:03 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-03 13:35:03 --> 404 Page Not Found: /index
ERROR - 2024-09-03 14:51:15 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-03 14:51:15 --> 404 Page Not Found: /index
ERROR - 2024-09-03 15:09:27 --> Query error: Unknown column 'b.kode_barang' in 'field list' - Invalid query: SELECT a.*, b.nama as nama_produk, b.kode_barang, c.nama_category2 as nama_formula FROM ms_product_pricelist as a 
										INNER JOIN ms_inventory_category3 b on b.id_category3=a.id_category3
										INNER JOIN ms_product_costing c on c.id_category2 = a.id_formula
										WHERE a.deleted !='1'
										
ERROR - 2024-09-03 15:09:40 --> Query error: Unknown column 'b.kode_barang' in 'field list' - Invalid query: SELECT a.*, b.nama as nama_produk, b.kode_barang, c.nama_category2 as nama_formula FROM ms_product_pricelist as a 
										INNER JOIN ms_inventory_category3 b on b.id_category3=a.id_category3
										INNER JOIN ms_product_costing c on c.id_category2 = a.id_formula
										WHERE a.deleted !='1'
										
ERROR - 2024-09-03 15:16:14 --> Query error: Unknown column 'id_category3' in 'where clause' - Invalid query: SELECT * FROM ms_inventory_category3 WHERE id_category3 = '1571' 
ERROR - 2024-09-03 15:16:14 --> Query error: Unknown column 'id_category3' in 'where clause' - Invalid query: SELECT * FROM ms_inventory_category3 WHERE id_category3 = '1571' 
ERROR - 2024-09-03 15:16:14 --> Query error: Unknown column 'id_category3' in 'where clause' - Invalid query: SELECT * FROM ms_inventory_category3 WHERE id_category3 = '1571' 
ERROR - 2024-09-03 16:48:32 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-03 16:48:33 --> 404 Page Not Found: /index
ERROR - 2024-09-03 16:50:33 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/packing/controllers/Packing.php 69
ERROR - 2024-09-03 16:52:32 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/packing/controllers/Packing.php 69
ERROR - 2024-09-03 16:52:33 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/packing/controllers/Packing.php 69
ERROR - 2024-09-03 16:56:16 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-03 16:56:16 --> 404 Page Not Found: /index
ERROR - 2024-09-03 17:18:32 --> Severity: Warning --> implode(): Invalid arguments passed /home/ssc/hirobolt/application/modules/incoming_stok/controllers/Incoming_stok.php 499
ERROR - 2024-09-03 17:18:52 --> Severity: Warning --> implode(): Invalid arguments passed /home/ssc/hirobolt/application/modules/incoming_stok/controllers/Incoming_stok.php 499
ERROR - 2024-09-03 17:37:34 --> Query error: Unknown column 'a.code' in 'order clause' - Invalid query: SELECT a.*, b.name AS nama_pengiriman FROM sales_marketplace_header a LEFT JOIN master_pengiriman b ON b.id = a.delivery_service_id WHERE a.status IN(3,4,5) ORDER BY a.code DESC
