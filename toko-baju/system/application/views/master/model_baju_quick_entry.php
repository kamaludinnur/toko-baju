<h3>Tambahkan model untuk <?php echo $this->merek->get_merek($merek)->nama; ?></h3>

    <form action="" method="post" id="form_model_baju" class="dialogbox-form">

        <table width="100%">

            <tr>
                <td style="text-align: right"><label>Nama model:</label></td>
                <td><input type="text" name="new_nama" id="n" size="20" /></td>
            </tr>

            <tr>
                <td style="text-align: right"><label>Keterangan:</label></td>
                <td><input type="text" name="new_keterangan" id="ktr" size="30" /> (opsional)</td>
            </tr>

            <tr>
                <td></td>
                <td>
                    <input type="hidden" name="new_merek" value="<?php echo $merek; ?>"/>
                    <input type="submit" name="submit" id="submit" value="Tambahkan" class="button blue" />
                    <a href="index.php/master/model_baju" title="Buka manajemen model" class="form_jump">Manajemen model &raquo;</a>
                </td>
            </tr>


        </table>

    </form>

<script type="text/javascript">

$('#form_model_baju').submit(function(){

        if($('#n').val() == "") return false;

        var formData = $('#form_model_baju').serialize();
        $.ajax({
            url : 'index.php/master/model_baju/tambah_untuk_merek/<?php echo $merek ?>',
            type : 'POST',
            data : formData,
            dataType : 'text',
            success : function(data){
                $.fn.colorbox.close();
                load_model(<?php echo $merek ?>);
                // display message
                $('#x').removeClass('error_box').addClass('valid_box')
                    .html("Model baru \"" + $('#n').val() + "\" untuk merek \"<?php echo $this->merek->get_merek($merek)->nama; ?>\" telah ditambahkan.").slideDown('fast', function(){
                });
            },
            error : function(){
                alert("Terjadi kesalahan saat menyimpan data");
            }

        });

        return false;

});

</script>