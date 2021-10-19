<?= $this->extend("front/app") ?>
<?= $this->section("content") ?>

    <section class="banner position-relative">
        <img src="<?= site_url('assets/images/banner/about.jpg') ?>" alt="">
    </section>

    <section class="about-content ptb-2rem">
        <div class="container">
            <div class="text-center">
                <h3 class="text-uppercase mb-3"><?= $meta_title ?></h3>
                <p><?= lang('AboutLang.subtitle'); ?></p>
            </div>
            <div class="about-desc mb-5">
                <p><?= lang('AboutLang.desc'); ?></p>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <img src="<?= site_url('assets/images/front/about-vision.jpg'); ?>" alt="">
                </div>
                <div class="col-md-8 ps-5">
                    <div class="about-vision pt-5 h-50">
                        <h4 class="ff-semibold"><?= lang('AboutLang.vision'); ?></h4>
                        <P><?= lang('AboutLang.visionText'); ?></P>
                    </div>
                    <div class="about-mission h-50">
                        <h4 class="ff-semibold"><?= lang('AboutLang.mission'); ?></h4>
                        <P><?= lang('AboutLang.missionText'); ?></P>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?= $this->endSection() ?>