<?php
    $ENABLE_ADD     = has_permission('Trans_inquiry.Add');
    $ENABLE_MANAGE  = has_permission('Trans_inquiry.Manage');
    $ENABLE_VIEW    = has_permission('Trans_inquiry.View');
    $ENABLE_DELETE  = has_permission('Trans_inquiry.Delete');
	$tanggal = date('Y-m-d');
	foreach ($results['tr_spk'] as $tr_spk){
	}	
?>
<input type='hidden' id='urut' value='0'>
 <div class="box box-primary">
    <div class="box-body">
		<form id="data-form" method="post" autocomplete='off'>
			<div class="col-sm-12">
				<div class="input_fields_wrap2">
			<div class="row">
		<center><label for="customer" ><h3>Delivery Order</h3></label></center>
		<div class="col-sm-12">
		<div class="col-sm-6">
			<div class="form-group row">
				<div class="col-md-4">
					<label for="no_spk">Customer</label>
				</div>
				<div class="col-md-8">
				<input type="text" class="form-control" value = '<?= $tr_spk->nama_customer ?>' id="nama_customer" onkeyup required name="nama_customer" readonly >
			</div>
			<div class="col-md-8" hidden>
				<input type="text" class="form-control" value = '<?= $tr_spk->id_customer ?>' id="id_customer" onkeyup required name="id_customer" readonly >
			</div>
			</div>
		</div>
		</div>
		<div class="col-sm-12">
		<div class="col-sm-6">
		<div class="form-group row" >
			<div class="col-md-4">
					<label for="no_spk">No. Spk Marketing</label>
				</div>
				<div class="col-md-8">
					<input type="text" class="form-control" id="no_spk" value="<?= $tr_spk->no_spk_marketing ?>" required name="no_spk" readonly placeholder="No.SPK Marketing">
				</div>
				<div class="col-md-8">
                    <input type='hidden' id='id_delivery' name='id_delivery' value='<?= $results['id'];?>'>
					<input type="hidden" class="form-control" id="no_surat" value="<?= $tr_spk->no_surat ?>"   required name="no_surat" readonly placeholder="No.SPK">
			</div>
			
		</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group row">
				<div class="col-md-4">
				<label for="reff">Reff</label>
			</div>
			<div class="col-md-8">
				<input type="text" class="form-control" id="reff" onkeyup required name="reff" value = '<?= $tr_spk->reff ?>' readonly >
			</div>
			</div>
		</div>
		</div>
		
		<div class="col-sm-12">
		<div class="col-sm-6">
		<div class="form-group row" id="driver">
			<div class="col-md-4">
				<label for="driver">Driver</label>
			</div>
			<div class="col-md-8">
				<input type="text" class="form-control" id="driver" name="driver" value = '<?= $tr_spk->driver ?>' readonly >
			</div>
			
		</div>
		</div>
		<div class="col-sm-6">
		<div class="form-group row">
			<div class="col-md-4">
				<label for="driver">No Kendaraan</label>
			</div>
			<div class="col-md-8">
				<input type="text" class="form-control" id="nopol" name="nopol" value = '<?= $tr_spk->nopol ?>' >
			</div>
		</div>
		</div>
		
		</div>
		

		<div class="col-sm-12">
			<div class="form-group row" >
				<table class='table table-bordered table-striped' id='MyTable'>
					<thead>
						<tr class='bg-blue'>
						    <th class='text-center' width='10%'>Id Material</th>
							<th class='text-center' width='30%'>Material</th>
							<th class='text-center' width='7%'>Width</th>
							<th class='text-center' width='7%'>Length</th>
							<th class='text-center' width='7%'>Qty Order</th>
							<th class='text-center' width='5%'>Action</th>
							<th class='text-center' width='20%'>Lot</th>
							<th class='text-center' width='5%' >Qty</th>
							<th class='text-center' width='5%'>Berat</th>
							<th class='text-center' width='10%'>Remarks</th>
							<th class='text-center' width='4%'>#</th> 
						</tr>
					</thead>
					<tbody>
					<?php
					
					    $dt = $this->db->query("SELECT * FROM dt_delivery_order_child WHERE id_delivery_order ='$tr_spk->id_delivery_order' AND bantuan='0' GROUP BY id_material, width")->result();
						
						
						$loop			= 0; 
						foreach($dt AS $dt){
							$loop++;
							$id_category3	= $dt->id_material;
							
							$lot			= $this->db->query("SELECT * FROM dt_delivery_order_child WHERE id_material='$dt->id_material' AND width = $dt->width AND id_delivery_order = '$dt->id_delivery_order' ")->result();	
							
							// print_r($lot);
							// exit;
							
							 
							
							
								
							echo "
							<tr class='baris_".$loop."'>
								<td rowspan='1' class='id_".$loop."'>
								<input type='text' class='form-control input-sm'  value='$dt->id_material' name='hd[$loop][id_material]' id='id_material_$loop' readonly>
								</td>
								<td rowspan='1' class='id_".$loop."'>					
									<input type='hidden' value='$dt->id_material' name='hd[$loop][no_alloy]' id='no_alloy_$loop' readonly>
									<input type='hidden' value='$dt->thickness' name='hd[$loop][thickness]' id='thickness_$loop' readonly>
									<input type='text' class='form-control input-sm' value='$dt->nm_material' name='hd[$loop][material]' id='material_$loop'  readonly>
								</td>
								<td rowspan='1' class='id_".$loop."'><input type='text' class='form-control input-sm text-right' value='".number_format($dt->width,2)."' name='hd[$loop][width]'  id='width_$loop' readonly></td>
								<td rowspan='1' class='id_".$loop."'><input type='text' class='form-control input-sm text-right' value='".number_format($dt->length,2)."' name='hd[$loop][length]' id='length_$loop' readonly></td>
								<td rowspan='1' class='id_".$loop."'><input type='text' class='form-control input-sm text-right' value='".number_format($dt->qty_order,2)."' name='hd[$loop][qty_produk]' id='qty_$loop' readonly></td>
								<td rowspan='1' class='id_".$loop."'>
									<button type='button' class='btn btn-sm btn-success pluss' title='Plus' data-id='".$loop."'>Add</button>
								</td>
								
							</tr>
							";
							
							if(!empty($lot)){
							$numb = 0;
							$totalqty =0;
							$totalberat =0;
							foreach($lot AS $lot){
								
							$totalqty += $lot->qty_mat;
							$totalberat += $lot->weight_mat;
							$numb++;
								
								
								echo" <tr id='row_".$loop."' class='baris_".$loop.$numb."'>
								<td rowspan='1' class='id_".$loop.$numb."'>
								<input type='text' class='form-control input-sm' id='dp_id_material_$loop$numb'  value='$lot->id_material' name='dp[$loop$numb][id_material]' readonly>
								</td>
								<td rowspan='1' class='id_".$loop.$numb."'>					
									<input type='hidden' value='$lot->no_alloy' id='dp_no_alloy_$loop$numb' name='dp[$loop$numb][no_alloy]' readonly>
									<input type='hidden' value='$lot->thickness' id='dp_thickness_$loop$numb' name='dp[$loop$numb][thickness]' readonly>
									<input type='text' class='form-control input-sm' value='$lot->nm_material' id='dp_material_$loop$numb' name='dp[$loop$numb][material]' readonly>
								</td>
								<td rowspan='1' class='id_".$loop.$numb."'>
									<input type='text' class='form-control input-sm text-right' value='".number_format($lot->width,2)."' id='dp_width_$loop$numb' name='dp[$loop$numb][width]' readonly>
								</td>
								<td rowspan='1' class='id_".$loop.$numb."'>
									<input type='text' class='form-control input-sm text-right' value='".number_format($lot->length,2)."' id='dp_length_$loop$numb' name='dp[$loop$numb][length]' readonly>
									</td>
								<td rowspan='1' class='id_".$loop.$numb."'><input type='text' class='form-control input-sm text-right' value='".number_format($lot->qty_order,2)."'  id='dp_qty_produk_$loop$numb' name='dp[$loop$numb][qty_produk]' readonly></td>
								<td rowspan='1' class='id_".$loop.$numb."'>
								
								</td>";
								
								
								echo"<td>";
								echo"<input type='hidden' value='0' name='dp[$loop$numb][bantuan]' readonly>
								
								<input type='text' class='form-control' value='$lot->lotno' id='dp_lot_$loop$numb' name='dp[$loop$numb][lot]' readonly>			
								
								</td>
								<td><input type='text' class='form-control input-sm text-right autoNumeric' value='$lot->qty_mat' placeholder='Qty' id='dp_qty_mat_$loop$numb' required name='dp[$loop$numb][qty_mat]'></td>
								<td><input type='text' class='form-control input-sm text-right autoNumeric' placeholder='Weight' id='dp_weight_mat_$loop$numb' required name='dp[$loop$numb][weight_mat]' value='$lot->weight_mat'></td>
								<td><input type='text' class='form-control input-sm' placeholder='Remarks' tabindex=1 id='dp_remarks_$loop$numb' name='dp[$loop$numb][remarks]' value='$lot->remark'></td>
								
								<td><a class='text-red' href='javascript:void(0)' title='Hapus' onClick='delRow($loop$numb,$loop)'><i class='fa fa-trash'></i>
								</a></td>
							</tr>";
							
							
							};
							echo"<td colspan='11' id='tambah_$loop'> </td>";
							
							echo" <tr  class='bg-blue'>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td><input type='text' class='form-control input-sm text-right autoNumeric' id='totalqty$loop'  name='totalqty' value='$totalqty' readonly></td>
								<td><input type='text' class='form-control input-sm text-right autoNumeric' id='totalberat$loop'  name='totalberat' value='$totalberat' readonly></td>
								<td></td>				
								<td></td>
							</tr>
							";
							
							};
						 
						}; 
						?>
					</tbody>
					
				</table>
			</div>
		</div>
			<center>
				<button type="submit" class="btn btn-success btn-sm" name="save" id="simpan-com">Simpan</button>
				<a class="btn btn-danger btn-sm" href="<?= base_url('/delivery_order/') ?>"  title="Edit">Kembali</a>
			</center>
			</div>
		</div>
		</form>		  
	</div>
</div>	
	
				  
				  
<script src="<?= base_url('assets/js/autoNumeric.js')?>"></script>			  
<script type="text/javascript">
	//$('#input-kendaraan').hide();
	var base_url			= '<?php echo base_url(); ?>';
	var active_controller	= '<?php echo($this->uri->segment(1)); ?>';
	
	$(document).ready(function(){	
		var max_fields2      = 10; //maximum input boxes allowed
		var wrapper2         = $(".input_fields_wrap2"); //Fields wrapper
		var add_button2      = $(".add_field_button2"); //Add button ID	
		$('.select').select2();	

		$(document).on('change', '#id_customerx', function(e){
			e.preventDefault();
			$.ajax({
				url: siteurl+'delivery_order/get_penawaran',
				cache: false,
				type: "POST",
				data: "id="+this.value,
				dataType: "json",
				success: function(data){
					$("#no_spk").html(data.option).trigger("chosen:updated");
				},
				error: function() {
					swal({
						title				: "Error Message !",
						text				: 'Connection Timed Out ...',
						type				: "warning",
						timer				: 5000
					});
				}
			});
		});

		$('#simpan-com').click(function(e){
			e.preventDefault();
			var deskripsi	= $('#deskripsi').val();
			var image	= $('#image').val();
			var idtype	= $('#inventory_1').val();
			// alert('Development');
			// return false;
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
						var baseurl=siteurl+'delivery_order/SaveNewHeaderEdit';
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

	function get_produk(){ 
        var no_penawaran=$("#no_spk").val();
		
		$.ajax({
            type:"GET",
            url:siteurl+'delivery_order/GetCustomer',
            data:"no_penawaran="+no_penawaran,
			dataType	: 'json',
            success:function(html){
               $("#nama_customer").val(html.name_customer);
               $("#no_surat").val(html.nosurat);
               $("#id_customer").val(html.id_customer);
               $("#reff").val(html.reff);
            }
        });
		$.ajax({
            type:"GET",
            url:siteurl+'delivery_order/GetPenawaran',
            data:"no_penawaran="+no_penawaran,
            success:function(html){
               $("#list_penawaran_slot").html(html);
			   $('.select').select2();
			   $('.autoNumeric').autoNumeric();
            }
        });
    }

	function get_lebar(){ 
        var id_produk=$("#id_produk").val();
		var lebar_coil=$("#lebar_coil").val();
		$.ajax({
            type:"GET",
            url:siteurl+'penawaran_shearing/GetStock',
            data:"id_produk="+id_produk+"&lebar_coil="+lebar_coil,
            success:function(html){
               $("#stock_slot").html(html);
            }
        });
    }

	function AksiDetail(id){
	    var hgdeal=$('#dp_hgdeal_'+id).val();
		var qty=$('#dp_qty_'+id).val();
		var weight=$('#dp_weight_'+id).val();
		$.ajax({
            type:"GET",
            url:siteurl+'delivery_order/totalw',
            data:"hgdeal="+hgdeal+"&qty="+qty+"&weight="+weight+"&id="+id,
            success:function(html){
               $('#total_weight_'+id).html(html);
            }
        });
		$.ajax({
            type:"GET",
            url:siteurl+'delivery_order/totalhg',
            data:"hgdeal="+hgdeal+"&qty="+qty+"&weight="+weight+"&id="+id,
            success:function(html){
               $('#total_harga_'+id).html(html);
            }
        });
	}

	function HitungPisau(id){
	    var qty=$('#stok_qty_'+id).val();
		$.ajax({
            type:"GET",
            url:siteurl+'penawaran_shearing/HitungPisau',
            data:"qty="+qty+"&id="+id,
            success:function(html){
               $('#pisau_'+id).html(html);
            }
        });
	}

	function TambahItem(id){
	   	var idstk=$('#stok_idstk_'+id).val();
		var lotno=$('#stok_lotno_'+id).val();
		var namamaterial=$('#stok_namamaterial_'+id).val();
		var weight=$('#stok_weight_'+id).val();
		var density=$('#stok_density_'+id).val();
		var hasilpanjang=$('#stok_hasilpanjang_'+id).val();
		var width=$('#stok_width_'+id).val();
		var lebarcc=$('#stok_lebarcc_'+id).val();
		var jumlahcc=$('#stok_jumlahcc_'+id).val();
		var sisapotongan=$('#stok_sisapotongan_'+id).val();
		var qtystock=$('#stok_qty_'+id).val();
		var jumlahpisau=$('#stok_jmlpisau_'+id).val();
		var total_panjang=$("#total_panjang").val();
		var jml_pisau=$("#jml_pisau").val();
		var jml_mother=$("#jml_mother").val();
		var total_berat=$("#total_berat").val();
		var thickness=$("#thickness").val();
		var qty=$("#qty").val();
		var jumlah	=$('#used_slot').find('tr').length;
		$.ajax({
            type:"GET",
            url:siteurl+'penawaran_shearing/HitungTPanjang',
            data:"hasilpanjang="+hasilpanjang+"&total_panjang="+total_panjang,
            success:function(html){
               $("#tpanjang_slot").html(html);
            }
        });
		$.ajax({
            type:"GET",
            url:siteurl+'penawaran_shearing/HitungJPisau',
            data:"jumlahpisau="+jumlahpisau+"&jml_pisau="+jml_pisau,
            success:function(html){
               $("#jpisau_slot").html(html);
            }
        });
		$.ajax({
            type:"GET",
            url:siteurl+'penawaran_shearing/HitungJmother',
            data:"jml_mother="+jml_mother,
            success:function(html){
               $("#mother_slot").html(html);
            }
        });
		$.ajax({
            type:"GET",
            url:siteurl+'penawaran_shearing/HitungTBerat',
           data:"hasilpanjang="+hasilpanjang+"&total_panjang="+total_panjang+"&thickness="+thickness+"&lebarcc="+lebarcc+"&density="+density,
            success:function(html){
               $("#tberat_slot").html(html);
            }
        });
		$.ajax({
            type:"GET",
            url:siteurl+'penawaran_shearing/GetUsed',
            data:"idstk="+idstk+"&lotno="+lotno+"&namamaterial="+namamaterial+"&jumlah="+jumlah+"&weight="+weight+"&density="+density+"&hasilpanjang="+hasilpanjang+"&width="+width+"&lebarcc="+lebarcc+"&jumlahcc="+jumlahcc+"&sisapotongan="+sisapotongan+"&qtystock="+qtystock+"&jumlahpisau="+jumlahpisau,
            success:function(html){
               $("#used_slot").append(html);
            }
        });
	}

	function get_properties(){
        var id_produk=$("#id_produk").val();
		var lebar_coil=$("#lebar_coil").val();
		$.ajax({
            type:"GET",
            url:siteurl+'penawaran_shearing/GetMaterial',
            data:"id_produk="+id_produk,
            success:function(html){
               $("#material_slot").html(html);
            }
        });
		$.ajax({
            type:"GET",
            url:siteurl+'penawaran_shearing/GetThickness',
            data:"id_produk="+id_produk,
            success:function(html){
               $("#thickness_slot").html(html);
            }
        });
		$.ajax({
            type:"GET",
            url:siteurl+'penawaran_shearing/GetDensity',
            data:"id_produk="+id_produk,
            success:function(html){
               $("#density_slot").html(html);
            }
        });
		$.ajax({
            type:"GET",
            url:siteurl+'penawaran_shearing/GetSurface',
            data:"id_produk="+id_produk,
            success:function(html){
               $("#surface_slot").html(html);
            }
        });
		$.ajax({
            type:"GET",
            url:siteurl+'penawaran_shearing/GetPotongan',
            data:"id_produk="+id_produk,
            success:function(html){
               $("#potongan_slot").html(html);
            }
        });
		$.ajax({
            type:"GET",
            url:siteurl+'penawaran_shearing/GetStock',
            data:"id_produk="+id_produk+"&lebar_coil="+lebar_coil,
            success:function(html){
               $("#stock_slot").html(html);
            }
        });

    }

	function DelItem(id){
		$('#data_barang #tr_'+id).remove();
	}
	
	function CariProperties(id){	
        var idpr=$("#dt_lot_"+id).val();
		 $.ajax({
            type:"GET",
            url:siteurl+'delivery_order/CariIdMaterial',
            data:"idpr="+idpr+"&id="+id,
            success:function(html){
               $("#idmaterial_"+id).html(html); 
            }
        });
		$.ajax({
            type:"GET",
            url:siteurl+'delivery_order/CariWeightMaterial',
            data:"idpr="+idpr+"&id="+id,
            success:function(html){
               $("#weightmaterial_"+id).html(html); 
            }
        });
		$.ajax({
            type:"GET",
            url:siteurl+'delivery_order/CariBentukMaterial',
            data:"idpr="+idpr+"&id="+id,
            success:function(html){
               $("#bentuk_"+id).html(html); 
            }
        });
		$.ajax({
            type:"GET",
            url:siteurl+'delivery_order/CariNolotMaterial',
            data:"idpr="+idpr+"&id="+id,
            success:function(html){
               $("#nolot_"+id).html(html); 
            }
        });
		$.ajax({
            type:"GET",
            url:siteurl+'delivery_order/CariNoslitMaterial',
            data:"idpr="+idpr+"&id="+id,
            success:function(html){
               $("#noslit_"+id).html(html); 
            }
        });
				// $.ajax({
            // type:"GET",
            // url:siteurl+'purchase_order/CariPanjangMaterial',
            // data:"idpr="+idpr+"&id="+id,
            // success:function(html){
               // $("#panjang_"+id).html(html); 
            // }
        // });
		// $.ajax({
            // type:"GET",
            // url:siteurl+'purchase_order/CariLebarMaterial',
            // data:"idpr="+idpr+"&id="+id,
            // success:function(html){
               // $("#lebar_"+id).html(html); 
            // }
        // });
		// $.ajax({
            // type:"GET",
            // url:siteurl+'purchase_order/CariDescripitionMaterial',
            // data:"idpr="+idpr+"&id="+id,
            // success:function(html){
               // $("#description_"+id).html(html);
            // }
        // });
		// $.ajax({
            // type:"GET",
            // url:siteurl+'purchase_order/CariQtyMaterial',
            // data:"idpr="+idpr+"&id="+id,
            // success:function(html){
               // $("#qty_"+id).html(html);
            // }
        // });
		// $.ajax({
            // type:"GET",
            // url:siteurl+'purchase_order/CariweightMaterial',
            // data:"idpr="+idpr+"&id="+id,
            // success:function(html){
               // $("#width_"+id).html(html);
            // }
        // });
		// $.ajax({
            // type:"GET",
            // url:siteurl+'purchase_order/CariTweightMaterial',
            // data:"idpr="+idpr+"&id="+id,
            // success:function(html){
               // $("#totalwidth_"+id).html(html);
            // }
        // });
    }
	
	function addmaterial(id){ 
	    
		var jumlah	=$("#list_penawaran_slot_"+id).find('tr').length; 
	    var no_penawaran=$("#no_spk").val();
		var id_dt=$("#dp_id_dt_spkmarketing_"+id).val();

        var urut = parseFloat($("#urut").val()) + 1;

        $("#urut").val(urut);
		// console.log(jumlah)
		$.ajax({
            type:"GET",
            url:siteurl+'delivery_order/GetCustomer',
            data:"no_penawaran="+no_penawaran,
            success:function(html){
               $("#slot_customer").html(html);
            }
        });
		$.ajax({ 
            type:"GET",
            url:siteurl+'delivery_order/AddMaterial1',
            data:"jumlah="+jumlah+"&no_penawaran="+no_penawaran+"&id_dt="+id_dt+"&nomor="+id+"&urut="+urut,
            success:function(html){
               $("#det_lot1_"+id).append(html);
            }
        });
		$.ajax({ 
            type:"GET",
            url:siteurl+'delivery_order/AddMaterial2',
            data:"jumlah="+jumlah+"&no_penawaran="+no_penawaran+"&id_dt="+id_dt+"&nomor="+id+"&urut="+urut,
            success:function(html){
               $("#det_lot2_"+id).append(html);
            }
        });
		$.ajax({ 
            type:"GET",
            url:siteurl+'delivery_order/AddMaterial3',
            data:"jumlah="+jumlah+"&no_penawaran="+no_penawaran+"&id_dt="+id_dt+"&nomor="+id+"&urut="+urut,
            success:function(html){
               $("#det_lot3_"+id).append(html);
            }
        });
		$.ajax({ 
            type:"GET",
            url:siteurl+'delivery_order/AddMaterial4',
            data:"jumlah="+jumlah+"&no_penawaran="+no_penawaran+"&id_dt="+id_dt+"&nomor="+id+"&urut="+urut,
            success:function(html){
               $("#det_lot4_"+id).append(html);
            }
        });
		$.ajax({ 
            type:"GET",
            url:siteurl+'delivery_order/AddMaterial5',
            data:"jumlah="+jumlah+"&no_penawaran="+no_penawaran+"&id_dt="+id_dt+"&nomor="+id+"&urut="+urut,
            success:function(html){
               $("#det_lot5_"+id).append(html);
            }
        });
		
		// var jumlah	=$('#data_request').find('tr').length;
		// var angka =jumlah+1;
		
		// $.ajax({
            // type:"GET",
            // url:siteurl+'delivery_order/AddMaterial',
            // data:"jumlah="+jumlah,
			 // data:"jumlah="+jumlah+"&id_suplier="+id_suplier+"&loi="+loi,
            // success:function(html){
               // $("#list_penawaran_slot2").append(html);
			   // $(".bilangan-desimal").maskMoney();
			   // $(".chosen-select").select2({ width: '100%' });
            //}
       // });
		// $.ajax({
            // type:"GET",
            // url:siteurl+'purchase_order/UbahImport',
            // data:"loi="+loi,
            // success:function(html){
               // $("ubahloi").html(html);
            // }
        // });
		
    }
	
	function HapusItem(id){
		$('.del'+id).remove();
	}
	
	//ARWANT
	$(document).on('click','.plus', function(){
		var no 		= $(this).data('id');
		var kolom	= parseFloat($(this).parent().parent().find("td:nth-child(1)").attr('rowspan')) + 1;
		
		$(this).parent().parent().find("td:nth-child(6)").attr('rowspan', kolom);
		let html_list = $('#list_'+no).html().replaceAll('selected', '');

		var Rows	= "<tr>";
			Rows	+= "<td align='left'>";
			Rows	+= 		"<select name='dp["+no+"][detail]["+kolom+"][lot]' class='form-control select changeLot'>"+html_list+"</select>";
			Rows	+= 		"<input type='hidden' value='1' name='dp["+no+"][detail]["+kolom+"][bantuan]' readonly>";
			Rows	+= "</td>";
			Rows	+= "<td align='center'><input type='text' name='dp["+no+"][detail]["+kolom+"][qty]' data-no='"+no+"' class='form-control input-sm text-right autoNumeric qty' readonly></td>";
			Rows	+= "<td align='center'><input type='text' name='dp["+no+"][detail]["+kolom+"][weight]' data-no='"+no+"' class='form-control input-sm text-right autoNumeric weight' readonly></td>";
			Rows	+= "<td align='center'><input type='text' name='dp["+no+"][detail]["+kolom+"][qty_mat]' data-no='"+no+"' class='form-control input-sm text-right autoNumeric' placeholder='Qty'></td>";
			Rows	+= "<td align='center'><input type='text' name='dp["+no+"][detail]["+kolom+"][weight_mat]' data-no='"+no+"' class='form-control input-sm text-right autoNumeric' placeholder='Weight'></td>";
			Rows	+= "<td align='center'><input type='text' name='dp["+no+"][detail]["+kolom+"][remarks]' data-no='"+no+"' class='form-control input-sm text-left' placeholder='Remarks'></td>";
			Rows	+= "<td align='center'>";
			Rows	+= "<button type='button' class='btn btn-sm btn-danger delete' title='Delete' data-id='"+no+"'><i class='fa fa-trash'></i></button>";
			Rows	+= "</td>";
			Rows	+= "</tr>"; 
		// alert(Rows);
		$(this).parent().parent().after(Rows);
		
		$('.autoNumeric').autoNumeric();
		$('.select').select2();
	});

	$(document).on('click','.delete', function(){
		var no 		= $(this).data('id');
		var kolom	= parseFloat($(".baris_"+no).find("td:nth-child(1)").attr('rowspan')) - 1;
		$(".baris_"+no).find("td:nth-child(1), td:nth-child(2), td:nth-child(3), td:nth-child(4), td:nth-child(5)").attr('rowspan', kolom);
		
		$(this).parent().parent().remove();
	});

	$(document).on('change','.changeLot', function(){
		let lot = $(this).val();
		let change = $(this);
		var no 		= $(this).data('id');
		var totalqty   = $('#totalqty'+no).val();
	    var totalberat = $('#totalberat'+no).val();
		var baris      = $(this).data('baris');
		
		console.log(baris);
		
		$.ajax({
            type:"POST",
            url:siteurl+'delivery_order/getStockLot',
			data: {
				"lot" 	: lot
			},
			cache		: false,
			dataType	: 'json',
            success:function(data){
               change.parent().parent().find('.qty').val(data.qty);
               change.parent().parent().find('.weight').val(data.berat);
			   
			   var ttl_qty =parseFloat(totalqty)+parseFloat(data.qty);
			   var ttl_brt =parseFloat(totalberat)+parseFloat(data.berat);
			   
			   $('#totalqty'+no).val(ttl_qty);
			   $('#totalberat'+no).val(ttl_brt);
			  
			   
            }
        });
	});
	
	
	function delRow(row,no){
		
		
		var qty 	= $('#dp_qty_mat_'+row).val();
		var berat 	= $('#dp_weight_mat_'+row).val();
		
		
		
		var totalqty 	= $('#totalqty'+no).val();
		var totalberat 	= $('#totalberat'+no).val();
		
		console.log(berat);
		
		var ttl_qty =parseFloat(totalqty)-parseFloat(qty);
		var ttl_brt =parseFloat(totalberat)-parseFloat(berat);
			   
       $('#totalqty'+no).val(ttl_qty);
	   $('#totalberat'+no).val(ttl_brt);
			 
	   $('.baris_'+row).remove();
		
		
		
	}
	
	$(document).on('click','.pluss', function(){
		
		var no 		        = $(this).data('id');
		var jumlah          = $("#tambah_"+no).find('tr').length; 
		
		var idMaterial 		= $('#id_material_'+no).val();
		var nmMaterial 		= $('#material_'+no).val();
		var width    		= $('#width_'+no).val().split(",").join("");
		var length  		= $('#length_'+no).val().split(",").join("");
		var order  		    = $('#qty_'+no).val().split(",").join("");
		
		$.ajax({ 
            type:"GET",
            url:siteurl+'delivery_order/AddGetPenawaran',
            data:"id_material="+idMaterial+"&nm_material="+nmMaterial+"&width="+width+"&length="+length+"&qty_order="+order+"&nomor="+no+"&jumlah="+jumlah,
            success:function(html){
               $("#tambah_"+no).append(html);
            }
        });
	});
	
</script>