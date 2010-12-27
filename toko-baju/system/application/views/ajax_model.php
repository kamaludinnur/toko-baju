<?php
if(count($daftar_model)>0){?>
<select name="model">
    <option>--Model--</option>
<?php
foreach ($daftar_model as $model)
{?>
    <option value="<?php echo $model['id'] ?>" onclick="load_warna(<?php echo $model['id']?>); load_ukuran(0)"><?php echo $model['nama']?></option>
<?php }
?>
</select>
<?php }
else{?>
    <div id="model">
        <select name="model" disabled>
            <option>--Model--</option>
        </select>
    </div>
<?php }