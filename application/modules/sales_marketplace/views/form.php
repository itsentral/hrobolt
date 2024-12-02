
<div class="modal-header" style="border-top-right-radius: 30px; border-top-left-radius: 30px">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <h4 class="modal-title" id="myModalLabel"><span class="fa fa-pencil"></span>&nbsp;Data Order untuk SPK Gudang</h4>
</div>
<div class="modal-body" id="MyModalBody-edit">
    <h4>SPK Gudang</h4>
    <table id="example1" class="table table-bordered table-striped" width='100%'>
        <thead>
            <tr>
                <th class="text-center">No. SPK</th>
                <th class="text-center">Kode Order</th>
                <th class="text-center">Nama Produk</th>
                <th class="text-center">Qty Produk</th>
                <th class="text-center">Status</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
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
    function calculateTotalPrice(elem) {
        var value = elem.value;
        var price = $("#product_price").val();
        var total = value * price;
        $("#total_price_edit").val(total);
    }

    $(document).on('click', '#save-edit', function() {
        var nomor_order_marketplace = $("#edit_nomor_order_marketplace").val();
        var customer_name = $("#edit_customer_name").val();
        var tanggal_pengiriman = $("#edit_tanggal_pengiriman").val();
        var qty = $("#edit_qty").val();
        var pengiriman = $("#edit_pengiriman").val();
        var marketplace = $("#edit_marketplace").val();
        var total_price = $("#total_price_edit").val();
        var code_order_detail_id = $("#code_order_detail_id").val();

        var code_order = $("#code_order").val();
        // alert(pengiriman);
        $.ajax({
            method: "POST",
            data: {
                nomor_order_marketplace: nomor_order_marketplace,
                customer_name: customer_name,
                marketplace: marketplace,
                tanggal_pengiriman: tanggal_pengiriman,
                qty: qty,
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
		