<?php
if(count($daftar_ukuran)>0){?>
<select name="ukuran">
    <option>--ukuran--</option>
<?php
foreach ($daftar_ukuran as $ukuran)
{?>
    <option value="<?php echo $ukuran['id'] ?>"><?php echo $ukuran['nama']?></option>
<?php }
?>
</select>
<?php }
else{?>
    <div id="ukuran">
        <select name="ukuran" disabled>
            <option>--ukuran--</option>
        </select>
    </div>
<?php }