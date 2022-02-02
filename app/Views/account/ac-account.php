<?= $this->extend("front/app") ?>

<?= $this->section("content") ?>

    <section class="banner position-relative">
        <?= $this->include('account/ac-banner') ?>
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
            <div class="row <?= ($info['type']=='member'?'justify-content-center':'') ?>">
                <div class="col-lg-7 col-md-7">
                    <?php
                        if($info['type']=='member'){
                            echo $this->include('account/left-menu-2');
                        }else{
                            echo $this->include('account/left-menu');
                        }
                    ?>
                </div>
                <?php
                        if($info['type']!='member'){
                ?>
                <div class="col-lg-5 col-md-5">
                    <div class="ac-about mt-4">                        
                        <div class="content-title"><strong class="ff-dbadmanBoldnn fs-3">About Us</strong></div>
                        <p class="about-edit"><?= ($info['about']==''? '-' : $info['about']) ?></p>
                    </div>
                    
                    <div class="content-body">                        
                        <div class="content-title"><strong class="ff-dbadmanBold fs-3">Gallery</strong></div>
                        <div class="ac-album">
                            <div class="row main-album-img">
                                <?php
                                    if($album){
                                        foreach($album as $img){
                                ?>
                                    <div class="col-md-4 col-4 album-item mb-3">
                                        <a class="fancybox" data-fancybox="plans" data-width="1400" data-caption="" href="<?= (is_file($img['images'])?site_url($img['images']):site_url('assets/images/default-900x600.jpg')) ?>" title="">
                                            <div class="zoom-in"><img src="<?= (is_file($img['images'])?site_url($img['images']):site_url('assets/images/default-900x600.jpg')) ?>" alt=""></div>
                                        </a>
                                    </div>
                                <?php } } ?>
                            </div>                            
                        </div>                        
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>

<?= $this->endSection() ?>

<?= $this->section("scripts") ?>
    <?= $this->include('template/slick-slide') ?>
    <?= $this->include('account/ac-script') ?>
<?= $this->endSection() ?>