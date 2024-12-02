<?php
    $ENABLE_ADD     = has_permission('Purchase_Request.Add');
    $ENABLE_MANAGE  = has_permission('Purchase_Request.Manage');
    $ENABLE_VIEW    = has_permission('Purchase_Request.View');
    $ENABLE_DELETE  = has_permission('Purchase_Request.Delete');
	
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
		<span class="pull-left">
			<?php if($ENABLE_ADD) : ?>
				<a class="btn btn-success btn-sm" href="<?= base_url('/purchase_request/add/'.$record->no_penawaran) ?>" title="Add" ><i class="fa fa-plus"></i>&nbsp; Buat Purchase Request</a>
			<?php endif; ?>
		</span>
	</div>
	<!-- /.box-header -->
	<!-- /.box-header -->
	<div class="box-body">
		<table id="example1" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th width="5">#</th>
					<th >ID</th>
					<th >No</th>
					<th>Tanggal</th>
					<th>Requestor</th>
					<th>Status</th>
					<th>Approved By</th>
					<?php if($ENABLE_MANAGE) : ?>
					<th width="13%">Action</th>
					<?php endif; ?>
				</tr>
			</thead>

			<tbody>
				<?php if(empty($results)) {
				} else {
					
					$numb=0; foreach($results AS $record){ $numb++;
					$ling = base_url('/purchase_request/edit/'.$record->no_pr);
					?>
				<tr>
					<td><?= $numb; ?></td>
					<td><?= $record->no_pr ?></td>
					<td><?= $record->no_surat ?></td>
					<td><?= $record->tanggal ?></td>
					<td><?= strtoupper($record->nm_karyawan) . " - Divisi : " . strtoupper($record->nama_department)  ?></td>
					<? if($record->status == '1'){
						echo"<td><span class='label label-info' style='font-size:15px;'><i class='fa fa-circle-o-notch'></i> Waiting</span></td>";
					}else{
						echo"<td><span class='label label-primary' style='font-size:15px;'><i class='fa fa-check'></i> Approved</span></td>";
					}?>
					<td><?= ($record->nm_lengkap != null) ? $record->nm_lengkap : '<span class="label label-primary">Belum di Approve</span>' ?></td>
					<? if($record->status == '1'){
					echo"
					<td style='padding-left:20px'>
						<a class='btn btn-primary btn-sm view' href='javascript:void(0)' title='View' data-no_pr='$record->no_pr'><i class='fa fa-eye'></i>
						</a>
						<a class='btn btn-success btn-sm' href='$ling' title='Edit' ><i class='fa fa-edit'></i></a>
						<a class='btn btn-info btn-sm approve' href='javascript:void(0)' data-no_pr='$record->no_pr' title='Approve' ><i class='fa fa-check'></i></a>
					</td>";
					} else {
								echo"
					<td style='padding-left:20px'>
						<a class='btn btn-primary btn-sm view' href='javascript:void(0)' title='View' data-no_pr='$record->no_pr'><i class='fa fa-eye'></i>
						</a>
					</td>";	
					}?>
				</tr>
				<?php } } ?>
			</tbody>
		</table>
	</div>
	<!-- /.box-body -->
</div>

<!-- awal untuk modal dialog -->
<!-- Modal -->
<div class="modal modal-primary" id="dialog-rekap" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

<div class="modal modal-default fade" id="dialog-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      	<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			<h4 class="modal-title" id="headerModal2"><span class="fa fa-users"></span>&nbsp;Data Purchase Request</h4>
		</div>
		<div class="modal-body" id="ModalView">
			...
		</div>
      	<div class="modal-footer" id="ModalFooter">
			<button type="button" class="btn btn-danger" data-dismiss="modal">
				<span class="glyphicon glyphicon-remove"></span>  
				Close
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

	$(document).on('click', '.edit', function(e){
		var id = $(this).data('no_penawaran');
		$("#head_title").html("<i class='fa fa-list-alt'></i><b>Edit Inventory</b>");
		$.ajax({
			type:'POST',
			url:siteurl+'penawaran/EditHeader/'+id,
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
		var id = $(this).data('no_pr');
		// alert(id);
		$("#head_title").html("<i class='fa fa-list-alt'></i><b>Detail Inventory</b>");
		$.ajax({
			type:'POST',
			url:siteurl+'purchase_request/View/'+id,
			data:{'id':id},
			success:function(data){
				$("#dialog-popup").modal();
				$("#ModalView").html(data);
			}
		})
	});

	$(document).on('click', '.approve', function(){
		var id = $(this).data('no_pr');
		// alert(id);
		$("#headerModal2").html("<i class='fa fa-list-alt'></i><b> Approve Purchase Request</b>");
		$.ajax({
			type:'POST',
			url:siteurl+'purchase_request/ApprovalView/'+id,
			data:{'id':id},
			success:function(data){
				$("#dialog-popup").modal();
				$("#ModalView").html(data);
				$("#ModalFooter").html(`
					<button type="button" class="btn btn-danger" data-dismiss="modal">
						<span class="glyphicon glyphicon-remove"></span>  
						Close
					</button>
					<button type="button" class="btn btn-info btn-approve" data-no_pr=${id}>
						<span class="fa fa-check"></span>  
						Approve
					</button>
				`
				)
			}
		})
	});
	
	$(document).on('click', '.add', function(){
		$("#head_title").html("<i class='fa fa-list-alt'></i><b>Tambah Inventory</b>");
		$.ajax({
			type:'POST',
			url:siteurl+'penawaran/addHeader',
			success:function(data){
				$("#dialog-popup").modal();
				$("#ModalView").html(data);
				
			}
		})
	});
	
	
	// DELETE DATA
	$(document).on('click', '.btn-approve', function(e){
		e.preventDefault()
		var id = $(this).data('no_pr');
		// alert(id);
		swal({
		  title: "Anda Yakin?",
		  text: "Purchase Request Akan Di Approve.",
		  type: "info",
		  showCancelButton: true,
		  confirmButtonClass: "btn-info",
		  confirmButtonText: "Ya, Approve!",
		  cancelButtonText: "Batal",
		  closeOnConfirm: false
		},
		function(){
		  $.ajax({
			  type:'POST',
			  url:siteurl+'purchase_request/Approved',
			  dataType : "json",
			  data:{'id':id},
			  success:function(result){
				  if(result.status == '1'){
					 swal({
						  title: "Sukses",
						  text : "Purchase Request Approved.",
						  type : "success"
						},
						function (){
							window.location.reload(true);
						})
				  } else {
					swal({
					  title : "Error",
					  text  : "Data error. Gagal Approve data",
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
