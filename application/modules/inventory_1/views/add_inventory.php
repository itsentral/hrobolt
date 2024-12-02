<?php
    $ENABLE_ADD     = has_permission('Jenis_Produk_(LVL_1).Add');
    $ENABLE_MANAGE  = has_permission('Jenis_Produk_(LVL_1).Manage');
    $ENABLE_VIEW    = has_permission('Jenis_Produk_(LVL_1).View');
    $ENABLE_DELETE  = has_permission('Jenis_Produk_(LVL_1).Delete');
?>
<style type="text/css">
thead input {
	width: 100%;
}
</style>
<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.css')?>">
<link rel="stylesheet" href="<?= base_url('assets/plugins/sweetalert/dist/sweetalert.css')?>">

          <div class="box box-primary">
            <div class="box-body">
			
			<form id="data_form">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group row">
							<div class="col-md-3">
							  	<label for="">Nama Kategori Produk</label>
							</div>
							<div class="col-md-7">
							  	<input type="text" class="form-control" id="" required name="nm_inventory" placeholder="Nama Tipe">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-3">
							  	<label for="">Kode SKU Kategori Produk</label>
							</div>
							<div class="col-md-7">
							  	<input type="text" class="form-control" id="" required name="kode_sku" placeholder="Kode SKU Tipe">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-3">
							  	<label for="">Kode Kategori MarketPlace Produk</label>
							</div>
							<div class="col-md-7">
							  	<input type="text" class="form-control" id="" required name="kode_kategory_marketplace" placeholder="Kode Kategori Marketplace Tipe">
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<button type="submit" class="btn btn-primary pull-right col-md-4" name="save" id="save"><i class="fa fa-save"></i> Save</button>
							</div>
						</div>
					</div>
				</div>
				
			</form>
        </div>

<!-- Modal Bidus-->
<script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
<script src="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.min.js')?>"></script>
<script src="<?= base_url('assets/plugins/sweetalert/dist/sweetalert.js')?>"></script>
<!-- End Modal Bidus-->

<script type="text/javascript">

  $(document).ready(function() {
	$('.select2').select2();
    $(document).on('submit', '#data_form', function(e){
		e.preventDefault()
		var data = $('#data_form').serialize();
		// alert(data);

		swal({
		  title: "Anda Yakin?",
		  text: "Data Inventory akan di simpan.",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonClass: "btn-info",
		  confirmButtonText: "Ya, Simpan!",
		  cancelButtonText: "Batal",
		  closeOnConfirm: false
		},
		function(){
		  $.ajax({
			  type:'POST',
			  url:siteurl+'inventory_1/saveNewinventory',
			  dataType : "json",
			  data:data,
			  success:function(result){
				  if(result.status == '1'){
					 swal({
						  title: "Sukses",
						  text : "Data Inventory berhasil disimpan.",
						  type : "success"
						},
						function (){
							window.location.reload(true);
						})
				  } else {
					swal({
					  title : "Error",
					  text  : "Data error. Gagal insert data",
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
   
  });

  

</script>
