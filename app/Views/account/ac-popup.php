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