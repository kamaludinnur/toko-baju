<h2>Entri Produk</h2>

<div id="x" style="display: none"></div>

<div class="form">
    <form action="" method="post" id="form">

        <fieldset>

            <dl>
                <dt><label>Merek</label></dt>
                <dd>
                    <select size="1" name="merek" id="id_merek" onchange="load_model(this.value)">
                        <option value="">Pilih merek: </option>
                        <?php foreach ($daftar_merek as $merek) {
 ?>
                            <option value="<?php echo $merek['id'] ?>"><?php echo $merek['nama'] ?></option>
<?php } ?>
                    </select>
                    atau <a href="#" title="Klik untuk menambahkan merek baru" onclick="$.colorbox({href:'index.php/master/merek/quick_entry', width:'500px', height:'270px', opacity: 0.5, onComplete: function(){$('#n').focus()}}); return false;">Tambah baru</a>
                </dd>
            </dl>

            <dl>
                <dt><label>Model</label></dt>
                <dd id="model">
                    <select size="1" name="model" id="id_model" disabled>
                        <option value="">Pilih model: </option>
                    </select>
                </dd>
            </dl>

            <dl>
                <dt><label>Warna</label></dt>
                <dd id="warna">
                    <select size="1" name="warna" id="id_warna">
                        <option value="">Pilih warna: </option>
<?php foreach ($daftar_warna as $merek) { ?>
                            <option value="<?php echo $merek['id'] ?>"><?php echo $merek['nama'] ?></option>
<?php } ?>
                    </select>
                    atau <a href="#" title="Klik untuk menambahkan warna baru" onclick="$.colorbox({href:'index.php/master/warna/quick_entry', width:'500px', height:'270px', opacity: 0.5, onComplete: function(){$('#n').focus()}}); return false;">Tambah baru</a>
                </dd>
            </dl>

            <dl>
                <dt><label>Ukuran</label></dt>
                <dd id="ukuran">
                    <select size="1" name="ukuran" id="id_ukuran">
                        <option value="">Pilih ukuran: </option>
<?php foreach ($daftar_ukuran as $merek) { ?>
                            <option value="<?php echo $merek['id'] ?>"><?php echo $merek['nama'] ?></option>
<?php } ?>
                    </select>
                    atau <a href="#" title="Klik untuk menambahkan ukuran baru" onclick="$.colorbox({href:'index.php/master/ukuran/quick_entry', width:'500px', height:'270px',opacity: 0.5, onComplete: function(){$('#n').focus()}}); return false;">Tambah baru</a>
                </dd>
            </dl>

            <dl>
                <dt><label>Stok</label></dt>
                <dd><input type="text" name="stok" id="stok" size="10" /></dd>
            </dl>

            <dl>
                <dt><label>Harga beli</label></dt>
                <dd><input type="text" name="harga_beli" id="hb" size="20" /> (harga beli satuan)</dd>
            </dl>

            <dl>
                <dt><label>Harga jual</label></dt>
                <dd><input type="text" name="harga_jual" id="hj" size="20" /> (harga jual satuan)</dd>
            </dl>

            <dl>
                <dt><label>Keterangan</label></dt>
                <dd><input type="text" name="keterangan" id="ktr" size="30" /> (opsional)</dd>
            </dl>

            <dl>
                <dt></dt>
                <dd>
                    <input type="submit" name="submit" id="submit" value="Simpan" class="button blue" />
                    <a href="index.php/master/produk" class="form_jump">&laquo; Kembali ke semua produk</a>
                </dd>
            </dl>



        </fieldset>

    </form>
</div>


<script type="text/javascript">

    var successCount = 0;

    $('#form').submit(function(){

        if(validateInputs()) {

            $('#x').load('index.php/master/produk/cek_database/' + $('#id_model').val() + '/' + $('#id_warna').val() + '/' + $('#id_ukuran').val(), function(){
                var x = $('#x').html();
                if (x == "1") {
                    error_sudahAda();
                } else {
                    submitForm();
                }
            });

        }

        return false;

    })

    function submitForm() {

        var formData = $('#form').serialize();
        $.ajax({
            url : 'index.php/master/produk/post',
            type : 'POST',
            data : formData,
            dataType : 'text',
            success : function(){
                $('#x').removeClass('error_box').addClass('valid_box').html("Data disimpan. Silakan entri lagi untuk produk yang lain.").slideDown('fast', function(){
                    //$(this).delay(3000).slideUp('slow');
                    putLatests();
                    $('#form')[0].reset();
                    load_model(0);
                    successCount++;
                });
            },
            error : function(){
                alert("Terjadi kesalahan saat menyimpan data");
            }
            
        });
    }

    function putLatests(){
        $('#produk_hint_sidebar').hide();
        $('#latest_entried_sidebar').fadeIn('slow');
        var data = "\
            <div class='entri'><table>\
                <tr>\
                    <td>Merek</td>\
                    <td>: "+$("#id_merek option:selected").text()+"</td>\
                </tr>\
                <tr>\
                    <td>Model</td>\
                    <td>: "+$("#id_model option:selected").text()+"</td>\
                </tr>\
                <tr>\
                    <td>Warna</td>\
                    <td>: "+$("#id_warna option:selected").text()+"</td>\
                </tr>\
                <tr>\
                    <td>Ukuran</td>\
                    <td>: "+$("#id_ukuran option:selected").text()+"</td>\
                </tr>\
            </table></div>";

         $('#latest_entried').prepend(data);
         $('.entri').first().hide(0, function(){$(this).fadeIn('slow')});


    }

    function error_sudahAda(){
        $('#x').removeClass('valid_box').addClass('error_box').html("Kesalahan : produk yang ingin Anda entri (merek " + $("#id_merek option:selected").text() + " model " + $("#id_model option:selected").text() + " warna " + $("#id_warna option:selected").text() + " ukuran " + $("#id_ukuran option:selected").text() + ") sudah pernah dientri sebelumnya.").slideDown('fast', function(){
            //$(this).delay(3000).slideUp('slow');
        });
    }

    function load_model(id){
        $('#model').load('index.php/master/produk/load_model/' + id);
    }

    function validateInputs() {

        $.validity.start();

        $('#id_merek').require("Harus memilih salah satu merek");
        $('#id_model').require("Harus memilih salah satu model");
        $('#id_warna').require("Harus memilih salah satu warna");
        $('#id_ukuran').require("Harus memilih salah satu ukuran");
        $('#stok').require("Stok harus diisi").match("number", "Harus diisi angka").greaterThan(0, "Harus lebih besar dari nol");
        $('#hj').require("Harga jual harus diisi").match("number", "Harus diisi angka").greaterThan(0, "Harus lebih besar dari nol");
        $('#hb').require("harga beli harus diisi").match("number", "Harus diisi angka").greaterThan(0, "Harus lebih besar dari nol");
       
        var result = $.validity.end();
        return result.valid;
    }

    // refresh isi dropdown, kalo ada input baru
    function refreshMerek()
    {
        $('#id_merek').load('index.php/master/merek/refresh_merek');
    }

    function refreshWarna()
    {
        $('#id_warna').load('index.php/master/warna/refresh_warna');
    }

    function refreshUkuran()
    {
        $('#id_ukuran').load('index.php/master/ukuran/refresh_ukuran');
    }

    // anti tutup
    window.onbeforeunload = function() {if(successCount > 0) return "Anda yakin akan meninggalkan halaman ini?"}

    $(document).ready(function(){
        // preserve sidebar
        $('#sidebar_toggler input').remove();
    })

</script>