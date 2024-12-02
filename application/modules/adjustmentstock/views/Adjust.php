<?php
foreach ($results['inventory_3'] as $inventory_3){
}
	
$idstock = $results['idstock'];

?>
 <div class="box box-primary">
    <div class="box-body">
		<form id="data-form" method="post">
						<div class="col-sm-12">
						   <div class="input_fields_wrap2">
								<div class="row">
									<div class="form-group row">
									<div class="col-md-12">
									<div class="col-md-6">
										<div class="col-md-4">
									    <label for="customer">Nama Material</label>
									    </div>
									    <div class="col-md-6" hidden >
						<input type="text" class="form-control" id="id_material" value="<?= $inventory_3->id_category3 ?>" readonly required name="id_material" placeholder="Id Material">
						<input type="text" class="form-control" id="id_stock" value="<?= $idstock?>" readonly required name="id_stock" placeholder="Id stock">
									    </div>
										<div class="col-md-6" >
						<input type="text" class="form-control"  id="nama_material" value="<?= $inventory_3->nama ?>" readonly required name="nama_material" placeholder="Nama Material">
									    </div>
									</div>
									</div>
						</div>
						<div class="form-group row">
							<div class="col-md-12">
									<div class="col-md-6">
										<div class="col-md-4">
									    <label for="customer">Adjust</label>
									    </div>
									    <div class="col-md-6" >
						<select class="form-control" id="adjustment"  name="adjustment" onchange="CariAdjustment()"> 
						<option value="">--Pilih--</option>
						<option value="PLUS">PLUS</option>
						<option value="MINUS">MINUS</option>
						<!--<option value="MUTASI">MUTASI</option>-->
						</select>
									    </div>
									</div>
						</div>
						</div>
						<div id="inputancustom">
					
						</div>
						<div class="form-group row">
							<div class="col-md-12">
							<div class="col-md-12">
										<div class="col-md-4">
									    <label for="customer">Alasan / Keterangan</label>
									    </div>
										<div class="col-md-6" >
						<input type="text" class="form-control"  id="note" required name="note" placeholder="Alasan / Keterangan">
									    </div>
									</div>
							</div>
						</div>
								</div>
							</div>
						</div>
				 	<hr>
					<center>
					<button type='submit' class='btn btn-success btn-sm' name='save' id='simpan-plus'><i class='fa fa-save'></i>Simpan</button>
					</center>
					
				  </form>
				  
				  
				  
	</div>
</div>	
	
				  
				  
				  
<script type="text/javascript">
	//$('#input-kendaraan').hide();
	var base_url			= '<?php echo base_url(); ?>';
	var active_controller	= '<?php echo($this->uri->segment(1)); ?>';
	
	$(document).ready(function(){
		 var data_pay	        = <?php echo json_encode($results['supplier']);?>;	
		 
				  ///INPUT PERKIRAAN KIRIM
			
			
			var max_fields2      = 10; //maximum input boxes allowed
			var wrapper2         = $(".input_fields_wrap2"); //Fields wrapper
			var add_button2      = $(".add_field_button2"); //Add button ID

			//console.log(persen);

			var x2 = 1; //initlal text box count
	$('#simpan-plus').click(function(e){
			e.preventDefault();
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
						var baseurl=siteurl+'adjustmentstock/SavePlus';
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
	function CariAdjustment(){
	    var adjus=$('#adjustment').val();
		var id_material=$('#id_material').val();
		$.ajax({
            type:"GET",
            url:siteurl+'adjustmentstock/LotNumber',
            data:"adjus="+adjus+"&id_material="+id_material,
            success:function(html){
               $('#form_lotno').html(html);
            }
        });
		if(adjus == "PLUS"){
			$.ajax({
            type:"GET",
            url:siteurl+'adjustmentstock/FormPlus',
            data:"adjus="+adjus+"&id_material="+id_material,
            success:function(html){
               $('#inputancustom').html(html);
            }
			});
		}else if(adjus == "MINUS"){
			$.ajax({
            type:"GET",
            url:siteurl+'adjustmentstock/FormMinus',
            data:"adjus="+adjus+"&id_material="+id_material,
            success:function(html){
               $('#inputancustom').html(html);
            }
			});
		} else if(adjus == "MUTASI"){
			$.ajax({
            type:"GET",
            url:siteurl+'adjustmentstock/FormMutasi',
            data:"adjus="+adjus+"&id_material="+id_material,
            success:function(html){
               $('#inputancustom').html(html);
            }
			});
		}
	}
	function HitungPlusJml(){
	    var total_qty=$('#total_qty').val();
		var total_berat=$('#total_berat').val();
		$.ajax({
            type:"GET",
            url:siteurl+'adjustmentstock/HitungJumlah',
            data:"total_qty="+total_qty+"&total_berat="+total_berat,
            success:function(html){
               $('#total_jumlah_berat').val(html);
            }
        });
	}
	function HitungJumlahMinus(){
	    var mother_qty=$('#mother_qty').val();
		var total_qty=$('#total_qty').val();
		var total_berat=$('#total_berat').val();
		if(total_qty > mother_qty) {
					swal("Peringatan", "Pengurangan Qty Lebih dari Qty Stock Yang Ada", "error");
		return false;
		}else{
		$.ajax({
            type:"GET",
            url:siteurl+'adjustmentstock/HitungJumlah',
            data:"total_qty="+total_qty+"&total_berat="+total_berat,
            success:function(html){
               $('#total_jumlah_berat').val(html);
            }
        });
		}
	}
	function GetDataMinus(){
		var id_stock=$('#id_stock').val();
		$.ajax({
            type:"GET",
            url:siteurl+'adjustmentstock/AmbilDataMinus',
            data:"id_stock="+id_stock,
            success:function(html){
               $('#inputancustom').html(html);
            }
        });
	}
	function GetDataMutasi(){
		var id_stock=$('#id_stock').val();
		$.ajax({
            type:"GET",
            url:siteurl+'adjustmentstock/AmbilDataMutasi',
            data:"id_stock="+id_stock,
            success:function(html){
               $('#inputancustom').html(html);
            }
        });
	}
</script>