<?php
    $ENABLE_ADD     = has_permission('Purchase_Order.Add');
    $ENABLE_MANAGE  = has_permission('Purchase_Order.Manage');
    $ENABLE_VIEW    = has_permission('Purchase_Order.View');
    $ENABLE_DELETE  = has_permission('Purchase_Order.Delete');
	
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
		<div class="box active">
			<div class="box-body">
				<a href="<?= base_url('purchase_order')?>" class="btn btn-default">Back</a>
			</div>
			<div class="box-body">
				<div style="display: flex; justify-content: space-between;">
					<div>
						<h4 style="font-weight: bold;" >Pilih Purchase Request Anda</h4>
					</div>
					<div class="">
						<input type="hidden" name="cekppn" id="cekppn" class="form-control input-sm" placeholder="">
						<input type="hidden" name="cekcus" id="cekcus" class="form-control input-sm">
						<input type="hidden" id="cekcustomer" class="form-control input-sm">
						<button onclick="proses_do()" class="btn btn-primary" id="btn-proses-do" <?php // echo $disabled?> type="button"> Proses PO</button>
					</div>
				</div>
				<div>
					<ol>
						<li>Pilih Purchase Request yang akan di buat PO</li>
						<li>Lalu Klik, tombol Proses PO</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<!-- /.box-header -->
	<!-- /.box-header -->
	
	<div class="box-body">
		<table id="table-purchase-request" class="table table-bordered table-striped">
		<thead>
		<tr>
			<th>#</th>
			<th width="10%">ID </th>
			<th>No </th>
            <th>Tanggal </th>
            <th>Requestor </th>
			<th>Tingkat Kebutuhan</th>
			<?php if($ENABLE_MANAGE) : ?>
			<th>Details</th>
			<th>Action</th>
			<?php endif; ?>
		</tr>
		</thead>

		<tbody>
		<?php if(empty($results)){
		} else {
			$numb = 0; foreach($results AS $record){ $numb++; 
		?>
			
		<tr>
		    <td><?= $numb; ?></td>
			<td><?= $record->no_pr ?></td>
			<td><?= strtoupper($record->no_surat) ?></td>
            <td><?= $record->tanggal ?></td>
            <td><?= strtoupper($record->nama_karyawan) . " - " . strtoupper($record->nama_department) ?></td>
			<td><?= ($record->tingkat_kebutuhan == 'sangat penting') ? "<span class='label label-danger'>".strtoupper($record->tingkat_kebutuhan)."</span>"  : 
					(($record->tingkat_kebutuhan == 'penting') ? "<span class='label label-success'>".strtoupper($record->tingkat_kebutuhan)."</span>" :
					(($record->tingkat_kebutuhan == 'biasa') ? "<span class='label label-info'>".strtoupper($record->tingkat_kebutuhan)."</span>" : "NULL")) ?></td>
			<td>
				<a class='btn btn-primary btn-sm view' href='javascript:void(0)' title='View' data-no_pr='<?= $record->no_pr ?>'><i class='fa fa-eye'></i>
				</a>
			</td>
			<td>
				<?php if($ENABLE_MANAGE)  : ?>		
        			<input type="checkbox" class="set_choose_do" name="set_choose_do" id="set_choose_do<?php echo $numb?>" value="<?php echo $record->no_pr?>" onclick="cekcus('<?php echo $record->requestor?>','<?php echo $numb?>','<?php echo $vso->ppn?>','<?php echo $vso->nm_customer?>','<?php echo set_choose_do.$numb?>')">
           	 	<?php endif; ?>
			</td>		
		</tr>
		<?php 	 
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
        <span class="glyphicon glyphicon-remove"></span>  Close</button>
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
	$("#table-purchase-request").DataTable();

	$(document).ready(function(){
		$("#idcustomer").select2({
			placeholder: "Pilih",
			allowClear: true
		});
	});

	function getcustomer(){
        var idcus = $('#idcustomer').val();
        window.location.href = siteurl+"wt_delivery_order/addSpkdelivery/"+idcus;
    }

	$(document).on('click', '.edit', function(e){
		var id = $(this).data('no_penawaran');
		$("#head_title").html("<i class='fa fa-list-alt'></i><b>Edit Inventory</b>");
		$.ajax({
			type:'POST',
			url:siteurl+'wt_penawaran/editPenawaran/'+id,
			success:function(data){
				$("#dialog-popup").modal();
				$("#ModalView").html(data);
				
			}
		})
	});

	$(document).on('click', '.view', function(){
		var id = $(this).data('no_pr');
		// alert(id);
		$("#head_title").html("<i class='fa fa-list-alt'></i><b>Detail Inventory</b>");
		$.ajax({
			type:'POST',
			url:siteurl+'purchase_order/ViewPurchaseRequest/'+id,
			data:{'id':id},
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

	function cekcus(idcus,no,ppn,id,set)
	{
		var table = $('#example1').DataTable();
		var cek = $('#'+set);
		//alert(cek.value);
		if (cek.is(":checked")) {
			table.column(2).search( id ).draw();
		}
		else{
			table.column(2).search('').draw();
		}

		var customer = $('#cekcustomer').val();
		var cekppn   = $('#cekppn').val();
		var reason = [];
		var jumcus = 0;

		$(".set_choose_do:checked").each(function() {
			reason.push($(this).val());
			jumcus++;
		});

		$('#cekcus').val(reason.join(';'));
  	}

	function proses_do()
	{
		var param = $('#cekcus').val();
		var uri3 = '<?php echo $this->uri->segment(3)?>';
		window.location.href = siteurl+"purchase_order/proses/"+uri3+"?param="+param;
	}
</script>
