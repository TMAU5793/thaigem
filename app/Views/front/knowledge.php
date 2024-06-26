<?= $this->extend("front/app") ?>
<?= $this->section("content") ?>

    <section class="knowledge-content ptb-2rem">
        <div class="text-center title mb-4">
            <h1 class="text-uppercase ff-semibold fs-3"><?= lang('GlobalLang.knowledgeNews'); ?></h1>
        </div>
        <div class="container">
            <div class="knowledge-hot slick-1-item slick-dots-2">
                
            <?php
                if($hot_article){
                    foreach($hot_article as $row){
            ?>
                <div class="bg-lightgold position-relative">
                    <div class="w-50">
                        <div class="hot-img">
                            <img src="<?= (is_file($row['thumbnail'])?site_url($row['thumbnail']) : site_url('assets/images/img-default.jpg')) ?>" alt="<?= ($lang=='en' && $row['title_en']!=""?$row['title_en']:$row['title']) ?>">
                        </div>
                    </div>
                    <div class="item-body w-50 plr-4rem position-absolute translate-middle-y top-50 end-0">
                        <!-- <div class="event-date mt-3 mb-3"><?= substr($row['created_at'],0,10) ?></div> -->
                        <h1 class="ff-dbadmanBold text-line-2"><?= ($lang=='en' && $row['title_en']!=""?$row['title_en']:$row['title']) ?></h1>
                        <p class="text-line-3"><?= ($lang=='en' && $row['shortdesc_en']!=""?$row['shortdesc_en']:$row['shortdesc']) ?></p>
                        
                        <div class="event-action mt-2">
                            <a href="<?= site_url('knowledge/post/'.($row['slug']!=""?$row['slug']:$row['id'])) ?>" class="btn btn-black-border text-uppercase letter-spacing-1"><?= lang('GlobalLang.readMore'); ?></a>
                            <span class="ms-3 ff-dbadmanBold share-social" data-url="<?= site_url('knowledge/post/'.($row['slug']!=""?$row['slug']:$row['id'])) ?>"><i class="fas fa-share-alt"></i> <?= lang('GlobalLang.share'); ?></span>                            
                        </div>
                    </div>
                </div>
            <?php } } ?>

            </div>
        </div>

        <div class="container mt-5">
            <div class="row">
                <?php
                    if($info){                        
                        foreach ($info as $row){                            
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
                                    <p class="text-line-3 line-height-22px"><?= ($lang=='en' && $row['shortdesc_en']!=""?$row['shortdesc_en']:$row['shortdesc']) ?></p>                                    
                                </div>
                                <div class="event-action mt-2">
                                    <!-- <div class="event-date"><small><?= lang('GlobalLang.date').' : '.substr($row['created_at'],0,10) ?></small></div> -->
                                    <a href="<?= site_url('knowledge/post/'.($row['slug']!=""?$row['slug']:$row['id'])) ?>" class="btn btn-black-border text-uppercase letter-spacing-1"><?= lang('GlobalLang.readMore'); ?></a>
                                    <span class="ms-3 ff-dbadmanBold share-social" data-url="<?= site_url('knowledge/post/'.($row['slug']!=""?$row['slug']:$row['id'])) ?>"><i class="fas fa-share-alt"></i> <?= lang('GlobalLang.share'); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } } else{ ?>
                    <div class="col-12 text-center">ไม่พบข้อมูล</div>
                <?php } ?>
            </div>
            <?php if(isset($pager)) { ?>
                <nav class="navigation-center mt-5">
                    <?= $pager->links(); ?>
                </nav>
            <?php } ?>
        </div>
        
    </section>

<?= $this->endSection() ?>

<?= $this->section("scripts") ?>
    <?= $this->include('template/slick-slide') ?>
<?= $this->endSection() ?>