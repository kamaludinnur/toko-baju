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

    <form action="" method="post" style="margin-top: 10px">
    <table>
        <tr>
            <td>Merek:</td>
            <td>Model:</td>
            <td>Warna:</td>
            <td>Ukuran:</td>
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
                <div class="trx">
                    <input type="text" name="jumlah" value="" size="10" />
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
    <input type="button" value="Bayar" class="button blue" onclick="location.href = 'index.php/transaksi_agen/bayar'"/>
    <input type="button" value="Batal" class="button red"  onclick="location.href = 'index.php/transaksi_agen/batal'"/>
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

</script>

<script type="text/javascript">

    $(document).ready(function(){

        $('#main_table').tablesorter({cssHeader:'tablesorter-header',sortList: [[0,0]]});

    });


</script>