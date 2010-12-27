<h2>Manajemen Produk</h2>

<h1>TODO: Sorting</h1>

<table class="rounded-corner" id="main_table">
    <thead>
        <tr>
            <th width="25" class="rounded-company">ID</th>
            <th width="">Model</th>
            <th width="">Warna</th>
            <th width="">Ukuran</th>
            <th width="">Stok</th>
            <th width="">Harga pembelian</th>
            <th width="">Harga penjualan</th>
            <th width="">Keterangan</th>
            <th width="120" class="rounded-q4">&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($daftar_produk) == 0) : ?>
        <tr>
            <td colspan="9">Belum ada data</td>
        </tr>
        <?php else : $i = 1; foreach($daftar_produk as $produk) : ?>
        <tr class="row" id="baris_<?php echo $produk['id'] ?>" >
            <td><?php echo $produk['id']; ?></td>
            <td><?php echo $produk['model']; ?></td>
            <td><?php echo $produk['warna']; ?></td>
            <td><?php echo $produk['ukuran']; ?></td>
            <td><?php echo $produk['stok']; ?></td>
            <td><?php echo $produk['harga_beli']; ?></td>
            <td><?php echo $produk['harga_jual']; ?></td>
            <td><?php echo $produk['keterangan']; ?></td>
            <td>&nbsp;</td>
        </tr>
        <?php $i++; endforeach; endif; ?>
    </tbody>
<!--    <tfoot>
        <tr>
            <td colspan="9">Tambahkan data</td>
        </tr>
        <tr>
            <form action="" id="form" method="post">
                <td class="rounded-foot-left"></td>
                <td><input type="text" size="30" maxlength="100" style="width: 100%" name="new_nama" id="new_nama"/></td>
                <td><input type="text" size="50" maxlength="255" style="width: 100%" name="new_keterangan" id="new_keterangan"/></td>
                <td class="rounded-foot-right"><input type="submit" value="+ Tambahkan" name="submit"/></td>
            </form>
        </tr>
    </tfoot> -->
</table>