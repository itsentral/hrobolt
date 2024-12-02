<div class="nav-tabs-area">
    <!-- /.tab-content -->
    <div class="tab-content">
        <div class="tab-pane active" id="area">
        <!-- Biodata Mitra -->
            <div id='alert_edit' class="alert alert-success alert-dismissable" style="padding: 15px; display: none;"></div>
            <!-- form start-->
            <div class="box box-primary">
            <?= form_open($this->uri->uri_string(),array('id'=>'frm_data','name'=>'frm_data','role'=>'form','class'=>'form-horizontal')) ?>
                <div class="box-body">
				  <div class="row">
					<div class="col-md-6">
						<?php  if(isset($data->code_budget)){$type='edit';}?>
						<input type="hidden" id="type" name="type" value="<?= isset($type) ? $type : 'add' ?>">
						<input type="hidden" id="id" name="id" value="<?php echo set_value('id', isset($data->code_budget) ? $data->code_budget : ''); ?>">
						<input type="hidden" id="rev" name="rev" value="<?php echo (isset($data->rev) ? $data->rev : '0'); ?>">
						<div class="form-group ">
							<label class="col-sm-4 control-label">Departemen<font size="4" color="red"><B>*</B></font></label>
							<div class="col-sm-8">
								<div class="input-group">
									<?php
									$datdepartemen[0]	= 'Select An Option';
									echo form_dropdown('department',$datdepartemen, set_value('department', isset($data->department) ? $data->department: '0'), array('id'=>'department','class'=>'form-control','style'=>'width:100%;','required'=>'required','onblur'=>'getcostcentre()'));
									?>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group ">
							<label class="col-sm-4 control-label">Cost Center</label>
							<div class="col-sm-8">
								<div class="input-group">
									<?php
									$datcostcenter[0]	= 'Select An Option';
									echo form_dropdown('costcenter',$datcostcenter, set_value('costcenter', isset($data->costcenter) ? $data->costcenter: '0'), array('id'=>'costcenter','class'=>'form-control','style'=>'width:100%;'));
									?>
								</div>
							</div>
						</div>
					</div>
                  </div>
				  <?php
				  $totals=0;
				 if(isset($jenisrutin)){
					foreach($jenisrutin AS $key){
						echo "<h4>".$key->nama." <button type='button' data-id_barang='".$key->id_type."' class='btn btn-sm btn-success addPart pull-right' title='Add Item'><i class='fa fa-plus'></i> Add Item</button></h4>
						<table class='table table-striped table-bordered table-hover table-condensed' width='100%' id='tbl_".$key->id_type."'>
							<thead>
								<tr class='bg-blue'>
									<th class='text-center' style='width: 5%;'>#</th>
									<th class='text-center' style='width: 30%;'>Nama Barang</th>
									<th class='text-center'>Spesifikasi</th>
									<th class='text-center' style='width: 15%;'>Kebutuhan 1 Bulan</th>
									<th class='text-center' style='width: 15%;'>Satuan</th>
									<th class='text-center' style='width: 5%;'>#</th>
								</tr>
							</thead>
							<tbody>	
								<tr>
									<td style='width: 5%;'></td>
									<td style='width: 30%;'></td>
									<td></td>
									<td style='width: 15%;'></td>
									<td style='width: 15%;'></td>
									<td style='width: 5%;'></td>
								</tr>							
							</tbody>
						</table>	  
						";
					}
				 }else{
				  if(isset($data_detail)){
					$jenisrutin='';
					$nojenis=1;
					foreach($data_detail as $key){
					  if($jenisrutin != $key->id_type) {
						if($totals>0) echo '</tbody></table>';
						echo "<h4>".$key->nama_jenis."
						<button type='button' data-id_barang='".$key->id_type."' class='btn btn-sm btn-success addPart pull-right' title='Add Item'><i class='fa fa-plus'></i> Add Item</button></h4>
						<table class='table table-striped table-bordered table-hover table-condensed' width='100%' id='tbl_".$key->id_type."'>
							<thead>
								<tr class='bg-blue'>
									<th class='text-center' style='width: 5%;'>#</th>
									<th class='text-center' style='width: 30%;'>Nama Barang</th>
									<th class='text-center'>Spesifikasi</th>
									<th class='text-center' style='width: 15%;'>Kebutuhan 1 Bulan</th>
									<th class='text-center' style='width: 15%;'>Satuan</th>
									<th class='text-center' style='width: 5%;'>#</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td style='width: 5%;'></td>
									<td style='width: 30%;'></td>
									<td></td>
									<td style='width: 15%;'></td>
									<td style='width: 15%;'></td>
									<td style='width: 5%;'></td>
								</tr>
						";
						$nojenis=1;
					  }
					  $jenisrutin=$key->id_type;
					  if($key->id_barang!='') {
						  echo '<tr>
						  <td>'.$nojenis.'<input type="hidden" name="jenis_barang[]" value="'.$key->jenis_barang.'"></td>
						  <td><input type="hidden" name="id_barang[]" value="'.$key->id_barang.'">'.$key->id_barang.' - '.$key->nama_barang.'</td><td>'.$key->spec1.'</td><td><input type="text" class="form-control input-sm" name="kebutuhan_month[]" value="'.$key->kebutuhan_month.'"></td>
						  <td><input type="hidden" name="satuan[]" value="'.$key->satuan.'">'.$key->satuan.'</td>
						  <td><button type="button" class="btn btn-sm btn-danger delPart" title="Delete Part"><i class="fa fa-close"></i></button></td></tr>';
						  $nojenis++;
					  }
					  $totals++;
					}
					echo '</tbody></table>';
				  }
				 }?>
				</div>
				<div class="box-footer">
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" name="save" class="btn btn-success" id="submit"><i class="fa fa-save">&nbsp;</i>Save</button>
						<a class="btn btn-danger" data-toggle="modal" onclick="cancel()"><i class="fa fa-minus-circle">&nbsp;</i>Cancel</a>
						</div>
					</div>
				</div>
            <?= form_close() ?>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('/assets/js/number-divider.min.js')?>"></script>
<script type="text/javascript">
	var row=<?=$totals?>;
    $(document).ready(function() {
		$(".divide").divide();
    });
	$(document).on('click', '.addPart', function(){
		var jenis_barang = $(this).data('id_barang');
		$.ajax({
			url: siteurl +'budget_rutin/get_material/'+jenis_barang,
			cache: false,
			type: "POST",
			dataType: "json",
			success: function(data){
				var options = '<option value="">Select An Option</option>';
				var i;
				for(i=0; i<data.length; i++){
					row++;
					options += '<option value='+data[i].id_material+' data-id_spec="'+data[i].spec1+'">'+data[i].nama+'</option>';
				}
				$('#tbl_'+jenis_barang+' tr:last').after('<tr><td>#<input type="hidden" name="jenis_barang[]" value="'+jenis_barang+'"></td><td><select id="id_barang'+row+'" name="id_barang[]" class="form-control select2 input-sm" required onchange="getsatuan('+row+')">'+options+'</select></td><td id="spek'+row+'"></td><td><input type="text" class="form-control input-sm" name="kebutuhan_month[]" value="0"></td><td><select id="satuan'+row+'" name="satuan[]" class="form-control input-sm" required></select></td><td><button type="button" class="btn btn-sm btn-danger delPart" title="Delete Part"><i class="fa fa-close"></i></button></td></tr>');
				$(".select2").select2();
			},
			error: function() {
				swal({
					title				: "Error Message !",
					text				: 'Connection Time Out. Please try again..',
					type				: "warning",
					timer				: 3000,
					showCancelButton	: false,
					showConfirmButton	: false,
					allowOutsideClick	: false
				});
			}
		});
	});
	function getsatuan(id){
		idbarang=$("#id_barang"+id).val();
		var idspec = $("#id_barang"+id).find(':selected').attr('data-id_spec');
		$("#spek"+id).html(idspec);
		if(idbarang!=''){
			$.ajax({
				url:siteurl+'budget_rutin/get_satuan/'+idbarang,
				method : "POST",
				dataType : 'json',
				success: function(data){
					var html = '<option value="">Select An Option</option>';
					var i;
					for(i=0; i<data.length; i++){
						html += '<option value='+data[i].nama_satuan+'>'+data[i].nama_satuan+'</option>';
					}
					$('#satuan'+id).html(html);
//					console.log(data);
				}
			});
		}else{
			$('#satuan').html('');
		}
	}
	$(document).on('click', '.delPart', function(){
	   $(this).closest("tr").remove();
	});
	function getcostcentre(){
		dept=$("#department").val();
		if(dept!='0'){
			$.ajax({
				url:siteurl+'budget_rutin/get_cost_center/'+dept,
				method : "POST",
				dataType : 'json',
				success: function(data){
					var html = '<option value="">Select An Option</option>';
					var i;
					for(i=0; i<data.length; i++){
						html += '<option value='+data[i].id+'>'+data[i].cost_center+'</option>';
					}
					$('#costcenter').html(html);
//					console.log(data);
				}
			});
		}else{
			$('#costcenter').html('');
		}
	}

    $('#frm_data').on('submit', function(e){
        e.preventDefault();
        var formdata = $("#frm_data").serialize();
        $.ajax({
            url: siteurl+"budget_rutin/save_data",
            dataType : "json",
            type: 'POST',
            data: formdata,
            success: function(msg){
                if(msg['save']=='1'){
                    swal({
                        title: "Sukses!",
                        text: "Data Berhasil Di Simpan",
                        type: "success",
                        timer: 1500,
                        showConfirmButton: false
                    });
					console.log(msg);
                    cancel();
                } else {
                    swal({
                        title: "Gagal!",
                        text: "Data Gagal Di Simpan",
                        type: "error",
                        timer: 1500,
                        showConfirmButton: false
                    });
                };
				console.log(msg);
            },
            error: function(msg){
                swal({
                    title: "Gagal!",
                    text: "Ajax Data Gagal Di Proses",
                    type: "error",
                    timer: 1500,
                    showConfirmButton: false
                });
				console.log(msg);
            }
        });
    });
    function cancel(){
		window.location.reload();
    }
</script>
