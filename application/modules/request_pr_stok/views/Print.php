<html>

<head>
	<style type="text/css">
		.header_style_company {
			padding: 15px;
			color: black;
			font-size: 20px;
			vertical-align: bottom;
		}

		.header_style_company2 {
			padding: 15px;
			color: black;
			font-size: 15px;
			vertical-align: top;
		}

		.header_style_alamat {
			padding: 10px;
			color: black;
			font-size: 10px;
		}

		table.default {
			font-family: arial, sans-serif;
			font-size: 9px;
			padding: 0px;
		}

		p {
			font-family: arial, sans-serif;
			font-size: 14px;
		}

		.font {
			font-family: arial, sans-serif;
			font-size: 14px;
		}

		table.gridtable {
			font-family: arial, sans-serif;
			font-size: 11px;
			color: #333333;
			border: 1px solid #808080;
			border-collapse: collapse;
		}

		table.gridtable th {
			padding: 6px;
			background-color: #f7f7f7;
			color: black;
			border-color: #808080;
			border-style: solid;
			border-width: 1px;
		}

		table.gridtable th.head {
			padding: 6px;
			background-color: #f7f7f7;
			color: black;
			border-color: #808080;
			border-style: solid;
			border-width: 1px;
		}

		table.gridtable td {
			border-width: 1px;
			padding: 6px;
			border-style: solid;
			border-color: #808080;
		}

		table.gridtable td.cols {
			border-width: 1px;
			padding: 6px;
			border-style: solid;
			border-color: #808080;
		}


		table.gridtable2 {
			font-family: arial, sans-serif;
			font-size: 12px;
			color: #333333;
			border-width: 1px;
			border-color: #666666;
			border-collapse: collapse;
		}

		table.gridtable2 td {
			border-width: 1px;
			padding: 1px;
			border-style: none;
			border-color: #666666;
			background-color: #ffffff;
		}

		table.gridtable2 td.cols {
			border-width: 1px;
			padding: 1px;
			border-style: none;
			border-color: #666666;
			background-color: #ffffff;
		}

		table.gridtableX {
			font-family: arial, sans-serif;
			font-size: 12px;
			color: #333333;
			border: none;
			border-collapse: collapse;
		}

		table.gridtableX td {
			border-width: 1px;
			padding: 6px;
		}

		table.gridtableX td.cols {
			border-width: 1px;
			padding: 6px;
		}

		table.gridtableX2 {
			font-family: arial, sans-serif;
			font-size: 12px;
			color: #333333;
			border: none;
			border-collapse: collapse;
		}

		table.gridtableX2 td {
			border-width: 1px;
			padding: 2px;
		}

		table.gridtableX2 td.cols {
			border-width: 1px;
			padding: 2px;
		}

		#testtable {
			width: 100%;
		}
	</style>
</head>

<body>
	<?php
	foreach ($header as $header) {
	}
	// $detailsum = $this->db->query("SELECT SUM(width) as sumwidth, SUM(qty) as sumqty, SUM(totalwidth) as sumtotalwidth, SUM(jumlahharga) as sumjumlahharga, SUM(hargasatuan) as sumhargasatuan FROM dt_trans_po WHERE no_po = '" . $header->no_po . "' ")->result();
	// $jumlahdetail = $this->db->query("SELECT COUNT(no_po) as no_po FROM dt_trans_po WHERE no_po = '" . $header->no_po . "' ")->result();
	// $jumlahdata = $jumlahdetail[0]->no_po;
	// $tinggi = 300 / $jumlahdata;
	if (empty($header->negara)) {
		$cou = 'Indonesia';
	} else {
		// $findnegara = $this->db->query("SELECT * FROM negara WHERE id_negara = '" . $header->negara . "' ")->result();
		// $cou = $findnegara[0]->nm_negara;
	}
	// $findpic = $this->db->query("SELECT * FROM child_supplier_pic WHERE id_suplier = '" . $header->id_suplier . "' ")->result();
	// $namapic = $findpic[0]->name_pic;

	// print_r($_SERVER['DOCUMENT_ROOT'] . '/origa_live/assets/images/ori_logo.jpg');
	// exit;
	if($header->tingkat_pr == '2'){
		$tingkat_pr = 'Urgent';
	}else{
		$tingkat_pr = 'Normal';
	}
	?>
	<table border="0px" cellspacing="0" width='100%' valign="top">
		<tr>
			<td align="left"width="30%" valign="top" >
				<img src='<?=$_SERVER['DOCUMENT_ROOT'];?>hirobolt/assets/foto/LogoHiroBolt1.png' alt="" height='100' width='150px'>
			</td>
			<td align="center" valign="top" width="50%">
				<h3><strong>PT. SINAR JAYA TEKNINDO</strong></h3>
				Kantor Pusat : Tanjung Kawasan Industri Multiguna 2 BIIE <br>
				Lippo Cikarang No.7, Cibatu, Cikarang Selatan, Kab. Bekasi, Jawa Barat. <br>
				Kantor Cabang : Komplek Gading Bukit Indah Blok. I No. 22-23 <br>
				Jl. Bukit Gading Raya, Kelapa Gading Permai, RT.18/RW.8 Klp. <br>
				Gading Bar, Kec. Klp. Gading, Jkt Utara 14240 <br>
				No. Telp : 021-38879058 / 0811-9159-985 <br>
			</td>
			<td align="right" width="30%" valign="top" >
				<img src='<?=$_SERVER['DOCUMENT_ROOT'];?>hirobolt/assets/foto/LogoHiroBolt2.png' alt="" height='100' width='150px'>
			</td>
		</tr>
	</table>
	<hr>
	<div style='display:block; border-color:none; background-color:#c2c2c2;' align='center'>
		<h3>PURCHASE REQUEST </h3>
	</div>
	<br>
	<table class='gridtable2' width='100%' border='1' align='left' cellpadding='0' cellspacing='0'>
		<tr>
			<td width="300" align="center">
				<table width='300' align="center">
					<tr>
						<td width='50' align="left">Customer</td>
						<td width='10' align="left">:</td>
						<td width='250' align="left"><?= $header->nm_customer ?></td>
					</tr>
					<tr>
						<td width='50' align="left">Address</td>
						<td width='10' align="left">:</td>
						<td width='250' align="left"><?= $header->alamat ?></td>
					</tr>
					<tr>
						<td width='50' align="left">Country</td>
						<td width='10' align="left">:</td>
						<td width='250' align="left"><?= $header->country_name ?></td>
					</tr>
					<tr>
						<td width='50' align="left">PIC</td>
						<td width='10' align="left">:</td>
						<td width='250' align="left"><?= $this->auth->user_name(); ?></td>
					</tr>
					<tr>
						<td width='50' align="left">Phone</td>
						<td width='10' align="left">:</td>
						<td width='250' align="left"><?= $header->hp ?></td>
					</tr>
					<tr>
						<td width='50' align="left">Fax</td>
						<td width='10' align="left">:</td>
						<td width='250' align="left"><?= $header->fax ?></td>
					</tr>
				</table>
			</td>
			<td width="300" align="center">
				<table width='300' align="center">
					<tr>
						<td width='80' align="left">No. PR</td>
						<td width='10' align="left">:</td>
						<td width='250' align="left"><?= $header->no_pr ?></td>
					</tr>
					<tr>
						<td width='80' align="left">Date</td>
						<td width='10' align="left">:</td>
						<td width='250' align="left"><?= date('d-F-Y', strtotime($header->created_date))  ?></td>
					</tr>
					<tr>
						<td width='80' align="left">Needed Date</td>
						<td width='10' align="left">:</td>
						<td width='250' align="left"><?= date('d-F-Y', strtotime($header->tgl_dibutuhkan))  ?></td>
					</tr>
					<tr>
						<td width='80' align="left">Revision</td>
						<td width='10' align="left">:</td>
						<td width='250' align="left"><?= $header->no_rev ?></td>
					</tr>
					<tr>
						<td width='80' align="left">Page</td>
						<td width='10' align="left">:</td>
						<td width='250' align="left"></td>
					</tr>
					<tr>
						<td width='80' align="left">Tingkat PR</td>
						<td width='10' align="left">:</td>
						<td width='250' align="left"><?= $tingkat_pr ?></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<br>
	<?php
	// $matauang = (!empty($header->matauang)) ? "<br>(" . strtoupper($header->matauang) . ")" : '';

	// if (strtolower($header->matauang) == 'usd') {
	// 	$kode = '$';
	// }
	// if (strtolower($header->matauang) == 'idr') {
	// 	$kode = 'Rp';
	// }
	?>
	<table class='gridtable' cellpadding='0' width="100%" cellspacing='0' style='vertical-align:top;'>
		<tbody>
			<tr style='vertical-align:middle; background-color:#c2c2c2; font-weight:bold;'>
				<td align="center" width="30">Code</td>
				<td align="center" width="100">Description</td>
				<td align="center" width="30">Qty</td>
				<td align="center" width="30">Satuan Unit</td>
				<td align="center" width="30">Qty Pack</td>
				<td align="center" width="30">Unit Packing</td>
			</tr>
			<?php
			$CIF = "<br>" . $header->cif . "<br><br><br><br>";
			$TOT_PPH = 0;
			foreach ($detail as $detail) {
				$kategory = $detail->id_material;
				$barang  = $this->db->query("SELECT * FROM new_inventory_4 WHERE code_lv4 = '$kategory' ")->row();

				$TOT_PPH += $detail->jumlahharga * $detail->pajak / 100;
				$HS = number_format($detail->hargasatuan, 2);
				$JH = number_format($detail->jumlahharga, 2);
				if (strtolower($header->loi) == 'lokal') {
					$HS = number_format($detail->hargasatuan, 2);
					$JH = number_format($detail->jumlahharga, 2);
				}

				$qty = $detail->propose_purchase;



				if ($jumlahdata <= '30') {
					if ($qty > 0) {
						echo "	
							<tr >
								<td style='text-align: center;'>" . $detail->code . "</td>
								<td style='min-width: 100px; max-width: 200px;'>" . $detail->nama . "</td>
								<td style='text-align: center;'>" . number_format($qty * $detail->konversi, 2) . "</td>
								<td style='text-align: center;'>" . $detail->satuan . "</td>
								<td style='text-align: center;'>" . number_format($qty, 2) . "</td>
								<td style='text-align: center;'>" . $detail->satuan_packing . "</td>
							</tr>";
					}
					$CIF = "";
				} else {
					if ($qty > 0) {
						echo "	
							<tr >
								<td style='text-align: center;'>" . $detail->code . "</td>
								<td style='min-width: 100px; max-width: 200px;'>" . $detail->nama . "</td>
								<td style='text-align: center;'>" . number_format($qty * $detail->konversi, 2) . "</td>
								<td style='text-align: center;'>" . $detail->satuan . "</td>
								<td style='text-align: center;'>" . number_format($qty, 2) . "</td>
								<td style='text-align: center;'>" . $detail->satuan_packing . "</td>
							</tr>";
					}
					$CIF = "";
				}
			} ?>

			<?php
			if ($header->loi == 'Lokal') {
			?>

			<?php
			}
			if ($header->loi == 'Import') {
				$TOT_PPH = 0;
			}

			$TOTHEAD = number_format($detailsum[0]->sumjumlahharga + $TOT_PPH, 2);
			if (strtolower($header->loi) == 'lokal') {
				$TOTHEAD = number_format($detailsum[0]->sumjumlahharga + $TOT_PPH, 2);
			}
			?>


		</tbody>
	</table>
	<br>

	<table border="0" width='100%' align="left">

		<tr>

			<td width="250" align="left"><br><br>
				<table>
					<tr>
						<td align='center'></td>
					</tr>
					<tr>
						<td align='right'></td>
					</tr>
					<tr>
						<td align='right'></td>
					</tr>
					<tr>
						<td align='right'></td>
					</tr>
					<tr>
						<td align='right'></td>
					</tr>
					<tr>
						<td align='right'></td>
					</tr>
					<tr>
						<td align='right'></td>
					</tr>
					<tr>
						<td align='right'></td>
					</tr>
					<tr>
						<td align='right'></td>
					</tr>
					<tr>
						<td align='right'></td>
					</tr>
					<tr>
						<td align='right'></td>
					</tr>
					<tr>
						<td align='right'></td>
					</tr>
					<tr>
						<td align='right'></td>
					</tr>
					<tr>
						<td align='right'></td>
					</tr>
					<tr>
						<td align='right'></td>
					</tr>
					<tr>
						<td align='right'></td>
					</tr>
					<tr>
						<td align='right'>(Cost Control)</td>
					</tr>
				</table>
			</td>
			<td width="250" align="left"><br><br>
				<table>
					<tr>
						<td align='center'></td>
					</tr>
					<tr>
						<td align='right'></td>
					</tr>
					<tr>
						<td align='right'></td>
					</tr>
					<tr>
						<td align='right'></td>
					</tr>
					<tr>
						<td align='right'></td>
					</tr>
					<tr>
						<td align='right'></td>
					</tr>
					<tr>
						<td align='right'></td>
					</tr>
					<tr>
						<td align='right'></td>
					</tr>
					<tr>
						<td align='right'></td>
					</tr>
					<tr>
						<td align='right'></td>
					</tr>
					<tr>
						<td align='right'></td>
					</tr>
					<tr>
						<td align='right'></td>
					</tr>
					<tr>
						<td align='right'></td>
					</tr>
					<tr>
						<td align='right'></td>
					</tr>
					<tr>
						<td align='right'></td>
					</tr>
					<tr>
						<td align='right'></td>
					</tr>
					<tr>
						<td align='center'>(Dept Head)</td>
					</tr>
				</table>
			</td>
			<td width="250" align="left"><br><br>
				<table>
					<tr>
						<td align='center'></td>
					</tr>
					<tr>
						<td align='right'></td>
					</tr>
					<tr>
						<td align='right'></td>
					</tr>
					<tr>
						<td align='right'></td>
					</tr>
					<tr>
						<td align='right'></td>
					</tr>
					<tr>
						<td align='right'></td>
					</tr>
					<tr>
						<td align='right'></td>
					</tr>
					<tr>
						<td align='right'></td>
					</tr>
					<tr>
						<td align='right'></td>
					</tr>
					<tr>
						<td align='right'></td>
					</tr>
					<tr>
						<td align='right'></td>
					</tr>
					<tr>
						<td align='right'></td>
					</tr>
					<tr>
						<td align='right'></td>
					</tr>
					<tr>
						<td align='right'></td>
					</tr>
					<tr>
						<td align='right'></td>
					</tr>
					<tr>
						<td align='right'></td>
					</tr>
					<tr>
						<td align='center'>(<?= $this->auth->user_name() ?>)</td>
					</tr>
				</table>

			</td>
		</tr>
	</table>



</body>

</html>