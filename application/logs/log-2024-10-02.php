<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-10-02 08:03:11 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-10-02 08:03:33 --> 404 Page Not Found: /index
ERROR - 2024-10-02 08:19:19 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/penawaran/controllers/Penawaran.php 196
ERROR - 2024-10-02 08:30:05 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-10-02 08:30:06 --> 404 Page Not Found: /index
ERROR - 2024-10-02 08:43:44 --> Severity: Error --> Call to a member function get_data() on null /home/ssc/hirobolt/application/modules/penawaran/views/revisipenawaran.php 171
ERROR - 2024-10-02 08:55:26 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-10-02 08:55:26 --> 404 Page Not Found: /index
ERROR - 2024-10-02 09:00:05 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-10-02 09:00:06 --> 404 Page Not Found: /index
ERROR - 2024-10-02 09:03:35 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-10-02 09:03:35 --> 404 Page Not Found: /index
ERROR - 2024-10-02 09:07:38 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-10-02 09:07:39 --> 404 Page Not Found: /index
ERROR - 2024-10-02 09:43:37 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-10-02 09:43:38 --> 404 Page Not Found: /index
ERROR - 2024-10-02 10:10:53 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/purchase_order/views/view.php 27
ERROR - 2024-10-02 10:14:05 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/purchase_order/views/view.php 27
ERROR - 2024-10-02 10:19:18 --> Severity: Warning --> implode(): Invalid arguments passed /home/ssc/hirobolt/application/modules/incoming_stok/controllers/Incoming_stok.php 405
ERROR - 2024-10-02 10:19:41 --> Severity: Warning --> implode(): Invalid arguments passed /home/ssc/hirobolt/application/modules/incoming_stok/controllers/Incoming_stok.php 405
ERROR - 2024-10-02 10:35:33 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'asc  LIMIT 0 ,10' at line 24 - Invalid query: 
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
  			WHERE 1=1
  				AND (
  				a.code_order LIKE '%%'
  				OR a.code_order_marketplace LIKE '%%'
                OR a.customer_name LIKE '%%'
                OR c.nama_marketplace LIKE '%%'
				OR d.name LIKE '%%'
  	        )
  		 ORDER BY a.id DESC,  asc  LIMIT 0 ,10 
ERROR - 2024-10-02 10:47:40 --> Query error: Unknown column 'a.kd_gudang_dari' in 'where clause' - Invalid query: SELECT SUM(a.jumlah_mat) AS jumlah_material, `id_material`
FROM `warehouse_history` `a`
WHERE `a`.`id_gudang` = '2'
AND DATE(a.update_date) >= '2024-10-02'
AND DATE(a.update_date) <= '2024-10-02'
AND `a`.`kd_gudang_dari` <> 'BOOKING'
AND   (
`a`.`ket` LIKE '%penambahan%' ESCAPE '!'
OR  `a`.`ket` LIKE '%incoming%' ESCAPE '!'
 )
GROUP BY `a`.`id_material`
ERROR - 2024-10-02 10:47:45 --> Query error: Unknown column 'a.kd_gudang_dari' in 'where clause' - Invalid query: SELECT SUM(a.jumlah_mat) AS jumlah_material, `id_material`
FROM `warehouse_history` `a`
WHERE `a`.`id_gudang` = '1'
AND DATE(a.update_date) >= '2024-10-02'
AND DATE(a.update_date) <= '2024-10-02'
AND `a`.`kd_gudang_dari` <> 'BOOKING'
AND   (
`a`.`ket` LIKE '%penambahan%' ESCAPE '!'
OR  `a`.`ket` LIKE '%incoming%' ESCAPE '!'
 )
GROUP BY `a`.`id_material`
ERROR - 2024-10-02 10:47:53 --> Query error: Unknown column 'a.kd_gudang_dari' in 'where clause' - Invalid query: SELECT SUM(a.jumlah_mat) AS jumlah_material, `id_material`
FROM `warehouse_history` `a`
WHERE `a`.`id_gudang` = '2'
AND DATE(a.update_date) >= '2024-10-02'
AND DATE(a.update_date) <= '2024-10-02'
AND `a`.`kd_gudang_dari` <> 'BOOKING'
AND   (
`a`.`ket` LIKE '%penambahan%' ESCAPE '!'
OR  `a`.`ket` LIKE '%incoming%' ESCAPE '!'
 )
GROUP BY `a`.`id_material`
ERROR - 2024-10-02 10:48:12 --> Query error: Unknown column 'a.kd_gudang_dari' in 'where clause' - Invalid query: SELECT SUM(a.jumlah_mat) AS jumlah_material, `id_material`
FROM `warehouse_history` `a`
WHERE `a`.`id_gudang` = '2'
AND DATE(a.update_date) >= '2024-08-01'
AND DATE(a.update_date) <= '2024-10-31'
AND `a`.`kd_gudang_dari` <> 'BOOKING'
AND   (
`a`.`ket` LIKE '%penambahan%' ESCAPE '!'
OR  `a`.`ket` LIKE '%incoming%' ESCAPE '!'
 )
GROUP BY `a`.`id_material`
ERROR - 2024-10-02 10:48:35 --> Query error: Unknown column 'a.kd_gudang_dari' in 'where clause' - Invalid query: SELECT SUM(a.jumlah_mat) AS jumlah_material, `id_material`
FROM `warehouse_history` `a`
WHERE `a`.`id_gudang` = '2'
AND DATE(a.update_date) >= '2024-08-01'
AND DATE(a.update_date) <= '2024-10-31'
AND `a`.`kd_gudang_dari` <> 'BOOKING'
AND   (
`a`.`ket` LIKE '%penambahan%' ESCAPE '!'
OR  `a`.`ket` LIKE '%incoming%' ESCAPE '!'
 )
GROUP BY `a`.`id_material`
ERROR - 2024-10-02 10:50:03 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-10-02 10:52:49 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-10-02 10:52:51 --> 404 Page Not Found: /index
ERROR - 2024-10-02 10:53:02 --> Severity: Warning --> Missing argument 3 for Stok_gudang_barang::download_excel() /home/ssc/hirobolt/application/modules/stok_gudang_barang/controllers/Stok_gudang_barang.php 64
ERROR - 2024-10-02 10:53:02 --> Severity: Notice --> Undefined variable: date_filter /home/ssc/hirobolt/application/modules/stok_gudang_barang/controllers/Stok_gudang_barang.php 90
ERROR - 2024-10-02 11:02:06 --> Query error: Table 'hirobolt.ms_karyawan' doesn't exist - Invalid query: SELECT *
FROM `ms_karyawan`
WHERE `deleted` = '0'
ERROR - 2024-10-02 11:04:22 --> Severity: Error --> Call to a member function get_data() on null /home/ssc/hirobolt/application/modules/penawaran/views/revisipenawaran.php 171
ERROR - 2024-10-02 11:04:30 --> Severity: Error --> Call to a member function get_data() on null /home/ssc/hirobolt/application/modules/penawaran/views/revisipenawaran.php 171
ERROR - 2024-10-02 11:10:02 --> Severity: Notice --> Undefined index: project /home/ssc/hirobolt/application/modules/spk_delivery/views/add.php 26
ERROR - 2024-10-02 11:10:42 --> Severity: Notice --> Undefined index: project /home/ssc/hirobolt/application/modules/spk_delivery_sj/views/add.php 30
ERROR - 2024-10-02 11:11:50 --> Severity: Notice --> Undefined index: project /home/ssc/hirobolt/application/modules/spk_delivery_sj/views/add.php 30
ERROR - 2024-10-02 11:13:26 --> Severity: Notice --> Undefined index: project /home/ssc/hirobolt/application/modules/spk_delivery_sj/views/add.php 30
ERROR - 2024-10-02 11:13:42 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-10-02 11:13:46 --> 404 Page Not Found: /index
ERROR - 2024-10-02 11:15:44 --> Severity: Notice --> Undefined index: project /home/ssc/hirobolt/application/modules/spk_delivery_sj/views/add.php 30
ERROR - 2024-10-02 11:17:27 --> Severity: Notice --> Undefined index: project /home/ssc/hirobolt/application/modules/spk_delivery_sj/views/add.php 30
ERROR - 2024-10-02 11:19:36 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-10-02 11:19:36 --> 404 Page Not Found: /index
ERROR - 2024-10-02 11:19:41 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-10-02 11:19:41 --> 404 Page Not Found: /index
ERROR - 2024-10-02 11:19:45 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-10-02 11:19:45 --> 404 Page Not Found: /index
ERROR - 2024-10-02 12:02:41 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-10-02 12:02:42 --> 404 Page Not Found: /index
ERROR - 2024-10-02 12:02:54 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-10-02 12:02:54 --> 404 Page Not Found: /index
ERROR - 2024-10-02 12:03:09 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-10-02 12:03:09 --> 404 Page Not Found: /index
ERROR - 2024-10-02 13:17:02 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-10-02 13:17:02 --> 404 Page Not Found: /index
ERROR - 2024-10-02 14:01:41 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-10-02 14:01:41 --> 404 Page Not Found: /index
ERROR - 2024-10-02 14:10:54 --> Severity: Error --> Call to a member function get_data() on null /home/ssc/hirobolt/application/modules/penawaran/views/revisipenawaran.php 171
ERROR - 2024-10-02 16:21:16 --> Severity: Notice --> Undefined variable: getDataDetail /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 50
ERROR - 2024-10-02 16:21:16 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 50
ERROR - 2024-10-02 16:22:19 --> Severity: Notice --> Undefined variable: getDataDetail /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 52
ERROR - 2024-10-02 16:22:19 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 52
ERROR - 2024-10-02 16:22:52 --> Severity: Notice --> Undefined variable: getDataDetail /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 52
ERROR - 2024-10-02 16:22:52 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 52
ERROR - 2024-10-02 16:23:06 --> Severity: Notice --> Undefined variable: getDataDetail /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 52
ERROR - 2024-10-02 16:23:06 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 52
ERROR - 2024-10-02 16:23:31 --> Severity: Notice --> Undefined variable: getDataDetail /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 52
ERROR - 2024-10-02 16:23:31 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 52
ERROR - 2024-10-02 16:23:50 --> Severity: Notice --> Undefined variable: getDataDetail /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 52
ERROR - 2024-10-02 16:23:50 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 52
ERROR - 2024-10-02 16:23:59 --> Severity: Notice --> Undefined variable: getDataDetail /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 52
ERROR - 2024-10-02 16:23:59 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 52
ERROR - 2024-10-02 16:24:51 --> Severity: Notice --> Undefined variable: getDataDetail /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 52
ERROR - 2024-10-02 16:24:51 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 52
ERROR - 2024-10-02 16:25:52 --> Severity: Notice --> Undefined variable: getDataDetail /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 52
ERROR - 2024-10-02 16:25:52 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 52
ERROR - 2024-10-02 16:26:07 --> Severity: Notice --> Undefined variable: getDataDetail /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 52
ERROR - 2024-10-02 16:26:07 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 52
ERROR - 2024-10-02 16:26:24 --> Severity: Notice --> Undefined variable: getDataDetail /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 52
ERROR - 2024-10-02 16:26:24 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 52
ERROR - 2024-10-02 16:26:41 --> Severity: Notice --> Undefined variable: getDataDetail /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 52
ERROR - 2024-10-02 16:26:41 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 52
ERROR - 2024-10-02 16:27:10 --> Severity: Notice --> Undefined variable: getDataDetail /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 52
ERROR - 2024-10-02 16:27:10 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 52
ERROR - 2024-10-02 16:27:19 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-10-02 16:27:19 --> 404 Page Not Found: /index
ERROR - 2024-10-02 16:27:22 --> Severity: Notice --> Undefined variable: getDataDetail /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 52
ERROR - 2024-10-02 16:27:22 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 52
ERROR - 2024-10-02 16:28:03 --> Severity: Notice --> Undefined variable: getDataDetail /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 52
ERROR - 2024-10-02 16:28:03 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 52
ERROR - 2024-10-02 16:28:25 --> Severity: Notice --> Undefined variable: getDataDetail /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 52
ERROR - 2024-10-02 16:28:25 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 52
ERROR - 2024-10-02 16:28:37 --> Severity: Notice --> Undefined variable: getDataDetail /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 52
ERROR - 2024-10-02 16:28:37 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 52
ERROR - 2024-10-02 16:30:49 --> Severity: Notice --> Undefined variable: getDataDetail /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 57
ERROR - 2024-10-02 16:30:49 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 57
ERROR - 2024-10-02 16:31:07 --> Severity: Notice --> Undefined variable: getDataDetail /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 57
ERROR - 2024-10-02 16:31:07 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 57
ERROR - 2024-10-02 16:33:46 --> Severity: Notice --> Undefined variable: getDataDetail /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 63
ERROR - 2024-10-02 16:33:46 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 63
ERROR - 2024-10-02 16:34:00 --> Severity: Notice --> Undefined variable: getDataDetail /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 63
ERROR - 2024-10-02 16:34:00 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 63
ERROR - 2024-10-02 16:34:39 --> Severity: Notice --> Undefined variable: getDataDetail /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 63
ERROR - 2024-10-02 16:34:39 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 63
ERROR - 2024-10-02 16:35:32 --> Severity: Notice --> Undefined variable: getDataDetail /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 69
ERROR - 2024-10-02 16:35:32 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 69
ERROR - 2024-10-02 16:35:49 --> Severity: Notice --> Undefined variable: getDataDetail /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 69
ERROR - 2024-10-02 16:35:49 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 69
ERROR - 2024-10-02 16:36:16 --> Severity: Notice --> Undefined variable: getDataDetail /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 69
ERROR - 2024-10-02 16:36:16 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 69
ERROR - 2024-10-02 16:36:28 --> Severity: Notice --> Undefined variable: getDataDetail /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 69
ERROR - 2024-10-02 16:36:28 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 69
ERROR - 2024-10-02 16:42:21 --> Severity: Notice --> Undefined variable: getDataDetail /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 77
ERROR - 2024-10-02 16:42:21 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 77
ERROR - 2024-10-02 16:42:36 --> Severity: Notice --> Undefined variable: getDataDetail /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 78
ERROR - 2024-10-02 16:42:36 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 78
ERROR - 2024-10-02 16:43:05 --> Severity: Notice --> Undefined variable: getDataDetail /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 83
ERROR - 2024-10-02 16:43:05 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 83
ERROR - 2024-10-02 16:43:52 --> Severity: Notice --> Undefined variable: getDataDetail /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 77
ERROR - 2024-10-02 16:43:52 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 77
ERROR - 2024-10-02 16:44:12 --> Severity: Notice --> Undefined variable: getDataDetail /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 76
ERROR - 2024-10-02 16:44:12 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 76
ERROR - 2024-10-02 16:44:26 --> Severity: Notice --> Undefined variable: getDataDetail /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 75
ERROR - 2024-10-02 16:44:26 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 75
ERROR - 2024-10-02 16:44:38 --> Severity: Notice --> Undefined variable: getDataDetail /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 75
ERROR - 2024-10-02 16:44:38 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 75
ERROR - 2024-10-02 16:44:44 --> Severity: Notice --> Undefined variable: getDataDetail /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 75
ERROR - 2024-10-02 16:44:44 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 75
ERROR - 2024-10-02 16:44:51 --> Severity: Notice --> Undefined variable: getDataDetail /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 75
ERROR - 2024-10-02 16:44:51 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 75
ERROR - 2024-10-02 16:46:31 --> Severity: Notice --> Undefined variable: getDataDetail /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 76
ERROR - 2024-10-02 16:46:31 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 76
ERROR - 2024-10-02 16:47:54 --> Severity: Notice --> Undefined variable: getDataDetail /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 83
ERROR - 2024-10-02 16:47:54 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 83
ERROR - 2024-10-02 16:48:15 --> Severity: Notice --> Undefined variable: getDataDetail /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 81
ERROR - 2024-10-02 16:48:15 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 81
ERROR - 2024-10-02 16:48:37 --> Severity: Notice --> Undefined variable: getDataDetail /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 81
ERROR - 2024-10-02 16:48:37 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 81
ERROR - 2024-10-02 16:50:02 --> Severity: Notice --> Undefined variable: getDataDetail /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 87
ERROR - 2024-10-02 16:50:02 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 87
ERROR - 2024-10-02 16:50:46 --> Severity: Notice --> Undefined variable: getDataDetail /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 88
ERROR - 2024-10-02 16:50:46 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 88
ERROR - 2024-10-02 16:51:04 --> Severity: Notice --> Undefined variable: getDataDetail /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 88
ERROR - 2024-10-02 16:51:04 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 88
ERROR - 2024-10-02 16:51:40 --> Severity: Notice --> Undefined variable: getDataDetail /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 88
ERROR - 2024-10-02 16:51:40 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 88
ERROR - 2024-10-02 16:52:21 --> Severity: Notice --> Undefined variable: getDataDetail /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 88
ERROR - 2024-10-02 16:52:21 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/spk_delivery/views/print_spk.php 88
ERROR - 2024-10-02 20:12:23 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-10-02 20:12:24 --> 404 Page Not Found: /index
ERROR - 2024-10-02 20:12:35 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-10-02 20:12:37 --> 404 Page Not Found: /index
