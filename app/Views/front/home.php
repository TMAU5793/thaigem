<?= $this->extend("front/app") ?>
<?= $this->section("content") ?>

    <section class="banner-home">
        <div class="banner-slick slick-dots-2 hide-575">
            <?php
                if($banner){
                    foreach($banner as $row) { 
            ?>
                <div class="banner-slide <?= ($row['link']!=''? 'cursor-pointer' : '') ?>" title="<?= ($row['link']!=''?$row['link'] : '') ?>">
                    <?php if($row['link']!=''){ ?>
                        <a href="<?= $row['link'] ?>" target="_blank">
                            <img src="<?= (is_file($row['banner'])?site_url($row['banner']):site_url('assets/images/img-default.jpg')) ?>" alt="thai gem">
                        </a>
                    <?php }else{ ?>
                            <img src="<?= (is_file($row['banner'])?site_url($row['banner']):site_url('assets/images/img-default.jpg')) ?>" alt="thai gem">
                    <?php } ?>
                </div>
            <?php } } ?>
        </div>

        <div class="banner-slick slick-dots-2 show-575">
            <?php
                if($banner){
                    foreach($banner as $row) { 
            ?>
                <div class="banner-slide <?= ($row['link']!=''? 'cursor-pointer' : '') ?>" title="<?= ($row['link']!=''?$row['link'] : '') ?>">                   
                    <?php if($row['link']!=''){ ?>
                        <a href="<?= $row['link'] ?>" target="_blank">
                            <img src="<?= (is_file($row['banner_mobile'])?site_url($row['banner_mobile']):site_url('assets/images/img-default.jpg')) ?>" alt="thai gem">
                        </a>
                    <?php }else{ ?>
                            <img src="<?= (is_file($row['banner_mobile'])?site_url($row['banner_mobile']):site_url('assets/images/img-default.jpg')) ?>" alt="thai gem">
                    <?php } ?>
                </div>
            <?php } } ?>
        </div>
    </section>
    
    <section class="category-home">
        <div class="bg-title pb-4 pt-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 col-sm-12 col-order-2">
                        <div class="ff-dbadmanBold">
                            <h3 class="mb-0 fs-1">Fulfill your business opportunities</h3>
                            <h4 class="mb-0">with our trusted and reliable members.</h4>
                        </div>
                        <a href="<?= site_url('member') ?>" class="btn btn-darkgold c-white fs-5">TGJTA Members Search</a>
                        <div class="tg-title">
                            <h3 class="c-darkgold mb-0"><?= lang('HomeLang.category'); ?></span></h3>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-12 col-order-1">
                        <?= $this->include('template/gold-price') ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="category-list ptb-2rem">
            <div class="container">
                <div class="cate-slide slick-dots-2">
                    <?php
                        if($catergory){
                            foreach($catergory as $row){
                    ?>
                        <div class="cateory-item">
                            <div class="box-shadow-lightgold cursor-pointer zoom-in" onclick="location.href='<?= site_url('member/filter?c='.$row['id']) ?>'">
                                <div class="item-img">
                                    <img src="<?= (is_file($row['thumbnail'])?site_url($row['thumbnail']):site_url('assets/images/img-default.jpg')) ?>" alt="<?= ($row['name_en']==""?$row['name_th'] : $row['name_'.$lang] ) ?>">
                                </div>
                                <div class="item-text text-center position-relative">
                                    <h2 class="ff-dbadmanBold absolute-center w-100 fs-5"><?= ($row['name_en']==""?$row['name_th'] : $row['name_'.$lang] ) ?></h2>                                    
                                </div>
                            </div>
                        </div>
                    <?php } } ?>
                </div>
            </div>
        </div>
    </section>

    <section class="banner-ads pt-5">
        <div class="container">
            <?php
                //print_r($adsbanner);
                if($adsbanner){
                    foreach ($adsbanner as $ads){
                        //echo $ads['position'];
                        if($ads['position']=='p1'){
            ?>
                <a href="<?= $ads['link'] ?>" target="_blank">
                    <img src="<?= (is_file($ads['banner'])?site_url($ads['banner']):site_url('assets/images/ads-1298x276.jpg')); ?>" alt="">
                </a>
            <?php } } } ?>
        </div>
    </section>

    <section class="price-update ptb-2rem">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <div class="tg-title pt-1">
                        <h3 class="c-darkgold"><?= lang('GlobalLang.priceUpdate'); ?></h3>
                    </div>
                </div>
                <div class="col-md-8 col-sm-8">
                    <ul class="nav nav-pills mb-3 justify-content-end" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a href="<?= site_url('price-update#diamond-price') ?>" class="text-decoration-none">
                                <strong class="ff-bold nav-link active" data-bs-toggle="pill" data-bs-target="#pills-1">
                                    <i class="fas fa-square"></i>
                                    <?= lang('GlobalLang.diamonds'); ?>
                                </strong>
                            </a>
                        </li>
                        <!-- <li class="nav-item" role="presentation">
                            <strong class="ff-bold nav-link" data-bs-toggle="pill" data-bs-target="#pills-2"><i class="fas fa-square"></i> <?= lang('GlobalLang.ruby'); ?></strong>
                        </li>
                        <li class="nav-item" role="presentation">
                            <strong class="ff-bold nav-link" data-bs-toggle="pill" data-bs-target="#pills-3"><i class="fas fa-square"></i> <?= lang('GlobalLang.sapphire'); ?></strong>
                        </li> -->
                    </ul>
                </div>
            </div>
            
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-1" role="tabpanel" aria-labelledby="pills-1-tab">
                    <div class="table-price">
                        <?php
                            if($tbl_price){
                                $n=0;
                                foreach ($tbl_price as $row){                                    
                                    if($row['type']=='diamonds' && $n<1){
                                        $n++;
                        ?>
                            <a href="<?= site_url('price-update#diamond-price') ?>" class="text-decoration-none">
                                <img src="<?= site_url($row['file']) ?>" alt="<?= $row['type']; ?>">
                            </a>
                        <?php } } } ?>
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-2" role="tabpanel" aria-labelledby="pills-2-tab">
                    <div class="table-price">
                        <?php
                            if($tbl_price){
                                $n=0;
                                foreach ($tbl_price as $row){                                    
                                    if($row['type']=='ruby' && $n<1){
                                        $n++;
                        ?>
                            <a href="<?= site_url('price-update#dimon-price') ?>" class="text-decoration-none">
                                <img src="<?= site_url($row['file']) ?>" alt="<?= $row['type']; ?>">
                            </a>
                        <?php } } } ?>
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-3" role="tabpanel" aria-labelledby="pills-3-tab">
                    <div class="table-price">
                        <?php
                            if($tbl_price){
                                $n=0;
                                foreach ($tbl_price as $row){                                    
                                    if($row['type']=='sapphire' && $n<1){
                                        $n++;
                        ?>
                            <a href="<?= site_url('price-update#dimon-price') ?>" class="text-decoration-none">
                                <img src="<?= site_url($row['file']) ?>" alt="<?= $row['type']; ?>">
                            </a>
                        <?php } } } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php if($events){ ?>
    <section class="event-home ptb-2rem">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-8">
                    <div class="tg-title mb-4">
                        <h3 class="c-darkgold"><strong class="ff-bold"><?= lang('GlobalLang.events'); ?></strong></h3>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-4">
                    <div class="text-end view-all">
                        <a href="<?= site_url('event') ?>" class="c-black a-hover-darkgold text-uppercase letter-spacing-1"><?= lang('GlobalLang.viewAll'); ?></a>
                    </div>
                </div>
            </div>
            <div class="slick-1-item">
                <?php                    
                    foreach ($events as $event){
                ?>
                    <div class="event-item">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="<?= (is_file($event['thumbnail'])?site_url($event['thumbnail']):site_url('assets/images/img-default.jpg')) ?>" alt="<?= ($lang=='en'?$event['name_en']:$event['name']) ?>">
                            </div>
                            <div class="col-md-6 position-relative">
                                <div class="event-date text-end pt-3 pe-4">
                                    <span><?= lang('GlobalLang.eventDate') ?> : </span>
                                    <?php
                                        $start_event = explode('-',$event['start_event']);
                                        $end_event = explode('-',$event['end_event']);
                                        foreach ($month as $row){
                                            if($row['id']==$start_event[1]){
                                                $m1 = ($lang=='en'?$row['name_en']:$row['name_th']);
                                            }
                                            if($row['id']==$end_event[1]){
                                                $m2 = ($lang=='en'?$row['name_en']:$row['name_th']);
                                            }                                            
                                        }
                                        if($start_event[0]==$end_event[0]){
                                            if($start_event[1]==$end_event[1]){
                                                echo $start_event[2].'-'.$end_event[2].' '.$m1.' '.$start_event[0];
                                            }else{
                                                echo $start_event[2].' '.$m1.' - '.$end_event[2].' '.$m2.' '.$end_event[0];
                                            }
                                        }else{
                                            echo $start_event[2].' '.$m1.' '.$start_event[0].' - '.$end_event[2].' '.$m2.' '.$end_event[0];
                                        }
                                    ?>
                                </div>
                                <div class="absolute-center text-center w-75">
                                    <h2 class="ff-semibold fs-4 text-line-3"><?= ($lang=='en' && $event['name_en']!=""?$event['name_en']:$event['name']) ?></h2>
                                    <p class="text-line-3 line-height-22px"><?= ($lang=='en' && $event['shortdesc_en']!=""?character_limiter($event['shortdesc_en'],100):character_limiter($event['shortdesc'],100)) ?></p>
                                    <div class="btn-tg-group text-center">
                                        <a href="<?= site_url('event/post/'.($event['slug']!=""?$event['slug']:$event['id'])) ?>" class="btn btn-redmore text-uppercase letter-spacing-1"><?= lang('GlobalLang.readMore'); ?></a>
                                        <?php
                                            if($member['type']=='dealer' && $member['status']=='2'){
                                        ?>
                                            <a href="javascript:void(0)" class="btn-booking booking_event text-uppercase letter-spacing-1" data-event="<?= $event['id']; ?>">
                                                <img src="<?= site_url('assets/images/'.($lang=='en'?'book.gif':'book-th.gif')); ?>" alt="">
                                            </a>
                                        <?php }elseif($member['type']=='dealer' && $member['status']=='1'){ ?>
                                            <a href="" class="btn-booking text-uppercase letter-spacing-1" data-bs-toggle="modal" data-bs-target="#eventModal">
                                                <img src="<?= site_url('assets/images/'.($lang=='en'?'book.gif':'book-th.gif')); ?>" alt="">
                                            </a>
                                        <?php }else{ ?>
                                            <a href="" class="btn-booking text-uppercase letter-spacing-1" data-bs-toggle="modal" data-bs-target="#loginModal">
                                                <img src="<?= site_url('assets/images/'.($lang=='en'?'book.gif':'book-th.gif')); ?>" alt="">
                                            </a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
     <?php } ?>

    <section class="banner-ads">
        <div class="container">
            <?php
                //print_r($adsbanner);
                if($adsbanner){
                    foreach ($adsbanner as $ads){
                        //echo $ads['position'];
                        if($ads['position']=='p2'){
            ?>
                <a href="<?= $ads['link'] ?>" target="_blank">
                    <img src="<?= (is_file($ads['banner'])?site_url($ads['banner']):site_url('assets/images/ads-1298x276.jpg')); ?>" alt="">
                </a>
            <?php } } } ?>
        </div>
    </section>

    <?php if($articles){ ?>
    <section class="news-home ptb-2rem">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-8">
                    <div class="tg-title mb-4">
                        <h3 class="c-darkgold"><strong class="ff-bold"><?= lang('GlobalLang.knowledgeNews'); ?></strong></h3>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-4">
                    <div class="text-end">
                        <a href="<?= site_url('knowledge') ?>" class="c-black a-hover-darkgold view-all text-uppercase letter-spacing-1"><?= lang('GlobalLang.viewAll'); ?></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php                    
                    foreach($articles as $row){
                ?>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="shadow-lightgold h-100 rounded">
                            <img src="<?= (is_file($row['thumbnail'])?site_url($row['thumbnail']) : site_url('assets/images/img-default.jpg')) ?>" alt="<?= ($lang=='en' && $row['title_en']!=""?$row['title_en']:$row['title']) ?>">
                            <div class="p-4">
                                <div class="event-text mt-3">
                                    <h2 class="ff-dbadmanBold text-line-2">
                                        <a href="<?= site_url('knowledge/post/'.($row['slug']!=""?$row['slug']:$row['id'])) ?>" class="a-hover-darkgold">
                                            <?= ($lang=='en' && $row['title_en']!=""?$row['title_en']:$row['title']) ?>
                                        </a>
                                    </h2>
                                    <p class="text-line-3"><?= ($lang=='en' && $row['shortdesc_en']!=""?$row['shortdesc_en']:$row['shortdesc']) ?></p>
                                    <!-- <div class="event-date"><?= substr($row['created_at'],0,10) ?></div> -->
                                </div>
                                <div class="event-action mt-2">
                                    <a href="<?= site_url('knowledge/post/'.($row['slug']!=""?$row['slug']:$row['id'])) ?>" class="btn btn-black-border text-uppercase letter-spacing-1"><?= lang('GlobalLang.readMore'); ?></a>
                                    <span class="ms-3 ff-dbadmanBold share-social" data-url="<?= site_url('knowledge/post/'.($row['slug']!=""?$row['slug']:$row['id'])) ?>"><i class="fas fa-share-alt"></i> <?= lang('GlobalLang.share'); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <?php } ?>
    
    <section class="member-home member-content ptb-2rem">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-8">
                    <div class="tg-title mb-4">
                        <h3 class="c-darkgold"><strong class="ff-bold"><?= lang('GlobalLang.members'); ?></strong></h3>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-4">
                    <div class="text-end">
                        <a href="<?= site_url('member') ?>" class="c-black a-hover-darkgold view-all text-uppercase letter-spacing-1"><?= lang('GlobalLang.viewAll'); ?></a>
                    </div>
                </div>
            </div>
            <div class="member-list">
                <div class="slick-3-home slick-dots-2">
                    <?php
                        if($dealers){
                            foreach($dealers as $row){
                    ?>
                    <div class="item position-relative">
                        <div class="shadow-lightgold box-member d-flex">
                            <div class="w-50">
                                <?php
                                    if($row['profile']){
                                ?>
                                    <div class="slider-for-item">
                                        <img src="<?= (is_file($row['profile'])?site_url($row['profile']):site_url('assets/images/default-1000x750.jpg')) ?>" alt="<?= $row['company'] ?>">
                                    </div>
                                <?php }else{ ?>
                                    <div class="slider-for-item">
                                        <img src="<?= site_url('assets/images/default-1000x750.jpg') ?>" alt="<?= $row['company'] ?>">
                                    </div>
                                <?php } ?>
                                
                                <ul>
                                    <?php if($albums){
                                            $n=0;
                                            foreach($albums as $img){
                                                if($img['member_id'] == $row['id'] && $n<3){
                                                    $n++;
                                    ?>
                                        <li class="album-item">
                                            <img src="<?= (is_file($img['images'])?site_url($img['images']):site_url('assets/images/default-1000x750.jpg')) ?>" alt="<?= $row['company'] ?>">
                                        </li>
                                    <?php } } } if($n==0){ for($i=1;$i<4;$i++){ ?>
                                        <li class="album-item invisible">
                                            <img src="<?= (site_url('assets/images/default-1000x750.jpg')) ?>" alt="<?= $row['company'] ?>">
                                        </li>
                                    <?php } } ?>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="w-50 position-relative">
                                <div class="ps-3 text-center">
                                    <h2 class="ff-dbamanBold fs-6 text-uppercase letter-spacing-1 mb-0 line-height-16px text-line-4"><?= $row['company'] ?></h2>
                                    <div class="cate-type">
                                        <strong class="ff-dbadmanBold c-darkgold fs-5"><?= lang('GlobalLang.product-type') ?></strong>
                                        <span class="text-line-2 line-height-18px mt-minus-5px fs-5"><?= $row['product'] ?></span>
                                    </div>
                                    <div class="cate-type">
                                        <strong class="ff-dbadmanBold c-darkgold fs-5"><?= lang('GlobalLang.business-type') ?></strong>
                                        <span class="text-line-2 line-height-18px mt-minus-5px fs-5"><?= $row['business'] ?></span>
                                    </div>
                                    <div class="event-action">
                                        <?php
                                            $member_id = $row['id'];
                                            if($row['code']){
                                                $member_id = $row['code'];
                                            }
                                        ?>
                                        <?php if($userdata['logged_member']){ ?>
                                            <a href="<?= site_url('member/id/'.$member_id); ?>" class="btn btn-black-border text-uppercase letter-spacing-1 fs-6"><?= lang('GlobalLang.viewProfile'); ?></a>
                                        <?php }else{ ?>
                                            <a href="javascript:void(0)" class="btn btn-black-border text-uppercase letter-spacing-1 fs-6" data-bs-toggle="modal" data-bs-target="#loginModal" onclick="viewMember('<?= $member_id; ?>');"><?= lang('GlobalLang.viewProfile'); ?></a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } }else{ ?>
                        <div class="col-12 mt-4 text-center">
                            <span>ไม่พบข้อมูล</span>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>

    <section class="banner-ads pb-5">
        <div class="container">
            <?php
                //print_r($adsbanner);
                if($adsbanner){
                    foreach ($adsbanner as $ads){
                        //echo $ads['position'];
                        if($ads['position']=='p3'){
            ?>
                <a href="<?= $ads['link'] ?>" target="_blank">
                    <img src="<?= (is_file($ads['banner'])?site_url($ads['banner']):site_url('assets/images/ads-1298x276.jpg')); ?>" alt="">
                </a>
            <?php } } } ?>
        </div>
    </section>

    <section class="singup-home">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="singup-form text-center h-100">
                        <div class="head-sect">
                            <h3 class="ff-dbadmanBold text-uppercase"><?= lang('GlobalLang.memberTgjta') ?></h3>
                            <p class="fs-4"><?= lang('HomeLang.memberTgjtaText') ?></p>
                        </div>
                        <?php 
                            if($member){
                        ?>
                            
                        <?php }else{ ?>                                
                            <button type="button" class="btn btn-darkgold c-white w-100 a-hover-white btn-register member-tgjta" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#registerModal"><?= lang('GlobalLang.btnmember') ?></button>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="sign-member text-center">
                        <div class="head-sect">
                            <h3 class="ff-dbadmanBold text-uppercase"><?= lang('GlobalLang.memberPerson') ?></h3>
                            <p class="fs-4"><?= lang('HomeLang.memberPersonText') ?></p>
                        </div>
                        <div class="body-sect">
                            <?php 
                                if($member){
                            ?>
                                
                            <?php }else{ ?>                                
                                <button type="button" class="btn btn-darkgold c-white w-100 a-hover-white btn-register member-personal" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#registerModal"><?= lang('GlobalLang.btnjoin') ?></button>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="map-home">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.9353333358026!2d100.51798321488828!3d13.722364901671902!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e298cfb8058255%3A0xbaeba354c2284a26!2sThai%20Gem%20and%20Jewelry%20Traders%20Association!5e0!3m2!1sen!2sth!4v1630665357250!5m2!1sen!2sth"  height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </section>

    <section class="contact-home ptb-2rem">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="contact-info">
                        <strong class="ff-semibold d-block fs-2">TGJTA</strong>
                        <strong class="ff-semibold d-block">Thai Gem and Jewelry Traders Association</strong>
                        <p class="mt-4"><?= lang('GlobalLang.addressInfo'); ?></p>
                        <div class="social-contact">
                            <a href="tel:02-630-1390"><i class="fas fa-mobile-alt"></i> 02-630-1390</a>
                            <a href="http://wa.me/66981023919" target="_blank"><i class="fab fa-weixin"></i> http://wa.me/66981023919</a>
                            <a href="http://www.thaigemjewelry.or.th/"><i class="fas fa-globe"></i> http://www.thaigemjewelry.or.th/</a>
                            <a href="mailto:info@thaigemjewelry.org"><i class="far fa-envelope"></i> info@thaigemjewelry.org</a>
                        </div>
                        <div class="follow-us">
                            <strong class="ff-dbadmanBold fs-3 text-uppercase letter-spacing-1"><?= lang('GlobalLang.followUs'); ?></strong>
                            <a href="https://www.facebook.com/tgjta" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://www.instagram.com/tgjta919" target="_blank"><i class="fab fa-instagram"></i></a>
                            <a href="https://lin.ee/kH0e06R" target="_blank"><i class="fab fa-line"></i></a>
                            <a href="https://www.youtube.com/c/ThaiGemandJewelryTradersAssociation" target="_blank"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="contact-form">
                        <strong class="ff-dbadmanBold d-block fs-2 mb-3"><?= lang('GlobalLang.contactForm'); ?></strong>
                        <form action="<?= site_url('thaigem/mailcontact') ?>" method="POST">                            
                            <div class="form-group">
                                <input type="text" class="form-control" name="txt_name" placeholder="<?= lang('GlobalLang.name'); ?>" required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="txt_email" aria-describedby="emailHelp" placeholder="<?= lang('GlobalLang.email'); ?>" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="txt_phone" placeholder="<?= lang('GlobalLang.phoneNumber'); ?>" required>
                            </div>
                            <div class="form-group">
                                <textarea name="txt_message" id="txt_message" class="form-control" placeholder="<?= lang('GlobalLang.message'); ?>" required></textarea>
                            </div>
                            <button type="submit" class="btn bg-darkgold c-white ff-dbadmanBold w-100"><?= lang('GlobalLang.submit'); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?= $this->endSection() ?>

<?= $this->section("scripts") ?>
    <?= $this->include('template/slick-slide') ?>
<?= $this->endSection() ?>