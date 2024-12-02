<?php
    $ENABLE_ADD     = has_permission('SPK_Gudang.Add');
    $ENABLE_MANAGE  = has_permission('SPK_Gudang.Manage');
    $ENABLE_VIEW    = has_permission('SPK_Gudang.View');
    $ENABLE_DELETE  = has_permission('SPK_Gudang.Delete');
?>

<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.css') ?>">

<div class="box">
    <!-- <ul class="nav nav-pills nav-justified">
        <li role="presentation" class="active"><a href="#marketplace" data-toggle="tab">Marketplace</a></li>
        <li role="presentation"><a href="#b2b" data-toggle="tab">B2B</a></li>
    </ul> -->

    <div class="tab-content">
        <div id="marketplace" class="tabe-pane fade in active">
            <div class="box-header">
                <h4>Data Order Marketplace yang siap di Buatkan SPK</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered table-striped" width='100%'>
                        <thead>
                            <tr>
                                <th class="text-center" width="50px">Nomor Order</th>
                                <th class="text-center" width="50px">Nomor Order Marketplace</th>
                                <th class="text-center">Nama Customer</th>
                                <th class="text-center">Tanggal  Pengiriman</th>
                                <th class="text-center" width="200px">Product</th>
                                <th class="text-center">SKU Code</th>
                                <th class="text-center">Qty</th>
                                <th class="text-center">Jasa Pengiriman</th>
                                <th class="text-center">Total Price</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($results['dataOrder']) { ?>
                                <?php foreach($results['dataOrder'] AS $data) { ?>
                                <tr>
                                    <td><?= $data['code_order'] ?></td>
                                    <td><?= $data['code_order_marketplace'] ?></td>
                                    <td><?= $data['customer_name'] ?></td>
                                    <td>
                                        <?php
                                            $date = new DateTime($data['delivery_date']);
                                            echo $date->format("d-m-Y");
                                        ?>
                                    </td>
                                    <td>
                                        <ul>
                                            <?php foreach($data['detail'] AS $detail) { ?>
                                            <li>
                                                Nama Produk: <?= $detail['product_name'] ?> <br>
                                                Harga Produk: Rp. <?= number_format($detail['price']) ?> <br>
                                                Total Harga : Rp. <?= number_format($detail['total_price'] - $data['another_price']) ?>
                                            </li>
                                            <?php } ?>
                                        </ul>
                                    </td>
                                    <td>
                                        <ul>
                                            <?php foreach($data['detail'] AS $detail) { ?>
                                            <li><?= $detail['sku_varian'] ?></li>
                                            <?php } ?>
                                        </ul>
                                    </td>
                                    <td>
                                        <ul>
                                            <?php foreach($data['detail'] AS $detail) { ?>
                                            <li><?= $detail['qty'] ?></li>
                                            <?php } ?>
                                        </ul>
                                    </td>
                                    <td><?= $data['delivery_name'] ?></td>
                                    <?php 
                                        $priceProduct = ($data['total_price'] * 11/100) + $data['total_price'];
                                    ?>
                                    <td>Rp. <?= number_format(($priceProduct - $data['another_price']), 2, ",", ".") ?></td>
                                    <!-- <td>
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
                                    </td> -->
                                    <td>
                                        <input type="checkbox" id="check_order" name="order_row[]" value="<?= $data['code_order'] ?>" /><label for="">&nbsp; Check</label>
                                    </td>
                                </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="9" style="text-align: center;">Data Tidak Tersedia</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="box-footer">
                <center>
                    <button class="btn btn-success" id="save-create-spk">Buat SPK</button>
                </center>
            </div>
        <hr>
            <div class="box-header">
                <h4>Data SPK yang telah Tersedia</h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table id="datatable2" class="table table-bordered table-striped" width='100%'>
                        <thead>
                            <tr>
                                <th class="text-center">No. SPK</th>
                                <th class="text-center">Tanggal SPK</th>
                                <!-- <th class="text-center">Produk</th>
                                <th class="text-center">Total Qty Produk</th> -->
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($results['dataSPK'] AS $data) { ?>
                            <tr>
                                <td><?= $data['code_spk'] ?></td>
                                <td><?= $data['created_at'] ?></td>
                                <td><p class="label label-info"><?= $data['status'] ?></p></td>
                                <td>
                                    <?php if ($data['status_print'] == 'Sudah Print') { ?>
                                        <p class="label label-success">Process Packing</p>
                                        <a href="<?php echo site_url($this->uri->segment(1)) . '/printSPK/' . $data['code_spk'] ?>" class="btn btn-sm btn-info" title="Print SPK" target="_blank"><i class="fa fa-download"></i></a>
                                        <br />
                                        <?php  echo $data['status_print'] . ' : ' . $data['count_print'] . ' Kali'; ?>
                                    <?php } else { ?>
                                        <a href="<?php echo site_url($this->uri->segment(1)) . '/printSPK/' . $data['code_spk'] ?>" class="btn btn-sm btn-info" title="Print SPK" target="_blank"><i class="fa fa-download"></i></a>
                                        <br />
                                        <?php  echo $data['status_print'] . ' : ' . $data['count_print'] . ' Kali'; ?>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="b2b" class="tabe-pane fade">

        </div>
    </div>
</div>

<div class="modal modal-default fade" id="dialog-popup" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" style='width:90%; '>
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Default</h4>
			</div>
			<div class="modal-body" id="ModalView">
				...
			</div>
		</div>
	</div>
</div>

<div class="modal modal-default fade" id="modal-add-spk" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" style='width:90%; '>
		<div class="modal-content" id="mymodalcontent-addspk">
            
		</div>
	</div>
</div>

<!-- DataTables -->
<script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>

<!-- page script -->
<script type="text/javascript">
    
    $("#datatable").DataTable({
        order: [[1, 'desc']]
    });

    $("#datatable2").DataTable({
        order: [[1, 'desc']]
    });
    // $(document).on('click', '.add-spk', function() {
    //     $.ajax({
    //         type: 'GET',
    //         url: base_url + active_controller + '/formSPKGudang',
    //         success: function(data) {
    //             console.log(data);
    //             $("#modal-add-spk").modal();
    //             $("#mymodalcontent-addspk").html(data);
    //         }
    //     })
    // });

    // $(document).on('click', '.detail', function() {
    //     var so_number = $(this).data('so_number');
    //     // alert(id);
    //     $("#head_title").html("<b>Detail>");
    //     $.ajax({
    //         type: 'POST',
    //         url: base_url + active_controller + 'detail',
    //         data: {
    //             'so_number': so_number,
    //         },
    //         success: function(data) {
    //             $("#dialog-popup").modal();
    //             $("#ModalView").html(data);

    //         }
    //     })
    // });

    $(document).on('click', '#save-create-spk', function() {
        var check_order = $("input[name='order_row[]']").map(function() {
            if ($(this).is(":checked")) {
                return $(this).val();
            } 
        }).get();

        if (check_order.length == 0) {
            return alert("Silahkan Check List Item Terlebih Dahulu")
        }
        
        $.ajax({
            url: siteurl + active_controller + 'saveGudangSPK',
            data: {
                check_order: check_order
            },
            method: "POST",
            success: function(result) {
                // console.log(result);
                window.location.reload();
            }
        });
    });
</script>