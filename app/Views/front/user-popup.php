<?php
    $db = db_connect();
    $tbl_info = $db->table('tbl_information');
    $tbl_info->where(['page'=>'terms','status'=>'1']);
    $terms = $tbl_info->get()->getRow();
?>
<!-- Modal Login -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="text-center w-100 ms-4">
                    <strong class="ff-dbadmanBold fs-4"><?= lang('GlobalLang.signin') ?></strong>                    
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">                
                <form action="<?= base_url('account/login'); ?>" method="POST" autocomplete="off">
                    <input type="hidden" name="hd_burl" value="<?= current_url(); ?>">
                    <input type="hidden" id="hd_member" name="hd_member" value="">
                    <div class="input-nobg plr-2rem">
                        <?php if(isset($signin_valid)): ?>
                            <div class="alert alert-danger"><?= $signin_valid->listErrors(); ?></div>
                        <?php endif;?>
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" name="txt_username" placeholder="<?= lang('GlobalLang.userName') ?> *" value="<?= (isset($signin_valid)?set_value('txt_username'):''); ?>" autocomplete="off">
                        </div>
                        <div class="form-group mb-3">
                            <input type="password" class="form-control" name="txt_password" placeholder="<?= lang('GlobalLang.password') ?> *" autocomplete="off">
                        </div>
                        <button type="submit" class="btn bg-lightgold ff-dbadmanBold w-100 text-uppercase"><?= lang('GlobalLang.signin') ?></button>
                    </div>
                </form>
                <a href="<?= site_url('member/forgotpassword') ?>" class="text-decoration-none c-black text-uppercase mt-3 d-block text-center"><?= lang('GlobalLang.forgot') ?></a>
                <div class="login-with-social plr-2rem mt-3">
                    <a href="javascript:void(0)" onclick="loginFacebook();" class="btn bg-lightgold ff-dbadmanBold text-uppercase d-block w-100 mb-3"> <?= lang('GlobalLang.signFacebook') ?></a>
                    <a href="<?= site_url('logingoogle'); ?>" class="btn bg-lightgold ff-dbadmanBold text-uppercase d-block w-100"> <?= lang('GlobalLang.signGmail') ?></a>
                </div>
                <div class="signup-account text-center p-3">
                    <strong class="ff-dbadmanBold fs-4 d-block"><?= lang('GlobalLang.createAccount') ?></strong>
                    <span class="fs-5"><?= lang('GlobalLang.notMember') ?></span>
                    <a href="" class="ff-dbadmanBold c-black text-decoration-none text-uppercase" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#registerModal"><?= lang('GlobalLang.register') ?></a>
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
                <span class="register-back cursor-pointer input-nobg d-none"><?= lang('GlobalLang.back') ?></span>
                <div class="text-center w-100">
                    <strong class="ff-dbadmanBold fs-2 ms-4 d-block"><?= lang('GlobalLang.createAccount') ?></strong>                    
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0">
                <form id="frm_register" action="<?= site_url('account/register'); ?>" method="POST">
                    <div class="container register-desc">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="singup-form text-center">
                                    <div class="head-sect">
                                        <h4 class="ff-dbadmanBold"><?= lang('GlobalLang.memberTgjta') ?></h4>
                                        <p><?= lang('HomeLang.memberTgjtaText') ?></p>
                                    </div>
                                    <div class="text-center">
                                        <button type="button" class="btn btn-register member-tgjta"><?= lang('GlobalLang.btnmember') ?></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="sign-member text-center">
                                    <div class="head-sect">
                                        <h4 class="ff-dbadmanBold"><?= lang('GlobalLang.memberPerson') ?></h4>
                                        <p><?= lang('HomeLang.memberPersonText') ?></p>
                                    </div>
                                    <div class="text-center">
                                        <button type="button" class="btn btn-register member-personal"><?= lang('GlobalLang.btnjoin') ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="input-nobg mt-3 d-none">
                        <?php if(isset($signup_valid)): ?>
                            <div class="alert alert-danger"><?= $signup_valid->listErrors(); ?></div>
                        <?php endif;?>
                        <div class="form-group mb-3">
                            <div class="form-check form-check-inline w-50 float-start">
                                <input class="form-check-input" type="radio" name="rd_member" id="rd_member1" value="dealer" checked>
                                <label class="form-check-label" for="rd_member1"><?= lang('GlobalLang.memberTgjta') ?></label>
                            </div>

                            <div class="form-check form-check-inline w-50 float-start">
                                <input class="form-check-input" type="radio" name="rd_member" id="rd_member2" value="member">
                                <label class="form-check-label" for="rd_member2"><?= lang('GlobalLang.memberPerson') ?></label>
                            </div>
                            <div class="clearfix"></div>
                            
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
                        <div class="form-check mb-3">
                            <input type="hidden" name="txt_term" id="txt_term">
                            <input class="form-check-input" type="checkbox" id="cb_term" name="cb_term">
                            <label class="form-check-label" for="cb_term">
                                <span><?= lang('GlobalLang.accept') ?></span> <a href="" class="ff-dbadmanBold c-black" data-bs-toggle="modal" data-bs-target="#termsModal"><?= lang('GlobalLang.termCondition') ?></a>
                            </label>
                        </div>
                        <button type="submit" class="btn bg-lightgold ff-dbadmanBold w-100 text-uppercase mb-3"><?= lang('GlobalLang.register') ?></button>
                        <a href="" class="c-black ff-dbadmanBold text-center d-block" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#loginModal"><?= lang('GlobalLang.login') ?></a>
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
                <span class="ff-dbadmanBold text-center d-inline-block w-100">Share content with : </span>
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

                    <!-- LinkedIn -->
                    <a href="" target="_blank" class="share-in"><i class="fab fa-linkedin-in"></i> <span>linkedin</span></a>

                    <!-- Pinterest -->
                    <a href="" target="_blank" class="share-pt"><i class="fab fa-pinterest"></i> <span>pinterest</span></a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal terms -->
<div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header pb-0">
                <span class="ff-dbadmanBold text-center d-inline-block w-100"><?= ($terms?($lang=='en'?$terms->title_en:$terms->title_th):'') ?></span>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="p-4">
                    <?= ($terms?($lang=='en'?$terms->desc_en:$terms->desc_th):'') ?>
                </div>
            </div>
            <button class="btn btn-primary" id="terms-accept"><?= lang('GlobalLang.accept') ?></button>
        </div>
    </div>
</div>

<!-- Modal Confirm -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-lightgold border-0">
            <div class="modal-header pb-0">
                <span class="ff-dbadmanBold text-center d-inline-block w-100"> <strong class="ff-dbadmanBold"><?= lang('GlobalLang.comfirm') ?> :</strong> <?= lang('GlobalLang.cancelText') ?> </span>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="p-4 text-center">
                    <button class="btn btn-black-border" id="confirmEvent"><?= lang('GlobalLang.comfirm') ?></button>
                    <button type="button" class="btn btn-black-border" data-bs-dismiss="modal" aria-label="Close"><?= lang('GlobalLang.cancel') ?></button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal booked -->
<div class="modal fade" id="bookedModal" tabindex="-1" aria-labelledby="bookedModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-lightgold border-0">
            <div class="modal-header pb-0">
                <span class="ff-dbadmanBold text-center d-inline-block w-100"> <?= lang('GlobalLang.bookedEvent') ?> </span>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="p-4 text-center">
                    <a href="<?= site_url('account/event') ?>" class="btn btn-black-border w-25" id="confirmEvent"><?= lang('GlobalLang.bookedList') ?></a>
                    <button type="button" class="btn btn-black-border w-25" data-bs-dismiss="modal" aria-label="Close"><?= lang('GlobalLang.close') ?></button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Event -->
<div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-lightgold border-0">
            <div class="modal-header pb-0">
                <span class="ff-dbadmanBold text-center d-inline-block w-100"> Booking Fail </span>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="p-4 text-center">
                    <p class="c-black">
                        <?= lang('GlobalLang.bookingFail') ?>
                    </p>
                    <?php if(session()->get('userdata')['user_type']=='dealer') { ?>
                        <a href="<?= site_url('account') ?>" class="btn btn-black-border"><?= lang('GlobalLang.checkstatus') ?></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Event Booking -->
<div class="modal fade" id="eventBookingModal" tabindex="-1" aria-labelledby="eventBookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-lightgold border-0">
            <div class="modal-header pb-0">
                <span class="ff-dbadmanBold text-center d-inline-block w-100"> Booking Success </span>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="p-4">
                    <p class="c-black">
                    <?= lang('GlobalLang.bookingSuccess') ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete Reply Webboard -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <a href="javascript:void(0)" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <p><?= lang('GlobalLang.delSuccess') ?></p>
                </div>
                <div class="text-center mb-3">
                    <a href="javascript:void(0)" class="btn bg-lightgold ff-dbadmanBold text-uppercase btn-padding" data-bs-dismiss="modal" aria-label="Close"><?= lang('GlobalLang.close') ?></a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Success -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <a href="javascript:void(0)" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
            </div>
            <div class="modal-body">
                <i class="fas fa-check-circle text-success fs-1 d-block text-center mb-3"></i>
                <div class="text-center" id="modalSuccessMSG">                    
                    <p><?= lang('GlobalLang.success') ?></p>
                </div>
                <div class="text-center mb-3">
                    <a href="javascript:void(0)" class="btn bg-lightgold ff-dbadmanBold text-uppercase btn-padding" data-bs-dismiss="modal" aria-label="Close"><?= lang('GlobalLang.close') ?></a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Hide Reply Webboard -->
<div class="modal fade" id="hideModal" tabindex="-1" aria-labelledby="hideModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <a href="javascript:void(0)" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
            </div>
            <div class="modal-body">
                <div class="text-center" id="reply_msg">
                    <p><?= lang('GlobalLang.success') ?></p>
                </div>
                <div class="text-center mb-3">
                    <a href="javascript:void(0)" class="btn bg-lightgold ff-dbadmanBold text-uppercase btn-padding" data-bs-dismiss="modal" aria-label="Close"><?= lang('GlobalLang.close') ?></a>
                </div>
            </div>
        </div>
    </div>
</div>