<div class="form">
    <form action="" method="post" id="form">

    <?php if(isset($password_diganti)) : ?>
    <div class="valid_box">
        Password sudah diganti
    </div>
    <?php else : ?>

        <fieldset>

            <?php if(isset($password_lama_salah)) : ?>
            <div class="error_box">
                Password lama salah
            </div>
            <?php endif; ?>

            <div class="error_box" id="unmatch" style="display: none">
                Kedua password baru harus cocok
            </div>

            <dl>
                <dt><label>Password lama</label></dt>
                <dd><input type="password" name="password_lama" id="pl" size="20" /></dd>
            </dl>

            <dl>
                <dt><label>Password baru</label></dt>
                <dd><input type="password" name="password_baru" id="pb" size="20" /></dd>
            </dl>

            <dl>
                <dt><label>Ulangi password baru</label></dt>
                <dd><input type="password" name="password_baru2" id="pb2" size="20" /></dd>
            </dl>

            <dl>
                <dt></dt>
                <dd>
                    <input type="submit" name="submit" id="submit" value="Simpan" class="button blue" onclick="return submitGanti();" />
                </dd>
            </dl>

        </fieldset>

    <?php endif; ?>

    </form>
</div>

<script type="text/javascript">

function submitGanti(){

    if($('#pb').val() != $('#pb2').val()) {
        $('#unmatch').show();
        $('#pb2').focus();
        return false;
    } else return true;

}

</script>