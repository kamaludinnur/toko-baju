<h2>Transaksi Pelunasan</h2>

Berikut ini daftar Agen yang memiliki transaksi yang belum lunas.

<br style="clear: both"/>
<br/>


<br/>

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
                <input type="button" value="" class="edit-in-place-btn tambahstok icon_only" title="Tambah Pembayaran" onclick="location.href='index.php/transaksi_pelunasan/add/<?php echo $produk['order_id']?>'" />
            </td>
        </tr>
        <?php $i++; endforeach; endif; ?>
    </tbody>
</table>

<br/>
