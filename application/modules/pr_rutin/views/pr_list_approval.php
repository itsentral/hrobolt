<?php
$ENABLE_ADD     = has_permission('Approval_PR_Stock.Add');
$ENABLE_MANAGE  = has_permission('Approval_PR_Stock.Manage');
$ENABLE_VIEW    = has_permission('Approval_PR_Stock.View');
$ENABLE_DELETE  = has_permission('Approval_PR_Stock.Delete');
?>
<div id="alert_edit" class="alert alert-success alert-dismissable" style="padding: 15px; display: none;"></div>
<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.css')?>">
<div class="box">
	<!-- /.box-header -->
	<div class="box-body"><div class="table-responsive">
		<table id="mytabledata" class="table table-bordered table-striped">
		<thead>
		<tr>
			<th width="5">No</th>
			<th>No PR</th>
			<th>Tgl PR</th>
			<th>Requestor</th>
			<th>Status</th>
			<th width="100">
			<?php if($ENABLE_MANAGE) : ?>
				Action
			<?php endif; ?>
			</th>
		</tr>
		</thead>
		<tbody>
		<?php
		if(!empty($results)){
			$numb=0; foreach($results AS $record){ $numb++; ?>
		<tr>
		    <td><?= $numb; ?></td>
			<td><?= $record->pr_no ?></td>
			<td><?= $record->pr_date ?></td>
			<td><?= $record->nama_karyawan ?></td>
			<td><?= $status[$record->status] ?></td>
			<td nowrap>
			<?php if($ENABLE_VIEW) : ?>
				<a class="btn btn-warning btn-sm view" href="javascript:void(0)" title="View" onclick="data_view('<?=$record->id?>')"><i class="fa fa-eye"></i></a>
			<?php endif;
			if($ENABLE_MANAGE) :
				if ($record->status==0 || $record->status==10) {
					echo '
						<a class="btn btn-success btn-sm approve" href="javascript:void(0)" title="Approve" onclick="data_approve('.$record->id.')"><i class="fa fa-check"></i></a>
						';
				}
			endif;
			?>
			</td>
		</tr>
		<?php
			}
		}  ?>
		</tbody>
		</table>
		</div>
	</div>
	<!-- /.box-body -->
</div>
<div id="form-data"></div>
<!-- DataTables -->
<script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
<script src="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.min.js')?>"></script>
<!-- page script -->
<script type="text/javascript">
	var url_edit = siteurl+'pr_rutin/edit/';
	var url_view = siteurl+'pr_rutin/view/';
  	function data_approve(id){
		if(id!=""){
			$(".box").hide();
			$("#form-data").show();
			$("#form-data").load(url_edit+id+'/approve');
		}
	}
</script>
<script src="<?= base_url('assets/js/basic.js')?>"></script>
