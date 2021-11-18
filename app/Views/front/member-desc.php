<?= $this->extend("front/app") ?>

<?= $this->section("content") ?>
    
    <section class="account-body mb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-4">
                    <div class="ac-menu-left p-4 h-100">
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
                                            <a href="tel:<?= $info['company_phone'] ?>" class="text-decoration-none c-black"><?= ($info['company_phone']==''?'-':$info['company_phone']); ?></a>
                                        </div>
                                        <div class="person-phone">
                                            <strong class="ff-dbadmanBold pe-3"><?= lang('GlobalLang.personcontact') ?> : </strong>
                                            <span class="ff-dbadmanBold"><?= ($info['phone']==''?'-':$info['name']); ?></span>
                                            <a href="tel:<?= $info['phone'] ?>" class="text-decoration-none c-black"><?= $info['phone'] ?></a>
                                            <?php
                                                if(isset($membercontact)){
                                                    foreach ($membercontact as $contact) {
                                            ?>
                                                <span class="ff-dbadmanBold"><?= ' , '.$contact->name ?></span>
                                                <a href="tel:<?= $contact->phone ?>" class="text-decoration-none c-black"><?= $contact->phone ?></a>
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
                        
                    </div>
                </div>

                <div class="col-lg-5 col-md-8">
                    <div class="content-body mt-4">
                        <div class="ac-about">
                            <div class="content-title"><strong class="ff-dbadmanBoldnn fs-3">About Us</strong></div>
                            <p class="about-edit"><?= $info['about'] ?></p>
                        </div>

                        <div class="content-body">                        
                            <div class="content-title"><strong class="ff-dbadmanBold fs-3">Gallery</strong></div>
                            <div class="ac-album">
                                <div class="row main-album-img">
                                    <?php
                                        if($album){
                                            foreach($album as $img){
                                    ?>
                                        <div class="col-md-4 album-item mb-3">
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