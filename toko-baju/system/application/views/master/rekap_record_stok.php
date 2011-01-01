<script type="text/javascript" src="js/jquery.datepicker.js"></script>

<h2>Record Stok Produk</h2>

<div class="tab activetab" id="t1" onclick="$('#t2').removeClass('activetab'); $('#t1').addClass('activetab'); $('#filterbox').show(); $('#datebox').hide(); $('#rekap_result').slideUp()">Berdasarkan produk</div>
<div class="tab"           id="t2" onclick="$('#t1').removeClass('activetab'); $('#t2').addClass('activetab'); $('#filterbox').hide(); $('#datebox').show(); $('#rekap_result').slideUp()">Berdasarkan tanggal</div>

<div class="yellowbox" id="filterbox">
    <?php //print_r($filter_value); ?>
    <form action="" method="post" id="filter_form">

        <table>
            <tr>
                <td>Merek:</td>
                <td>Model:</td>
                <td>Warna:</td>
                <td>Ukuran:</td>
                <td></td>
            </tr>
            <tr>
                <td>
                    <select name="merek" id="id_merek" style="width: 150px; overflow: hidden">
                        <option value="0">[Semua merek] </option>
                        <optgroup label="Pilih merek">
                        <?php foreach ($daftar_merek as $merek) { ?>
                            <option value="<?php echo $merek['id'] ?>"><?php echo $merek['nama'] ?></option>
                        <?php } ?>
                        </optgroup>
                    </select>
                </td>
                <td>
                    <select name="model" id="id_model" style="width: 150px; overflow: hidden">
                        <option value="0">[Semua model] </option>
                        <optgroup label="Pilih model">
                        <?php foreach ($daftar_model as $model) { ?>
                            <option value="<?php echo $model['id'] ?>"><?php echo $model['nama'] ?></option>
                        <?php } ?>
                        </optgroup>
                    </select>
                </td>                
                <td>
                    <select name="warna" id="id_warna" style="width: 100px; overflow: hidden">
                        <option value="0">[Semua warna] </option>
                        <optgroup label="Pilih warna">
                        <?php foreach ($daftar_warna as $warna) { ?>
                            <option value="<?php echo $warna['id'] ?>"><?php echo $warna['nama'] ?></option>
                        <?php } ?>
                        </optgroup>
                    </select>
                </td>
                <td>
                    <select name="ukuran" id="id_ukuran" style="width: 70px; overflow: hidden">
                        <option value="0">[Semua ukuran] </option>
                        <optgroup label="Pilih ukuran">
                        <?php foreach ($daftar_ukuran as $ukuran) { ?>
                            <option value="<?php echo $ukuran['id'] ?>"><?php echo $ukuran['nama'] ?></option>
                        <?php } ?>
                        </optgroup>
                    </select>
                </td>
                <td>
                    <input type="submit" class="button blue" value="Tampilkan &raquo;" name="submit"/>
                </td>
            </tr>
        </table>

    </form>


</div>

<div class="yellowbox" id="datebox" style="display: none;">

    <form action="" method="post" id="trx_form">
        <table>
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
                    <input type="submit" class="button blue" value="Tampilkan &raquo;" name="submit"/>
                </td>
            </tr>
        </table>
    </form>

</div>

<br/>

<div id="rekap_result"></div>

<script type="text/javascript">

$('#filter_form').submit(function(){

    $('#rekap_result').slideUp('slow', function(){
        $('#rekap_result')
            .load('index.php/master/rekap/record_stok_per_produk',
            {
                "merek" : $('#id_merek').val(),
                "model" : $('#id_model').val(),
                "warna" : $('#id_warna').val(),
                "ukuran" : $('#id_ukuran').val()
            }, function(){
                $('#rekap_result').slideDown('slow');
            });
    })

    // $('.datepicker').fadeOut('slow');

    return false;
});

$('#trx_form').submit(function(){

    if($('#start_date').val() == '' || $('#end_date').val() == '') return false;

    $('#rekap_result').slideUp('slow', function(){
        $('#rekap_result')
            .load('index.php/master/rekap/record_stok_per_tanggal',
            {
                "start" : $('#start_date').val(),
                "end"   : $('#end_date').val()
            }, function(){
                $('#rekap_result').slideDown('slow');
            });
    })

    // $('.datepicker').fadeOut('slow');

    return false;
});

$(document).ready(function () {

	$('#start_date').simpleDatepicker();
	$('#end_date').simpleDatepicker();

});

</script>