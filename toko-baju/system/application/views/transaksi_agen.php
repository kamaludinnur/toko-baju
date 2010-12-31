<h2>Transaksi Agen <?php echo $nama_agen?></h2>
<div id="agen">
        <select name="agen">
            <?php
            foreach ($daftar_agen as $agen){
            ?>
            <option value="<?php echo $agen['id']?>" onclick="window.location='index.php/transaksi_agen/pilih_agen/<?php echo $agen['id']?>'"><?php echo $agen['kode']?>, <?php echo $agen['nama']?></option>
            <?php }?>
        </select>
    </div>
<?php if ($info) echo $info?>
<table>
    <tr>
        <th>No</th>
        <th>Merek</th>
        <th>Model</th>
        <th>Warna</th>
        <th>Ukuran</th>
        <th>Jumlah</th>
        <th>Harga Satuan</th>
        <th>Total</th>
    </tr>


<?php
$i=1;
foreach($this->cart->contents() as $item){?>
    <tr>
        <td><?php echo $i++?></td>
        <td><?php echo $item['merek']?></td>
        <td><?php echo $item['name']?></td>
        <td><?php echo $item['warna']?></td>
        <td><?php echo $item['ukuran']?></td>
        <td><?php echo $item['qty']?></td>
        <td><?php echo $item['price']?></td>
        <td><?php echo $item['subtotal']?></td>
    </tr>
<?php }
?>
</table>
Total: Rp <?php echo number_format($this->cart->total())?> <br />

<a href="index.php/transaksi_agen/bayar">Bayar</a>
<a href="index.php/transaksi_agen/batal">Batal</a>
<form action="" method="POST">
    
    <div id="merek">
    <select name="merek">
        <option>--Merek--</option>
        <?php foreach ($daftar_merek as $merek) {?>
        <option value="<?php echo $merek['id'] ?>" onclick="load_model(<?php echo $merek['id']?>); load_warna(0); load_ukuran(0,0)"><?php echo $merek['nama']?></option>
        <?php }?>
    </select>
    </div>
    <div id="model">
        <select name="model" disabled>
            <option>--Model--</option>
        </select>
    </div>
    <div id="warna">
        <select name="warna" disabled>
            <option>--Warna--</option>
        </select>
    </div>
    <div id="ukuran">
        <select name="id" disabled>
            <option>--Ukuran--</option>
        </select>
    </div>
    <div class="trx">
        <input type="text" name="jumlah" value="" />
    </div>
    <div class="trx">
        <input type="submit" name="submit" value="tambah">
    </div>
</form>

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