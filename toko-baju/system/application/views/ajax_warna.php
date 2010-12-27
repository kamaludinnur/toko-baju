<?php
if(count($daftar_warna)>0){?>
<select name="warna">
    <option>--Warna--</option>
<?php
foreach ($daftar_warna as $warna)
{?>
    <option value="<?php echo $warna['id'] ?>" onclick="load_ukuran(<?php echo $model_baju . "," . $warna['id']?>)"><?php echo $warna['nama']?></option>
<?php }
?>
</select>
<?php }
else{?>
    <div id="warna">
        <select name="model" disabled>
            <option>--Warna--</option>
        </select>
    </div>
<?php }