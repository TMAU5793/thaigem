<?= $this->extend("front/app") ?>

<?= $this->section("content") ?>

    <section class="banner">
        <img src="<?= site_url('assets/images/account/banner.jpg') ?>" alt="">
    </section>
    
    <section class="account-body mb-5">
        <div class="container">
            <div class="ac-nav">
                <?php
                    if (session()->get('userdata')) {
                        echo $this->include('account/ac-menu');
                    }
                ?>
            </div>
            <div class="row">
                <div class="col-lg-7 col-md-4">
                    <?= $this->include('account/left-menu') ?>
                </div>
                <div class="col-lg-5 col-md-8">
                    <div class="ac-about input-disabled">
                        <div class="content-title"><strong class="ff-dbadmanBoldnn fs-3">About Us</strong></div>
                        <p class="about-edit"><?= $info['about'] ?></p>
                        <textarea name="txt_ac_about" id="txt_ac_about" class="form-control about-edit d-none"><?= $info['about'] ?></textarea>
                    </div>
                                         
                    <div class="content-body">                        
                        <div class="content-title"><strong class="ff-dbadmanBold fs-3">Gallery</strong></div>
                        <div class="ac-album">
                            <div class="row main-album-img">
                                <?php
                                    if($album){
                                        foreach($album as $img){
                                ?>
                                    <div class="col-md-4 album-item mb-3">
                                        <a class="fancybox" data-fancybox="plans" data-width="1400" data-caption="" href="<?= (is_file($img['images'])?site_url($img['images']):site_url('assets/images/default-900x600.jpg')) ?>" title="">
                                            <div class="zoom-in"><img src="<?= (is_file($img['images'])?site_url($img['images']):site_url('assets/images/default-900x600.jpg')) ?>" alt=""></div>
                                        </a>
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