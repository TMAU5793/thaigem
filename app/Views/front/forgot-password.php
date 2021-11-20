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
        if(isset($resetpass) && $expire==false){
    ?>
        <section class="resetpass-content vh-100">
            <div class="container">
                <div class="tg-title mt-5 text-center">
                    <h3 class="ff-dbadmanBold"><?= lang('GlobalLang.resetpass') ?></h3>
                    <p><?= lang('GlobalLang.resetText') ?></p>
                </div>
                <?php if(isset($validation)): ?>
                    <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
                <?php endif;?>
                <form action="<?= site_url('member/update_password') ?>" method="POST">
                    <input type="hidden" name="hd_token" value="<?= (!empty($_GET) ? $_GET['tk'] : $token) ?>">
                    <input type="hidden" name="hd_member" value="<?= (isset($member_id) ? $member_id : '') ?>">
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
    <?php }else{ ?>
        <div class="container vh-100">
            <div class="alert alert-danger mt-5 mb-5 text-center">
                <span><?= lang('GlobalLang.linkExpire') ?></span>
                <a href="<?= site_url('member/forgotpassword') ?>"><?= lang('GlobalLang.resetpass') ?></a>
            </div>
        </div>
    <?php } ?>

<?= $this->endSection() ?>