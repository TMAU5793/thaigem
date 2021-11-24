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
                        <div class="fs-3">ระบบบันทึกข้อมูลเรียบร้อยแล้ว</div>
                    <?php }else{ ?>
                        <div class="fs-3 line-h-34px">ระบบบันทึกข้อมูลเรียบร้อยแล้ว <br>กรุณาดาวน์โหลดใบสมัครที่เมนูดาวโหลด เพื่อทำการกรอกเอกสารดำเนินการขั้นต่อไป</div>
                    <?php } ?>
                </div>
                <div class="text-center mb-3 mt-3">
                    <a href="javascript:void(0)" class="btn bg-lightgold ff-semibold text-uppercase btn-padding" data-bs-dismiss="modal" aria-label="Close"><?= lang('accountLang.close') ?></a>
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
                    <p>ระบบลบข้อมูลเรียบร้อยแล้ว</p>
                    <p>Success, Remove your data</p>
                </div>
                <div class="text-center mb-3">
                    <a href="javascript:void(0)" class="btn bg-lightgold ff-semibold text-uppercase btn-padding" data-bs-dismiss="modal" aria-label="Close"><?= lang('accountLang.close') ?></a>
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
                            $msg = 'ระบบบันทึกข้อมูลเรียบร้อยแล้ว <br>กรุณารอเจ้าหน้าที่ทำการตรวจสอบภายใน 30 วันหากเอกสารผ่านการพิจารณาท่านจะได้รับอีเมลแจ้งเตือน';
                        }
                        if(session('msg_invoice')){
                            $msg = 'ระบบบันทึกข้อมูลเรียบร้อยแล้ว <br>กรุณารอเจ้าหน้าที่ดำเนินการตรวจสอบ หากบัญชีของคุณผ่านการอนุมัติท่านจะได้รับแจ้งทางอีเมล';
                        }
                    ?>
                    <p><?= $msg ?></p>
                </div>
                <div class="text-center mb-3">
                    <a href="javascript:void(0)" class="btn bg-lightgold ff-semibold text-uppercase btn-padding" data-bs-dismiss="modal" aria-label="Close"><?= lang('accountLang.close') ?></a>
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
                    <p>กรุณาดาวโหลดใบสมัครงานแสดงสินค้า เพื่อทำการกรอกข้อมูล และแนบไฟล์กลับมาได้จากเมนู อัพโหลดไฟล์</p>
                </div>
                <div class="text-center mb-3">
                    <a href="javascript:void(0)" class="btn bg-lightgold ff-semibold text-uppercase btn-padding" data-bs-dismiss="modal" aria-label="Close"><?= lang('accountLang.close') ?></a>
                </div>
            </div>
        </div>
    </div>
</div>