<!-- Modal Login -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="text-center w-100 ms-4">
                    <strong class="ff-semibold fs-4"><?= lang('GlobalLang.signin') ?></strong>                    
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">                
                <form action="<?= base_url('account/login'); ?>" method="POST">
                    <input type="hidden" name="hd_burl" value="<?= current_url(); ?>">
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
                        <button type="submit" class="btn bg-lightgold ff-dbadmanBold w-100 text-uppercase"><?= lang('GlobalLang.signin') ?></button>
                    </div>
                </form>
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
                <div class="text-center w-100">
                    <strong class="ff-semibold fs-4 ms-4"><?= lang('GlobalLang.createAccount') ?></strong>              
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">                
                <form id="frm_register" action="<?= site_url('account/register'); ?>" method="POST">                    
                    <div class="input-nobg plr-2rem">
                        <?php if(isset($signup_valid)): ?>
                            <div class="alert alert-danger"><?= $signup_valid->listErrors(); ?></div>
                        <?php endif;?>
                        <div class="form-group mb-3">
                            <div class="form-check form-check-inline w-50 float-start">
                                <input class="form-check-input" type="radio" name="rd_member" id="rd_member1" value="dealer" checked>
                                <label class="form-check-label" for="rd_member1">Sign up for member</label>
                            </div>

                            <div class="form-check form-check-inline w-50 float-start">
                                <input class="form-check-input" type="radio" name="rd_member" id="rd_member2" value="member">
                                <label class="form-check-label" for="rd_member2">Sign up for newsletter</label>
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
                <span class="ff-semibold text-center d-inline-block w-100">Terms & Condition </span>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="p-4">
                    <p>
                        The standard Lorem Ipsum passage, used since the 1500s
                        "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
                    </p>
                    <p>
                        Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in 45 BC
                        "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?"
                    </p>
                        1914 translation by H. Rackham
                        "But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?"
                    </p>
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
                <span class="ff-semibold text-center d-inline-block w-100"> Booking Fail </span>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="p-4">
                    <p class="c-black">
                        <strong class="ff-semibold">ล้มเหลว! :</strong> การจองบูธงานอีเว้นท์สำหรับสมาชิกที่เป็นดีลเลอร์เท่านั้น
                    </p>
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
                <span class="ff-semibold text-center d-inline-block w-100"> Booking Success </span>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="p-4">
                    <p class="c-black">
                        การจองบูธงานอีเว้นท์เรียบร้อยแล้ว ทางเราจะติดต่อกลับไปหาท่านโดยเร็วที่สุด
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
                    <p>ระบบลบข้อมูลเรียบร้อยแล้ว</p>
                    <p>Success, Remove your data</p>
                </div>
                <div class="text-center mb-3">
                    <a href="javascript:void(0)" class="btn bg-lightgold ff-semibold text-uppercase fs-7" data-bs-dismiss="modal" aria-label="Close">Close</a>
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
                <div class="text-center">
                    <p>ระบบบันทึกข้อมูลเรียบร้อยแล้ว</p>
                    <p>Complete to your data</p>
                </div>
                <div class="text-center mb-3">
                    <a href="javascript:void(0)" class="btn bg-lightgold ff-semibold text-uppercase fs-7" data-bs-dismiss="modal" aria-label="Close">Close</a>
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
                    <p>ระบบอัพเดตสถานะเรียบร้อยแล้ว</p>
                    <p>Success, Update plubilc item.</p>
                </div>
                <div class="text-center mb-3">
                    <a href="javascript:void(0)" class="btn bg-lightgold ff-semibold text-uppercase fs-7" data-bs-dismiss="modal" aria-label="Close">Close</a>
                </div>
            </div>
        </div>
    </div>
</div>