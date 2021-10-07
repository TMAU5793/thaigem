<?= $this->extend("front/app") ?>
<?= $this->section("content") ?>

    <section class="banner position-relative">
        <img src="<?= site_url('assets/images/banner/event.jpg') ?>" alt="">
    </section>

    <section class="event-content ptb-2rem">
        <div class="container">
            <div class="text-center title">
                <h1 class="text-uppercase ff-semibold fs-3"><?= lang('GlobalLang.event'); ?></h1>
            </div>

            <div class="row">
                <?php $n=0; for($i=1;$i<10;$i++){ if($n==3){$n=1;}else{$n++;} ?>
                    <div class="col-md-4 mt-4">
                        <img src="<?= site_url('assets/images/front/item-'.$n.'.jpg') ?>" alt="">
                        <div class="event-text mt-3">
                            <h2 class="ff-semibold fs-5">Event Title</h2>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting in dustry. Lorem Ipsum has been</p>
                            <div class="event-date">05/06/2564</div>
                        </div>
                        <div class="event-action mt-2">
                            <a href="<?= site_url('event/desc'); ?>" class="btn btn-black-border fs-7"><?= lang('GlobalLang.readMore'); ?></a>
                            <span class="ms-3 ff-semibold"><i class="fas fa-share-alt"></i> <?= lang('GlobalLang.share'); ?></span>
                        </div>
                    </div>
                <?php } ?>                
            </div>
        </div>
        
    </section>

<?= $this->endSection() ?>