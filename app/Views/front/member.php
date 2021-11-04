<?= $this->extend("front/app") ?>
<?= $this->section("content") ?>

    <section class="member-content ptb-2rem">        

        <div class="container mt-3">
            <div class="text-center title">
                <h1 class="text-uppercase ff-dbamanBold fs-2 letter-spacing-1"><?= lang('GlobalLang.searchMember'); ?></h1>
            </div>

            <div class="search-member mt-4">
                <form id="frm-search-member" action="<?= site_url('member/search') ?>" method="GET">
                    <div class="row">
                        <div class="col-md-6 toggle-slow">
                            <div class="input-group">
                                <input type="text" name="txt_keyword" class="form-control" placeholder="Member name" value="<?= (isset($_GET['txt_keyword'])?$_GET['txt_keyword']:'') ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text bg-darkgold c-white"><i class="fas fa-search"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 toggle-slow">
                            <button type="button" class="btn bg-darkgold c-white w-100 ff-dbamanBold btn-search-member letter-spacing-1 text-uppercase"><?= lang('GlobalLang.search'); ?></button>
                        </div>                        

                        <div class="col-md-6 search-show d-none">
                            <div class="input-group">
                                <select name="ddl_product_type" id="ddl_product_type" class="w-100">
                                    <option value=""> --product type-- </option>
                                    <?php
                                        if($category){
                                            foreach($category as $row){
                                    ?>
                                        <option value="<?= $row['id'] ?>" <?= (isset($_GET['ddl_product_type'])&&$_GET['ddl_product_type']==$row['id']?'selected':'') ?>><?= ($row['name_en']=="" && $lang=='en' ? $row['name_th']:$row['name_'.$lang]) ?></option>
                                    <?php } } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 search-show d-none">
                            <div class="input-group">
                                <input type="text" name="kw_company" class="form-control" placeholder="Company name" value="<?= (isset($_GET['kw_company'])?$_GET['kw_company']:'') ?>">
                            </div>
                        </div>
                        <div class="col-md-6 search-show d-none">
                            <div class="input-group">
                                <select name="ddl_business" id="ddl_business" class="w-100">
                                    <option value=""> --business type-- </option>
                                    <?php
                                        if($business){
                                            foreach($business as $row){
                                    ?>
                                        <option value="<?= $row['id'] ?>" <?= (isset($_GET['ddl_business'])&&$_GET['ddl_business']==$row['id']?'selected':'') ?>><?= ($row['name_en']=="" && $lang=='en' ? $row['name_th']:$row['name_'.$lang]) ?></option>
                                    <?php } } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 search-show d-none">
                            <div class="input-group">
                                <select name="ddl_province" id="ddl_province" class="w-100">
                                    <option value=""> --province-- </option>
                                    <?php
                                        if($province){
                                            foreach($province as $row){
                                    ?>
                                        <option value="<?= $row['code'] ?>" <?= (isset($_GET['ddl_province'])&&$_GET['ddl_province']==$row['code']?'selected':'') ?>><?= $row['name_'.$lang] ?></option>
                                    <?php } } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 search-show d-none">
                            <div class="input-group">
                                <select name="ddl_duration" id="ddl_duration" class="w-100">
                                    <option value=""> --membership duration-- </option>
                                    <option value="1" <?= (isset($_GET['ddl_duration'])&&$_GET['ddl_duration']=='1'?'selected':'') ?>> น้อยกว่า 1ปี </option>
                                    <option value="2" <?= (isset($_GET['ddl_duration'])&&$_GET['ddl_duration']=='2'?'selected':'') ?>> 1ปี - 2ปี </option>
                                    <option value="3" <?= (isset($_GET['ddl_duration'])&&$_GET['ddl_duration']=='3'?'selected':'') ?>> 2ปี - 4ปี  </option>
                                    <option value="4" <?= (isset($_GET['ddl_duration'])&&$_GET['ddl_duration']=='4'?'selected':'') ?>> มากว่า 4ปี  </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 search-show d-none">
                            <button type="button" class="btn bg-darkgold c-white w-100 ff-dbamanBold btn-search-member letter-spacing-1 text-uppercase"><?= lang('GlobalLang.search'); ?></button>
                        </div>  

                        <div class="col-md-12 btn-avd text-center">
                            <button type="button" class="btn bg-darkgold c-white search-show btn_advance letter-spacing-1" id="btn_advance"><?= lang('GlobalLang.advanceSearch'); ?></button>
                            <a href="<?= site_url('member') ?>" class="btn bg-darkgold c-white search-show d-none a-hover-white btn_advance letter-spacing-1"><?= lang('GlobalLang.advanceclose'); ?></a>
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
                <div class="col-md-12 col-lg-6 position-relative mt-4">
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
                            <h5 class="ff-dbamanBold fs-4 text-uppercase letter-spacing-1"><?= $row['name'].' '.$row['lastname'] ?></h5>
                            <p class="text-line-3"><?= character_limiter($row['about'],50) ?></p>
                            
                            <div class="event-action mt-2">
                                <a href="<?= site_url('member/id/'.$row['id']); ?>" class="btn btn-black-border text-uppercase letter-spacing-1"><?= lang('GlobalLang.viewProfile'); ?></a>
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