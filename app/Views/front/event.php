<?= $this->extend("front/app") ?>
<?= $this->section("content") ?>

    <section class="event-content ptb-2rem">
        <div class="container">
            <div class="text-center title">
                <h1 class="text-uppercase ff-dbadmanBold"><?= lang('GlobalLang.event'); ?></h1>
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
                                    <p class="text-line-3 text-line-3"><?= ($lang=='en' && $row['shortdesc_en']!=""?$row['shortdesc_en']:$row['shortdesc']) ?></p>
                                    <div class="event-date fs-5"><?= lang('GlobalLang.eventDate').' : '.substr($row['start_event'],0,10) ?></div>
                                </div>
                                <div class="event-action mt-2">
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
            <nav class="navigation-center mt-5 border-none">
                <?= $pager->links(); ?>
            </nav>
        </div>
        
    </section>

<?= $this->endSection() ?>