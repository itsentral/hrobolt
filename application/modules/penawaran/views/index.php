<?php
    $ENABLE_ADD     = has_permission('Penawaran.Add');
    $ENABLE_MANAGE  = has_permission('Penawaran.Manage');
    $ENABLE_VIEW    = has_permission('Penawaran.View');
    $ENABLE_DELETE  = has_permission('Penawaran.Delete');
	
?>
<style type="text/css">
thead input {
	width: 100%;
}
</style>
<div id='alert_edit' class="alert alert-success alert-dismissable" style="padding: 15px; display: none;"></div>
<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.css')?>">

<div class="box">
	<div class="box-header">
			<?php if($ENABLE_VIEW) : ?>
				<a class="btn btn-success btn-sm" href="<?= base_url('/penawaran/AddPenawaran/') ?>"  title="Add New"><i class="fa fa-plus">&nbsp;</i>Add</i></a>
			<?php endif; ?>

		<span class="pull-right">
		</span>
	</div>
	<!-- /.box-header -->
	<!-- /.box-header -->
	<div class="box-body">
		<table id="example1" class="table table-bordered table-striped">
		<thead>
		<tr>
			<th>#</th>
			<th>No.Penawaran</th>
			<th>No.Revisi</th>
			<th>Nama Customer</th>
            <th>Marketing</th>
            <th>Nilai<br>Penawaran</th>
			<th>Tanggal<br>Penawaran</th>
			<th>Keterangan Approved</th>
			<th>Revisi</th>
            <th>Status</th>
			<?php if($ENABLE_MANAGE) : ?>
			<th>Action</th>
			<?php endif; ?>
		</tr>
		</thead>

		<tbody>
		<?php if(empty($results)){
		}else{
			
			$numb=0; foreach($results AS $record){ $numb++; 


			    if($record->status == 0 )
				{
					$Status = "<span class='badge bg-grey'>Draft</span>";
				}
				elseif($record->status == 1 )
				{
					$Status = "<span class='badge bg-yellow'>Menunggu Approval</span>";
				}
				elseif($record->status == 2 )
				{
					$Status = "<span class='badge bg-green'>Approved</span>";
				}
				elseif($record->status == 3 )
				{
					$Status = "<span class='badge bg-blue'>Dicetak</span>";
				}
				elseif($record->status == 4 )
				{
					$Status = "<span class='badge bg-green'>Terkirim</span>";
				}
				elseif($record->status == 5 )
				{
					$Status = "<span class='badge bg-red'>Not Approved</span>";
				}
				elseif($record->status == 6 )
				{
					$Status = "<span class='badge bg-green'>SO</span>";
				}
				elseif($record->status == 7 )
				{
					$Status = "<span class='badge bg-red'>Loss</span>";
				}
			?>

			<?php if ($record->status <> '6' OR $record->status <> '7' ) { ?>
		<tr>
		    <td><?= $numb; ?></td>
			<td><?= $record->no_surat ?></td>
			<td><?= $record->no_revisi ?></td>
			<td><?= strtoupper($record->name_customer) ?></td>
            <td><?= $record->nama_sales ?></td>
            <td><?= number_format($record->grand_total) ?></td>
			<td><?= date('d-F-Y', strtotime($record->tgl_penawaran)) ?></td>
			<td><?= $record->keterangan_approve ?></td>
            <td><?= $record->revisi ?></td>
            <td><?= $Status ?></td>		
			<td style="padding:20px">
			
			<?php if($record->status == '1' || $record->status == '0' && $record->diskon_total > 0) : ?>	
				<a class="btn btn-primary btn-sm" href="<?= base_url('/penawaran/editpenawaran/'.$record->no_penawaran) ?>" title="Edit" data-penawaran="<?=$record->no_penawaran?>"><i class="fa fa-edit"></i>
				</a>
				<a class="btn btn-warning btn-sm" href="<?= base_url('/penawaran/ajukanapprove/'.$record->no_penawaran) ?>" title="Ajukan approval" data-penawaran="<?=$record->no_penawaran?>"><i class="fa fa-mail-forward"></i>
				</a>
			<?php  endif; ?>

			<?php if($record->status == '0' && $record->diskon_total == 0) : ?>
				<a class="btn btn-primary btn-sm" href="<?= base_url('/penawaran/editpenawaran/'.$record->no_penawaran) ?>" title="Edit" data-penawaran="<?=$record->no_penawaran?>"><i class="fa fa-edit"></i>
				</a>
				<a class="btn btn-info btn-sm btn-modal-print" title="Print" data-penawaran="<?=$record->no_penawaran?>"><i class="fa fa-print"></i>
				</a>
			<?php endif; ?>
			
			<!-- href="<?= base_url('/penawaran/printpenawaran/'.$record->no_penawaran) ?>" target="_blank" -->
			<?php if($ENABLE_MANAGE AND $record->status == '2') : ?>
				<a class="btn btn-info btn-sm btn-modal-print" title="Print" data-penawaran="<?=$record->no_penawaran?>"><i class="fa fa-print"></i>
				</a>
			<?php endif; ?>

			<?php if($ENABLE_MANAGE AND $record->status == '3') : ?>
				<a class="btn btn-primary btn-sm" href="<?= base_url('/penawaran/revisipenawaran/'.$record->no_penawaran) ?>" title="Revisi" data-penawaran="<?=$record->no_penawaran?>"><i class="fa fa-list"></i>
				</a>
				<a class="btn btn-success btn-sm" href="<?= base_url('/penawaran/statusterkirim/'.$record->no_penawaran) ?>" title="Ubah Status" data-penawaran="<?=$record->no_penawaran?>"><i class="fa fa-check"></i>
				</a>
				<a class="btn btn-info btn-sm btn-modal-print" title="Print" data-penawaran="<?=$record->no_penawaran?>"><i class="fa fa-print"></i>
				</a>
				<?php if($record->printed_by != NULL) { ?>
					<a href="<?= base_url($record->path_file) ?>" target="_blank" class="btn btn-primary btn-sm" title="PDF" data-penawaran="<?=$record->no_penawaran?>"><i class="fa fa-file-pdf-o"></i>
					</a>
				<?php } ?>
			<?php endif; ?>

			<?php if($ENABLE_MANAGE AND $record->status == '4' AND $record->printed_by != NULL) : ?>
				<a class="btn btn-success btn-sm" href="<?= base_url('/sales_order/createSO/'.$record->no_penawaran) ?>" title="Create SO" data-penawaran="<?=$record->no_penawaran?>"><i class="fa fa-plus"> Create SO</i>
				</a>
				<a class="btn btn-danger btn-sm" href="<?= base_url('/penawaran/statusloss/'.$record->no_penawaran) ?>" title="Loss" data-penawaran="<?=$record->no_penawaran?>"><i class="fa fa-check"></i>
				</a>
				<a href="<?= base_url($record->path_file) ?>" target="_blank" class="btn btn-primary btn-sm" title="PDF" data-penawaran="<?=$record->no_penawaran?>"><i class="fa fa-file-pdf-o"></i>
				</a>
			<?php endif; ?>
			</td>
		</tr>
		<?php 	 }
				}
			 }  ?>
		</tbody>
		</table>
	</div>
	<!-- /.box-body -->
</div>

<!-- awal untuk modal dialog -->
<!-- Modal -->
<div class="modal modal-primary" id="dialog-rekap" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="fa fa-file-pdf-o"></span>&nbsp;Rekap Data Customer</h4>
      </div>
      <div class="modal-body" id="MyModalBody">
		...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">
        <span class="glyphicon glyphicon-remove"></span>  Close</button>
        </div>
    </div>
  </div>
</div>

<div class="modal modal-default fade" id="dialog-popup" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel"><span class="fa fa-users"></span>&nbsp;Data Penawaran</h4>
			</div>
			<div class="modal-body" id="ModalView">
				...
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">
					<span class="glyphicon glyphicon-remove"></span>  Close
				</button>
			</div>
		</div>
	</div>
</div>

<div class="modal modal-default fade" id="dialog-popup-modal-print" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel"><span class="fa fa-users"></span>&nbsp;Form Data Print untuk Pernyataan: Dengan Kebutuhan</h4>
			</div>
			<div class="modal-body" id="ModalView">
				<form id="form-print-penawaran" method="GET">
				<input type="hidden" name="print_no_penawaran" id="print_no_penawaran">
				<div class="row">
			 		<div class="col-md-12">
			 			<label for="">Pernyataan 1 </label>
						<input type="text" class="form-control" name="pernyataan1" id="pernyataan1" value="Harga Loco Jakarta dan sudah termasuk PPN 11%">
					</div>
					<div class="col-md-12">
						<label for="">Pernyataan 2 </label>
						<input type="text" class="form-control" name="pernyataan2" id="pernyataan2" value="Uang Muka Minimum 10% atau CBD dibayarkan pada saat Invoice diterbitkan">
					</div>
				</div>
				<div class="row">
			 		<div class="col-md-12">
			 			<label for="">Pernyataan 3 </label>
						<input type="text" class="form-control" name="pernyataan3" id="pernyataan3" value="Pelunasan 90% dibayarkan sebelum pengiriman barang terlebih dahulu">
					</div>
					<div class="col-md-12">
						<label for="">Pernyataan 4 </label>
						<input type="text" class="form-control" name="pernyataan4" id="pernyataan4" value="Waranty 6 Bulan*(Manufacturing Defect) diluar Human Error dan Troubleshot">
					</div>
				</div>
				<div class="row">
			 		<div class="col-md-12">
			 			<label for="">Pernyataan 5 </label>
						<input type="text" class="form-control" name="pernyataan5" id="pernyataan5" value="Penawaran ini berlaku 2 minggu atau dapat berubah-ubah sewaktu waktu">
					</div>
					<div class="col-md-12">
						<label for="">Pernyataan 6 </label>
						<input type="text" class="form-control" name="pernyataan6" id="pernyataan6" value="Pembayaran Cash atau Transfer">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" id="btn-print-penawaran">
					<span class="glyphicon glyphicon-print"></span>  Print
				</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">
					<span class="glyphicon glyphicon-remove"></span>  Close
				</button>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- modal -->
<div class="modal modal-default fade" id="ModalViewX"  role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<h4 class="modal-title" id='head_title'>Closing Penawaran</h4>
		</div>
		<div class="modal-body" id="viewX">
			
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-primary" data-dismiss="modal" id='close_penawaran'>Save</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- DataTables -->
<script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
<script src="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.min.js')?>"></script>

<!-- page script -->
<script type="text/javascript">

	$(document).on('click', '.btn-modal-print', function(e) {
		var id = $(this).data('penawaran');
		// alert(id);
		$("#print_no_penawaran").val(id);
		$("#form-print-penawaran").attr('action', siteurl + 'penawaran/PrintPenawaran/' + id);
		$("#dialog-popup-modal-print").modal();
	});

	$(document).on('click', '#btn-print-penawaran', function(e) {
		var no_penawaran = $("#print_no_penawaran").val();
		var pernyataan1 = $("#pernyataan1").val();
		var pernyataan2 = $("#pernyataan2").val();
		var pernyataan3 = $("#pernyataan3").val();
		var pernyataan4 = $("#pernyataan4").val();
		var pernyataan5 = $("#pernyataan5").val();
		var pernyataan6 = $("#pernyataan6").val();

		window.open(siteurl + 'penawaran/PrintPenawaran/' + no_penawaran + "?pernyataan1=" + pernyataan1 + "&pernyataan2=" + pernyataan2 + "&pernyataan3=" + pernyataan3 + "&pernyataan4=" + pernyataan4 + "&pernyataan5=" + pernyataan5 + "&pernyataan6=" + pernyataan6, "_blank");
	});

	$(document).on('click', '.edit', function(e){
		var id = $(this).data('no_penawaran');
		$("#head_title").html("<i class='fa fa-list-alt'></i><b>Edit Inventory</b>");
		$.ajax({
			type:'POST',
			url:siteurl+'penawaran/editPenawaran/'+id,
			success:function(data){
				$("#dialog-popup").modal();
				$("#ModalView").html(data);
				
			}
		})
	});
	
	$(document).on('click', '.cetak', function(e){
		var id = $(this).data('no_penawaran');
		$("#head_title").html("<i class='fa fa-list-alt'></i><b>Edit Inventory</b>");
		$.ajax({
			type:'POST',
			url:siteurl+'xtes/cetak'+id,
			success:function(data){
				
			}
		})
	});
	
	$(document).on('click', '.view', function(){
		var id = $(this).data('no_penawaran');
		// alert(id);
		$("#head_title").html("<i class='fa fa-list-alt'></i><b>Detail Inventory</b>");
		$.ajax({
			type:'POST',
			url:siteurl+'penawaran/ViewHeader/'+id,
			data:{'id':id},
			success:function(data){
				$("#dialog-popup").modal();
				$("#ModalView").html(data);
				
			}
		})
	});
	
	
	
	// CLOSE PENAWARAN
	$(document).on('click','.close_penawaran', function(e){
		e.preventDefault();
		var id = $(this).data('no_penawaran');
		
		$("#head_title").html("Closing Penawaran");
		$.ajax({
			type:'POST',
			url: base_url + active_controller+'/modal_closing_penawaran/'+id,
			success:function(data){
				$("#ModalViewX").modal();
				$("#viewX").html(data);

			},
			error: function() {
				swal({
				title				: "Error Message !",
				text				: 'Connection Timed Out ...',
				type				: "warning",
				timer				: 5000,
				showCancelButton	: false,
				showConfirmButton	: false,
				allowOutsideClick	: false
				});
			}
		});
	});

  	$(function() {
    	// $('#example1 thead tr').clone(true).appendTo( '#example1 thead' );
	    // $('#example1 thead tr:eq(1) th').each( function (i) {
	        // var title = $(this).text();
	        //alert(title);
	        // if (title == "#" || title =="Action" ) {
	        	// $(this).html( '' );
	        // }else{
	        	// $(this).html( '<input type="text" />' );
	        // }

	        // $( 'input', this ).on( 'keyup change', function () {
	            // if ( table.column(i).search() !== this.value ) {
	                // table
	                    // .column(i)
	                    // .search( this.value )
	                    // .draw();
	            // }else{
	            	// table
	                    // .column(i)
	                    // .search( this.value )
	                    // .draw();
	            // }
	        // } );
	    // } );

	    // var table = $('#example1').DataTable( {
	        // orderCellsTop: true,
	        // fixedHeader: true,
			// scrollX: true,
	    // } );
    	$("#form-area").hide();
  	});
	
	
	//Delete

	function PreviewPdf(id)
	{
		param=id;
		tujuan = 'customer/print_request/'+param;

	   	$(".modal-body").html('<iframe src="'+tujuan+'" frameborder="no" width="570" height="400"></iframe>');
	}

	function PreviewRekap()
	{
		tujuan = 'customer/rekap_pdf';
	   	$(".modal-body").html('<iframe src="'+tujuan+'" frameborder="no" width="100%" height="400"></iframe>');
	}
</script>
