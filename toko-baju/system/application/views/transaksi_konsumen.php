<h2>Transaksi Konsumen</h2>
<table>
    <tr>
        <th>No</th>
        <th>Produk</th>
        <th>Jumlah</th>
        <th>Harga Satuan</th>
        <th>Total</th>
    </tr>
</table>
<form>
    <div id="merek">
    <select name="merek">
        <option>--Merek--</option>
        <?php foreach ($daftar_merek as $merek) {?>
        <option value="<?php echo $merek['id'] ?>" onclick="load_model(<?php echo $merek['id']?>)"><?php echo $merek['nama']?></option>
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
        <select name="ukuran" disabled>
            <option>--Ukuran--</option>
        </select>
    </div>
    <?php echo $this->input->get('id')?>
</form>

<script type="text/javascript">

function load_model(id){
    $('#model').load('index.php/transaksi_konsumen/model/' + id);
}

function load_warna(model){
    $('#warna').load('index.php/transaksi_konsumen/warna/' + model);
}


</script>