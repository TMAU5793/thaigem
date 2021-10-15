<?= $this->extend("front/app") ?>
<?= $this->section("content") ?>

    <section class="banner position-relative">
        <img src="<?= site_url('assets/images/banner/member.jpg') ?>" alt="">
    </section>

    <section class="member-content ptb-2rem">        

        <div class="container mt-3">
            <div class="text-center title">
                <h1 class="text-uppercase ff-semibold fs-3"><?= lang('GlobalLang.searchMember'); ?></h1>
            </div>

            <div class="search-member mt-4">
                <form action="">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Company name, Product type">
                                <div class="input-group-append">
                                    <span class="input-group-text bg-darkgold c-white"><i class="fas fa-search"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn bg-darkgold c-white w-100 ff-semibold" id="btn_advance"><?= lang('GlobalLang.advanceSearch'); ?></button>
                        </div>

                        <div class="col-md-6 search-show d-none">
                            <div class="input-group">
                                <select name="ddl_product_type" id="ddl_product_type" class="w-100">
                                    <option value="">Product type</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 search-show d-none">
                            <div class="input-group">
                                <select name="ddl_company" id="ddl_company" class="w-100">
                                    <option value="">Company name</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 search-show d-none">
                            <div class="input-group">
                                <select name="ddl_business" id="ddl_business" class="w-100">
                                    <option value="">Business type</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 search-show d-none">
                            <div class="input-group">
                                <select name="ddl_province" id="ddl_province" class="w-100">
                                    <option value="">Province</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 search-show d-none">
                            <div class="input-group">
                                <select name="ddl_member" id="ddl_member" class="w-100">
                                    <option value="">Membership Duration</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <button class="btn bg-darkgold c-white w-100 ff-semibold"><?= lang('GlobalLang.search'); ?></button>
                        </div>
                    </div>
                </form>
                <div class="clearfix"></div>
            </div>

            <div class="row">
                <?php
                    if($info){
                        foreach($info as $row){
                ?>
                <div class="col-md-6 position-relative mt-4">
                    <div class="shadow-lightgold">
                        <div class="ac-album w-50">
                            <div class="main-album-img slider-for-hidedots">
                                <?php
                                    if($album){
                                        foreach($album as $img){
                                            if($img['member_id'] == $row['id']){
                                ?>
                                    <div class="slider-for-item">
                                        <img src="<?= (is_file($img['images'])?site_url($img['images']):site_url('assets/images/img-default.jpg')) ?>" alt="<?= $row['name'].' '.$row['lastname'] ?>">
                                    </div>
                                <?php } } } ?>
                            </div>
                            <div class="album-item slider-nav-hidedots">
                                <?php
                                    if($album){
                                        foreach($album as $img){
                                            if($img['member_id'] == $row['id']){
                                ?>
                                    <div class="slider-nav-item">
                                        <img src="<?= (is_file($img['images'])?site_url($img['images']):site_url('assets/images/img-default.jpg')) ?>" alt="thumbnail">
                                    </div>
                                <?php } } } ?>
                            </div>
                        </div>
                        <div class="item-body text-center w-50 plr-2rem position-absolute translate-middle-y top-50 end-0">
                            <h5 class="ff-semibold"><?= $row['name'].' '.$row['lastname'] ?></h5>
                            <p><?= $row['about'] ?></p>
                            
                            <div class="event-action mt-2">
                                <a href="<?= site_url('member/id/'.$row['id']); ?>" class="btn btn-black-border fs-7"><?= lang('GlobalLang.viewProfile'); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } }else{ ?>
                    <div class="col-12 mt-4 text-center">
                        <span>ไม่พบข้อมูล</span>
                    </div>
                <?php } ?>
            </div>
        </div>
        
    </section>

<?= $this->endSection() ?>

<?= $this->section("scripts") ?>
    <?= $this->include('template/slick-slide') ?>
<?= $this->endSection() ?>