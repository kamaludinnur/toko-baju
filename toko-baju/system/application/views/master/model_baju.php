<h2>Manajemen Model</h2>

<div>Masukkan data pada kotak isian di bawah. Klik pada data untuk mengeditnya. <br/><em>Data yang sudah dimasukkan tidak dapat dihapus.</em></div>

<br/>

<div class="yellowbox">
    <h3 class="left_drop">Opsi</h3>
    <ul>
        <li>Urutkan berdasarkan
        <?php
        if($sort_by == 'id') echo "<strong>ID</strong> &middot; <a href='index.php/master/model_baju/manage/nama'>Nama</a> &middot; <a href='index.php/master/model_baju/manage/merek'>Merek</a>";
        if($sort_by == 'nama') echo "<a href='index.php/master/model_baju/manage'>ID</a> &middot; <strong>Nama</strong> &middot; <a href='index.php/master/model_baju/manage/merek'>Merek</a>";
        if($sort_by == 'merek') echo "<a href='index.php/master/model_baju/manage'>ID</a> &middot; <a href='index.php/master/model_baju/manage/nama'>Nama</a> &middot; <strong>Merek</strong>";
        ?>
        </li>
        <li>
            Filter model <input type="text" size="20" name="search" id="filter"/>
        </li>
    </ul>
</div>

<br style="clear: both"/>

<table  class="rounded-corner" id="main_table">
    <thead>
        <tr>
            <th width="25">ID</th>
            <th width="250">Model</th>
            <th width="250">Merek</th>
            <th width="350">Keterangan</th>
            <th width="120">&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($daftar_model_baju) == 0) : ?>
        <tr>
            <td colspan="5">Belum ada data</td>
        </tr>
        <?php else : $i = 1; foreach($daftar_model_baju as $model_baju) : ?>
        <tr class="row<?php if($id_model_baju_baru == $model_baju['id']) echo ' entri_baru'; ?> <?php if($i%2==0) echo "alt" ?>" id="baris_<?php echo $model_baju['id'] ?>" >
            <td onclick="showEditForm(<?php echo $model_baju['id']; ?>)"><?php echo $model_baju['id']; ?></td>
            <td onclick="showEditForm(<?php echo $model_baju['id']; ?>)"><?php echo $model_baju['nama']; ?></td>
            <td onclick="showEditForm(<?php echo $model_baju['id']; ?>)"><?php echo $this->merek->get_merek($model_baju['merek'])->nama; ?></td>
            <td onclick="showEditForm(<?php echo $model_baju['id']; ?>)"><?php echo $model_baju['keterangan']; ?></td>
            <td onclick="showEditForm(<?php echo $model_baju['id']; ?>)"><input type="button" value="Edit"  class="edit-in-place-btn"/></td>
        </tr>
	<tr id="edit_<?php echo $model_baju['id'] ?>" class="editrow" style="display: none">
		<form action="" method="post" id="edit_form_<?php echo $model_baju['id'] ?>">
			<td><input type="hidden" name="id" value="<?php echo $model_baju['id'] ?>" /><?php echo $model_baju['id'] ?></td>
			<td><input type="text"   name="nama" id="nama_<?php echo $model_baju['id'] ?>" size="30" value="<?php echo $model_baju['nama'] ?>"  style="width: 100%"/></td>
                        <td>
                            <select name="merek">
                                <?php foreach ($daftar_merek as $merek)
                                    { ?>
                                <option value="<?php echo $merek['id']?>" <?php if ($merek['id']==$model_baju['merek']) echo 'selected'?>><?php echo $merek['nama']?></option>
                                <?php }?>
                            </select>
                        </td>
			<td><input type="text"   name="keterangan" id="keterangan_<?php echo $model_baju['id'] ?>" size="50" value="<?php echo $model_baju['keterangan'] ?>"  style="width: 100%"/></td>
			<td><input type="submit" name="edit_submit" id="edit_submit_btn_<?php echo $model_baju['id'] ?>" value="Simpan" class="e_formbtn_l" /><input onclick="hideEditForm(<?php echo $model_baju['id'] ?>)" type="button" value="Batal" id="btn_edit_batal" class="e_formbtn_r" /></td>
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
                <td></td>
                <td><input type="text" size="30" maxlength="100" style="width: 100%" name="new_nama" id="new_nama"/></td>
                <td><select name="new_merek" style="width: 100%">
                        <?php foreach ($daftar_merek as $merek)
                            { ?>
                        <option value="<?php echo $merek['id']?>"><?php echo $merek['nama']?></option>
                        <?php }?>
                    </select></td>
                <td><input type="text" size="50" maxlength="255" style="width: 100%" name="new_keterangan" id="new_keterangan"/></td>
                <td><input type="submit" value="+ Tambahkan" name="submit" class="button blue"/></td>
            </form>
        </tr>
    </tfoot>
</table>

<script type="text/javascript">

$(document).ready(function(){

    var inputNama = $('#new_nama');

    $('#form').submit(function(){

        if(inputNama.val() == "") return false;

    });
    $('.entri_baru').css({backgroundColor : 'yellow'});

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


</script>