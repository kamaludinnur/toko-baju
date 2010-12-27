<h2>Entri Produk</h2>

         <div class="form">
         <form action="" method="post">

                <fieldset>

                    <dl>
                        <dt><label for="gender">Merek:</label></dt>
                        <dd>
                            <select size="1" name="merek" id="">
                                <option value="">Pilih merek: </option>
                                <?php foreach ($daftar_merek as $merek) {?>
                                <option value="<?php echo $merek['id'] ?>" onclick="load_model(<?php echo $merek['id']?>)"><?php echo $merek['nama']?></option>
                                <?php }?>
                            </select>
                        </dd>
                    </dl>

                    <dl>
                        <dt><label for="gender">Model:</label></dt>
                        <dd id="model">
                            <select size="1" name="model" id="" disabled="disabled">
                                <option value="">Pilih model: </option>
                            </select>
                        </dd>
                    </dl>

                    <dl>
                        <dt><label for="gender">Warna:</label></dt>
                        <dd id="warna">
                            <select size="1" name="warna" id="">
                                <option value="">Pilih warna: </option>
                                <?php foreach ($daftar_warna as $merek) {?>
                                <option value="<?php echo $merek['id'] ?>" onclick="load_model(<?php echo $merek['id']?>)"><?php echo $merek['nama']?></option>
                                <?php }?>
                            </select>
                        </dd>
                    </dl>

                    <dl>
                        <dt><label for="gender">Ukuran:</label></dt>
                        <dd id="ukuran">
                            <select size="1" name="ukuran" id="">
                                <option value="">Pilih ukuran: </option>
                                <?php foreach ($daftar_ukuran as $merek) {?>
                                <option value="<?php echo $merek['id'] ?>" onclick="load_model(<?php echo $merek['id']?>)"><?php echo $merek['nama']?></option>
                                <?php }?>
                            </select>
                        </dd>
                    </dl>

                    <dl>
                        <dt><label for="email">Email Address:</label></dt>
                        <dd><input type="text" name="" id="" size="54" /></dd>
                    </dl>

                    <dl>
                        <dt><label for="comments">Message:</label></dt>
                        <dd><textarea name="comments" id="comments" rows="5" cols="36"></textarea></dd>
                    </dl>

                    <dl>
                        <dt><label></label></dt>
                        <dd>
                            <input type="checkbox" name="interests[]" id="" value="" /><label class="check_label">I agree to the <a href="#">terms &amp; conditions</a></label>
                        </dd>
                    </dl>

                     <dl class="submit">
                    <input type="submit" name="submit" id="submit" value="Submit" />
                     </dl>



                </fieldset>

         </form>
         </div>



<table class="rounded-corner" id="main_table">
    <thead>
        <tr>
            <th width="25" class="rounded-company">ID</th>
            <th width="">Model</th>
            <th width="">Warna</th>
            <th width="">Ukuran</th>
            <th width="">Stok</th>
            <th width="">Harga pembelian</th>
            <th width="">Harga penjualan</th>
            <th width="">Keterangan</th>
            <th width="120" class="rounded-q4">&nbsp;</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
    <tfoot>
        <tr>
            <td colspan="9">Tambahkan data</td>
        </tr>
        <tr>
            <form action="" id="form" method="post">
                <td class="rounded-foot-left"></td>
                <td><input type="text" style="width: 100%" id="id_model"/></td>
                <td><input type="text" style="width: 100%" id="id_warna"/></td>
                <td><input type="text" style="width: 100%" id="id_ukuran"/></td>
                <td><input type="text" style="width: 100%" id="stok"/></td>
                <td><input type="text" style="width: 100%" id="harga_beli"/></td>
                <td><input type="text" style="width: 100%" id="harga_jual"/></td>
                <td><input type="text" style="width: 100%" id="keterangan"/></td>
                <td class="rounded-foot-right"><input type="submit" value="+ Tambahkan" name="submit"/></td>
            </form>
        </tr>
    </tfoot> 
</table>

<div id="x" style="display: none"></div>

<script type="text/javascript">

$('#form').submit(function(){

    $('#x').load('index.php/master/produk/cek_database/' + $('#id_model').val() + '/' + $('#id_warna').val() + '/' + $('#id_ukuran').val(), function(){
        var x = $('#x').html();
        if (x == "1") error_sudahAda();
    });

    return false;
})

function error_sudahAda(){
    $('#x').addClass('error_box').html("Kesalahan : produk yang ingin Anda entri sudah pernah dientri sebelumnya.").fadeIn('fast');
}

</script>

<script type="text/javascript">

function load_model(id){
    $('#model').load('index.php/master/produk/load_model/' + id);
}

</script>