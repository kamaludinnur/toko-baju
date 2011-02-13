<h2>Cari Transaksi</h2>

<div class="yellowbox">
    <form action="" method="post" id="form">

        Masukkan nomor transaksi : 
        <input type="text" name="id_order" id="id_order" size="20"/>
        <input type="submit" class="button blue" value="Cari &raquo;" name="submit"/>
        
    </form>
</div>

<div id="cari_result"></div>

<script type="text/javascript">

$('#form').submit(function(){

    if($('#id_order').val() == '') return false;

    $('#cari_result').slideUp('slow', function(){
        $('#cari_result')
            .load('index.php/master/order/cari_get/' + $('#id_order').val(), function(){
                $('#cari_result').slideDown('slow');
            });
    })

    return false;
});

</script>