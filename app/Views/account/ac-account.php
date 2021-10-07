<?= $this->extend("front/app") ?>
<?= $this->section("content") ?>

    <section class="banner">
        <img src="<?= site_url('assets/images/banner/account.jpg') ?>" alt="">
    </section>
    
    <section class="account-body mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <?= $this->include('account/left-menu') ?>
                </div>
                <div class="col-md-9">
                    <?php
                        if (session()->get('userdata')) {
                            echo $this->include('account/ac-menu');
                        }
                    ?>
                    <div class="content-body">
                        <div class="content-title"><strong class="ff-semibold fs-3">My Account</strong></div>
                        <div class="ac-album mt-4">
                            <div class="main-album-img slider-for">
                                <?php
                                    for($i=1;$i<5; $i++){
                                ?>
                                    <div class="slider-for-item">
                                        <img src="<?= site_url('assets/images/account/album-1.jpg') ?>" alt="">
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="album-item slider-nav slick-dots-2">
                                <div class="slider-nav-item">
                                    <img src="<?= site_url('assets/images/account/album-2.jpg') ?>" alt="">
                                </div>
                                <div class="slider-nav-item">
                                    <img src="<?= site_url('assets/images/account/album-3.jpg') ?>" alt="">
                                </div>
                                <div class="slider-nav-item">
                                    <img src="<?= site_url('assets/images/account/album-4.jpg') ?>" alt="">
                                </div>
                                <div class="slider-nav-item">
                                    <img src="<?= site_url('assets/images/account/album-2.jpg') ?>" alt="">
                                </div>
                                <div class="slider-nav-item">
                                    <img src="<?= site_url('assets/images/account/album-3.jpg') ?>" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="ac-about input-disabled mt-5">
                            <div class="content-title"><strong class="ff-semibold fs-3">About Us</strong></div>
                            <textarea name="txt_ac_about" id="txt_ac_about" class="form-control" disabled>Lorem Ipsum is simply dummy text and typesetting industry. Lorem Ipthe industry's standard dummy text Lorem Ipsum is simply dummy text and typesetting industry. Lorem Ipthe industry's standard dummy text</textarea>
                        </div>
                        <div class="edit_ac_about_btn">
                            <button class="btn btn-black-border mt-3" id="edit_ac_about" data-bs-toggle="modal" data-bs-target="#successModal">Edit Profile</button>
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