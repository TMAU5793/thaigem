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
    <div class="row dealer-head">
        <div class="col-6">            
            <div class="status-dealer">
                <?php
                    if($info['status']=='2'){
                ?>
                    <span>ดำเนินการสำเร็จแล้ว <i class="fas fa-circle"></i></span>
                <?php }else if($info['status']=='1'){ ?>
                    <span>รอดำเนินการ <i class="fas fa-circle text-warning"></i></span>
                <?php } ?>
            </div>
        </div>
        <div class="col-6 text-uppercase text-end dealer-id">ID TGJTA<?= ($info['code']!="" ? $info['code'] : $info['id']) ?></div>
    </div>
    <div class="border-b">
        <div class="row personal-info">
            <div class="col-md-3 col-3">
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

            <div class="col-md-9 col-9">
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

    <div class="person-item border-b more-info hide-767">
        <div class="row">
            <div class="col-lg-1 col-md-2 col-2">
                <i class="fas fa-hand-holding-usd"></i>
            </div>
            <div class="ccol-lg-11 col-md-10 col-10">
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

    <div class="person-item border-b more-info hide-767">
        <div class="row">
            <div class="col-lg-1 col-md-2 col-2">
                <i class="fas fa-briefcase"></i>
            </div>
            <div class="col-lg-11 col-md-10 col-10">
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

    <div class="person-item border-b more-info hide-767">
        <div class="row">
            <div class="col-lg-1 col-md-2 col-2">
                <i class="far fa-building"></i>
            </div>
            <div class="col-lg-11 col-md-10 col-10">
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

    <div class="person-item border-b more-info hide-767">
        <div class="row">
            <div class="col-lg-1 col-md-2 col-2">
                <i class="fas fa-globe"></i>
            </div>
            <div class="col-lg-1 col-md-10 col-10">
                <div class="item-desc">
                    <h4 class="ff-dbadmanBold mb-0"><?= lang('GlobalLang.website') ?></h4>
                    <a href="<?= urldecode($info['website']); ?>" target="_blank"><?= urldecode($info['website']); ?></a>
                </div>
            </div>
        </div>
    </div>

    <div class="social-contact border-b more-info hide-767">
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
        <?php if($social->linkein!=""){ ?>
            <a href="https://www.linkedin.com/in/<?= $social->linkein ?>" target="_blank"><i class="fab fa-linkedin"></i></a>
        <?php } ?>
        <?php if($social->youtube!=""){ ?>
            <a href="<?= $social->youtube ?>" target="_blank"><i class="fab fa-youtube"></i></a>
        <?php } ?>
    </div>
    
    <div class="text-center mt-4 text-center ac-btn-action">
        <a href="<?= site_url('account/member/edit?u=TGJTA-'.$info['code']) ?>" class="btn btn-black-border" id="edit_ac_info"><?= lang('accountLang.e-info') ?></a>
        <button type="botton" id="btn-member-more" class="btn btn-black-border show-767">
            <span class="more-info">
                เพิ่มเติม <i class="fas fa-caret-down"></i>
            </span>
            <span class="more-info hide-767">
                ซ่อน <i class="fas fa-caret-up"></i>
            </span>
        </button>
    </div>
</div>