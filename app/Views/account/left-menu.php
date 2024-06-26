<?php
    use App\Models\Account\AccountModel;
    use App\Models\Account\MemberModel;

    $userdata = session()->get('userdata');
    $model = new AccountModel();
    $model_member = new MemberModel();
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
                    if($info['m_status']=='2'){
                ?>
                    <span><?= lang('accountLang.complete') ?> <i class="fas fa-circle"></i></span>
                <?php }else if($info['m_status']=='1'){ ?>
                    <span><?= lang('accountLang.process') ?> <i class="fas fa-circle text-warning"></i></span>
                <?php }else{ ?>
                    <span><?= lang('accountLang.process') ?> <i class="fas fa-circle text-warning"></i></span>
                <?php } ?>
            </div>
        </div>
        <div class="col-6 text-uppercase text-end dealer-id"><?= lang('accountLang.mbshId') ?> : <?= ($info['m_code']!="" ? $info['m_code'] : $info['code']) ?></div>
    </div>
    <div class="border-b">
        <div class="row personal-info">
            <div class="col-md-3 col-3 text-center">
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

                <button class="btn btn-changepassword fs-6" data-bs-toggle="modal" data-bs-target="#changepasswordModal"><?= lang('GlobalLang.changepassword') ?></button>
            </div>

            <div class="col-md-9 col-9">
                <div class="personal-desc">
                    <h2 class="ff-dbadmanBold mb-0"><?= $info['company']; ?></h2>
                    <div class="person-email">
                        <i class="far fa-envelope pe-3"></i>
                        <span class="line-height-22px d-inline-block"><?= $info['email']; ?></span>
                    </div>
                    <div class="phone-contact">
                        <i class="fas fa-phone-volume pe-3 rotate-25ngt"></i>
                        <span><?= ($info['company_phone']==''?'-':$info['company_phone']); ?></span>
                    </div>
                    <div class="person-phone">
                        <strong class="ff-dbadmanBold pe-3"><?= lang('GlobalLang.contactperson') ?> : </strong>
                        <div class="contact-item ps-3 lh-1_25rem">
                            <span><?= ($info['phone']==''?'':'<span class="fs-5">'.$info['name'].' : </span> '.$info['phone']); ?></span>
                        </div>
                        <?php
                            if(isset($membercontact) && $membercontact){
                                foreach ($membercontact as $contact) {
                        ?>
                            <div class="contact-item ps-3 lh-1_25rem">
                                <span><?= '<span class="fs-5">'.$contact->name.' : </span> '.$contact->phone; ?></span>
                            </div>
                        <?php } } ?>
                    </div>
                    <div class="member-since">
                        <strong class="ff-dbadmanBold pe-3"><?= lang('GlobalLang.membersince') ?> : </strong>
                        <span><?= ($info['member_start']==''?'-':$info['member_start']); ?></span>
                    </div>
                    <div class="employee">
                        <strong class="ff-dbadmanBold pe-3"><?= lang('accountLang.employee') ?> : </strong>
                        <span><?= ($info['employee']==''?'-':$info['employee']); ?> <?= ($info['employee']=='1000'?lang('accountLang.peopleUp') : lang('accountLang.person')) ?></span>
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
                        <p class="mb-0"><?= $info['product'] ?></p>
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
                        <p class="mb-0"><?= $info['business'] ?></p>
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
                            echo $address->address;
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
            <a href="<?= $social->facebook ?>" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
        <?php } ?>
        <?php if($social->instagram!=""){ ?>
            <a href="<?= $social->instagram ?>" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
        <?php } ?>
        <?php if($social->line!=""){ ?>
            <a href="http://line.me/ti/p/<?= $social->line ?>" target="_blank" title="Line"><i class="fab fa-line"></i></a>
        <?php } ?>        
        <?php if($social->youtube!=""){ ?>
            <a href="<?= $social->youtube ?>" target="_blank" title="Youtube"><i class="fab fa-youtube"></i></a>
        <?php } ?>
        <?php if($social->wechat!=""){ ?>
            <a href="<?= site_url($social->wechat) ?>" target="_blank" title="Wechat"><i class="fab fa-weixin"></i></a>
        <?php } ?>
        <?php if($social->whatsapp!=""){ ?>
            <a href="<?= $social->whatsapp ?>" target="_blank" title="Whatsapp"><i class="fab fa-whatsapp"></i></a>
        <?php } ?>
        <?php if($social->linkein!=""){ ?>
            <a href="<?= $social->linkein ?>" target="_blank" title="Linkein"><i class="fab fa-linkedin"></i></a>
        <?php } ?>
        <span class="ff-dbadmanBold share-social" data-url="<?= site_url('member/id/'.$info['id']); ?>" data-image="<?= $profile_pic; ?>" title="<?= lang('GlobalLang.share'); ?>"><i class="fas fa-share-alt"></i></span>
    </div>

    <div class="map-iframe">
        <?= ($info['map']!=''?$info['map']:'') ?>
    </div>
    
    <div class="text-center mt-4 text-center ac-btn-action">
        <?php
            $edit_id = $info['id'];
            if($info['code']!=''){
                $edit_id = 'TGJTA-'.$info['code'];
            }
        ?>
        <a href="<?= site_url('account/member/edit?u='.$edit_id) ?>" class="btn btn-black-border" id="edit_ac_info"><?= lang('accountLang.e-info') ?></a>
        <button type="botton" id="btn-member-more" class="btn btn-black-border show-767">
            <span class="more-info">
                <?= lang('accountLang.more') ?> <i class="fas fa-caret-down"></i>
            </span>
            <span class="more-info hide-767">
                <?= lang('accountLang.hide') ?> <i class="fas fa-caret-up"></i>
            </span>
        </button>
    </div>
</div>