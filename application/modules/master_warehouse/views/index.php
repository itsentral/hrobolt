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
						<h4 style="font-weight: 700; color:aliceblue;">Table Warehouse</h4>
						<span class="pull-right">
							<a class="btn btn-success btn-sm form-warehouse" href="#" title="Form Warehouse"><i class="fa fa-archive">&nbsp;</i> Form Warehouse</a>
						</span>
					</div>
					<div class="table-responsive" style="margin-top: 15px;">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th width="10px">No.</th>
									<th>Nama Warehouse</th>
									<th>Kode Warehouse</th>
									<th>Deskripsi Warehouse</th>
									<th>Status</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($results['warehouses'] AS $key => $warehouse) { ?>
									<tr>
										<td><?php echo ++$key . "." ?></td>
										<td><?php echo $warehouse->nm_gudang ?></td>
										<td><?php echo $warehouse->kd_gudang ?></td>
										<td><?php echo $warehouse->desc ?></td>
										<td><?php echo $warehouse->status ?></td>
										<td>
											<a class="btn btn-info edit" data-id="<?php echo $warehouse->id ?>"><span class="fa fa-pencil"></span></a> |
											<a class="btn btn-danger delete" data-name="<?php echo $warehouse->name ?>" data-id="<?php echo $warehouse->id ?>"><span class="fa fa-trash"></span></a> 
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
<div class="modal modal-primary" id="modal-warehouse" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel"><span class="fa fa-file-pdf-o"></span>&nbsp;Form Data Warehouse</h4>
			</div>
			<div class="modal-body" id="MyModalBody">
				<input type="hidden" name="id_warehouse" id="id_warehouse">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>Nama Warehouse</label>
							<input type="text" name="warehouse_name" id="warehouse_name" class="form-control" required>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>Kode Gudang</label>
							<select name="kode_gudang" id="kode_gudang" class="form-control" required>
								<option value="">Silahkan Pilih</option>
								<option value="PUSAT">PUSAT</option>
								<option value="SUBGUDANG">SUB GUDANG</option>
								<option value="PRODUKSI">PRODUKSI</option>
								<option value="STOK">GUDANG INDIRECT</option>
								<option value="SPM">GUDANG SPAREPART MAINTENANCE</option>
								<option value="ATH">GUDANG ATK/HOUSEHOLD</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>Deskripsi</label>
							<select name="desc" id="desc" class="form-control" required>
								<option value="">Silahkan Pilih</option>
								<option value="Pusat">Gudang Pusat</option>
								<option value="Sub Gudang">Sub Gudang Lokal</option>
								<option value="Produksi">Gudang Produksi</option>
								<option value="Stok">Stok</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>Status</label>
							<select name="status" id="status" class="form-control" required>
								<option value="">Silahkan Pilih</option>
								<option value="Aktif">Aktif</option>
								<option value="Not Aktif">Not Aktif</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" id="btn-modal-variasi" onclick="return saveWarehouse()">
					<span class="glyphicon glyphicon-check"></span> 
					Save
				</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">
				<span class="glyphicon glyphicon-remove"></span> Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal modal-default fade" id="dialog-popup" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="head_title">Default</h4>
			</div>
			<div class="modal-body" id="ModalView">
				...
			</div>
		</div>
	</div>

<!-- DataTables -->
<script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
<script src="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.min.js')?>"></script>

<!-- page script -->
<script type="text/javascript">

	$(".form-warehouse").click(function() {
		$("#modal-warehouse").modal('show');
	});

	$(document).on('click', '.edit', function(e) {
			var id = $(this).data('id');
			$("#head_title").html("<b>Form Edit Warehouse</b>");
			$.ajax({
				type: 'POST',
				//url: siteurl + active_controller + '/formWarehouse/' + id,//version old
				url: siteurl + active_controller + '/edit/' + id,//version new
				success: function(data) {
					$("#dialog-popup").modal();
					$("#ModalView").html(data);

				}
			})
		});

	function saveWarehouse() {
		var warehouseName = $('#warehouse_name').val();
		var kodeGudang = $('#kode_gudang').val();
		var deskripsi = $('#desc').val();
		var status = $("#status").val();
		var idWarehouse = $("#id_warehouse").val();
		
		if(warehouseName == '' || warehouseName == null){
			// $("#error").html("Nama asset masih kosong !!!");
			// $('#myModal').modal("show");
			swal({
				title	: "Error Message!",
				text	: 'Nama Warehouse Name masih kosong ...',
				type	: "warning"
			});
			//$('#simpan-bro').prop('disabled',false);
			return false;
		}

		if(kodeGudang == '' || kodeGudang == null){
			// $("#error").html("Nama asset masih kosong !!!");
			// $('#myModal').modal("show");
			swal({
				title	: "Error Message!",
				text	: 'Nama Kode Gudang masih kosong ...',
				type	: "warning"
			});
			//$('#simpan-bro').prop('disabled',false);
			return false;
		}

		if(deskripsi == '' || deskripsi == null){
			// $("#error").html("Nama asset masih kosong !!!");
			// $('#myModal').modal("show");
			swal({
				title	: "Error Message!",
				text	: 'Nama Deskripsi masih kosong ...',
				type	: "warning"
			});
			//$('#simpan-bro').prop('disabled',false);
			return false;
		}

		if(status == '' || status == null){
			// $("#error").html("Nama asset masih kosong !!!");
			// $('#myModal').modal("show");
			swal({
				title	: "Error Message!",
				text	: 'Nama Status masih kosong ...',
				type	: "warning"
			});
			//$('#simpan-bro').prop('disabled',false);
			return false;
		}

		$.ajax({
			url: '<?php echo base_url('master_warehouse/saveFormWarehouse') ?>',
			method: 'POST',
			data: {
				kodeGudang: kodeGudang,
				warehouseName: warehouseName,
				idWarehouse: idWarehouse,
				deskripsi: deskripsi,
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
	
	//bagian edit data warehouse
	$(document).on('submit', '#data_form', function(e) {
			e.preventDefault()
			var data = $('#data_form').serialize();
			// alert(data);

			swal({
					title: "Anda Yakin?",
					text: "Data akan diproses!",
					type: "warning",
					showCancelButton: true,
					confirmButtonClass: "btn-info",
					confirmButtonText: "Yes",
					cancelButtonText: "No",
					closeOnConfirm: false
				},
				function() {
					$.ajax({
						type: 'POST',
						url: siteurl + active_controller + 'edit',
						dataType: "json",
						data: data,
						success: function(data) {
							if (data.status == '1') {
								swal({
										title: "Sukses",
										text: data.pesan,
										type: "success"
									},
									function() {
										window.location.reload(true);
									})
							} else {
								swal({
									title: "Error",
									text: data.pesan,
									type: "error"
								})

							}
						},
						error: function() {
							swal({
								title: "Error",
								text: "Error proccess !",
								type: "error"
							})
						}
					})
				});

		})

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
				url: siteurl + active_controller + '/delete',
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
