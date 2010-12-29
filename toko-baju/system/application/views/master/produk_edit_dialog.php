<h3>Edit Produk</h3>

<form action="" method="post" id="form_edit_produk" class="dialogbox-form" onsubmit="submitEdit(); return false;">

    <table width="100%">

        <tr>
            <td style="text-align: right"><label>Merek:</label></td>
            <td><?php echo $data_produk->merek; ?></td>
        </tr>
        <tr>
            <td style="text-align: right"><label>Model:</label></td>
            <td><?php echo $data_produk->model; ?></td>
        </tr>
        <tr>
            <td style="text-align: right"><label>Warna:</label></td>
            <td><?php echo $data_produk->warna; ?></td>
        </tr>
        <tr>
            <td style="text-align: right"><label>Ukuran:</label></td>
            <td><?php echo $data_produk->ukuran; ?></td>
        </tr>

        <tr>
            <td style="text-align: right"><label>Stok:</label></td>
            <td><input type="text" name="new_stok" id="s" size="10" value="<?php echo $data_produk->stok; ?>"/></td>
        </tr>

        <tr>
            <td style="text-align: right"><label>Harga beli:</label></td>
            <td><input type="text" name="new_harga_beli" id="hb" size="15" value="<?php echo round($data_produk->harga_beli); ?>"/></td>
        </tr>

        <tr>
            <td style="text-align: right"><label>Harga jual:</label></td>
            <td><input type="text" name="new_harga_jual" id="hj" size="15" value="<?php echo round($data_produk->harga_jual); ?>"/></td>
        </tr>

        <tr>
            <td style="text-align: right"><label>Keterangan:</label></td>
            <td><input type="text" name="new_keterangan" id="ktr" size="25" value="<?php echo $data_produk->keterangan ?>"/></td>
        </tr>

        <tr>
            <td></td>
            <td>
                <input type="hidden" name="new_id" value="<?php echo $id; ?>"/>
                <input type="submit" name="submit" id="submit" value="Simpan" class="button blue" />
            </td>
        </tr>


    </table>

</form>

<br/>

<script type="text/javascript">


    function validateInputs() {

        $.validity.start();

        $('#s').require("Stok harus diisi").match("number", "Harus diisi angka").greaterThan(0, "Harus lebih besar dari nol");
        $('#hb').require("harga beli harus diisi").match("number", "Harus diisi angka").greaterThan(0, "Harus lebih besar dari nol");
        $('#hj').require("harga beli harus diisi").match("number", "Harus diisi angka").greaterThan(0, "Harus lebih besar dari nol");

        var result = $.validity.end();
        return result.valid;
    }

function submitEdit(){

    if (validateInputs()){

        var formData = $('#form_edit_produk').serialize();
        $.ajax({
            url : 'index.php/master/produk/edit/<?php echo $id ?>',
            type : 'POST',
            data : formData,
            dataType : 'text',
            success : function(data){
                $.fn.colorbox.close();
                data = jQuery.parseJSON(data);  // return newStok, newHB

                $('#baris_' + <?php echo $id ?>).addClass('entri_baru');
                $('#data_stok_' + <?php echo $id ?>).css({fontWeight : 'bold'}).text(data.newStok);
                $('#data_hb_' + <?php echo $id ?>).css({fontWeight : 'bold'}).text(data.newHB);
                $('#data_hj_' + <?php echo $id ?>).css({fontWeight : 'bold'}).text(data.newHJ);
                $('#data_ktr_' + <?php echo $id ?>).css({fontWeight : 'bold'}).text(data.newKtr);
            },
            error : function(){
                alert("Terjadi kesalahan saat menyimpan data");
            }

        });
     }

}

</script>