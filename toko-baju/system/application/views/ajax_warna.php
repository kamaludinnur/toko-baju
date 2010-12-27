<?php
if(count($daftar_warna)>0){?>
<select name="warna">
<?php
foreach ($daftar_warna as $warna)
{?>
    <option value="<?php echo $warna['id'] ?>" onclick="load_ukuran(<?php echo $warna['id']?>)"><?php echo $warna['nama']?></option>
<?php }
?>
</select>
<?php }
else{
    echo "Belum ada warna";
}