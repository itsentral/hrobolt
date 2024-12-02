<page backtop="50mm" backbottom="7mm">
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

    <table class='gridtable2' border='0' width='100%' cellpadding='2' style='margin-left:20px;margin-right:20px;margin-bottom: 20px;'>
        <tr>
            <td style="font-size: 14px;">
                <strong>Alamat Pengiriman:</strong>
            </td>
            <td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td align="left">Tanggal SJ</td><td>: <?= date('d F Y') ?></td>
        </tr>
		<tr>
			<td style="font-size: 14px;">
				<strong><?= $getData2['nm_customer'] ?></strong>
			</td>
			<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td align="left">No. Surat Jalan</td><td>: <?= $no_surat_jalan ?></td>
		</tr>
		<tr>
			<td style="font-size: 14px;">
				
			</td>
			<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td align="left">No. Penawaran</td><td>: <?= $getData2['no_surat_penawaran'] ?></td>
		</tr>
		<tr>
			<td style="font-size: 14px;">
				<?php $countStringAlamat = strlen($getData2['delivery_address']); ?>
				<strong>
					<?= substr($getData2['delivery_address'], 0, 50); ?> <br>
					<?= substr($getData2['delivery_address'], 50, 100); ?> <br>
					<?php if ($countStringAlamat > 100) { ?>
					<?= substr($getData2['delivery_address'], 100, 150); ?> <br>
					<?= substr($getData2['delivery_address'], 150, 200); ?> <br>
					<?php } ?>
				</strong>
			</td>
			<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td align="left">No. Sales Order</td><td>: <?= $getData2['no_surat_so'] ?></td>
		</tr>
        <tr>
			<td style="font-size: 14px;">
				<strong>PIC : <?= $getData2['pic'] ?></strong>
			</td>
		</tr>
    </table>

    <!-- <h3 style="text-align: center"><u>SURAT JALAN</u></h3> -->
    <table width='100%' border='1' cellpadding='0' cellspacing='0' style='margin-top: 20px; margin-left:20px;margin-right:20px; font-size: 11px;'>
        <tr>
            <th width='25' align='center'>No. </th>
            <th width='100' align="center">Kode Barang</th>
            <th align='center' width="250">Nama Barang</th>
            <th align='center' width="70">Jumlah Barang</th>
            <th width='70' align='center'>Keterangan</th>
        </tr>
        <?php
			$dataTotalQty = 0;
            foreach ($getDataDetail as $key => $value) { $key++;
				$dataTotalQty += $value['qty_delivery'];
                echo "<tr>";
                    echo "<td align='center'>".$key." </td>";
                    echo "<td align='center'>".$value['barcode_sku']."</td>";
                    echo "<td style='padding: 5px'>".$value['nm_product']."</td>";
                    echo "<td align='center'>".number_format($value['qty_delivery'])." Set</td>";
                    echo "<td align='center'></td>";
                echo "</tr>";
            }
        ?>
		<tr>
			<td colspan="3" align="center"><strong>Total</strong></td>
			<td align="center"><strong><?= $dataTotalQty ?> Set</strong></td>
			<td></td>
		</tr>
    </table><br><br><br>

    <table style="margin-left: 20px">
        <tr>
            <td><strong>Jakarta, <?= date('d F Y') ?></strong></td>
        </tr>
    </table>

    <br><br>
    
    <table align="left" style="margin-left: 20px">
        <tr>
            <td>Gudang</td>
            <td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td align='left'>&nbsp;&nbsp;&nbsp;</td>
			<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td align='left'>&nbsp;&nbsp;&nbsp;</td>
            <td style="margin-left: 10px">Driver</td>
            <td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td style="margin-left: 10px">Penerima</td>
        </tr>
    </table>

    <br><br><br><br>

    <table align="left" style="margin-left: 20px">
        <tr>
            <td>..........</td>
            <td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td align='left'>&nbsp;&nbsp;&nbsp;</td>
			<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>..........</td>
            <td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>..........</td>
        </tr>
    </table>
</page>

<style type="text/css">
    .text-bold{
        font-weight: bold;
    }
    .bold{
        font-weight: bold;
    }
    .header_style_company{
        padding: 15px;
        color: black;
        font-size: 20px;
    }
    .header_style_company2{
        padding-bottom: 10px;
        color: black;
        font-size: 16px;
        /* vertical-align: bottom; */
    }
    .header_style_alamat{
        padding: 10px;
        color: black;
        font-size: 11px;
        vertical-align: top !important;
    }
    p{
        /* font-family: verdana,arial,sans-serif; */
        font-size:11px;
        padding: 0px;
    }
    
    table.gridtable {
        /* font-family: verdana,arial,sans-serif; */
        font-size: 10px;
        border-collapse: collapse;
    }
    table.gridtable th {
        padding: 3px;
    }
    table.gridtable th.head {
        padding: 3px;
    }
    table.gridtable td {
        padding: 3px;
    }
    table.gridtable td.cols {
        padding: 3px;
    }

    table.gridtable2 {
        /* font-family: verdana,arial,sans-serif; */
        font-size:11px;
        color:#000000;
        border-collapse: collapse;
    }
    table.gridtable2 th {
        padding: 1px;
    }
    table.gridtable2 th.head {
        padding: 1px;
    }
    table.gridtable2 td {
        border-width: 1px;
        padding: 1px;
    }
    table.gridtable2 td.cols {
        padding: 1px;
    }
    
    table.gridtable4 {
        /* font-family: verdana,arial,sans-serif; */
        font-size:12px;
        color:#000000;
    }
    table.gridtable4 td {
        padding: 1px;
        border-color: #dddddd;
    }
    table.gridtable4 td.cols {
        padding: 1px;
    }

    table.gridtable5 {
        /* font-family: verdana,arial,sans-serif; */
        font-size:8px;
        color:#000000;
    }
    table.gridtable5 td {
        padding: 1px;
        border-color: #dddddd;
    }
    table.gridtable5 td.cols {
        padding: 1px;
    }
</style>
