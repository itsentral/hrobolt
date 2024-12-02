<?php
    $ENABLE_ADD     = has_permission('Variasi.Add');
    $ENABLE_MANAGE  = has_permission('Variasi.Manage');
    $ENABLE_VIEW    = has_permission('Variasi.View');
    $ENABLE_DELETE  = has_permission('Variasi.Delete');
	
?>
<style type="text/css">
thead input {
	width: 100%;
}
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
	<!-- /.box-header -->
	<div class="box-body">
		<div class="row">
			<div class="col-md-8">
				<p>Perhatikan untuk melakukan pengisian data varian dan variasi harap mengikuti langkah langkah berikut : </p>
				<ol>
					<li>Isi terlebih dahulu data Variasi</li>
					<li>Setelah itu, data Variasi akan dapat dipilih pada form varian</li>
					<li>Isi form varian sesuai data</li>
				</ol>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="box-body" style="background-color: #3c8dbc;">
					<div style="display: flex; justify-content:space-between">
						<h4 style="font-weight: 700; color:aliceblue;">Table Variasi</h4>
						<span class="pull-right">
							<a class="btn btn-success btn-sm form-variasi" href="#" title="Form Variasi"><i class="fa fa-archive">&nbsp;</i> Form Variasi</a>
						</span>
					</div>
					<div class="table-responsive" style="margin-top: 15px;">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th width="10px">No.</th>
									<th>Nama Variasi</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($results['variasi'] AS $key => $variasi) { ?>
									<tr>
										<td><?php echo ++$key . "." ?></td>
										<td><?php echo $variasi->name ?></td>
										<td>
											<!-- <a class="btn btn-primary" data-id="<?php echo $variasi->id ?>" ><span class="fa fa-eye"></span></a> |  -->
											<a class="btn btn-info btn-variasi-edit" data-id="<?php echo $variasi->id ?>"><span class="fa fa-pencil"></span></a> |
											<a class="btn btn-danger delete" data-name="<?php echo $variasi->name ?>" data-id="<?php echo $variasi->id ?>"><span class="fa fa-trash"></span></a> 
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="box-body" style="background-color: #ff9900;">
					<div style="display: flex; justify-content:space-between">
						<h4 style="font-weight: 700; color:aliceblue;">Table Varian</h4>
						<span class="pull-right">
							<a class="btn btn-success btn-sm form-varian" href="#" title="Form Varian"><i class="fa fa-archive">&nbsp;</i> Form Varian</a>
						</span>
					</div>
					<div class="table-responsive" style="margin-top: 15px;">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th width="10px">No.</th>
									<th>Nama Varian</th>
									<th>Variasi</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($results['varian'] AS $key => $varian) { ?>
									<tr>
										<td><?php echo ++$key . "." ?></td>
										<td><?php echo $varian->nama_varian ?></td>
										<td><?php echo $varian->nama_variasi ?></td>
										<td>
											<!-- <a class="btn btn-primary" data-id="<?php echo $varian->id ?>"><span class="fa fa-eye"></span></a> |  -->
											<a class="btn btn-info btn-varian-edit" data-id="<?php echo $varian->id ?>"><span class="fa fa-pencil"></span></a> |
											<a class="btn btn-danger delete" data-name="<?php echo $varian->nama_varian ?>" data-id="<?php echo $varian->id ?>"><span class="fa fa-trash"></span></a> 
										</td>
									</tr>
								<?php } ?>
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
<div class="modal modal-primary" id="modal-variasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel"><span class="fa fa-file-pdf-o"></span>&nbsp;Form Data Variasi</h4>
			</div>
			<div class="modal-body" id="MyModalBody">
				<input type="hidden" name="id_variasi" id="id_variasi">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>Nama Variasi</label>
							<input type="text" name="nama_variasi" id="nama_variasi" class="form-control">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" id="btn-modal-variasi" onclick="return saveVariasi()">
					<span class="glyphicon glyphicon-check"></span> 
					Save</button>
				<button type="button"  class="btn btn-default" data-dismiss="modal">
				<span class="glyphicon glyphicon-remove"></span>  Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal modal-default fade" id="modal-varian" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title" id="myModalLabel"><span class="fa fa-users"></span>&nbsp;Form Varian</h4>
			</div>
			<div class="modal-body" id="ModalView">
				<input type="hidden" name="id_varian" id="id_varian">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>Nama Varian</label>
							<input type="text" name="nama_varian" id="nama_varian" class="form-control">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>Variasi</label>
							<select class="form-control" name="variasi_varian" id="variasi_varian">
								<option value="">Silahkan Pilih</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" id="btn-modal-variasi" onclick="return saveVarian()">
					<span class="glyphicon glyphicon-check"></span> 
					Save</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">
					<span class="glyphicon glyphicon-remove"></span>  Close
				</button>
			</div>
		</div>
	</div>
</div>

<!-- DataTables -->
<script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
<script src="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.min.js')?>"></script>

<!-- page script -->
<script type="text/javascript">

	$(".form-variasi").click(function() {
		$("#modal-variasi").modal('show');
	});

	function saveVariasi() {
		var name = $('#nama_variasi').val();
		var id = $("#id_variasi").val();

		$.ajax({
			url: '<?php echo base_url('master_variasi/saveFormVariasi') ?>',
			method: 'POST',
			data: {
				name: name,
				id: id
			},
			success: function(result) {
				if(result.status == 1) {
					swal({
						title: "Sukses",
						text : result.pesan,
						type : "success"
					},)
				} else {
					swal({
						title: "Gagal",
						text : result.pesan,
						type : "error"
					},)
				}
				window.location.reload(true);
			}
		});
	}

	$(".form-varian").click(function() {
		$.ajax({
			method: "GET",
			url: "<?php echo base_url('master_variasi/formVarian') ?>",
			success: function(result) {
				if (result.code == 200) {
					var html = "<select id='variasi_varian' name='variasi_varian' class='form-control'><option>Silahkan Pilih</option>";
					$.each(result.variasi, function(key, value) {
						html += '<option value='+value.id+'>'+value.name+'</option>'
					});
					html += "</select>";
					$("#variasi_varian").html(html);
					$('#nama_varian').val("");
					$("#modal-varian").modal('show');
				}
			}
		});
	});

	function saveVarian() {
		var id = $("#id_varian").val();
		var name = $('#nama_varian').val();
		var variasi_id = $('#variasi_varian').val();
		$.ajax({
			url: '<?php echo base_url('master_variasi/saveFormVarian') ?>',
			method: 'POST',
			data: {
				id: id,
				name: name,
				variasi_id: variasi_id
			},
			success: function(result) {
				if(result.status == 1) {
					swal({
						title: "Sukses",
						text : result.pesan,
						type : "success"
					},)
				} else {
					swal({
						title: "Gagal",
						text : result.pesan,
						type : "error"
					},)
				}
				window.location.reload(true);
			}
		});
	}

	$(".btn-variasi-edit").click(function() {
		var id = $(this).data('id');
		$.ajax({
			url: "<?php echo base_url('master_variasi/formVariasi') ?>",
			data: {
				id: id
			}, 
			method: "POST",
			success: function (result) {
				if (result.code == 200) {
					$("#id_variasi").val(id);
					$("#nama_variasi").val(result.data.name);
					$("#modal-variasi").modal('show');
				}
			}
		})
	});

	$(".btn-varian-edit").click(function() {
		var id = $(this).data('id');
		$.ajax({
			url: "<?php echo base_url('master_variasi/formVarian') ?>",
			data: {
				id: id
			}, 
			method: "POST",
			success: function (result) {
				if (result.code == 200) {
					var html = "<select id='variasi_varian' name='variasi_varian' class='form-control'><option>Silahkan Pilih</option>";
					$.each(result.variasi, function(key, value) {
						html += '<option value='+value.id+'>'+value.name+'</option>'
					});
					html += "</select>";
					$("#id_varian").val(id);
					$("#variasi_varian").html(html);
					$('#nama_varian').val(result.varian.name);
					$("#modal-varian").modal('show');
				}
			}
		})
	});

	
	// DELETE DATA
	$(document).on('click', '.delete', function(e){
		e.preventDefault()
		var id = $(this).data('id');
		var name = $(this).data('name');
		swal({
			title: "Anda Yakin Mengahapus Data ?",
			text: "Data ini, " + name.toUpperCase() + " akan dihapus",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-info",
			confirmButtonText: "Ya, Hapus!",
			cancelButtonText: "Batal",
			closeOnConfirm: false
		}, function(){
			$.ajax({
				type:'POST',
				url:siteurl+'master_variasi/delete',
				dataType : "json",
				data:{'id':id},
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
</script>
