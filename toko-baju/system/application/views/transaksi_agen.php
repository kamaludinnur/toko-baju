<h2>Transaksi Agen <?php echo $nama_agen?></h2>

<div class="yellowbox">
    <h3 class="left_drop" style="height: 30px">Agen</h3>
    <form action="" method="post">
    <div id="agen">
        <select name="agen">
            <?php
            foreach ($daftar_agen as $agen){
            ?>
            <option value="<?php echo $agen['id']?>" <?php if ($this->session->userdata('id_agen') == $agen['id']) echo 'selected="selected"'; ?> onclick="window.location='index.php/transaksi_agen/pilih_agen/<?php echo $agen['id']?>'"><?php echo $agen['kode']?>, <?php echo $agen['nama']?></option>
            <?php }?>
        </select>
    </div>
    </form>
</div>

<div class="yellowbox">
    <h3 class="left_drop">Produk</h3>

    <form action="" method="post" style="margin-top: 10px" onsubmit="return tambah();">
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
                    <select name="merek" onchange="load_model(this.value); load_warna(0); load_ukuran(0,0)">
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
                    <select name="model" disabled>
                        <option>--Model--</option>
                    </select>
                </div>
            </td>
            <td>
                <div id="warna">
                    <select name="warna" disabled>
                        <option>--Warna--</option>
                    </select>
                </div>
            </td>
            <td>
                <div id="ukuran">
                    <select name="id" disabled>
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
                    <input type="text" id="jumlah" name="jumlah" value="" size="10" />
                </div>
            </td>
            <td>
                <input type="submit" class="button blue" value="Tambah &raquo;" name="submit"/>
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
                                        <th>Diskon</th>
                                        <th>Harga Diskon</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
        <?php
                            if (count($this->cart->contents()) == 0) { ?>
                                <tr>
                                    <td colspan="10" style="text-align: center"><h1>Belum ada data</h1></td>
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
                                    <td style="text-align: right"><?php echo number_format($item['harga_satuan'], 0, ',', '.'); ?></td>
                                    <td style="text-align: right"><?php echo number_format($item['diskon'], 0, ',', '.');?>%</td>
                                    <td style="text-align: right"><?php echo number_format($item['price'], 0, ',', '.'); ?></td>
                                    <td style="text-align: right"><?php echo number_format($item['subtotal'], 0, ',', '.'); ?></td>
                                </tr>
<?php }} ?>
                        </tbody>
                        <tfoot>
                            <tr style="font-size: 15px;">
                                <td colspan="9" style="text-align: right"><strong>Total</strong></td>
                                <td style="text-align: right"><?php echo number_format($this->cart->total(), 0, ',', '.'); ?></td>
        </tr>
    </tfoot>
</table>

<br/>

<div style="text-align: right">
    Pembayaran:
    <select>
        <option value="1" <?php if($pembayaran==1) echo "selected "?>onclick="location.href='index.php/transaksi_agen/pembayaran/1'">Lunas</option>
        <option value="2" <?php if($pembayaran==2) echo "selected "?> onclick="location.href='index.php/transaksi_agen/pembayaran/2'">Tidak Lunas</option>
    </select>
    Metode Pembayaran:
    <select name="metode">
        <option value="1" onclick="location.href = 'index.php/transaksi_agen/metode_pembayaran/1'" <?php if($metode_pembayaran==1) echo "selected"?>>Cash</option>
        <option value="2" onclick="location.href = 'index.php/transaksi_agen/metode_pembayaran/2'" <?php if($metode_pembayaran==2) echo "selected"?>>EDC</option>
        <option value="3" onclick="location.href = 'index.php/transaksi_agen/metode_pembayaran/3'" <?php if($metode_pembayaran==3) echo "selected"?>>Transfer</option>
    </select>
    Total Pembayaran<?php if($pembayaran==2) echo ' Pertama'?>:
    
    <input type="text" id="dibayar" size="10" <?php if($pembayaran==1) echo 'disabled value="' . number_format($this->cart->total(), 0, ',', '') . '"'; else echo 'value="0"'?>/>
    Poin:

    <input type="text" id="poin" size="4" value="0" />
    <br />
    <input type="button" value="Bayar" class="button blue" onclick="window.location = 'index.php/transaksi_agen/bayar/' + $('#dibayar').val() + '/' + $('#poin').val()" />
    <input type="button" value="Batal" class="button red"  onclick="if(confirm('Yakin akan membatalkan? Transaksi yang belum dibayar akan terhapus.')) location.href = 'index.php/transaksi_agen/batal'"/>
</div>


<script type="text/javascript">

function load_model(id){
    $('#model').load('index.php/transaksi_agen/model/' + id);
}

function load_warna(model){
    $('#warna').load('index.php/transaksi_agen/warna/' + model);
}

function load_ukuran(model,warna){
    $('#ukuran').load('index.php/transaksi_agen/ukuran/' + model + '/' + warna);
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