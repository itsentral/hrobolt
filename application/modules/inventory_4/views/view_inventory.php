<?php
    $ENABLE_ADD     = has_permission('master_bentuk.Add');
    $ENABLE_MANAGE  = has_permission('master_bentuk.Manage');
    $ENABLE_VIEW    = has_permission('master_bentuk.View');
    $ENABLE_DELETE  = has_permission('master_bentuk.Delete');	
?>
<div class="box box-primary">
    <div class="box-body">
		<form id="data-form" method="post">
			<div class="col-sm-12">
				<div class="input_fields_wrap2">
					<div class="row">
						<div class="form-group row">
							<div class="col-md-4">
								<label for="customer">Jenis Produk</label>
							</div>
							<div class="col-md-6">
								<input type="text" class="form-control" value="<?= $results['product']->jeniskategori?>" readonly>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-4">
								<label for="customer">Brand Produk</label>
							</div>
							<div class="col-md-6">
								<input type="text" class="form-control" value="<?= $results['product']->brandkategori?>" readonly>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-4">
								<label for="customer">Tipe Produk</label>
							</div>
							<div class="col-md-6">
								<input type="text" class="form-control" value="<?= $results['product']->tipekategori?>" readonly>
							</div>
						</div>
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
								<input type="text" class="form-control" value="<?= "Rp. " . number_format($results['product']->price, 2, ",", ".") ?>" readonly>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-4">
								<label for="barcode_image">Barcode Image</label>
							</div>
							<div class="col-md-6">
								<?php
									$imgpath = base_url($results['product']->barcode);
									$imageinfo = pathinfo($imgpath, PATHINFO_EXTENSION);
									if ($imginfo == 'pdf') {
										echo $imagepath;
									} else {
								?>
									<img src="<?= $imgpath ?>" width="250px" height="250px" />
								<?php
									}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>		  
	</div>
</div>	
	
				  
				  
				  
<script type="text/javascript">
	//$('#input-kendaraan').hide();
	var base_url			= '<?php echo base_url(); ?>';
	var active_controller	= '<?php echo($this->uri->segment(1)); ?>';
	
	$(document).ready(function(){
		 var data_pay	        = <?php echo json_encode($results['supplier']);?>;	
			var max_fields2      = 10; //maximum input boxes allowed
			var wrapper2         = $(".input_fields_wrap2"); //Fields wrapper
			var add_button2      = $(".add_field_button2"); //Add button ID
			//console.log(persen);

			var x2 = 1; //initlal text box count
			$(add_button2).click(function(e){ //on add input button click
			  e.preventDefault();
			  if(x2 < max_fields2){ //max input box allowed
				x2++; //text box increment
				
				$(wrapper2).append('<div class="row">'+
				'<div class="col-xs-1">'+x2+'</div>'+
				'<div class="col-xs-3">'+
				'<div class="input-group">'+
				'<input type="text" name="hd'+x2+'[produk]"  class="form-control input-sm" value="">'+
				'</div>'+
				'<div class="input-group">'+
				'<input type="text" name="hd'+x2+'[costcenter]"  class="form-control input-sm" value="">'+
				'</div>'+
				'<div class="input-group">'+
				'<input type="text" name="hd'+x2+'[mesin]"  class="form-control input-sm" value="">'+
				'</div>'+
				'<div class="input-group">'+
				'<input type="text" name="hd'+x2+'[mold_tools]"  class="form-control input-sm" value="">'+
				'</div>'+
				'</div>'+
				'<a href="#" class="remove_field2">Remove</a>'+
				'</div>'); //add input box
				$('#datepickerxxr'+x2).datepicker({
				  format: 'dd-mm-yyyy',
				  autoclose: true
				});
			  }
			});

			$(wrapper2).on("click",".remove_field2", function(e){ //user click on remove text
			  e.preventDefault(); $(this).parent('div').remove(); x2--;
			})
		
});
</script>