<?php
$ENABLE_ADD     = has_permission('PR_Departemen.Add');
$ENABLE_MANAGE  = has_permission('PR_Departemen.Manage');
$ENABLE_VIEW    = has_permission('PR_Departemen.View');
$ENABLE_DELETE  = has_permission('PR_Departemen.Delete');
?>
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" integrity="sha512-yVvxUQV0QESBt1SyZbNJMAwyKvFTLMyXSyBHDO4BG5t7k/Lw34tyqlSDlKIrIENIzCl+RVUNjmCPG+V/GMesRw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<form action="#" method="POST" id="form_proses_bro" enctype="multipart/form-data" autocomplete='off'>
	<div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title"><?php echo $title; ?></h3>
			<div class="box-tool pull-right">
				<?php
				if ($ENABLE_ADD) {
				?>
					<a href="<?php echo site_url('non_rutin/form/add/1') ?>" class="btn btn-sm btn-success" style='float:right;' id='btn-add'>
						<i class="fa fa-plus"></i> &nbsp;&nbsp;Add
					</a>
				<?php
				}
				?>
			</div>
		</div>
		<!-- /.box-header -->
		<div class="box-body table-responsive">
			<input type='hidden' id='tanda' value='<?= $tanda; ?>'>
			<div class="col-md-4">
				<select name="" id="" class="form-control form-control-sm search_depart" style="margin-top: 5px;">
					<?php
					foreach ($list_department as $item) {
						echo '<option value="' . $item->id . '">' . strtoupper($item->nama) . '</option>';
					}
					?>
				</select>
				<button type="button" class="btn btn-sm btn-primary search_btn" style=''><i class="fa fa-search"></i> Cari</button>
			</div>
			<div class="col-12">
				<table class="table table-bordered table-striped" id="my-grid" width='100%'>
					<thead>
						<tr class='bg-blue'>
							<th class="text-center">#</th>
							<th class="text-center">No PR</th>
							<th class="text-center">Departemen</th>
							<th class="text-center no-sort">Nama Barang/Jasa</th>
							<th class="text-center no-sort">Spec / Requirement</th>
							<th class="text-center no-sort" width='7%'>Qty</th>
							<th class="text-center no-sort">Dibutuhkan</th>
							<th class="text-center no-sort">Keterangan</th>
							<th class="text-center no-sort">Status</th>
							<th class="text-center no-sort" width='13%'>Option</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
		<!-- /.box-body -->
	</div>
	<!-- /.box -->
	<!-- modal -->
	<div class="modal fade" id="ModalView2" style='overflow-y: auto;'>
		<div class="modal-dialog" style='width:80%; '>
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="head_title2"></h4>
				</div>
				<div class="modal-body" id="view2">
				</div>
				<div class="modal-footer">
					<!--<button type="button" class="btn btn-primary">Save</button>-->
					<button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!-- modal -->
</form>

<script src="https://cdn.datatables.net/2.0.2/js/dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js" integrity="sha512-rMGGF4wg1R73ehtnxXBt5mbUfN9JUJwbk21KMlnLZDJh7BkPmeovBuddZCENJddHYYMkCh9hPFnPmS9sspki8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="<?= base_url('assets/js/autoNumeric.js') ?>"></script>
<script>
	$(document).ready(function() {
		$('.maskM').autoNumeric();

		var tanda = $('#tanda').val();
		DataTables(tanda);

		$('.search_depart').chosen({
			width: '250px',
		});
	});

	$(document).on('change', '.search_btn', function() {
		var search_depart = $('.search_depart').val();
		if(search_depart == '') {
			DataTables(tanda)
		}
	});

	function DataTables(tanda = null, department = null) {
		var dataTable = $('#my-grid').DataTable({
			"processing": true,
			"serverSide": true,
			"stateSave": true,
			"bAutoWidth": true,
			"destroy": true,
			"responsive": true,
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
				[10, 20, 50, 100, 150],
				[10, 20, 50, 100, 150]
			],
			"ajax": {
				url: base_url + active_controller + '/server_side_non_rutin',
				type: "post",
				data: function(d) {
					d.tanda = tanda
				},
				cache: false,
				error: function() {
					$(".my-grid-error").html("");
					$("#my-grid").append('<tbody class="my-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
					$("#my-grid_processing").css("display", "none");
				}
			}
		});
	}
</script>