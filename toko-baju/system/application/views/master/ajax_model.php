<?php if (count($daftar_model) > 0) { ?>
    <select name="model" id="id_model">
        <option>Pilih model:</option>
<?php
    foreach ($daftar_model as $model) {
 ?>
        <option value="<?php echo $model['id'] ?>"><?php echo $model['nama'] ?></option>
<?php }
?>
</select>
atau <a href="#" title="Tambahkan model baru" onclick="$.colorbox({href:'index.php/master/model_baju/tambah_untuk_merek/<?php echo $merek; ?>', width:'500px', height:'270px', onComplete: function(){$('#n').focus()}}); return false;">Tambah model baru</a>
<?php } else { ?>
<select name="model" id="id_model" disabled>
    <option>Pilih model: </option>
</select>
<?php if($merek != 0) { ?>
Belum ada model untuk <?php echo $this->merek->get_merek($merek)->nama; ?>. <a href="index.php/master/model_baju/tambah_untuk_merek/<?php echo $merek; ?>" onclick="$.colorbox({href:this.href, width:'500px', height:'270px', onComplete: function(){$('#n').focus()}}); return false;">Tambah model baru</a>
<?php
}}