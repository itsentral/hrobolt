<html>

    <head>

        <title>SPK Code : <?php echo $codeSPK ?></title>
        <style>
        @media print {
                /* All your print styles go here */
                #btn-print {
                    display: none !important;
                }

                #btn-pemberi {
                    display: none !important;
                }

                #btn-diketahui {
                    display: none !important;
                }

                #btn-penerima {
                    display: none !important;
                }

                #btn-clear-pemberi {
                    display: none !important;
                }

                #btn-clear-diketahui {
                    display: none !important;
                }

                #btn-clear-penerima {
                    display: none !important;
                }
            }
        </style>
    </head>

    <br><br><br>
    <button id="btn-print">Print</button>

    <center><h4>SPK Mengambil Barang</h4></center>
    <div style="display: flex; justify-content: space-between;">
        <h4>SPK Kode <?php echo $codeSPK ?></h4>
        <h3>HIRO BOLT</h3>
    </div>
    <!-- <div>
        <img src="<?= base_url('assets/temp/'. $barcode) ?>" width="100px" height="100px" alt="image" />
    </div> -->
    <hr>
    <table style="border: 1px solid black; border-radius: 25px; width: 100%; padding: 10px;">
        <thead>
            <tr>
                <th align="left" width="100">Kode Order</th>
                <th align="left" colspan="5">Data</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach ($dataOrder['detail'] AS $key => $details) {
            ?> 
            <tr>
                <td>
                    <?= $key ?>
                </td>
                <td>
                    <table>
                        <thead>
                            <tr>
                                <th align="left" width="500">Nama Produk</th>
                                <th align="left" width="200">Nomor Rak</th>
                                <th align="left" width="200">Kode Order Marketplace</th>
                                <th align="left" width="90">SKU</th>
                                <th align="left" width="90">Qty</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                    foreach ($details AS $detail) {    
                            ?>
                                    <tr>
                                        <td><?= $detail['product_name'] ?></td>
                                        <td><?= $detail['rak'] ?></td>
                                        <td><?= $detail['code_order_marketplace'] ?></td>
                                        <td><?= $detail['sku_varian'] ?></td>
                                        <td><?= $detail['qty'] ?></td>
                                    </tr>
                            <?php          
                                    }
                            ?>
                        </tbody>
                    </table>
                </td>
            </tr>
            <?php
                } 
            ?>
        </tbody>
    </table>

    <div style="display: flex; justify-content:space-evenly;">
        <div style="display: block;">
            <strong><p>Pemberi SPK,</p></strong>
            <div style="display: flex;">
                <canvas id="canvas-pemberi" style="width: 250px; height: 150px">

                </canvas>
                <button id="btn-clear-pemberi" onclick="return clearSignPemberi()">Clear Signature</button>
            </div>
            <div style="display: flex;">
                <input type="text" onkeydown="return addNamePemberi(this, 'name_pemberi', 'text_pemberi')" id="name_pemberi" placeholder="Nama Pemberi SPK" />
                <p id="text_pemberi" style="display: none;"></p>
                <button id="btn-pemberi" onclick="return showInputTypePenerima('name_pemberi', 'text_pemberi')">Edit</button>
            </div>
            <hr style="margin-bottom: -10px">
        </div>
        <div style="display: block; margin-top:70px;">
            <strong><p>Diketahui,</p></strong>
            <div style="display: flex;">
                <canvas id="canvas-diketahui" style="width: 250px; height: 150px">

                </canvas>
                <button id="btn-clear-diketahui" onclick="return clearSignDiketahui()">Clear Signature</button>
            </div>
            <div style="display: flex;">
                <input type="text" onkeydown="return addNameDiketahui(this, 'name_diketahui', 'text_diketahui')" id="name_diketahui" placeholder="Nama Diketahui" />
                <p id="text_diketahui" style="display: none;"></p>
                <button id="btn-diketahui" onclick="return showInputTypePenerima('name_diketahui', 'text_diketahui')">Edit</button>
            </div>
            <hr style="margin-bottom: -10px">
        </div>
        <div style="display: block;">
            <strong><p>Penerima SPK,</p></strong>
            <div style="display: flex;">
                <canvas id="canvas-penerima" style="width: 250px; height: 150px">

                </canvas>
                <button id="btn-clear-penerima" onclick="return clearSignPenerima()">Clear Signature</button>
            </div>
            <div style="display: flex;">
                <input type="text" onkeydown="return addNamePenerima(this, 'name_penerima', 'text_penerima')" id="name_penerima" placeholder="Nama Penerima SPK" />
                <p id="text_penerima" style="display: none;"></p>
                <button id="btn-penerima" onclick="return showInputTypePenerima('name_penerima', 'text_penerima')">Edit</button>
            </div>
            <hr style="margin-bottom: -10px">
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>

    <script>
        const canvasPemberi = document.getElementById("canvas-pemberi");
        const canvasDiketahui = document.getElementById("canvas-diketahui");
        const canvasPenerima = document.getElementById("canvas-penerima");

        const signaturePadPemberi = new SignaturePad(canvasPemberi);
        const signaturePadDiketahui = new SignaturePad(canvasDiketahui);
        const signaturePadPenerima = new SignaturePad(canvasPenerima);

        function clearSignPenerima() {
            signaturePadPenerima.clear();
        }

        function clearSignPemberi() {
            signaturePadPemberi.clear();
        }

        function clearSignDiketahui() {
            signaturePadDiketahui.clear();
        }

        function showInputTypePenerima(idfield, idtext) {
            document.getElementById(idtext).style.display = "none";
            document.getElementById(idfield).style.display = "block";
        }

        function showInputTypePenerima(idfield, idtext) {
            document.getElementById(idtext).style.display = "none";
            document.getElementById(idfield).style.display = "block";
        }

        function showInputTypePenerima(idfield, idtext) {
            document.getElementById(idtext).style.display = "none";
            document.getElementById(idfield).style.display = "block";
        }

        function addNamePemberi(elem, idfield, idtext) {
            if (event.keyCode == 13) {
                // alert("Oke")
                var value = elem.value;
                document.getElementById(idtext).innerText = value;
                document.getElementById(idtext).style.display = "block";
                document.getElementById(idfield).style.display = "none";
            }
        }

        function addNameDiketahui(elem, idfield, idtext) {
            if (event.keyCode == 13) {
                // alert("Oke")
                var value = elem.value;
                document.getElementById(idtext).innerText = value;
                document.getElementById(idtext).style.display = "block";
                document.getElementById(idfield).style.display = "none";
            }
        }

        function addNamePenerima(elem, idfield, idtext) {
            if (event.keyCode == 13) {
                // alert("Oke")
                var value = elem.value;
                document.getElementById(idtext).innerText = value;
                document.getElementById(idtext).style.display = "block";
                document.getElementById(idfield).style.display = "none";
            }
        }

        document.getElementById("btn-print").onclick = function() {
            print();
        }

        window.addEventListener("afterprint", (event) => {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", '<?= base_url("spk_gudang/countPrintSPK") ?>', true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = () => {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    alert("Successfully Print");
                }
            };

            xhr.send("spk=<?= $codeSPK ?>");
        });
    </script>
</html> 