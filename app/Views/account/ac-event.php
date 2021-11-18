<?= $this->extend("front/app") ?>
<?= $this->section("content") ?>

    <section class="banner">
        <img src="<?= site_url('assets/images/account/banner.jpg') ?>" alt="">
    </section>    

    <section class="event-body mb-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <?php
                        if (session()->get('userdata')) {
                            echo $this->include('account/ac-menu');
                        }
                    ?>
                    <div class="content-body">
                        <div class="content-title"><strong class="ff-semibold fs-3"><?= $meta_title ?></strong></div>
                        <div class="event-section mt-4">
                            <div class="event-nav slider-nav slick-dotted">
                                <?php
                                    if($bookings){
                                        foreach ($events as $event){
                                            foreach ($bookings as $booking){
                                                if($event['id'] == $booking['event_id']){
                                ?>
                                    <div class="event-item-box border-lightgray">
                                        <img src="<?= (is_file($event['thumbnail'])?site_url($event['thumbnail']):site_url('assets/images/img-default.jpg')) ?>" alt="<?= ($lang=='en' && $event['name_en']!=""?$event['name_en']:$event['name']) ?>">
                                        <div class="item-desc p-3">
                                            <strong class="ff-semibold text-line-2"><?= ($lang=='en' && $event['name_en']!=""?$event['name_en']:$event['name']) ?></strong>
                                            <p class="text-line-3"><?= ($lang=='en' && $event['shortdesc_en']!=""?word_limiter($event['shortdesc_en'],10):word_limiter($event['shortdesc'],10)) ?></p>
                                        </div>
                                    </div>
                                <?php } } } } ?>
                            </div>
                        </div>
                    </div>

                    <div class="event-info">
                        <div class="event-album">
                            <div class="slider-event">
                                <?php
                                    if($bookings){
                                        foreach ($events as $event){
                                            foreach ($bookings as $booking){
                                                if($event['id'] == $booking['event_id']){
                                ?>
                                    <div class="slide-item">                                        
                                        <div class="event-desc mt-3">
                                            <div class="content-title mb-3">
                                                <a href="<?= site_url('event/post/'.($event['slug']!=""?$event['slug']:$event['id'])) ?>" class="ff-semibold fs-3 a-hover-darkgold"><?= ($lang=='en' && $event['name_en']!=""?$event['name_en']:$event['name']) ?></a>
                                            </div>
                                            <?= ($lang=='en' && $event['desc_en']!=""?$event['desc_en']:$event['desc']) ?>
                                        </div>
                                    </div>
                                <?php } } } } ?>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </section>    

<?= $this->endSection() ?>

<?= $this->section("scripts") ?>
    <?= $this->include('template/slick-slide') ?>
    <?= $this->include('account/ac-script') ?>
<?= $this->endSection() ?>