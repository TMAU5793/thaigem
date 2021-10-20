<?= $this->extend("front/app") ?>
<?= $this->section("content") ?>

    <section class="banner position-relative">
        <img src="<?= site_url('assets/images/banner/knowledge.jpg') ?>" alt="">
    </section>

    <section class="knowledge-desc pt-2rem">
        <div class="container">
            <div class="text-center bread-crumbs mb-3">
                <h1 class="ff-semibold fs-3"><?= ($lang=='en' && $info['title_en']!=""?$info['title_en']:$info['title']) ?></h1>
                <small>
                    <a href="<?= site_url('knowledge') ?>" class="text-decoration-none"><?= lang('GlobalLang.knowledgeNews'); ?></a> >> 
                    <span class="c-darkgold"><?= ($lang=='en' && $info['title_en']!=""?$info['title_en']:$info['title']) ?></span>
                </small>
            </div>
            
            <div class="single-desc">
                <?= ($lang=='en' && $info['desc_en']!=""?$info['desc_en']:$info['desc']) ?>
            </div>

            <div class="share-post text-end mt-4 mb-4">
                <span class="ff-semibold share-social" data-url="<?= site_url('knowledge/post/'.($info['slug']!=""?$info['slug']:$info['id'])) ?>"><i class="fas fa-share-alt"></i> <?= lang('GlobalLang.share'); ?></span>
            </div>
            <div class="event-date mt-3 mb-3">เผยแพร่ : <?= substr($info['created_at'],0,10) ?></div>
        </div>
        
    </section>
<?= $this->endSection() ?>