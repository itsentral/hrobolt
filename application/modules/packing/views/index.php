<?php
    $ENABLE_ADD     = has_permission('Packing.Add');
    $ENABLE_MANAGE  = has_permission('Packing.Manage');
    $ENABLE_VIEW    = has_permission('Packing.View');
    $ENABLE_DELETE  = has_permission('Packing.Delete');
?>
<style type="text/css">
thead input {
	width: 100%;
}
</style>
<div id='alert_edit' class="alert alert-success alert-dismissable" style="padding: 15px; display: none;"></div>
<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.css')?>">
<link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css" >

<div class="box">
	<div class="box-header">
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<div class="table-responsive">
			<table id="datatable" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No. Order</th>
						<th>No. Order Marketplace</th>
						<th>Customer</th>
						<th>Marketplace</th>
						<th>Jasa Pengiriman</th>
						<th>Estimasi Tanggal Pengiriman</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$number = 1;
						foreach($results['data'] AS $key => $value) {
							++$key;
					?>
						<tr>
							<td><?= $value->code_order ?></td>
							<td><?= $value->code_order_marketplace ?></td>
							<td><?= $value->customer_name ?></td>
							<td><?= $value->marketplace ?></td>
							<td><?= $value->nama_pengiriman ?></td>
							<td><?= $value->delivery_date ?></td>
							<td>
								<?php
									if ($value->status == 3) {
										echo "<p class='label label-info'>Packing</p>";
									} else if ($value->status == 4) {
										echo "<p class='label label-info'>Siap Diprint</p>";
									} else if ($value->status == 5) {
										echo "<p class='label label-info'>Printed</p>";
									}
								?>
							</td>
							<td>
								<?php
									if ($value->status == 3) {
										echo '<button class="btn btn-primary" id="btn-process-packing" onclick="return showModalProcessPacking(this, '.$value->id.', '.$value->code_order.')">Process Packing</button>';
									} else if ($value->status == 4) {
									?>
										<button class="btn btn-success" type="button" onclick="return countLabelPengiriman(this, '<?= $value->code_order ?>', '<?= base_url() . $value->delivery_label ?>')">
											Print PDF Label Pengiriman
										</button>
										<!-- <button  id="btn-print-label-pengiriman" onclick="return printImage('')">Print Label Pengiriman</button> -->
									<?
									} else {
										echo '<button class="btn btn-info" id="btn-view-data">View Data</button>';
									}
								?>
							</td>
						</tr>
					<?php 
							--$key;
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
	<!-- /.box-body -->
</div>

<div class="modal fade" id="modal-process-packing" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<form action="<?= base_url('packing/savePacking') ?>" method="POST" id="form-add-packing">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel"><span class="fa fa-list"></span>&nbsp;Process Packing Kode Order <span id="modal-process-packing-subtitle"></span></h4>
			</div>
			<div class="modal-body" id="ModalView">
				<div class="row" style="margin: 10px 10px; padding: 10px; border: 2px solid #16ab8b;">
					<div class="col-md-3">
						<input type="hidden" name="product_id[]" id="product_id">
						<div class="form-group">
							<label style="width: 100%; border-right: 2px solid #16ab8b;">Scan Barcode</label>
							<input type="text" id="barcode-text-process-packing" class="form-control" />
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label style="width: 100%; border-right: 2px solid #16ab8b;">Produk</label>
							<p id="produk-packing"></p>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label style="width: 100%; border-right: 2px solid #16ab8b;">Qty Barang</label>
							<p id="produk-qty-barang"></p>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>Qty Actual</label>
							<input type="number" name="produk_qty_aktual[]" id="produk-qty-aktual" class="form-control" />
						</div>
					</div>
					<div class="col-md-5">
						<div class="form-group">
							<label>SKU Produk</label>
							<p id="produk-sku"></p>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="form-group">
					<center>
						<button type="button" id="btn-save-process-packing" class="btn btn-success" onclick="return saveData(this, <?= $value->code_order ?>, <?= $value->id ?>)">Simpan Data</button>
					</center>
				</div>
			</div>
		</div>
	</div>
	</form>
</div>


<!-- DataTables -->
<script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
<script src="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.min.js')?>"></script>
<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script> 

<!-- page script -->
<script type="text/javascript">

	$("#datatable").DataTable({
		order: [[0, 'desc']] // mengindex column 0 secara descending
	});

	function imageToPrint(source) {
		return "<html><head><scri"+"pt>"+
					"function step1(){\n" + 
						"setTimeout(step2(), 10})\n"+
					"function step2(){window.print();window.close()}\n</scri"+"pt></head><body onload='return step1()'>\n" + 
				"<img src='" + source + "' /></body></html>";
	}

	function printImage(source) {
		var PageLink = "about:blank";
		var pwa = window.open(PageLink, "_new");
		pwa.document.open();
		pwa.document.write(imageToPrint(source));
		pwa.document.close();
	}

	function countLabelPengiriman(elem, codeOrder, label) {
		$.ajax({
			url: siteurl + active_controller + 'printLabel',
			type: "POST",
			data: {
				codeOrder: codeOrder
			},
			success: function(result) {
				if (result.code == 200) {
					printJS({printable: label, type:'pdf', showModal:true});
				} else {
					alert(result.message);
				}
			}
		});
	}

	function showModalProcessPacking(elem, id, codeorder) {
		var scanner = document.getElementById("barcode-text-process-packing"); // membuat elemen scanner dari field barcode
		// saat proses barcode yang merupakan proses penekanan keyboard, lakukan fungsi berikut
		document.getElementById("barcode-text-process-packing").onkeydown = function() {
			return scanbarcode(scanner, codeorder, 1, id); // menjalankan fungsi scanbarcode
		}

		var qtyframe = document.getElementById("produk-qty-aktual"); // membuat elemen qty frame dari field qty aktual
		// saat proses mengangkat tangan dari keyboard lakukan fungsi berikut
		document.getElementById("produk-qty-aktual").onkeyup = function() {
			return scanqtyaktual(qtyframe, 2, id); // menjalankan fungsi scanqtyaktual
		}

		arrProductSKU = [];

		// mengosongkan field
		$("#barcode-text-process-packing").val("");
		$("#produk-packing").text("");
		$("#produk-qty-barang").text("");
		$("#produk-qty-aktual").val("");

		$("#modal-process-packing-subtitle").text(codeorder) // menampilkan code order
		$('#modal-process-packing').modal('show'); // menampilkan modal

		// ketika proses modal langsung focus ke id yang dituju
		$('#modal-process-packing').on('shown.bs.modal', function () {
			$('#barcode-text-process-packing').focus()
		})
	}

	var barcode = ""; // variable menampung data scanner
	var arrProductSKU = []; // variable arrProductSKU = array yang digunakan untuk menampung data productsku

	// function scanbarcode terdiri dari 4 parameter, yaitu : element, code order, number, id
	// number merupakan penanda field tesebut, dimulai dari 1
	function scanbarcode(elem, code_order, number, id) {

		// jika event keyCode sama dengan 13 (ENTER) atau 9 (TAB) lakukan block code if
		if (event.keyCode == 13 || event.keyCode == 9) {
			var value = ""; // menampung data scanner

			// jika number = 1 maka jalankan block if
			if (number == 1){
				// variable value diisi dengan nilai element dari field barcode awal dengan mengosongkan sisi kiri dan kanan dari spasi
				value = document.getElementById("barcode-text-process-packing").value.trim();
			} else {
				// variable value diisi dengan nilai element dari field barcode sesuai number dengan mengosongkan sisi kiri dan kanan dari spasi
				value = document.getElementById("barcode-text-process-packing-"+number).value.trim();
			}

			// let index = value.indexOf("SKU") + 5; // variable index = ambil nilai index dari kata SKU ditambah 4
			// let calculateText = value.length - index;
			// let text = value.substr(index, calculateText);

			// if (calculateText == 33) {
			// 	if (text.includes("P")) { 
			// 		textLength = text.length; // variable textLength = mengambil nilai panjang karakter text
			// 		text = text.substr(0, textLength - 22).trim(); // variable text = perbarui variable text yang di ambil dari index 0 sampai panjang karakter dikurangi 1, kemudian kosongkan sisi kiri dan kanan dari spasi
			// 		text = text.replace(/\s/g, '');
			// 	}
			// } else if (calculateText == 30) {
			// 	if (text.includes("P")) { 
			// 		textLength = text.length; // variable textLength = mengambil nilai panjang karakter text
			// 		text = text.substr(0, textLength - 22).trim(); // variable text = perbarui variable text yang di ambil dari index 0 sampai panjang karakter dikurangi 1, kemudian kosongkan sisi kiri dan kanan dari spasi
			// 	}
			// } else if (calculateText == 28) {
			// 	if (text.includes("P")) { 
			// 		textLength = text.length; // variable textLength = mengambil nilai panjang karakter text
			// 		text = text.substr(0, textLength - 22).trim(); // variable text = perbarui variable text yang di ambil dari index 0 sampai panjang karakter dikurangi 1, kemudian kosongkan sisi kiri dan kanan dari spasi
			// 	}
			// }

			// alert(text);

			// jika variable text mengandung karakter P, lakukan block if
			// if (text.includes("P")) {
			// 	textUpdate = text.indexOf("P");  
			// 	textLength = text.length; // variable textLength = mengambil nilai panjang karakter text
			// 	text = text.substr(0, textLength - 1).trim(); // variable text = perbarui variable text yang di ambil dari index 0 sampai panjang karakter dikurangi 1, kemudian kosongkan sisi kiri dan kanan dari spasi
			// }

			$.ajax({
				url: siteurl + active_controller + '/scanbarcode', // url yang dituju untuk memproses data ajax
				// data ajax
				data: {
					value: value,
					code_order: code_order,
					number: number
				},
				// metode ajax
				method: 'POST',
				success: function(result) {

					$(".ajax_loader").hide(); // menutup loader image

					if (result.code == 404) {
						return alert(result.message);
					}

					var productsku = ''; // variable productsku = digunakan untuk proses pengecekan apakah product sudah dilakukan scan

					// karena produk sku berbeda di setiap field maka dilakukan pengecekan apakah product sku merupakan field pertama (1)
					// jika iya maka lakukan blok if, hasil ini akan mengembalikan kosong
					if (number == 1) {
						productsku = $("#produk-sku").text(); // variable productsku = mengambil nilai atau text dari id produk-sku
					} else {
						// karena nilai yang harus di cek pada scan yang SELANJUTNYA adalah nilai yang SEBELUMNYA, maka number dilakukan decrement
						number--;

						// jika number sama dengan 1 maka lakukan blok if
						if (number == 1) {
							productsku = $("#produk-sku").text(); // variable productsku = nilai text dari element id produk-sku
						} else { // jika tidak, lakukan blok else
							productsku = $("#produk-sku-"+number).text(); // variable productsku = nilai text dari element id produk-sku sesuai penanda
						}

						arrProductSKU.push(productsku); // masukan productsku ke dalam variable array
						number++; // kembalikan nilai number dengan melakukan increment
					}

					let checkArrProductSKU = arrProductSKU.find(checkProductSKU); // membandingkan nilai yang di ambil dari server dengan data array yang telah di simpan

					// function pembanding produksku
					function checkProductSKU(productsku) {
						return productsku == result.product.sku
					}

					// jika nilai pembanding sama dengan nilai produk sku dari server, lakukan blok if
					if (checkArrProductSKU == result.product.sku) {
						return alert('Barang Sudah Tersedia'); // menampilkan alert
					} else { // jika tidak, lakukan blok else
						// jika penanda sama dengan 1 lakukan blok if, yang mana blok if ini merupakan pengisian data ke dalam field yang sesuai dengan penandanya yaitu 1
						if (number == 1) {
							$("#product_id").val(result.product.product_id);
							$("#produk-packing").text(result.product.nama_produk);
							$("#produk-qty-barang").text(result.product.qty_barang);
							$("#produk-sku").text(result.product.sku);
							$('#produk-qty-aktual').focus();
						} else { // jika tidak lakukan blok else, yang mana blok else ini merupakan pengisian data ke dalam field yang sesuai dengan penandanya yaitu number
							$("#product_id-"+number).val(result.product.product_id);
							$("#produk-packing-"+number).text(result.product.nama_produk);
							$("#produk-qty-barang-"+number).text(result.product.qty_barang);
							$("#produk-sku-"+number).text(result.product.sku);
							$('#produk-qty-aktual-'+number).focus();
						}

						// karena akan dibuat suatu field baru maku lakukan pre-incerement pada penanda yaitu number
						++number;

						var html = "";
						html += '<div class="row" style="margin: 10px 10px; padding: 10px; border: 2px solid #16ab8b;">';
						html += '<div class="col-md-3">'
						html +=	'<div class="form-group">'
						html += 	'<input type="hidden" name="product_id[]" id="product_id-'+ number +'">'
						html +=		'<label style="width: 100%; border-right: 2px solid #16ab8b;">Scan Barcode</label>'
						html +=		'<input type="text" id="barcode-text-process-packing-'+ number +'" onkeyup="return scanbarcode(this, '+ code_order +', '+ number +', '+ id +')" class="form-control" />'
						html +=	'</div>'
						html +=	'</div>'
						html += '<div class="col-md-3">'
						html +=		'<div class="form-group">'
						html +=			'<label style="width: 100%; border-right: 2px solid #16ab8b;">Produk</label>'
						html +=			'<p id="produk-packing-'+ number +'"></p>'
						html +=		'</div>'
						html +=	'</div>'
						html +=	'<div class="col-md-3">'
						html +=		'<div class="form-group">'
						html +=			'<label style="width: 100%; border-right: 2px solid #16ab8b;">Qty Barang</label>'
						html +=			'<p id="produk-qty-barang-'+ number +'"></p>'
						html +=		'</div>'
						html +=	'</div>'

						html +=	'<div class="col-md-3">'
						html +=		'<div class="form-group">'
						html +=			'<label>Qty Actual</label>'
						html +=			'<input type="number" name="produk_qty_aktual[]" onkeyup="return scanqtyaktual(this, '+ ++number +', '+id+')"'; --number
						html += 		'id="produk-qty-aktual-'+ number +'" class="form-control" />'
						html +=		'</div>'
						html +=	'</div>'

						html +=	'<div class="col-md-5">'
						html +=		'<div class="form-group">'
						html +=			'<label>SKU Produk</label>'
						html +=			'<p id="produk-sku-'+ number +'"></p>'
						html +=		'</div>'
						html +=	'</div>'
						html +=	'</div>'

						$("#ModalView").append(html);

					} // $("#btn-save-process-packing").val(number);
				}
			})
        } else {
            if (!event.ctrlKey){
                if (!event.altKey){
                    if (!event.shiftKey){
                        if (event.keyCode >= 32 && event.keyCode <= 126){
                            barcode = barcode + event.key;
							if ("btn-save-process-packing" !== event.target.id) {
								if (number == 1){
									document.getElementById("barcode-text-process-packing").focus();
								} else {
									document.getElementById("barcode-text-process-packing-"+number).focus();
								}
							}
                        }
                    }
                }
            }            
        }
	}

	function saveData(elem, codeOrder, id) {
		codeOrder = $("#modal-process-packing-subtitle").text();

		swal({
            title: "Are you sure to Save Data ?",
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
                var baseurl = siteurl + active_controller + '/savePacking';
				var formData = new FormData($('#form-add-packing')[0]);
				formData.append('code_order', codeOrder);

                $.ajax({
                    url: baseurl,
                    type: "POST",
                    data: formData,
                    cache: false,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(data) {
						// alert(result);
                        if (data.code == 200) {
                            swal({
                                title: "Save Success!",
                                text: data.message,
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
								text: data.message,
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
	}

	function scanqtyaktual(elem, number, id) {
		var value = elem.value;

		var countValue = value.length;

		if (countValue > 5) {
			$("#barcode-text-process-packing-"+number).focus();
		}
	}

    function DataTables(id_category=null){
  		var dataTable = $('#example1').DataTable({
  			"processing" : true,
  			"serverSide": true,
  			"stateSave" : true,
  			"bAutoWidth": true,
  			"destroy": true,
  			"responsive": true,
  			"aaSorting": [[ 1, "asc" ]],
  			"columnDefs": [ {
  				"targets": 'no-sort',
  				"orderable": false,
  			}],
  			"sPaginationType": "simple_numbers",
  			"iDisplayLength": 10,
  			"aLengthMenu": [[10, 20, 50, 100, 150], [10, 20, 50, 100, 150]],
  			"ajax":{
  				url : siteurl+active_controller+'/data_side_accessories',
  				type: "post",
  				data: function(d){
  					d.id_category = id_category
  				},
  				cache: false,
  				error: function(){
  					$(".my-grid-error").html("");
  					$("#my-grid").append('<tbody class="my-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
  					$("#my-grid_processing").css("display","none");
  				}
  			}
  		});
  	}
</script>
