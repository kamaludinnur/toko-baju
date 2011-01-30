<?php if(count($data_rekapan) > 0) : ?>
<form action="index.php/master/rekap/record_stok_xls" method="post" style="float: right; margin-bottom: 10px">
    <input type="hidden" name="start" value="<?php echo $start_date; ?>"/>
    <input type="hidden" name="end" value="<?php echo $end_date; ?>"/>
    <input type="submit" class="xls-button" value="Simpan XLS" title="Klik untuk menyimpan hasil rekap dalam bentuk file XLS"/>
</form>
<?php endif; ?>

<strong><big><?php echo count($data_rekapan); ?> record, tanggal <?php echo date('d/m/Y', strtotime($start_date)); if(!$sehari_doang) echo " sampai " . date('d/m/Y', strtotime($end_date)) ?></big></strong>

<br/><br/>

<table class="rounded-corner sortable" id="main_table">
    <thead>
        <tr>
            <th width="25" class="rounded-company">No</th>
            <th>Tanggal</th>
            <th>Merek</th>
            <th>Model</th>
            <th>Warna</th>
            <th>Ukuran</th>
            <th>Stok akhir</th>
            <th>Jenis transaksi</th>
        </tr>
    </thead>
    <tbody>
    <?php if (count($data_rekapan) == 0) : ?>
        <tr>
            <td colspan="8" style="text-align: center"><h1>Tidak ada data</h1></td>
        </tr>
    <?php else : $i = 1; foreach($data_rekapan as $data) : ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo date('d/m/Y', strtotime($data['tanggal'])); ?></td>
            <td><?php echo $data['merek']; ?></td>
            <td><?php echo $data['model']; ?></td>
            <td><?php echo $data['warna']; ?></td>
            <td><?php echo $data['ukuran']; ?></td>
            <td style="text-align: right"><?php echo $data['stok_akhir']; ?></td>
            <td><?php echo $data['jenis']; ?></td>
        </tr>
    <?php
    $i++; endforeach; endif; ?>
    </tbody>
</table>

<script type="text/javascript">

$(document).ready(function(){

   $('#main_table').tablesorter({cssHeader:'tablesorter-header',sortList: [[0,0]]});

});


</script>