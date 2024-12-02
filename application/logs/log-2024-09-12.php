<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-09-12 08:23:46 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-12 08:23:47 --> 404 Page Not Found: /index
ERROR - 2024-09-12 08:36:37 --> Query error: Unknown column 'a.id_material' in 'field list' - Invalid query: SELECT `a`.`id_material`, `a`.`qty_stock`, `a`.`qty_booking`, `b`.`konversi`
FROM `warehouse_adjustment` `a`
JOIN `accessories` `b` ON `a`.`id_material`=`b`.`id`
WHERE `a`.`id_gudang_ke` = '2'
ERROR - 2024-09-12 09:00:53 --> Query error: Unknown column 'a.id_material' in 'field list' - Invalid query: SELECT `a`.`id_material`, `a`.`qty_stock`, `a`.`qty_booking`, `b`.`konversi`
FROM `warehouse_adjustment` `a`
JOIN `accessories` `b` ON `a`.`id_material`=`b`.`id`
WHERE `a`.`id_gudang_ke` = '2'
ERROR - 2024-09-12 09:38:41 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-12 09:38:43 --> 404 Page Not Found: /index
ERROR - 2024-09-12 09:42:22 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-12 09:44:43 --> Query error: Unknown column 'a.id_material' in 'field list' - Invalid query: SELECT `a`.`id_material`, `a`.`qty_stock`, `a`.`qty_booking`, `b`.`konversi`
FROM `warehouse_adjustment` `a`
JOIN `accessories` `b` ON `a`.`id_material`=`b`.`id`
WHERE `a`.`id_gudang_ke` = '2'
ERROR - 2024-09-12 09:51:05 --> Query error: Unknown column 'a.id_material' in 'field list' - Invalid query: SELECT `a`.`id_material`, `a`.`qty_stock`, `a`.`qty_booking`, `b`.`konversi`
FROM `warehouse_adjustment` `a`
JOIN `accessories` `b` ON `a`.`id_material`=`b`.`id`
WHERE `a`.`id_gudang_ke` = '2'
ERROR - 2024-09-12 09:51:53 --> Severity: Notice --> Undefined index: date_filter /home/ssc/hirobolt/application/modules/stok_gudang_barang/models/Stok_gudang_barang_model.php 14
ERROR - 2024-09-12 09:51:53 --> Severity: Notice --> Undefined index: id_category /home/ssc/hirobolt/application/modules/stok_gudang_barang/models/Stok_gudang_barang_model.php 15
ERROR - 2024-09-12 09:51:53 --> Severity: Notice --> Undefined index: id_warehouse /home/ssc/hirobolt/application/modules/stok_gudang_barang/models/Stok_gudang_barang_model.php 16
ERROR - 2024-09-12 09:51:53 --> Severity: Notice --> Undefined index: search /home/ssc/hirobolt/application/modules/stok_gudang_barang/models/Stok_gudang_barang_model.php 17
ERROR - 2024-09-12 09:51:53 --> Severity: Notice --> Undefined index: order /home/ssc/hirobolt/application/modules/stok_gudang_barang/models/Stok_gudang_barang_model.php 18
ERROR - 2024-09-12 09:51:53 --> Severity: Notice --> Undefined index: order /home/ssc/hirobolt/application/modules/stok_gudang_barang/models/Stok_gudang_barang_model.php 19
ERROR - 2024-09-12 09:51:53 --> Severity: Notice --> Undefined index: start /home/ssc/hirobolt/application/modules/stok_gudang_barang/models/Stok_gudang_barang_model.php 20
ERROR - 2024-09-12 09:51:53 --> Severity: Notice --> Undefined index: length /home/ssc/hirobolt/application/modules/stok_gudang_barang/models/Stok_gudang_barang_model.php 21
ERROR - 2024-09-12 09:51:53 --> Severity: Notice --> Undefined index:  /home/ssc/hirobolt/application/modules/stok_gudang_barang/models/Stok_gudang_barang_model.php 153
ERROR - 2024-09-12 09:51:53 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'LIMIT  ,' at line 19 - Invalid query: SELECT
              (@row:=@row+1) AS nomor,
              a.id AS code_lv4,
              a.id_stock AS code,
              a.stock_name AS nama,
              a.id_unit_gudang AS id_unit_packing,
              a.id_unit,
              a.konversi,
			  b.nm_category
            FROM
				accessories a
				LEFT JOIN accessories_category b ON a.id_category=b.id,
              (SELECT @row:=0) r
            WHERE a.deleted_date IS NULL  AND a.id_category=''  AND (
              a.id_stock LIKE '%%'
              OR a.stock_name LIKE '%%'
              OR b.nm_category LIKE '%%'
              )
           ORDER BY    LIMIT  , 
ERROR - 2024-09-12 09:51:53 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/ssc/hirobolt/system/core/Exceptions.php:272) /home/ssc/hirobolt/system/core/Common.php 571
ERROR - 2024-09-12 09:53:49 --> Query error: Unknown column 'a.id_material' in 'field list' - Invalid query: SELECT `a`.`id_material`, `a`.`qty_stock`, `a`.`qty_booking`, `b`.`konversi`
FROM `warehouse_adjustment` `a`
JOIN `accessories` `b` ON `a`.`id_material`=`b`.`id`
WHERE `a`.`id_gudang_ke` = '2'
ERROR - 2024-09-12 10:45:45 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/purchase_order/views/add_purchaseorder.php 27
ERROR - 2024-09-12 11:01:57 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/purchase_order/views/add_purchaseorder.php 27
ERROR - 2024-09-12 11:06:06 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-12 11:06:06 --> 404 Page Not Found: /index
ERROR - 2024-09-12 11:09:48 --> Query error: The used SELECT statements have a different number of columns - Invalid query: 
			SELECT 
				a.id as id,
				a.so_number as so_number,
				a.id_material as id_material,
				a.propose_purchase as propose_purchase,
				(b.qty_stock - b.qty_booking) AS avl_stock, 
				IF(c.code = '' OR c.code IS NULL, d.id_stock, c.code) as code, 
				'' as code1, 
				IF(c.nama = '' OR c.nama IS NULL, d.stock_name, c.nama) as nm_material,
				'' as tipe_pr,
				e.code as packing_unit,	
				f.code as packing_unit2,
				d.konversi as konversi,
				IF(g.code IS NOT NULL, g.code, h.code) as unit_measure
			FROM
				material_planning_base_on_produksi_detail a
				LEFT JOIN warehouse_stock b ON b.id_material = a.id_material
				LEFT JOIN new_inventory_4 c ON c.code_lv4 = a.id_material 
				LEFT JOIN accessories d ON d.id = a.id_material
				LEFT JOIN ms_satuan e ON e.id = c.id_unit_packing
				LEFT JOIN ms_satuan f ON f.id = d.id_unit_gudang
				LEFT JOIN ms_satuan g ON g.id = c.id_unit
				LEFT JOIN ms_satuan h ON h.id = d.id_unit
			WHERE
				a.so_number IN ('P240900001')
				AND a.status_app = 'Y'
			GROUP BY a.id_material

			UNION ALL

			SELECT
				a.id as id,
				a.no_pengajuan as so_number,
				'' as id_material,
				a.qty as propose_purchase,
				'0' as avl_stock,
				a.nm_barang as code,
				'' as code1,
				a.nm_barang as nm_material,
				'pr depart' as tipe_pr,
				b.code as packing_unit,
				'' as packing_unit2,
				b.code as unit_measure
			FROM
				non_rutin_planning_detail a 
				LEFT JOIN ms_satuan b ON b.id = a.satuan
			WHERE
				a.no_pengajuan IN ('P240900001')
			GROUP BY a.id
		
ERROR - 2024-09-12 11:11:00 --> Query error: The used SELECT statements have a different number of columns - Invalid query: 
			SELECT 
				a.id as id,
				a.so_number as so_number,
				a.id_material as id_material,
				a.propose_purchase as propose_purchase,
				d.konversi as konversi,
				(b.qty_stock - b.qty_booking) AS avl_stock, 
				IF(c.code = '' OR c.code IS NULL, d.id_stock, c.code) as code, 
				'' as code1, 
				IF(c.nama = '' OR c.nama IS NULL, d.stock_name, c.nama) as nm_material,
				'' as tipe_pr,
				e.code as packing_unit,	
				f.code as packing_unit2,
				IF(g.code IS NOT NULL, g.code, h.code) as unit_measure
			FROM
				material_planning_base_on_produksi_detail a
				LEFT JOIN warehouse_stock b ON b.id_material = a.id_material
				LEFT JOIN new_inventory_4 c ON c.code_lv4 = a.id_material 
				LEFT JOIN accessories d ON d.id = a.id_material
				LEFT JOIN ms_satuan e ON e.id = c.id_unit_packing
				LEFT JOIN ms_satuan f ON f.id = d.id_unit_gudang
				LEFT JOIN ms_satuan g ON g.id = c.id_unit
				LEFT JOIN ms_satuan h ON h.id = d.id_unit
			WHERE
				a.so_number IN ('P240900001')
				AND a.status_app = 'Y'
			GROUP BY a.id_material

			UNION ALL

			SELECT
				a.id as id,
				a.no_pengajuan as so_number,
				'' as id_material,
				a.qty as propose_purchase,
				'0' as avl_stock,
				a.nm_barang as code,
				'' as code1,
				a.nm_barang as nm_material,
				'pr depart' as tipe_pr,
				b.code as packing_unit,
				'' as packing_unit2,
				b.code as unit_measure
			FROM
				non_rutin_planning_detail a 
				LEFT JOIN ms_satuan b ON b.id = a.satuan
			WHERE
				a.no_pengajuan IN ('P240900001')
			GROUP BY a.id
		
ERROR - 2024-09-12 11:14:29 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/purchase_order/views/add_purchaseorder.php 27
ERROR - 2024-09-12 11:15:51 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/purchase_order/views/add_purchaseorder.php 27
ERROR - 2024-09-12 13:24:29 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-12 13:24:29 --> 404 Page Not Found: /index
ERROR - 2024-09-12 13:43:22 --> Severity: Notice --> Undefined index: param /home/ssc/hirobolt/application/modules/approval_po/views/approval_po.php 10
ERROR - 2024-09-12 13:43:22 --> Severity: Warning --> implode(): Invalid arguments passed /home/ssc/hirobolt/application/modules/approval_po/views/approval_po.php 10
ERROR - 2024-09-12 13:43:22 --> Severity: Notice --> Undefined index: supplier /home/ssc/hirobolt/application/modules/approval_po/views/approval_po.php 27
ERROR - 2024-09-12 13:43:22 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/approval_po/views/approval_po.php 27
ERROR - 2024-09-12 13:43:41 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/purchase_order/views/view.php 27
ERROR - 2024-09-12 13:46:50 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-12 13:46:51 --> 404 Page Not Found: /index
ERROR - 2024-09-12 14:02:07 --> Severity: Warning --> implode(): Invalid arguments passed /home/ssc/hirobolt/application/modules/incoming_stok/controllers/Incoming_stok.php 547
ERROR - 2024-09-12 14:45:40 --> Severity: Warning --> Missing argument 1 for Penawaran::PrintPenawaran() /home/ssc/hirobolt/application/modules/penawaran/controllers/Penawaran.php 424
ERROR - 2024-09-12 14:46:09 --> Severity: Warning --> Missing argument 1 for Penawaran::PrintPenawaran() /home/ssc/hirobolt/application/modules/penawaran/controllers/Penawaran.php 424
ERROR - 2024-09-12 14:47:18 --> Severity: Warning --> Missing argument 1 for Penawaran::PrintPenawaran() /home/ssc/hirobolt/application/modules/penawaran/controllers/Penawaran.php 424
ERROR - 2024-09-12 14:49:08 --> Severity: Warning --> Missing argument 1 for Penawaran::PrintPenawaran() /home/ssc/hirobolt/application/modules/penawaran/controllers/Penawaran.php 424
ERROR - 2024-09-12 15:44:32 --> 404 Page Not Found: /index
ERROR - 2024-09-12 16:02:47 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-12 16:02:47 --> 404 Page Not Found: /index
ERROR - 2024-09-12 16:04:02 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-12 16:04:02 --> 404 Page Not Found: /index
ERROR - 2024-09-12 16:05:19 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/users/views/users_form.php 68
ERROR - 2024-09-12 16:05:19 --> Severity: Notice --> Undefined variable: data /home/ssc/hirobolt/application/modules/users/views/users_form.php 87
ERROR - 2024-09-12 16:05:19 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/users/views/users_form.php 87
ERROR - 2024-09-12 16:05:19 --> Severity: Notice --> Undefined variable: data /home/ssc/hirobolt/application/modules/users/views/users_form.php 87
ERROR - 2024-09-12 16:05:19 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/users/views/users_form.php 87
ERROR - 2024-09-12 16:05:19 --> Severity: Notice --> Undefined variable: data /home/ssc/hirobolt/application/modules/users/views/users_form.php 87
ERROR - 2024-09-12 16:05:19 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/users/views/users_form.php 87
ERROR - 2024-09-12 16:05:32 --> Severity: Notice --> Undefined variable: cabang /home/ssc/hirobolt/application/modules/users/views/users_form.php 68
ERROR - 2024-09-12 16:05:32 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/users/views/users_form.php 68
ERROR - 2024-09-12 16:05:32 --> Severity: Notice --> Undefined variable: departments /home/ssc/hirobolt/application/modules/users/views/users_form.php 85
ERROR - 2024-09-12 16:05:32 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/users/views/users_form.php 85
ERROR - 2024-09-12 16:06:25 --> Severity: Notice --> Undefined variable: cabang /home/ssc/hirobolt/application/modules/users/views/users_form.php 68
ERROR - 2024-09-12 16:06:25 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/users/views/users_form.php 68
ERROR - 2024-09-12 16:06:25 --> Severity: Notice --> Undefined variable: departments /home/ssc/hirobolt/application/modules/users/views/users_form.php 85
ERROR - 2024-09-12 16:06:25 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/users/views/users_form.php 85
ERROR - 2024-09-12 16:07:02 --> Severity: Notice --> Undefined variable: cabang /home/ssc/hirobolt/application/modules/users/views/users_form.php 68
ERROR - 2024-09-12 16:07:02 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/users/views/users_form.php 68
ERROR - 2024-09-12 16:07:02 --> Severity: Notice --> Undefined variable: departments /home/ssc/hirobolt/application/modules/users/views/users_form.php 85
ERROR - 2024-09-12 16:07:02 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/users/views/users_form.php 85
ERROR - 2024-09-12 16:19:15 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-12 16:19:15 --> 404 Page Not Found: /index
ERROR - 2024-09-12 16:42:15 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-12 16:42:15 --> 404 Page Not Found: /index
ERROR - 2024-09-12 16:42:22 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-12 16:42:22 --> 404 Page Not Found: /index
ERROR - 2024-09-12 16:42:28 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-12 16:42:28 --> 404 Page Not Found: /index
ERROR - 2024-09-12 16:42:33 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-12 16:42:33 --> 404 Page Not Found: /index
ERROR - 2024-09-12 16:42:39 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-12 16:42:39 --> 404 Page Not Found: /index
ERROR - 2024-09-12 16:42:57 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-12 16:42:58 --> 404 Page Not Found: /index
ERROR - 2024-09-12 16:43:06 --> Severity: Notice --> Undefined variable: cabang /home/ssc/hirobolt/application/modules/users/views/users_form.php 68
ERROR - 2024-09-12 16:43:06 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/users/views/users_form.php 68
ERROR - 2024-09-12 16:43:06 --> Severity: Notice --> Undefined variable: departments /home/ssc/hirobolt/application/modules/users/views/users_form.php 85
ERROR - 2024-09-12 16:43:06 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/users/views/users_form.php 85
ERROR - 2024-09-12 16:43:31 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-12 16:43:31 --> 404 Page Not Found: /index
ERROR - 2024-09-12 16:50:16 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-12 16:50:17 --> 404 Page Not Found: /index
ERROR - 2024-09-12 16:50:39 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/users/views/users_form.php 68
ERROR - 2024-09-12 16:50:39 --> Severity: Notice --> Undefined variable: data /home/ssc/hirobolt/application/modules/users/views/users_form.php 87
ERROR - 2024-09-12 16:50:39 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/users/views/users_form.php 87
ERROR - 2024-09-12 16:50:39 --> Severity: Notice --> Undefined variable: data /home/ssc/hirobolt/application/modules/users/views/users_form.php 87
ERROR - 2024-09-12 16:50:39 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/users/views/users_form.php 87
ERROR - 2024-09-12 16:50:39 --> Severity: Notice --> Undefined variable: data /home/ssc/hirobolt/application/modules/users/views/users_form.php 87
ERROR - 2024-09-12 16:50:39 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/users/views/users_form.php 87
ERROR - 2024-09-12 16:50:58 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-12 16:50:58 --> 404 Page Not Found: /index
ERROR - 2024-09-12 16:51:13 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-12 16:51:31 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/users/views/users_form.php 68
ERROR - 2024-09-12 16:51:31 --> Severity: Notice --> Undefined variable: data /home/ssc/hirobolt/application/modules/users/views/users_form.php 87
ERROR - 2024-09-12 16:51:31 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/users/views/users_form.php 87
ERROR - 2024-09-12 16:51:31 --> Severity: Notice --> Undefined variable: data /home/ssc/hirobolt/application/modules/users/views/users_form.php 87
ERROR - 2024-09-12 16:51:31 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/users/views/users_form.php 87
ERROR - 2024-09-12 16:51:31 --> Severity: Notice --> Undefined variable: data /home/ssc/hirobolt/application/modules/users/views/users_form.php 87
ERROR - 2024-09-12 16:51:31 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/users/views/users_form.php 87
ERROR - 2024-09-12 16:52:04 --> Severity: Notice --> Undefined variable: cabang /home/ssc/hirobolt/application/modules/users/views/users_form.php 68
ERROR - 2024-09-12 16:52:04 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/users/views/users_form.php 68
ERROR - 2024-09-12 16:52:04 --> Severity: Notice --> Undefined variable: departments /home/ssc/hirobolt/application/modules/users/views/users_form.php 85
ERROR - 2024-09-12 16:52:04 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/users/views/users_form.php 85
ERROR - 2024-09-12 16:52:38 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-12 16:52:38 --> 404 Page Not Found: /index
ERROR - 2024-09-12 16:53:59 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-12 16:54:00 --> 404 Page Not Found: /index
ERROR - 2024-09-12 16:54:03 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-12 16:54:04 --> 404 Page Not Found: /index
ERROR - 2024-09-12 16:54:12 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-12 16:54:12 --> 404 Page Not Found: /index
ERROR - 2024-09-12 16:54:46 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-12 16:54:46 --> 404 Page Not Found: /index
ERROR - 2024-09-12 16:55:04 --> Severity: Notice --> Undefined variable: cabang /home/ssc/hirobolt/application/modules/users/views/users_form.php 68
ERROR - 2024-09-12 16:55:04 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/users/views/users_form.php 68
ERROR - 2024-09-12 16:55:04 --> Severity: Notice --> Undefined variable: departments /home/ssc/hirobolt/application/modules/users/views/users_form.php 85
ERROR - 2024-09-12 16:55:04 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/users/views/users_form.php 85
ERROR - 2024-09-12 16:55:21 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-12 16:55:21 --> 404 Page Not Found: /index
ERROR - 2024-09-12 16:55:46 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-12 16:55:47 --> 404 Page Not Found: /index
ERROR - 2024-09-12 16:59:21 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-12 16:59:21 --> 404 Page Not Found: /index
ERROR - 2024-09-12 16:59:38 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-12 16:59:38 --> 404 Page Not Found: /index
ERROR - 2024-09-12 17:01:57 --> Severity: Notice --> Undefined variable: cabang /home/ssc/hirobolt/application/modules/users/views/users_form.php 68
ERROR - 2024-09-12 17:01:57 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/users/views/users_form.php 68
ERROR - 2024-09-12 17:01:57 --> Severity: Notice --> Undefined variable: departments /home/ssc/hirobolt/application/modules/users/views/users_form.php 85
ERROR - 2024-09-12 17:01:57 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/users/views/users_form.php 85
ERROR - 2024-09-12 17:02:03 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-12 17:02:03 --> 404 Page Not Found: /index
ERROR - 2024-09-12 17:02:20 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-12 17:02:20 --> 404 Page Not Found: /index
ERROR - 2024-09-12 17:28:11 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-12 17:28:11 --> 404 Page Not Found: /index
ERROR - 2024-09-12 17:31:16 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-12 17:31:16 --> 404 Page Not Found: /index
ERROR - 2024-09-12 19:48:23 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-12 19:48:25 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-12 19:48:26 --> 404 Page Not Found: /index
