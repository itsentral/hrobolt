<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.css') ?>">

<div class="box box-primary">
    <div class="box-body">
        <div class="container-fluid" style="height: 500px; min-height: 100%;">
            <div class="row">
                <div class="col-md-12">
                    <div style="border: 2px solid lightblue; margin: 5px; padding: 5px; border-radius: 20px;">
                        <div style="padding: 5px; display: flex; justify-content: space-between; align-items: center;">
                            <h4 style="font-weight: 700;">Order API</h4>
                            <i class="fa fa-money" style="font-size: 22px; padding: 5px; border: 2px solid; border-radius: 50%;"></i>
                        </div>
                        <hr>
                        <!-- <ol>
                            <li>Ambil Seluruh Order dengan Menekan Button Get Order All.</li>
                            <li>Kemudian Data Akan Muncul di Table.</li>
                            <li>Lalu, lakukan checklist terhadap Code Order dari Shopee untuk diambil data detailnya dengan menekan Button Get Order Detail.</li>
                        </ol> -->
                        <?php
                        $form_data = $this->session->userdata('form_data');
                        ?>
                        <div class="row" style="padding: 10px;">
                            <div class="col-md-4">
                                <h4>Rentang Tanggal hanya untuk 15 Hari</h4>
                                <form method="POST" action="<?= base_url('API/getOrderList') ?>">
                                    <div class="form-group">
                                        <label for="">Tanggal Order Mulai</label>
                                        <input type="date" class="form-control" id="date_form" name="date_form" value="<?php echo isset($form_data['date_form']) ? $form_data['date_form'] : ''; ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label for="">Tanggal Order Selesai</label>
                                        <input type="date" class="form-control" id="date_to" name="date_to" value="<?php echo isset($form_data['date_to']) ? $form_data['date_to'] : ''; ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label for="">Status Order</label>
                                        <select class="form-control" id="status_order" name="status_order">
                                            <option>Silahkan Pilih</option>
                                            <option value="UNPAID" <?php if($form_data['status_order'] == 'UNPAID' ){ echo "selected"; } ?> >UNPAID</option>
                                            <option value="READY_TO_SHIP" <?php if($form_data['status_order'] == 'READY_TO_SHIP' ){ echo "selected"; } ?> >READY_TO_SHIP</option>
                                            <option value="PROCESSED" <?php if($form_data['status_order'] == 'PROCESSED' ){ echo "selected"; } ?> >PROCESSED</option>
                                            <option value="SHIPPED" <?php if($form_data['status_order'] == 'SHIPPED' ){ echo "selected"; } ?> >SHIPPED</option>
                                            <option value="COMPLETED" <?php if($form_data['status_order'] == 'COMPLETED' ){ echo "selected"; } ?> >COMPLETED</option>
                                            <option value="IN_CANCEL" <?php if($form_data['status_order'] == 'IN_CANCEL' ){ echo "selected"; } ?> >IN_CANCEL</option>
                                            <option value="CANCELLED" <?php if($form_data['status_order'] == 'CANCELLED' ){ echo "selected"; } ?> >CANCELLED</option>
                                        </select>
                                    </div>

                                    <button type="submit" style="margin: 10px; border-radius: 5px;" class="btn btn-info">Get All Order</button>
                                </form>
                            </div>
                            <form action="<?= base_url('API/getOrderListDetail') ?>" method="POST">
                            <div class="col-md-8">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Code Order</th>
                                            <th>Date Order</th>
                                            <th>Status Order</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody-all-order">
                                        <?php 
                                            foreach($results['orders'] AS $key => $order) {
                                                if($order->status == 0 )
                                                {
                                                    $Status = "<span class='badge bg-grey'>Draft</span>";
                                                }
                                                elseif($order->status == 1 )
                                                {
                                                    $Status = "<span class='badge bg-yellow'>Menunggu Approval</span>";
                                                }
                                                elseif($order->status == 2 )
                                                {
                                                    $Status = "<span class='badge bg-green'>Approved</span>";
                                                }
                                                elseif($order->status == 3 )
                                                {
                                                    $Status = "<span class='badge bg-blue'>Dicetak</span>";
                                                }
                                                elseif($order->status == 4 )
                                                {
                                                    $Status = "<span class='badge bg-green'>Terkirim</span>";
                                                }
                                                elseif($order->status == 5 )
                                                {
                                                    $Status = "<span class='badge bg-red'>Not Approved</span>";
                                                }
                                                elseif($order->status == 6 )
                                                {
                                                    $Status = "<span class='badge bg-green'>SO</span>";
                                                }
                                                elseif($order->status == 7 )
                                                {
                                                    $Status = "<span class='badge bg-red'>Loss</span>";
                                                }
                                        ?>
                                            <tr>
                                                <td><input type="checkbox" value="<?= $order->code_order_marketplace ?>" name="code_order[]"></td>
                                                <td><?= $order->code_order_marketplace ?></td>
                                                <td><?= $order->delivery_date ?></td>
                                                <td><?= $Status ?></td>
                                            </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row" style="padding: 10px;">
                            <div class="col-md-4">
                                
                            </div>
                            <div class="col-md-8">
                                <button class="btn btn-success" type="submit">Get Order Detail</button>
                            </div>
                            </form>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="col-md-12">
                            <div style="border: 2px solid lightblue; margin: 5px; padding: 5px; border-radius: 20px;">
                                <div style="padding: 5px; display: flex; justify-content: space-between; align-items: center;">
                                    <h4 style="font-weight: 700;">Order Delivery Label API</h4>
                                    <i class="fa fa-money" style="font-size: 22px; padding: 5px; border: 2px solid; border-radius: 50%;"></i>
                                </div>
                                <hr>
                                <ol>
                                    <li>Pilih Order yang Akan di Ambil Label Pengirimannya.</li>
                                </ol>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Code Order</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody-all-order">
                                        <?php 
                                            foreach($results['orderdeliveries'] AS $key => $orderdelivery) {
                                        ?>
                                            <tr>
                                                <td><?= $orderdelivery->code_order_marketplace ?></td>
                                                <td>
                                                    <form action="<?= base_url('API/createShippingDocument/' . $orderdelivery->code_order_marketplace) ?>" method="POST">
                                                        <button class="btn btn-info" data-id="<?= $orderdelivery->code_order_marketplace ?>">Get Document</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div style="border: 2px solid lightblue; margin: 5px; padding: 5px; border-radius: 20px;">
                        <div style="padding: 5px; display: flex; justify-content: space-between; align-items: center;">
                            <h4 style="font-weight: 700;">Product API</h4>
                            <i class="fa fa-cubes" style="font-size: 22px; padding: 5px; border: 2px solid; border-radius: 50%;"></i>
                        </div>
                        <hr>
                        <!-- <ol>
                            <li>Ambil Seluruh Product Parent dengan Menekan Button Get Product Parent.</li>
                            <li>Kemudian Data Akan Muncul di Table.</li>
                            <li>Lalu, lakukan pengambilan Product Detail dengan mengclick Button get Product Detail di setiap row dari Data Product Parent.</li>
                        </ol> -->
                        <div class="row" style="padding: 10px;">
                            <div class="col-md-12">
                                <form action="<?= base_url('API/getDataProduct') ?>" style="margin-bottom: 10px" method="POST">
                                    <button class="btn btn-primary">Update Data</button>
                                </form>
                                <table id="datatable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Item Id / Model Name</th>
                                            <th>SKU Product</th>
                                            <th>Stok Shopee</th>
                                            <th>Stok ERP</th>
                                            <!-- <th>Aksi</th> -->
                                        </tr>
                                    </thead>
                                    <tbody id="tbody-parent-product">
                                        <?php 
                                            foreach($results['products'] AS $key => $product) {
                                        ?>
                                        <tr>
                                            <td><?= ++$key ?></td>
                                            <td>
                                                <?php if($product->parent_id == null) { ?>
                                                    <?= $product->item_id ?>    
                                                <?php } else { ?>
                                                    <?= $product->parent_id ?>
                                                <?php } ?>
                                                <br>
                                                <?php echo $product->model_name ?>
                                            </td>
                                            <td><?= $product->sku_product ?></td>
                                            <td><?= $product->stok ?></td>
                                            <td><?= $product->qty_erp ?></td>
                                            <!-- <td>
                                                <form action="<?= base_url('API/getDataProductDetail/' . $product->item_id) ?>" method="POST">
                                                    <button class="btn btn-info" data-id="<?= $product->item_id ?>">Get Detail Product</button>
                                                </form>
                                            </td> -->
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 

<!-- DataTables -->
<script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>

<script type="text/javascript">
    
    $("#datatable").DataTable();

</script>