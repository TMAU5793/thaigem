<?= $this->extend("front/app") ?>
<?= $this->section("content") ?>

    <section class="knowledge-desc pt-2rem">
        <div class="container">
            <div class="text-center bread-crumbs mb-3">
                <h1 class="ff-dbadmanBold"><?= ($lang=='en' && $info['title_en']!=""?$info['title_en']:$info['title']) ?></h1>
                <small>
                    <a href="<?= site_url('knowledge') ?>" class="text-decoration-none"><?= lang('GlobalLang.knowledgeNews'); ?></a> >> 
                    <span class="c-darkgold"><?= ($lang=='en' && $info['title_en']!=""?$info['title_en']:$info['title']) ?></span>
                </small>
            </div>
            
            <div class="single-desc">
                <?= ($lang=='en' && $info['desc_en']!=""?$info['desc_en']:$info['desc']) ?>
            </div>

            <div class="share-post text-end mt-4 mb-4">
                <span class="ff-dbadmanBold share-social" data-url="<?= site_url('knowledge/post/'.($info['slug']!=""?$info['slug']:$info['id'])) ?>"><i class="fas fa-share-alt"></i> <?= lang('GlobalLang.share'); ?></span>
            </div>
            <!-- <div class="event-date mt-3 mb-3"><?= lang('GlobalLang.publish') ?> : <?= substr($info['created_at'],0,10) ?></div> -->
        </div>
        
    </section>

    <section class="relate-list mb-5">
        <div class="container">
            <div class="title"><h3><?= lang('GlobalLang.related-post') ?></h3></div>
            <div class="row">
                <?php
                    if($related){
                        foreach ($related as $row){
                ?>
                <div class="col-md-4">
                    <div class="shadow-lightgold h-100 rounded">
                        <img src="<?= (is_file($row['thumbnail'])?site_url($row['thumbnail']) : site_url('assets/images/img-default.jpg')) ?>" alt="<?= ($lang=='en' && $row['title_en']!=""?$row['title_en']:$row['title']) ?>">
                        <div class="p-4">
                            <div class="event-text">
                                <h2 class="ff-dbadmanBold text-line-1">
                                    <a href="<?= site_url('knowledge/post/'.($row['slug']!=""?$row['slug']:$row['id'])) ?>" class="a-hover-darkgold">
                                        <?= ($lang=='en' && $row['title_en']!=""?$row['title_en']:$row['title']) ?>
                                    </a>
                                </h2>
                                <p class="text-line-2 mb-0"><?= ($lang=='en' && $row['shortdesc_en']!=""?$row['shortdesc_en']:$row['shortdesc']) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } }else{ ?>
                    <div class="notfound"><?= lang('GlobalLang.notfound') ?></div>
                <?php } ?>
            </div>
        </div>
    </section>
<?= $this->endSection() ?>