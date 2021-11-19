<?= $this->extend("front/app") ?>
<?= $this->section("content") ?>

    <?php
        if(!isset($resetpass)){
    ?>
        <section class="forgot-content vh-100">
            <div class="container">
                <div class="tg-title mt-5 text-center">
                    <h3 class="ff-dbadmanBold"><?= lang('GlobalLang.forgot') ?></h3>
                    <p><?= lang('GlobalLang.forgotText') ?></p>
                </div>
                <form action="<?= site_url('member/emailforgot') ?>" method="POST">
                    <div class="input-form mb-3">
                        <label for=""><?= lang('GlobalLang.u-name-mail') ?></label>
                        <input type="email" class="form-control" name="txt_email" placeholder="example@mail.com" required>
                        <input type="hidden" name="hd_token" value="<?= csrf_hash() ?>">
                    </div>
                    <button type="submit" class="btn-black-border"><?= lang('GlobalLang.comfirm') ?></button>
                </form>
            </div>
        </section>
    <?php } ?>

    <?php
        if(isset($resetpass)){
    ?>
        <section class="resetpass-content vh-100">
            <div class="container">
                <div class="tg-title mt-5 text-center">
                    <h3 class="ff-dbadmanBold"><?= lang('GlobalLang.resetpass') ?></h3>
                    <p><?= lang('GlobalLang.resetText') ?></p>
                </div>
                <form action="<?= site_url('member/update_password') ?>" method="POST">
                    <div class="input-form mb-3">
                        <label for=""><?= lang('GlobalLang.newpassword') ?></label>
                        <input type="password" class="form-control" name="txt_newpassword" required>
                    </div>
                    <div class="input-form mb-3">
                        <label for=""><?= lang('GlobalLang.comfirmPassword') ?></label>
                        <input type="password" class="form-control" name="txt_cfpassword" required>
                    </div>
                    <button type="submit" class="btn-black-border"><?= lang('GlobalLang.comfirm') ?></button>
                </form>
            </div>
        </section>
    <?php } ?>

<?= $this->endSection() ?>