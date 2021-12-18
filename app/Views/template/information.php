<?= $this->extend("front/app") ?>
<?= $this->section("content") ?>

    <section class="banner-home">
        <img src="<?= (is_file($banner['banner'])?site_url($banner['banner']):site_url('assets/images/img-default.jpg')) ?>" class="hide-575" alt="thai gem">
        <img src="<?= (is_file($banner['banner_mobile'])?site_url($banner['banner_mobile']):site_url('assets/images/img-default.jpg')) ?>" class="show-575" alt="thai gem">
    </section>
    
    <section class="information-center pb-5">
        <div class="container">
            <!-- <div class="title text-center pt-5"><h1 class="fs-3 ff-semibold"><?= $meta_title ?></h1></div> -->
            <div class="content-body mt-3">
                <div class="p-4">
                    <?php
                        if(isset($info_single) && $info_single->desc_en!='' || $info_single->desc_th!=''){
                            echo ($lang=='en' && $info_single->desc_en!='' ? $info_single->desc_en : $info_single->desc_th );
                        }else{
                            echo lang('GlobalLang.notfound');
                        }
                    ?>
                </div>
            </div>
        </div>
    </section>

<?= $this->endSection() ?>