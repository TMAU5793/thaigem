<?php
    use App\Models\Account\AccountModel;
    use App\Models\Account\MemberModel;

    $userdata = session()->get('userdata');
    $model = new AccountModel();
    $model_member = new MemberModel();
    $info = $model->where('account', session()->get('userdata')['account'])->first();
    $main_cate = $model_member->getProductMainType();
    $product_type = $model_member->getProductType();
    $business_main = $model_member->getBusinessMainType();
    $business_tpye = $model_member->getBusinessType();
    $province = $model_member->getProvince();
   // print_r($province);
?>
<div class="ac-menu-left p-4">
    <div class="border-b">
        <div class="row personal-info">
            <div class="col-md-3">
                <div class="personal-img">
                    <?php
                        $profile_pic = (is_file($info['profile'])?site_url($info['profile']):site_url('assets/images/img-default.png'));
                        if(!is_file($info['profile'])){
                            if($userdata['type'] == 'facebook'){
                                $profile_pic = 'https://graph.facebook.com/'.$userdata['id'].'/picture?width=400&height=400';
                            }else if($userdata['type'] == 'google'){
                                $profile_pic = $userdata['profile_pic'];
                            }
                        }
                    ?>
                    <img src="<?= $profile_pic; ?>" id="pic_profile" class="rounded-circle">
                </div>
            </div>

            <div class="col-md-9">
                <div class="personal-desc">
                    <h2 class="ff-dbadmanBold mb-0"><?= $info['company']; ?></h2>
                    <div class="person-email">
                        <i class="far fa-envelope pe-3"></i>
                        <?= $info['email']; ?>
                    </div>
                    <div class="phone-contact">
                        <i class="fas fa-phone-volume pe-3 rotate-25ngt"></i>
                        <span><?= ($info['phone']==''?'-':$info['phone']); ?></span>
                    </div>
                    <div class="person-phone">
                        <strong class="ff-dbadmanBold pe-3">Contact Person : </strong>
                        <span><?= ($info['phone']==''?'-':$info['phone']); ?></span>
                    </div>
                </div>           
            </div>
        </div>
    </div>

    <div class="person-item border-b">
        <div class="row">
            <div class="col-md-1">
                <i class="fas fa-hand-holding-usd"></i>
            </div>
            <div class="col-md-11">
                <div class="item-desc">
                    <h4 class="ff-dbadmanBold mb-0">Product Type</h4>
                    <?php
                        foreach($product_type as $row){
                            if($info['product_type'] == $row->id){
                                foreach($main_cate as $cate){
                                    if($row->maincate_id == $cate->id){
                    ?>
                        <span class="fs-5"><?= $cate->name_th; ?> : <?= $row->name_th; ?></span>
                    <?php } } } } ?>
                </div>
            </div>
        </div>
    </div>

    <div class="person-item border-b">
        <div class="row">
            <div class="col-md-1">
                <i class="fas fa-briefcase"></i>
            </div>
            <div class="col-md-11">
                <div class="item-desc">
                    <h4 class="ff-dbadmanBold mb-0">Business Type</h4>
                    <?php
                        foreach($business_tpye as $row){
                            if($info['business_type'] == $row->id){
                                foreach($business_main as $cate){
                                    if($row->main_type == $cate->id){
                    ?>
                        <span class="fs-5"><?= $cate->name_th; ?> : <?= $row->name_th; ?></span>
                    <?php } } } } ?>
                </div>
            </div>
        </div>
    </div>

    <div class="person-item border-b">
        <div class="row">
            <div class="col-md-1">
                <i class="far fa-building"></i>
            </div>
            <div class="col-md-11">
                <div class="item-desc">
                    <h4 class="ff-dbadmanBold mb-0">Address</h4>
                    <span class="fs-5">Thai Gem and Jewelry Traders Association 919/616 Jewelry Trade Center, 52md Floor, Silom Rd., Bangkok 10500</span>
                </div>
            </div>
        </div>
    </div>

    <div class="person-item border-b">
        <div class="row">
            <div class="col-md-1">
                <i class="fas fa-globe"></i>
            </div>
            <div class="col-md-11">
                <div class="item-desc">
                    <h4 class="ff-dbadmanBold mb-0">Website</h4>
                    <a href="www.en.thaigemjewelry.or.th" target="_blank">www.en.thaigemjewelry.or.th</a>
                </div>
            </div>
        </div>
    </div>

    <div class="social-contact border-b">
        <strong class="ff-dbadmanBold pe-2">Social Media</strong>
        <a href=""><i class="fab fa-facebook-f"></i></a>
        <a href=""><i class="fab fa-instagram"></i></a>
        <a href=""><i class="fab fa-line"></i></a>
    </div>
    
    <div class="text-center mt-4 text-center">
        <a href="<?= site_url('account/member/edit?u=TGJTA-'.$info['code']) ?>" class="btn btn-black-border" id="edit_ac_info"><?= lang('accountLang.e-info') ?></a>
    </div>
</div>

<!-- Modal Edit data Success -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
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