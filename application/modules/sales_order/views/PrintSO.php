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
<h3 align="center">SALES ORDER</h3>
<?php
$customer =$this->db->query("SELECT * FROM master_customers WHERE id_customer='$header->id_customer'")->row();
$sales =$this->db->query("SELECT u.*, me.tanda_tangan FROM users u JOIN ms_employee me ON me.id = u.employee_id WHERE u.id_user='$header->id_sales'")->row();
$top =$this->db->query("SELECT * FROM list_help WHERE id='$header->top'")->row();
?>
<table border="0" width='100%' align="center">
	<tr>
		<td width="650" align="left">
			<table>
				<tr>
					<td align="left">
						<table border="0" width='20%' align="left">
							<tr>
								<td align='left'>Order By</td><td align='left'>:</td><td align='left' width="150"><?=$customer->nm_customer?></td>
							</tr>
							<tr>
								<td align='left'></td><td align='left'></td><td align='left' width="150"><?=$customer->alamat?></td>
							</tr>
						</table>
					</td>
					
					<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td align='right'>SO Date</td><td align='left'>:</td><td align='left'><?= date('d-F-Y', strtotime($header->tgl_so)) ?></td>
				</tr>

				<tr>
					<td align="left">
						<table border="0" width='20%' align="left">
							
						</table>
					</td>
					<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td align='right'>SO No.</td><td align='left'>:</td><td align='left'><?= $header->no_surat ?></td>
				</tr>
				
				<tr>
					<td align="left">
						<table border="0" width='20%' align="left">
							<tr>
								<td align='left' width="">PIC</td><td align='left'>:</td><td align='left'><?= $header->pic ?></td>
							</tr>
							<!-- <tr>
								<td align='left'></td><td align='left'></td><td align='left' width="150"><?=$customer->alamat?></td>
							</tr> -->
						</table>
					</td>
					
					<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td align='left'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td align='left'>No. Penawaran</td><td align='left'>:</td><td align='left'><?= $header->nomor_penawaran ?></td>
				</tr>
			</table>
		</td>	
	</tr>
</table>
<br>

    <table id="tables" border="1" width='100%' align="center">
		<thead>
			<tr height='160'>
				<th align="center" width="30">No</th>	
				<th align="center" width="90">Kode</th>	
				<th align="center" width="400">Product</th>
				<th align="center" width="50" colspan="2">Quantity</th>
			</tr>
			<tr></tr>
		</thead>    
		<tbody>
				<?	
					$no=0; 
					
					foreach($detail as $detail) {
						$product = $this->db->query("SELECT nama, sku_varian FROM ms_inventory_category3 WHERE id='$detail->id_category3'")->row();
						
						$no++;
				?>
					<tr>
						<td align="center">&nbsp;<?= $no ?></td>
						<td align="left">&nbsp;<?= $product->sku_varian ?></td>
						<td align="left">&nbsp;<?= $product->nama ?></td>
						<td align="center"><?= number_format($detail->qty_so) ?></td>
						<td align="center">Set</td>			
					</tr>
				<?}?>
		</tbody>
	</table>


	<table border="0" width='100%' align="center">
		<tr>
			<td width="350" align="left"><br><br>
				<table>
					<tr><td align='center'>Pembuat Sales Order</td></tr>
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
					<tr><td align='center'><u><?=$header->nama_sales?></u></td></tr>
					<!-- <tr><td align='center'>Account Handler</td></tr>	 -->
				</table>
			</td>
			<td width="250" align="left"><br><br>
				<table>
					<tr><td align='center'></td></tr>
					<tr><td align="center"width="70%" valign="top"></td></tr>
					<tr><td align='center'></td></tr>
					<tr><td align='center'></td></tr>		
				</table>
			</td>
			<td width="250" align="left"><br><br>
				<table>
					<tr><td align='center'>Warehouse</td></tr>
					<tr>
						<td align="center"width="70%" valign="top" >
							<br>
							<br>
							<br>
							<br>
						</td>
					</tr>
					<tr><td align='center'><hr></td></tr>
				<!-- <tr><td align='center'>Account Handler</td></tr>	 -->
				</table>
			</td>
		</tr>
	</table>
</page>