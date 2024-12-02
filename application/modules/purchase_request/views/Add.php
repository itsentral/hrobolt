<?php
	$tanggal = date('Y-m-d');
?>

<div class="box box-primary">
    <div class="box-body">
		<form id="data-form" method="post">
			<div class="col-sm-12">
				<div class="input_fields_wrap2"> 
					<div class="row">
						<a href="<?= base_url('purchase_request') ?>" class="btn btn-default">Back</a>
						<center><label for="customer" ><h3>Purchase Request</h3></label></center>
						<div class="col-sm-12">
							<div class="col-sm-6">
								<div class="form-group row">
									<div class="col-md-4">
										<label for="customer">No. Purchase Request</label>
									</div>
									<div class="col-md-8" hidden>
										<input type="text" class="form-control" id="no_pr"  required name="no_pr" readonly placeholder="ID PR">
									</div>
									<div class="col-md-8">
										<input type="text" class="form-control" id="no_surat"  required name="no_surat" readonly placeholder="No. Purchase Request">
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="col-sm-6">
								<div class="form-group row">
									<div class="col-md-4">
										<label for="customer">Tanggal Purchase Request</label>
									</div>
									<div class="col-md-8">
										<input type="date" class="form-control datepicker" id="tanggal" value="<?= $tanggal ?>" onkeyup required name="tanggal" placeholder="yyyy-mm-dd">
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="col-sm-6">
								<div class="form-group row">
									<div class="col-md-4">
										<label for="id_customer">Department Requestor</label>
									</div>
									<div class="col-md-8">
										<select class="form-control select2department" onchange="getKaryawan(this)" name="requestor_departement" id="requestor_departement">
											<option>Silahkan Pilih</option>
											<?php 
												foreach($results['departements'] AS $departement) {
											?>
												<option value="<?= $departement->id ?>"><?= strtoupper($departement->nama) ?></option>
											<?php
												}
											?>
										</select>
										<!-- <input type="text" class="form-control" id="requestor" required name="requestor"  > -->
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group row">
									<div class="col-md-3">
										<label for="id_customer">PIC Requestor</label>
									</div>
									<div class="col-md-9">
										<select class="form-control select2department" name="requestor_employee" id="requestor_employee">
											<option>Silahkan Pilih</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="col-sm-6">
								<div class="form-group row">
									<div class="col-md-4">
										<label for="">Tingkat Kebutuhan</label>
									</div>
									<div class="col-md-8">
										<select class="form-control" name="tingkat_kebutuhan" id="tingkat_kebutuhan">
											<option>Silahkan Pilih</option>
											<option value="sangat penting">Sangat Penting</option>
											<option value="penting">Penting</option>
											<option value="biasa">Biasa</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group row">
									<div class="col-md-3">
										<label for="">Alasan Request</label>
									</div>
									<div class="col-md-9">
										<Textarea class="form-control" rows="5" name="alasan_request"></Textarea>
									</div>
								</div>
							</div>
						</div>

						<div class="col-sm-12">
							<div class="form-group row">
								<button type='button' class='btn btn-md btn-success' style="width: 12rem;" title='Ambil' id='tbh_ata' data-role='qtip' data-klik='0'><i class='fa fa-plus'></i> Add</button>
							</div>
							<div class="form-group row" >
								<table class='table table-bordered table-striped'> 
									<thead>
										<tr class='bg-blue'>
											<th width='30%'>Produk</th>
											<th width='8%'>SKU Produk</th>
											<th width='8%'>Qty (Unit)</th>
											<th width='20%'>Supplier</th>
											<th width='10%'>Tanggal Dibutuhkan</th>
											<th width='30%'>Keterangan</th>
											<th width='5%'>Aksi</th>
										</tr>
									</thead>
									<tbody id="data_request">
									</tbody>
								</table>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<center>
									<button type="submit" style="width: 32rem;" class="btn btn-success btn-md" name="save" id="simpan-com"><i class="fa fa-save"></i> Simpan</button>
								</center>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>		  
	</div>
</div>	
	
<style>
	.select2 {
		width:100%!important;
	}
	.datepicker{
		cursor: pointer;
	}
</style>			  
				  
<script src="<?php echo base_url('assets/js/jquery.maskMoney.js'); ?>"></script>				  
<script type="text/javascript">
	//$('#input-kendaraan').hide();
	var base_url			= '<?php echo base_url(); ?>';
	var active_controller	= '<?php echo($this->uri->segment(1)); ?>';
	
	$(document).ready(function() {	
		var max_fields2      = 10; //maximum input boxes allowed
		var wrapper2         = $(".input_fields_wrap2"); //Fields wrapper
		var add_button2      = $(".add_field_button2"); //Add button ID
		
		$(".select2department").select2();
	
		$('#simpan-com').click(function(e) {
			e.preventDefault();
			var deskripsi	= $('#deskripsi').val();
			var image	= $('#image').val();
			var idtype	= $('#inventory_1').val();
			
			var data, xhr;
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
						var formData 	=new FormData($('#data-form')[0]);
						var baseurl=siteurl+'purchase_request/SaveNew';
						$.ajax({
							url			: baseurl,
							type		: "POST",
							data		: formData,
							cache		: false,
							dataType	: 'json',
							processData	: false, 
							contentType	: false,				
							success		: function(data){								
								if(data.status == 1){											
									swal({
										  title	: "Save Success!",
										  text	: data.pesan,
										  type	: "success",
										  timer	: 7000,
										  showCancelButton	: false,
										  showConfirmButton	: false,
										  allowOutsideClick	: false
										});
									window.location.href = base_url + active_controller;
								}else{
									
									if(data.status == 2){
										swal({
										  title	: "Save Failed!",
										  text	: data.pesan,
										  type	: "warning",
										  timer	: 7000,
										  showCancelButton	: false,
										  showConfirmButton	: false,
										  allowOutsideClick	: false
										});
									}else{
										swal({
										  title	: "Save Failed!",
										  text	: data.pesan,
										  type	: "warning",
										  timer	: 7000,
										  showCancelButton	: false,
										  showConfirmButton	: false,
										  allowOutsideClick	: false
										});
									}
									
								}
							},
							error: function() {
								
								swal({
								  title				: "Error Message !",
								  text				: 'An Error Occured During Process. Please try again..',						
								  type				: "warning",								  
								  timer				: 7000,
								  showCancelButton	: false,
								  showConfirmButton	: false,
								  allowOutsideClick	: false
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

	function getKaryawan(element) {
		var idDepartement = element.value;
		$.ajax({
            type:"GET",
            url:siteurl+'purchase_request/getKaryawan',
            data:"iddepartement="+idDepartement,
            success:function(result){
				var html = "";
				$.each(result.value, function(key, value) {
					html += '<option value="'+value.id+'">'+value.nm_karyawan+'</option>';
				});
				$("#requestor_employee").append(html);
            }
        });
	}

	$('#tbh_ata').on( 'click', function () {
		var jumlah = $('#list_spk').find('tr').length;
		var nomor = $(this).data('klik'); 
		var klik = parseInt(nomor)+parseInt(1);
		
		$.ajax({
			type:"GET",
			url:siteurl+'purchase_request/AddMaterial',
			data:"jumlah="+nomor,
			success:function(html){
				$("#data_request").append(html);
				$('.select2').select2();
				$('.datepicker').datepicker({
					dateFormat: 'yy-mm-dd',
					changeMonth:true,
					changeYear:true,
				});
			}
		});
		
		$(this).data('klik',klik);
		//alert(klik);
	});	

	// function addmaterial(){ 
	// 	var jumlah	=$('#data_request').find('tr').length;
	// 	$.ajax({
    //         type:"GET",
    //         url:siteurl+'purchase_request/AddMaterial',
    //         data:"jumlah="+jumlah,
    //         success:function(html){
    //            $("#data_request").append(html);

	// 		   $('.select2').select2();
	// 			$('.autoNumeric').autoNumeric();
	// 			$('.datepicker').datepicker({
	// 				dateFormat: 'yy-mm-dd',
	// 				changeMonth:true,
	// 				changeYear:true,
	// 			});
    //         }
    //     });
    // }

	function CariProperties(id) {
        var idmaterial=$("#dt_idmaterial_"+id).val();
		$.ajax({
            type:"GET",
            url:siteurl+'purchase_request/getWidth',
            data:"idmaterial="+idmaterial+"&id="+id,
            success:function(result){
				document.getElementById("dt_width_"+id).value = result.value;
            }
        });
		$.ajax({
            type:"GET",
            url:siteurl+'purchase_request/getLength',
            data:"idmaterial="+idmaterial+"&id="+id,
            success:function(result){
				document.getElementById("dt_length_"+id).value = result.value;
            }
        });
		$.ajax({
            type:"GET",
            url:siteurl+'purchase_request/getWeight',
            data:"idmaterial="+idmaterial+"&id="+id,
            success:function(result){
				document.getElementById("dt_weight_"+id).value = result.value;
            }
        });
		$.ajax({
            type:"GET",
            url:siteurl+'purchase_request/CariSupplier',
            data:"idmaterial="+idmaterial+"&id="+id,
            success:function(html){
               $("#supplier_"+id).html(html);
			   $('.select2').select2();
            }
        });
		$.ajax({
            type:"GET",
            url:siteurl+'purchase_request/CariKodeproduk',
            data:"idmaterial="+idmaterial+"&id="+id,
            success:function(html){
               $("#kodeproduk_"+id).html(html);
            }
        });
    }

	function HapusItem(id) {
		$('#data_request #tr_'+id).remove();	
	}
</script>