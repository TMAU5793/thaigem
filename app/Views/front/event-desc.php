<?= $this->extend("front/app") ?>
<?= $this->section("content") ?>

    <section class="banner position-relative">
        <img src="<?= site_url('assets/images/banner/event.jpg') ?>" alt="">
    </section>

    <section class="event-desc pt-2rem">
        <div class="container">
            <div class="text-center bread-crumbs mb-3">
                
                <h1 class="ff-semibold fs-3"><?= ($lang=='en' && $info['name_en']!=""?$info['name_en']:$info['name']) ?></h1>
                <small>
                    <a href="<?= site_url('event') ?>" class="text-decoration-none"><?= lang('GlobalLang.event'); ?></a> >> 
                    <span class="c-darkgold"><?= ($lang=='en' && $info['name_en']!=""?$info['name_en']:$info['name']) ?></span>
                </small>
            </div>

            <div class="single-desc">
                <?= ($lang=='en' && $info['desc_en']!=""?$info['desc_en']:$info['desc']) ?>
            </div>

            <div class="share-post text-end mt-4 mb-4">
                <span class="ff-semibold share-social"><i class="fas fa-share-alt"></i> <?= lang('GlobalLang.share'); ?></span>
            </div>
            
            <div class="event-date mt-3 mb-3">เผยแพร่ : <?= substr($info['created_at'],0,10) ?></div>
        </div>
        
        <div class="event-booking pt-4 pb-4 bg-lightgray">
            <div class="container">
                <p>Lorem Ipsum is simply dummy text of the printingand typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. Lorem Ipsum is simply dummy text of the printingand typesetting industry.</p>

                <div class="text-center mb-3">
                    <?php
                        $logged = session()->get('userdata');
                        if($logged['logged_member'] && $logged['user_type']=='dealer'){
                    ?>
                        <a href="javascript:void(0)" class="btn btn-black-border" id="booking_event" data-event="<?= $info['id']; ?>">Book Event</a>
                    <?php }else if($logged['logged_member'] && $logged['user_type']!='dealer'){ ?>
                        <a href="" data-bs-toggle="modal" data-bs-target="#eventModal" class="btn btn-black-border">Book Event</a>
                    <?php }else{ ?>
                        <a href="" data-bs-toggle="modal" data-bs-target="#loginModal" class="btn btn-black-border">Book Event</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
<?= $this->endSection() ?>