<!-- Modal Login -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">                
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <strong class="ff-semibold fs-4"><?= lang('GlobalLang.signin') ?></strong>
                    <p>Lorem Ipsum is simply dummy text and typesetting industry. Lorem Ip the dummy text industry.</p>                    
                </div>
                <form action="<?= base_url('account/login'); ?>" method="POST">                    
                    <div class="input-nobg plr-2rem">
                        <?php if(isset($signin_valid)): ?>
                            <div class="alert alert-danger"><?= $signin_valid->listErrors(); ?></div>
                        <?php endif;?>
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" name="txt_username" placeholder="<?= lang('GlobalLang.userName') ?> *" value="<?= (isset($signin_valid)?set_value('txt_username'):''); ?>">
                        </div>
                        <div class="form-group mb-3">
                            <input type="password" class="form-control" name="txt_password" placeholder="<?= lang('GlobalLang.password') ?> *" autocomplete="new-password">
                        </div>
                        <button type="submit" class="btn bg-lightgold ff-semibold w-100 text-uppercase"><?= lang('GlobalLang.signin') ?></button>
                    </div>
                </form>
                <a href="<?= site_url('forgotpassword') ?>" class="text-uppercase mt-3 d-block text-center c-black text-decoration-none"><?= lang('GlobalLang.forgot') ?></a>
                <div class="login-with-social plr-2rem mt-3">
                    <!-- <a href="<?= site_url('loginfacebook'); ?>" class="btn bg-lightgold ff-semibold text-uppercase d-block w-100 mb-3"> <?= lang('GlobalLang.signFacebook') ?></a> -->
                    <a href="javascript:void(0)" onclick="loginFacebook();" class="btn bg-lightgold ff-semibold text-uppercase d-block w-100 mb-3"> <?= lang('GlobalLang.signFacebook') ?></a>
                    <a href="<?= site_url('logingoogle'); ?>" class="btn bg-lightgold ff-semibold text-uppercase d-block w-100"> <?= lang('GlobalLang.signGmail') ?></a>
                </div>
                <div class="signup-account text-center p-3">
                    <strong class="ff-semibold fs-4 d-block"><?= lang('GlobalLang.createAccount') ?></strong>
                    <span><?= lang('GlobalLang.notMember') ?></span>
                    <a href="" class="ff-semibold c-black text-decoration-none text-uppercase" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#registerModal"><?= lang('GlobalLang.register') ?></a>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal Register -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">                
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <strong class="ff-semibold fs-4"><?= lang('GlobalLang.createAccount') ?></strong>              
                </div>
                <form id="frm_register" action="<?= site_url('account/register'); ?>" method="POST">                    
                    <div class="input-nobg plr-2rem">
                        <?php if(isset($signup_valid)): ?>
                            <div class="alert alert-danger"><?= $signup_valid->listErrors(); ?></div>
                        <?php endif;?>
                        <div class="form-group mb-3">
                            <div class="form-check form-check-inline w-50 float-start">
                                <input class="form-check-input" type="radio" name="rd_member" id="rd_member1" value="dealer" checked>
                                <label class="form-check-label fs-7" for="rd_member1">Sign up for member</label>
                            </div>

                            <div class="form-check form-check-inline w-50 float-start">
                                <input class="form-check-input" type="radio" name="rd_member" id="rd_member2" value="member">
                                <label class="form-check-label fs-7" for="rd_member2">Sign up for newsletter</label>
                            </div>
                            <div class="clearfix"></div>
                            <p class="mt-2 fs-7">Lorem Ipsum is simply dummy text of the printing and typesetting in dustry. Lorem Ipsum has been</p>
                        </div>
                        <div class="form-group mb-3">
                            <input type="email" class="form-control" name="txt_username" placeholder="<?= lang('GlobalLang.userName').' ('.lang('GlobalLang.email').')' ?> *" value="<?= (isset($signup_valid)?set_value('txt_username'):''); ?>">
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" name="txt_name" placeholder="<?= lang('GlobalLang.name') ?> *" value="<?= (isset($signup_valid)?set_value('txt_name'):''); ?>">
                        </div>
                        <div class="form-group mb-3">
                            <input type="password" class="form-control" name="txt_password" placeholder="<?= lang('GlobalLang.password') ?> *" autocomplete="new-password">
                        </div>
                        <div class="form-group mb-3">
                            <input type="password" class="form-control" name="txt_confirm_password" placeholder="<?= lang('GlobalLang.comfirmPassword') ?> *">
                        </div>
                        <!-- <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="" id="cb_newsletter">
                            <label class="form-check-label" for="cb_newsletter">
                                <?= lang('GlobalLang.newsletter') ?>
                            </label>
                        </div> -->
                        <div class="form-check mb-3">
                            <input type="hidden" name="txt_term" id="txt_term">
                            <input class="form-check-input" type="checkbox" id="cb_term" name="cb_term">
                            <label class="form-check-label" for="cb_term">
                                <?= lang('GlobalLang.accept') ?> <a href="" class="ff-semibold c-black"><?= lang('GlobalLang.termCondition') ?></a>
                            </label>
                        </div>
                        <button type="submit" class="btn bg-lightgold ff-semibold w-100 text-uppercase mb-3"><?= lang('GlobalLang.register') ?></button>
                        <a href="" class="c-black ff-semibold text-center d-block" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#loginModal"><?= lang('GlobalLang.login') ?></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Share -->
<div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header pb-0">
                <span class="ff-semibold text-center d-inline-block w-100">Share content with : </span>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="social-item">
                    <!-- Facebook -->
                    <a href="" target="_blank" class="share-fb"><i class="fab fa-facebook-f"></i> <span>facebook</span></a>

                    <!-- Twitter -->
                    <a href="" target="_blank" class="share-tw"><i class="fab fa-twitter"></i> <span>twitter</span></a>

                    <!-- Line -->
                    <a href="" target="_blank" class="share-line"><i class="fab fa-line"></i> <span>line</span></a>

                    <!-- Google+ -->
                    <a href="" target="_blank" class="share-gg"><i class="fab fa-google-plus-g"></i> <span>google+</span></a>

                    <!-- LinkedIn -->
                    <a href="" target="_blank" class="share-in"><i class="fab fa-linkedin-in"></i> <span>linkedin</span></a>

                    <!-- Pinterest -->
                    <a href="" class="share-pt"><i class="fab fa-pinterest"></i> <span>pinterest</span></a>
                </div>
            </div>
        </div>
    </div>
</div>