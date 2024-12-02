<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-09-23 08:20:06 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-23 08:20:09 --> 404 Page Not Found: /index
ERROR - 2024-09-23 09:53:03 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-23 09:53:03 --> 404 Page Not Found: /index
ERROR - 2024-09-23 09:53:23 --> Severity: Notice --> Undefined index: project /home/ssc/hirobolt/application/modules/spk_delivery_sj/views/add.php 30
ERROR - 2024-09-23 09:56:23 --> Severity: Notice --> Undefined index: project /home/ssc/hirobolt/application/modules/spk_delivery_sj/views/add.php 30
ERROR - 2024-09-23 10:16:12 --> Severity: Notice --> Undefined index: project /home/ssc/hirobolt/application/modules/spk_delivery_sj/views/add.php 30
ERROR - 2024-09-23 10:16:45 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/spk_delivery_sj/controllers/Spk_delivery_sj.php 228
ERROR - 2024-09-23 10:16:45 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/spk_delivery_sj/controllers/Spk_delivery_sj.php 245
ERROR - 2024-09-23 10:16:55 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/spk_delivery_sj/controllers/Spk_delivery_sj.php 228
ERROR - 2024-09-23 10:16:55 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/spk_delivery_sj/controllers/Spk_delivery_sj.php 245
ERROR - 2024-09-23 10:19:27 --> Severity: Notice --> Undefined index: project /home/ssc/hirobolt/application/modules/spk_delivery_sj/views/add.php 30
ERROR - 2024-09-23 10:20:37 --> Severity: Notice --> Undefined index: project /home/ssc/hirobolt/application/modules/spk_delivery_sj/views/add.php 30
ERROR - 2024-09-23 10:27:42 --> Severity: Notice --> Undefined index: code_lv4 /home/ssc/hirobolt/application/modules/spk_delivery_sj/controllers/Spk_delivery_sj.php 149
ERROR - 2024-09-23 10:27:42 --> Query error: Unknown column 'code_lv4' in 'field list' - Invalid query: INSERT INTO `spk_delivery_detail_sj_temp` (`code_lv4`, `created_by`, `id_spk`, `no_delivery`, `no_so`, `qty_delivery`, `qty_order`, `qty_spk`) VALUES (NULL,'25','60','DLV24090002','P2400001',NULL,'100','100')
ERROR - 2024-09-23 10:28:21 --> Severity: Notice --> Undefined index: project /home/ssc/hirobolt/application/modules/spk_delivery_sj/views/add.php 30
ERROR - 2024-09-23 10:28:30 --> Query error: Table 'hirobolt.customer' doesn't exist - Invalid query: SELECT
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
                  WHERE a.approve = '1' AND z.no_delivery = 'DLV24090002' 
ERROR - 2024-09-23 10:28:58 --> Query error: Unknown column 'a.project' in 'field list' - Invalid query: SELECT
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
                    LEFT JOIN master_customers c ON b.id_customer = c.id_customer
                  WHERE z.no_delivery = 'DLV24090002' 
ERROR - 2024-09-23 10:35:05 --> Severity: Notice --> Undefined index: project /home/ssc/hirobolt/application/modules/spk_delivery_sj/views/add.php 30
ERROR - 2024-09-23 10:41:00 --> Severity: Notice --> Undefined index: project /home/ssc/hirobolt/application/modules/spk_delivery_sj/views/add.php 30
ERROR - 2024-09-23 10:43:07 --> Severity: Notice --> Undefined index: project /home/ssc/hirobolt/application/modules/spk_delivery_sj/views/add.php 30
ERROR - 2024-09-23 10:43:39 --> Severity: Notice --> Undefined index: project /home/ssc/hirobolt/application/modules/spk_delivery_sj/views/add.php 30
ERROR - 2024-09-23 10:49:39 --> Severity: Notice --> Undefined index: project /home/ssc/hirobolt/application/modules/spk_delivery_sj/views/add.php 30
ERROR - 2024-09-23 10:51:08 --> Severity: Notice --> Undefined index: project /home/ssc/hirobolt/application/modules/spk_delivery_sj/views/add.php 30
ERROR - 2024-09-23 11:00:57 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/spk_delivery_sj/controllers/Spk_delivery_sj.php 255
ERROR - 2024-09-23 11:01:15 --> Severity: Notice --> Undefined index: id /home/ssc/hirobolt/application/modules/spk_delivery_sj/controllers/Spk_delivery_sj.php 255
ERROR - 2024-09-23 11:44:39 --> Severity: Notice --> Undefined index: project /home/ssc/hirobolt/application/modules/spk_delivery_sj/views/add.php 30
ERROR - 2024-09-23 12:48:26 --> Severity: Notice --> Undefined index: no_bom /home/ssc/hirobolt/application/modules/spk_delivery_sj/controllers/Spk_delivery_sj.php 410
ERROR - 2024-09-23 12:48:26 --> Severity: Notice --> Undefined index: no_bom /home/ssc/hirobolt/application/modules/spk_delivery_sj/controllers/Spk_delivery_sj.php 410
ERROR - 2024-09-23 12:48:26 --> Severity: Notice --> Undefined index: code_lv4 /home/ssc/hirobolt/application/helpers/json_helper.php 1587
ERROR - 2024-09-23 12:48:26 --> Query error: Table 'hirobolt.stock_product' doesn't exist - Invalid query: SELECT *
FROM `stock_product`
WHERE `code_lv4` IS NULL
AND `no_bom` IS NULL
ERROR - 2024-09-23 12:48:37 --> Severity: Notice --> Undefined index: no_bom /home/ssc/hirobolt/application/modules/spk_delivery_sj/controllers/Spk_delivery_sj.php 410
ERROR - 2024-09-23 12:48:37 --> Severity: Notice --> Undefined index: no_bom /home/ssc/hirobolt/application/modules/spk_delivery_sj/controllers/Spk_delivery_sj.php 410
ERROR - 2024-09-23 12:48:37 --> Severity: Notice --> Undefined index: code_lv4 /home/ssc/hirobolt/application/helpers/json_helper.php 1587
ERROR - 2024-09-23 12:48:37 --> Query error: Table 'hirobolt.stock_product' doesn't exist - Invalid query: SELECT *
FROM `stock_product`
WHERE `code_lv4` IS NULL
AND `no_bom` IS NULL
ERROR - 2024-09-23 13:42:27 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-23 13:42:27 --> 404 Page Not Found: /index
ERROR - 2024-09-23 13:44:50 --> Severity: Notice --> Undefined index: project /home/ssc/hirobolt/application/modules/spk_delivery/views/add.php 26
ERROR - 2024-09-23 13:51:04 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-23 13:51:04 --> 404 Page Not Found: /index
ERROR - 2024-09-23 13:59:56 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/packing/controllers/Packing.php 69
ERROR - 2024-09-23 14:00:26 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/packing/controllers/Packing.php 69
ERROR - 2024-09-23 14:01:52 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/packing/controllers/Packing.php 69
ERROR - 2024-09-23 14:25:35 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/packing/controllers/Packing.php 69
ERROR - 2024-09-23 14:26:41 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/packing/controllers/Packing.php 69
ERROR - 2024-09-23 15:18:45 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/packing/controllers/Packing.php 69
ERROR - 2024-09-23 16:14:40 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/packing/controllers/Packing.php 69
ERROR - 2024-09-23 16:15:18 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/packing/controllers/Packing.php 69
ERROR - 2024-09-23 16:41:49 --> Severity: Notice --> Trying to get property of non-object /home/ssc/hirobolt/application/modules/packing/controllers/Packing.php 69
ERROR - 2024-09-23 17:33:22 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-23 17:33:22 --> 404 Page Not Found: /index
