<?php
if(count($daftar_ukuran)>0){?>
<select name="id">
    <option>--ukuran--</option>
<?php
foreach ($daftar_ukuran as $ukuran)
{?>
    <option value="<?php echo $ukuran['id'] ?>" onclick="load_stok(<?php echo $ukuran['id']?>)"><?php echo $ukuran['nama']?></option>
<?php }
?>
</select>
<?php }
else{?>
    <div id="ukuran">
        <select name="id" disabled>
            <option>--ukuran--</option>
        </select>
    </div>
<?php }