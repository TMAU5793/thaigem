<?= $this->extend("front/app") ?>
<?= $this->section("content") ?>

    <section class="banner-home">
        <img src="<?= (is_file($banner['banner'])?site_url($banner['banner']):site_url('assets/images/img-default.jpg')) ?>" class="hide-575" alt="thai gem">
        <img src="<?= (is_file($banner['banner_mobile'])?site_url($banner['banner_mobile']):site_url('assets/images/img-default.jpg')) ?>" class="show-575" alt="thai gem">
    </section>
    
    <section class="information-center yt-iframe pb-5">
        <div class="container">
            <!-- <div class="title text-center pt-5"><h1 class="fs-3 ff-semibold"><?= $meta_title ?></h1></div> -->
            <div class="content-body mt-3">
                <div class="p-4">
                    <?php
                        if(isset($info_single) && $info_single->desc_en!='' || $info_single->desc_th!=''){
                            echo ($lang=='en' && $info_single->desc_en!='' ? $info_single->desc_en : $info_single->desc_th );
                        }
                    ?>
                    <?php
                        if(isset($advisory)){
                    ?>
                        <div class="row justify-content-center advisory">
                            <div class="col-12 text-center">
                                <h2 class="ff-dbadmanBold mb-0">NAMES CONSULTANTS ASSOCIATION</h2>
                            </div>
                            <?php
                                foreach($advisory as $row){
                                    if($row['sortby']==1){
                            ?>                                
                                <div class="col-lg-3 col-md-4 col-6">
                                    <div class="col-img">
                                        <img src="<?= site_url($row['profile']) ?>" alt="<?= ($lang=='en' && $row['name_en']!=''?$row['name_en']:$row['name']) ?>">
                                    </div>
                                    <div class="col-text mt-3">
                                        <strong class="d-block ff-dbadmanBold fs-4 line-height-24px"><?= ($lang=='en' && $row['position_en']!=''?$row['position_en']:$row['position']) ?></strong>
                                        <span class="d-block line-height-18px"><?= ($lang=='en' && $row['name_en']!=''?$row['name_en']:$row['name']) ?></span>
                                    </div>
                                </div>
                            <?php } } ?>
                        </div>

                        <div class="row justify-content-center advisory">
                            <?php
                                foreach($advisory as $row){
                                    if($row['sortby']==2){
                            ?>
                                <div class="col-lg-3 col-md-4 col-6">
                                    <div class="col-img">
                                        <img src="<?= site_url($row['profile']) ?>" alt="<?= ($lang=='en' && $row['name_en']!=''?$row['name_en']:$row['name']) ?>">
                                    </div>
                                    <div class="col-text mt-3">
                                        <strong class="d-block ff-dbadmanBold fs-4 line-height-24px"><?= ($lang=='en' && $row['position_en']!=''?$row['position_en']:$row['position']) ?></strong>
                                        <span class="d-block line-height-18px"><?= ($lang=='en' && $row['name_en']!=''?$row['name_en']:$row['name']) ?></span>
                                    </div>
                                </div>
                            <?php } }  ?>
                        </div>
                    
                        <div class="row justify-content-center advisory">
                            <?php
                                foreach($advisory as $row){
                                    if($row['sortby']>2 ){
                            ?>
                                <div class="col-lg-3 col-md-4 col-6">
                                    <div class="col-img">
                                        <img src="<?= site_url($row['profile']) ?>" alt="<?= ($lang=='en' && $row['name_en']!=''?$row['name_en']:$row['name']) ?>">
                                    </div>
                                    <div class="col-text mt-3">
                                        <strong class="d-block ff-dbadmanBold fs-4 line-height-24px"><?= ($lang=='en' && $row['position_en']!=''?$row['position_en']:$row['position']) ?></strong>
                                        <span class="d-block line-height-18px"><?= ($lang=='en' && $row['name_en']!=''?$row['name_en']:$row['name']) ?></span>
                                    </div>
                                </div>
                            <?php } }  ?>
                        </div>
                    <?php } ?>

                    <div class="row justify-content-center advisory">
                        <?php
                            if(isset($director)){
                        ?>
                            <div class="col-12 text-center">
                                <h2 class="ff-dbadmanBold mb-0">The list of the Elected TGJTA Board of Directors in fiscal year 2019-2021</h2>
                            </div>
                            <?php
                                foreach($director as $row){
                            ?>                            
                            <div class="col-lg-3 col-md-4 col-6">
                                <div class="col-img">
                                    <img src="<?= site_url($row['profile']) ?>" alt="<?= ($lang=='en' && $row['name_en']!=''?$row['name_en']:$row['name']) ?>">
                                </div>
                                <div class="col-text mt-3">
                                    <strong class="d-block ff-dbadmanBold fs-4 line-height-24px"><?= ($lang=='en' && $row['position_en']!=''?$row['position_en']:$row['position']) ?></strong>
                                    <span class="d-block line-height-18px"><?= ($lang=='en' && $row['name_en']!=''?$row['name_en']:$row['name']) ?></span>
                                </div>
                            </div>
                        <?php } } ?>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
    <!-- echo lang('GlobalLang.notfound'); -->
<?= $this->endSection() ?>