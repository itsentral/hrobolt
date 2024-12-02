<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-09-11 08:23:35 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-11 08:23:37 --> 404 Page Not Found: /index
ERROR - 2024-09-11 10:46:11 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-11 10:46:12 --> 404 Page Not Found: /index
ERROR - 2024-09-11 10:52:16 --> 404 Page Not Found: /index
ERROR - 2024-09-11 10:52:18 --> 404 Page Not Found: /index
ERROR - 2024-09-11 10:52:21 --> 404 Page Not Found: /index
ERROR - 2024-09-11 11:03:10 --> Severity: Notice --> Undefined variable: datgroupmenu /home/ssc/hirobolt/application/modules/menus/views/menus_form.php 70
ERROR - 2024-09-11 11:04:35 --> Severity: Notice --> Undefined variable: datgroupmenu /home/ssc/hirobolt/application/modules/menus/views/menus_form.php 70
ERROR - 2024-09-11 11:04:54 --> Severity: Notice --> Undefined variable: datgroupmenu /home/ssc/hirobolt/application/modules/menus/views/menus_form.php 70
ERROR - 2024-09-11 11:08:53 --> Severity: Notice --> Undefined variable: datgroupmenu /home/ssc/hirobolt/application/modules/menus/views/menus_form.php 70
ERROR - 2024-09-11 11:09:07 --> Severity: Error --> Call to a member function cariSalesOrder() on null /home/ssc/hirobolt/application/modules/sales_order/controllers/Sales_order.php 40
ERROR - 2024-09-11 11:09:26 --> Severity: Error --> Call to a member function get_data() on null /home/ssc/hirobolt/application/modules/sales_order/controllers/Sales_order.php 86
ERROR - 2024-09-11 11:12:15 --> Severity: Error --> Call to a member function get_data() on null /home/ssc/hirobolt/application/modules/sales_order/controllers/Sales_order.php 86
ERROR - 2024-09-11 11:13:09 --> Severity: Error --> Call to a member function get_data() on null /home/ssc/hirobolt/application/modules/sales_order/controllers/Sales_order.php 86
ERROR - 2024-09-11 11:13:55 --> Query error: Table 'hirobolt.ms_karyawan' doesn't exist - Invalid query: SELECT *
FROM `ms_karyawan`
ERROR - 2024-09-11 11:38:38 --> 404 Page Not Found: /index
ERROR - 2024-09-11 11:38:53 --> 404 Page Not Found: /index
ERROR - 2024-09-11 11:40:33 --> The upload destination folder does not appear to be writable.
ERROR - 2024-09-11 11:40:33 --> The upload destination folder does not appear to be writable.
ERROR - 2024-09-11 11:40:34 --> Query error: Unknown column 'b.name_customer' in 'field list' - Invalid query: SELECT `a`.*, `b`.`name_customer` as `name_customer`, `c`.`grand_total` as `total_penawaran`, `c`.`no_surat` as `nomor_penawaran`, `c`.`tgl_penawaran`, `d`.`nm_lengkap`
FROM `tr_sales_order` `a`
JOIN `master_customers` `b` ON `b`.`id_customer`=`a`.`id_customer`
JOIN `tr_penawaran` `c` ON `c`.`no_penawaran`=`a`.`no_penawaran`
JOIN `users` `d` ON `d`.`id_user`=`a`.`created_by`
WHERE `a`.`status` != '0'
ORDER BY `a`.`no_so` DESC
ERROR - 2024-09-11 11:49:15 --> 404 Page Not Found: /index
ERROR - 2024-09-11 11:49:39 --> Query error: Unknown column 'b.name_customer' in 'field list' - Invalid query: SELECT `a`.*, `b`.`name_customer` as `name_customer`, `c`.`grand_total` as `total_penawaran`, `c`.`no_surat` as `nomor_penawaran`, `c`.`tgl_penawaran`
FROM `tr_sales_order` `a`
JOIN `master_customers` `b` ON `b`.`id_customer`=`a`.`id_customer`
JOIN `tr_penawaran` `c` ON `c`.`no_penawaran`=`a`.`no_penawaran`
WHERE `a`.`no_so` = 'P2400001'
AND `a`.`status` != '0'
ORDER BY `a`.`no_so` DESC
ERROR - 2024-09-11 11:49:58 --> Query error: Table 'hirobolt.ms_karyawan' doesn't exist - Invalid query: SELECT * FROM ms_karyawan WHERE id_karyawan='25'
ERROR - 2024-09-11 11:51:04 --> Query error: Unknown column 'kode_barang' in 'field list' - Invalid query: SELECT kode_barang FROM ms_inventory_category3 WHERE id_category3='1577'
ERROR - 2024-09-11 11:51:26 --> Severity: error --> Exception: ERROR n°6 : Impossible to load the image /home/ssc/watercosystem/assets/files/tandatangan/ /home/ssc/hirobolt/assets/html2pdf/html2pdf/html2pdf.class.php 1319
ERROR - 2024-09-11 11:56:21 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-11 11:56:21 --> 404 Page Not Found: /index
ERROR - 2024-09-11 13:21:11 --> 404 Page Not Found: /index
ERROR - 2024-09-11 13:23:21 --> The upload destination folder does not appear to be writable.
ERROR - 2024-09-11 13:23:21 --> The upload destination folder does not appear to be writable.
ERROR - 2024-09-11 13:26:32 --> The upload destination folder does not appear to be writable.
ERROR - 2024-09-11 13:26:32 --> The upload destination folder does not appear to be writable.
ERROR - 2024-09-11 13:27:32 --> The upload destination folder does not appear to be writable.
ERROR - 2024-09-11 13:27:32 --> The upload destination folder does not appear to be writable.
ERROR - 2024-09-11 13:57:00 --> Severity: error --> Exception: ERROR n°5 : HTML code invalid, all tags must be closed.Status : Array
(
    [0] => html
)
 /home/ssc/hirobolt/assets/html2pdf/html2pdf/_class/parsingHtml.class.php 218
ERROR - 2024-09-11 13:57:15 --> Severity: error --> Exception: ERROR n°5 : HTML code invalid, all tags must be closed.Status : Array
(
    [0] => html
)
 /home/ssc/hirobolt/assets/html2pdf/html2pdf/_class/parsingHtml.class.php 218
ERROR - 2024-09-11 13:58:16 --> Severity: error --> Exception: ERROR n°4 : HTML code invalid, the tags are not closed in an orderly fashion.Status : Array
(
    [0] => page
    [1] => page
)
 HTML : ...</td>
		</tr>
	</table>
	<hr>
</page_header>

<table border="0" width=... /home/ssc/hirobolt/assets/html2pdf/html2pdf/_class/parsingHtml.class.php 119
ERROR - 2024-09-11 13:58:19 --> Severity: error --> Exception: ERROR n°4 : HTML code invalid, the tags are not closed in an orderly fashion.Status : Array
(
    [0] => page
    [1] => page
)
 HTML : ...</td>
		</tr>
	</table>
	<hr>
</page_header>

<table border="0" width=... /home/ssc/hirobolt/assets/html2pdf/html2pdf/_class/parsingHtml.class.php 119
ERROR - 2024-09-11 13:58:28 --> Severity: error --> Exception: ERROR n°4 : HTML code invalid, the tags are not closed in an orderly fashion.Status : Array
(
    [0] => page
    [1] => page
)
 HTML : ...</td>
		</tr>
	</table>
	<hr>
</page_header>

<table border="0" width=... /home/ssc/hirobolt/assets/html2pdf/html2pdf/_class/parsingHtml.class.php 119
ERROR - 2024-09-11 14:03:02 --> Severity: error --> Exception: ERROR n°5 : HTML code invalid, all tags must be closed.Status : Array
(
    [0] => html
)
 /home/ssc/hirobolt/assets/html2pdf/html2pdf/_class/parsingHtml.class.php 218
ERROR - 2024-09-11 14:09:15 --> Severity: error --> Exception: ERROR n°5 : HTML code invalid, all tags must be closed.Status : Array
(
    [0] => html
)
 /home/ssc/hirobolt/assets/html2pdf/html2pdf/_class/parsingHtml.class.php 218
ERROR - 2024-09-11 14:10:33 --> Severity: error --> Exception: ERROR n°1 : The tag &lt;TITLE&gt; does not yet exist.If you want to add it, you must create the methods o_TITLE (for opening) and c_TITLE (for closure) by following the model of existing tags.If you create these methods, do not hesitate to send me an email to webmaster@html2pdf.fr to included them in the next version of HTML2PDF. /home/ssc/hirobolt/assets/html2pdf/html2pdf/html2pdf.class.php 1251
ERROR - 2024-09-11 14:14:38 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-11 14:14:38 --> 404 Page Not Found: /index
ERROR - 2024-09-11 14:38:11 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-11 14:38:11 --> 404 Page Not Found: /index
ERROR - 2024-09-11 14:39:18 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-11 14:39:18 --> 404 Page Not Found: /index
ERROR - 2024-09-11 14:42:38 --> Severity: Notice --> Undefined variable: cabang /home/ssc/hirobolt/application/modules/users/views/users_form.php 68
ERROR - 2024-09-11 14:42:38 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/users/views/users_form.php 68
ERROR - 2024-09-11 14:42:38 --> Severity: Notice --> Undefined variable: departments /home/ssc/hirobolt/application/modules/users/views/users_form.php 85
ERROR - 2024-09-11 14:42:38 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/users/views/users_form.php 85
ERROR - 2024-09-11 14:44:42 --> Severity: Notice --> Undefined variable: datgroupmenu /home/ssc/hirobolt/application/modules/menus/views/menus_form.php 70
ERROR - 2024-09-11 14:45:53 --> Severity: Notice --> Undefined variable: datgroupmenu /home/ssc/hirobolt/application/modules/menus/views/menus_form.php 70
ERROR - 2024-09-11 14:47:43 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-11 14:47:43 --> 404 Page Not Found: /index
ERROR - 2024-09-11 14:47:50 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-11 14:47:50 --> 404 Page Not Found: /index
ERROR - 2024-09-11 14:48:15 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-11 14:48:15 --> 404 Page Not Found: /index
ERROR - 2024-09-11 15:04:14 --> 404 Page Not Found: /index
ERROR - 2024-09-11 15:04:16 --> 404 Page Not Found: /index
ERROR - 2024-09-11 15:08:21 --> 404 Page Not Found: /index
ERROR - 2024-09-11 15:08:28 --> 404 Page Not Found: /index
ERROR - 2024-09-11 15:57:31 --> 404 Page Not Found: /index
ERROR - 2024-09-11 15:57:37 --> 404 Page Not Found: /index
ERROR - 2024-09-11 16:30:33 --> 404 Page Not Found: /index
ERROR - 2024-09-11 16:43:38 --> 404 Page Not Found: /index
ERROR - 2024-09-11 16:43:56 --> 404 Page Not Found: /index
ERROR - 2024-09-11 17:25:28 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-11 17:25:28 --> 404 Page Not Found: /index
ERROR - 2024-09-11 17:38:50 --> 404 Page Not Found: /index
ERROR - 2024-09-11 17:44:39 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-11 17:44:40 --> 404 Page Not Found: /index
ERROR - 2024-09-11 17:44:51 --> Severity: Notice --> Undefined variable: datgroupmenu /home/ssc/hirobolt/application/modules/menus/views/menus_form.php 70
ERROR - 2024-09-11 17:45:19 --> Severity: Notice --> Undefined variable: datgroupmenu /home/ssc/hirobolt/application/modules/menus/views/menus_form.php 70
ERROR - 2024-09-11 17:45:29 --> Query error: Unknown column 'b.name_customer' in 'field list' - Invalid query: SELECT `a`.*, `b`.`name_customer` as `name_customer`
FROM `tr_penawaran` `a`
JOIN `master_customers` `b` ON `b`.`id_customer`=`a`.`id_customer`
WHERE `a`.`status` = '1'
ORDER BY `a`.`no_penawaran`
ERROR - 2024-09-11 17:46:00 --> Query error: Unknown column 'b.nm_customers' in 'field list' - Invalid query: SELECT `a`.*, `b`.`nm_customers` as `name_customer`
FROM `tr_penawaran` `a`
JOIN `master_customers` `b` ON `b`.`id_customer`=`a`.`id_customer`
WHERE `a`.`status` = '1'
ORDER BY `a`.`no_penawaran`
ERROR - 2024-09-11 17:46:34 --> 404 Page Not Found: /index
ERROR - 2024-09-11 17:46:54 --> 404 Page Not Found: /index
ERROR - 2024-09-11 17:46:58 --> Query error: Table 'hirobolt.ms_karyawan' doesn't exist - Invalid query: SELECT *
FROM `ms_karyawan`
WHERE `deleted` = '0'
ERROR - 2024-09-11 17:48:00 --> Severity: Error --> Call to a member function get_data() on null /home/ssc/hirobolt/application/modules/penawaran/views/formprosesapproval.php 214
ERROR - 2024-09-11 19:01:06 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-11 19:01:06 --> 404 Page Not Found: /index
ERROR - 2024-09-11 21:03:59 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-11 21:04:00 --> 404 Page Not Found: /index
ERROR - 2024-09-11 21:17:59 --> Severity: Notice --> Use of undefined constant php - assumed 'php' /home/ssc/hirobolt/application/modules/users/views/login_animate.php 6
ERROR - 2024-09-11 21:18:00 --> 404 Page Not Found: /index
ERROR - 2024-09-11 21:25:11 --> Query error: Unknown column 'b.name_customer' in 'field list' - Invalid query: SELECT `a`.*, `b`.`name_customer` as `name_customer`
FROM `tr_penawaran` `a`
JOIN `master_customers` `b` ON `b`.`id_customer`=`a`.`id_customer`
WHERE `a`.`status` = '1'
ORDER BY `a`.`no_penawaran` DESC
ERROR - 2024-09-11 21:29:05 --> Severity: Error --> Class 'Penawaran_model' not found /home/ssc/hirobolt/application/third_party/MX/Loader.php 228
ERROR - 2024-09-11 21:31:22 --> Severity: Warning --> implode(): Invalid arguments passed /home/ssc/hirobolt/application/modules/incoming_stok/controllers/Incoming_stok.php 499
ERROR - 2024-09-11 21:38:53 --> Severity: Warning --> implode(): Invalid arguments passed /home/ssc/hirobolt/application/modules/incoming_stok/controllers/Incoming_stok.php 499
ERROR - 2024-09-11 21:45:10 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/purchase_order/views/add_purchaseorder.php 27
ERROR - 2024-09-11 22:26:26 --> Severity: Notice --> Undefined index: tanda /home/ssc/hirobolt/application/modules/app_pr_stock/models/App_pr_stock_model.php 43
ERROR - 2024-09-11 22:26:26 --> Severity: Notice --> Undefined index: tanda /home/ssc/hirobolt/application/modules/app_pr_stock/models/App_pr_stock_model.php 72
ERROR - 2024-09-11 22:26:26 --> Severity: Notice --> Undefined index: tanda /home/ssc/hirobolt/application/modules/app_pr_stock/models/App_pr_stock_model.php 75
ERROR - 2024-09-11 22:26:26 --> Severity: Notice --> Undefined index: tanda /home/ssc/hirobolt/application/modules/app_pr_stock/models/App_pr_stock_model.php 72
ERROR - 2024-09-11 22:26:26 --> Severity: Notice --> Undefined index: tanda /home/ssc/hirobolt/application/modules/app_pr_stock/models/App_pr_stock_model.php 75
ERROR - 2024-09-11 22:26:31 --> Severity: Notice --> Undefined index: tanda /home/ssc/hirobolt/application/modules/app_pr_stock/models/App_pr_stock_model.php 43
ERROR - 2024-09-11 22:26:31 --> Severity: Notice --> Undefined index: tanda /home/ssc/hirobolt/application/modules/app_pr_stock/models/App_pr_stock_model.php 72
ERROR - 2024-09-11 22:26:31 --> Severity: Notice --> Undefined index: tanda /home/ssc/hirobolt/application/modules/app_pr_stock/models/App_pr_stock_model.php 75
ERROR - 2024-09-11 22:26:31 --> Severity: Notice --> Undefined index: tanda /home/ssc/hirobolt/application/modules/app_pr_stock/models/App_pr_stock_model.php 72
ERROR - 2024-09-11 22:26:31 --> Severity: Notice --> Undefined index: tanda /home/ssc/hirobolt/application/modules/app_pr_stock/models/App_pr_stock_model.php 75
ERROR - 2024-09-11 22:37:17 --> Severity: Parsing Error --> syntax error, unexpected '"' class='btn btn-sm btn-warni' (T_CONSTANT_ENCAPSED_STRING) /home/ssc/hirobolt/application/modules/app_pr_stock/models/App_pr_stock_model.php 132
ERROR - 2024-09-11 22:40:44 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/purchase_order/views/add_purchaseorder.php 27
ERROR - 2024-09-11 22:43:13 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/purchase_order/views/view.php 27
ERROR - 2024-09-11 22:43:39 --> Severity: Notice --> Undefined index: param /home/ssc/hirobolt/application/modules/approval_po/views/approval_po.php 10
ERROR - 2024-09-11 22:43:39 --> Severity: Warning --> implode(): Invalid arguments passed /home/ssc/hirobolt/application/modules/approval_po/views/approval_po.php 10
ERROR - 2024-09-11 22:43:39 --> Severity: Notice --> Undefined index: supplier /home/ssc/hirobolt/application/modules/approval_po/views/approval_po.php 27
ERROR - 2024-09-11 22:43:39 --> Severity: Warning --> Invalid argument supplied for foreach() /home/ssc/hirobolt/application/modules/approval_po/views/approval_po.php 27
ERROR - 2024-09-11 22:45:33 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '= b.id = 950' at line 1 - Invalid query: SELECT a.id AS id, a.stok AS stok FROM ms_inventory_category3 a JOIN accessories b ON b.id_stock = a.sku_varian WHERE = b.id = 950
ERROR - 2024-09-11 22:45:46 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '= b.id = 950' at line 1 - Invalid query: SELECT a.id AS id, a.stok AS stok FROM ms_inventory_category3 a JOIN accessories b ON b.id_stock = a.sku_varian WHERE = b.id = 950
ERROR - 2024-09-11 22:57:37 --> Severity: Error --> Cannot use object of type stdClass as array /home/ssc/hirobolt/application/modules/incoming_stok/views/detail.php 77
ERROR - 2024-09-11 23:00:53 --> Severity: Error --> Cannot use object of type stdClass as array /home/ssc/hirobolt/application/modules/incoming_stok/views/detail.php 77
ERROR - 2024-09-11 23:01:09 --> Severity: Error --> Cannot use object of type stdClass as array /home/ssc/hirobolt/application/modules/incoming_stok/views/detail.php 77
ERROR - 2024-09-11 23:13:48 --> Query error: Unknown column 'a.id_material' in 'field list' - Invalid query: SELECT `a`.`id_material`, `a`.`qty_stock`, `a`.`qty_booking`, `b`.`konversi`
FROM `warehouse_adjustment` `a`
JOIN `accessories` `b` ON `a`.`id_material`=`b`.`id`
WHERE `a`.`id_gudang_ke` = '2'
