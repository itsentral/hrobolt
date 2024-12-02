<?php
    $ENABLE_ADD     = has_permission('Level_4.Add');
    $ENABLE_MANAGE  = has_permission('Level_4.Manage');
    $ENABLE_VIEW    = has_permission('Level_4.View');
    $ENABLE_DELETE  = has_permission('Level_4.Delete');	
?>

<div class="box box-primary">
    <div class="box-body">
		<form id="data-form" method="post">
			<div class="col-sm-12">
				<div class="input_fields_wrap2">
					<div class="row">
						<input type="hidden" name="id" value="<?= $results['product']->id ?>">
						<input type="hidden" name="id_product_tokopedia" value="<?= $results['product_tokopedia']->id ?>">
						<div class="form-group row">
							<div class="col-md-4">
								<label for="customer">Nama Produk</label>
							</div>
							<div class="col-md-6">
								<input type="text" class="form-control" value="<?= $results['product']->nama?>" readonly>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-4">
								<label for="customer">Nama Produk Marketplace</label>
							</div>
							<div class="col-md-6">
								<input type="text" class="form-control" value="<?= $results['product']->nama_marketplace?>" readonly>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-4">
								<label for="customer">SKU Induk Produk</label>
							</div>
							<div class="col-md-6">
								<input type="text" class="form-control" value="<?= $results['product']->sku_induk?>" readonly>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-4">
								<label for="customer">SKU Varian Produk</label>
							</div>
							<div class="col-md-6">
								<input type="text" class="form-control" value="<?= $results['product']->sku_varian?>" readonly>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-4">
								<label for="customer">Price Produk</label>
							</div>
							<div class="col-md-6">
								<input type="text" class="form-control" value="<?= "Rp. " . number_format($results['product']->price) ?>" readonly>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="">Minimum Order</label>
										<input type="number" name="minimum_order" id="minimum_order" class="form-control" min="1" value="<?= ($results['product_tokopedia']->minimum_order) ?  $results['product_tokopedia']->minimum_order : 1 ?>">
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="">Kondisi</label>
										<select name="kondisi" id="kondisi" class="form-control">
											<option>Silahkan Pilih</option>
											<option value="Baru" <?= ($results['product_tokopedia']->kondisi == 'Baru') ?  'selected' : '' ?>>Baru</option>
											<option value="Bekas" <?= ($results['product_tokopedia']->kondisi == 'Bekas') ?  'selected' : '' ?>>Bekas</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="">Waktu Proses Pre Order</label>
										<input type="number" name="waktu_proses_order" id="waktu_proses_order" class="form-control" min="1" max="30" value="<?= $results['product_tokopedia']->waktu_proses_order ?>">
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="">Asuransi Pengiriman</label>
										<select name="asuransi_pengiriman" id="asuransi_pengiriman" class="form-control">
											<option>Silahkan Pilih</option>
											<option value="Ya" <?= ($results['product_tokopedia']->asuransi_pengiriman == 'Ya') ?  'selected' : '' ?>>Ya</option>
											<option value="Opsional" <?= ($results['product_tokopedia']->asuransi_pengiriman == 'Opsional') ?  'selected' : '' ?>>Opsional</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="">Kurir Pengiriman</label>
										<select name="kurir_pengiriman[]" id="kurir_pengiriman" class="form-control" multiple>
											<?php foreach($results['pengiriman'] AS $pengiriman) { ?>
												<option value="<?= $pengiriman->code_tokopedia ?>"><?= $pengiriman->name ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="">Kurir Pengiriman</label>
										<ul>
											<?php if ($results['dataKurir']) { ?>
											<?php foreach($results['dataKurir'] AS $key => $pengiriman) { 	?>
												<li><?=  $pengiriman->name ?></li>
											<?php } 
											} ?>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<hr>
			<center>
				<button type="submit" class="btn btn-success btn-sm" name="save" id="simpan-data">
				<i class="fa fa-save"></i> Simpan </button>
			</center>
		</form>		  
	</div>
</div>	
	 
				  
<script type="text/javascript">
	//$('#input-kendaraan').hide();
	var base_url			= '<?php echo base_url(); ?>';
	var active_controller	= '<?php echo($this->uri->segment(1)); ?>';
	
	$(document).ready(function(){
		$('#kurir_pengiriman').chosen({
			width: "100%"
		});

		$('#simpan-data').click(function(e) {
			e.preventDefault();
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
			}, function(isConfirm) {
				if (isConfirm) {
					var formData = new FormData($('#data-form')[0]);
					var baseurl = siteurl + 'inventory_4/saveTokopediaInventory';
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
									timer: 7000,
									showCancelButton: false,
									showConfirmButton: false,
									allowOutsideClick: false
								});
								location.reload();
							} else {
								swal({
									title: "Save Failed!",
									text: data.pesan,
									type: "warning",
									timer: 7000,
									showCancelButton: false,
									showConfirmButton: false,
									allowOutsideClick: false
								});
							}
						},
						error: function() {
							swal({
								title: "Error Message !",
								text: 'An Error Occured During Process. Please try again..',
								type: "warning",
								timer: 7000,
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
		});
	});
</script>