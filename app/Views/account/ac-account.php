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
                    <form id="frm_ac_about" action="<?= site_url('account/member/album') ?>" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="hd_id" value="<?= $info['id']; ?>">
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
                                        if($album){
                                            foreach($album as $img){
                                    ?>
                                        <div class="slider-for-item position-relative">
                                            <img src="<?= site_url($img['images']) ?>">
                                            <div class="ff-semibold position-absolute top-0 start-50">
                                                
                                            </div>
                                        </div>
                                    <?php } } ?>
                                </div>
                                <div class="album-item slider-nav slick-dots-2">
                                    <?php
                                        if($album){
                                            foreach($album as $img){
                                    ?>
                                        <div class="slider-nav-item">
                                            <img src="<?= site_url($img['images']) ?>">
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
                                        <img src="<?= site_url($img['images']) ?>">
                                        <i class="far fa-trash-alt" data-id="<?= $img['id'] ?>"></i>
                                    </div>
                                    <?php } } ?>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="fallback" id="album_fallback">
                                    
                                </div>
                                <input id="file_album" name="file_album[]" type="file" class="form-control" multiple />
                                <small class="text-danger mt-2 d-block">*ขนาดรูปที่ต้องการ 900 x 540 px </small>
                            </div>

                            <div class="ac-about input-disabled mt-5">
                                <div class="content-title"><strong class="ff-semibold fs-3">About Us</strong></div>
                                <p class="about-edit"><?= $info['about'] ?></p>
                                <textarea name="txt_ac_about" id="txt_ac_about" class="form-control about-edit d-none"><?= $info['about'] ?></textarea>
                            </div>
                            <div class="edit_ac_about_btn">
                                <button type="button" class="btn btn-black-border mt-3 about-edit" id="edit_ac_about">Edit Profile</button>
                                <div class="btn-profile-about about-edit mt-3 d-none">
                                    <button type="button" class="btn btn-black-border" id="submit_ac_about">Comfirm</button>
                                    <a href="<?= current_url(); ?>" class="text-danger ff-bold ms-3">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

<?= $this->endSection() ?>

<?= $this->section("scripts") ?>
    <?= $this->include('template/slick-slide') ?>
    <?= $this->include('account/ac-script') ?>
<?= $this->endSection() ?>