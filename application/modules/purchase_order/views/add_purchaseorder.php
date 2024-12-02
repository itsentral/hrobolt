<?php
$ENABLE_ADD     = has_permission('Purchase_Request.Add');
$ENABLE_MANAGE  = has_permission('Purchase_Request.Manage');
$ENABLE_VIEW    = has_permission('Purchase_Request.View');
$ENABLE_DELETE  = has_permission('Purchase_Request.Delete');
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" integrity="sha512-yVvxUQV0QESBt1SyZbNJMAwyKvFTLMyXSyBHDO4BG5t7k/Lw34tyqlSDlKIrIENIzCl+RVUNjmCPG+V/GMesRw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="box box-primary">
	<div class="box-body">
		<form id="data-form" method="post">
			<input type="hidden" name="so_number" value="<?= implode(',', $results['param']) ?>">
			<div class="col-sm-12">
				<div class="input_fields_wrap2">
					<div class="row">
						<center><label for="customer">
								<h3>Purchase Order</h3>
							</label></center>
						<div class="col-sm-12">
							<!-- <div class="col-sm-6">
								<div class="form-group row">
									<div class="col-md-4">
										<label for="id_customer">Supplier</label>
									</div>
									<div class="col-md-8">
										<select id="id_suplier" name="id_suplier" class='form-control input-md chosen-select' onchange="get_lokasi()" required>
											<option value="">--Pilih--</option>
											<?php foreach ($results['supplier'] as $supplier) { ?>
												<option value="<?= $supplier->id_suplier ?>"><?= strtoupper(strtolower($supplier->name_suplier)) ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
							</div> -->
							<div class="col-sm-6">
								<div class="form-group row">
									<div class="col-md-4">
										<label for="id_customer">Local / Import</label>
									</div>
									<div class="col-md-8" id="ubahloi">
										<select id="loi" name="loi" class="form-control select" onchange="get_kurs()" required>
											<option value="">--Pilih--</option>
											<option value="Import">Import</option>
											<option value="Lokal">Lokal</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group row">
									<div class="col-md-4">
										<label for="id_customer">Department</label>
									</div>
									<div class="col-md-8" id="ubahloi">
										<select id="select_department" name="dept[]" class="form-control" multiple required>
											<?php
											foreach ($results['list_department'] as $item) {
												echo '<option value="' . $item->id . '">' . strtoupper($item->nama) . '</option>';
											}
											?>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="col-sm-6">
								<div class="form-group row">
									<div class="col-md-4">
										<label for="customer">No. Po</label>
									</div>
									<div class="col-md-8">
										<input type="text" class="form-control" id="no_po" required name="no_po" readonly placeholder="ID PO">
										<input type="hidden" class="form-control" id="no_surat" required name="no_surat" readonly placeholder="No.PO">
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group row">
									<div class="col-md-4">
										<label for="customer">Delivery Date</label>
									</div>
									<div class="col-md-8">
										<input type="date" name="delivery_date" id="" class="form-control" required>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="col-sm-6">
								<div class="form-group row">
									<div class="col-md-4">
										<label for="customer">Tanggal PO</label>
									</div>
									<div class="col-md-8">
										<input type="text" class="form-control" id="tanggal" value="<?= $tanggal ?>" onkeyup required name="tanggal">
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group row">
									<div class="col-md-4">
										<label for="id_customer">Currency</label>
									</div>
									<div class="col-md-8">
										<select id="select_curr" name="matauang" class='form-control input-md' required>
											<option value="">- Currency -</option>
											<?php foreach ($results['mata_uang'] as $mata_uang) {
												$selected = '';
											?>
												<option value="<?= $mata_uang->kode ?>" <?= $selected; ?>><?= strtoupper(strtolower($mata_uang->kode)) ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
							</div>
						</div>
						<!-- <div class="col-sm-12">
			<div class="col-sm-6">
			<div class="form-group row">
				<div class="col-md-4">
					<label for="customer">Expect Date</label>
				</div>
				<div class="col-md-8">
					<input type="date" class="form-control" id="expect_tanggal" required name="expect_tanggal"  >
				</div>
			</div>
			</div>
			</div> -->
						<div class="col-sm-12">
							<div class="col-sm-6">
								<div class="form-group row">
									<div class="col-md-4">
										<label for="customer">Payment Term</label>
									</div>
									<div class="col-md-8">
										<input type="text" class="form-control" id="term" onkeyup required name="term">
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group row">
									<div class="col-md-4">
										<label for="id_customer">Supplier</label>
									</div>
									<div class="col-md-8">
										<select id="supplier" name="supplier" class='form-control input-md' required>
											<option value="">- Supplier -</option>
											<?php foreach ($results['list_supplier'] as $supplier) {
												$selected = '';
											?>
												<option value="<?= $supplier->code_supplier ?>" <?= $selected; ?>><?= strtoupper(strtolower($supplier->name_suplier)) ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group row">
									<div class="col-md-4">
										<label for="id_customer">PR</label>
									</div>
									<div class="col-md-8">
										<!-- <select id="no_pr" name="no_pr" class='form-control input-md chosen-select' required>
											<option value="0">List Empty</option>
										</select> -->
										<input type="text" id="no_pr" name="no_pr" class='form-control input-md' value="" required>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-12" hidden>
							<div class="col-sm-6">
								<div class="form-group row">
									<div class="col-md-4">
										<label for="id_customer">Price Method</label>
									</div>
									<div class="col-md-8">
										<select id="cif" name="cif" class="form-control select" required>
											<option value="">--Pilih--</option>
											<option value="CIF">CIF</option>
											<option value="FOB">FOB</option>
											<option value="LOCO">LOCO</option>
											<option value="DDU">DDU</option>
											<option value="FRANCO">FRANCO</option>
										</select>
									</div>
								</div>
							</div>
						</div>

						<input type="hidden" class="count_all_prod" value="<?= count($results['getitemso']) ?>">
						<div class="col-sm-12">
							<div class="col-sm-12">
								<div class="form-group row">
									<div class="table-responsive">
										<table class='table table-bordered table-striped'>
											<thead>
												<tr class='bg-blue'>
													<th width='5%' class="text-center">
														<input type="checkbox" id="select_all" checked>
													</th>
													<th>Item</th>
													<th>Kode Produk</th>
													<th>Description</th>
													<th width='7%' hidden>Width</th>
													<th width='7%' hidden>Length</th>
													<th width='7%'>Qty PR</th>
													<th width='7%'>PO Qty</th>
													<th width='5%'>Unit Measurement</th>
													<th width='7%'>Unit Packing</th>
													<th width='8%' hidden>Rate LME</th>
													<th width='7%' hidden>Alloy Price</th>
													<th width='7%' hidden>Fab Cost</th>
													<th width='10%'>Unit Price <br> Exclude PPN</th>
													<th width='6%' hidden>Disc %</th>
													<th width='6%' hidden>Biaya Kirim</th>
													<th width='7%'>PPN</th>
													<th width='10%'>Nilai Barang</th>
													<th width='12%'>Nilai Discount</th>
													<th width='7%'>Nilai PPN</th>
													<th width='9%'>Total Barang + PPN</th>
													<th width='8%'>Note</th>
												</tr>
											</thead>
											<tbody>
												<?php
												// if ($results['getitemso']) {
												$n = 1;
												// print_r($results['getitemso']);
												// exit;

												foreach ($results['getitemso'] as $value) {

													$get_trans_po = $this->db->get_where('dt_trans_po', ['idpr' => $value->id])->num_rows();

													$get_qty_all_po = $this->db->query("SELECT IF(SUM(a.qty) IS NOT NULL, SUM(a.qty), 0) AS qty_all_po FROM dt_trans_po a WHERE a.idpr = '" . $value->id . "'")->row();

													// echo '<tr><td>' . $value->nm_material . '</td></tr>';

													$no = $n++;
													$key++;
													// $disabled = ($loi == 'Import') ? '' : 'readonly';
													// $disabled2 = ($loi == 'Import') ? 'readonly' : '';
													// $idmat = $value->idmaterial;
													// $harga 	= $this->db->query("SELECT * FROM ms_product_pricelist WHERE id_category3 = '$idmat'")->row();

													// $stock = $this->db->query("SELECT * FROM stock_material WHERE id_category3 = '$idmat'")->row();

													// $avl 	 =	$stock->qty_free;
													$po    = $value->qty;

													$total = $harga->harga_beli * $value->qty;


													// if ($value->status_app !== 'Y') {

													$get_po = $this->db->get_where('dt_trans_po', ['idpr' => $value->id])->row();
													// if ($get_po->qty == null || $get_po->qty > $value->propose_purchase) {
													$status = "<div class='badge bg-green'>Done PO</div>";
													if ($get_po->qty == null || $get_po->qty > $value->propose_purchase) {
														$status = "<div class='badge bg-red'>Outstanding PO</div>";
													}
													echo "
													<tr>
														<td class='text-center'>
															<input type='checkbox' name='dt[" . $key . "][checked_point]' class='checked_point' data-no='" . $key . "' value='" . $key . "'  checked>
														</td>
													<td>  " . $value->nm_material . $value->nm_material1 . "
															  <input type='hidden' class='form-control input-sm' id='dt_idpr_" . $key . "' name='dt[" . $key . "][idpr]' value='" . $value->id . "'>
															  <input type='hidden' id='dt_tipe_pr_" . $key . "' name='dt[" . $key . "][tipe_pr]' value='" . $value->tipe_pr . "'>
															  <input type='hidden' class='form-control input-sm' id='dt_no_pr_" . $key . "' name='dt[" . $key . "][no_pr]' value='" . $value->no_pr . "'>
																<input type='hidden' class='form-control input-sm' id='dt_idmaterial_" . $key . "' name='dt[" . $key . "][idmaterial]' value='" . $value->id_material . "'>
																<input type='hidden' class='form-control input-sm' id='dt_namamaterial_" . $key . "' name='dt[" . $key . "][namamaterial]' value='" . $value->nm_material . $value->nm_material1 . "'>
																<input type='hidden' class='form-control input-sm' id='dt_panjang_" . $key . "' name='dt[" . $key . "][panjang]'>
																<input type='hidden' class='form-control input-sm' id='dt_lebar_" . $key . "' name='dt[" . $key . "][lebar]'>
								
																<input type='hidden' class='form-control input-sm ch_diskon' id='dt_ch_diskon_" . $key . "'>
																<input type='hidden' class='form-control input-sm ch_pajak' id='dt_ch_pajak_" . $key . "'>
																<input type='hidden' class='form-control input-sm ch_jumlah' id='dt_ch_jumlah_" . $key . "'>
																<input type='hidden' class='form-control input-sm ch_ppn' id='dt_ch_ppn_" . $key . "'>
								
															</td>
												  
												  <td><input type='text' class='form-control input-sm' name='dt[" . $key . "][kode_barang]' id='dt_kode_barang_" . $key . "' value='" . $value->code . $value->code1 . "' readonly></td>
												  
													<td><input type='text' class='form-control input-sm' name='dt[" . $key . "][description]' id='dt_description_" . $key . "' value=''></td>
												  
												  <td><input type='text' class='form-control input-sm' id='dt_pr_" . $key . "' name='dt[" . $key . "][pr]' value='" . (($value->propose_purchase - $get_qty_all_po->qty_all_po) * $value->konversi)  . "' readonly ></td>
												  
													<td hidden><input type='hidden' class='form-control input-sm autoNumeric' name='dt[" . $key . "][width]' id='dt_width_" . $key . "'  value='" . $value->width . "'></td>
													<td hidden><input type='hidden' class='form-control input-sm autoNumeric' name='dt[" . $key . "][length]' id='dt_length_" . $key . "'  value='" . $value->length . "'></td>
													<td><input type='hidden' class='form-control input-sm autoNumeric' name='dt[" . $key . "][totalweight]' id='dt_totalweight_" . $key . "' value='" . $value->totalweight . "'  onkeyup='HitAmmount(" . $key . ")'>
																		<input type='text' class='form-control input-sm' id='dt_qty_" . $key . "' name='dt[" . $key . "][qty]' value='" . (($value->propose_purchase - $get_qty_all_po->qty_all_po) * $value->konversi) . "' onkeyup='HitAmmount(" . $key . ")'>
																
															</td>
															<td class='text-center'>".ucfirst($value->unit_measure)."</td>
															<td class='text-center'>" . ucfirst($value->packing_unit) . ucfirst($value->packing_unit2) . "</td>
													<td hidden>
																<select class='form-control input-sm' id='dt_ratelme_" . $key . "' name='dt[" . $key . "][ratelme]' onchange='CariPrice(" . $key . ")'>
																	<option value=''>-Pilih-</option>
																	<option value='Hari Ini'>Hari ini</option>
																	<option value='H-10'>H-10</option>
																	<option value='H-30'>H-30</option>
																</select>
															</td>
													<td hidden><input type='text' class='form-control input-sm autoNumeric3' id='dt_alloyprice_" . $key . "' " . $disabled . " data-decimal='.' data-thousand='' data-precision='0' data-allow-zero='' name='dt[" . $key . "][alloyprice]' onkeyup='HitAmmount(" . $key . ")'></td>
													<td hidden><input type='text' class='form-control input-sm autoNumeric3' id='dt_fabcost_" . $key . "' " . $disabled . " name='dt[" . $key . "][fabcost]' onkeyup='HitAmmount(" . $key . ")'></td>
													<td><input type='text' class='form-control input-sm autoNumeric3' id='dt_hargasatuan_" . $key . "' name='dt[" . $key . "][hargasatuan]' onkeyup='HitAmmount(" . $key . ")' value=''></td>
												  <td>
														<select class='form-control input-sm' id='dt_ppn_" . $key . "' name='dt[" . $key . "][ppn]' onchange='CariPPN(" . $key . ")'>
															<option value=''>SELECT</option>
															<option value='Y'>Y</option>
															<option value='N'>N</option>
														</select>
													</td>
													<td hidden><input type='text' class='form-control input-sm autoNumeric pajak' id='dt_pajak_" . $key . "' name='dt[" . $key . "][pajak]' onkeyup='HitAmmount(" . $key . ")'></td>
													<td hidden><input type='text' class='form-control input-sm autoNumeric3' id='dt_diskon_" . $key . "' " . $disabled . " name='dt[" . $key . "][diskon]' onkeyup='HitAmmount(" . $key . ")'></td>
												
												  <td><input type='text' class='form-control input-sm ch_jumlah_ex' id='dt_jumlahharga_" . $key . "' readonly name='dt[" . $key . "][jumlahharga]' value='" . $total . "'></td>
													<td>
														<input type='text' name='dt[" . $key . "][disc_persen]' class='form-control form-control-sm auto_num disc_persen' id='disc_persen_" . $key . "' placeholder='Discount (%)' data-key='" . $key . "'>
														<br>
														<input type='text' name='dt[" . $key . "][disc_num]' class='form-control form-control-sm auto_num disc_num' id='disc_num_" . $key . "' data-key='" . $key . "' placeholder='- Discount ($) -'>
													</td>
													<td><input type='text' class='form-control auto_num input-sm ch_ppn cng_nilai_ppn' id='dt_nilai_ppn_" . $key . "' name='dt[" . $key . "][nilai_ppn]' data-key='" . $key . "' placeholder='Nilai PPN' readonly>
													<input type='text' class='form-control input-sm ch_per_ppn cng_persen_ppn' id='dt_persen_ppn_" . $key . "' name='dt[" . $key . "][persen_ppn]' data-key='" . $key . "' placeholder='Persen PPN' readonly></td>
													<td><input type='text' class='form-control input-sm ch_jumlah_ex2' id='dt_totalharga_" . $key . "' readonly name='dt[" . $key . "][totalharga]' value='" . $total . "'></td>
													<td><input type='text' class='form-control input-sm' id='dt_note_" . $key . "' name='dt[" . $key . "][note]'></td>
											 </tr>
													";
													// }
												}
												// }

												?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>


					</div>
					<div class="col-sm-12" hidden>
						<div class="col-sm-6">
							<div class="form-group row">
								<div class="col-md-4">
									<label for="customer">Expect Date</label>
								</div>
								<div class="col-md-8">
									<input type="text" class="form-control" id="expect_tanggal" required name="expect_tanggal" readonly>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group row">
								<div class="col-md-2">
									<label for="customer">Note</label>
								</div>
								<div class="col-md-10">
									<input type="text" class="form-control" id="note_ket" name="note_ket">
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group row">
									<div class="col-md-4">
										<label for="id_customer">Sub Total (Exclude PPN & Disc)</label>
									</div>
									<div class="col-md-8" id="ForHarga">
										<input readonly type="text" class="form-control" id="hargatotal" onkeyup required name="hargatotal">
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group row">
									<div class="col-md-4">
										<label for="id_customer">Keterangan</label>
									</div>
									<div class="col-md-8" id="ForHarga">
										<textarea name="note" id="" class="form-control" rows="5"></textarea>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group row">
									<div class="col-md-4">
										<label for="id_customer">Total Discount</label>
									</div>
									<div class="col-md-1 text-right">
										<span>(%)</span> <br><br>
										<span>($)</span>
									</div>
									<div class="col-md-7" id="ForHarga">
										<input type="text" class="form-control auto_num" id="persendisc" onkeyup required name="persendisc" onblur="cariTotal()" placeholder="Persen Disc (%)">
										<input type="text" class="form-control auto_num" id="totaldisc" onkeyup required name="totaldisc" onblur="cariTotal()" placeholder="Nilai Disc">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group row">
									<div class="col-md-4">
										<label for="id_customer">Total PPN</label>
									</div>
									<div class="col-md-1 text-right">
										<span>(%)</span> <br><br>
										<span>($)</span>
									</div>
									<div class="col-md-7" id="ForHarga">
										<input type="text" class="form-control auto_num" id="persenppn" onkeyup required name="persenppn" onblur="cariTotal()" placeholder="Persen PPN (%)">
										<input type="text" class="form-control auto_num" id="totalppn" onkeyup required name="totalppn" onblur="cariTotal()" placeholder="Nilai PPN">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-12" hidden>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group row">
									<div class="col-md-4">
										<label for="id_customer">Discount</label>
									</div>
									<div class="col-md-8" id="ForDiskon">
										<input readonly type="text" class="form-control" id="diskontotal" onkeyup required name="diskontotal">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group row">
									<div class="col-md-4">
										<label for="id_customer">Biaya Kirim</label>
									</div>
									<div class="col-md-8" id="ForTax">
										<input type="hidden" class="form-control" id="taxtotal" onkeyup required name="taxtotal">
										<input type="text" class="form-control" id="kirim" onblur="cariTotal()" required name="kirim">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group row">
									<div class="col-md-4">
										<label for="id_customer">Total Order</label>
									</div>
									<div class="col-md-8" id="ForSum">
										<input readonly type="text" class="form-control" id="subtotal" onkeyup required name="subtotal">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="row">
							<div class="col-sm-12">
								<input type="hidden" name="num_top" class="num_top">
								<button type="button" class="btn btn-sm btn-primary add_top">
									<i class="fa fa-plus"></i> Add TOP
								</button>
								<table class="table table-bordered">
									<thead class="bg-blue">
										<tr>
											<th class="text-center">Group TOP</th>
											<th class="text-center">Progress (%)</th>
											<th class="text-center">Value</th>
											<th class="text-center">Keterangan</th>
											<th class="text-center">Action</th>
										</tr>
									</thead>
									<tbody class="list_tbody_top">

									</tbody>
								</table>
							</div>
						</div>
					</div>
					<center>
						<button type="submit" class="btn btn-success btn-md" name="save" id="simpan-com"><i class="fa fa-save"></i> Simpan</button>
					</center>
				</div>
			</div>
		</form>
	</div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js" integrity="sha512-rMGGF4wg1R73ehtnxXBt5mbUfN9JUJwbk21KMlnLZDJh7BkPmeovBuddZCENJddHYYMkCh9hPFnPmS9sspki8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
	//$('#input-kendaraan').hide();
	var base_url = '<?php echo base_url(); ?>';
	var active_controller = '<?php echo ($this->uri->segment(1)); ?>';
	var num_top = getNum($('.num_top').val());
	$(document).ready(function() {

		TotalSemua()

		const queryString = window.location.search;
		const urlParamas = new URLSearchParams(queryString);
		const pr = urlParamas.get('param'); 
		$("#no_pr").val(pr);


		$('.auto_num').autoNumeric('init');

		var max_fields2 = 10; //maximum input boxes allowed
		var wrapper2 = $(".input_fields_wrap2"); //Fields wrapper
		var add_button2 = $(".add_field_button2"); //Add button ID	

		$('.datepicker').datepicker({
			dateFormat: 'yy-mm-dd',
			changeMonth: true,
			changeYear: true,
		});

		$(document).on('click', '.checked_point', function() {
			var no = $(this).data('no');

			if ($(this).prop('checked') === true) {
				$('input[name="dt[' + no + '][description]"]').prop('readonly', false);
				$('input[name="dt[' + no + '][description]"]').val('');

				$('input[name="dt[' + no + '][qty]"]').prop('readonly', false);
				$('input[name="dt[' + no + '][qty]"]').val('');

				$('input[name="dt[' + no + '][hargasatuan]"]').prop('readonly', false);
				$('input[name="dt[' + no + '][hargasatuan]"]').val('');

				$('input[name="dt[' + no + '][ppn]"]').prop('disabled', false);
				$('input[name="dt[' + no + '][ppn]"]').val('');

				$('input[name="dt[' + no + '][jumlahharga]"]').val('0');

				$('input[name="dt[' + no + '][disc_persen]"]').prop('readonly', false);
				$('input[name="dt[' + no + '][disc_persen]"]').val('0');

				$('input[name="dt[' + no + '][disc_num]"]').prop('readonly', false);
				$('input[name="dt[' + no + '][disc_num]"]').val('0');

				$('input[name="dt[' + no + '][nilai_ppn]"]').val('0');

				$('input[name="dt[' + no + '][persen_ppn]"]').val('0');

				$('input[name="dt[' + no + '][totalharga]"]').val('0');

				$('input[name="dt[' + no + '][note]"]').prop('readonly', false);
				$('input[name="dt[' + no + '][note]"]').val('');
			} else {
				$('input[name="dt[' + no + '][description]"]').prop('readonly', true);
				$('input[name="dt[' + no + '][description]"]').val('');

				$('input[name="dt[' + no + '][qty]"]').prop('readonly', true);
				$('input[name="dt[' + no + '][qty]"]').val('');

				$('input[name="dt[' + no + '][hargasatuan]"]').prop('readonly', true);
				$('input[name="dt[' + no + '][hargasatuan]"]').val('');

				$('input[name="dt[' + no + '][ppn]"]').prop('disabled', true);
				$('input[name="dt[' + no + '][ppn]"]').val('');

				$('input[name="dt[' + no + '][jumlahharga]"]').val('0');

				$('input[name="dt[' + no + '][disc_persen]"]').prop('readonly', true);
				$('input[name="dt[' + no + '][disc_persen]"]').val('0');

				$('input[name="dt[' + no + '][disc_num]"]').prop('readonly', true);
				$('input[name="dt[' + no + '][disc_num]"]').val('0');

				$('input[name="dt[' + no + '][nilai_ppn]"]').val('0');

				$('input[name="dt[' + no + '][persen_ppn]"]').val('0');

				$('input[name="dt[' + no + '][totalharga]"]').val('0');

				$('input[name="dt[' + no + '][note]"]').prop('readonly', true);
				$('input[name="dt[' + no + '][note]"]').val('');
			}

			TotalSemua()
		});

		$('#select_all').change(function() {
			var count_all_prod = $('.count_all_prod').val();
			// If the checkbox being changed is checked
			if ($(this).prop('checked')) {
				// Set all checkboxes to checked
				$('input[type="checkbox"]').prop('checked', true);
				for (var i = 1; i <= count_all_prod; i++) {
					$('input[name="dt[' + i + '][description]"]').prop('readonly', false);
					$('input[name="dt[' + i + '][description]"]').val('');

					$('input[name="dt[' + i + '][qty]"]').prop('readonly', false);
					$('input[name="dt[' + i + '][qty]"]').val('');

					$('input[name="dt[' + i + '][hargasatuan]"]').prop('readonly', false);
					$('input[name="dt[' + i + '][hargasatuan]"]').val('');

					$('input[name="dt[' + i + '][ppn]"]').prop('disabled', false);
					$('input[name="dt[' + i + '][ppn]"]').val('');

					$('input[name="dt[' + i + '][jumlahharga]"]').val('0');

					$('input[name="dt[' + i + '][disc_persen]"]').prop('readonly', false);
					$('input[name="dt[' + i + '][disc_persen]"]').val('0');

					$('input[name="dt[' + i + '][disc_num]"]').prop('readonly', false);
					$('input[name="dt[' + i + '][disc_num]"]').val('0');

					$('input[name="dt[' + i + '][nilai_ppn]"]').val('0');

					$('input[name="dt[' + i + '][persen_ppn]"]').val('0');

					$('input[name="dt[' + i + '][totalharga]"]').val('0');

					$('input[name="dt[' + i + '][note]"]').prop('readonly', false);
					$('input[name="dt[' + i + '][note]"]').val('');
				}
			} else {
				// If the checkbox being changed is unchecked, uncheck all checkboxes
				$('input[type="checkbox"]').prop('checked', false);
				for (var i = 1; i <= count_all_prod; i++) {
					$('input[name="dt[' + i + '][description]"]').prop('readonly', true);
					$('input[name="dt[' + i + '][description]"]').val('');

					$('input[name="dt[' + i + '][qty]"]').prop('readonly', true);
					$('input[name="dt[' + i + '][qty]"]').val('');

					$('input[name="dt[' + i + '][hargasatuan]"]').prop('readonly', true);
					$('input[name="dt[' + i + '][hargasatuan]"]').val('');

					$('input[name="dt[' + i + '][ppn]"]').prop('disabled', true);
					$('input[name="dt[' + i + '][ppn]"]').val('');

					$('input[name="dt[' + i + '][jumlahharga]"]').val('0');

					$('input[name="dt[' + i + '][disc_persen]"]').prop('readonly', true);
					$('input[name="dt[' + i + '][disc_persen]"]').val('0');

					$('input[name="dt[' + i + '][disc_num]"]').prop('readonly', true);
					$('input[name="dt[' + i + '][disc_num]"]').val('0');

					$('input[name="dt[' + i + '][nilai_ppn]"]').val('0');

					$('input[name="dt[' + i + '][persen_ppn]"]').val('0');

					$('input[name="dt[' + i + '][totalharga]"]').val('0');

					$('input[name="dt[' + i + '][note]"]').prop('readonly', true);
					$('input[name="dt[' + i + '][note]"]').val('');
				}
			}
		});

		$(document).on('change', '#id_suplier', function() {
			let id_suplier = $('#id_suplier').val();
			$.ajax({
				type: "POST",
				url: siteurl + 'purchase_order/getPR',
				data: {
					'id_suplier': id_suplier
				},
				cache: false,
				dataType: 'json',
				success: function(data) {
					$('#no_pr').html(data.option).trigger("chosen:updated");
				}
			});
		});

		$(document).on('change', '#no_pr', function() {
			let loi = $('#loi').val();
			let no_pr = $(this).val();
			$.ajax({
				type: "POST",
				url: siteurl + 'purchase_order/AddMaterial_Direct',
				data: {
					'loi': loi,
					'no_pr': no_pr
				},
				cache: false,
				dataType: 'json',
				success: function(data) {
					$('#data_request').html(data.list_mat);
					$(".bilangan-desimal").maskMoney();
					$('.autoNumeric3').autoNumeric('init', {
						vMin: 0
					});
					$('.autoNumeric').autoNumeric();
					$('#expect_tanggal').val(data.min_date);
				}
			});
		});

		$(document).on('click', '.hapus_baris', function() {
			$(this).parent().parent().remove();
			SumDel();
		});

		$('#simpan-com').click(function(e) {
			e.preventDefault();
			var deskripsi = $('#deskripsi').val();
			var tanggal = $('#tanggal').val();
			var loi = $('#loi').val();
			var term = $('#term').val();
			var cif = $('#cif').val();
			var pajak = $('.pajak').val();
			var supplier = $('#supplier').val()

			var data, xhr;
			if (loi == '' || loi == null) {
				swal("Warning", "Form Tidak Boleh Kosong :)", "error");
				return false;
			} else if (tanggal == '' || tanggal == null) {
				swal("Warning", "Tanggal Tidak Boleh Kosong :)", "error");
				return false;
			} else if (supplier == '' || supplier == null) {
				swal("Warning", "Supplier tidak boleh kosong  :)", "error");
				return false;
			} else {
				swal({
						title: "Are you sure?",
						text: "You will not be able to process again this data!",
						type: "warning",
						showCancelButton: true,
						confirmButtonClass: "btn-danger",
						confirmButtonText: "Yes, Process it!",
						cancelButtonText: "No, cancel process!",
						closeOnConfirm: true,
						closeOnCancel: false
					},
					function(isConfirm) {
						if (isConfirm) {

							var formData = new FormData($('#data-form')[0]);
							var baseurl = siteurl + 'purchase_order/SaveNew';
							$.ajax({
								url: baseurl,
								type: "POST",
								data: formData,
								cache: false,
								dataType: 'json',
								processData: false,
								contentType: false,
								success: function(data) {
									if (data.status == 1) {
										swal({
											title: "Save Success!",
											text: data.pesan,
											type: "success",
											timer: 5000,
											showCancelButton: false,
											showConfirmButton: false,
											allowOutsideClick: false
										});
										window.location.href = base_url + active_controller;
									} else {

										if (data.status == 2) {
											swal({
												title: "Save Failed!",
												text: data.pesan,
												type: "warning",
												timer: 5000,
												showCancelButton: false,
												showConfirmButton: false,
												allowOutsideClick: false
											});
										} else {
											swal({
												title: "Save Failed!",
												text: data.pesan,
												type: "warning",
												timer: 5000,
												showCancelButton: false,
												showConfirmButton: false,
												allowOutsideClick: false
											});
										}

									}
								},
								error: function() {

									swal({
										title: "Error Message !",
										text: 'An Error Occured During Process. Please try again..',
										type: "warning",
										timer: 5000,
										showCancelButton: false,
										showConfirmButton: false,
										allowOutsideClick: false
									});
								}
							});
						} else {
							swal("Cancelled", "Data can be process again :)", "error");
							return false;
						}
					});
			}
		});

	});

	$(document).on('change', '.cng_nilai_ppn', function() {
		var key = $(this).data('key');
		var nilai = $("#dt_nilai_ppn_" + key).val();
		var nilai = nilai.split(',').join('');
		var nilai = parseFloat(nilai);
		var nilai = nilai.toFixed(2);

		var hargasatuan = $("#dt_hargasatuan_" + key).val();
		var hargasatuan = hargasatuan.split(',').join('');
		var hargasatuan = parseFloat(hargasatuan);

		var qty = $("#dt_qty_" + key).val();
		var qty = qty.split(',').join('');
		var qty = parseFloat(qty);

		if (qty <= 0 || hargasatuan <= 0) {
			var nilai_persen = 0;
		} else {
			var nilai_persen = parseFloat(nilai / (hargasatuan * qty) * 100);
		}

		$("#dt_persen_ppn_" + key).val(nilai_persen);

		HitAmmount(key);
	});

	$(document).on('change', '.cng_persen_ppn', function() {
		var key = $(this).data('key');

		var persen = $("#dt_persen_ppn_" + key).val();
		persen = persen.split(',').join('');
		persen = parseFloat(persen);

		var hargasatuan = $("#dt_hargasatuan_" + key).val();
		hargasatuan = hargasatuan.split(',').join('');
		hargasatuan = parseFloat(hargasatuan);

		var qty = $("#dt_qty_" + key).val();
		qty = qty.split(',').join('');
		qty = parseFloat(qty);

		var nilai_ppn = parseFloat((hargasatuan * qty) * persen / 100);

		$("#dt_nilai_ppn_" + key).autoNumeric('set', nilai_ppn.toFixed(2));


		HitAmmount(key);
	});

	$(document).on('change', '.disc_persen', function() {
		var key = $(this).data('key');
		var disc_persen = getNum($(this).val().split(',').join(''));
		var hargasatuan = getNum($('#dt_hargasatuan_' + key).val().split(',').join(''));
		var qty = getNum($('#dt_qty_' + key).val().split(',').join(''));

		var disc_num = ((hargasatuan * qty) * disc_persen / 100);
		$('#disc_num_' + key).val(number_format(disc_num, 2));

		HitAmmount(key);
	});

	$(document).on('change', '.disc_num', function() {
		var key = $(this).data('key');
		var disc_num = getNum($(this).val().split(',').join(''));
		var hargasatuan = getNum($('#dt_hargasatuan_' + key).val().split(',').join(''));
		var qty = getNum($('#dt_qty_' + key).val().split(',').join(''));

		var disc_persen = parseFloat(disc_num / (hargasatuan * qty) * 100);
		$('#disc_persen_' + key).val(disc_persen);

		HitAmmount(key);
	});

	$(document).on('keyup', '#persendisc', function() {
		var total = getNum($("#hargatotal").val().split(",").join(""));
		var persen_disc = getNum($(this).val().split(",").join(""));

		var disc = (total * persen_disc / 100);

		$("#totaldisc").val(number_format(disc, 2));
		cariTotal();
	});

	$(document).on('keyup', '#totaldisc', function() {
		var total = getNum($("#hargatotal").val().split(",").join(""));
		var disc = getNum($("#totaldisc").val().split(",").join(""));

		var persen_disc = (disc / total * 100);
		$("#persendisc").val(number_format(persen_disc, 2));

		cariTotal();
	});

	$(document).on('click', '.add_top', function() {
		$.ajax({
			type: "POST",
			url: siteurl + active_controller + '/add_top_po',
			cache: false,
			dataType: 'JSON',
			success: function(result) {
				num_top++;
				var Rows = '<tr class="top_' + num_top + '">';

				Rows += '<td class="">';
				Rows += '<select class="form-control chosen-select" name="group_top_' + num_top + '">';
				Rows += result.list_top_group;
				Rows += '</select>';
				Rows += '</td>';

				Rows += '<td class="">';
				Rows += '<input type="text" class="form-control form-control-sm input_progress progress_' + num_top + ' auto_num" name="progress_' + num_top + '" data-no="' + num_top + '">';
				Rows += '</select>';
				Rows += '</td>';

				Rows += '<td class="text-right">';
				Rows += '<input type="text" class="form-control form-control-sm nilai_top nilai_top_' + num_top + ' auto_num" name="nilai_top_' + num_top + '" data-no="' + num_top + '">';
				Rows += '</td>';

				Rows += '<td class="">';
				Rows += '<textarea name="keterangan_top_' + num_top + '" class="form-control form-control-sm"></textarea>';
				Rows += '</td>';

				Rows += '<td class="text-center">';
				Rows += '<button type="button" class="btn btn-sm btn-danger del_top" data-top_no="' + num_top + '"><i class="fa fa-trash"></i></button>';
				Rows += '</td>';

				Rows += '</tr>';




				$('.num_top').val(num_top);
				$('.list_tbody_top').append(Rows);

				$('.chosen-select').chosen({
					width: "100%"
				});
			},
			error: function(result) {
				swal({
					title: 'Error !',
					text: 'Please try again later !',
					type: 'error'
				});
			}
		});
	});

	$(document).on('change', '.input_progress', function() {
		var no = $(this).data('no');
		var subtotal = $('#subtotal').val();
		if (subtotal == '' || subtotal == null) {
			subtotal = 0;
		} else {
			subtotal = subtotal.split(',').join('');
			subtotal = parseFloat(subtotal);
		}

		var progress = $(this).val();
		if (progress == '' || progress == null) {
			progress = 0;
		} else {
			progress = progress.split(',').join('');
			progress = parseFloat(progress);
		}

		var nilai_top = (subtotal * progress / 100);

		$('.nilai_top_' + no).val(nilai_top.toLocaleString());
	});

	$(document).on('change', '.nilai_top', function() {
		var no = $(this).data('no');

		var subtotal = $('#subtotal').val();
		if (subtotal == '' || subtotal == null) {
			subtotal = 0;
		} else {
			subtotal = subtotal.split(',').join('');
			subtotal = parseFloat(subtotal);
		}

		var nilai_top = $(this).val();
		if (nilai_top == '' || nilai_top == null) {
			nilai_top = 0;
		} else {
			nilai_top = nilai_top.split(',').join('');
			nilai_top = parseFloat(nilai_top);
		}

		var progress = (nilai_top / subtotal * 100);

		$(this).val(nilai_top.toLocaleString());
		$('.progress_' + no).val(progress.toLocaleString());
	});

	$(document).on('click', '.del_top', function() {
		var top_no = $(this).data('top_no');

		$('.top_' + top_no).remove();
	});


	function addmaterial() {
		var jumlah = $('#data_request').find('tr').length;
		var id_suplier = $("#id_suplier").val();
		var loi = $("#loi").val();
		var angka = jumlah + 1;
		if (id_suplier == '' || id_suplier == null || loi == '' || loi == null) {
			swal("Warning", "Silahkan Pilih Supplier Terlebih Dahulu :)", "error");
			return false;
		} else {
			$.ajax({
				type: "GET",
				url: siteurl + 'purchase_order/AddMaterial',
				data: "jumlah=" + jumlah + "&id_suplier=" + id_suplier + "&loi=" + loi,
				success: function(html) {
					$("#data_request").append(html);
					$(".bilangan-desimal").maskMoney();
					$(".chosen-select").chosen({
						width: "100%"
					});
					$('.autoNumeric3').autoNumeric('init', {
						vMin: 0
					});
				}
			});
			$.ajax({
				type: "GET",
				url: siteurl + 'purchase_order/UbahImport',
				data: "loi=" + loi,
				success: function(html) {
					$("ubahloi").html(html);
				}
			});
		}
	}

	function HitungHarga(id) {
		var dt_qty = $("#dt_qty_" + id).val();
		var dt_width = $("#dt_width_" + id).val();
		var dt_hargasatuan = $("#dt_hargasatuan_" + id).val();
		// $.ajax({
		// type:"GET",
		// url:siteurl+'purchase_order/HitungHarga',
		// data:"dt_hargasatuan="+dt_hargasatuan+"&dt_qty="+dt_qty+"&id="+id,
		// success:function(html){
		// $("#jumlahharga_"+id).html(html);
		// }
		// });
		$.ajax({
			type: "GET",
			url: siteurl + 'purchase_order/TotalWeight',
			data: "dt_width=" + dt_width + "&dt_qty=" + dt_qty + "&id=" + id,
			success: function(html) {
				$("#totalwidth_" + id).html(html);
			}
		});
	}

	function CariPrice(id) {
		var dt_ratelme = $("#dt_ratelme_" + id).val();
		var dt_idmaterial = $("#dt_idmaterial_" + id).val();
		if (dt_idmaterial == '' || dt_idmaterial == null) {
			swal("Warning", "Silahkan Pilih Material Terlebih Dahulu :)", "error");
			return false;
		} else {
			$.ajax({
				type: "GET",
				url: siteurl + 'purchase_order/CariPrice',
				data: "dt_ratelme=" + dt_ratelme + "&dt_idmaterial=" + dt_idmaterial + "&id=" + id,
				success: function(html) {
					$("#dt_alloyprice_" + id).val(html);
				}
			});
		}
	}

	function CariPPN(id) {
		var ppn = $("#dt_ppn_" + id).val();

		// console.log(ppn)

		var harga = getNum($("#dt_jumlahharga_" + id).val().split(",").join(""));
		var disc_persen = getNum($("#disc_persen_" + id).val().split(",").join(""));
		var disc_num = getNum($("#disc_num_" + id).val().split(",").join(""));
		if (disc_num == '' || disc_num == 0) {
			disc_num = (harga * disc_persen / 100);
		}

		harga = (harga - disc_num);
		var dt_idmaterial = $("#dt_idmaterial_" + id).val();


		// if (dt_idmaterial == '' || dt_idmaterial == null) {
		// 	swal("Warning", "Silahkan Pilih Material Terlebih Dahulu :)", "error");
		// 	return false;
		// } else {


		// }
		if (ppn == '' || ppn == 'N') {
			$("#dt_nilai_ppn_" + id).attr('readonly', true);
			$("#dt_persen_ppn_" + id).attr('readonly', true);

			$("#dt_nilai_ppn_" + id).val('0');
			$("#dt_persen_ppn_" + id).val('0');
			HitAmmount(id);
		} else {
			$.ajax({
				type: "GET",
				url: siteurl + 'purchase_order/CariPPN',
				data: "harga=" + harga + "&id=" + id,
				success: function(html) {
					$("#dt_nilai_ppn_" + id).attr('readonly', false);
					$("#dt_persen_ppn_" + id).attr('readonly', false);

					$("#dt_nilai_ppn_" + id).val(html);
					$("#dt_persen_ppn_" + id).val(11);
					HitAmmount(id);
				}
			});
		}
	}

	function get_kurs() {
		// var loi = $("#loi").val();
		// $.ajax({
		// 	type: "GET",
		// 	url: siteurl + 'purchase_order/FormInputKurs',
		// 	data: "loi=" + loi,
		// 	success: function(html) {
		// 		$("#input_kurs").html(html);
		// 	}
		// });
	}


	function HitungUP(id) {
		var alloyprice = $("#dt_alloyprice_" + id).val();
		var fabcost = $("#dt_fabcost_" + id).val();
		var diskon = $("#dt_diskon_" + id).val();
		var pajak = $("#dt_pajak_" + id).val();
		var qty = $("#dt_qty_" + id).val();
		var hargasatuan = $("#dt_hargasatuan_" + id).val();
		var dt_width = $("#dt_totalwidth_" + id).val();

		var loi = $("#loi").val();
		// console.log(dt_width)
		$.ajax({
			type: "GET",
			url: siteurl + 'purchase_order/HitungUP',
			data: "fabcost=" + fabcost + "&alloyprice=" + alloyprice + "&hargasatuan=" + hargasatuan + "&loi=" + loi,
			success: function(html) {
				// $("#dt_hargasatuan_"+id).val(html); 
				HitAmmount(id)
			}
		});
		// $.ajax({
		// type:"GET",
		// url:siteurl+'purchase_order/Hitjumlah',
		// data:"fabcost="+fabcost+"&alloyprice="+alloyprice+"&pajak="+pajak+"&diskon="+diskon+"&qty="+qty+"&hargasatuan="+hargasatuan+"&loi="+loi+"&dt_width="+dt_width,
		// success:function(html){
		// $("#dt_jumlahharga_"+id).val(html); 
		// }
		// });		
	}

	function HitungUPIm(id) {
		var alloyprice = $("#dt_alloyprice_" + id).val();
		var fabcost = $("#dt_fabcost_" + id).val();
		var diskon = $("#dt_diskon_" + id).val();
		var pajak = $("#dt_pajak_" + id).val();
		var qty = $("#dt_qty_" + id).val();
		var hargasatuan = $("#dt_hargasatuan_" + id).val();
		var dt_width = $("#dt_totalwidth_" + id).val();

		var loi = $("#loi").val();
		// console.log(dt_width)
		$.ajax({
			type: "GET",
			url: siteurl + 'purchase_order/HitungUP',
			data: "fabcost=" + fabcost + "&alloyprice=" + alloyprice + "&hargasatuan=" + hargasatuan + "&loi=" + loi,
			success: function(html) {
				// $("#dt_hargasatuan_"+id).val(html); 
				$('.autoNumeric3').autoNumeric('init', {
					vMin: 0
				});
				HitAmmount(id)
			}
		});
		// $.ajax({
		// type:"GET",
		// url:siteurl+'purchase_order/Hitjumlah',
		// data:"fabcost="+fabcost+"&alloyprice="+alloyprice+"&pajak="+pajak+"&diskon="+diskon+"&qty="+qty+"&hargasatuan="+hargasatuan+"&loi="+loi+"&dt_width="+dt_width,
		// success:function(html){
		// $("#dt_jumlahharga_"+id).val(html); 
		// }
		// });		
	}

	function CariProperties(id) {
		var idpr = $("#dt_idpr_" + id).val();
		$.ajax({
			type: "GET",
			url: siteurl + 'purchase_order/CariIdMaterial',
			data: "idpr=" + idpr + "&id=" + id,
			success: function(html) {
				$("#idmaterial_" + id).html(html);
			}
		});
		$.ajax({
			type: "GET",
			url: siteurl + 'purchase_order/CariNamaMaterial',
			data: "idpr=" + idpr + "&id=" + id,
			success: function(html) {
				$("#namaterial_" + id).html(html);
			}
		});
		$.ajax({
			type: "GET",
			url: siteurl + 'purchase_order/CariPanjangMaterial',
			data: "idpr=" + idpr + "&id=" + id,
			success: function(html) {
				$("#panjang_" + id).html(html);
			}
		});
		$.ajax({
			type: "GET",
			url: siteurl + 'purchase_order/CariLebarMaterial',
			data: "idpr=" + idpr + "&id=" + id,
			success: function(html) {
				$("#lebar_" + id).html(html);
			}
		});
		$.ajax({
			type: "GET",
			url: siteurl + 'purchase_order/CariDescripitionMaterial',
			data: "idpr=" + idpr + "&id=" + id,
			success: function(html) {
				$("#description_" + id).html(html);
			}
		});
		$.ajax({
			type: "GET",
			url: siteurl + 'purchase_order/CariQtyMaterial',
			data: "idpr=" + idpr + "&id=" + id,
			success: function(html) {
				$("#qty_" + id).html(html);
			}
		});
		// $.ajax({
		// type:"GET",
		// url:siteurl+'purchase_order/CariweightMaterial',
		// data:"idpr="+idpr+"&id="+id,
		// success:function(html){
		// $("#width_"+id).html(html);
		// }
		// });
		$.ajax({
			type: "GET",
			url: siteurl + 'purchase_order/CariTweightMaterial',
			data: "idpr=" + idpr + "&id=" + id,
			success: function(html) {
				$("#totalwidth_" + id).html(html);
			}
		});

		$.ajax({
			type: "GET",
			url: siteurl + 'purchase_order/CariWidthMaterial',
			data: "idpr=" + idpr + "&id=" + id,
			success: function(html) {
				$("#width_" + id).html(html);
			}
		});

		var a;
		var ArrList = [];
		for (a = 1; a <= 100; a++) {
			var dataid = $('#dt_idpr_' + a).val();
			ArrList.push(dataid);
		}
		$.ajax({
			type: "POST",
			url: siteurl + 'purchase_order/getDateExp',
			data: {
				'id_pr': ArrList
			},
			dataType: 'json',
			success: function(data) {
				$('#expect_tanggal').val(data.minimal)
			}
		});
	}

	function LockMaterial(id) {
		var idpr = $("#dt_idpr_" + id).val();
		var idmaterial = $("#dt_idmaterial_" + id).val();
		var namaterial = $("#dt_namamaterial_" + id).val();
		var description = $("#dt_description_" + id).val();
		var qty = $("#dt_qty_" + id).val();
		var width = $("#dt_width_" + id).val();
		var totalwidth = $("#dt_totalweight_" + id).val();
		var hargasatuan = $("#dt_hargasatuan_" + id).val();
		var diskon = $("#dt_diskon_" + id).val();
		var pajak = $("#dt_pajak_" + id).val();
		var ratelme = $("#dt_ratelme_" + id).val();
		var alloyprice = $("#dt_alloyprice_" + id).val();
		var fabcost = $("#dt_fabcost_" + id).val();
		var panjang = $("#dt_panjang_" + id).val();
		var lebar = $("#dt_lebar_" + id).val();
		var jumlahharga = $("#dt_jumlahharga_" + id).val();
		var note = $("#dt_note_" + id).val();
		var subtotal = $("#subtotal").val();
		var hargatotal = $("#hargatotal").val();
		var diskontotal = $("#diskontotal").val();
		var taxtotal = $("#taxtotal").val();
		if (qty == '' || qty == null || hargasatuan == '' || hargasatuan == null) {
			swal("Warning", "Form Tidak Boleh Kosong :)", "error");
			return false;
		} else {
			$.ajax({
				type: "GET",
				url: siteurl + 'purchase_order/LockMatrial',
				data: "idpr=" + idpr + "&id=" + id + "&idmaterial=" + idmaterial + "&width=" + width + "&ratelme=" + ratelme + "&alloyprice=" + alloyprice + "&fabcost=" + fabcost + "&panjang=" + panjang + "&lebar=" + lebar + "&totalwidth=" + totalwidth + "&namaterial=" + namaterial + "&description=" + description + "&qty=" + qty + "&hargasatuan=" + hargasatuan + "&diskon=" + diskon + "&pajak=" + pajak + "&jumlahharga=" + jumlahharga + "&note=" + note,
				success: function(html) {
					$("#trmaterial_" + id).html(html);
				}
			});
			$.ajax({
				type: "GET",
				url: siteurl + 'purchase_order/CariTHarga',
				data: "idpr=" + idpr + "&id=" + id + "&hargatotal=" + hargatotal + "&idmaterial=" + idmaterial + "&namaterial=" + namaterial + "&description=" + description + "&qty=" + qty + "&hargasatuan=" + hargasatuan + "&diskon=" + diskon + "&pajak=" + pajak + "&jumlahharga=" + jumlahharga + "&note=" + note,
				success: function(html) {
					$("#ForHarga").html(html);
				}
			});
			$.ajax({
				type: "GET",
				url: siteurl + 'purchase_order/CariTDiskon',
				data: "idpr=" + idpr + "&id=" + id + "&diskontotal=" + diskontotal + "&idmaterial=" + idmaterial + "&namaterial=" + namaterial + "&description=" + description + "&qty=" + qty + "&hargasatuan=" + hargasatuan + "&diskon=" + diskon + "&pajak=" + pajak + "&jumlahharga=" + jumlahharga + "&note=" + note,
				success: function(html) {
					$("#ForDiskon").html(html);
				}
			});
			$.ajax({
				type: "GET",
				url: siteurl + 'purchase_order/CariTPajak',
				data: "idpr=" + idpr + "&id=" + id + "&taxtotal=" + taxtotal + "&idmaterial=" + idmaterial + "&namaterial=" + namaterial + "&description=" + description + "&qty=" + qty + "&hargasatuan=" + hargasatuan + "&diskon=" + diskon + "&pajak=" + pajak + "&jumlahharga=" + jumlahharga + "&note=" + note,
				success: function(html) {
					$("#ForTax").html(html);
				}
			});
			$.ajax({
				type: "GET",
				url: siteurl + 'purchase_order/CariTSum',
				data: "idpr=" + idpr + "&id=" + id + "&hargatotal=" + hargatotal + "&diskontotal=" + diskontotal + "&taxtotal=" + taxtotal + "&idmaterial=" + idmaterial + "&namaterial=" + namaterial + "&description=" + description + "&qty=" + qty + "&hargasatuan=" + hargasatuan + "&diskon=" + diskon + "&pajak=" + pajak + "&jumlahharga=" + jumlahharga + "&note=" + note,
				success: function(html) {
					$("#ForSum").html(html);
				}
			});
		}
	}

	function CancelItem(id) {
		var idpr = $("#dt_idpr_" + id).val();
		var idmaterial = $("#dt_idmaterial_" + id).val();
		var namaterial = $("#dt_namamaterial_" + id).val();
		var description = $("#dt_description_" + id).val();
		var qty = $("#dt_qty_" + id).val();
		var hargasatuan = $("#dt_hargasatuan_" + id).val();
		var diskon = $("#dt_diskon_" + id).val();
		var pajak = $("#dt_pajak_" + id).val();
		var jumlahharga = $("#dt_jumlahharga_" + id).val();
		var note = $("#dt_note_" + id).val();
		var subtotal = $("#subtotal").val();
		var hargatotal = $("#hargatotal").val();
		var diskontotal = $("#diskontotal").val();
		var taxtotal = $("#taxtotal").val();
		$.ajax({
			type: "GET",
			url: siteurl + 'purchase_order/CariMinHarga',
			data: "idpr=" + idpr + "&id=" + id + "&hargatotal=" + hargatotal + "&idmaterial=" + idmaterial + "&namaterial=" + namaterial + "&description=" + description + "&qty=" + qty + "&hargasatuan=" + hargasatuan + "&diskon=" + diskon + "&pajak=" + pajak + "&jumlahharga=" + jumlahharga + "&note=" + note,
			success: function(html) {
				$("#ForHarga").html(html);
			}
		});
		$.ajax({
			type: "GET",
			url: siteurl + 'purchase_order/CariMinDiskon',
			data: "idpr=" + idpr + "&id=" + id + "&diskontotal=" + diskontotal + "&idmaterial=" + idmaterial + "&namaterial=" + namaterial + "&description=" + description + "&qty=" + qty + "&hargasatuan=" + hargasatuan + "&diskon=" + diskon + "&pajak=" + pajak + "&jumlahharga=" + jumlahharga + "&note=" + note,
			success: function(html) {
				$("#ForDiskon").html(html);
			}
		});
		$.ajax({
			type: "GET",
			url: siteurl + 'purchase_order/CariMinPajak',
			data: "idpr=" + idpr + "&id=" + id + "&taxtotal=" + taxtotal + "&idmaterial=" + idmaterial + "&namaterial=" + namaterial + "&description=" + description + "&qty=" + qty + "&hargasatuan=" + hargasatuan + "&diskon=" + diskon + "&pajak=" + pajak + "&jumlahharga=" + jumlahharga + "&note=" + note,
			success: function(html) {
				$("#ForTax").html(html);
			}
		});
		$.ajax({
			type: "GET",
			url: siteurl + 'purchase_order/CariMinSum',
			data: "idpr=" + idpr + "&id=" + id + "&hargatotal=" + hargatotal + "&diskontotal=" + diskontotal + "&taxtotal=" + taxtotal + "&idmaterial=" + idmaterial + "&namaterial=" + namaterial + "&description=" + description + "&qty=" + qty + "&hargasatuan=" + hargasatuan + "&diskon=" + diskon + "&pajak=" + pajak + "&jumlahharga=" + jumlahharga + "&note=" + note,
			success: function(html) {
				$("#ForSum").html(html);
			}
		});
		$('#data_request #trmaterial_' + id).remove();
	}

	function HapusItem(id) {

	}

	function HitungHarga2(id) {
		var dt_qty = $("#dt_qty_" + id).val();
		var dt_width = $("#dt_totalwidth_" + id).val();
		var dt_hargasatuan = $("#dt_hargasatuan_" + id).val();
		console.log(dt_width);
		$.ajax({
			type: "GET",
			url: siteurl + 'purchase_order/HitungHarga',
			data: "dt_hargasatuan=" + dt_hargasatuan + "&dt_qty=" + dt_qty + "&id=" + id + "&dt_width=" + dt_width,
			success: function(html) {
				$("#jumlahharga_" + id).html(html);
			}
		});

	}

	function get_lokasi() {
		var supplier = $("#id_suplier").val();
		$.ajax({
			type: "GET",
			url: siteurl + 'purchase_order/CariLokasi',
			data: "supplier=" + supplier,
			success: function(html) {
				$("#loi").html(html);
				get_kurs();
			}

		});


	}

	function HitAmmount(id) {
		var alloyprice = getNum($("#dt_alloyprice_" + id).val().split(",").join(""));
		var fabcost = getNum($("#dt_fabcost_" + id).val().split(",").join(""));
		var diskon = getNum($("#dt_diskon_" + id).val().split(",").join(""));
		var pajak = getNum($("#dt_pajak_" + id).val().split(",").join(""));
		var qty = getNum($("#dt_qty_" + id).val().split(",").join(""));
		var hargasatuan = getNum($("#dt_hargasatuan_" + id).val().split(",").join(""));
		var ppn = getNum($("#dt_nilai_ppn_" + id).val().split(",").join(""));
		var persen_ppn = getNum($("#dt_persen_ppn_" + id).val().split(",").join(""));
		var dt_width = getNum($("#dt_totalweight_" + id).val().split(",").join(""));
		var disc_persen = getNum($('#disc_persen_' + id).val().split(',').join(''));
		var disc_num = getNum($('#disc_num_' + id).val().split(',').join(''));
		var loi = $("#loi").val();

		// if(loi == 'Import'){
		// 	var total 	= Number(alloyprice) + Number(fabcost);
		// 	var jumlah 	= total * dt_width;	

		// 	$("#dt_hargasatuan_"+id).val(number_format(total,2));
		// }
		//else{

		// if (disc_num !== ((hargasatuan * qty) * disc_persen / 100)) {
		// 	disc_num = ((hargasatuan * qty) * disc_persen / 100);
		// }


		var total = hargasatuan;
		var jumlah = hargasatuan * qty;
		var jumlah_w_disc = (jumlah - (jumlah * disc_persen / 100));
		var ppn = (jumlah_w_disc * persen_ppn / 100);
		var totalharga = (jumlah_w_disc + ppn);
		// console.log(totalharga);

		// alert(jumlah);
		//}

		var tot_pajak = pajak;
		var tot_diskon = diskon / 100 * jumlah;
		var tot_jumlah = totalharga - tot_diskon + tot_pajak;

		var nilai_ppn = parseFloat(((hargasatuan - (hargasatuan * disc_persen / 100)) * qty) * persen_ppn / 100);
		$("#dt_nilai_ppn_" + id).val(number_format(nilai_ppn, 2));



		$("#dt_jumlahharga_" + id).val(number_format(jumlah, 2));
		$("#dt_totalharga_" + id).val(number_format(totalharga, 2));

		$("#dt_ch_pajak_" + id).val(tot_pajak);
		$("#dt_ch_diskon_" + id).val(tot_diskon);
		$("#dt_ch_jumlah_" + id).val(tot_jumlah);

		$("#disc_persen_" + id).val(number_format(disc_persen, 2));
		$("#disc_num_" + id).val(number_format(disc_num, 2));

		var SUM_JML = 0
		var SUM_DIS = 0
		var SUM_PJK = 0
		var SUM_JMX = 0
		var SUM_PPN = 0
		var SUM_DISC = 0

		$(".ch_diskon").each(function() {
			SUM_DIS += Number($(this).val());
		});

		$(".ch_pajak").each(function() {
			SUM_PJK += Number($(this).val());
		});

		$(".ch_jumlah").each(function() {
			SUM_JML += Number($(this).val());
		});

		$(".ch_jumlah_ex").each(function() {
			SUM_JMX += Number($(this).val().split(",").join(""));
		});
		$(".ch_ppn").each(function() {
			SUM_PPN += Number($(this).val().split(",").join(""));
		});
		$(".disc_num").each(function() {
			SUM_DISC += Number($(this).val().split(",").join(""));
		});

		$("#hargatotal").val(number_format(SUM_JMX, 2));
		$("#totalppn").val(number_format(SUM_PPN, 2));
		$("#totaldisc").val(number_format(SUM_DISC, 2));
		$("#diskontotal").val(number_format(SUM_DIS));
		$("#taxtotal").val(number_format(SUM_PJK));
		$("#subtotal").val(number_format(SUM_JML, 2));

	}


	function cariTotal() {
		var kirim = getNum($("#kirim").val().split(",").join(""));
		var total = getNum($("#hargatotal").val().split(",").join(""));
		var persen_disc = getNum($("#persendisc").val().split(",").join(""));
		var disc = getNum($("#totaldisc").val().split(",").join(""));
		var persen_ppn = getNum($("#persenppn").val().split(",").join(""));
		var ppn = getNum($("#totalppn").val().split(",").join(""));

		// if (persen_disc > 0 && persen_disc !== null) {	
		// 	var disc = parseFloat(total * persen_disc / 100);
		// 	$("#totaldisc").val(number_format(disc, 2));
		// }

		if (persen_ppn > 0 && persen_ppn !== null) {
			var ppn = parseFloat((total - disc) * persen_ppn / 100);
			$("#totalppn").val(number_format(ppn, 2));
		}

		var grandtotal = kirim + total - disc + ppn;
		$("#kirim").val(number_format(kirim, 2));
		$("#subtotal").val(number_format(grandtotal, 2));

	}

	function SumDel() {
		var SUM_JML = 0
		var SUM_DIS = 0
		var SUM_PJK = 0
		var SUM_JMX = 0

		$(".ch_diskon").each(function() {
			SUM_DIS += Number($(this).val());
		});

		$(".ch_pajak").each(function() {
			SUM_PJK += Number($(this).val());
		});

		$(".ch_jumlah").each(function() {
			SUM_JML += Number($(this).val());
		});

		$(".ch_jumlah_ex").each(function() {
			SUM_JMX += Number($(this).val().split(",").join(""));
		});

		$("#hargatotal").val(number_format(SUM_JMX, 2));
		$("#diskontotal").val(number_format(SUM_DIS, 2));
		$("#taxtotal").val(number_format(SUM_PJK, 2));
		$("#subtotal").val(number_format(SUM_JML, 2));

	}

	function TotalSemua() {
		var SUM_JML = 0
		var SUM_DIS = 0
		var SUM_PJK = 0
		var SUM_JMX = 0

		$(".ch_diskon").each(function() {
			SUM_DIS += Number($(this).val());
		});

		$(".ch_pajak").each(function() {
			SUM_PJK += Number($(this).val());
		});

		$(".ch_jumlah").each(function() {
			SUM_JML += Number($(this).val());
		});

		$(".ch_jumlah_ex2").each(function() {
			SUM_JMX += Number($(this).val().split(",").join(""));
		});

		$("#hargatotal").val(number_format(SUM_JMX, 2));
		$("#diskontotal").val(number_format(SUM_DIS, 2));
		$("#taxtotal").val(number_format(SUM_PJK, 2));
		$("#subtotal").val(number_format(SUM_JMX, 2));

	}

	function number_format(number, decimals, dec_point, thousands_sep) {
		// Strip all characters but numerical ones.
		number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
		var n = !isFinite(+number) ? 0 : +number,
			prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
			sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
			dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
			s = '',
			toFixedFix = function(n, prec) {
				var k = Math.pow(10, prec);
				return '' + Math.round(n * k) / k;
			};
		// Fix for IE parseFloat(0.55).toFixed(0) = 0;
		s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
		if (s[0].length > 3) {
			s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
		}
		if ((s[1] || '').length < prec) {
			s[1] = s[1] || '';
			s[1] += new Array(prec - s[1].length + 1).join('0');
		}
		return s.join(dec);
	}

	function getNum(val) {
		if (isNaN(val) || val == '') {
			return 0;
		}
		return parseFloat(val);
	}
</script>
<script src="<?= base_url('assets/js/jquery.maskMoney.js') ?>"></script>
<script src="<?= base_url('assets/js/autoNumeric.js') ?>"></script>
<script>
	$(function() {
		$('#select_department').chosen();
		$('#select_curr').chosen();
		$('#supplier').chosen();
		$('.select').chosen();
		$('#tanggal').datepicker({
			dateFormat: 'yy-mm-dd',
			changeMonth: true,
			changeYear: true,
		});
	});
</script>