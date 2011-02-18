    <h2>Transaksi Pelunasan</h2>

<div>Silakan masukan pembayaran di bawah ini</div>

<br/>

<br style="clear: both"/>
<table class="rounded-corner sortable" id="main_table">
    <thead>
        <tr>
            <th width="25" class="rounded-company">No</th>
            <th>Tanggal</th>
            <th>No Transaksi</th>
            <th>Agen</th>
            <th>Kode Agen</th>
            <th>Total Belanja</th>
            <th>Total Pembayaran</th>
            <th>Sisa Pembayaran</th>
            <th style="width: 30px" class="rounded-q4">&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($daftar_hutang) == 0) : ?>
        <tr>
            <td colspan="6">Belum ada data</td>
        </tr>
        <?php else : $i = $this->uri->segment(4, 0) + 1; foreach($daftar_hutang as $produk) : ?>
        <tr <?php if($i%2 == 0) echo "class='alt'" ; ?> id="baris_" >
            <td><?php echo $i; ?></td>
            <td><?php echo date('d/m/Y', strtotime($produk['tanggal'])); ?></td>
            <td style="text-align: right"><?php echo $produk['order_id']; ?></td>
            <td><?php echo $produk['agen']; ?></td>
            <td><?php echo $produk['kode_agen']; ?></td>
            <td style="text-align: right"><?php echo number_format($produk['total'], 0, ',', '.'); ?></td>
            <td style="text-align: right"><?php echo number_format($produk['dibayar'], 0, ',', '.'); ?></td>
            <td style="text-align: right"><?php echo number_format($produk['sisa'], 0, ',', '.'); ?></td>
            <td>
                
            </td>
        </tr>
        <?php $i++; endforeach; endif; ?>
    </tbody>
</table>
<br />
<table class="rounded-corner" id="main_table">
    <thead>
        <tr <?php if($i%2 == 0) echo "class='alt'" ; ?> >
            <th width="25" class="rounded-company">No</th>
            <th>Tanggal</th>
            <th>No. Trx.</th>
            <th style="text-align: right">Jumlah</th>
            <th class="rounded-q4">Metode Pembayaran</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($pembayaran) == 0) : ?>
        <tr>
            <td colspan="9">Belum ada data</td>
        </tr>
        <?php else : $i = 1; foreach($pembayaran as $p) : ?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo date('d/m/Y', strtotime($p['tanggal'])); ?></td>
            <td><?php echo $p['order']; ?></td>
            <td style="text-align: right"><?php echo number_format($p['jumlah'], 0, ',', '.'); ?></td>
            <td><?php
            $metode = $p['metode'];
            if($metode==1)
        {
            echo "Cash";
        }
        else if ($metode==2)
        {
            echo "EDC";
        }
        else if ($metode==3)
        {
            echo "Transfer";
        }
        ?>
            </td>
            
        </tr>
	
        <?php $i++; endforeach; endif; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="9">Tambahkan data</td>
        </tr>
        <tr>
            <form action="index.php/transaksi_pelunasan/tambah" id="form" method="post">
                <td class="rounded-foot-left"></td>
                <td><input type="hidden" name="id" value="<?php echo $p['order']?>" /></td>
                <td></td>
                <td style="text-align: right">
                    <input type="text" name="jumlah" value="<?php echo $produk['sisa']?>" style="text-align: right" />
                    
                </td>

                <td class="rounded-foot-right">
                    <select name="metode">
                        <option value="1">Cash</option>
                        <option value="2">EDC</option>
                        <option value="3">Transfer</option>
                    </select>
                    <input type="submit" value="+ Tambahkan" name="submit" class="button blue"/></td>
            </form>
        </tr>
    </tfoot>
</table>

<script type="text/javascript">

$(document).ready(function(){

    var inputNama = $('#new_nama');

    $('#form').submit(function(){

        if(inputNama.val() == "" || $('#new_diskon').val() == "" || $('#new_kode').val() == "") return false;

    });
    $('.entri_baru').css({backgroundColor : 'yellow !important'});

})

function showEditForm(id) {
        $('#filter').val("");
        $('.editrow').hide();
        $('.row').show();
	$('#baris_' + id).hide();
	$('#edit_' + id).fadeIn('slow');
        $('#nama_' + id).focus();
}

function hideEditForm(id) {
	$('#edit_' + id).hide();
	$('#baris_' + id).fadeIn('slow');
}

$(function() {
  var theTable = $('#main_table')

  $("#filter").keyup(function() {
    $.uiTableFilter( theTable, this.value );
    $('.editrow').hide();
  })
});

function hapus(id){
    if(confirm("Yakin ingin menghapus data ini?")){
        $.ajax({
           url: 'index.php/master/agen/hapus/' + id,
           dataType: 'text',
           success: function(data){
               if(data == 1){
                   $('#baris_' + id).fadeOut('slow', function(){$(this).remove()});
                   $('#edit_' + id).remove();
               } else alert("Kesalahan: gagal menghapus data!");
           },
           error: function(){
               alert("Kesalahan: gagal menghapus data!");
           }
        });
    }
}

</script>
