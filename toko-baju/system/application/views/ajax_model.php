<?php
if(count($daftar_model)>0){?>
<select name="model" onchange="load_warna(this.value); load_ukuran(0,0)">
    <option>--Model--</option>
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
            <option>--Model--</option>
        </select>
    </div>
<?php }