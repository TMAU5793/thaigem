<?= $this->extend("front/app") ?>
<?= $this->section("content") ?>

    <section class="banner position-relative">
        <img src="<?= site_url('assets/images/front/banner-knowledge.jpg') ?>" alt="">
    </section>

    <section class="knowledge-content ptb-2rem">
        <div class="text-center title mb-4">
            <h1 class="text-uppercase ff-semibold fs-3"><?= lang('globallang.knowledgeNews'); ?></h1>
        </div>
        <div class="container">
            <div class="knowledge-hot slick-1-item slick-dots-2">                
                <div class="bg-lightgold position-relative">
                    <div class="w-50">
                        <div class="hot-img">
                            <img src="<?= site_url('assets/images/front/knowledge-hot.jpg') ?>" alt="">
                        </div>
                    </div>
                    <div class="item-body w-50 plr-4rem position-absolute translate-middle-y top-50 end-0">
                        <div class="event-date mt-3 mb-3">05/06/2564</div>
                        <h1 class="ff-semibold">Gemstones Knowledge</h1>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                        
                        <div class="event-action mt-2">
                            <a href="<?= site_url('knowledge/desc'); ?>" class="btn btn-black-border fs-7"><?= lang('globallang.readMore'); ?></a>
                            <span class="ms-3 ff-semibold"><i class="fas fa-share-alt"></i> <?= lang('globallang.share'); ?></span>
                        </div>
                    </div>
                </div>

                <div class="bg-lightgold position-relative">
                    <div class="w-50">
                        <div class="hot-img">
                            <img src="<?= site_url('assets/images/front/knowledge-hot.jpg') ?>" alt="">
                        </div>
                    </div>
                    <div class="item-body w-50 plr-4rem position-absolute translate-middle-y top-50 end-0">
                        <div class="event-date mt-3 mb-3">05/06/2564</div>
                        <h1 class="ff-semibold">Gemstones Knowledge</h1>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                        
                        <div class="event-action mt-2">
                            <a href="<?= site_url('knowledge/desc'); ?>" class="btn btn-black-border fs-7"><?= lang('globallang.readMore'); ?></a>
                            <span class="ms-3 ff-semibold"><i class="fas fa-share-alt"></i> <?= lang('globallang.share'); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-5">
            <div class="row">
                <?php $n=0; for($i=1;$i<10;$i++){ if($n==3){$n=1;}else{$n++;} ?>
                    <div class="col-md-4 mt-4">
                        <img src="<?= site_url('assets/images/front/item-'.$n.'.jpg') ?>" alt="">
                        <div class="event-text mt-3">
                            <h2 class="ff-semibold fs-5">Knowledge Title</h2>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting in dustry. Lorem Ipsum has been</p>
                            <div class="event-date">05/06/2564</div>
                        </div>
                        <div class="event-action mt-2">
                            <a href="<?= site_url('knowledge/desc'); ?>" class="btn btn-black-border fs-7"><?= lang('globallang.readMore'); ?></a>
                            <span class="ms-3 ff-semibold"><i class="fas fa-share-alt"></i> <?= lang('globallang.share'); ?></span>
                        </div>
                    </div>
                <?php } ?>                
            </div>
        </div>
        
    </section>

<?= $this->endSection() ?>

<?= $this->section("scripts") ?>
    <?= $this->include('template/slick-slide') ?>
<?= $this->endSection() ?>