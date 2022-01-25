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
                <img src="<?= site_url('assets/images/account/infographic/'.($lang=='en'?'member-eng.jpg':'member-th.jpg')) ?>" alt="">                
            </div>
            <?php
                $sess = session()->get('userdata');
                if(!$sess){
            ?>
                <div class="row justify-content-center mt-5">
                    <div class="col-lg-3 col-md-4 col-8">
                        <button type="button" class="btn btn-darkgold c-white w-100 a-hover-white btn-register member-tgjta" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#registerModal"><?= lang('MenuLang.membership') ?></button>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
    <!-- echo lang('GlobalLang.notfound'); -->
<?= $this->endSection() ?>