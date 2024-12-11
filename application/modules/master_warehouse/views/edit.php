<?php
	$id = (!empty($listData[0]->id))?$listData[0]->id:'';
	$nama = (!empty($listData[0]->nama))?$listData[0]->nama:'';

	$status1 = (!empty($listData[0]->status) AND $listData[0]->status == '1')?'checked':'';
	$status2 = (!empty($listData[0]->status) AND $listData[0]->status == '0')?'checked':'';
?>
<div class="box box-primary">
	<div class="box-body">
		<form id="data_form" autocomplete="off">
			<div class="form-group row">
				<div class="col-md-3">
				<label for="">Nama Warehouse <span class='text-danger'>*</span></label>
				</div>
				<div class="col-md-9">
				<input type="hidden" class="form-control" id="id" name="id" value='<?=$id;?>'>
				<input type="text" class="form-control" id="nama" required name="nama" placeholder="Department Name" value='<?=$namaGudang;?>'>
				</div>
			</div>
			
			<div class="form-group row">
				<div class="col-md-3">
					<label for="">Kode Gudang</label>
				</div>
				<div class="col-md-4">
				<select name="kode_gudang" id="kode_gudang" class="form-control">
					<option value="">Silahkan Pilih</option>
					<option value="PUSAT" <?php if($kodeGudang == 'PUSAT'){ echo 'selected'; } ?> >PUSAT</option>
					<option value="SUBGUDANG" <?php if($kodeGudang == 'SUBGUDANG'){ echo 'selected'; } ?> >SUB GUDANG</option>
					<option value="PRODUKSI" <?php if($kodeGudang == 'PRODUKSI'){ echo 'selected'; } ?> >PRODUKSI</option>
					<option value="STOK" <?php if($kodeGudang == 'STOK'){ echo 'selected'; } ?> >GUDANG INDIRECT</option>
					<option value="SPM" <?php if($kodeGudang == 'SPM'){ echo 'selected'; } ?> >GUDANG SPAREPART MAINTENANCE</option>
					<option value="ATH" <?php if($kodeGudang == 'ATH'){ echo 'selected'; } ?> >GUDANG ATK/HOUSEHOLD</option>
				</select>
				</div>
			</div>
			
			<div class="form-group row">
				<div class="col-md-3">
					<label for="">Deskripsi</label>
				</div>
				<div class="col-md-4">
					<select name="desc" id="desc" class="form-control">
						<option value="">Silahkan Pilih</option>
						<option value="Pusat" <?php if($desc == 'Pusat'){ echo 'selected'; } ?> >Gudang Pusat</option>
						<option value="Sub Gudang" <?php if($desc == 'Sub Gudang'){ echo 'selected'; } ?> >Sub Gudang Lokal</option>
						<option value="Produksi" <?php if($desc == 'Produksi'){ echo 'selected'; } ?> >Gudang Produksi</option>
						<option value="Stok" <?php if($desc == 'Stok'){ echo 'selected'; } ?> >Stok</option>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-3">
					<label for="">Status</label>
				</div>
				<div class="col-md-4">
					<select name="status" id="status" class="form-control">
						<option value="">Silahkan Pilih</option>
						<option value="Aktif" <?php if($status == 'Aktif'){ echo 'selected'; } ?> >Aktif</option>
						<option value="Not Aktif" <?php if($status == 'Not Aktif'){ echo 'selected'; } ?> >Not Aktif</option>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-3"></div>
				<div class="col-md-9">
				<button type="submit" class="btn btn-primary" name="save" id="save"><i class="fa fa-save"></i> Save</button>
				</div>
			</div>
		</form>
	</div>
</div>


<!-- bagian baru -->