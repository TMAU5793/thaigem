<?= $this->extend("front/app") ?>
<?= $this->section("content") ?>

    <section class="banner position-relative">
        <img src="<?= site_url('assets/images/front/banner-knowledge.jpg') ?>" alt="">
    </section>

    <section class="knowledge-desc pt-2rem">
        <div class="container">
            <div class="text-center bread-crumbs mb-3">
                <h1 class="ff-semibold fs-3">Knowledge & News</h1>
                <small>
                    <a href="<?= site_url('event') ?>" class="text-decoration-none ff-semibold"><?= lang('globallang.knowledgeNews'); ?></a> >> 
                    <span class="c-darkgold">Event Title</span>
                </small>
            </div>
            <img src="<?= site_url('assets/images/front/knowledge-img.jpg') ?>" alt="">
            <div class="event-date mt-3 mb-3">05/06/2564</div>

            <p>Lorem Ipsum is simply dummy text of the printingand typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. Lorem Ipsum is simply dummy text of the printingand typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the1500s, when an unknown printer took a galley oftype and scrambled it to make a type specimen book.</p>
            <p>Lorem Ipsum is simply dummy text of the printingand typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. Lorem Ipsum is simply dummy text of the printingand typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the1500s, when an unknown printer took a galley oftype and scrambled it to make a type specimen book.</p>

            <div class="share-post text-end mt-4 mb-4">
                <span class="ff-semibold"><i class="fas fa-share-alt"></i> <?= lang('globallang.share'); ?></span>
            </div>            
        </div>
        
    </section>
<?= $this->endSection() ?>