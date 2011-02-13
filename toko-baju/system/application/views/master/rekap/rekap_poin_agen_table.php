<?php $total_poin = 0 ?>

<?php if(isset($is_range)) : ?>
<strong><big>Tanggal <?php echo date('d/m/Y', strtotime($start_date)); if($start_date != $end_date) echo " sampai " . date('d/m/Y', strtotime($end_date)) ?></big></strong>
<br/><br/>
<?php endif; ?>

<table class="rounded-corner sortable" id="main_table">
    <thead>
        <tr>
            <th width="25" class="rounded-company">No</th>
            <th>Tanggal</th>
            <th>No. Transaksi</th>
            <th>Total</th>
            <th class="rounded-q4">Poin</th>
        </tr>
    </thead>
    <tbody>
    <?php if (count($data_rekapan) == 0) : ?>
        <tr>
            <td colspan="5" style="text-align: center"><h1>Tidak ada data</h1></td>
        </tr>
    <?php else : $i = 1; foreach($data_rekapan as $data) : ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo date('d/m/Y', strtotime($data['tanggal'])); ?></td>
            <td><?php echo $data['no_transaksi']; ?></td>
            <td style="text-align: right"><?php echo number_format($data['total'], 0, ',', '.'); ?></td>
            <td style="text-align: right"><?php echo $data['poin']; ?></td>
        </tr>
    <?php
    $total_poin += $data['poin'];
    $i++; endforeach; endif; ?>
    </tbody>
    <tfoot>
        <tr style="font-size: 15px;">
            <td colspan="4" style="text-align: right"><strong>Total poin</strong></td>
            <td style="text-align: right"><?php echo $total_poin; ?></td>
        </tr>
    </tfoot>
</table>

<script type="text/javascript">

$(document).ready(function(){
    
   $('#main_table').tablesorter({cssHeader:'tablesorter-header',sortList: [[0,0]]});
    
});


</script>