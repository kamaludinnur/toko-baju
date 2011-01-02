<h2>Pilih Agen</h2>

<div class="yellowbox">
    <h3 class="left_drop">Agen</h3>
    <form action="" method="post">
        <div id="agen">
            <select name="agen">
                <?php
                foreach ($daftar_agen as $agen){
                ?>
                <option value="<?php echo $agen['id']?>" onclick="window.location='index.php/retur_agen/pilih_agen/<?php echo $agen['id']?>'"><?php echo $agen['kode']?>, <?php echo $agen['nama']?></option>
                <?php }?>
            </select>
        </div>
    </form>
</div>