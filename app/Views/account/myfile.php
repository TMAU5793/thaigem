<?= $this->extend("front/app") ?>
<?= $this->section("content") ?>

    <section class="banner">
        <img src="<?= site_url('assets/images/account/banner.jpg') ?>" alt="">
    </section>    

    <section class="myfile-body mb-5">
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
                        <div class="content-title"><strong class="ff-semibold fs-3"><?= $title; ?></strong></div>
                        <p>Lorem Ipsum is simply dummy text and typesetting industry. Lorem Ipthe industry's standard dummy text Lorem Ipsum is simply dummy text and typesetting industry. Lorem Ipthe industry's standard dummy text</p>
                        <div class="event-section mt-4">
                            <div class="row">                                
                                <div class="col-md-6 mb-4">
                                    <div class="event-item-box box-shadow">
                                        <img src="<?= site_url('assets/images/event/event-1.jpg') ?>" alt="">
                                        <div class="item-desc p-3">
                                            <strong class="ff-semibold border-b-darkgold">Event <?= $i; ?></strong>
                                            <p>Lorem Ipsum is simply dummy text and typesetting industry.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>    

<?= $this->endSection() ?>

<?= $this->section("scripts") ?>
    <?= $this->include('account/ac-script') ?>
<?= $this->endSection() ?>