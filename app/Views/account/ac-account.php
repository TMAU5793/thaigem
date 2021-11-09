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
                    <div class="ac-about input-disabled mt-5">
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

                        <div class="about-edit ac-album-form mt-3 d-none">
                            <div class="album-managed">
                                <?php
                                    if($album){
                                        foreach($album as $img){
                                ?>
                                <div class="managed-item">
                                    <img src="<?= (is_file($img['images'])?site_url($img['images']):site_url('assets/images/img-default.jpg')) ?>">
                                    <i class="far fa-trash-alt" data-id="<?= $img['id'] ?>" title="Delete Image"></i>
                                </div>
                                <?php } } ?>
                                <div class="clearfix"></div>
                            </div>
                            <div class="fallback" id="album_fallback">
                                <?php
                                    $count = count($album);
                                    if($count == 9){
                                ?>
                                    <span class="d-block text-center text-danger mt-4">*จำนวนรูปเต็มแล้ว กรุณาลบรูปเก่าหากต้องการเพิ่มรูปใหม่</span>
                                <?php } ?>
                            </div>
                            <input id="file_album" name="file_album[]" type="file" class="form-control input-hide" multiple />
                            <label for="file_album" class="label-file-img">Choose Images</label>
                            <small class="text-danger mt-2 d-block">*ขนาดรูปที่ต้องการ 900 x 600 px </small>
                            <small class="text-danger mt-2 d-block">*จำกัดจำนวนรูปทั้งหมด 9 รูป </small>
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