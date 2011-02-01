<!-- TODO: cek stok cukup atau nggak pake AJAX aja, belum ada validasi juga, kalo input kosong error  -->

<h2>Kehilangan</h2>

<div class="yellowbox">
    <h3 class="left_drop">Produk</h3>

    <form id="form" action="" method="post" style="margin-top: 10px" onsubmit="return tambah();">
    <table>
        <tr>
            <td>Merek:</td>
            <td>Model:</td>
            <td>Warna:</td>
            <td>Ukuran:</td>
            <td width="50px">Stok:</td>
            <td>Jumlah:</td>
            <td></td>
        </tr>
        <tr>
            <td>
                <div id="merek">
                    <select name="merek" onchange="load_model(this.value); load_warna(0); load_ukuran(0,0); $('.error_box').slideUp()">
                        <option>--Merek--</option>
                        <?php foreach ($daftar_merek as $merek) {
 ?>
                            <option value="<?php echo $merek['id'] ?>"><?php echo $merek['nama'] ?></option>
<?php } ?>
                    </select>
                </div>
            </td>
            <td>
                <div id="model">
                    <select name="model" id="model" disabled>
                        <option>--Model--</option>
                    </select>
                </div>
            </td>
            <td>
                <div id="warna">
                    <select name="warna" id="warna" disabled>
                        <option>--Warna--</option>
                    </select>
                </div>
            </td>
            <td>
                <div id="ukuran">
                    <select name="id" id="ukuran" disabled>
                        <option>--Ukuran--</option>
                    </select>
                </div>
            </td>
            <td>
                <div id="stok">
                    <input type="text" id="isi_stok" value="" disabled style="width: 40px; font-weight: bolder" />
                </div>
            </td>
            <td>
                <div class="trx">
                    <input type="text" id="jumlah" name="jumlah" value="" size="10" onchange="$('.error_box').slideUp();" />
                </div>
            </td>
            <td>
                <input id="submit" type="submit" class="button blue" value="Tambah &raquo;" name="submit"/>
            </td>
        </tr>
    </table>
    </form>
</div>

<br/>

<?php if ($info)
                            echo "<div class='error_box'>" . $info . "</div>" ?>

<div class="error_box" style="display: none"></div>

                            <br/>

                            <table class="rounded-corner sortable" id="main_table">
                                <thead>
                                    <tr>
                                        <th width="25" class="rounded-company">No</th>
                                        <th>Merek</th>
                                        <th>Model</th>
                                        <th>Warna</th>
                                        <th>Ukuran</th>
                                        <th>Jumlah</th>
                                        <th>Harga Satuan</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
        <?php
                            if (count($this->cart->contents()) == 0) { ?>
                                <tr>
                                    <td colspan="8" style="text-align: center"><h1>Belum ada data</h1></td>
                                </tr>
        <?php               } else { $i = 1;
                            foreach ($this->cart->contents() as $item) {
        ?>
                                <tr>
                                    <td><?php echo $i++ ?></td>
                                    <td><?php echo $item['merek'] ?></td>
                                    <td><?php echo $item['name'] ?></td>
                                    <td><?php echo $item['warna'] ?></td>
                                    <td><?php echo $item['ukuran'] ?></td>
                                    <td style="text-align: right"><?php echo $item['qty'] ?></td>
                                    <td style="text-align: right"><?php echo number_format($item['price'], 0, ',', '.'); ?></td>
                                    <td style="text-align: right"><?php echo number_format($item['subtotal'], 0, ',', '.'); ?></td>
                                </tr>
<?php }} ?>
                        </tbody>
                        <tfoot>
                            <tr style="font-size: 15px;">
                                <td colspan="7" style="text-align: right"><strong>Total</strong></td>
                                <td style="text-align: right"><?php echo number_format($this->cart->total(), 0, ',', '.'); ?></td>
        </tr>
    </tfoot>
</table>

<br/>

<div style="text-align: right">
    <input type="button" value="Proses" class="button blue" onclick="location.href = 'index.php/transaksi_kehilangan/bayar'"/>
    <input type="button" value="Batal" class="button red"  onclick="if(confirm('Yakin akan membatalkan? Transaksi yang belum dibayar akan terhapus.')) location.href = 'index.php/transaksi_konsumen/batal'"/>
</div>

<script type="text/javascript">

    function load_model(id){
        $('#model').load('index.php/transaksi_konsumen/model/' + id);
    }

    function load_warna(model){
        $('#warna').load('index.php/transaksi_konsumen/warna/' + model);
    }

    function load_ukuran(model,warna){
        $('#ukuran').load('index.php/transaksi_konsumen/ukuran/' + model + '/' + warna);
    }

    function load_stok(id){
        $('#stok').load('index.php/transaksi_konsumen/stok/' + id);
    }

    function tambah(){

        var jumlahDipesen = parseInt($('#jumlah').val());
        var stokTersedia = parseInt($('#stok input[type=text]').val());
        if (jumlahDipesen > stokTersedia) {
            $('.error_box').slideDown('slow').html("Stok tidak mencukupi. Stok tersedia hanya " + stokTersedia + " sedangkan jumlah yang dipesan " + jumlahDipesen);
            return false;
        }
    }

</script>

<script type="text/javascript">

    $(document).ready(function(){

        $('#main_table').tablesorter({cssHeader:'tablesorter-header',sortList: [[0,0]]});

    });


</script>