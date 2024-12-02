<?php
    $ENABLE_ADD     = has_permission('Level_4.Add');
    $ENABLE_MANAGE  = has_permission('Level_4.Manage');
    $ENABLE_VIEW    = has_permission('Level_4.View');
    $ENABLE_DELETE  = has_permission('Level_4.Delete');
	$id_bentuk = $this->uri->segment(3);
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" integrity="sha512-yVvxUQV0QESBt1SyZbNJMAwyKvFTLMyXSyBHDO4BG5t7k/Lw34tyqlSDlKIrIENIzCl+RVUNjmCPG+V/GMesRw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style type="text/css">
thead input {
	width: 100%;
}
</style>

<div id='alert_edit' class="alert alert-success alert-dismissable" style="padding: 15px; display: none;"></div>
<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.css')?>">
<div class="box">
	<div class="box-header">
			<?php if($ENABLE_ADD) : ?>
				<a class="btn btn-success btn-sm add" href="javascript:void(0)" data-id_bentuk="<?=$id_bentuk?>" title="Add"><i class="fa fa-plus">&nbsp;</i>Add</a>
			<?php endif; ?>
		<span class="pull-right" style="display: flex;">
			<form action="<?= base_url('/inventory_4/exportExcelShopee') ?>" style="margin-right: 5px;" method="POST">
				<button type="submit" class="btn btn-warning">Export Excel Shopee</button>
			</form>
			<form action="<?= base_url('/inventory_4/exportExcelTokopedia') ?>" style="margin-right: 5px;" method="POST">
				<button class="btn btn-success">Export Excel Tokopedia</button>
			</form>
			<form action="<?= base_url('/inventory_4/exportExcelTokopediaWithVarian') ?>" style="margin-right: 5px;" method="POST">
				<button class="btn btn-success">Export Excel Tokopedia with Varian</button>
			</form>
			<form action="<?= base_url('/inventory_4/exportExcelTikTok') ?>" style="margin-right: 5px;" method="POST">
				<button class="btn btn-dark">Export Excel TikTok Shop</button>
			</form>
		</span>
	</div>
	<!-- /.box-header -->
	<!-- /.box-header -->
	<div class="box-body">
		<table id="example1" class="table table-bordered table-striped">
		<thead>
		<tr>
			<th width="5">#</th>
			<th>Kategori Produk (LV I)</th>
			<th>Brand Produk (LV II)</th>
			<th>Tipe Produk (LV III)</th>
			<th width="13%" >Varian 1</th>
			<th width="13%" >Varian 2</th>
			<th>Nama Produk</th>
			<th>SKU Varian</th>
			<th>Price Produk</th>
		    <th>Status</th>
			<?php if($ENABLE_MANAGE) : ?>
			<th width="13%">Action</th>
			<?php endif; ?>
		</tr>
		</thead>
		<tbody>
		<?php if(empty($results)){
		}else{
			$numb=0; foreach($results AS $record){ $numb++; ?>
		<tr>
		    <td><?= $numb; ?></td>
			<td ><?= $record->nama_type ?></td>
			<td ><?= $record->nama_category1 ?></td>
			<td ><?= $record->nama_category2 ?></td>
			<td ><?= $record->variasi1 . " - " . $record->varian1 ?></td>
			<td ><?= $record->variasi2 . " - " . $record->varian2 ?></td>
			<td ><?= $record->nama ?></td>
			<td ><?= $record->sku_varian ?></td>
			<td ><?= "Rp. " . number_format($record->price, 2, ',', '.') ?></td>
			<td>
				<?php if($record->aktif == 'aktif'){ ?>
					<label class="label label-success">Aktif</label>
				<?php }else{ ?>
					<label class="label label-danger">Non Aktif</label>
				<?php } ?>
			</td>
			<style>
				.btn-sm {
					margin: 5px;
				}
			</style>
			<td style="padding-left:20px">
			<?php if($ENABLE_VIEW) : ?>
				<a class="btn btn-primary btn-sm view" href="javascript:void(0)" title="View" data-id_inventory3="<?=$record->id?>"><i class="fa fa-eye"></i>
				</a>
			<?php endif; ?>
			<?php if($ENABLE_MANAGE) : ?>
				<a class="btn btn-warning btn-sm edit" href="javascript:void(0)" title="Edit" data-id_inventory3="<?=$record->id?>"><i class="fa fa-edit"></i>
				</a>
			<?php endif; ?>

			<?php if($ENABLE_DELETE) : ?>
				<a class="btn btn-danger btn-sm delete" href="javascript:void(0)" title="Delete" data-id_inventory3="<?=$record->id?>"><i class="fa fa-trash"></i>
				</a>
			<?php endif; ?>
			<?php if($ENABLE_MANAGE) : ?>
				<a class="btn btn-info btn-sm copy" href="javascript:void(0)" title="Copy" data-id_inventory3="<?=$record->id?>"><i class="fa fa-copy"></i>
				</a>
			<?php endif; ?>
			<?php if($ENABLE_MANAGE) : ?>
				<a class="btn btn-success btn-sm tokopedia" href="javascript:void(0)" title="Tokopedia Setting" data-id_inventory3="<?=$record->id?>"><i class="fa fa-desktop"></i>
				</a>
			<?php endif; ?>
			<?php if($ENABLE_MANAGE) : ?>
				<a class="btn btn-primary btn-sm barcode-setting" href="javascript:void(0)" title="Barocode Setting" data-id_inventory3="<?=$record->id?>"><i class="fa fa-barcode"></i>
				</a>
			<?php endif; ?>
			</td>

		</tr>
		<?php } }  ?>
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
        <h4 class="modal-title" id="myModalLabel"><span class="fa fa-users"></span>&nbsp;Data Inventory</h4>
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

<div class="modal modal-default fade" id="dialog-barcode" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel"><span class="fa fa-users"></span>&nbsp;Manage Image Barcode | SKU Varian : <strong id="dialog-barcode-header-sku"></strong></h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<input type="hidden" id="barcode-id">
						<label for="">Barcode Image: </label>
						<input type="file" accept=".jpg, .jpeg, .png, .pdf" onchange="return loadFile(event)" class="form-control" id="barcode_image" name="barcode_image">
					</div>
					<div class="col-md-6">
						<img src="" id="view-barcode-image" width="100%" height="350px" alt="No Image">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">
				<span class="glyphicon glyphicon-remove"></span>  Close</button>
			</div>
		</div>
	</div>
</div>

<!-- DataTables -->
<script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
<script src="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.min.js')?>"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js" integrity="sha512-rMGGF4wg1R73ehtnxXBt5mbUfN9JUJwbk21KMlnLZDJh7BkPmeovBuddZCENJddHYYMkCh9hPFnPmS9sspki8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>	 

<!-- page script -->
<script type="text/javascript">

	var loadFile = function(event) {
		var output = document.getElementById('view-barcode-image');

		var file = event.target.files[0];

		var code = $("#barcode-id").val();

		// alert(code);
		
		var form_data = new FormData();
		form_data.append('file', file);
		form_data.append('id', code);

		if (event.target.files && event.target.files[0]){
			$.ajax({
				url: "<?php echo base_url() ?>inventory_4/saveImage",
				type: "POST",
				data: form_data,
				processData: false,
				contentType: false,
				success: function(res) {
					if (res.code == 200) {
						output.src = URL.createObjectURL(event.target.files[0]);
						output.onload = function() {
							URL.revokeObjectURL(output.src) // free memory
						}
						// document.getElementById('image-text').value = res.name
						// console.log(res);
					}
				}
			});
		}        
	};

	$(document).on('click', '.barcode-setting', function(e) {
		var id = $(this).data('id_inventory3');
		$.ajax({
			type: 'GET',
			url: siteurl+'inventory_4/barcodesetting/'+id,
			success:function(result){
				if (result.code == 200) {	
					$("#barcode-id").val(result.data.id);
					var srcImage = "<?= base_url() ?>" +  result.data.barcode;
					$("#view-barcode-image").attr('src', srcImage);
					$("#dialog-barcode-header-sku").text(result.data.sku_varian);
					$("#dialog-barcode").modal();
				}
			}
		})
	});

	$(document).on('click', '.edit', function(e){
		var id = $(this).data('id_inventory3');
		$("#head_title").html("<i class='fa fa-list-alt'></i><b>Edit Inventory</b>");
		$.ajax({
			type:'POST',
			url:siteurl+'inventory_4/editInventory/'+id,
			success:function(data){
				$("#dialog-popup").modal();
				$("#ModalView").html(data);
				
			}
		})
	});

	$(document).on('click', '.tokopedia', function(e){
		var id = $(this).data('id_inventory3');
		$("#head_title").html("<i class='fa fa-list-alt'></i><b>Edit Inventory</b>");
		$.ajax({
			type:'POST',
			url:siteurl+'inventory_4/tokopediaInventory/'+id,
			success:function(data){
				$("#dialog-popup").modal();
				$("#ModalView").html(data);
			}
		})
	});
	
	$(document).on('click', '.copy', function(e){
		var id = $(this).data('id_inventory3');
		$("#head_title").html("<i class='fa fa-list-alt'></i><b>Copy Inventory</b>");
		$.ajax({
			type:'POST',
			url: siteurl+'inventory_4/addInventory',
			data: {
				id: id
			},
			success:function(data){
				$("#dialog-popup").modal();
				$("#ModalView").html(data);	
			}
		})
	});
	
	$(document).on('click', '.view', function(){
		var id = $(this).data('id_inventory3');
		// alert(id);
		$("#head_title").html("<i class='fa fa-list-alt'></i><b>Detail Inventory</b>");
		$.ajax({
			type:'POST',
			url:siteurl+'inventory_4/viewInventory/'+id,
			data:{'id':id},
			success:function(data){
				$("#dialog-popup").modal();
				$("#ModalView").html(data);
				
			}
		})
	});
		$(document).on('click', '.add', function(){
			var id = $(this).data('id_bentuk');
			$("#head_title").html("<i class='fa fa-list-alt'></i><b>Tambah Inventory</b>");
			$.ajax({
				type:'POST',
				url:siteurl+'inventory_4/addInventory/'+id,
				data:{'id':id},
				success:function(data){
					$("#dialog-popup").modal();
					$("#ModalView").html(data);
					
				}
			})
	});
	
	
	// DELETE DATA
	$(document).on('click', '.delete', function(e){
		e.preventDefault()
		var id = $(this).data('id_inventory3');
		// alert(id);
		swal({
		  title: "Anda Yakin?",
		  text: "Data Inventory akan di hapus.",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonClass: "btn-info",
		  confirmButtonText: "Ya, Hapus!",
		  cancelButtonText: "Batal",
		  closeOnConfirm: false
		},
		
		function(){
		  $.ajax({
			  type:'POST',
			  url:siteurl+'inventory_4/deleteInventory',
			  dataType : "json",
			  data:{'id':id},
			  success:function(result){
				  if(result.status == '1'){
					 swal({
						  title: "Sukses",
						  text : "Data Inventory berhasil dihapus.",
						  type : "success"
						},
						function (){
							window.location.reload(true);
						})
				  } else {
					swal({
					  title : "Error",
					  text  : "Data error. Gagal hapus data",
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
	    var table = $('#example3').DataTable( {
	        orderCellsTop: true,
	        fixedHeader: true,
			buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
	    } );
    	$("#form-area").hide();
  	}); 
	$(function() {
	    // var table = $('#example1').DataTable( {
	        // orderCellsTop: true,
	        // fixedHeader: true,
			// buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
	    // } );
    	$("#form-area").hide();
  	});
	  	$(function() {
	    var table = $('#example4').DataTable( {
	        orderCellsTop: true,
	        fixedHeader: true,
			buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
	    } );
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
