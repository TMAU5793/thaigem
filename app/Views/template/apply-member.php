<?= $this->extend("front/app") ?>
<?= $this->section("content") ?>

    <section class="banner-home">
        <img src="<?= (is_file($banner['banner'])?site_url($banner['banner']):site_url('assets/images/img-default.jpg')) ?>" class="hide-575" alt="thai gem">
        <img src="<?= (is_file($banner['banner_mobile'])?site_url($banner['banner_mobile']):site_url('assets/images/img-default.jpg')) ?>" class="show-575" alt="thai gem">
    </section>
    
    <section class="information-center pb-5">
        <div class="container">
            <!-- <div class="title text-center pt-5"><h1 class="fs-3 ff-semibold"><?= $meta_title ?></h1></div> -->
            <div class="content-body apply-member mt-3">
                <div class="p-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="col-img">
                                <img src="<?= site_url('assets/images/apply-member/1.jpg') ?>" alt="">
                            </div>
                        </div>
                        
                        <div class="col-md-5">
                            <div class="col-img">
                                <img src="<?= site_url('assets/images/apply-member/2.jpg') ?>" alt="">
                            </div>
                        </div>

                        <div class="col-md-7">
                            <div class="col-img">
                                <img src="<?= site_url('assets/images/apply-member/3.jpg') ?>" alt="">
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="col-img">
                                <img src="<?= site_url('assets/images/apply-member/4.jpg') ?>" alt="">
                            </div>
                        </div>
                        
                        <div class="col-md-7">
                            <div class="col-img">
                                <img src="<?= site_url('assets/images/apply-member/5.jpg') ?>" alt="">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="col-img">
                                <img src="<?= site_url('assets/images/apply-member/6.jpg') ?>" alt="">
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="col-img">
                                <img src="<?= site_url('assets/images/apply-member/7.jpg') ?>" alt="">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="col-img">
                                <img src="<?= site_url('assets/images/apply-member/8.jpg') ?>" alt="">
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="col-img">
                                <img src="<?= site_url('assets/images/apply-member/9.jpg') ?>" alt="">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="col-img">
                                <img src="<?= site_url('assets/images/apply-member/10.jpg') ?>" alt="">
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="col-img">
                                <img src="<?= site_url('assets/images/apply-member/11.jpg') ?>" alt="">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="col-img">
                                <img src="<?= site_url('assets/images/apply-member/12.jpg') ?>" alt="">
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="col-img">
                                <img src="<?= site_url('assets/images/apply-member/13.jpg') ?>" alt="">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="col-img">
                                <img src="<?= site_url('assets/images/apply-member/14.jpg') ?>" alt="">
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="col-img">
                                <img src="<?= site_url('assets/images/apply-member/15.jpg') ?>" alt="">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- echo lang('GlobalLang.notfound'); -->
<?= $this->endSection() ?>