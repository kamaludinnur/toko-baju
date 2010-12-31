<script type="text/javascript" src="js/jquery.datepicker.js"></script>

<h2>Rekap Transaksi Konsumen</h2>

<div class="yellowbox">
    <h3 class="left_drop">Rentang</h3>
    <form action="index.php/master/rekap/transaksi_konsumen_res" method="post" id="trx_form">
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
                    <input type="submit" class="button blue" value="Rekap &raquo;" name="submit"/>
                </td>
            </tr>
        </table>
    </form>
</div>

<br/>

<div id="rekap_result"></div>

<script type="text/javascript">

$('#trx_form').submit(function(){

    if($('#start_date').val() == '' || $('#end_date').val() == '') return false;

    $('#rekap_result').slideUp('slow', function(){
        $('#rekap_result')
            .load('index.php/master/rekap/transaksi_konsumen_get',
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