
<div class="modal-header" style="border-top-right-radius: 30px; border-top-left-radius: 30px">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title" id="myModalLabel"><span class="fa fa-pencil"></span>&nbsp;Edit Data Order Marketplace <?= $results['detailProduct']->code_order ?></h4>
</div>
<div class="modal-body" id="MyModalBody-edit">
    <input type="hidden" value="<?= $results['detailProduct']->code_order ?>" id="code_order">
    <input type="hidden" value="<?= $results['detailProduct']->id ?>" id="code_order_detail_id">
    <h4>Header Order</h4>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Nomor Order Marketplace</label>
                <input type="text" name="nomor_order_marketplace" id="edit_nomor_order_marketplace" value="<?= $results['detailProduct']->code_order_marketplace ?>" class="form-control">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Nama Pelanggan</label>
                <input type="text" name="customer_name" id="edit_customer_name" value="<?= $results['detailProduct']->customer_name ?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Marketplace</label>
                <select name="marketplace" id="edit_marketplace" class="form-control">
                    <option value="">Silahkan Pilih</option>
                    <?php foreach($results['dataMarketplace'] AS $marketplace) { ?>
                        <option value="<?= $marketplace->name ?>" <?= ($marketplace->name == $results['detailProduct']->marketplace) ? 'selected' : '' ?>><?= $marketplace->name ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
    <hr>
    <h4>Informasi Produk - <button class="btn btn-success btn-update-data-order" data-code="<?= $results['detailProduct']->code_order ?>">Update Data</button></h4>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Nama Product</label>
                <input type="text" name="product_name" id="product_name" value="<?= $results['detailProduct']->product_name ?>" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label>Deskripsi Product</label>
                <input type="text" name="product_description" id="product_description" value="<?= $results['detailProduct']->product_description ?>" class="form-control" readonly>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Harga Product</label>
                <input type="text" name="product_price" id="product_price" value="<?= $results['detailProduct']->product_price ?>" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label>SKU</label>
                <input type="text" name="sku" id="product_sku" onchange="return searchDataProductBySKU(this.value)" value="<?= $results['detailProduct']->sku ?>" class="form-control" readonly>
            </div>
        </div>
    </div>
    <hr>
    <h4>Detail Order</h4>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Tanggal Pengiriman</label>
                <input type="date" name="tanggal_pengiriman" value="<?php echo date($results['detailProduct']->delivery_date); ?>" id="edit_tanggal_pengiriman" class="form-control">
            </div>
            <div class="form-group">
                <label>Qty</label>
                <input type="number" value="<?= $results['detailProduct']->qty ?>" onkeyup="calculateTotalPrice(this);" name="qty" id="edit_qty" class="form-control">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Jasa Pengiriman</label>
                <select name="pengiriman" id="edit_pengiriman" class="form-control">
                    <option value="">Silahkan Pilih</option>
                    <?php foreach($results['dataPengiriman'] AS $pengiriman) { ?>
                    <option value="<?= $pengiriman->id ?>" <?= ($pengiriman->id == $results['detailProduct']->delivery_id) ? 'selected' : '' ?>><?= $pengiriman->name ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label>Total Harga</label>
                <input type="text" readonly name="total_price_edit" id="total_price_edit" value="<?= $results['detailProduct']->total_price ?>" class="form-control">
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="">Gambar Produk</label>
        <img id="gambar-produk" src="<?= base_url($results['detailProduct']->fhoto_url) ?>" width="300px" height="200px" />
    </div>
</div>
<div class="modal-footer" style="border-bottom-right-radius: 30px; border-bottom-left-radius: 30px">
    <button type="button"  class="btn btn-info" id="save-edit" data-dismiss="modal">
        <span class="glyphicon glyphicon-check"></span>  Simpan
    </button>
    <button type="button"  class="btn btn-default" data-dismiss="modal">
        <span class="glyphicon glyphicon-remove"></span>  Close
    </button>
</div>

<script>
    function searchDataProductBySKU(value) {
        $.ajax({
            url: siteurl + active_controller + 'searchDataProductBySKU',
            data: {
                sku: value
            },
            method: "POST",
            success: function(result) {
                if (result.code == 200) {
                    $("#product_name").val(result.data.nama)
                    $("#product_description").val(result.data.deskripsi)
                    $("#product_price").val(result.data.price)

                    var qty = $("#edit_qty").val()
                    var resultPrice = qty * result.data.price

                    $("#total_price_edit").val(resultPrice);
                }
            }
        })
    }

    function calculateTotalPrice(elem) {
        var value = elem.value;
        var price = $("#product_price").val();
        var total = value * price;
        $("#total_price_edit").val(total);
    }

    $(document).on('click', '.btn-update-data-order', function() {
        $("#product_sku").attr("readonly", false);
        $.ajax({
            url: siteurl + active_controller + 'searchProductBySKU',
            method: "POST",
            success: function(result) {
                if (result.code == 200) {
                    var suggestions = [];
                    $.each(result.data, function (key, value) {
                        suggestions.push(
                            {
                                id: value.sku_varian,
                                text: value.sku_varian
                            }
                        );
                    });

                    $("#product_sku").select2({
                        data: suggestions
                    });
                }
            }
        })
    })

    $(document).on('click', '#save-edit', function() {
        var nomor_order_marketplace = $("#edit_nomor_order_marketplace").val();
        var customer_name = $("#edit_customer_name").val();
        var tanggal_pengiriman = $("#edit_tanggal_pengiriman").val();
        var qty = $("#edit_qty").val();
        var sku = $("#product_sku").val();
        var pengiriman = $("#edit_pengiriman").val();
        var marketplace = $("#edit_marketplace").val();
        var total_price = $("#total_price_edit").val();
        var code_order_detail_id = $("#code_order_detail_id").val();

        var code_order = $("#code_order").val();
        $.ajax({
            method: "POST",
            data: {
                nomor_order_marketplace: nomor_order_marketplace,
                customer_name: customer_name,
                marketplace: marketplace,
                tanggal_pengiriman: tanggal_pengiriman,
                qty: qty,
                sku: sku,
                pengiriman: pengiriman,
                code_order: code_order,
                total_price: total_price,
                code_order_detail_id: code_order_detail_id
            },
            url: siteurl + active_controller + 'saveEditOrder',
            success:function(result){
                if(result.status == 1){
                    swal({
                        title: "Sukses",
                        text : result.pesan,
                        type : "success"
                    },
                    function (){
                        window.location.reload(true);
                    })
                } else {
                    swal({
                        title : "Error",
                        text  : result.pesan,
                        type  : "error"
                    })
                }
            },
        })
    })

</script>
		