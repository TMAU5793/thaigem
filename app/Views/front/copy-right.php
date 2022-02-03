<div class="copy-right ff-dbadman">
    <div class="container">
        <div class="row">
            <div class="col-6">
                <span class="fs-19px">© 2021 TGJTA All Rights Reserved.</span>
            </div>
            <div class="col-6 text-end">
                <a href="<?= site_url('policy'); ?>" class="fs-19px"><?= lang('GlobalLang.policy') ?></a>
                <!-- <a href="<?= site_url('terms'); ?>" class="fs-19px"><?= lang('GlobalLang.termServices') ?></a> -->
            </div>
        </div>
    </div>
</div>

<?php
    helper('cookie');
    if(!get_cookie('ckpopup')) {
?>
    <div class="cookie-policy">
        <span class="d-block"><?= lang('GlobalLang.cookie') ?> <a href="<?= site_url('policy') ?>"><?= lang('GlobalLang.policy') ?></a></span>
        <button class="btn btn-black mt-3 fs-5" id="btn-cookie" onclick="setCookie()"><?= lang('GlobalLang.comfirm') ?></button>
    </div>
<?php } ?>
<!-- Loading event -->
<div class="loading d-none"></div>