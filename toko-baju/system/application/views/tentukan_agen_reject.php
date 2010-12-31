<h2>Pilih Agen</h2>
<form action="" method="POST">
    <div id="agen">
        <select name="agen">
            <?php
            foreach ($daftar_agen as $agen){
            ?>
            <option value="<?php echo $agen['id']?>" onclick="window.location='index.php/reject_agen/pilih_agen/<?php echo $agen['id']?>'"><?php echo $agen['kode']?>, <?php echo $agen['nama']?></option>
            <?php }?>
        </select>
    </div>
</form>
