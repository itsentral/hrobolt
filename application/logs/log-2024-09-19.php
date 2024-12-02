<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-09-19 08:29:15 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-19 08:29:16 --> 404 Page Not Found: /index
ERROR - 2024-09-19 09:28:37 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-19 09:28:37 --> 404 Page Not Found: /index
ERROR - 2024-09-19 09:33:23 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-19 09:33:25 --> 404 Page Not Found: /index
ERROR - 2024-09-19 09:36:29 --> Query error: Unknown column 'b.another_price' in 'field list' - Invalid query: 
  			SELECT
  				a.*,
				b.id AS id_sales_order_detail,
				b.qty AS qty_pcs,
				b.total_price AS total_price_pcs,
				b.another_price AS another_price,
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
  		
ERROR - 2024-09-19 09:50:02 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-19 09:50:03 --> 404 Page Not Found: /index
ERROR - 2024-09-19 11:22:52 --> Severity: Warning --> Missing argument 3 for Stok_gudang_barang::download_excel() /home/ssc/hirobolt/application/modules/stok_gudang_barang/controllers/Stok_gudang_barang.php 64
ERROR - 2024-09-19 11:22:52 --> Severity: Notice --> Undefined variable: date_filter /home/ssc/hirobolt/application/modules/stok_gudang_barang/controllers/Stok_gudang_barang.php 90
ERROR - 2024-09-19 13:41:12 --> Severity: Notice --> Undefined index: kd_gudang_dari /home/ssc/hirobolt/application/modules/stok_gudang_barang/views/modal_history.php 25
ERROR - 2024-09-19 13:41:12 --> Severity: Notice --> Undefined index: kd_gudang_ke /home/ssc/hirobolt/application/modules/stok_gudang_barang/views/modal_history.php 26
ERROR - 2024-09-19 13:50:01 --> Severity: Notice --> Undefined variable: datgroupmenu /home/ssc/hirobolt/application/modules/menus/views/menus_form.php 70
ERROR - 2024-09-19 13:51:06 --> Severity: Notice --> Undefined variable: datgroupmenu /home/ssc/hirobolt/application/modules/menus/views/menus_form.php 70
ERROR - 2024-09-19 13:51:23 --> Severity: Notice --> Undefined variable: datgroupmenu /home/ssc/hirobolt/application/modules/menus/views/menus_form.php 70
ERROR - 2024-09-19 13:51:55 --> Severity: Notice --> Undefined variable: datgroupmenu /home/ssc/hirobolt/application/modules/menus/views/menus_form.php 70
ERROR - 2024-09-19 13:52:30 --> Severity: Notice --> Undefined variable: datgroupmenu /home/ssc/hirobolt/application/modules/menus/views/menus_form.php 70
ERROR - 2024-09-19 13:52:39 --> Query error: Unknown column 'approve' in 'where clause' - Invalid query: SELECT *
FROM `tr_sales_order`
WHERE `approve` = 1
ERROR - 2024-09-19 13:53:29 --> Severity: Notice --> Undefined variable: datgroupmenu /home/ssc/hirobolt/application/modules/menus/views/menus_form.php 70
ERROR - 2024-09-19 13:53:37 --> Severity: Notice --> Undefined variable: datgroupmenu /home/ssc/hirobolt/application/modules/menus/views/menus_form.php 70
ERROR - 2024-09-19 13:53:54 --> Severity: Notice --> Undefined variable: datgroupmenu /home/ssc/hirobolt/application/modules/menus/views/menus_form.php 70
ERROR - 2024-09-19 13:55:42 --> Severity: Warning --> Missing argument 3 for Stok_gudang_barang::download_excel() /home/ssc/hirobolt/application/modules/stok_gudang_barang/controllers/Stok_gudang_barang.php 64
ERROR - 2024-09-19 13:55:42 --> Severity: Notice --> Undefined variable: date_filter /home/ssc/hirobolt/application/modules/stok_gudang_barang/controllers/Stok_gudang_barang.php 90
ERROR - 2024-09-19 13:58:46 --> Query error: Table 'hirobolt.customer' doesn't exist - Invalid query: SELECT
              (@row:=@row+1) AS nomor,
              a.no_so,
              a.no_penawaran,
              c.nm_customer,
              a.project,
              SUM(y.qty_delivery) AS total_delivery,
              a.created_by,
              a.created_on AS created_date
            FROM
              tr_sales_order a
              LEFT JOIN spk_delivery_detail y ON a.no_so = y.no_so
              LEFT JOIN spk_delivery z ON y.no_delivery = z.no_delivery
              LEFT JOIN tr_penawaran b ON a.no_penawaran = b.no_penawaran
              LEFT JOIN customer c ON b.id_customer = c.id_customer,
              (SELECT @row:=0) r
            WHERE a.approve = '1'  AND z.deleted_date IS NULL AND (
              a.no_so LIKE '%%'
              OR a.no_penawaran LIKE '%%'
              OR c.nm_customer LIKE '%%'
              OR a.project LIKE '%%'
            )
            GROUP BY a.no_so
            
ERROR - 2024-09-19 13:58:59 --> Query error: Table 'hirobolt.customer' doesn't exist - Invalid query: SELECT
              (@row:=@row+1) AS nomor,
              a.no_so,
              a.no_penawaran,
              c.nm_customer,
              a.project,
              SUM(y.qty_delivery) AS total_delivery,
              a.created_by,
              a.created_on AS created_date
            FROM
              tr_sales_order a
              LEFT JOIN spk_delivery_detail y ON a.no_so = y.no_so
              LEFT JOIN spk_delivery z ON y.no_delivery = z.no_delivery
              LEFT JOIN tr_penawaran b ON a.no_penawaran = b.no_penawaran
              LEFT JOIN customer c ON b.id_customer = c.id_customer,
              (SELECT @row:=0) r
            WHERE a.approve = '1'  AND z.deleted_date IS NULL AND (
              a.no_so LIKE '%%'
              OR a.no_penawaran LIKE '%%'
              OR c.nm_customer LIKE '%%'
              OR a.project LIKE '%%'
            )
            GROUP BY a.no_so
            
ERROR - 2024-09-19 14:00:14 --> Query error: Unknown column 'a.project' in 'field list' - Invalid query: SELECT
              (@row:=@row+1) AS nomor,
              a.no_so,
              a.no_penawaran,
              c.nm_customer,
              a.project,
              SUM(y.qty_delivery) AS total_delivery,
              a.created_by,
              a.created_on AS created_date
            FROM
              tr_sales_order a
              LEFT JOIN spk_delivery_detail y ON a.no_so = y.no_so
              LEFT JOIN spk_delivery z ON y.no_delivery = z.no_delivery
              LEFT JOIN tr_penawaran b ON a.no_penawaran = b.no_penawaran
              LEFT JOIN master_customers c ON b.id_customer = c.id_customer,
              (SELECT @row:=0) r
            WHERE a.approve = '1'  AND z.deleted_date IS NULL AND (
              a.no_so LIKE '%%'
              OR a.no_penawaran LIKE '%%'
              OR c.nm_customer LIKE '%%'
              OR a.project LIKE '%%'
            )
            GROUP BY a.no_so
            
ERROR - 2024-09-19 14:00:40 --> Query error: Unknown column 'a.project' in 'where clause' - Invalid query: SELECT
              (@row:=@row+1) AS nomor,
              a.no_so,
              a.no_penawaran,
              c.nm_customer,
              SUM(y.qty_delivery) AS total_delivery,
              a.created_by,
              a.created_on AS created_date
            FROM
              tr_sales_order a
              LEFT JOIN spk_delivery_detail y ON a.no_so = y.no_so
              LEFT JOIN spk_delivery z ON y.no_delivery = z.no_delivery
              LEFT JOIN tr_penawaran b ON a.no_penawaran = b.no_penawaran
              LEFT JOIN master_customers c ON b.id_customer = c.id_customer,
              (SELECT @row:=0) r
            WHERE a.approve = '1'  AND z.deleted_date IS NULL AND (
              a.no_so LIKE '%%'
              OR a.no_penawaran LIKE '%%'
              OR c.nm_customer LIKE '%%'
              OR a.project LIKE '%%'
            )
            GROUP BY a.no_so
            
ERROR - 2024-09-19 14:02:43 --> Query error: Table 'hirobolt.customer' doesn't exist - Invalid query: SELECT
              (@row:=@row+1) AS nomor,
              a.no_so,
              a.no_penawaran,
              c.nm_customer,
              a.project,
              z.no_delivery,
              z.no_surat_jalan,
              z.created_date,
              z.id,
              z.status,
              z.reject_reason,
              z.created_by,
              z.created_date
            FROM
              spk_delivery z
              LEFT JOIN tr_sales_order a ON a.no_so = z.no_so
              LEFT JOIN tr_penawaran b ON a.no_penawaran = b.no_penawaran
              LEFT JOIN customer c ON b.id_customer = c.id_customer,
              (SELECT @row:=0) r
            WHERE a.approve = '1'  AND z.deleted_date IS NULL AND (
              a.no_so LIKE '%%'
              OR a.no_penawaran LIKE '%%'
              OR c.nm_customer LIKE '%%'
              OR a.project LIKE '%%'
              OR z.no_surat_jalan LIKE '%%'
              OR z.no_delivery LIKE '%%'
            )
            
ERROR - 2024-09-19 14:14:06 --> Query error: Table 'hirobolt.customer' doesn't exist - Invalid query: SELECT
              (@row:=@row+1) AS nomor,
              a.no_so,
              a.no_penawaran,
              c.nm_customer,
              a.project,
              z.no_delivery,
              z.no_surat_jalan,
              z.created_date,
              z.id,
              z.status,
              z.reject_reason,
              z.created_by,
              z.created_date
            FROM
              spk_delivery z
              LEFT JOIN tr_sales_order a ON a.no_so = z.no_so
              LEFT JOIN tr_penawaran b ON a.no_penawaran = b.no_penawaran
              LEFT JOIN customer c ON b.id_customer = c.id_customer,
              (SELECT @row:=0) r
            WHERE a.approve = '1'  AND z.deleted_date IS NULL AND (
              a.no_so LIKE '%%'
              OR a.no_penawaran LIKE '%%'
              OR c.nm_customer LIKE '%%'
              OR a.project LIKE '%%'
              OR z.no_surat_jalan LIKE '%%'
              OR z.no_delivery LIKE '%%'
            )
            
ERROR - 2024-09-19 15:07:20 --> Query error: Table 'hirobolt.customer' doesn't exist - Invalid query: SELECT
              (@row:=@row+1) AS nomor,
              a.no_so,
              a.no_penawaran,
              c.nm_customer,
              a.project,
              z.no_delivery,
              z.no_surat_jalan,
              z.created_date,
              z.id,
              z.status,
              z.reject_reason,
              z.created_by,
              z.created_date
            FROM
              spk_delivery z
              LEFT JOIN tr_sales_order a ON a.no_so = z.no_so
              LEFT JOIN tr_penawaran b ON a.no_penawaran = b.no_penawaran
              LEFT JOIN customer c ON b.id_customer = c.id_customer,
              (SELECT @row:=0) r
            WHERE a.approve = '1'  AND z.deleted_date IS NULL AND (
              a.no_so LIKE '%%'
              OR a.no_penawaran LIKE '%%'
              OR c.nm_customer LIKE '%%'
              OR a.project LIKE '%%'
              OR z.no_surat_jalan LIKE '%%'
              OR z.no_delivery LIKE '%%'
            )
            
ERROR - 2024-09-19 15:52:58 --> Severity: Notice --> Undefined variable: datgroupmenu /home/ssc/hirobolt/application/modules/menus/views/menus_form.php 70
ERROR - 2024-09-19 15:53:18 --> Severity: Notice --> Undefined variable: datgroupmenu /home/ssc/hirobolt/application/modules/menus/views/menus_form.php 70
ERROR - 2024-09-19 16:07:48 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-19 16:07:48 --> 404 Page Not Found: /index
ERROR - 2024-09-19 16:27:23 --> Query error: Table 'hirobolt.customer' doesn't exist - Invalid query: SELECT
                    a.no_so,
                    a.no_penawaran,
                    c.nm_customer,
                    a.project,
                    a.delivery_date,
                    a.invoice_address
                  FROM
                    tr_sales_order a
                    LEFT JOIN tr_penawaran b ON a.no_penawaran = b.no_penawaran
                    LEFT JOIN customer c ON b.id_customer = c.id_customer
                  WHERE a.status = '1' AND a.no_so = 'P2400001' 
ERROR - 2024-09-19 16:27:54 --> Query error: Unknown column 'a.project' in 'field list' - Invalid query: SELECT
                    a.no_so,
                    a.no_penawaran,
                    c.nm_customer,
                    a.project,
                    a.delivery_date,
                    a.invoice_address
                  FROM
                    tr_sales_order a
                    LEFT JOIN tr_penawaran b ON a.no_penawaran = b.no_penawaran
                    LEFT JOIN master_customers c ON b.id_customer = c.id_customer
                  WHERE a.status = '1' AND a.no_so = 'P2400001' 
ERROR - 2024-09-19 16:28:07 --> Query error: Unknown column 'a.delivery_date' in 'field list' - Invalid query: SELECT
                    a.no_so,
                    a.no_penawaran,
                    c.nm_customer,
                    -- a.project,
                    a.delivery_date,
                    a.invoice_address
                  FROM
                    tr_sales_order a
                    LEFT JOIN tr_penawaran b ON a.no_penawaran = b.no_penawaran
                    LEFT JOIN master_customers c ON b.id_customer = c.id_customer
                  WHERE a.status = '1' AND a.no_so = 'P2400001' 
