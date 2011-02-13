<h2></h2>

<?php if($notfound) : ?>

<h2>Transaksi nomor <?php echo $nomor_transaksi; ?> tidak ditemukan</h2>

<?php else : ?>

<div style="float: right">
    <h3 style="display: inline-block">(<?php echo strtoupper($jenis_transaksi); ?>)</h3>
</div>

<h1>Transaksi nomor <?php echo $nomor_transaksi; ?></h1>
<h2>Tanggal <?php echo $order->tanggal; ?></h2>

<div class="infobox yellowbox">
    <strong>Atas nama agen: </strong><br/>
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
                <td><?php echo $item['model'] ?></td>
                <td><?php echo $item['warna'] ?></td>
                <td><?php echo $item['ukuran'] ?></td>
                <td style="text-align: right"><?php echo number_format($item['harga'], 0, ',', '.'); ?></td>
                <td style="text-align: right"><?php echo $item['jumlah'] ?></td>
                <td style="text-align: right"><?php echo number_format($item['harga'] * $item['jumlah'], 0, ',', '.'); ?></td>
            </tr>
        <?php $total += $item['harga'] * $item['jumlah'];
            $jumlah += $item['jumlah'];
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

<?php endif; ?>