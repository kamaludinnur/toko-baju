<h3>Tambahkan stok</h3>

<form action="" method="post" id="form_tambah_stok" class="dialogbox-form" onsubmit="submitTambahStok(); return false;">

    <table width="100%">

        <tr>
            <td style="text-align: right"><label>Tambahan stok:</label></td>
            <td><input type="text" name="new_stok" id="j" size="10" value="0"/></td>
            <td rowspan="4">

                <div style="width: 120px; overflow: hidden">
                    Data produk:
                    <ul style="padding-left: 13px">
                        <li>Merek <?php echo $data_produk->merek; ?></li>
                        <li>Model <?php echo $data_produk->model; ?></li>
                        <li>Warna <?php echo $data_produk->warna; ?></li>
                        <li>Ukuran <?php echo $data_produk->ukuran; ?></li>
                        <li>Harga beli <?php echo number_format($data_produk->harga_beli, 0, ',', '.'); ?></li>
                        <li>Harga jual <?php echo number_format($data_produk->harga_jual, 0, ',', '.'); ?></li>
                    </ul>
                </div>

            </td>
        </tr>

        <tr>
            <td style="text-align: right"><label>Harga beli:</label></td>
            <td><input type="text" name="new_harga_beli" id="h" size="15" value="<?php echo round($data_produk->harga_beli); ?>"/></td>
        </tr>

        <tr>
            <td></td>
            <td><small>(Harga pembelian saat ini)</small></td>
        </tr>

        <tr>
            <td></td>
            <td>
                <input type="hidden" name="new_id" value="<?php echo $id; ?>"/>
                <input type="submit" name="submit" id="submit" value="Tambah" class="button blue" />
            </td>
        </tr>


    </table>

</form>

<br/>

<script type="text/javascript">


    function validateInputs() {

        $.validity.start();

        $('#j').require("Stok harus diisi").match("number", "Harus diisi angka").greaterThan(0, "Harus lebih besar dari nol");
        $('#h').require("harga beli harus diisi").match("number", "Harus diisi angka").greaterThan(0, "Harus lebih besar dari nol");

        var result = $.validity.end();
        return result.valid;
    }

function submitTambahStok(){

    if (validateInputs()){

        var formData = $('#form_tambah_stok').serialize();
        $.ajax({
            url : 'index.php/master/produk/tambah_stok/<?php echo $id ?>',
            type : 'POST',
            data : formData,
            dataType : 'text',
            success : function(data){
                $.fn.colorbox.close();
                data = jQuery.parseJSON(data);  // return newStok, newHB

                $('#baris_' + <?php echo $id ?>).addClass('entri_baru');
                $('#data_stok_' + <?php echo $id ?>).css({fontWeight : 'bold'}).text(data.newStok);
                $('#data_hb_' + <?php echo $id ?>).css({fontWeight : 'bold'}).text(data.newHB);
                $('#edit_btn_' + <?php echo $id ?>).attr({"disabled":"disabled"});
            },
            error : function(){
                alert("Terjadi kesalahan saat menyimpan data");
            }

        });
     }
}

</script>