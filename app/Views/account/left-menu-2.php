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
        <div class="col-12 text-uppercase text-end dealer-id"><?= lang('accountLang.mbshId') ?> : <?= ($info['dealer_code']!="" ? $info['dealer_code'] : $info['code']) ?></div>
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
                    <div class="person-name">
                        <strong class="ff-dbadmanBold pe-3"><?= lang('GlobalLang.name') ?> : </strong>
                        <span class="line-height-22px d-inline-block"><?= $info['name'].' '.$info['lastname']; ?></span>
                    </div>
                    <div class="person-company">
                        <strong class="ff-dbadmanBold pe-3"><?= lang('GlobalLang.company') ?> : </strong>
                        <span class="line-height-22px d-inline-block"><?= ($info['company']==''?'-':$info['company']); ?></span>
                    </div>
                    <div class="phone-contact">
                        <strong class="ff-dbadmanBold pe-3"><?= lang('GlobalLang.phoneNumber') ?> : </strong>
                        <span><?= ($info['phone']==''?'-':$info['phone']); ?></span>
                    </div>
                    <div class="person-email">
                        <strong class="ff-dbadmanBold pe-3"><?= lang('GlobalLang.email') ?> : </strong>
                        <span class="line-height-22px d-inline-block"><?= $info['email']; ?></span>
                    </div>
                    <div class="member-country">
                        <strong class="ff-dbadmanBold pe-3"><?= lang('GlobalLang.country') ?> : </strong>
                        <span><?= ($info['country']==''?'-':$info['country']); ?></span>
                    </div>
                </div>           
            </div>
        </div>
    </div>
    
    <div class="text-center mt-4 text-center ac-btn-action">
        <?php
            $edit_id = $info['id'];
            if($info['code']!=''){
                $edit_id = 'TGJTA-'.$info['code'];
            }
        ?>
        <a href="<?= site_url('account/member/account?u='.$edit_id) ?>" class="btn btn-black-border" id="edit_ac_info"><?= lang('accountLang.e-info') ?></a>
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