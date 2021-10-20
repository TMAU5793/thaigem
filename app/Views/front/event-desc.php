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
                <span class="ff-semibold share-social" data-url="<?= site_url('knowledge/post/'.($info['slug']!=""?$info['slug']:$info['id'])) ?>"><i class="fas fa-share-alt"></i> <?= lang('GlobalLang.share'); ?></span>
            </div>
            
            <div class="event-date mt-3 <?= ($booking?'mb-5':'mb-3') ?>">เผยแพร่ : <?= substr($info['created_at'],0,10) ?></div>
        </div>
        <?php
            if(!$booking){
        ?>
            <div class="event-booking pt-4 pb-4 bg-lightgray">
                <div class="container">
                    <p>Lorem Ipsum is simply dummy text of the printingand typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. Lorem Ipsum is simply dummy text of the printingand typesetting industry.</p>

                    <div class="text-center mb-3">
                        <?php
                            if($member['type']=='dealer' && $member['status']=='2'){
                        ?>
                            <a href="javascript:void(0)" class="btn btn-black-border booking_event" id="booking_event" data-event="<?= $info['id']; ?>"><?= lang('GlobalLang.bookevent') ?></a>
                        <?php }else if($member['type']=='dealer' && $member['status']=='1'){ ?>
                            <a href="" data-bs-toggle="modal" data-bs-target="#eventModal" class="btn btn-black-border"><?= lang('GlobalLang.bookevent') ?></a>
                        <?php }else{ ?>
                            <a href="" data-bs-toggle="modal" data-bs-target="#loginModal" class="btn btn-black-border"><?= lang('GlobalLang.bookevent') ?></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </section>
<?= $this->endSection() ?>