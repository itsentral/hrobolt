<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-09-20 05:51:37 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-20 05:51:38 --> 404 Page Not Found: /index
ERROR - 2024-09-20 05:55:55 --> Query error: Table 'hirobolt.customer' doesn't exist - Invalid query: SELECT
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
            
ERROR - 2024-09-20 08:20:02 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-20 08:20:05 --> 404 Page Not Found: /index
ERROR - 2024-09-20 08:35:29 --> Query error: Table 'hirobolt.customer' doesn't exist - Invalid query: SELECT
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
            
ERROR - 2024-09-20 08:35:42 --> Query error: Unknown column 'a.delivery_date' in 'field list' - Invalid query: SELECT
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
ERROR - 2024-09-20 09:32:17 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-20 09:32:17 --> 404 Page Not Found: /index
ERROR - 2024-09-20 09:32:51 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-20 09:32:52 --> 404 Page Not Found: /index
ERROR - 2024-09-20 09:33:15 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-20 09:33:16 --> 404 Page Not Found: /index
ERROR - 2024-09-20 09:33:33 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-20 09:33:34 --> 404 Page Not Found: /index
ERROR - 2024-09-20 09:35:53 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-20 09:35:53 --> 404 Page Not Found: /index
ERROR - 2024-09-20 09:35:58 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-20 09:35:58 --> 404 Page Not Found: /index
ERROR - 2024-09-20 09:36:26 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-20 09:36:26 --> 404 Page Not Found: /index
ERROR - 2024-09-20 09:38:08 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-20 09:38:09 --> 404 Page Not Found: /index
ERROR - 2024-09-20 09:41:08 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-20 09:41:08 --> 404 Page Not Found: /index
ERROR - 2024-09-20 10:00:43 --> Query error: Unknown column 'a.delivery_date' in 'field list' - Invalid query: SELECT
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
ERROR - 2024-09-20 10:57:06 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-20 10:57:06 --> 404 Page Not Found: /index
ERROR - 2024-09-20 13:33:34 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-20 13:33:34 --> 404 Page Not Found: /index
ERROR - 2024-09-20 13:52:47 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-20 13:52:48 --> 404 Page Not Found: /index
ERROR - 2024-09-20 13:53:00 --> Severity: Notice --> Undefined variable: datgroupmenu /home/ssc/hirobolt/application/modules/menus/views/menus_form.php 70
ERROR - 2024-09-20 13:53:21 --> Severity: Notice --> Undefined variable: datgroupmenu /home/ssc/hirobolt/application/modules/menus/views/menus_form.php 70
ERROR - 2024-09-20 13:53:36 --> Severity: Notice --> Undefined variable: datgroupmenu /home/ssc/hirobolt/application/modules/menus/views/menus_form.php 70
ERROR - 2024-09-20 14:06:47 --> Severity: Error --> Cannot use object of type CI_Output as array /home/ssc/hirobolt/application/modules/sales_order/controllers/Sales_order.php 405
ERROR - 2024-09-20 14:08:27 --> Query error: Unknown column 'a.invoice_address' in 'field list' - Invalid query: SELECT
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
                  WHERE a.status = '1' AND a.no_so = 'P2400002' 
ERROR - 2024-09-20 14:09:41 --> Severity: Notice --> Undefined index: project /home/ssc/hirobolt/application/modules/spk_delivery/views/add.php 26
ERROR - 2024-09-20 14:10:20 --> Severity: Notice --> Undefined index: project /home/ssc/hirobolt/application/modules/spk_delivery/views/add.php 26
ERROR - 2024-09-20 14:11:35 --> Severity: Notice --> Undefined index: project /home/ssc/hirobolt/application/modules/spk_delivery/views/add.php 26
ERROR - 2024-09-20 14:12:08 --> Severity: Notice --> Undefined index: project /home/ssc/hirobolt/application/modules/spk_delivery/views/add.php 26
ERROR - 2024-09-20 14:14:36 --> Severity: Notice --> Undefined index: project /home/ssc/hirobolt/application/modules/spk_delivery/views/add.php 26
ERROR - 2024-09-20 14:14:50 --> Query error: Unknown column 'b.no_bom' in 'field list' - Invalid query: SELECT `a`.*, `b`.`no_bom`
FROM `spk_delivery_detail` `a`
JOIN `tr_sales_order_detail` `b` ON `a`.`id_so_det`=`b`.`id_so_detail`
WHERE `a`.`no_delivery` = 'DLV24090001'
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 226
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 227
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 228
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 229
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 230
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 231
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 232
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 233
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 234
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 226
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 227
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 228
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 229
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 230
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 231
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 232
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 233
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 234
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 226
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 227
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 228
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 229
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 230
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 231
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 232
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 233
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 234
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 226
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 227
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 228
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 229
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 230
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 231
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 232
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 233
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 234
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 226
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 227
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 228
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 229
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 230
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 231
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 232
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 233
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 234
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 226
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 227
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 228
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 229
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 230
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 231
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 232
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 233
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 234
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 226
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 227
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 228
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 229
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 230
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 231
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 232
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 233
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 234
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 226
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 227
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 228
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 229
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 230
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 231
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 232
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 233
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 234
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 226
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 227
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 228
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 229
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 230
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 231
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 232
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 233
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 234
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 226
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 227
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 228
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 229
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 230
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 231
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 232
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 233
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 234
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 226
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 227
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 228
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 229
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 230
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 231
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 232
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 233
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 234
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 226
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 227
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 228
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 229
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 230
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 231
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 232
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 233
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 234
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 226
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 227
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 228
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 229
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 230
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 231
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 232
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 233
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 234
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 226
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 227
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 228
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 229
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 230
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 231
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 232
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 233
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 234
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 226
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 227
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 228
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 229
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 230
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 231
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 232
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 233
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 234
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 226
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 227
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 228
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 229
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 230
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 231
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 232
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 233
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 234
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 226
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 227
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 228
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 229
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 230
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 231
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 232
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 233
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 234
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 226
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 227
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 228
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 229
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 230
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 231
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 232
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 233
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 234
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 226
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 227
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 228
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 229
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 230
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 231
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 232
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 233
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 234
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 226
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 227
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 228
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 229
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 230
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 231
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 232
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 233
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 234
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 226
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 227
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 228
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 229
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 230
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 231
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 232
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 233
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 234
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 226
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 227
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 228
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 229
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 230
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 231
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 232
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 233
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 234
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 226
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 227
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 228
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 229
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 230
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 231
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 232
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 233
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 234
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 226
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 227
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 228
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 229
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 230
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 231
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 232
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 233
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 234
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 226
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 227
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 228
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 229
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 230
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 231
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 232
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 233
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 234
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 226
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 227
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 228
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 229
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 230
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 231
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 232
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 233
ERROR - 2024-09-20 14:23:37 --> Severity: Notice --> Undefined index: product_id /home/ssc/hirobolt/application/helpers/json_helper.php 234
ERROR - 2024-09-20 14:23:38 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/ssc/hirobolt/system/core/Exceptions.php:272) /home/ssc/origa_live/application/libraries/MPDF57/mpdf.php 8298
ERROR - 2024-09-20 14:23:38 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/ssc/hirobolt/system/core/Exceptions.php:272) /home/ssc/origa_live/application/libraries/MPDF57/mpdf.php 1707
ERROR - 2024-09-20 14:47:16 --> Severity: Notice --> Undefined index: project /home/ssc/hirobolt/application/modules/spk_delivery/views/add.php 26
ERROR - 2024-09-20 14:47:23 --> Query error: Table 'hirobolt.customer' doesn't exist - Invalid query: SELECT
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
            
ERROR - 2024-09-20 14:47:33 --> Query error: Table 'hirobolt.customer' doesn't exist - Invalid query: SELECT
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
            
ERROR - 2024-09-20 14:49:12 --> Severity: Notice --> Undefined index: project /home/ssc/hirobolt/application/modules/spk_delivery_sj/models/Spk_delivery_sj_model.php 83
ERROR - 2024-09-20 14:50:10 --> Query error: Table 'hirobolt.customer' doesn't exist - Invalid query: SELECT
                    a.no_so,
                    a.no_penawaran,
                    c.nm_customer,
                    a.project,
                    z.no_delivery,
                    z.no_surat_jalan,
                    z.created_date,
                    z.id,
                    z.status,
                    z.delivery_date,
                    z.delivery_address
                  FROM
                    spk_delivery z
                    LEFT JOIN tr_sales_order a ON a.no_so = z.no_so
                    LEFT JOIN tr_penawaran b ON a.no_penawaran = b.no_penawaran
                    LEFT JOIN customer c ON b.id_customer = c.id_customer
                  WHERE a.approve = '1' AND z.no_delivery = 'DLV24090001' 
ERROR - 2024-09-20 14:50:40 --> Query error: Unknown column 'b.no_bom' in 'field list' - Invalid query: SELECT `a`.*, `b`.`no_bom`
FROM `spk_delivery_detail` `a`
JOIN `tr_sales_order_detail` `b` ON `a`.`id_so_det`=`b`.`id_so_detail`
WHERE `a`.`no_delivery` = 'DLV24090001'
ERROR - 2024-09-20 14:50:50 --> Severity: Notice --> Undefined index: project /home/ssc/hirobolt/application/modules/spk_delivery_sj/views/add.php 30
ERROR - 2024-09-20 14:50:50 --> Severity: Notice --> Undefined index: code_lv4 /home/ssc/hirobolt/application/modules/spk_delivery_sj/views/add.php 69
ERROR - 2024-09-20 14:50:50 --> Severity: Notice --> Undefined index: no_bom /home/ssc/hirobolt/application/modules/spk_delivery_sj/views/add.php 70
ERROR - 2024-09-20 14:50:50 --> Severity: Notice --> Undefined index: no_bom /home/ssc/hirobolt/application/modules/spk_delivery_sj/views/add.php 70
ERROR - 2024-09-20 14:50:50 --> Severity: Notice --> Undefined index:  /home/ssc/hirobolt/application/modules/spk_delivery_sj/views/add.php 70
ERROR - 2024-09-20 14:50:50 --> Severity: Notice --> Undefined index: code_lv4 /home/ssc/hirobolt/application/modules/spk_delivery_sj/views/add.php 76
ERROR - 2024-09-20 14:50:50 --> Severity: Notice --> Undefined index: no_bom /home/ssc/hirobolt/application/modules/spk_delivery_sj/views/add.php 76
ERROR - 2024-09-20 14:50:50 --> Severity: Notice --> Undefined index: code_lv4 /home/ssc/hirobolt/application/modules/spk_delivery_sj/views/add.php 69
ERROR - 2024-09-20 14:50:50 --> Severity: Notice --> Undefined index: no_bom /home/ssc/hirobolt/application/modules/spk_delivery_sj/views/add.php 70
ERROR - 2024-09-20 14:50:50 --> Severity: Notice --> Undefined index: no_bom /home/ssc/hirobolt/application/modules/spk_delivery_sj/views/add.php 70
ERROR - 2024-09-20 14:50:50 --> Severity: Notice --> Undefined index:  /home/ssc/hirobolt/application/modules/spk_delivery_sj/views/add.php 70
ERROR - 2024-09-20 14:50:50 --> Severity: Notice --> Undefined index: code_lv4 /home/ssc/hirobolt/application/modules/spk_delivery_sj/views/add.php 76
ERROR - 2024-09-20 14:50:50 --> Severity: Notice --> Undefined index: no_bom /home/ssc/hirobolt/application/modules/spk_delivery_sj/views/add.php 76
ERROR - 2024-09-20 14:51:35 --> Severity: Notice --> Undefined index: project /home/ssc/hirobolt/application/modules/spk_delivery_sj/views/add.php 30
ERROR - 2024-09-20 14:51:35 --> Severity: Notice --> Undefined index: code_lv4 /home/ssc/hirobolt/application/modules/spk_delivery_sj/views/add.php 76
ERROR - 2024-09-20 14:51:35 --> Severity: Notice --> Undefined index: no_bom /home/ssc/hirobolt/application/modules/spk_delivery_sj/views/add.php 76
ERROR - 2024-09-20 14:51:35 --> Severity: Notice --> Undefined index: code_lv4 /home/ssc/hirobolt/application/modules/spk_delivery_sj/views/add.php 76
ERROR - 2024-09-20 14:51:35 --> Severity: Notice --> Undefined index: no_bom /home/ssc/hirobolt/application/modules/spk_delivery_sj/views/add.php 76
ERROR - 2024-09-20 14:52:42 --> Severity: Notice --> Undefined index: project /home/ssc/hirobolt/application/modules/spk_delivery_sj/views/add.php 30
ERROR - 2024-09-20 17:02:44 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-20 17:02:44 --> 404 Page Not Found: /index
ERROR - 2024-09-20 17:04:21 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/packing/controllers/Packing.php 69
ERROR - 2024-09-20 17:04:48 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-20 17:04:48 --> 404 Page Not Found: /index
ERROR - 2024-09-20 17:07:45 --> Severity: Notice --> Undefined index: project /home/ssc/hirobolt/application/modules/spk_delivery/views/add.php 26
ERROR - 2024-09-20 17:17:10 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-20 17:17:11 --> 404 Page Not Found: /index
ERROR - 2024-09-20 17:22:51 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-20 17:22:51 --> 404 Page Not Found: /index
ERROR - 2024-09-20 20:52:58 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-20 20:53:02 --> 404 Page Not Found: /index
ERROR - 2024-09-20 20:53:22 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/stock.php 27
ERROR - 2024-09-20 20:53:22 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/stock.php 27
ERROR - 2024-09-20 20:53:22 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/stock.php 27
ERROR - 2024-09-20 20:53:22 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/stock.php 27
ERROR - 2024-09-20 20:53:22 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/stock.php 27
ERROR - 2024-09-20 20:53:22 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/stock.php 27
ERROR - 2024-09-20 20:53:22 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/stock.php 27
ERROR - 2024-09-20 20:53:22 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/stock.php 27
ERROR - 2024-09-20 20:53:22 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/stock.php 27
ERROR - 2024-09-20 20:53:22 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/stock.php 27
ERROR - 2024-09-20 20:53:22 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/stock.php 27
ERROR - 2024-09-20 20:53:22 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/stock.php 27
ERROR - 2024-09-20 20:53:22 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/stock.php 27
ERROR - 2024-09-20 20:53:22 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/stock.php 27
ERROR - 2024-09-20 20:53:22 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/stock.php 27
ERROR - 2024-09-20 20:53:22 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/stock.php 27
ERROR - 2024-09-20 20:53:22 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/stock.php 27
ERROR - 2024-09-20 20:53:22 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/stock.php 27
ERROR - 2024-09-20 20:53:22 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/stock.php 27
ERROR - 2024-09-20 20:53:22 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/stock.php 27
ERROR - 2024-09-20 20:53:22 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/stock.php 27
ERROR - 2024-09-20 20:53:22 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/stock.php 27
ERROR - 2024-09-20 20:53:22 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/stock.php 27
ERROR - 2024-09-20 20:53:22 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/stock.php 27
ERROR - 2024-09-20 20:53:22 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/stock.php 27
ERROR - 2024-09-20 20:53:22 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/stock.php 27
ERROR - 2024-09-20 20:53:22 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/stock.php 27
ERROR - 2024-09-20 20:53:22 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/stock.php 27
ERROR - 2024-09-20 20:53:22 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/stock.php 27
ERROR - 2024-09-20 20:53:54 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/wip.php 27
ERROR - 2024-09-20 20:53:54 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/wip.php 27
ERROR - 2024-09-20 20:53:54 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/wip.php 27
ERROR - 2024-09-20 20:53:54 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/wip.php 27
ERROR - 2024-09-20 20:53:54 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/wip.php 27
ERROR - 2024-09-20 20:53:54 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/wip.php 27
ERROR - 2024-09-20 20:53:54 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/wip.php 27
ERROR - 2024-09-20 20:53:54 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/wip.php 27
ERROR - 2024-09-20 20:53:54 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/wip.php 27
ERROR - 2024-09-20 20:53:54 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/wip.php 27
ERROR - 2024-09-20 20:53:54 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/wip.php 27
ERROR - 2024-09-20 20:53:54 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/wip.php 27
ERROR - 2024-09-20 20:53:54 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/wip.php 27
ERROR - 2024-09-20 20:53:54 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/wip.php 27
ERROR - 2024-09-20 20:53:54 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/wip.php 27
ERROR - 2024-09-20 20:53:54 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/wip.php 27
ERROR - 2024-09-20 20:53:54 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/wip.php 27
ERROR - 2024-09-20 20:53:54 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/wip.php 27
ERROR - 2024-09-20 20:53:54 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/wip.php 27
ERROR - 2024-09-20 20:53:54 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/wip.php 27
ERROR - 2024-09-20 20:53:54 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/wip.php 27
ERROR - 2024-09-20 20:53:54 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/wip.php 27
ERROR - 2024-09-20 20:53:54 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/wip.php 27
ERROR - 2024-09-20 20:53:54 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/wip.php 27
ERROR - 2024-09-20 20:53:54 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/wip.php 27
ERROR - 2024-09-20 20:53:54 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/wip.php 27
ERROR - 2024-09-20 20:53:54 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/wip.php 27
ERROR - 2024-09-20 20:53:54 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/wip.php 27
ERROR - 2024-09-20 20:53:54 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/wip.php 27
ERROR - 2024-09-20 20:54:10 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/adjustment.php 30
ERROR - 2024-09-20 20:54:10 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/adjustment.php 30
ERROR - 2024-09-20 20:54:10 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/adjustment.php 30
ERROR - 2024-09-20 20:54:10 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/adjustment.php 30
ERROR - 2024-09-20 20:54:10 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/adjustment.php 30
ERROR - 2024-09-20 20:54:10 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/adjustment.php 30
ERROR - 2024-09-20 20:54:10 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/adjustment.php 30
ERROR - 2024-09-20 20:54:10 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/adjustment.php 30
ERROR - 2024-09-20 20:54:10 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/adjustment.php 30
ERROR - 2024-09-20 20:54:10 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/adjustment.php 30
ERROR - 2024-09-20 20:54:10 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/adjustment.php 30
ERROR - 2024-09-20 20:54:10 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/adjustment.php 30
ERROR - 2024-09-20 20:54:10 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/adjustment.php 30
ERROR - 2024-09-20 20:54:10 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/adjustment.php 30
ERROR - 2024-09-20 20:54:10 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/adjustment.php 30
ERROR - 2024-09-20 20:54:10 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/adjustment.php 30
ERROR - 2024-09-20 20:54:10 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/adjustment.php 30
ERROR - 2024-09-20 20:54:10 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/adjustment.php 30
ERROR - 2024-09-20 20:54:10 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/adjustment.php 30
ERROR - 2024-09-20 20:54:10 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/adjustment.php 30
ERROR - 2024-09-20 20:54:10 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/adjustment.php 30
ERROR - 2024-09-20 20:54:10 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/adjustment.php 30
ERROR - 2024-09-20 20:54:10 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/adjustment.php 30
ERROR - 2024-09-20 20:54:10 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/adjustment.php 30
ERROR - 2024-09-20 20:54:10 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/adjustment.php 30
ERROR - 2024-09-20 20:54:10 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/adjustment.php 30
ERROR - 2024-09-20 20:54:10 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/adjustment.php 30
ERROR - 2024-09-20 20:54:10 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/adjustment.php 30
ERROR - 2024-09-20 20:54:10 --> Severity: Notice --> Undefined index: id_category2 /home/ssc/hirobolt/application/modules/warehouse_product/views/adjustment.php 30
ERROR - 2024-09-20 21:12:00 --> Severity: Notice --> Undefined variable: datgroupmenu /home/ssc/hirobolt/application/modules/menus/views/menus_form.php 70
ERROR - 2024-09-20 21:12:39 --> Severity: Notice --> Undefined variable: datgroupmenu /home/ssc/hirobolt/application/modules/menus/views/menus_form.php 70
ERROR - 2024-09-20 21:12:56 --> Severity: Notice --> Undefined variable: datgroupmenu /home/ssc/hirobolt/application/modules/menus/views/menus_form.php 70
ERROR - 2024-09-20 21:13:05 --> Severity: Notice --> Undefined variable: datgroupmenu /home/ssc/hirobolt/application/modules/menus/views/menus_form.php 70
ERROR - 2024-09-20 21:13:20 --> 404 Page Not Found: ../modules/purchase_request_payment/controllers//index
ERROR - 2024-09-20 21:13:29 --> Severity: Notice --> Undefined variable: datgroupmenu /home/ssc/hirobolt/application/modules/menus/views/menus_form.php 70
ERROR - 2024-09-20 21:13:39 --> Severity: Notice --> Undefined variable: datgroupmenu /home/ssc/hirobolt/application/modules/menus/views/menus_form.php 70
ERROR - 2024-09-20 21:14:39 --> Severity: Notice --> Undefined variable: datgroupmenu /home/ssc/hirobolt/application/modules/menus/views/menus_form.php 70
ERROR - 2024-09-20 21:15:04 --> Severity: Notice --> Undefined variable: datgroupmenu /home/ssc/hirobolt/application/modules/menus/views/menus_form.php 70
ERROR - 2024-09-20 21:15:47 --> Severity: Notice --> Undefined variable: datgroupmenu /home/ssc/hirobolt/application/modules/menus/views/menus_form.php 70
ERROR - 2024-09-20 21:16:12 --> Severity: Notice --> Undefined variable: datgroupmenu /home/ssc/hirobolt/application/modules/menus/views/menus_form.php 70
ERROR - 2024-09-20 21:16:43 --> Severity: Notice --> Undefined index: project /home/ssc/hirobolt/application/modules/spk_delivery/views/add.php 26
ERROR - 2024-09-20 21:20:35 --> Severity: Notice --> Undefined index: project /home/ssc/hirobolt/application/modules/spk_delivery/views/add.php 26
ERROR - 2024-09-20 21:20:52 --> Severity: Notice --> Undefined index: project /home/ssc/hirobolt/application/modules/spk_delivery_sj/views/add.php 30
ERROR - 2024-09-20 22:34:44 --> Severity: Notice --> Undefined index: project /home/ssc/hirobolt/application/modules/spk_delivery_sj/views/add.php 30
ERROR - 2024-09-20 23:04:16 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/packing/controllers/Packing.php 69
ERROR - 2024-09-20 23:21:30 --> Severity: Notice --> Undefined index: project /home/ssc/hirobolt/application/modules/spk_delivery_sj/views/add.php 30
ERROR - 2024-09-20 23:21:37 --> Severity: Notice --> Undefined index: project /home/ssc/hirobolt/application/modules/spk_delivery_sj/views/add.php 30
