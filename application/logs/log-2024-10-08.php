<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-10-08 08:24:09 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-10-08 08:24:11 --> 404 Page Not Found: /index
ERROR - 2024-10-08 08:54:36 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-10-08 08:54:36 --> 404 Page Not Found: /index
ERROR - 2024-10-08 09:08:22 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-10-08 09:08:23 --> 404 Page Not Found: /index
ERROR - 2024-10-08 09:11:36 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-10-08 09:11:36 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-10-08 09:11:38 --> 404 Page Not Found: /index
ERROR - 2024-10-08 09:11:39 --> 404 Page Not Found: /index
ERROR - 2024-10-08 09:22:13 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-10-08 09:22:13 --> 404 Page Not Found: /index
ERROR - 2024-10-08 10:37:25 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/inventory_4/views/form_inventory.php 105
ERROR - 2024-10-08 10:37:25 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/inventory_4/views/form_inventory.php 133
ERROR - 2024-10-08 10:57:40 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/inventory_4/views/form_inventory.php 105
ERROR - 2024-10-08 10:57:40 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/inventory_4/views/form_inventory.php 133
ERROR - 2024-10-08 11:00:30 --> Query error: Incorrect usage of UNION and ORDER BY - Invalid query: SELECT `a`.`no_surat`, `a`.`nama_sales`, `a`.`nilai_penawaran`, `a`.`tgl_penawaran`, `a`.`revisi`, `a`.`no_penawaran`, `a`.`status`, `b`.`nm_customer` as `name_customer`
FROM `tr_penawaran_history` `a`
JOIN `master_customers` `b` ON `b`.`id_customer`=`a`.`id_customer`
ORDER BY `created_on` DESC UNION SELECT `a`.`no_surat`, `a`.`nama_sales`, `a`.`nilai_penawaran`, `a`.`tgl_penawaran`, `a`.`revisi`, `a`.`no_penawaran`, `a`.`status`, `b`.`nm_customer` as `name_customer`
FROM `tr_penawaran` `a`
JOIN `master_customers` `b` ON `b`.`id_customer`=`a`.`id_customer`
WHERE `a`.`status_so` = '1'
ORDER BY `created_on` DESC
ERROR - 2024-10-08 11:00:59 --> Query error: Incorrect usage of UNION and ORDER BY - Invalid query: SELECT `a`.`no_surat`, `a`.`nama_sales`, `a`.`nilai_penawaran`, `a`.`tgl_penawaran`, `a`.`revisi`, `a`.`no_penawaran`, `a`.`status`, `b`.`nm_customer` as `name_customer`
FROM `tr_penawaran_history` `a`
JOIN `master_customers` `b` ON `b`.`id_customer`=`a`.`id_customer`
ORDER BY `a`.`created_on` DESC UNION SELECT `a`.`no_surat`, `a`.`nama_sales`, `a`.`nilai_penawaran`, `a`.`tgl_penawaran`, `a`.`revisi`, `a`.`no_penawaran`, `a`.`status`, `b`.`nm_customer` as `name_customer`
FROM `tr_penawaran` `a`
JOIN `master_customers` `b` ON `b`.`id_customer`=`a`.`id_customer`
WHERE `a`.`status_so` = '1'
ORDER BY `a`.`created_on` DESC
ERROR - 2024-10-08 11:01:24 --> Query error: Table 'a' from one of the SELECTs cannot be used in field list - Invalid query: SELECT `a`.`no_surat`, `a`.`nama_sales`, `a`.`nilai_penawaran`, `a`.`tgl_penawaran`, `a`.`revisi`, `a`.`no_penawaran`, `a`.`status`, `b`.`nm_customer` as `name_customer`
FROM `tr_penawaran_history` `a`
JOIN `master_customers` `b` ON `b`.`id_customer`=`a`.`id_customer` UNION SELECT `a`.`no_surat`, `a`.`nama_sales`, `a`.`nilai_penawaran`, `a`.`tgl_penawaran`, `a`.`revisi`, `a`.`no_penawaran`, `a`.`status`, `b`.`nm_customer` as `name_customer`
FROM `tr_penawaran` `a`
JOIN `master_customers` `b` ON `b`.`id_customer`=`a`.`id_customer`
WHERE `a`.`status_so` = '1'
ORDER BY `a`.`created_on` DESC
ERROR - 2024-10-08 11:22:24 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-10-08 11:22:26 --> 404 Page Not Found: /index
ERROR - 2024-10-08 11:30:37 --> 404 Page Not Found: /index
ERROR - 2024-10-08 14:16:32 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-10-08 14:16:32 --> 404 Page Not Found: /index
ERROR - 2024-10-08 14:37:51 --> Severity: Notice --> Undefined index: project /home/ssc/hirobolt/application/modules/spk_delivery/views/add.php 26
ERROR - 2024-10-08 14:41:48 --> Severity: Notice --> Undefined index: project /home/ssc/hirobolt/application/modules/spk_delivery_sj/views/add.php 30
ERROR - 2024-10-08 15:36:48 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-10-08 15:36:48 --> 404 Page Not Found: /index
ERROR - 2024-10-08 15:59:50 --> Severity: Parsing Error --> syntax error, unexpected '}' /home/ssc/hirobolt/application/modules/API/controllers/API.php 349
ERROR - 2024-10-08 16:05:41 --> Severity: Notice --> Undefined index: response /home/ssc/hirobolt/application/modules/API/controllers/API.php 283
ERROR - 2024-10-08 16:05:41 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/API/controllers/API.php 283
ERROR - 2024-10-08 16:21:11 --> Severity: Notice --> Array to string conversion /home/ssc/hirobolt/application/modules/API/controllers/API.php 338
ERROR - 2024-10-08 16:21:11 --> Query error: Unknown column 'Array' in 'where clause' - Invalid query: SELECT * FROM sales_marketplace_header WHERE code_order_marketplace IN(Array)
ERROR - 2024-10-08 16:22:00 --> Query error: Unknown column '24100827TURVDP' in 'where clause' - Invalid query: SELECT * FROM sales_marketplace_header WHERE code_order_marketplace IN(24100827TURVDP)
ERROR - 2024-10-08 16:22:30 --> Severity: Notice --> Array to string conversion /home/ssc/hirobolt/application/modules/API/controllers/API.php 353
ERROR - 2024-10-08 16:23:03 --> Severity: Notice --> Array to string conversion /home/ssc/hirobolt/application/modules/API/controllers/API.php 355
ERROR - 2024-10-08 16:23:28 --> Severity: Notice --> Array to string conversion /home/ssc/hirobolt/application/modules/API/controllers/API.php 355
ERROR - 2024-10-08 16:50:35 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-10-08 16:50:36 --> 404 Page Not Found: /index
ERROR - 2024-10-08 16:51:44 --> Query error: Unknown column '24100827TURVDP' in 'where clause' - Invalid query: SELECT * FROM sales_marketplace_header WHERE code_order_marketplace IN(24100827TURVDP)
ERROR - 2024-10-08 16:53:09 --> Query error: Unknown column '24100827TURVDP' in 'where clause' - Invalid query: SELECT * FROM sales_marketplace_header WHERE code_order_marketplace IN(24100827TURVDP)
ERROR - 2024-10-08 16:53:21 --> Query error: Unknown column '24100827TURVDP' in 'where clause' - Invalid query: SELECT * FROM sales_marketplace_header WHERE code_order_marketplace IN(24100827TURVDP)
ERROR - 2024-10-08 20:45:26 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-10-08 20:45:27 --> 404 Page Not Found: /index
ERROR - 2024-10-08 20:49:50 --> Severity: Notice --> Undefined index: project /home/ssc/hirobolt/application/modules/spk_delivery/views/add.php 26
ERROR - 2024-10-08 20:50:49 --> Severity: Notice --> Undefined index: project /home/ssc/hirobolt/application/modules/spk_delivery_sj/views/add.php 30
