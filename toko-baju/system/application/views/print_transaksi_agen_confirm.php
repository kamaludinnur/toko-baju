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
    <br/>
</div>

<table width="100%" border="0" cellspacing="7">
    <tr>
        <td width="60%" style="vertical-align: top">
            <img src="images/logo-outlet.jpg" alt=""/>
            <h2>Sabilla Distributor</h2>
            <strong>Distributor Outlet</strong>
            <br/>
            <br/>
            <small>
                Ruko Cibinong Mansion<br/>
                Jl. Raya Jakarta - Bogor KM. 46 Blok Tulip No. 22 Cibinong<br/>
                HP. 0819 3261 5666 / 0818 0495 1066
                Telp/Fax 021-8761066<br/>
                Cibinong - Bogor
            </small>
        </td>
        <td width="40%" style="vertical-align: top">
            <div style="text-align: right">
                <h2>Transaksi No. <?php echo $nomer_transaksi ?></h2>
            </div>
            Cibinong, <?php echo date("d/m/Y"); ?>
            <br/>
            <br/>
            <small>
            Kepada Yth,
            <p style="margin-left: 10px">
                <?php echo $agen->nama; ?> (kode <?php echo $agen->kode; ?>)<br/>
                <?php echo $agen->alamat; ?> <br/>Telp. <?php echo $agen->hp; ?>
            </p>
            </small>
        </td>
    </tr>
</table>

<?php if(isset($jenis)) : ?>
<div style="float: right">
    <h1 style="display: inline-block"><?php echo $jenis; ?></h1>
</div>
<?php endif; ?>

<br/>

<table class="rounded-corner" id="main_table">
    <thead>
        <tr>
            <th width="25" class="rounded-company">No</th>
            <th>Merek</th>
            <th>Model</th>
            <th>Warna</th>
            <th>Ukuran</th>
            <th>Diskon</th>
            <th>Harga Diskon</th>
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
                <td><?php echo round($agen->diskon, 2); ?>%</td>
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
            <td colspan="7" style="text-align: right"><strong>Total</strong></td>
            <td style="text-align: right"><strong><?php echo $jumlah; ?></strong></td>
            <td style="text-align: right"><strong><?php echo number_format($total, 0, ',', '.'); ?></strong></td>
        </tr>
    </tfoot>
</table>

<?php

if(isset($metode_bayar)) :

        $q = $this->db->get_where('metode_pembayaran', array('id' => $metode_bayar))->result();
?>

        <p align="right">
            <small>Pembayaran : <?php echo $q[0]->nama; ?></small>
        </p>

<?php endif; ?>

<br/>

<div style="text-align: right">

    <strong>Hormat kami,</strong>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    <br/>
    .........................

</div>