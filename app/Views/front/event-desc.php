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
            
            <div class="event-date mt-3 <?= ($booking?'mb-5':'mb-3') ?>">
                <?php
                    $start_event = explode('-',$info['start_event']);
                    $end_event = explode('-',$info['end_event']);
                    $eventdate = '';
                    foreach ($month as $item){
                        if($item['id']==$start_event[1]){
                            $m1 = ($lang=='en'?$item['name_en']:$item['name_th']);
                        }
                        if($item['id']==$end_event[1]){
                            $m2 = ($lang=='en'?$item['name_en']:$item['name_th']);
                        }                                            
                    }
                    if($start_event[0]==$end_event[0]){
                        if($start_event[1]==$end_event[1]){
                            $eventdate = $start_event[2].'-'.$end_event[2].' '.$m1.' '.$start_event[0];
                        }else{
                            $eventdate = $start_event[2].' '.$m1.' - '.$end_event[2].' '.$m2.' '.$end_event[0];
                        }
                    }else{
                        $eventdate = $start_event[2].' '.$m1.' '.$start_event[0].' - '.$end_event[2].' '.$m2.' '.$end_event[0];
                    }
                ?>
                <?= lang('GlobalLang.eventDate').' : '.$eventdate ?>
            </div>
        </div>
        
        <div class="event-booking pt-4 pb-4 bg-lightgray">
            <div class="container">
                <div class="text-center">
                    <?php
                        if($member['type']=='dealer' && $member['status']=='2'){
                    ?>
                        <a href="javascript:void(0)" class="booking_event" id="booking_event" data-event="<?= $info['id']; ?>">
                            <img src="<?= site_url('assets/images/'.($lang=='en'?'book.gif':'book-th.gif')); ?>" alt="" class="img-book">                            
                        </a>
                    <?php }else{ ?>
                        <a href="" data-bs-toggle="modal" data-bs-target="#eventModal" class="">
                            <img src="<?= site_url('assets/images/'.($lang=='en'?'book.gif':'book-th.gif')); ?>" alt="" class="img-book">                            
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
        
    </section>
<?= $this->endSection() ?>