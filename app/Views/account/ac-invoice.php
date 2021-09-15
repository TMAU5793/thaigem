<?= $this->extend("front/app") ?>
<?= $this->section("content") ?>

    <section class="banner">
        <img src="<?= site_url('assets/images/account/banner.jpg') ?>" alt="">
    </section>    

    <section class="invoice-body mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <?= $this->include('account/left-menu') ?>
                </div>
                <div class="col-md-9">
                    <?php
                        if (session()->get('logged_member')) {
                            echo $this->include('account/ac-menu');
                        }
                    ?>
                    <div class="content-body acform-body">
                        <div class="content-title"><strong class="ff-semibold fs-3"><?= $title; ?></strong></div>
                        <p>Lorem Ipsum is simply dummy text and typesetting industry. Lorem Ipthe industry's standard dummy text Lorem Ipsum is simply dummy text and typesetting industry. Lorem Ipthe industry's standard dummy text</p>
                        <div class="invoice-section mt-4">
                            <div class="row">
                                <?php for($i=1;$i<5;$i++){ ?>
                                    <div class="col-md-6 mb-4">
                                        <div class="acform-item d-flex">
                                            <div class="w-25 ac-form-file position-relative">
                                                <i class="fas fa-file-pdf text-danger absolute-center"></i>
                                            </div>
                                            <div class="w-75">
                                                <strong class="ff-semibold">Form <?= $i; ?></strong>
                                                <p>Lorem Ipsum is simply dummy text and typesetting industry.</p>
                                                <button class="btn btn-black-border fs-7">Download Form</button>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="acform-upload text-center">
                            <input type="file" name="file_upload" class="">
                            <small class="d-block">Maximun 20MB</small>
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