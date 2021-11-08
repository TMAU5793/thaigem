<?= $this->extend("front/app") ?>
<?= $this->section("content") ?>

    <section class="banner">
        <img src="<?= site_url('assets/images/banner/home.jpg') ?>" alt="">
    </section>
    
    <section class="category-home">
        <div class="bg-title ptb-2rem">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-12 col-order-2">
                        <div class="ff-dbadmanBold fs-1">Fulfill your business opportunities with our trusted and reliable members.</div>
                        <div class="tg-title mt-5rem">
                            <h3 class="c-darkgold"><?= lang('HomeLang.category'); ?></span></h3>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-order-1">
                        <?= $this->include('template/gold-price') ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="category-list ptb-2rem">
            <div class="container">
                <div class="row">
                    <?php
                        if($catergory){
                            foreach($catergory as $row){
                    ?>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-6 cateory-item mb-3">
                            <div class="box-shadow-lightgold cursor-pointer zoom-in" onclick="location.href='<?= site_url('member/filter?c='.$row['id']) ?>'">
                                <div class="item-img">
                                    <img src="<?= (is_file($row['thumbnail'])?site_url($row['thumbnail']):site_url('assets/images/img-default.jpg')) ?>" alt="<?= ($row['name_en']==""?$row['name_th'] : $row['name_'.$lang] ) ?>">
                                </div>
                                <div class="item-text text-center position-relative">
                                    <h2 class="ff-dbadmanBold absolute-center w-100"><?= ($row['name_en']==""?$row['name_th'] : $row['name_'.$lang] ) ?></h2>                                    
                                </div>
                            </div>
                        </div>
                    <?php } } ?>
                </div>
            </div>
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
                            <strong class="ff-bold nav-link active" data-bs-toggle="pill" data-bs-target="#pills-1"><i class="fas fa-square"></i> <?= lang('GlobalLang.diamonds'); ?></strong>
                        </li>
                        <li class="nav-item" role="presentation">
                            <strong class="ff-bold nav-link" data-bs-toggle="pill" data-bs-target="#pills-2"><i class="fas fa-square"></i> <?= lang('GlobalLang.ruby'); ?></strong>
                        </li>
                        <li class="nav-item" role="presentation">
                            <strong class="ff-bold nav-link" data-bs-toggle="pill" data-bs-target="#pills-3"><i class="fas fa-square"></i> <?= lang('GlobalLang.sapphire'); ?></strong>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-1" role="tabpanel" aria-labelledby="pills-1-tab">
                    <div class="table-price">
                        <img src="<?= site_url('assets/images/home/tbl-price.jpg') ?>" alt="<?= lang('GlobalLang.diamonds'); ?>">
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-2" role="tabpanel" aria-labelledby="pills-2-tab">
                    <div class="table-price">
                        <img src="<?= site_url('assets/images/home/tbl-price.jpg') ?>" alt="<?= lang('GlobalLang.diamonds'); ?>">
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-3" role="tabpanel" aria-labelledby="pills-3-tab">
                    <div class="table-price">
                        <img src="<?= site_url('assets/images/home/tbl-price.jpg') ?>" alt="<?= lang('GlobalLang.diamonds'); ?>">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="event-home ptb-2rem">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-8">
                    <div class="tg-title">
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
                    if($events){
                        foreach ($events as $event){
                ?>
                    <div class="event-item">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="<?= (is_file($event['thumbnail'])?site_url($event['thumbnail']):site_url('assets/images/img-default.jpg')) ?>" alt="<?= ($lang=='en'?$event['name_en']:$event['name']) ?>">
                            </div>
                            <div class="col-md-6 position-relative">
                                <div class="event-date text-end pt-3 pe-4"><span><?= substr($event['created_at'],0,10) ?></span></div>
                                <div class="absolute-center text-center w-75">
                                    <h2 class="ff-semibold fs-4"><?= ($lang=='en'?$event['name_en']:$event['name']) ?></h2>
                                    <p><?= ($lang=='en'?character_limiter($event['shortdesc_en'],100):character_limiter($event['shortdesc'],100)) ?></p>
                                    <div class="btn-tg-group text-center">
                                        <a href="<?= site_url('event/post/'.($event['slug']!=""?$event['slug']:$event['id'])) ?>" class="btn btn-redmore btn-black-border text-uppercase letter-spacing-1"><?= lang('GlobalLang.readMore'); ?></a>
                                        <?php
                                            if($member['type']=='dealer' && $member['status']=='2'){
                                        ?>
                                            <a href="javascript:void(0)" class="btn btn-booking btn-black-border booking_event text-uppercase letter-spacing-1" data-event="<?= $event['id']; ?>"><?= lang('GlobalLang.bookNow'); ?></a>
                                        <?php }elseif($member['type']=='dealer' && $member['status']=='1'){ ?>
                                            <a href="" class="btn btn-booking btn-black-border text-uppercase letter-spacing-1" data-bs-toggle="modal" data-bs-target="#eventModal"><?= lang('GlobalLang.bookNow'); ?></a>
                                        <?php }else{ ?>
                                            <a href="" class="btn btn-booking btn-black-border text-uppercase letter-spacing-1" data-bs-toggle="modal" data-bs-target="#loginModal"><?= lang('GlobalLang.bookNow'); ?></a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } } ?>
            </div>
        </div>
    </section>

    <section class="news-home ptb-2rem">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-8">
                    <div class="tg-title">
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
                    if($articles){
                        foreach($articles as $row){

                ?>
                    <div class="col-lg-4 col-md-6 col-sm-6  mt-4">
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
                                    <div class="event-date"><?= substr($row['created_at'],0,10) ?></div>
                                </div>
                                <div class="event-action mt-2">
                                    <a href="<?= site_url('knowledge/post/'.($row['slug']!=""?$row['slug']:$row['id'])) ?>" class="btn btn-black-border text-uppercase letter-spacing-1"><?= lang('GlobalLang.readMore'); ?></a>
                                    <span class="ms-3 ff-dbadmanBold share-social" data-url="<?= site_url('knowledge/post/'.($row['slug']!=""?$row['slug']:$row['id'])) ?>"><i class="fas fa-share-alt"></i> <?= lang('GlobalLang.share'); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } } ?>
            </div>
        </div>
    </section>

    <section class="member-home ptb-2rem">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="tg-title">
                        <h3 class="c-darkgold"><strong class="ff-bold"><?= lang('GlobalLang.members'); ?></strong></h3>
                    </div>
                </div>
            </div>
            <div class="member-list slick-2-item slick-dots-2 mb-5 mt-3">
                <?php 
                    use App\Models\Account\AlbumModel;
                    $model = new AlbumModel();
                    if($dealers){
                        foreach($dealers as $dealer){
                            $album1 = $model->where('member_id',$dealer['id'])->first();
                            $album3 = $model->where('member_id',$dealer['id'])->findAll(3);
                            if($album1){
                ?>
                <div class="member-item">
                    <div class="shadow-lightgold h-100 rounded w-100 d-inline-flex p-3">
                        <div class="w-50 ac-album">
                            <div class="mian-img">                                
                                <div class="img-item">
                                    <img src="<?= (is_file($album1['images'])?site_url($album1['images']):site_url('assets/images/img-default.jpg')) ?>" alt="<?= $dealer['name'].' '.$dealer['lastname'] ?>">
                                </div>
                            </div>
                            <div class="sub-img album-item">
                                <?php
                                    if($album3){
                                        foreach($album3 as $album){
                                ?>
                                    <div class="img-item">
                                        <img src="<?= (is_file($album['images'])?site_url($album['images']):site_url('assets/images/img-default.jpg')) ?>" alt="<?= $dealer['name'].' '.$dealer['lastname'] ?>">
                                    </div>
                                <?php } } ?>
                            </div>
                        </div>
                        <div class="w-50 position-relative">
                            <div class="absolute-center text-center w-100 p-3">
                                <h2 class="ff-dbadmanBold c-darkgold fs-4 text-uppercase"><?= $dealer['name'].' '.$dealer['lastname'] ?></h2>
                                <p><?= character_limiter($dealer['about'],40) ?></p>
                                <div class="btn-tg-group mt-5">
                                    <a href="<?= site_url('member/id/'.$dealer['id']); ?>" class="btn btn-redmore btn-black-border text-uppercase letter-spacing-1"><?= lang('GlobalLang.viewProfile'); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } } } ?>
            </div>
        </div>
    </section>

    <section class="singup-home">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="singup-form text-center">
                        <div class="head-sect">
                            <?= lang('HomeLang.newsletterText'); ?>
                        </div>
                        <form id="frm-singup" class="mt-5" action="<?= site_url('thaigem/newsLetter') ?>" method="POST">
                            <?php if(isset($errors_newsleeter)): ?>
                                <div class="alert alert-danger"><?= $errors_newsleeter->listErrors() ?></div>
                            <?php endif;?>
                            <div class="input-group">
                                <input type="email" name="news_email" class="form-control" placeholder="<?= lang('GlobalLang.email'); ?>" require>
                            </div>
                            <div class="btn-singup-group mt-3">
                                <button type="button" id="btn_newsletter" class="btn btn-darkgold c-white w-100 a-hover-white"><?= lang('GlobalLang.subscribe'); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="sign-member text-center">
                        <div class="head-sect">
                            <?= lang('HomeLang.signupText'); ?>
                        </div>
                        <div class="body-sect mt-5">
                            <?php 
                                if($member){
                            ?>
                                <button type="button" class="btn btn-darkgold c-white w-100 a-hover-white" onclick="location.href='<?= site_url('account') ?>'"><?= lang('GlobalLang.viewProfile'); ?></button>
                            <?php }else{ ?>                                
                                <button type="button" class="btn btn-darkgold c-white w-100 a-hover-white" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#registerModal"><?= lang('GlobalLang.register'); ?></button>
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
                        <form action="">                            
                            <div class="form-group">
                                <input type="text" class="form-control" name="txt_name" placeholder="<?= lang('GlobalLang.name'); ?>">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="txt_email" aria-describedby="emailHelp" placeholder="<?= lang('GlobalLang.email'); ?>">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="txt_phone" placeholder="<?= lang('GlobalLang.phoneNumber'); ?>">
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