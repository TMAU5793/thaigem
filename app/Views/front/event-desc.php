<?= $this->extend("front/app") ?>
<?= $this->section("content") ?>

    <section class="event-desc pt-2rem">
        <div class="container">
            <div class="text-center bread-crumbs mb-3">
                
                <h1 class="ff-dbadmanBold"><?= ($lang=='en' && $info['name_en']!=""?$info['name_en']:$info['name']) ?></h1>
                <small>
                    <a href="<?= site_url('event') ?>" class="text-decoration-none"><?= lang('GlobalLang.event'); ?></a> >> 
                    <span class="c-darkgold"><?= ($lang=='en' && $info['name_en']!=""?$info['name_en']:$info['name']) ?></span>
                </small>
            </div>

            <div class="single-desc">
                <?= ($lang=='en' && $info['desc_en']!=""?$info['desc_en']:$info['desc']) ?>
            </div>

            <div class="share-post text-end mt-4 mb-4">
                <span class="ff-dbadmanBold share-social" data-url="<?= site_url('knowledge/post/'.($info['slug']!=""?$info['slug']:$info['id'])) ?>"><i class="fas fa-share-alt"></i> <?= lang('GlobalLang.share'); ?></span>
            </div>
            
            <div class="event-date mt-3 <?= ($booking?'mb-5':'mb-3') ?>">เผยแพร่ : <?= substr($info['created_at'],0,10) ?></div>
        </div>
        
        <div class="event-booking pt-4 pb-4 bg-lightgray">
            <div class="container">
                <div class="text-center">
                    <?php
                        if($member['type']=='dealer' && $member['status']=='2'){
                    ?>
                        <a href="javascript:void(0)" class="booking_event" id="booking_event" data-event="<?= $info['id']; ?>">
                            <img src="<?= site_url('assets/images/'.($lang=='en'?'book.gif':'book-th.gif')); ?>" alt="" class="img-book">
                            <!-- <?= lang('GlobalLang.bookevent') ?> -->
                        </a>
                    <?php }else{ ?>
                        <a href="" data-bs-toggle="modal" data-bs-target="#eventModal" class="">
                            <img src="<?= site_url('assets/images/'.($lang=='en'?'book.gif':'book-th.gif')); ?>" alt="" class="img-book">
                            <!-- <?= lang('GlobalLang.bookevent') ?> -->
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
        
    </section>
<?= $this->endSection() ?>