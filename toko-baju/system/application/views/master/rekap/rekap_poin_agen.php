<script type="text/javascript" src="js/jquery.datepicker.js"></script>

<h2>Rekap Poin Agen</h2>

<form action="" method="post" id="form">

<div class="yellowbox">
    <h3 class="left_drop" style="height: auto">Agen</h3>
        <select name="agen" id="agen">
            <option value="0">Pilih agen:</option>
            <?php
            foreach ($daftar_agen as $agen){
            ?>
            <option value="<?php echo $agen['id']?>" <?php if($agen['id'] == $id_agen) echo 'selected="selected"'; ?>><?php echo $agen['kode']?>, <?php echo $agen['nama']?></option>
            <?php }?>
        </select>

     Tampilkan
     <input type="radio" name="range" value="all" id="range1" checked="checked" onclick="setRangeAll()"/>
     <label for="range1" onclick="setRangeAll()">Semua</label>
     <input type="radio" name="range" value="range" id="range2" onclick="setRangeRange()"/>
     <label for="range2" onclick="setRangeRange()">Rentang tanggal</label>

    &nbsp;&nbsp;&nbsp;&nbsp;
    <input type="submit" class="button blue" value="Rekap &raquo;" name="submit"/>

</div>

<div class="yellowbox" id="range" style="display: none">
    <h3 class="left_drop">Rentang</h3>
    <table style="margin-top: 10px">
        <tr>
            <td>Tanggal:</td>
            <td></td>
            <td>Sampai tanggal:</td>
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
        </tr>
    </table>
</div>

</form>

<br/>

<div id="rekap_result"></div>

<script type="text/javascript">

$('#form').submit(function(){

    $('#rekap_result').slideUp('slow', function(){
        $('#rekap_result')
            .load('index.php/master/rekap/poin_agen_get',
            {
                "agen"  : $('#agen').val(),
                "range" : $('#form input:radio:checked').val(),
                "start" : $('#start_date').val(),
                "end"   : $('#end_date').val()
            }, function(){
                $('#rekap_result').slideDown('slow');
            });
    })

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

        <?php if(isset($langsung_tampilin)) : ?>
            $('#form').submit();
        <?php endif; ?>

});

function setRangeAll(){
    $('#range').fadeOut('fast');
}

function setRangeRange(){
    $('#range').fadeIn();
}

</script>