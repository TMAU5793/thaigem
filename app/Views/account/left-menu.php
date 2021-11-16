<?php
    use App\Models\Account\AccountModel;
    use App\Models\Account\MemberModel;

    $userdata = session()->get('userdata');
    $model = new AccountModel();
    $model_member = new MemberModel();
    $info = $model->where('account', session()->get('userdata')['account'])->first();
    $pMaincate = $model_member->getProductMainType();
    $pSubcate = $model_member->getProductType();
    $bMaincate = $model_member->getBusinessMainType();
    $bSubcate = $model_member->getBusinessType();
    $province = $model_member->getProvince();
   
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
                        <span><?= ($info['company_phone']==''?'-':$info['company_phone']); ?></span>
                    </div>
                    <div class="person-phone">
                        <strong class="ff-dbadmanBold pe-3"><?= lang('GlobalLang.personcontact') ?> : </strong>
                        <span><?= ($info['phone']==''?'-':'<span class="ff-dbadmanBold">'.$info['name'].'</span> '.$info['phone']); ?></span>
                        <?php
                            if(isset($membercontact)){
                                foreach ($membercontact as $contact) {
                        ?>
                            <span><?= '<span class="ff-dbadmanBold"> , '.$contact->name.'</span> '.$contact->phone; ?></span>
                        <?php } } ?>
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
                    <h4 class="ff-dbadmanBold mb-0"><?= lang('GlobalLang.product-type') ?></h4>
                    <div class="box-info">
                        <?php
                            $n=0;
                            foreach($memberbusiness as $row){
                                if($row->type == 'product'){
                        ?>
                            <span class="fs-5 d-inline">
                                <?php
                                    $n++;
                                    if($n > 1){
                                        echo ' , ';
                                    }
                                    foreach($pSubcate as $subcate){
                                        foreach($pMaincate as $maincate){                                            
                                            if($subcate->maincate_id == $maincate->id && $row->cate_id == $subcate->id){
                                                echo ($lang=='en' && $subcate->name_en!='' && $maincate->name_en != ''?'<span class="ff-dbadmanBold d-inline">'.$maincate->name_en.'</span> > '.$subcate->name_en : '<span class="ff-dbadmanBold d-inline">'.$maincate->name_th.'</span> > '.$subcate->name_th);
                                            }

                                        }
                                    }
                                ?>
                            </span>
                        <?php } } ?>
                    </div>
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
                    <h4 class="ff-dbadmanBold mb-0"><?= lang('GlobalLang.business-type') ?></h4>
                    <div class="box-info">
                        <?php
                            $n=0;
                            foreach($memberbusiness as $row){
                                if($row->type == 'business'){
                        ?>
                            <span class="fs-5 d-inline">
                                <?php
                                    $n++;
                                    if($n > 1){
                                        echo ' , ';
                                    }
                                    foreach($bSubcate as $subcate){
                                        foreach($bMaincate as $maincate){
                                            if($subcate->main_type == $maincate->id && $row->cate_id == $subcate->id){
                                                echo ($lang=='en' && $subcate->name_en!='' && $maincate->name_en != ''? '<span class="ff-dbadmanBold d-inline">'.$maincate->name_en.'</span> > '.$subcate->name_en : '<span class="ff-dbadmanBold d-inline">'.$maincate->name_th.'</span> > '.$subcate->name_th);
                                            }

                                        }
                                    }
                                ?>
                            </span>
                        <?php } } ?>
                    </div>
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
                    <h4 class="ff-dbadmanBold mb-0"><?= lang('GlobalLang.address') ?></h4>
                    <p class="fs-5 mb-0">
                        <?php
                            $provinceText = '';
                            $amphureText = '';
                            $districtText = '';
                            foreach ($province as $pv){
                                if($pv->id == $address->province_id){
                                    $provinceText = ($lang=='en'?$pv->name_en : $pv->name_th);
                                }
                            }
                            foreach ($amphure as $ap){
                                if($ap->id == $address->amphure_id){
                                    $amphureText = ($lang=='en'?$ap->name_en : $ap->name_th);
                                }
                            }
                            foreach ($district as $dt){
                                if($dt->id == $address->district_id){
                                    $districtText = ($lang=='en'?$dt->name_en : $dt->name_th);
                                }
                            }
                            echo $address->address.' '.$districtText.' '.$amphureText.' '.$provinceText.' '.$address->zipcode;
                        ?>
                    </p>
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
                    <h4 class="ff-dbadmanBold mb-0"><?= lang('GlobalLang.website') ?></h4>
                    <a href="<?= urldecode($info['website']); ?>" target="_blank"><?= urldecode($info['website']); ?></a>
                </div>
            </div>
        </div>
    </div>

    <div class="social-contact border-b">
        <strong class="ff-dbadmanBold pe-2"><?= lang('GlobalLang.socialmedia') ?></strong>
        <?php if($social->facebook!=""){ ?>
            <a href="https://www.facebook.com/<?= $social->facebook ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
        <?php } ?>
        <?php if($social->instagram!=""){ ?>
            <a href="https://www.instagram.com/<?= $social->instagram ?>" target="_blank"><i class="fab fa-instagram"></i></a>
        <?php } ?>
        <?php if($social->line!=""){ ?>            
            <a href="http://line.me/ti/p/<?= $social->line ?>" target="_blank"><i class="fab fa-line"></i></a>
        <?php } ?>
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