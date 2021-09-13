<?= $this->extend("front/app") ?>
<?= $this->section("content") ?>

    <section class="banner">
        <img src="<?= site_url('assets/images/account/banner.jpg') ?>" alt="">
    </section>    

    <section class="event-body mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <?= $this->include('account/left-menu') ?>
                </div>
                <div class="col-md-9">
                    <?php
                        if (session()->get('logged_member')) {
                            echo $this->include('account/account-menu');
                        }
                    ?>
                    <div class="content-body">
                        <div class="content-title"><strong class="ff-semibold fs-3">Book Event</strong></div>
                        <div class="event-section mt-4">
                            <div class="row">
                                <?php
                                    for($i=1;$i<7;$i++){
                                        $img = $i;
                                        if($i>3){
                                            $img = $i-3;
                                        }
                                ?>
                                    <div class="col-md-4 mb-4">
                                        <div class="event-item-box box-shadow">
                                            <img src="<?= site_url('assets/images/event/event-'.$img.'.jpg') ?>" alt="">
                                            <div class="item-desc p-3">
                                                <strong class="ff-semibold border-b-darkgold">Event <?= $i; ?></strong>
                                                <p>Lorem Ipsum is simply dummy text and typesetting industry.</p>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
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