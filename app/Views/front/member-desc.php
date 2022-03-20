<?= $this->extend("front/app") ?>

<?= $this->section("content") ?>
    <section class="banner position-relative">
        <div class="banner-item">
            <img src="<?= site_url('assets/images/account/banner.jpg') ?>" alt="">
            <div class="absolute-center">
                <h2 class="display-3 ff-dbadmanBold"><?= $info['company'] ?></h2>
            </div>
        </div>
    </section>
    <section class="account-body mb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-7">
                    <div class="ac-menu-left p-4 h-100">
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
                                            <a href="mailto:<?= $info['email']; ?>" class="c-black"><?= $info['email']; ?></a>
                                        </div>
                                        <div class="phone-contact">
                                            <i class="fas fa-phone-volume pe-3 rotate-25ngt"></i>
                                            <a href="tel:<?= $info['company_phone'] ?>" class="c-black"><?= ($info['company_phone']==''?'-':$info['company_phone']); ?></a>
                                        </div>
                                        <div class="person-phone">
                                            <strong class="ff-dbadmanBold pe-3"><?= lang('GlobalLang.contactperson') ?> : </strong>
                                            <div class="contact-item ps-3 lh-1_25rem">
                                                <span class="fs-5"><?= ($info['phone']==''?'':$info['name'].' : '); ?></span>
                                                <a href="tel:<?= $info['phone'] ?>" class="c-black"><?= $info['phone'] ?></a>
                                            </div>
                                            <?php
                                                if(isset($membercontact)){
                                                    foreach ($membercontact as $contact) {
                                            ?>
                                                <div class="contact-item ps-3 lh-1_25rem">
                                                    <span class="fs-5"><?= $contact->name ?> : </span>
                                                    <a href="tel:<?= $contact->phone ?>" class="c-black"><?= $contact->phone ?></a>
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
                                <div class="col-lg-11 col-md-10 col-10">
                                    <div class="item-desc">
                                        <h4 class="ff-dbadmanBold mb-0"><?= lang('GlobalLang.product-type') ?></h4>
                                        <div class="box-info">
                                            <p class="mb-0"><?= ($cate_prod && $cate_prod['product']!=''?$cate_prod['product']:'-') ?></p>
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
                                            <p class="mb-0"><?= ($cate_prod && $cate_prod['product']!=''?$cate_prod['business']:'-') ?></p>
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
                                <div class="col-lg-11 col-md-10 col-10">
                                    <div class="item-desc">
                                        <h4 class="ff-dbadmanBold mb-0"><?= lang('GlobalLang.website') ?></h4>
                                        <a href="<?= urldecode($info['website']); ?>" target="_blank"><?= urldecode($info['website']); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="social-contact more-info border-b hide-767">
                            <strong class="ff-dbadmanBold pe-2"><?= lang('GlobalLang.socialmedia') ?></strong>
                            <?php if($social->facebook!=""){ ?>
                                <a href="<?= $social->facebook ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            <?php } ?>
                            <?php if($social->instagram!=""){ ?>
                                <a href="<?= $social->instagram ?>" target="_blank"><i class="fab fa-instagram"></i></a>
                            <?php } ?>
                            <?php if($social->line!=""){ ?>            
                                <a href="http://line.me/ti/p/<?= $social->line ?>" target="_blank"><i class="fab fa-line"></i></a>
                            <?php } ?>
                            <?php if($social->youtube!=""){ ?>
                                <a href="<?= $social->youtube ?>" target="_blank"><i class="fab fa-youtube"></i></a>
                            <?php } ?>                            
                            <?php if($social->wechat!=""){ ?>
                                <a href="<?= $social->wechat ?>" target="_blank" title="Wechat"><i class="fab fa-weixin"></i></a>
                            <?php } ?>
                            <?php if($social->whatsapp!=""){ ?>
                                <a href="<?= $social->whatsapp ?>" target="_blank" title="Whatsapp"><i class="fab fa-whatsapp"></i></a>
                            <?php } ?>
                            <?php if($social->linkein!=""){ ?>
                                <a href="<?= $social->linkein ?>" target="_blank"><i class="fab fa-linkedin"></i></a>
                            <?php } ?>
                        </div>
                        
                        <div class="map-iframe more-info hide-767">
                            <?= ($info['map']!=''?$info['map']:'') ?>
                        </div>
                        
                        <div class="text-center mt-2 show-767">
                            <button type="botton" id="btn-member-more" class="fs-5 btn btn-black-border pt-1">
                                <span class="more-info">
                                    เพิ่มเติม <i class="fas fa-caret-down"></i>
                                </span>
                                <span class="more-info hide-767">
                                    ซ่อน <i class="fas fa-caret-up"></i>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 col-md-5">
                    <div class="content-body mt-4">
                        <div class="ac-about">
                            <div class="content-title"><strong class="ff-dbadmanBoldnn fs-3">About Us</strong></div>
                            <p class="about-edit"><?= ($info['about']=='' ?  '-' : $info['about']) ?></p>
                        </div>

                        <div class="content-body">                        
                            <div class="content-title"><strong class="ff-dbadmanBold fs-3">Gallery</strong></div>
                            <div class="ac-album">
                                <div class="row main-album-img">
                                    <?php
                                        if($album){
                                            foreach($album as $img){
                                    ?>
                                        <div class="col-md-4 col-4 album-item mb-3">
                                            <a class="fancybox" data-fancybox="plans" data-width="1400" data-caption="" href="<?= (is_file($img['images'])?site_url($img['images']):site_url('assets/images/default-900x600.jpg')) ?>" title="">
                                                <div class="zoom-in"><img src="<?= (is_file($img['images'])?site_url($img['images']):site_url('assets/images/default-900x600.jpg')) ?>" alt=""></div>
                                            </a>
                                        </div>
                                    <?php } } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?= $this->endSection() ?>

<?= $this->section("scripts") ?>
    <?= $this->include('template/slick-slide') ?>
    <?= $this->include('account/ac-script') ?>
<?= $this->endSection() ?>