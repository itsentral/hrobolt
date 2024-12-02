<?php
    $ENABLE_ADD     = has_permission('Budget_Rutin.Add');
    $ENABLE_MANAGE  = has_permission('Budget_Rutin.Manage');
    $ENABLE_VIEW    = has_permission('Budget_Rutin.View');
    $ENABLE_DELETE  = has_permission('Budget_Rutin.Delete');
?>
<div id='alert_edit' class="alert alert-success alert-dismissable" style="padding: 15px; display: none;"></div>
<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.css')?>">
<div class="box">
	<div class="box-header">
		<?php if ($ENABLE_VIEW) : ?>
			<a class="btn btn-info" href="<?=base_url().'budget_rutin/kompilasi'?>" title="Kompilasi"><i class="fa fa-clone">&nbsp;</i>Kompilasi Budget</a>
		<?php endif; ?>
		<?php if ($ENABLE_ADD) : ?>
			<a class="btn btn-success" href="javascript:void(0)" title="Add" onclick="add_data()"><i class="fa fa-plus">&nbsp;</i>Add Budget</a>
		<?php endif; ?>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<table id="mytabledata" class="table table-bordered table-striped">
		<thead>
		<tr>
			<th>#</th>
			<th>Tanggal Dibuat</th>
			<th>Departement</th>
			<th>Costcenter</th>
			<th>Rev</th>
			<th width="50">
			<?php if($ENABLE_MANAGE) : ?>
			Action
			<?php endif; ?>
			</th>
		</tr>
		</thead>

		<tbody>
		<?php if(empty($results)){
		}else{
			$numb=0; foreach($results AS $record){ $numb++; ?>
		<tr>
		    <td><?= $numb ?></td>
			<td><?= $record->tanggal ?></td>
			<td><?= $record->nm_dept?></td>
			<td><?= $record->cost_center ?></td>
			<td><?= $record->rev ?></td>
			<td>
			<?php if($ENABLE_VIEW) : ?>
				<a class="text-green" href="javascript:void(0)" title="View" onclick="view_data('<?=$record->code_budget?>')"><i class="fa fa-view"></i></a>
			<?php endif;
			if($ENABLE_MANAGE) : ?>
				<a class="text-green" href="javascript:void(0)" title="Edit" onclick="edit_data('<?=$record->code_budget?>')"><i class="fa fa-pencil"></i></a>
			<?php endif;
			if($ENABLE_DELETE) : ?>
				<a class="text-red" href="javascript:void(0)" title="Delete" onclick="delete_data('<?=$record->code_budget?>')"><i class="fa fa-trash"></i></a>
			<?php endif; ?>
			</td>
		</tr>
		<?php } 
		}  ?>
		</tbody>
		</table>
	</div>
	<!-- /.box-body -->
</div>

<div id="form-data">
</div>
<!-- DataTables -->
<script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
<script src="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.min.js')?>"></script>
<!-- page script -->
<script type="text/javascript">

  	$(function() {
    	$("#mytabledata").DataTable({
			"paging":   true,
		});
    	$("#form-data").hide();
  	});

  	function add_data(){
		var url = 'budget_rutin/create/';
		$(".box").hide();
		$("#form-data").show();
		$("#form-data").load(siteurl+url);
		$("#title").focus();
	}

  	function edit_data(id){
		if(id!=""){
			var url = 'budget_rutin/edit/'+id;
			$(".box").hide();
			$("#form-data").show();
			$("#form-data").load(siteurl+url);
		    $("#title").focus();
		}
	}

	//Delete
	function delete_data(id){
		//alert(id);
		swal({
		  title: "Anda Yakin?",
		  text: "Data Akan Terhapus secara Permanen!",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "Ya, delete!",
		  cancelButtonText: "Tidak!",
		  closeOnConfirm: false,
		  closeOnCancel: true
		},
		function(isConfirm){
		  if (isConfirm) {
		  	$.ajax({
		            url: siteurl+'budget_rutin/hapus_data/'+id,
		            dataType : "json",
		            type: 'POST',
		            success: function(msg){
		                if(msg['delete']=='1'){
		                    swal({
		                      title: "Terhapus!",
		                      text: "Data berhasil dihapus",
		                      type: "success",
		                      timer: 1500,
		                      showConfirmButton: false
		                    });
		                    window.location.reload();
		                } else {
		                    swal({
		                      title: "Gagal!",
		                      text: "Data gagal dihapus",
		                      type: "error",
		                      timer: 1500,
		                      showConfirmButton: false
		                    });
		                };
		            },
		            error: function(){
		                swal({
	                      title: "Gagal!",
	                      text: "Gagal Eksekusi Ajax",
	                      type: "error",
	                      timer: 1500,
	                      showConfirmButton: false
	                    });
		            }
		        });
		  } else {
		    //cancel();
		  }
		});
	}
</script>
