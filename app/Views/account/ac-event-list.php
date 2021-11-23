<?= $this->extend("front/app") ?>
<?= $this->section("content") ?>

    <section class="banner position-relative">
        <?= $this->include('account/ac-banner') ?>
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
                            <div class="slider-nav slick-dotted">
                                <?php
                                    if($events){
                                        foreach ($events as $event){
                                ?>
                                    <div class="event-item-box">
                                        <img src="<?= (is_file($event['thumbnail'])?site_url($event['thumbnail']):site_url('assets/images/img-default.jpg')) ?>" alt="<?= ($lang=='en' && $event['name_en']!=""?$event['name_en']:$event['name']) ?>">
                                        <div class="item-desc p-3">
                                            <strong class="ff-semibold text-line-2"><?= ($lang=='en' && $event['name_en']!=""?$event['name_en']:$event['name']) ?></strong>
                                            <p class="text-line-3"><?= ($lang=='en' && $event['shortdesc_en']!=""?word_limiter($event['shortdesc_en'],10):word_limiter($event['shortdesc'],10)) ?></p>
                                        </div>
                                    </div>
                                <?php } } ?>
                            </div>
                        </div>
                    </div>

                    <div class="event-info">
                        <div class="event-album">
                            <div class="slider-for">
                                <?php
                                    if($events){
                                        foreach ($events as $event){
                                ?>
                                    <div class="slide-item">                                        
                                        <div class="event-desc mt-3">
                                            <div class="content-title mb-3"><strong class="ff-semibold fs-3"><?= ($lang=='en' && $event['name_en']!=""?$event['name_en']:$event['name']) ?></strong></div>
                                            <?= ($lang=='en' && $event['desc_en']!=""?$event['desc_en']:$event['desc']) ?>
                                        </div>
                                        <div class="event-booking pt-4 pb-2 bg-lightgray">
                                            <div class="container">
                                                <p>Lorem Ipsum is simply dummy text of the printingand typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. Lorem Ipsum is simply dummy text of the printingand typesetting industry.</p>

                                                <div class="text-center mb-3">
                                                    <a href="javascript:void(0)" class="btn btn-black-border booking_event" id="booking_event" data-event="<?= $event['id']; ?>"><?= lang('GlobalLang.bookevent') ?></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } } ?>
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