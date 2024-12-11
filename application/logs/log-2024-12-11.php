<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-12-11 03:44:06 --> 404 Page Not Found: /index
ERROR - 2024-12-11 10:32:53 --> Severity: Error --> Cannot use object of type stdClass as array C:\xampp_5_6\htdocs\hrobolt\application\modules\master_warehouse\controllers\Master_warehouse.php 141
ERROR - 2024-12-11 10:33:59 --> Severity: Error --> Cannot use object of type stdClass as array C:\xampp_5_6\htdocs\hrobolt\application\modules\master_warehouse\controllers\Master_warehouse.php 141
ERROR - 2024-12-11 10:34:36 --> Severity: Error --> Cannot use object of type stdClass as array C:\xampp_5_6\htdocs\hrobolt\application\modules\master_warehouse\controllers\Master_warehouse.php 141
ERROR - 2024-12-11 10:34:48 --> Severity: Error --> Cannot use object of type stdClass as array C:\xampp_5_6\htdocs\hrobolt\application\modules\master_warehouse\controllers\Master_warehouse.php 141
ERROR - 2024-12-11 10:55:50 --> 404 Page Not Found: ../modules/master_warehouse/controllers/Master_warehouse/updateWarehouse
ERROR - 2024-12-11 10:56:01 --> 404 Page Not Found: ../modules/master_warehouse/controllers/Master_warehouse/updateWarehouse
ERROR - 2024-12-11 10:57:50 --> 404 Page Not Found: ../modules/master_warehouse/controllers/Master_warehouse/updateWarehouse
ERROR - 2024-12-11 15:15:01 --> Query error: The user specified as a definer ('root'@'%') does not exist - Invalid query: SELECT
				SUM(a.nilai_asset) AS total_aset,
				SUM(a.`value`) AS total_susut,
				SUM(b.sisa_nilai) AS total_sisa
			FROM
				asset a LEFT JOIN asset_nilai b ON a.kd_asset = b.kd_asset
			WHERE 1=1
				AND a.deleted = 'N'
				
				
				AND (
				a.nm_asset LIKE '%%'
				OR a.category LIKE '%%'
	        )
ERROR - 2024-12-11 16:47:18 --> Query error: BIGINT UNSIGNED value is out of range in '(cast(`hirobolt`.`app_parameter`.`value` as unsigned) - 1)' - Invalid query: UPDATE app_parameter SET VALUE=RIGHT(CONCAT('0',CAST(VALUE AS UNSIGNED)-1),1) WHERE CODE='JP'
ERROR - 2024-12-11 16:50:57 --> Query error: BIGINT UNSIGNED value is out of range in '(cast(`hirobolt`.`app_parameter`.`value` as unsigned) - 1)' - Invalid query: UPDATE app_parameter SET VALUE=RIGHT(CONCAT('0',CAST(VALUE AS UNSIGNED)-1),1) WHERE CODE='JP'
ERROR - 2024-12-11 16:54:40 --> Query error: BIGINT UNSIGNED value is out of range in '(cast(`hirobolt`.`app_parameter`.`value` as unsigned) - 1)' - Invalid query: UPDATE app_parameter SET VALUE=RIGHT(CONCAT('0',CAST(VALUE AS UNSIGNED)-1),1) WHERE CODE='JP'
