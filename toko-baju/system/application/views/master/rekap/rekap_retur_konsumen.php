<script type="text/javascript" src="js/jquery.datepicker.js"></script>

<h2>Rekap Transaksi Konsumen</h2>

<?php $operators = array('=', '<', '<=', '>', '>='); ?>

<div class="yellowbox">
    <h3 class="left_drop">Rentang</h3>
    <form action="index.php/master/rekap/retur_konsumen_res" method="post" id="trx_form">
        <table style="margin-top: 10px">
            <tr>
                <td>Tanggal:</td>
                <td></td>
                <td>Sampai tanggal:</td>
                <td>Format: DD/MM/YYYY</td>
            </tr>
            <tr>
                <td>
                    <input type="text" size="15" id="start_date" name="start_date" value="<?php echo date("d/m/Y"); ?>"/>
                </td>
                <td>
                    <input type="button" value="&rArr;" title="Samakan tanggal" onclick="$('#end_date').val($('#start_date').val())"/>
                </td>
                <td>
                    <input type="text" size="15" id="end_date" name="end_date" value="<?php echo date("d/m/Y"); ?>"/>
                </td>
                <td>
                    <input type="button" class="button blue" value="Filter (0)" onclick="$('#filterbox').slideToggle()" id="filter_btn_toggler"/>
                    <input type="submit" class="button blue" value="Rekap &raquo;" name="submit"/>
                </td>
            </tr>
        </table>
    </form>
</div>

<div class="yellowbox" id="filterbox" style="display: none">
    <form action="index.php/master/produk/filter" method="post" id="filter_form">

        <table width="100%">
            <tr>
                <td>Merek:</td>
                <td><input type="text" id="merek" name="f_merek" size="20" value=""/></td>
            </tr>
            <tr>
                <td>Model:</td>
                <td><input type="text" id="model" name="f_model" size="20" value=""/></td>
            </tr>
            <tr>
                <td>Warna:</td>
                <td><input type="text" id="warna" name="f_warna" size="20" value=""/></td>
            </tr>
            <tr>
                <td>Ukuran:</td>
                <td><input type="text" id="ukuran" name="f_ukuran" size="5" value=""/></td>
            </tr>
            <tr>
                <td>Jumlah:</td>
                <td>
                    <select id="jumlah_op">
                        <?php foreach ($operators as $o) {
                            echo "<option value='$o'>$o</option>";
                        }; ?>
                    </select>
                    <input type="text" id="jumlah" name="f_jumlah" size="5" value="<?php echo $this->session->userdata('prod_filter_input_4'); ?>"/>
                </td>
            </tr>
            <tr>
                <td>Harga:</td>
                <td>
                    <select id="harga_op">
                        <?php foreach ($operators as $o) {
                            echo "<option value='$o'>$o</option>";
                        }; ?>
                    </select>
                    <input type="text" id="harga" name="f_harga" size="10" value="<?php echo $this->session->userdata('prod_filter_input_5'); ?>"/>
                </td>
            </tr>
            <tr>
                <td>Refund:</td>
                <td>
                    <select id="keuntungan_op">
                        <?php foreach ($operators as $o) {
                            echo "<option value='$o'>$o</option>";
                        }; ?>
                    </select>
                    <input type="text" id="keuntungan" name="f_keuntungan" size="10" value="<?php echo $this->session->userdata('prod_filter_input_6'); ?>"/>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" value="Aktifkan filter" class="button blue"/>
                    <a href="#" onclick="$('#filter_form input[type=text]').val(''); $('select option:first-child').attr('selected', 'selected'); $('#filter_form').submit(); return false;">Hapus filter</a>
                </td>
            </tr>
        </table>

    </form>
    <script type="text/javascript">

    $('#merek').autocompleteArray("<?php foreach ($daftar_merek as $merek) echo $merek['nama'] . ";" ?>".split(";"), {autoFill:true, delay:10,selectFirst:true,selectOnly:true});
    $('#model').autocompleteArray("<?php foreach ($daftar_model as $model) echo $model['nama'] . ";" ?>".split(";"), {autoFill:true, delay:10,selectFirst:true,selectOnly:true});
    $('#warna').autocompleteArray("<?php foreach ($daftar_warna as $warna) echo $warna['nama'] . ";" ?>".split(";"), {autoFill:true, delay:10,selectFirst:true,selectOnly:true});
    $('#ukuran').autocompleteArray("<?php foreach ($daftar_ukuran as $ukuran) echo $ukuran['nama'] . ";" ?>".split(";"), {autoFill:true, delay:10,selectFirst:true,selectOnly:true});

    </script>

</div>

<br/>

<div id="rekap_result"></div>

<script type="text/javascript">

$('#filter_form').submit(function(){

    if($('#start_date').val() == '' || $('#end_date').val() == '') return false;

    $('#filterbox').slideUp();

    $('#rekap_result').slideUp('slow', function(){

        $('#rekap_result')
            .load('index.php/master/rekap/retur_konsumen_get',
            {
                "start" : $('#start_date').val(),
                "end"   : $('#end_date').val(),

                "is_filtered" : 1,

                "f_merek" : $('#merek').val(),
                "f_model" : $('#model').val(),
                "f_warna" : $('#warna').val(),
                "f_ukuran" : $('#ukuran').val(),
                "f_jumlah" : $('#jumlah').val(),
                "f_harga" : $('#harga').val(),
                "f_keuntungan" : $('#keuntungan').val(),

                "f_jumlah_op" : $('#jumlah_op').val(),
                "f_harga_op" : $('#harga_op').val(),
                "f_keuntungan_op" : $('#keuntungan_op').val()
            }, function(){
                $('#rekap_result').slideDown('slow');

                var jumlahFilterAktif = 7 - $("#filter_form :input[value='']").length;

                if (jumlahFilterAktif > 0) $('#filter_btn_toggler').removeClass('blue').addClass('orange').val("Filter (" + jumlahFilterAktif + " kriteria)")
                else $('#filter_btn_toggler').removeClass('orange').addClass('blue').val("Filter (0)");
            });
    })
    
    return false;
});

$('#trx_form').submit(function(){

    if($('#start_date').val() == '' || $('#end_date').val() == '') return false;

    $('#filterbox').slideUp();

    $('#rekap_result').slideUp('slow', function(){
        $('#rekap_result')
            .load('index.php/master/rekap/retur_konsumen_get',
            {
                "start" : $('#start_date').val(),
                "end"   : $('#end_date').val()
            }, function(){
                $('#rekap_result').slideDown('slow');
                $('#filter_btn_toggler').removeClass('orange').addClass('blue').val("Filter (0)");
            });
    })

    // $('.datepicker').fadeOut('slow');

    return false;
});

function setHariIni(){

        var dateString = "<?php echo date("d/m/Y"); ?>";
        $('#start_date, #end_date').val(dateString);
        $('#trx_form').submit();

}

$(document).ready(function () {

	$('#start_date').simpleDatepicker();
	$('#end_date').simpleDatepicker();

});


</script>