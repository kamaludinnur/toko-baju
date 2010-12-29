<h2>Manajemen Agen</h2>

<div>Masukkan data pada kotak isian di bawah. Klik pada data untuk mengeditnya. <br/><em>Agen yang sudah pernah melakukan transaksi tidak dapat dihapus.</em></div>

<br/>

<div class="yellowbox">
    <h3 class="left_drop">Opsi</h3>
    <ul>
        <li>Urutkan berdasarkan
        <?php
        if($sort_by == 'id') echo "<strong>ID</strong> &middot; <a href='index.php/master/agen/manage/nama'>Nama</a> &middot; <a href='index.php/master/agen/manage/diskon'>Diskon</a>";
        if($sort_by == 'nama') echo "<a href='index.php/master/agen/manage'>ID</a> &middot; <strong>Nama</strong> &middot; <a href='index.php/master/agen/manage/diskon'>Diskon</a>";
        if($sort_by == 'diskon') echo "<a href='index.php/master/agen/manage'>ID</a> &middot; <a href='index.php/master/agen/manage/nama'>Nama</a> &middot; <strong>Diskon</strong>";
        ?>
        </li>
        <li>
            Filter agen <input type="text" size="20" name="search" id="filter"/>
        </li>
    </ul>
</div>

<br style="clear: both"/>

<table class="rounded-corner" id="main_table">
    <thead>
        <tr>
            <th width="25" class="rounded-company">ID</th>
            <th width="250">Agen</th>
            <th>Diskon</th>
            <th width="350">Keterangan</th>
            <th width="120" class="rounded-q4">&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($daftar_agen) == 0) : ?>
        <tr>
            <td colspan="5">Belum ada data</td>
        </tr>
        <?php else : $i = 1; foreach($daftar_agen as $agen) : ?>
        <tr class="row<?php if($id_agen_baru == $agen['id']) echo ' entri_baru'; ?> <?php if($i%2==0) echo "alt" ?>" id="baris_<?php echo $agen['id'] ?>" >
            <td onclick="showEditForm(<?php echo $agen['id']; ?>)"><?php echo $agen['id']; ?></td>
            <td onclick="showEditForm(<?php echo $agen['id']; ?>)"><?php echo $agen['nama']; ?></td>
            <td onclick="showEditForm(<?php echo $agen['id']; ?>)"><?php echo round($agen['diskon'], 2); ?>%</td>
            <td onclick="showEditForm(<?php echo $agen['id']; ?>)"><?php echo $agen['keterangan']; ?></td>
            <td>
                <input type="button" value="Edit" class="edit-in-place-btn" onclick="showEditForm(<?php echo $agen['id']; ?>)"/><input type="button" value="Hapus" class="edit-in-place-btn delete" <?php if (!$this->agen->aman_dihapus($agen['id'])) echo 'disabled' ?> onclick="hapus(<?php echo $agen['id']; ?>)"/>
            </td>
        </tr>
	<tr id="edit_<?php echo $agen['id'] ?>" class="editrow" style="display: none">
		<form action="" method="post" id="edit_form_<?php echo $agen['id'] ?>">
			<td><input type="hidden" name="id" value="<?php echo $agen['id'] ?>" /><?php echo $agen['id'] ?></td>
			<td><input type="text"   name="nama" id="nama_<?php echo $agen['id'] ?>" size="30" value="<?php echo $agen['nama'] ?>"  style="width: 100%"/></td>
                        <td><input type="text"   name="diskon" id="diskon_<?php echo $agen['id'] ?>" size="5" value="<?php echo round($agen['diskon'], 2) ?>"  style="width: 100%"/></td>
			<td><input type="text"   name="keterangan" id="keterangan_<?php echo $agen['id'] ?>" size="50" value="<?php echo $agen['keterangan'] ?>"  style="width: 100%"/></td>
			<td><input type="submit" name="edit_submit" id="edit_submit_btn_<?php echo $agen['id'] ?>" value="Simpan" class="e_formbtn_l" /><input onclick="hideEditForm(<?php echo $agen['id'] ?>)" type="button" value="Batal" id="btn_edit_batal" class="e_formbtn_r" /></td>
		</form>
	</tr>
        <?php $i++; endforeach; endif; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5">Tambahkan data</td>
        </tr>
        <tr>
            <form action="" id="form" method="post">
                <td class="rounded-foot-left"></td>
                <td><input type="text" size="30" maxlength="100" style="width: 100%" name="new_nama" id="new_nama"/></td>
                <td><input type="text" size="10" maxlength="100" style="width: 100%" name="new_diskon" id="new_diskon"/></td>
                <td><input type="text" size="50" maxlength="255" style="width: 100%" name="new_keterangan" id="new_keterangan"/></td>
                <td class="rounded-foot-right"><input type="submit" value="+ Tambahkan" name="submit" class="button blue"/></td>
            </form>
        </tr>
    </tfoot>
</table>

<script type="text/javascript">

$(document).ready(function(){

    var inputNama = $('#new_nama');

    $('#form').submit(function(){

        if(inputNama.val() == "" || $('#new_diskon').val() == "") return false;
       
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
