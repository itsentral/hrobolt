
<style>
    #tables td, th {
		border: 1px solid grey;
        padding: 0 px;
		font-size: 12px;
		border-collapse: collapse;
    } 
	.clearth{
		border: 0px;
		border-collapse: collapse; 
	}
</style>
<page backtop="40mm" backbottom="7mm">
	<page_header>
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
	</page_header>
	<page_footer>
		<table style="width: 100%; border: solid 1px black;">
            <tr>
                <td style="text-align: left;    width: 50%">HiroBolt</td>
                <td style="text-align: right;    width: 50%">page [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
	</page_footer>

<?php
	foreach($header as $header){
	} 
?>

	<table border="0" width='100%' align="left">
		<tr>
			<td width="350" align="left">
			<table>
				<tr>
					<?php if($header->no_revisi != null){ ?>
						<td align='left'>No</td><td align='left'>:</td><td align='left'><?= $header->no_revisi ?></td>
					<?php } else {?>
						<td align='left'>No</td><td align='left'>:</td><td align='left'><?= $header->no_surat ?></td>
						<?php } ?>
					
						<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td align='right'>Jakarta, <?= date('d F Y') ?></td>
				</tr>
				<?php if($header->revisi !='0'){ ?>
				<tr><td align='left'>Revisi</td><td align='left'>:</td><td align='left'><?=$header->revisi?></td></tr>
				<?php }?>
			</table>
			</td>	
		</tr>
	<?php
		$customer =$this->db->query("SELECT * FROM master_customers WHERE id_customer='$header->id_customer'")->row();
		$user = $this->db->query("SELECT * FROM users WHERE id_user = '$header->id_sales'")->row();
		$sales =$this->db->query("SELECT * FROM ms_employee WHERE id = '$user->employee_id'")->row();
		$pic =$this->db->query("SELECT * FROM child_customer_pic WHERE id_customer='$header->id_customer'")->row();
	?>
		<tr>
			<td width="350" align="left"><br><br>
				<table>
					<tr><td align='left'>Kepada Yth.</td></tr>
					<tr><td align='left'>Bpk/Ibu.&nbsp;<?=$header->pic_customer?></td></tr>
					<tr><td align='left'><?=$customer->nm_customer?></td></tr>
					<tr><td align='left' width="250"><?=$customer->alamat?></td></tr>
					<tr><td align='left'><?=$customer->zip_code?></td></tr>
				</table>
			</td>
		</tr>
		<tr>
			<td width="350" align="left">
				<table>
					<tr>
						<td align='left'>Perihal</td><td align='left'>:</td><td align='left'>Penawaran Harga</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
			<table>
				<tr><td align='left'>Dengan Hormat,</td></tr>
				<tr><td align='left'>Kami mengucapkan terima kasih atas minat Bapak/Ibu pada produk kami. Dan Bersama surat ini, dengan 
				senang hati kami mengirimkan penawaran harga sebagai berikut : </td></tr>
				<tr><td align='left'></td></tr>
			</table>
			</td>	
		</tr>
	</table>

<br>

    <table id="tables" border="1" width='100%' align="center">
		<thead>
			<tr height = '60'>
				<th align="centet" width="20">No.</th>
				<th align="center" width="100">Nama Produk</th>
				<th align="center" width="100">Spec</th>
				<th align="center" width="50">Qty (set)</th>
				<th align="center" width="50">Price/Unit</th>
				<th align="center" width="70">Price</th>
				<?php if ($isDiscount) { ?>
				<th align="center" width="50">Discount</th>
				<th align="center" width="50">Price Discount</th>
				<?php } ?>
				<th align="center" width="50">Total</th>
			</tr>
		</thead>    
		<tbody>
			<?	foreach($detail as $key => $detail){
			?>
			<tr>
				<td align="center"><?= ++$key; ?>.</td>
				<td align="left" style="padding: 10px;" width="100"><?= $detail->name ?></td>
				<td align="center" width="100">
					Panjang: <?= $detail->panjang ?> <br>
					Grade: <?= $detail->grade ?> <br>
					Merk: <?= $detail->merk ?> <br>
					Diameter: <?= $detail->diameter ?> <br>
				</td>
				<td align="center" style="padding: 5px;" width="50"><?= number_format($detail->qty) ?></td>
				<td align="right" style="padding: 5px;" width="50"><?= number_format(round($detail->harga_satuan), 0, '.', ',') ?></td>
				<td align="right" style="padding: 5px;" width="50"><?= number_format(round($detail->qty * $detail->harga_satuan),  0, '.', ',') ?></td>
				<?php if ($isDiscount) { ?>
				<td align="right" style="padding: 5px;" width="50"><?= number_format($detail->diskon,1) ?>%</td>
					<?php if ($detail->nilai_diskon == 0)  { 
						$nilaiDiskon = ($detail->diskon * $detail->total_harga) / 100;	
					?>
						<td align="right" style="padding: 5px;" width="50"><?= number_format($nilaiDiskon,1) ?></td>
					<?php } else { ?>
						<td align="right" style="padding: 5px;" width="50"><?= number_format($detail->nilai_diskon,1) ?></td>
					<?php } ?>
				<?php } ?>
				<td align="right" style="padding: 5px;" width="50"><?= number_format(round($detail->total_harga),  0, '.', ',') ?></td>
			</tr>
			<?}?>
			<tr>
				<th align="center" colspan=<?= ($isDiscount) ? "7" : "5" ?> width="300" align='right'>Total</th>
				<th></th>
				<th align="right" width="80"><?= number_format(round($header->nilai_penawaran), 0, '.', ',') ?></th>
			</tr>
			<tr>
				<th align="center" colspan="<?= ($isDiscount) ? "7" : "5" ?>" width="300" align='right'>PPN</th>
				<th  align="right"><?= $header->ppn ?>%</th>
				<th align="right" width="80"><?= number_format(round($header->nilai_ppn), 0, '.', ',') ?></th>
			</tr>
			<tr>
				<th align="right" colspan="<?= ($isDiscount) ? "7" : "5" ?>" width="300" align='right'>Grand Total</th>
				<th></th>
				<th align="right" width="80"><?= number_format(round($header->grand_total), 0, '.', ',') ?></th>
			</tr>
		</tbody>
		<!-- <tfoot>
			
		</tfoot>	 -->
	</table>


	<table border="0" width='100%' align="left">
		<tr>
			<td width="350" align="left"><br><br>
				<table>
					<tr><td align='left'>Dengan Kondisi :</td></tr>
					<?= ($pernyataan['pernyataan1'] == "") ? "" : "<tr><td align='right'>-</td><td>" . $pernyataan['pernyataan1'] . "</td></tr>"?>
					<?= ($pernyataan['pernyataan2'] == "") ? "" : "<tr><td align='right'>-</td><td>" . $pernyataan['pernyataan2'] . "</td></tr>"?>
					<?= ($pernyataan['pernyataan3'] == "") ? "" : "<tr><td align='right'>-</td><td>" . $pernyataan['pernyataan3'] . "</td></tr>"?>
					<?= ($pernyataan['pernyataan4'] == "") ? "" : "<tr><td align='right'>-</td><td>" . $pernyataan['pernyataan4'] . "</td></tr>"?>
					<?= ($pernyataan['pernyataan5'] == "") ? "" : "<tr><td align='right'>-</td><td>" . $pernyataan['pernyataan5'] . "</td></tr>"?>
					<?= ($pernyataan['pernyataan6'] == "") ? "" : "<tr><td align='right'>-</td><td>" . $pernyataan['pernyataan6'] . "</td></tr>"?>
				</table>
				<br><br>
				<table>
					<tr><td align='left'>Demikian penawaran ini kami sampaikan, apabila Bapak/Ibu membutuhkan informasi lebih lanjut silahkan 
						menghubungi Direct Sales kami (0811-9159-985).</td></tr>
					<tr><td align='left'></td></tr>
				</table>
			</td>
		</tr>
	</table>

	<table border="0" width='100%' align="left">
		<tr>
		
			<td width="300" align="left"><br><br>
				<table>
					<tr><td align='left'>Hormat kami, <br>PT. Sinar Jaya Teknindo</td></tr>
					<tr>
						<td align="center"width="70%" valign="top" >
						<?php if($sales->tanda_tangan) { ?>
							<img src='<?=$_SERVER['DOCUMENT_ROOT'];?>hirobolt/<?=$sales->tanda_tangan?>' alt="" height='80' width='100'>
						<?php } else { ?>
							<br>
							<br>
							<br>
							<br>
						<?php } ?>
						</td>
					</tr>
					<tr><td align='left'><u><?=$header->nama_sales?></u> </td></tr>
					<!-- <tr><td align='left'><?=$sales->nohp?></td></tr>	 -->
				</table>
			</td>
			<td width="230" align="left"><br><br>
				<!-- <?php if($header->approved_by != null){ ?>
				<table>
					<tr><td align='center'>Mengetahui</td></tr>
					<tr><td align="center"width="70%" valign="top" >
					<img src='<?=$_SERVER['DOCUMENT_ROOT'];?>watercosystem/assets/files/tandatangan/Cap_Waterco_dan_ttd_-_Fajar.png' alt="" height='80' width='100'>
					</td></tr>
					<tr><td align='center'><u>Fajar Nugroho Widyanto</u></td></tr>
					<tr><td align='center'>General Manager</td></tr>	
				</table>
				<?php }?> -->
			</td>
			<td width="300" align="left"><br><br>
				<table>
					<br>
					<tr><td align='left'>Mengetahui,</td></tr>
					<tr>
						<td align="center"width="70%" valign="top" >
						<?php if($marketing_manager->tanda_tangan) { ?>
							<img src='<?=$_SERVER['DOCUMENT_ROOT'];?>hirobolt/<?=$marketing_manager->tanda_tangan?>' alt="" height='80' width='100'>
						<?php } else { ?>
							<br>
							<br>
							<br>
							<br>
						<?php } ?>
						</td>
					</tr>
					<tr>
						<td align='left'>
							<u><?= strtoupper($marketing_manager->nm_karyawan) ?></u>
							<br>
							<?= $marketing_manager->role ?>
						</td>
					</tr>	
				</table>
			</td>
		</tr>
	</table>
</page>