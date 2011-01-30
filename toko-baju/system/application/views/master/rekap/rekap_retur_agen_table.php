<?php $total_jumlah = 0; $total_harga = 0; $total_keuntungan = 0 ?>

<?php if(count($data_rekapan) > 0) : ?>
<form action="index.php/master/rekap/retur_agen_xls" method="post" style="float: right; margin-bottom: 10px">
    <input type="hidden" name="start" value="<?php echo $start_date; ?>"/>
    <input type="hidden" name="end" value="<?php echo $end_date; ?>"/>
    <input type="submit" class="xls-button" value="Simpan XLS" title="Klik untuk menyimpan hasil rekap dalam bentuk file XLS"/>
</form>
<?php endif; ?>

<strong><big>Tanggal <?php echo date('d/m/Y', strtotime($start_date)); if(!$sehari_doang) echo " sampai " . date('d/m/Y', strtotime($end_date)) ?></big></strong>

<br/><br/>

<table class="rounded-corner sortable" id="main_table">
    <thead>
        <tr>
            <th width="25" class="rounded-company">No</th>
            <th>No. Transaksi</th>
            <th>Tanggal</th>
            <th>Agen</th>
            <th>Merek</th>
            <th>Model</th>
            <th>Warna</th>
            <th>Ukuran</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th class="rounded-q4">Refund</th>
        </tr>
    </thead>
    <tbody>
    <?php if (count($data_rekapan) == 0) : ?>
        <tr>
            <td colspan="11" style="text-align: center"><h1>Tidak ada data</h1></td>
        </tr>
    <?php else : $i = 1; foreach($data_rekapan as $data) : ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $data['id_order']; ?></td>
            <td><?php echo date('d/m/Y', strtotime($data['tanggal'])); ?></td>
            <td><?php echo $data['kode_agen']; ?> (<?php echo $data['agen']; ?>)</td>
            <td><?php echo $data['merek']; ?></td>
            <td><?php echo $data['model']; ?></td>
            <td><?php echo $data['warna']; ?></td>
            <td><?php echo $data['ukuran']; ?></td>
            <td style="text-align: right"><?php echo $data['jumlah']; ?></td>
            <td style="text-align: right"><?php echo number_format($data['harga'], 0, ',', '.'); ?></td>
            <td style="text-align: right"><?php echo number_format($data['refund'], 0, ',', '.'); ?></td>
        </tr>
    <?php
    $total_jumlah += $data['jumlah'];
    $total_harga  += $data['harga'];
    $total_keuntungan += $data['refund'];
    $i++; endforeach; endif; ?>
    </tbody>
    <tfoot>
        <tr style="font-size: 15px;">
            <td colspan="10" style="text-align: right"><strong>Total refund</strong></td>
            <td style="text-align: right"><?php echo number_format($total_keuntungan, 0, ',', '.'); ?></td>
        </tr>
    </tfoot>
</table>

<script type="text/javascript">

$(document).ready(function(){
    
   $('#main_table').tablesorter({cssHeader:'tablesorter-header',sortList: [[0,0]]});
    
});


</script>