<?= $this->extend("front/app") ?>
<?= $this->section("content") ?>

    <section class="information-center mb-5">
        <div class="container">
            <div class="title text-center mt-5"><h1 class="fs-3 ff-semibold"><?= $meta_title ?></h1></div>
            <div class="content-body mt-3">
                <div class="card p-4">
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