<?php
    $ENABLE_ADD     = has_permission('Marketplace.Add');
    $ENABLE_MANAGE  = has_permission('Marketplace.Manage');
    $ENABLE_VIEW    = has_permission('Marketplace.View');
    $ENABLE_DELETE  = has_permission('Marketplace.Delete');
	
?>
<style type="text/css">
thead input {
	width: 100%;
}

.pdfobject-container { height: 500px; border: 1px solid #ccc; }
</style>
<div id='alert_edit' class="alert alert-success alert-dismissable" style="padding: 15px; display: none;"></div>
<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.css')?>">

<div class="box">
	<!-- <div class="box-header">
		<?php if($ENABLE_VIEW) : ?>
			<a class="btn btn-success btn-sm add" href="javascript:void(0)" title="Add"><i class="fa fa-plus">&nbsp;</i>Add</a>
		<?php endif; ?>
		<span class="pull-right">
		</span>
	</div> -->
	<!-- /.box-header -->
	<div class="box-body">
		<!-- <div class="row">
			<div class="col-md-8">
				<p>Perhatikan untuk melakukan pengisian data varian dan variasi harap mengikuti langkah langkah berikut : </p>
				<ol>
					<li>Isi terlebih dahulu data Variasi</li>
					<li>Setelah itu, data Variasi akan dapat dipilih pada form varian</li>
					<li>Isi form varian sesuai data</li>
				</ol>
			</div>
		</div> -->
		<div class="row">
			<div class="col-md-12">
				<div class="box-body" style="background-color: #3c8dbc;">
					<div style="display: flex; justify-content:space-between">
						<h4 style="font-weight: 700; color:aliceblue;">Table Sales Marketplace</h4>
						<span class="pull-right" style="display: flex;">
							<form action="<?= base_url('/sales_marketplace/exportExcel') ?>" style="margin-right: 5px;" method="POST">
								<button type="submit" class="btn btn-success"><i class="fa fa-file-excel-o">&nbsp;</i>Export Excel</button>
							</form>
							<a class="btn btn-primary btn-sm form-sales-marketplace" href="#" title="Form Variasi"><i class="fa fa-archive">&nbsp;</i> Form Sales Marketplace</a>
						</span>
					</div>
					<div class="table-responsive" style="margin-top: 15px;">
						<table id="datatable" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Kode Order</th>
									<th>Kode SPK</th>
									<th>Marketplace Kode Order</th>
									<th>Marketplace</th>
									<th>Nama Customer</th>
									<th>Tanggal Pengiriman</th>
									<th width="150px">Produk</th>
									<th>Kode SKU</th>
									<th>Qty</th>
									<th>Jasa Pengiriman</th>
									<th>Total Harga</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody style="font-size: 11px;">
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /.box-body -->
</div>

<!-- awal untuk modal dialog -->
<!-- Modal -->
<div class="modal modal-primary" id="modal-sales-marketplace" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel"><span class="fa fa-file-pdf-o"></span>&nbsp;Form Data Marketplace</h4>
			</div>
			<form id="data-form">
			<div class="modal-body" id="MyModalBody">
				<!-- <input type="hidden" name="id_variasi" id="id_variasi"> -->
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Nomor Order</label>
							<input type="text" name="nomor_order_marketplace" id="nomor_order_marketplace" class="form-control">
						</div>
						<div class="form-group">
							<label>Customer Name</label>
							<input type="text" name="customer_name" id="customer_name" class="form-control">
						</div>
						<div class="form-group">
							<label>Tanggal Pengiriman</label>
							<input type="date" name="tanggal_pengiriman" id="tanggal_pengiriman" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Jasa Pengiriman</label>
							<select name="jasa_pengiriman" id="jasa_pengiriman" class="form-control">
								<option>Silahkan Pilih</option>
								<?php foreach($results['dataPengiriman'] AS $dataPengirim) { ?>
									<option value="<?= $dataPengirim->id ?>"><?= $dataPengirim->name ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label>Label Pengiriman</label>
							<input type="file" accept=".jpg, .pdf, .png" name="label_pengiriman" id="label_pengiriman" class="form-control">
							<span class="text-danger">Format yang Diterima: .jpg, .pdf, .png dan ukuran File tidak lebih dari 5MB</span>
						</div>
						<div class="form-group">
							<label>Marketplace</label>
							<select class="form-control" name="marketplace" id="marketplace">
								<option value="">Silahkan Pilih</option>
								<?php foreach($results['dataMarketplace'] AS $marketplace) { 
								?>
								<option value="<?= $marketplace->name ?>"><?= $marketplace->name ?></option>
								<?php		
								} ?>
							</select>
						</div>
					</div>
				</div>

				<hr>

				<div style="display: flex; justify-content: space-between; margin-bottom: 5px">
					<h5>Detail Product</h5>
					<button type="button" class="btn btn-info" id="addProduct">Add Product</button>
				</div>
				
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>SKU Code</th>
										<th>Product</th>
										<th>Qty</th>
										<th>Harga Produk</th>
										<th>Harga Produk + PPn</th>
										<th>Grand Total</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody id="list_product">

								</tbody>
							</table>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4">
						<label for="">Biaya Lain - Lain</label>
						<input type="number" class="form-control" onblur="return countAnotherPrice(this)" name="another_price" id="another_price">
					</div>
					<div class="col-md-6">
						<label for="">Total Price</label>
						<input type="text" id="total_price" name="total_price" class="form-control" readonly />
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" id="btn-modal-variasi" onclick="return saveData()">
					<span class="glyphicon glyphicon-check"></span> 
					Save
				</button>
				<button type="button"  class="btn btn-default" data-dismiss="modal">
				<span class="glyphicon glyphicon-remove"></span>  Close</button>
			</div>
			</form>
		</div>
	</div>
</div>

<!-- awal untuk modal dialog -->
<!-- Modal -->
<div class="modal modal-success" id="modal-view" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel"><span class="fa fa-file-pdf-o"></span>&nbsp;Detail Data Order Marketplace</h4>
			</div>
			<div class="modal-body" id="MyModalBody">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Nomor Order</label>
							<input type="text" name="nomor_order_marketplace" id="view_nomor_order_marketplace" class="form-control">
						</div>
						<div class="form-group">
							<label>Customer Name</label>
							<input type="text" name="customer_name" id="view_customer_name" class="form-control">
						</div>
						<div class="form-group">
							<label>Tanggal Pengiriman</label>
							<input type="text" name="tanggal_pengiriman" id="view_tanggal_pengiriman" class="form-control">
						</div>
						<div class="form-group">
							<label>Nama Produk</label>
							<input type="text" name="product_name" id="view_product_name" class="form-control">
						</div>
						<div class="form-group">
							<label for="">Gambar Produk</label>
							<img id="gambar-produk" src="" width="300px" height="200px" />
						</div>
						<div class="form-group">
							<label for="">Biaya Discount</label>
							<input type="text" name="view_another_price" id="view_another_price" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Jasa Pengiriman</label>
							<input type="text" name="jasa_pengiriman" id="view_jasa_pengiriman" class="form-control">
						</div>
						<div class="form-group">
							<label>Harga Product</label>
							<input type="text" name="price" id="view_price" class="form-control">
						</div>
						<div class="form-group">
							<label>SKU</label>
							<input type="text" name="sku" id="view_sku" class="form-control">
						</div>
						<div class="form-group">
							<label>Qty</label>
							<input type="text" name="qty" id="view_qty" class="form-control">
						</div>
						<div class="form-group">
							<label for="">Gambar Barcode Resi</label>
							<img id="gambar-barcode-resi" src="" width="300px" height="200px" />
							<embed id="pdf-view-barcode-resi" style="display: none;" width="300px" height="200px" src="" type="application/pdf">
						</div>
					</div>
				</div>
				<hr>
			</div>
			<div class="modal-footer">
				<button type="button"  class="btn btn-default" data-dismiss="modal">
					<span class="glyphicon glyphicon-remove"></span>  Close
				</button>
			</div>
		</div>
	</div>
</div>

<div class="modal modal-primary" style="background-color: rgba(160,235,90, 0.5)" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" id="MyModalContent-edit" >
					
		</div>
	</div>
</div>

<div class="modal modal-primary" style="background-color: rgba(160,235,90, 0.5)" id="modal-update-barcode" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" id="MyModalContent-update-barcode" >
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel"><span class="fa fa-file-pdf-o"></span>&nbsp;Update Barcode Resi <span id="edit-barcode-code-order"></span></h4>
			</div>
			<div class="modal-body" id="MyModalBody">
				<div class="row">
					<div class="col-md-6">
						<input type="hidden" id="modal_code_order_barcode">
						<div class="form-group">
							<label>Upload Barcode Order</label>
							<input type="file" accept=".pdf, .jpg, .png, .jpeg" onchange="return loadFile(event)" name="upload_barcode_order" id="upload_barcode_order" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="">Gambar Barcode Resi</label>
							<img id="gambar-upload-barcode-resi" src="" width="300px" height="200px" />
							<embed id="canvas-barcode" style="display: none;" src="" type="application/pdf"></embed>
							<p id="filename-barcode"></p>
						</div>
					</div>
				</div>
				<hr>
			</div>
			<!-- <div class="modal-footer">
				<button type="button" class="btn btn-info" data-dismiss="modal">
					<span class="glyphicon glyphicon-plus"></span>  Save
				</button>
				<button type="button"  class="btn btn-default" data-dismiss="modal">
					<span class="glyphicon glyphicon-remove"></span>  Close
				</button>
			</div> -->
		</div>
	</div>
</div>

<div class="modal modal-primary" style="background-color: rgba(160,235,90, 0.5)" id="modal-selesaikan-order" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content" id="MyModalContent-selesaikan-order" >
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel"><span class="fa fa-file-pdf-o"></span>&nbsp;Form Selesaikan Order <span id="edit-barcode-code-order"></span></h4>
			</div>
			<div class="modal-body" id="MyModalBody">
				<div class="row">
					<div class="col-md-6">
						<input type="hidden" id="modal_code_order_selesaikan_order">
						<div class="form-group">
							<label>Biaya Layanan</label>
							<input type="text" name="form_biaya_layanan" id="form_biaya_layanan" placeholder="10,000" class="form-control">
						</div>
					</div>
				</div>
				<hr>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-info" id="btn-selesaikan-order" data-dismiss="modal">
					<span class="glyphicon glyphicon-plus"></span>  Save
				</button>
				<button type="button"  class="btn btn-default" data-dismiss="modal">
					<span class="glyphicon glyphicon-remove"></span>  Close
				</button>
			</div>
		</div>
	</div>
</div>

<!-- DataTables -->
<script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
<script src="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.min.js')?>"></script>

<script src="https://unpkg.com/pdfobject"></script>

<!-- page script -->
<script type="text/javascript">

	function DelItem(id) {
		$('#list_product #tr_'+id).remove();
		$("#total_price").val("");
	}

	function getSKU(elem, loop) {
		var sku = elem.value;
		$.ajax({
			url: siteurl + active_controller + 'getProductBySKU',
			data: {
				sku: sku
			},
			method: "POST",
			success: function(result) {
				if (result.code == 200) {
					$("#data1_"+loop+"_product").val(result.product.name);
					$("#data1_"+loop+"_price").val(result.product.price);

					var pricePPN = parseFloat(result.product.price)  * (11/100);
					var priceWithPPN = parseFloat(result.product.price) + pricePPN;
					
					$("#data1_"+loop+"_price_plus_ppn").val(Math.round(priceWithPPN));
				} else {
					swal({
						title: "Gagal",
						text : result.message,
						type : "error"
					},)
				}
			}
		})
	}

	let totalValue;

	function countAnotherPrice(elem) {
		var value = totalValue;
		var anotherValue = elem.value;

		var resultValue = value - anotherValue;

		$("#total_price").val(parseFloat(resultValue).toString());
	}

	function calculatePrice(elem, loop) {
		var price = $("#data1_"+loop+"_price").val();
		var priceWithPPN = $("#data1_"+loop+"_price_plus_ppn").val();
		var qty = elem.value;
		var priceAfterPPn = priceWithPPN * qty;
		$("#data1_"+loop+"_price_fix").val(priceAfterPPn);

		var priceItems = $("#list_product").find("tr .price-product");
		var priceAll = parseFloat(0);
		$.each(priceItems, function (k, v) {
			priceAll += parseFloat(v.value);
		});
		$("#total_price").val(parseFloat(priceAll).toString())
		totalValue = $("#total_price").val();
		// console.log(priceAll);
	}

	var loadFile = function(event) {
		var output = document.getElementById('gambar-upload-barcode-resi');

		var file = event.target.files[0];
		var code = $("#modal_code_order_barcode").val();
		var filename = event.target.files[0].name;
		var extension = filename.split('.').pop(); 
		
		var form_data = new FormData();
		form_data.append('file', file);
		form_data.append('code', code);

		if (event.target.files && event.target.files[0]){
			$.ajax({
				url: "<?php echo base_url() ?>sales_marketplace/saveImage",
				type: "POST",
				data: form_data,
				processData: false,
				contentType: false,
				success: function(res) {
					if (res.code == 200) {
						if (extension == 'pdf') {
							$("#gambar-upload-barcode-resi").hide();
							$("#canvas-barcode").show();
							$("#canvas-barcode").attr("src", siteurl + res.data.url);
							$("#filename-barcode").text(filename);
						} else {
							$("#gambar-upload-barcode-resi").show();
							$("#canvas-barcode").hide();
							$("#filename-barcode").text(filename);

							output.src = URL.createObjectURL(event.target.files[0]);
							output.onload = function() {
								URL.revokeObjectURL(output.src) // free memory
							}
							// document.getElementById('image-text').value = res.name
							// console.log(res);
						}
					}
				}
			});
		}        
	};

	function saveData() {
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
                var baseurl = siteurl + 'sales_marketplace/saveFormOrder';
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
                            if (data.status == 2) {
                                swal({
                                    title: "Save Failed!",
                                    text: data.pesan,
                                    type: "warning",
                                    timer: 7000,
                                    showCancelButton: false,
                                    showConfirmButton: false,
                                    allowOutsideClick: false
                                });
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
	}

	$(document).ready(function() {
		$("#addProduct").click(function () { 
			var jumlah	= $('#list_product').find('tr').length;
			if (jumlah == 0 || jumlah == null) {
				var ada		= 0;
				var loop	= 1;
			} else {
				var nilai	= $('#list_product tr:last').attr('id');
				var jum1	= nilai.split('_');
				var loop	= parseInt(jum1[1])+1; 
			}

			// <input type="hidden" id="data1_'+loop+'_price_fix" />
			Template	='<tr id="tr_'+loop+'">';
			Template	+='<td align="left">';
			Template	+='<input type="text" class="form-control input-sm" onchange="return getSKU(this, '+loop+')" name="data1['+loop+'][sku_code]" id="data1_'+loop+'_sku_code" label="FALSE" div="FALSE">';
			Template	+='</td>';
			Template	+='<td align="left">';
			Template	+='<input type="text" class="form-control input-sm" name="data1['+loop+'][product]" id="data1_'+loop+'_product" readonly>';
			Template	+='</td>';
			Template	+='<td align="left">';
			Template	+='<input type="number" class="form-control input-sm" min="0" onkeyup="return calculatePrice(this, '+loop+')" name="data1['+loop+'][qty]" id="data1_'+loop+'_qty" label="FALSE" div="FALSE">';
			Template	+='</td>';
			Template	+='<td align="left">';
			Template	+='<input type="text" class="form-control input-sm" name="data1['+loop+'][price]" id="data1_'+loop+'_price" readonly>';
			Template	+='</td>';
			Template	+='<td align="left">';
			Template	+='<input type="text" class="form-control input-sm" name="data1['+loop+'][price_plus_ppn]" id="data1_'+loop+'_price_plus_ppn" readonly>';
			Template	+='</td>';
			Template	+='<td align="left">';
			Template	+='<input type="text" class="form-control input-sm price-product" name="data1['+loop+'][price_fix]" id="data1_'+loop+'_price_fix" readonly>';
			Template	+='</td>';
			Template	+='<td align="center"><button type="button" class="btn btn-sm btn-danger" title="Hapus Data" data-role="qtip" onClick="return DelItem('+loop+');"><i class="fa fa-trash-o"></i></button></td>';
			Template	+='</tr>';
			$('#list_product').append(Template);
		});

		var dataTable = $('#datatable').DataTable({
			"serverSide": true,
			"stateSave": true,
			"bAutoWidth": true,
			"destroy": true,
			"responsive": true,
			"oLanguage": {
				"sSearch": "<b>Live Search : </b>",
				"sLengthMenu": "_MENU_ &nbsp;&nbsp;<b>Records Per Page</b>&nbsp;&nbsp;",
				"sInfo": "Showing _START_ to _END_ of _TOTAL_ entries",
				"sInfoFiltered": "(filtered from _MAX_ total entries)",
				"sZeroRecords": "No matching records found",
				"sEmptyTable": "No data available in table",
				"sLoadingRecords": "Please wait - loading...",
				"oPaginate": {
				"sPrevious": "Prev",
				"sNext": "Next"
				}
			},
			"aaSorting": [
				[1, "asc"]
			],
			"columnDefs": [{
				"targets": 'no-sort',
				"orderable": false,
			}],
			"sPaginationType": "simple_numbers",
			"iDisplayLength": 10,
			"aLengthMenu": [
				[5, 10, 20, 50, 100, 150],
				[5, 10, 20, 50, 100, 150]
			],
			"ajax": {
				url: siteurl + active_controller + 'getDataJSON',
				type: "post",
				data: function(d) {
				d.activation = 'active'
				},
				cache: false,
				error: function() {
				$(".my-grid-error").html("");
				$("#my-grid").append('<tbody class="my-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
				$("#my-grid_processing").css("display", "none");
				}
			}
		});

		$(".form-sales-marketplace").click(function() {
			$("#modal-sales-marketplace").modal('show');
		});

		$(document).on('click', ".upload-barcode", (function(e) {
			var code = $(this).data('code');

			$.ajax({
				method: "POST",
				url: siteurl + 'sales_marketplace/viewUploadBarcode',
				data: {
					code: code
				},
				success: function(result) {
					$("#edit-barcode-code-order").text(code);
					$("#modal_code_order_barcode").val(code);
					$("#filename-barcode").text(result.data.delivery_label_filename);

					var filename = (result.data.delivery_label == null) ? 'test.test' : result.data.delivery_label;
					// console.log(filename);
					var extension = filename.split('.').pop(); 

					if (extension == 'pdf') {
						$("#canvas-barcode").attr("src", siteurl + filename);
						$("#canvas-barcode").show();
						$("#gambar-upload-barcode-resi").hide();
					} else if (extension == 'test') {
							
					} else {
						$("#gambar-upload-barcode-resi").attr("src", siteurl + filename);
						$("#canvas-barcode").hide();
						$("#gambar-upload-barcode-resi").show();
					}
					var srcImage = "<?= base_url() ?>" +  result.data.delivery_label;
					$("#gambar-upload-barcode-resi").attr('src', srcImage);
					$("#modal-update-barcode").modal('show');
				}
			})
		}));

		$(document).on('click', ".detail", (function(e) {
			var id = $(this).data('id');
			
			$.ajax({
				method: 'POST',
				url: siteurl + 'sales_marketplace/detail',
				data: {
					id:id
				},
				success: function(result) {
					if (result.code == 200) {
						var filename = (result.data.delivery_label == null) ? 'test.test' : result.data.delivery_label;
						// console.log(result.data.another_price);
						var extension = filename.split('.').pop(); 

						$("#view_nomor_order_marketplace").val(result.data.code_order);
						$("#view_customer_name").val(result.data.customer_name);
						$("#view_tanggal_pengiriman").val(result.data.delivery_date);
						$("#view_jasa_pengiriman").val(result.data.delivery_name);
						$("#view_price").val("Rp. " + parseFloat(result.data.price).toString());
						$("#view_sku").val(result.data.sku);
						$("#view_product_name").val(result.data.product_name);
						$("#view_qty").val(result.data.qty);
						$("#view_another_price").val(result.data.another_price);
						$("#gambar-produk").attr("src", siteurl + result.data.fhoto_url);
						if (extension == 'pdf') {
							$("#pdf-view-barcode-resi").attr("src", siteurl + filename);
							$("#pdf-view-barcode-resi").show();
							$("#gambar-barcode-resi").hide();
						} else if (extension == 'test') {

						} else {
							$("#gambar-barcode-resi").attr("src", siteurl + filename);
							$("#pdf-view-barcode-resi").hide();
							$("#gambar-barcode-resi").show();
						}
						$("#modal-view").modal('show');
					} else {

					}
				}			
			});
		}));

		$(document).on('click', ".edit", (function(e) {
			var id = $(this).data('id');
			
			$.ajax({
				method: 'GET',
				url: siteurl + 'sales_marketplace/edit/' + id,
				success: function(result) {
					if (result.code == 404) {
						alert(result.message);
					} else {
						$("#modal-edit").modal();
						$("#MyModalContent-edit").html(result)
					}
				}			
			});
		}));

		$(document).on('click', '.btn-selesai-order', function(e) {
			var code = $(this).data('code');
			$("#modal_code_order_selesaikan_order").val(code);
			$('#modal-selesaikan-order').modal('show');
		});

		$(document).on('click', '#btn-selesaikan-order', function(e) {
			var code = $("#modal_code_order_selesaikan_order").val();
			var biaya_layanan = $("#form_biaya_layanan").val();

			$.ajax({
				url: siteurl + 'sales_marketplace/finish_order',
				method: "POST",
				data: {
					code: code,
					biaya_layanan: biaya_layanan
				},
				success: function(result) {
					if(result.status == 1){
						swal({
							title: "Sukses",
							text : result.pesan,
							type : "success"
							},)
							window.location.reload(true);
					} else {
						swal({
							title : "Error",
							text  : result.pesan,
							type  : "error"
						})
					}
				}
			});
		});
		
		// DELETE DATA
		$(document).on('click', '.btn-batal', function(e){
			e.preventDefault()
			var code = $(this).data('code');
			swal({
				title: "Anda Yakin Membatalkan Order ?",
				text: "Data ini, " + code + " akan dilakukan Pembatalan Order",
				type: "warning",
				showCancelButton: true,
				confirmButtonClass: "btn-info",
				confirmButtonText: "Ya, Batalkan!",
				cancelButtonText: "Tidak Batalkan",
				closeOnConfirm: false
			}, function(){
				$.ajax({
					type:'POST',
					url:siteurl+'sales_marketplace/cancel_order',
					dataType : "json",
					data:{'code':code},
					success:function(result){
						if(result.status == 1){
							swal({
								title: "Sukses",
								text : result.pesan,
								type : "success"
								},)
								window.location.reload(true);
						} else {
							swal({
								title : "Error",
								text  : result.pesan,
								type  : "error"
							})
						}
					},
					error : function(){
						swal({
							title : "Error",
							text  : "Data error. Gagal request Ajax",
							type  : "error"
						})
					}
				})
			});
		})
	});
</script>
