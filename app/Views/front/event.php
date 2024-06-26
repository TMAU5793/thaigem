<?= $this->extend("front/app") ?>
<?= $this->section("content") ?>

    <?php if($banner){ ?>
        <section class="banner-home">
        <?php if($banner['link']!=''){ ?>
            <a href="<?= $banner['link'] ?>" target="_blank">
                <img src="<?= (is_file($banner['banner'])?site_url($banner['banner']):site_url('assets/images/img-default.jpg')) ?>" class="hide-575" alt="thai gem">
                <img src="<?= (is_file($banner['banner_mobile'])?site_url($banner['banner_mobile']):site_url('assets/images/img-default.jpg')) ?>" class="show-575" alt="thai gem">
            </a>
        <?php }else{ ?>
            <img src="<?= (is_file($banner['banner'])?site_url($banner['banner']):site_url('assets/images/img-default.jpg')) ?>" class="hide-575" alt="thai gem">
            <img src="<?= (is_file($banner['banner_mobile'])?site_url($banner['banner_mobile']):site_url('assets/images/img-default.jpg')) ?>" class="show-575" alt="thai gem">
        <?php } ?>
        </section>
    <?php } ?>

    <section class="event-content ptb-2rem">
        <div class="container">
            <div class="text-center title">
                <h1 class="text-uppercase ff-dbadmanBold"><?= lang('GlobalLang.events'); ?></h1>
            </div>

            <div class="row">
                <?php
                    if($info){
                        foreach ($info as $row){
                ?>
                    <div class="col-lg-4 col-md-6 col-sm-6 mt-4">
                        <div class="shadow-lightgold h-100 rounded">
                            <img src="<?= (is_file($row['thumbnail'])?site_url($row['thumbnail']) : site_url('assets/images/img-default.jpg')) ?>" alt="<?= ($lang=='en' && $row['name_en']!=""?$row['name_en']:$row['name']) ?>">
                            <div class="p-4">
                                <div class="event-text">
                                    <h2 class="ff-dbadmanBold text-line-2">
                                        <a href="<?= site_url('event/post/'.($row['slug']!=""?$row['slug']:$row['id'])) ?>" class="a-hover-darkgold">
                                            <?= ($lang=='en' && $row['name_en']!=""?$row['name_en']:$row['name']) ?>
                                        </a>
                                    </h2>
                                    <p class="text-line-3 line-height-22px"><?= ($lang=='en' && $row['shortdesc_en']!=""?$row['shortdesc_en']:$row['shortdesc']) ?></p>
                                    
                                </div>
                                <div class="event-action mt-2">
                                    <?php
                                        $start_event = explode('-',$row['start_event']);
                                        $end_event = explode('-',$row['end_event']);
                                        $eventdate = '';
                                        foreach ($month as $item){
                                            if($item['id']==$start_event[1]){
                                                $m1 = ($lang=='en'?$item['name_en']:$item['name_th']);
                                            }
                                            if($item['id']==$end_event[1]){
                                                $m2 = ($lang=='en'?$item['name_en']:$item['name_th']);
                                            }                                            
                                        }
                                        if($start_event[0]==$end_event[0]){
                                            if($start_event[1]==$end_event[1]){
                                                $eventdate = $start_event[2].'-'.$end_event[2].' '.$m1.' '.$start_event[0];
                                            }else{
                                                $eventdate = $start_event[2].' '.$m1.' - '.$end_event[2].' '.$m2.' '.$end_event[0];
                                            }
                                        }else{
                                            $eventdate = $start_event[2].' '.$m1.' '.$start_event[0].' - '.$end_event[2].' '.$m2.' '.$end_event[0];
                                        }
                                    ?>
                                    <div class="event-date fs-5"><?= lang('GlobalLang.eventDate').' : '.$eventdate ?></div>
                                    <a href="<?= site_url('event/post/'.($row['slug']!=""?$row['slug']:$row['id'])) ?>" class="btn btn-black-border text-uppercase letter-spacing-1"><?= lang('GlobalLang.readMore'); ?></a>
                                    <span class="ms-3 ff-dbadmanBold share-social" data-url="<?= site_url('event/post/'.($row['slug']!=""?$row['slug']:$row['id'])) ?>"><i class="fas fa-share-alt"></i> <?= lang('GlobalLang.share'); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } } else{ ?>
                    <div class="col-12 text-center">ไม่พบข้อมูล</div>
                <?php } ?>                
            </div>
            <?php if(isset($pager)) { ?>
                <nav class="navigation-center mt-5 border-none">
                    <?= $pager->links(); ?>
                </nav>
            <?php } ?>
        </div>
        
    </section>

<?= $this->endSection() ?>