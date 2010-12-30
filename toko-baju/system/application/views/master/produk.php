<h2>Manajemen Produk</h2>

<p>Berikut ini daftar semua produk yang sudah dientri. Klik pada judul kolom tabel untuk mengurutkannya. <br/>Produk yang sudah pernah ditransaksikan tidak dapat dihapus atau diedit lagi.</p>

<div class="new_product" style="float: left">
    <input type="submit" name="submit" value="Entri produk &raquo;" class="button blue" title="Klik untuk mengentri produk baru" onclick="location.href='index.php/master/produk/entri'"/>
    <input type="submit" name="submit" value="Filter<?php if($is_filtered) echo " ($filter_count kriteria)" ?>" class="button <?php echo ($is_filtered) ? "orange" : "blue"?>" title="Klik untuk memfilter produk berdasarkan kriteria tertentu" onclick="$('#filterbox').slideToggle();"/>
</div>

<div class="pagination">
<?php echo $page_links; ?>
</div>

<?php $operators = array('=', '<', '<=', '>', '>='); ?>

<br/>

<div class="yellowbox" id="filterbox" style="display: none">
    <?php //print_r($filter_value); ?>
    <form action="index.php/master/produk/filter" method="post" id="filter_form">

        <table width="100%">
            <tr>
                <td>Merek:</td>
                <td><input type="text" id="merek" name="f_merek" size="20" value="<?php echo $this->session->userdata('prod_filter_input_0'); ?>"/></td>
            </tr>
            <tr>                
                <td>Model:</td>
                <td><input type="text" id="model" name="f_model" size="20" value="<?php echo $this->session->userdata('prod_filter_input_1'); ?>"/></td>
            </tr>
            <tr>
                <td>Warna:</td>
                <td><input type="text" id="warna" name="f_warna" size="20" value="<?php echo $this->session->userdata('prod_filter_input_2'); ?>"/></td>
            </tr>
            <tr>
                <td>Ukuran:</td>
                <td><input type="text" id="ukuran" name="f_ukuran" size="5" value="<?php echo $this->session->userdata('prod_filter_input_3'); ?>"/></td>
            </tr>
            <tr>
                <td>Stok:</td>
                <td>
                    <select name="f_stok_op">
                        <?php foreach ($operators as $o) {
                            echo "<option value='$o'";
                            echo ($this->session->userdata('prod_filter_input_4_op') == $o) ? "selected='selected'" : "";
                            echo ">$o</option>";
                        }; ?>
                    </select>
                    <input type="text" id="stok" name="f_stok" size="5" value="<?php echo $this->session->userdata('prod_filter_input_4'); ?>"/>
                </td>               
            </tr>
            <tr>
                <td>Harga beli:</td>
                <td>
                    <select name="f_hb_op">
                        <?php foreach ($operators as $o) {
                            echo "<option value='$o'";
                            echo ($this->session->userdata('prod_filter_input_5_op') == $o) ? "selected='selected'" : "";
                            echo ">$o</option>";
                        }; ?>                    </select>
                    <input type="text" id="hb" name="f_hb" size="10" value="<?php echo $this->session->userdata('prod_filter_input_5'); ?>"/>
                </td>                
            </tr>
            <tr>
                <td>Harga jual:</td>
                <td>
                    <select name="f_hj_op">
                        <?php foreach ($operators as $o) {
                            echo "<option value='$o'";
                            echo ($this->session->userdata('prod_filter_input_6_op') == $o) ? "selected='selected'" : "";
                            echo ">$o</option>";
                        }; ?>                    </select>
                    <input type="text" id="hj" name="f_hj" size="10" value="<?php echo $this->session->userdata('prod_filter_input_6'); ?>"/>
                </td>                
            </tr>
            <tr>
                <td>Keterangan:</td>
                <td>
                    <input type="text" id="ktr" name="f_ktr" size="20" value="<?php echo $this->session->userdata('prod_filter_input_7'); ?>"/>
                </td>                
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" value="Filter" class="button blue"/>
                    <a href="#" onclick="$('#filter_form input[type=text]').val(''); $('select option:first-child').attr('selected', 'selected'); $('#filter_form').submit(); return false;">Hapus filter</a>
                </td>
            </tr>
        </table>

    </form>
    <script type="text/javascript">

    $('#merek').autocompleteArray("<?php foreach ($daftar_merek as $merek) echo $merek['nama'] . ";" ?>".split(";"), {autoFill:true, delay:10,selectFirst:true,selectOnly:true});
    $('#model').autocompleteArray("<?php foreach ($daftar_model as $model) echo $model['nama'] . ";" ?>".split(";"), {autoFill:true, delay:10,selectFirst:true,selectOnly:true});
    $('#warna').autocompleteArray("<?php foreach ($daftar_warna as $warna) echo $warna['nama'] . ";" ?>".split(";"), {autoFill:true, delay:10,selectFirst:true,selectOnly:true});
    $('#ukuran').autocompleteArray("<?php foreach ($daftar_ukuran as $ukuran) echo $ukuran['nama'] . ";" ?>".split(";"), {autoFill:true, delay:10,selectFirst:true,selectOnly:true});
    
    </script>

</div>

<br/>

<table class="rounded-corner sortable" id="main_table">
    <thead>
        <tr>
            <th width="25" class="rounded-company">No</th>
            <th class="<?php if(strpos($this->session->userdata('prod_sort_0'), 'merek') !== FALSE) echo substr($this->session->userdata('prod_sort_0'), 6); ?>">
                <a href="index.php/master/produk/sort/merek<?php if($this->session->userdata('prod_sort_0') == 'merek ASC') echo '/DESC' ?>">Merek</a>
            </th>
            <th class="<?php if(strpos($this->session->userdata('prod_sort_0'), 'model') !== FALSE) echo substr($this->session->userdata('prod_sort_0'), 6); ?>">
                <a href="index.php/master/produk/sort/model<?php if($this->session->userdata('prod_sort_0') == 'model ASC') echo '/DESC' ?>">Model</a>
            </th>
            <th class="<?php if(strpos($this->session->userdata('prod_sort_0'), 'warna') !== FALSE) echo substr($this->session->userdata('prod_sort_0'), 6); ?>">
                <a href="index.php/master/produk/sort/warna<?php if($this->session->userdata('prod_sort_0') == 'warna ASC') echo '/DESC' ?>">Warna</a>
            </th>
            <th class="<?php if(strpos($this->session->userdata('prod_sort_0'), 'ukuran') !== FALSE) echo substr($this->session->userdata('prod_sort_0'), 7); ?>">
                <a href="index.php/master/produk/sort/ukuran<?php if($this->session->userdata('prod_sort_0') == 'id_ukuran ASC') echo '/DESC' ?>">Ukuran</a>
            </th>
            <th class="<?php if(strpos($this->session->userdata('prod_sort_0'), 'stok') !== FALSE) echo substr($this->session->userdata('prod_sort_0'), 5); ?>">
                <a href="index.php/master/produk/sort/stok<?php if($this->session->userdata('prod_sort_0') == 'stok ASC') echo '/DESC' ?>">Stok</a>
            </th>
            <th class="<?php if(strpos($this->session->userdata('prod_sort_0'), 'harga_beli') !== FALSE) echo substr($this->session->userdata('prod_sort_0'), 11); ?>">
                <a href="index.php/master/produk/sort/harga_beli<?php if($this->session->userdata('prod_sort_0') == 'harga_beli ASC') echo '/DESC' ?>">Harga pembelian</a>
            </th>
            <th class="<?php if(strpos($this->session->userdata('prod_sort_0'), 'harga_jual') !== FALSE) echo substr($this->session->userdata('prod_sort_0'), 11); ?>">
                <a href="index.php/master/produk/sort/harga_jual<?php if($this->session->userdata('prod_sort_0') == 'harga_jual ASC') echo '/DESC' ?>">Harga penjualan</a>
            </th>
            <th>Keterangan</th>
            <th style="width: 70px" class="rounded-q4">&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($daftar_produk) == 0) : ?>
        <tr>
            <td colspan="10">Belum ada data</td>
        </tr>
        <?php else : $i = $this->uri->segment(4, 0) + 1; foreach($daftar_produk as $produk) : ?>
        <tr <?php if($i%2 == 0) echo "class='alt'" ; ?> id="baris_<?php echo $produk['id'] ?>" >
            <td><?php echo $i; ?></td>
            <td><?php echo $produk['merek']; ?></td>
            <td><?php echo $produk['model']; ?></td>
            <td><?php echo $produk['warna']; ?></td>
            <td><?php echo $produk['ukuran']; ?></td>
            <td style="text-align: right" id="data_stok_<?php echo $produk['id'] ?>"><?php echo $produk['stok']; ?></td>
            <td style="text-align: right" id="data_hb_<?php echo $produk['id'] ?>"><?php echo number_format($produk['harga_beli'], 0, ',', '.'); ?></td>
            <td style="text-align: right" id="data_hj_<?php echo $produk['id'] ?>"><?php echo number_format($produk['harga_jual'], 0, ',', '.'); ?></td>
            <td id="data_ktr_<?php echo $produk['id'] ?>"><?php echo $produk['keterangan']; ?></td>
            <td>
                <input type="button" value="" class="edit-in-place-btn tambahstok icon_only" title="Tambah stok untuk produk ini" onclick="tambahStok(<?php echo $produk['id'] ?>)"/><input type="button" value="" class="edit-in-place-btn icon_only" <?php if (!$this->produk->aman_diedit($produk['id'])) echo 'disabled="disabled"' ?> onclick="editProduk(<?php echo $produk['id']; ?>)" title="Klik untuk mengedit produk ini" id="edit_btn_<?php echo $produk['id']; ?>"/><input type="button" value="" class="edit-in-place-btn delete icon_only" <?php if (!$this->produk->aman_dihapus($produk['id'])) echo 'disabled="disabled"' ?> onclick="hapus(<?php echo $produk['id']; ?>)" title="Klik untuk menghapus produk ini"/>
            </td>
        </tr>
        <?php $i++; endforeach; endif; ?>
    </tbody>
</table>

<br/>

<div class="new_product" style="float: left">
    <input type="submit" name="submit" value="Entri produk &raquo;" class="button blue" title="Klik untuk mengentri produk baru" onclick="location.href='index.php/master/produk/entri'"/>
</div>


<div class="pagination">
<?php echo $page_links; ?>
</div>

<script type="text/javascript">

function tambahStok(id){

    $.colorbox({
        href:'index.php/master/produk/tambah_stok/' + id,
        width:'500px',
        opacity: 0.5,
        onComplete: function(){$('#j').focus()}
    });

}

function hapus(id){
    if(confirm("Yakin ingin menghapus data ini?")){
        $.ajax({
           url: 'index.php/master/produk/hapus/' + id,
           dataType: 'text',
           success: function(data){
               if(data == 1){
                   $('#baris_' + id).fadeOut('slow', function(){$(this).remove()});
               } else alert("Kesalahan: gagal menghapus data!");
           },
           error: function(){
               alert("Kesalahan: gagal menghapus data!");
           }
        });
    }
}

function editProduk(id){
    $.colorbox({
        href:'index.php/master/produk/edit/' + id,
        width:'500px',
        opacity: 0.5
    });
}

</script>