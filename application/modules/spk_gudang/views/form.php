
<div class="modal-header" style="border-top-right-radius: 30px; border-top-left-radius: 30px">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title" id="myModalLabel"><span class="fa fa-pencil"></span>&nbsp;Data Order untuk SPK Gudang</h4>
</div>

<style>
    #modal-view-detail {
        display: none;
        width: 130px;
        padding: 10px;
        font-size: .75em;
        text-align: left;
        background-color: inherit;
        border-radius: 10px;
        position: absolute;
        top: 200%;
        left: 50%;
        margin-left: -75px;
        margin-top: 10px; 
        z-index: 999;
    }

    /* .modal-view-detail div:before {
        content: '';
        display: block;
        width: 0;
        height: 0;
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        border-bottom: 11px solid #999999;
        position: absolute;
        top: -10px;
        left: 50%;
        margin-left: -10px;
    }  */
</style>

<div class="modal-body" id="MyModalBody-edit">
    <h4>SPK Gudang</h4>
    <table id="example1" class="table table-bordered table-striped" width='100%'>
        <thead>
            <tr>
                <th class="text-center">No. Order</th>
                <th class="text-center">Customer</th>
                <th class="text-center">Marketplace</th>
                <th class="text-center">Produk</th>
                <th class="text-center">Total Harga</th>
                <th class="text-center">Jasa Pengiriman</th>
                <th class="text-center">Estimasi Tanggal Pengiriman</th>
                <th class="text-center">Action</th>
                <th class="text-center">Checklist SPK</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($results['dataOrder'] AS $data) { ?>
            <tr>
                <td><?= $data['code_order'] ?></td>
                <td><?= $data['customer_name'] ?></td>
                <td><?= $data['code_order_marketplace'] ?></td>
                <td>
                    <ul>
                        <li>Nama Produk: <?= $data['detail']['product_name'] ?></li>
                        <li>Harga Produk: Rp. <?= number_format($data['detail']['price']) ?></li>
                        <li>Qty Produk: <?= $data['detail']['qty'] ?></li>
                        <li>Total Harga : Rp. <?= number_format($data['detail']['total_price']) ?></li>
                    </ul>
                </td>
                <td>Rp. <?= number_format($data['total_price']) ?></td>
                <td><?= $data['delivery_name'] ?></td>
                <td>
                    <?php
                        $date = new DateTime($data['delivery_date']);
                        echo $date->format("d-m-Y");
                    ?>
                </td>
                <td>
                    <button type="button" class="btn btn-success button-view-detail" aria-hidden="false">
                        View Detail
                    </button>
                    <div id="modal-view-detail">
                        <div>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th>Qty</th>
                                        <th>Lokasi Barang</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                       <td><?= $data['detail']['product_name'] ?></td>
                                       <td><?= $data['detail']['qty'] ?></td>
                                       <td>Line 01</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </td>
                <td>
                    <input type="checkbox" id="check_order" name="order_row[]" value="<?= $data['code_order'] ?>" /><label for="">&nbsp; Check</label>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<div class="modal-footer" style="border-bottom-right-radius: 30px; border-bottom-left-radius: 30px">
    <button type="button"  class="btn btn-info" id="save-create-spk" data-dismiss="modal">
        <span class="glyphicon glyphicon-check"></span>  Create SPK
    </button>
    <button type="button"  class="btn btn-default" data-dismiss="modal">
        <span class="glyphicon glyphicon-remove"></span>  Close
    </button>
</div>

<script>

    $(".button-view-detail").click(function() {
        $("#modal-view-detail").show()
    });

    $(document).on('click', '#save-create-spk', function() {
        var check_order = $("input[name='order_row[]']").map(function() {
            if ($(this).is(":checked")) {
                return $(this).val();
            } 
        }).get();
        
        $.ajax({
            url: siteurl + active_controller + 'saveGudangSPK',
            data: {
                check_order: check_order
            },
            method: "POST",
            success: function(result) {
                console.log(result);
            }
        });
    });

</script>
		