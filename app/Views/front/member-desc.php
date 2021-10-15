<?= $this->extend("front/app") ?>

<?= $this->section("content") ?>

    <section class="banner">
        <img src="<?= site_url('assets/images/banner/account.jpg') ?>" alt="">
    </section>
    
    <section class="account-body mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="ac-menu-left p-4">
                        <div class="ac-profile-img position-relative">
                            <?php
                                $profile_pic = (is_file($info['profile'])?site_url($info['profile']):site_url('assets/images/img-default.png'));
                                if(!is_file($info['profile'])){
                                    if($info['type'] == 'facebook'){
                                        $profile_pic = 'https://graph.facebook.com/'.$info['id'].'/picture?width=400&height=400';
                                    }else if($info['type'] == 'google'){
                                        $profile_pic = site_url($info['profile']);
                                    }
                                }
                            ?>
                            <img src="<?= $profile_pic; ?>" id="pic_profile">
                        </div>
                        <div class="ac-personal mb-3">
                            <span class="d-block"><?= $info['name'].' '.$info['lastname'] ?></span>
                            <span class="d-block"><?= $info['email'] ?></span>
                            <span class="d-block"><?= $info['phone'] ?></span>
                        </div>
                        <div class="ac-information">
                            <div class="ac-info-item">
                                <div class="ac-info-icon">
                                    <i class="fas fa-hand-holding-usd"></i>
                                </div>
                                <strong class="d-block">Product Type</strong>
                                <small class="small-data"><?= $category['name_th'] ?></small>
                            </div>
                            <div class="ac-info-item">
                                <div class="ac-info-icon">
                                    <i class="fas fa-briefcase"></i>
                                </div>
                                <strong class="d-block">Business Type</strong>
                                <small class="small-data"><?= $business['name_th'] ?></small>                                    
                            </div>
                            <div class="ac-info-item">
                                <div class="ac-info-icon">
                                    <i class="far fa-building"></i>
                                </div>
                                <strong class="d-block">Company Name</strong>
                                <small class="small-data"><?= $info['company'] ?></small>
                            </div>

                            <div class="ac-info-item">
                                <div class="ac-info-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <strong class="d-block">Province</strong>
                                <small class="small-data"><?= $province['name_th'] ?></small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="content-body mt-4">
                        
                        <div class="content-title"><strong class="ff-semibold fs-3"><?= $info['name'].' '.$info['lastname'] ?></strong></div>
                        <div class="ac-album mt-4">
                            <div class="main-album-img slider-for">
                                <?php
                                    if($album){
                                        foreach($album as $img){
                                ?>
                                    <div class="slider-for-item position-relative">
                                        <img src="<?= (is_file($img['images'])?site_url($img['images']):site_url('assets/images/img-default.jpg')) ?>">
                                    </div>
                                <?php } } ?>
                            </div>
                            <div class="album-item slider-nav slick-dots-2">
                                <?php
                                    if($album){
                                        foreach($album as $img){
                                ?>
                                    <div class="slider-nav-item">
                                        <img src="<?= (is_file($img['images'])?site_url($img['images']):site_url('assets/images/img-default.jpg')) ?>">
                                    </div>
                                <?php } } ?>
                            </div>
                        </div>

                        <div class="ac-about mt-5">
                            <div class="content-title"><strong class="ff-semibold fs-3">About Us</strong></div>
                            <p class="about-edit"><?= $info['about'] ?></p>
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