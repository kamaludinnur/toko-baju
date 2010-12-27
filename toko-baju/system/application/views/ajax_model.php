<?php
if(count($daftar_model)>0){?>
<select name="model">
<?php
foreach ($daftar_model as $model)
{?>
    <option value="<?php echo $model['id'] ?>" onclick="load_warna(<?php echo $model['id']?>)"><?php echo $model['nama']?></option>
<?php }
?>
</select>
<?php }
else{
    echo "Belum ada model";
}