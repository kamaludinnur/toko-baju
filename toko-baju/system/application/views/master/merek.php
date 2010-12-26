<h2>Manajemen Merek</h2>

<div>Masukkan data pada kotak isian di bawah. Klik pada data untuk mengeditnya.</div>

<br/>

<table class="tabel_merek">
    <thead>
        <tr>
            <th width="25">ID</th>
            <th width="250">Merek</th>
            <th width="350">Keterangan</th>
            <th width="120">&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($daftar_merek) == 0) : ?>
        <tr>
            <td colspan="4">Belum ada data</td>
        </tr>
        <?php else : $i = 1; foreach($daftar_merek as $merek) : ?>
        <tr class="row<?php if($this->session->flashdata('id_merek_baru') == $merek['id']) echo ' entri_baru'; ?>" id="baris_<?php echo $merek['id'] ?>" >
            <td onclick="showEditForm(<?php echo $merek['id']; ?>)"><?php echo $merek['id']; ?></td>
            <td onclick="showEditForm(<?php echo $merek['id']; ?>)"><?php echo $merek['nama']; ?></td>
            <td onclick="showEditForm(<?php echo $merek['id']; ?>)"><?php echo $merek['keterangan']; ?></td>
            <td onclick="showEditForm(<?php echo $merek['id']; ?>)"><input type="button" value="Edit"/></td>
        </tr>
	<tr id="edit_<?php echo $merek['id'] ?>" class="editrow" style="display: none">
		<form action="index.php/master/merek/update" method="post" id="edit_form_<?php echo $merek['id'] ?>">
			<td><input type="hidden" name="id" value="<?php echo $merek['id'] ?>" /><?php echo $merek['id'] ?></td>
			<td><input type="text"   name="nama" id="nama_<?php echo $merek['id'] ?>" size="30" value="<?php echo $merek['nama'] ?>"  style="width: 100%"/></td>
			<td><input type="text"   name="keterangan" id="keterangan_<?php echo $merek['id'] ?>" size="50" value="<?php echo $merek['keterangan'] ?>"  style="width: 100%"/></td>
			<td><input type="submit" name="edit_submit" id="edit_submit_btn_<?php echo $merek['id'] ?>" value="Simpan" class="e_formbtn_l" /><input onclick="hideEditForm(<?php echo $merek['id'] ?>)" type="button" value="Batal" id="btn_edit_batal" class="e_formbtn_r" /></td>
		</form>
	</tr>
        <?php $i++; endforeach; endif; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4">Tambahkan data</td>
        </tr>
        <tr>
            <form action="index.php/master/merek/insert" id="form" method="post">
                <td></td>
                <td><input type="text" size="30" maxlength="100" style="width: 100%" name="new_nama" id="new_nama"/></td>
                <td><input type="text" size="50" maxlength="255" style="width: 100%" name="new_keterangan" id="new_keterangan"/></td>
                <td><input type="submit" value="+ Tambahkan"/></td>
            </form>
        </tr>
    </tfoot>
</table>

<script type="text/javascript">

$(document).ready(function(){

    var inputNama = $('#new_nama');

    inputNama.focus();
    $('#form').submit(function(){

        if(inputNama.val() == "") return false;
       
    });
    $('.entri_baru').css({backgroundColor : 'yellow'});

})

function showEditForm(id) {
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

</script>