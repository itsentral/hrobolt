<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2024-12-24 03:44:08 --> 404 Page Not Found: /index
ERROR - 2024-12-24 08:25:40 --> 404 Page Not Found: /index
ERROR - 2024-12-24 08:29:37 --> 404 Page Not Found: /index
ERROR - 2024-12-24 08:33:56 --> 404 Page Not Found: /index
ERROR - 2024-12-24 08:33:58 --> 404 Page Not Found: /index
ERROR - 2024-12-24 08:33:58 --> 404 Page Not Found: /index
ERROR - 2024-12-24 08:34:48 --> 404 Page Not Found: /index
ERROR - 2024-12-24 14:41:37 --> Severity: Warning --> mysqli::real_connect(): (HY000/1045): Access denied for user 'appsystem'@'localhost' (using password: YES) C:\xampp_5_6\htdocs\hrobolt\system\database\drivers\mysqli\mysqli_driver.php 211
ERROR - 2024-12-24 14:41:37 --> Unable to connect to the database
ERROR - 2024-12-24 14:47:10 --> Severity: Warning --> mysqli::real_connect(): (HY000/1049): Unknown database 'hirobolt_dev' C:\xampp_5_6\htdocs\hrobolt\system\database\drivers\mysqli\mysqli_driver.php 211
ERROR - 2024-12-24 14:47:10 --> Unable to connect to the database
ERROR - 2024-12-24 08:53:48 --> 404 Page Not Found: /index
ERROR - 2024-12-24 14:53:54 --> Query error: The user specified as a definer ('root'@'%') does not exist - Invalid query: SELECT
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
ERROR - 2024-12-24 08:56:33 --> 404 Page Not Found: /index
ERROR - 2024-12-24 09:20:51 --> 404 Page Not Found: /index
ERROR - 2024-12-24 15:20:55 --> Query error: The user specified as a definer ('root'@'%') does not exist - Invalid query: SELECT
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
