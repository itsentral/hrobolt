<?php
    $ENABLE_ADD     = has_permission('Master_Marketplace.Add');
    $ENABLE_MANAGE  = has_permission('Master_Marketplace.Manage');
    $ENABLE_VIEW    = has_permission('Master_Marketplace.View');
    $ENABLE_DELETE  = has_permission('Master_Marketplace.Delete');
	
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
						<h4 style="font-weight: 700; color:aliceblue;">Table Marketplace</h4>
						<span class="pull-right">
							<a class="btn btn-success btn-sm form-marketplace" href="#" title="Form Jasa Marketplace"><i class="fa fa-archive">&nbsp;</i> Form Jasa Marketplace</a>
						</span>
					</div>
					<div class="table-responsive" style="margin-top: 15px;">
						<table id="table-marketplace" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th width="10px">No.</th>
									<th>Nama Marketplace</th>
									<th>Status</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($results['masterMarketplace'] AS $key => $marketplace) { ?>
									<tr>
										<td><?php echo ++$key . "." ?></td>
										<td><?php echo $marketplace->name ?></td>
										<td><?php echo strtoupper($marketplace->status) ?></td>
										<td>
											<!-- <a class="btn btn-primary" data-id="<?php echo $marketplace->id ?>" ><span class="fa fa-eye"></span></a> |  -->
											<a class="btn btn-info btn-marketplace-edit" data-id="<?php echo $marketplace->id ?>"><span class="fa fa-pencil"></span></a> |
											<a class="btn btn-danger delete" data-name="<?php echo $marketplace->name ?>" data-id="<?php echo $marketplace->id ?>"><span class="fa fa-trash"></span></a> 
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
<div class="modal modal-primary" id="modal-form-marketplace" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel"><span class="fa fa-file-pdf-o"></span>&nbsp;Form Data Jasa Marketplace</h4>
			</div>
			<div class="modal-body" id="MyModalBody">
				<input type="hidden" name="id_marketplace" id="id_marketplace">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>Nama Jasa Marketplace</label>
							<input type="text" name="nama_jasa_marketplace" id="nama_jasa_marketplace" class="form-control">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<div class="col-md-3">
								<label>Status Jasa Marketplace</label>
							</div>
							
							<div class="col-md-6">
								<label>
									<input type="radio" class="radio-control status" id="statusa" name="status" value="Aktif" <?=$aktifcheck?> required> Aktif
								</label>
									&nbsp &nbsp &nbsp
								<label>
									<input type="radio" class="radio-control status" id="statusn" name="status" value="Tidak Aktif" <?=$nonaktifcheck?> required> Non Aktif
								</label>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" id="btn-modal-marketplace" onclick="return saveFormMarketplace()">
					<span class="glyphicon glyphicon-check"></span> 
					Save</button>
				<button type="button"  class="btn btn-default" data-dismiss="modal">
				<span class="glyphicon glyphicon-remove"></span>  Close</button>
			</div>
		</div>
	</div>
</div>

<!-- DataTables -->
<script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
<script src="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.min.js')?>"></script>

<!-- page script -->
<script type="text/javascript">

	$(function() {
	    var table = $('#table-marketplace').DataTable( {
	        orderCellsTop: true,
	        fixedHeader: true,
			buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
	    } );
    	// $("#form-area").hide();
  	});

	$(".form-marketplace").click(function() {
		$("#modal-form-marketplace").modal('show');
	});

	function saveFormMarketplace() {
		var id = $('#id_marketplace').val();
		var name = $('#nama_jasa_marketplace').val();
		var status = $('input[name="status"]:checked').val();

		$.ajax({
			url: '<?php echo base_url('master_marketplace/saveFormMarketplace') ?>',
			method: 'POST',
			data: {
				id: id,
				name: name,
				status: status
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

	$(".btn-marketplace-edit").click(function() {
		var id = $(this).data('id');
		$.ajax({
			url: "<?php echo base_url('master_marketplace/formMarketplace') ?>",
			data: {
				id: id
			}, 
			method: "POST",
			success: function (result) {
				if (result.code == 200) {
					$("#id_marketplace").val(id);
					$("#nama_jasa_marketplace").val(result.data.name);
					$("#code_tokopedia").val(result.data.code_tokopedia);
					$("#modal-form-marketplace").modal('show');
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
				url:siteurl+'master_marketplace/delete',
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
