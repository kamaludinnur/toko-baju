<script type="text/javascript">

    $(document).ready(function(){
        $('.left_content').remove();
        $('#sidebar_toggler').remove();
        $('#nav_buttons').remove();
    });

</script>

<h2></h2>
<div id="print_buttons">
    <input type="button" class="button orange" value="     Print     " onclick="window.print()"/>
    <input type="button" class="button blue" value="     Selesai     " onclick="location.href = 'index.php/<?php echo $return_page ?>'"/>
    <br/>
</div>

<h1>Transaksi No. <?php echo $nomer_transaksi ?></h1>

<h2>Tanggal <?php echo date("d/m/Y"); ?> (pukul <?php echo date("H:i"); ?>)</h2>

<div class="infobox yellowbox">
    <strong>Data Agen</strong><br/>
    <table border="0">
        <tr>
            <td>Kode</td>
            <td>: <?php echo $agen->kode; ?></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>: <?php echo $agen->nama; ?></td>
        </tr>
        <tr>
            <td>HP</td>
            <td>: <?php echo $agen->hp; ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: <?php echo $agen->alamat; ?></td>
        </tr>
        <tr>
            <td>Diskon</td>
            <td>: <?php echo round($agen->diskon, 2); ?>%</td>
        </tr>

    </table>

</div>

<br/>

<table class="rounded-corner" id="main_table">
    <thead>
        <tr>
            <th width="25" class="rounded-company">No</th>
            <th>Merek</th>
            <th>Model</th>
            <th>Warna</th>
            <th>Ukuran</th>
            <th>Harga Satuan</th>
            <th>Jumlah</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1;
        $total = 0;
        $jumlah = 0;
        foreach ($isi_transaksi as $item) { ?>
            <tr>
                <td><?php echo $i++ ?></td>
                <td><?php echo $item['merek'] ?></td>
                <td><?php echo $item['name'] ?></td>
                <td><?php echo $item['warna'] ?></td>
                <td><?php echo $item['ukuran'] ?></td>
                <td style="text-align: right"><?php echo number_format($item['price'], 0, ',', '.'); ?></td>
                <td style="text-align: right"><?php echo $item['qty'] ?></td>
                <td style="text-align: right"><?php echo number_format($item['subtotal'], 0, ',', '.'); ?></td>
            </tr>
        <?php $total += $item['subtotal'];
            $jumlah += $item['qty'];
        } ?>
    </tbody>
    <tfoot>
        <tr style="font-size: 12pt;">
            <td colspan="6" style="text-align: right"><strong>Total</strong></td>
            <td style="text-align: right"><strong><?php echo $jumlah; ?></strong></td>
            <td style="text-align: right"><strong><?php echo number_format($total, 0, ',', '.'); ?></strong></td>
        </tr>
    </tfoot>
</table>

<?php
        $q = $this->db->get_where('metode_pembayaran', array('id' => $metode_bayar))->result();
?>

        <p align="right">
            Pembayaran : <?php echo $q[0]->nama; ?>
        </p>

