<?php
$ENABLE_ADD     = has_permission('Level_4.Add');
$ENABLE_MANAGE  = has_permission('Level_4.Manage');
$ENABLE_VIEW    = has_permission('Level_4.View');
$ENABLE_DELETE  = has_permission('Level_4.Delete');
$id='';
$id_category3='';
if(!empty($results['inven'])){
	
	foreach ($results['inven'] as $inven){
		if ($inven->alloy !=''){
			$all =$inven->alloy;
		}
		else {
			$all =$results['alloy'];
		}
		if ($inven->spek !=''){
			$spesifikasi =$inven->spek;
		}
		else {
			$spesifikasi =$inven->nama;
		}
		$id=$inven->id;
		$id_category3=$inven->id_category3;
	}
}
?>
<div class="box box-primary">
  <div class="box-body">
    <form id="data-form" method="post">
      <input type="hidden" class="form-control" id="id" value='<?= $id ?>' name="id">
      <input type="hidden" class="form-control" id="id_category3" value='<?= $id_category3 ?>' name="id_category3">
      <div class="col-sm-12">
        <div class="input_fields_wrap2">
          <div class="row">
            <div class="form-group row">
              <div class="col-md-4">
                <label for="customer">Kategori Produk (Level 1)</label>
              </div>
              <div class="col-md-6">
                <select id="id_type" name="id_type" class="form-control select" onchange="get_inv2(<?= $results['dataProduct']->id ?>)" required>
                  <option value="">Kategori Produk (Level 1)</option>
                  <?php foreach ($results['inventory_1'] as $datacombo){
                    $select = $results['dataProduct']->id_type == $datacombo->id ? 'selected' : '';?>
                    <option value="<?= $datacombo->id?>|<?= $datacombo->nama?>|<?= $datacombo->sku_code?>" <?= $select ?>> <?= $datacombo->nama?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-4">
                <label for="customer">Brand Produk (Level 2)</label>
              </div>
              <div class="col-md-6">
                <select id="id_category1" name="id_category1" class="form-control select" onchange="get_inv3(<?= $results['dataProduct']->id ?>)" required>
                  <option value="">Brand Produk (Level 2)</option>
                  <?php
                  if(!empty($results['inventory_2'])){
                    foreach ($results['inventory_2'] as $datacombo){
                      $select = $results['dataProduct']->id_category1 == $datacombo->id ? 'selected' : '';?>
                      <option value="<?= $datacombo->id?>|<?= $datacombo->nama?>|<?= $datacombo->sku_code?>" <?= $select ?>> <?= $datacombo->nama?></option>
                    <?php } 
                  }?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-4">
                <label for="customer">Tipe Produk (Level 3)</label>
              </div>
              <div class="col-md-6">
                <select id="id_category2" name="id_category2" class="form-control select" onchange="get_inv4(<?= $results['dataProduct']->id ?>)" required>
                  <option value="">Tipe Produk (Level 3)</option>
                  <?php 
                  if(!empty($results['inventory_3'])){
                    foreach ($results['inventory_3'] as $datacombo){
                    $select = $results['dataProduct']->id_category2 == $datacombo->id ? 'selected' : '';?>
                    <option value="<?= $datacombo->id?>|<?= $datacombo->nama?>|<?= $datacombo->sku_code?>" <?= $select ?>> <?= $datacombo->nama?></option>
                  <?php } 
                  }?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-4">
                <label for="customer">Variasi 1 Produk</label>
              </div>
              <div class="col-md-6">
                <select class="form-control" id="variasi1" onchange="return get_varian1(this)" required name="variasi1">
                  <option value="" >Silahkan Pilih</option>
                  <?php foreach($results['variasi'] AS $variasi) { 
                    $select = $results['dataProduct']->variasi1 == $variasi->name ? 'selected' : '';?>
                    <option value="<?= $variasi->name ?>" data-id="<?= $variasi->id ?>" <?= $select ?>> <?= $variasi->name?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-4">
                <label for="customer">Varian 1 Produk</label>
              </div>
              <div class="col-md-6">
                <select id="varian1" name="varian1" onchange="get_inv5()" class="form-control select" required>
                  <option value="">Varian Produk</option>
                  <?php foreach($results['varian1'] AS $varian1) { 
                    $select = $results['dataProduct']->varian1 == $varian1->name ? 'selected' : '';?>
                    <option <?php echo $varian1->name ?> <?= $select ?>><?php echo $varian1->name ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-4">
                <label for="customer">Variasi 2 Produk</label>
              </div>
              <div class="col-md-6">
                <select class="form-control" id="variasi2" onchange="return get_varian2(this)" required name="variasi2">
                  <option value="">Silahkan Pilih</option>
                  <?php foreach($results['variasi'] AS $variasi) {
                    $select = $results['dataProduct']->variasi2 == $variasi->name ? 'selected' : '';?>
                    <option value="<?= $variasi->name ?>" data-id="<?= $variasi->id ?>" <?= $select ?>> <?= $variasi->name?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-4">
                <label for="customer">Varian 2 Produk</label>
              </div>
              <div class="col-md-6">
                <select id="varian2" name="varian2" onchange="get_inv6()" class="form-control select" required>
                  <option value="">Varian Produk</option>
                  <?php foreach($results['varian2'] AS $varian2) { 
                    $select = $results['dataProduct']->varian2 == $varian2->name ? 'selected' : '';?>
                    <option <?php echo $varian2->name ?> <?= $select ?>><?php echo $varian2->name ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-4">
                <label for="customer">Nama Produk</label>
              </div>
              <div class="col-md-6">
                <input type="text" class="form-control nama" id="nama" name="nama" placeholder="Nama Produk" value='<?= $results['dataProduct']->nama ?>'>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-4">
                <label for="customer">Nama Produk Marketplace</label>
              </div>
              <div class="col-md-6">
                <input type="text" class="form-control nama" id="nama_marketplace" name="nama_marketplace" placeholder="Nama Produk Marketplace" value='<?= $results['dataProduct']->nama_marketplace ?>'>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-4">
                <label for="customer">Barcode Produk</label>
              </div>
              <div class="col-md-6">
                <input type="file" accept=".pdf, .jpg, .png" class="form-control" id="barcode" name="barcode" placeholder="Barcode Produk">
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-4">
                <label for="customer">SKU Induk</label>
              </div>
              <div class="col-md-6">
				        <input type="text" class="form-control" id="sku_induk" required name="sku_induk" placeholder="SKU Induk Barang" value='<?= $results['dataProduct']->sku_induk ?>'>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-4">
                <label for="customer">SKU Varian</label>
              </div>
              <div class="col-md-6">
				        <input type="text" class="form-control" id="sku_varian" required name="sku_varian" placeholder="SKU Varian Barang" value='<?= $results['dataProduct']->sku_varian ?>'>
              </div>
            </div>
			      <div class="form-group row">
              <div class="col-md-4">
                <label for="customer">Harga</label>
              </div>
              <div class="col-md-6">
                <input type="number" class="form-control" id="harga" required name="harga" placeholder="Price" step=".01" value='<?= $results['dataProduct']->price ?>'>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-4">
                <label for="customer">Panjang</label>
              </div>
              <div class="col-md-4">
                <input type="text" class="form-control" id="panjang" required name="panjang" placeholder="30" value='<?= $results['dataProduct']->panjang ?>'>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-4">
                <label for="customer">Tinggi</label>
              </div>
              <div class="col-md-4">
                <input type="text" class="form-control" id="tinggi" required name="tinggi" placeholder="30" value='<?= $results['dataProduct']->tinggi ?>'>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-4">
                <label for="customer">Lebar</label>
              </div>
              <div class="col-md-4">
                <input type="text" class="form-control" id="lebar" required name="lebar" placeholder="30" value='<?= $results['dataProduct']->lebar ?>'>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-4">
                <label for="customer">Diameter</label>
              </div>
              <div class="col-md-4">
                <input type="text" class="form-control" id="diameter" required name="diameter" placeholder="30" value='<?= $results['dataProduct']->diameter ?>'>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-4">
                <label for="customer">Satuan Panjang, Lebar, Tinggi</label>
              </div>
              <div class="col-md-4">
                <select class="form-control" id="satuanukur" name="satuanukur">
                  <option value="">Silahkan Pilih Satuan</option>
                  <?php
                    foreach($results['measurements'] AS $measurement) {
                  ?>
                    <option value="<?= $measurement->code ?>" <?= ($measurement->code == $results['dataProduct']->satuan_volume) ? 'selected' : '' ?>><?= strtoupper($measurement->nama) ?></option>
                  <?php 
                    } 
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-4">
                <label for="customer">Berat</label>
              </div>
              <div class="col-md-4">
                <input type="text" class="form-control" id="berat" required name="berat" placeholder="30" value='<?= $results['dataProduct']->berat ?>'>
              </div>
              <div class="col-md-4">
                <select class="form-control" id="beratsatuan" name="beratsatuan">
                  <option value="">Silahkan Pilih Satuan</option>
                  <?php
                    foreach($results['measurements'] AS $measurement) {
                  ?>
                    <option value="<?= $measurement->code ?>" <?= ($measurement->code == $results['dataProduct']->satuan_berat) ? 'selected' : '' ?>><?= strtoupper($measurement->nama) ?></option>
                  <?php 
                    } 
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-4">
                <label for="customer">Satuan Packing</label>
              </div>
              <div class="col-md-4">
                <select class="form-control" id="satuan_packing" name="satuan_packing">
                  <option value="">Silahkan Pilih Satuan</option>
                  <?php
                    foreach($results['packings'] AS $packing) {
                  ?>
                    <option value="<?= $packing->code ?>" <?= ($packing->code == $results['dataProduct']->satuan_packing) ? 'selected' : '' ?>><?= strtoupper($packing->nama) ?></option>
                  <?php 
                    } 
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-4">
                <label for="customer">Barang Berbahaya ?</label>
              </div>
              <div class="col-md-4">
                <select class="form-control" name="barangberbahaya" id="barangberbahaya">
                  <option>Silahkan Pilih</option>
                  <option value="true" <?= ($results['dataProduct']->barang_berbahaya == 1) ? 'selected' : '' ?>>IYA</option>
                  <option value="false" <?= ($results['dataProduct']->barang_berbahaya == 0) ? 'selected' : '' ?>>TIDAK</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-4">
                <label for="customer">Pengiriman</label>
              </div>
              <div class="col-md-4">
                <input type="checkbox" <?= ($results['dataProduct']->sameday == "Aktif") ? 'checked' : '' ?> name="sameday" value="Aktif"> Sameday
                <input type="checkbox" <?= ($results['dataProduct']->nextday == "Aktif") ? 'checked' : '' ?> name="nextday" value="Aktif"> Nextday
                <input type="checkbox" <?= ($results['dataProduct']->reguler == "Aktif") ? 'checked' : '' ?> name="reguler" value="Aktif"> Reguler (Cashless)
                <input type="checkbox" <?= ($results['dataProduct']->hemat == "Aktif") ? 'checked' : '' ?> name="hemat" value="Aktif"> Hemat
                <input type="checkbox" <?= ($results['dataProduct']->kargo == "Aktif") ? 'checked' : '' ?> name="kargo" value="Aktif"> Kargo
                <input type="checkbox" <?= ($results['dataProduct']->preorder == "Aktif") ? 'checked' : '' ?> name="preorder" value="Aktif"> Pre Order
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-4">
                <label for="grade">Grade Produk</label>
              </div>
              <div class="col-md-4">
                <input type="text" class="form-control" name="grade" id="grade" />
              </div>
            </div>
            <!-- <div class="form-group row">
              <div class="col-md-4">
                <label for="grade">Size Produk</label>
              </div>
              <div class="col-md-4">
                <input type="text" class="form-control" name="size" id="size" />
              </div>
            </div> -->
            <div class="form-group row">
              <div class="col-md-4">
                <label for="grade">Merk Produk</label>
              </div>
              <div class="col-md-4">
                <input type="text" class="form-control" name="merk" id="merk" />
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-4">
                <label for="grade">Rak Produk</label>
              </div>
              <div class="col-md-4">
                <select class="form-control" name="rak" id="rak">
                  <option>Silahkan Pilih</option>
                  <?php foreach($results['rak'] AS $rak) { ?>
                  <option value="<?= $rak->id ?>"><?= $rak->name ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-4">
                <label for="customer">Deskripsi Produk</label>
              </div>
              <div class="col-md-6">
                <textarea name="deskripsi" id="deskripsi" rows="5" class="form-control"><?= $results['dataProduct']->deskripsi ?></textarea>
                <!-- <input type="text" class="form-control" id="harga" required name="harga" value='' placeholder="Price"> -->
              </div>
            </div>
            <label>Foto Produk</label>
            <div class="row">
            <?php if ($results['dataProduct']) { ?>
            <?php 
                $count = 9;
                $j = 1;
                $data = [];
                foreach ($results['productImages'] AS $key => $image) {
                  $data[$key] = [
                    'key' => $key,
                    'idproduct' => $image->id_product,
                    'id' => $image->id,
                    'foto_url' => $image->foto_url
                  ];
                }
                $dataKey = array_keys($data);
                $dataCount = count($data);
                for ($i = 0; $i < 9; $i++) {
                  if ($data[$i]['key'] == $i) {
                  ?>
                    <div class="col-md-4" style="margin-top: 20px;">
                      <div class="mb-4 d-flex justify-content-center">
                        <img id="selectedImage<?php echo $j; ?>" src="<? echo base_url($data[$i]['foto_url']) ?>"
                        alt="example placeholder" style="width: 250px;" />
                      </div>
                      <div class="d-flex justify-content-center">
                        <input type="hidden" name="idproductimages[<?php echo $i; ?>]" value="<? echo $data[$i]['id'] ?>">
                        <input type="file" name="files[<?php echo $i; ?>]" accept=".jpg,.jpeg,.png" class="form-control d-none" id="customFile1" onchange="displaySelectedImage(event, 'selectedImage<?php echo $j; ?>')" />
                      </div>
                    </div> <br>
                  <?
                  } else {
                  ?>
                  <div class="col-md-4" style="margin-top: 20px;">
                    <div class="mb-4 d-flex justify-content-center">
                      <img id="selectedImage<?php echo $j; ?>" src="<? echo base_url('/assets/images/'.$j.'.png') ?>"
                      alt="example placeholder" style="width: 250px;" />
                    </div>
                    <div class="d-flex justify-content-center">
                      <input type="file" name="files[<?php echo $i; ?>]" accept=".jpg,.jpeg,.png" class="form-control d-none" id="customFile1" onchange="displaySelectedImage(event, 'selectedImage<?php echo $j; ?>')" />
                    </div>
                  </div>
                <?	
                  }
                  $j++; } 
                ?>
              </div>
            <?php }  else { ?>
            <div class="row">
              <div class="col-md-4">
                <div class="mb-4 d-flex justify-content-center">
                    <img id="selectedImage1" src="<? echo base_url('/assets/images/1.png') ?>"
                    alt="example placeholder" style="width: 250px;" />
                </div>
                <div class="d-flex justify-content-center">
                  <input type="file" name="files[]" accept=".jpg,.jpeg,.png" class="form-control d-none" id="customFile1" onchange="displaySelectedImage(event, 'selectedImage1')" />
                </div>
              </div>
              <div class="col-md-4">
                <div class="mb-4 d-flex justify-content-center">
                    <img id="selectedImage2" src="<? echo base_url('/assets/images/2.png') ?>"
                    alt="example placeholder" style="width: 250px;" />
                </div>
                <div class="d-flex justify-content-center">
                  <input type="file" name="files[]" accept=".jpg,.jpeg,.png" class="form-control d-none" id="customFile1" onchange="displaySelectedImage(event, 'selectedImage2')" />
                </div>
              </div>
              <div class="col-md-4">
                <div class="mb-4 d-flex justify-content-center">
                    <img id="selectedImage3" src="<? echo base_url('/assets/images/3.png') ?>"
                    alt="example placeholder" style="width: 250px;" />
                </div>
                <div class="d-flex justify-content-center">
                  <input type="file" name="files[]" accept=".jpg,.jpeg,.png" class="form-control d-none" id="customFile1" onchange="displaySelectedImage(event, 'selectedImage3')" />
                </div>
              </div>
            </div>
            <div class="row" style="margin-top: 20px;">
              <div class="col-md-4">
                <div class="mb-4 d-flex justify-content-center">
                    <img id="selectedImage4" src="<? echo base_url('/assets/images/4.png') ?>"
                    alt="example placeholder" style="width: 250px;" />
                </div>
                <div class="d-flex justify-content-center">
                  <input type="file" name="files[]" accept=".jpg,.jpeg,.png" class="form-control d-none" id="customFile1" onchange="displaySelectedImage(event, 'selectedImage4')" />
                </div>
              </div>
              <div class="col-md-4">
                <div class="mb-4 d-flex justify-content-center">
                    <img id="selectedImage5" src="<? echo base_url('/assets/images/5.png') ?>"
                    alt="example placeholder" style="width: 250px;" />
                </div>
                <div class="d-flex justify-content-center">
                  <input type="file" name="files[]" accept=".jpg,.jpeg,.png" class="form-control d-none" id="customFile1" onchange="displaySelectedImage(event, 'selectedImage5')" />
                </div>
              </div>
              <div class="col-md-4">
                <div class="mb-4 d-flex justify-content-center">
                    <img id="selectedImage6" src="<? echo base_url('/assets/images/6.png') ?>"
                    alt="example placeholder" style="width: 250px;" />
                </div>
                <div class="d-flex justify-content-center">
                  <input type="file" name="files[]" accept=".jpg,.jpeg,.png" class="form-control d-none" id="customFile1" onchange="displaySelectedImage(event, 'selectedImage6')" />
                </div>
              </div>
            </div>
            <div class="row" style="margin-top: 20px;">
              <div class="col-md-4">
                <div class="mb-4 d-flex justify-content-center">
                    <img id="selectedImage7" src="<? echo base_url('/assets/images/7.png') ?>"
                    alt="example placeholder" style="width: 250px;" />
                </div>
                <div class="d-flex justify-content-center">
                  <input type="file" name="files[]" accept=".jpg,.jpeg,.png" class="form-control d-none" id="customFile1" onchange="displaySelectedImage(event, 'selectedImage7')" />
                </div>
              </div>
              <div class="col-md-4">
                <div class="mb-4 d-flex justify-content-center">
                    <img id="selectedImage8" src="<? echo base_url('/assets/images/8.png') ?>"
                    alt="example placeholder" style="width: 250px;" />
                </div>
                <div class="d-flex justify-content-center">
                  <input type="file" name="files[]" accept=".jpg,.jpeg,.png" class="form-control d-none" id="customFile1" onchange="displaySelectedImage(event, 'selectedImage8')" />
                </div>
              </div>
              <div class="col-md-4">
                <div class="mb-4 d-flex justify-content-center">
                    <img id="selectedImage9" src="<? echo base_url('/assets/images/9.png') ?>"
                    alt="example placeholder" style="width: 250px;" />
                </div>
                <div class="d-flex justify-content-center">
                  <input type="file" name="files[]" accept=".jpg,.jpeg,.png" class="form-control d-none" id="customFile1" onchange="displaySelectedImage(event, 'selectedImage9')" />
                </div>
              </div>
            </div>
            <?php } ?>
			      <div class="form-group row" style="margin-top: 15px;">
              <div class="col-md-4">
                <label for="">Status</label>
              </div>
				      <div class="col-md-4">
                <?php
                $aktifcheck="";
                $nonaktifcheck="";
                if(!empty($results['dataProduct']->aktif)){
                  if($results['dataProduct']->aktif=='aktif'){
                    $aktifcheck="checked";
                  }else{
                    $nonaktifcheck="checked";
                  }
                }
                ?>
                <label>
                  <input type="radio" class="radio-control" id="statusa" name="status" value="aktif" <?=$aktifcheck?> required> Aktif
                </label>
                &nbsp &nbsp &nbsp
                <label>
                  <input type="radio" class="radio-control" id="statusn" name="status" value="nonaktif" <?=$nonaktifcheck?> required> Non Aktif
                </label>
				      </div>
			      </div>
          </div>
        </div>
      </div>
      <hr>
      <center>
        <button type="submit" class="btn btn-success btn-sm" name="save" id="simpan-com">
          <i class="fa fa-save"></i> Simpan </button>
      </center>
    </form>
  </div>
</div>

<script type="text/javascript">

// function numberWithCommas(elem, x) {
//   return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
// }

function displaySelectedImage(event, elementId) {
    const selectedImage = document.getElementById(elementId);
    const fileInput = event.target;

    if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            selectedImage.src = e.target.result;
        };

        reader.readAsDataURL(fileInput.files[0]);
    }
}

var nameproduct = "";
var nameproducttemp = "";
var nameproducttemp2 = "";
var nameproducttemp3 = "";
var nameproducttemp4 = "";
var nameproducttemp5 = "";

var skuproduct = "";
var skuproducttemp = "";
var skuproducttemp2 = "";
var skuproducttemp3 = "";
var skuproducttemp4 = "";
var skuproducttemp5 = "";

var base_url = '<?php echo base_url(); ?>';
var active_controller = '<?php echo $this->uri->segment(1); ?>';
$(document).ready(function() {
    $('#simpan-com').click(function(e) {
        e.preventDefault();
        var deskripsi = $('#deskripsi').val();
        var image = $('#image').val();
        var idtype = $('#inventory_4').val();
        var bentuk = $('.idbentuk').val();
        var data, xhr;
        swal({
            title: "Are you sure?",
            text: "You will not be able to process again this data!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, Process it!",
            cancelButtonText: "No, cancel process!",
            closeOnConfirm: true,
            closeOnCancel: false
        }, function(isConfirm) {
            if (isConfirm) {
                var formData = new FormData($('#data-form')[0]);
                var baseurl = siteurl + 'inventory_4/saveInventory';
                $.ajax({
                    url: baseurl,
                    type: "POST",
                    data: formData,
                    cache: false,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        if (data.status == 1) {
                            swal({
                                title: "Save Success!",
                                text: data.pesan,
                                type: "success",
                                timer: 7000,
                                showCancelButton: false,
                                showConfirmButton: false,
                                allowOutsideClick: false
                            });
							location.reload();
                        } else {
                            if (data.status == 2) {
                                swal({
                                    title: "Save Failed!",
                                    text: data.pesan,
                                    type: "warning",
                                    timer: 7000,
                                    showCancelButton: false,
                                    showConfirmButton: false,
                                    allowOutsideClick: false
                                });
                            } else {
                                swal({
                                    title: "Save Failed!",
                                    text: data.pesan,
                                    type: "warning",
                                    timer: 7000,
                                    showCancelButton: false,
                                    showConfirmButton: false,
                                    allowOutsideClick: false
                                });
                            }
                        }
                    },
                    error: function() {
                        swal({
                            title: "Error Message !",
                            text: 'An Error Occured During Process. Please try again..',
                            type: "warning",
                            timer: 7000,
                            showCancelButton: false,
                            showConfirmButton: false,
                            allowOutsideClick: false
                        });
                    }
                });
            } else {
                swal("Cancelled", "Data can be process again :)", "error");
                return false;
            }
        });
    });
});

function hasChecked(elem, posisi, selector) {
  if (elem.checked) {
    $("#" + selector).val(posisi);
  } else {
    $("#" + selector).val("");
  }
}

function get_varian1(elem) {
  var value = elem.value;
  var id = elem.options[elem.selectedIndex].getAttribute('data-id');
  $.ajax({
    url: "<?php echo base_url('inventory_4/get_varian1'); ?>",
    data: {
      id: id,
      value: value
    },
    method: "POST",
    success: function(result) {
      var html = "<select id='variasi_varian' name='variasi_varian' class='form-control'><option>Silahkan Pilih</option>";
      $.each(result.variasi, function(key, value) {
        html += "<option value='"+value.name+"'>'"+value.name+"</option>"
      });
      html += "</select>";
      $("#varian1").html(html);
    }
  });
}

function get_varian2(elem) {
  var value = elem.value;
  var id = elem.options[elem.selectedIndex].getAttribute('data-id');
  $.ajax({
    url: "<?php echo base_url('inventory_4/get_varian1'); ?>",
    data: {
      id: id,
      value: value
    },
    method: "POST",
    success: function(result) {
      var html = "<select id='variasi_varian' name='variasi_varian' class='form-control'><option>Silahkan Pilih</option>";
      $.each(result.variasi, function(key, value) {
        html += "<option value='"+value.name+"'>'"+value.name+"</option>"
      });
      html += "</select>";
      $("#varian2").html(html);
    }
  });
}

function get_inv2(id = null) {
  nameproduct = "";
  skuproduct = "";
  var text = $("#id_type").val();
  text = text.split("|");
  var id_type = text[0].trim();
  var idname = text[1].trim();
  var skucode = text[2].trim();
  nameproduct += idname;
  nameproducttemp = nameproduct;
  skuproduct += skucode;
  skuproducttemp = skuproduct;
  $.ajax({
      type: "GET",
      url: siteurl + 'inventory_4/get_inven2',
      data: "inventory_1=" + id_type,
      success: function(html) {
        $("#id_category1").html(html);
        if (id == null) {
          $("#nama").val(nameproduct);
          $("#sku_induk").val(skuproduct);
          $("#sku_varian").val(skuproduct);
        }
      }
  });
}

function get_inv3(id = null) {
  var brandcategorynametext = "";
  var textidtype = $("#id_type").val();
  textidtype = textidtype.split("|");
  var id_type = textidtype[0].trim();
  var textcategory = $("#id_category1").val();
  textcategory = textcategory.split("|");
  var id_category1 = textcategory[0].trim();
  var categoryname = textcategory[1].trim();
  var skucode = textcategory[2].trim();
  brandcategorynametext = categoryname;
  nameproduct = nameproducttemp + " " + brandcategorynametext;
  nameproducttemp2 = nameproduct;
  skuproduct += skucode;
  skuproducttemp2 = skuproduct;
  $.ajax({
      type: "GET",
      url: siteurl + 'inventory_4/get_inven3',
      data:"id_type="+id_type+"&inventory_2="+id_category1,
      success: function(result) {
        if (result.code == 200) {
          $("#id_category2").html(result.data.htmllevel3);
          // $("#varian").html(result.data.htmldatacomposition);
          if (id == null) {
            $("#nama").val(nameproduct);
            $("#sku_induk").val(skuproduct);
            $("#sku_varian").val(skuproduct);
          }
        }
      }
  });
}

function get_inv4(id = null) {
  var typecategorynametext = "";
  var textcategory = $("#id_category2").val();
  textcategory = textcategory.split("|");
  var id_category1 = textcategory[0].trim();
  var texttypecategorytext = textcategory[1].trim();
  var skucode = textcategory[2].trim();
  typecategorynametext = texttypecategorytext;
  nameproduct = nameproducttemp2 + " " + typecategorynametext;
  nameproducttemp3 = nameproduct;
  skuproduct += skucode;
  skuproducttemp3 = skuproduct;
  if (id == null) {
    $("#nama").val(nameproduct);
    $("#sku_induk").val(skuproduct);
    $("#sku_varian").val(skuproduct);
  } 
}

function get_inv5(id = null) {
  var typeposisibautnametext = "";
  var typeposisi = $("#varian1").val();
  typeposisi = typeposisi.split("|");
  var skucode = typeposisi[0].trim();
  var textposisi = typeposisi[1].trim();
  nameproduct = nameproducttemp3 + " " + textposisi;
  nameproducttemp4 = nameproduct;
  skuproduct += skucode;
  skuproducttemp4 = skuproduct;
  if (id == null) {
    $("#nama").val(nameproduct);
    $("#sku_induk").val(skuproduct);
    $("#sku_varian").val(skuproduct);
  } 
}

function get_inv6(id = null) {
  var typebagianbautnametext = "";
  var typebagian = $("#varian2").val();
  typebagian = typebagian.split("|");
  var skucode = typebagian[0].trim();
  var textposisi = typebagian[1].trim();
  nameproduct = nameproducttemp4 + " " + textposisi;
  nameproducttemp5 = nameproduct;
  skuproduct += skucode;
  skuproducttemp5 = skuproduct;
  if (id == null) {
    $("#nama").val(nameproduct);
    // $("#sku_induk").val(skuproduct);
    $("#sku_varian").val(skuproduct);
  } 
}

</script>
