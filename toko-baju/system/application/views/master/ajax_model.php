<?php
if(count($daftar_model)>0){?>
<select name="model">
    <option>Pilih model:</option>
<?php
foreach ($daftar_model as $model)
{?>
    <option value="<?php echo $model['id'] ?>"><?php echo $model['nama']?></option>
<?php }
?>
</select>
<?php }
else{?>
    <div id="model">
        <select name="model" disabled>
            <option>Pilih model: </option>
        </select>

        Belum ada model. <a href="index.php/master/model_baju">Buat model baru</a>
    </div>
<?php }