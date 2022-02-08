<!-- Modal Edit data Success -->
<div class="modal fade" id="acSuccessModal" tabindex="-1" aria-labelledby="acSuccessModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">                
                <a href="javascript:void(0)" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
            </div>
            <div class="modal-body pt-0">
                <div class="text-center">
                    <?php
                        if($info['type']=='dealer' && $info['status']==2){
                    ?>
                        <div class="fs-3"><?= lang('accountLang.success') ?></div>
                    <?php }else{ ?>
                        <div class="fs-3 line-h-34px"><?= lang('accountLang.success') ?> <br><?= lang('accountLang.successText') ?></div>
                    <?php } ?>
                </div>
                <div class="text-center mb-3 mt-3">
                    <a href="javascript:void(0)" class="btn bg-lightgold ff-dbadmanBold text-uppercase btn-padding" data-bs-dismiss="modal" aria-label="Close"><?= lang('accountLang.close') ?></a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete Image -->
<div class="modal fade" id="removeImgModal" tabindex="-1" aria-labelledby="removeImgModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <a href="javascript:void(0)" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <p><?= lang('accountLang.delSuccess') ?></p>
                </div>
                <div class="text-center mb-3">
                    <a href="javascript:void(0)" class="btn bg-lightgold ff-dbadmanBold text-uppercase btn-padding" data-bs-dismiss="modal" aria-label="Close"><?= lang('accountLang.close') ?></a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal upload file -->
<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">                
                <a href="javascript:void(0)" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <?php
                        $msg = '';
                        if(session('msg_upload')){
                            $msg = lang('accountLang.msg_upload');
                        }
                        if(session('msg_invoice')){
                            $msg = lang('accountLang.msg_invoice');
                        }
                    ?>
                    <p><?= $msg ?></p>
                </div>
                <div class="text-center mb-3">
                    <a href="javascript:void(0)" class="btn bg-lightgold ff-dbadmanBold text-uppercase btn-padding" data-bs-dismiss="modal" aria-label="Close"><?= lang('accountLang.close') ?></a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Booking Event -->
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">                
                <a href="javascript:void(0)" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <p><?= lang('accountLang.msg_booking'); ?></p>
                </div>
                <div class="text-center mb-3">
                    <a href="javascript:void(0)" class="btn bg-lightgold ff-dbadmanBold text-uppercase btn-padding" data-bs-dismiss="modal" aria-label="Close"><?= lang('accountLang.close') ?></a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Change password -->
<div class="modal fade" id="changepasswordModal" tabindex="-1" aria-labelledby="changepasswordLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-center">
                <span class="ff-dbadmanBold text-uppercase d-inline-block m-auto"><?= lang('GlobalLang.changepassword') ?></span>
            </div>
            <div class="modal-body pt-0">
                <div class="">
                    <form id="frm-changepassword" action="<?= site_url('account/member/update_password') ?>" method="POST">
                        <?php $failpwd = session()->get('failpwd'); ?>
                        <div class="form-group mb-3">
                            <label for=""><?= lang('GlobalLang.password') ?></label>
                            <input type="password" class="form-control" name="txt_password">
                            <small class="text-danger"><?= ($failpwd?'* '.$failpwd['password']:'') ?></small>
                        </div>
                        <div class="form-group mb-3">
                            <label for=""><?= lang('GlobalLang.comfirmPassword') ?></label>
                            <input type="password" class="form-control" name="txt_confirmpassword">
                            <small class="text-danger"><?= ($failpwd?'* '.$failpwd['confirmpassword']:'') ?></small>
                        </div>

                        <div class="text-center mb-3">
                            <button type="submit" class="btn btn-padding fs-5"><?= lang('accountLang.comfirm') ?></button>
                            <a href="<?= site_url('account') ?>" class="btn bg-lightgold text-uppercase btn-padding fs-5"><?= lang('accountLang.cancel') ?></a>
                        </div>
                    </form>
                </div>                
            </div>
        </div>
    </div>
</div>