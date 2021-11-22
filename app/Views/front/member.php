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
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="text" name="txt_keyword" class="form-control" placeholder="company name" value="<?= (isset($_GET['txt_keyword'])?$_GET['txt_keyword']:'') ?>">
                                <div class="input-group-append btn-search-member cursor-pointer">
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
                                        <option value="<?= $row['id'] ?>" <?= (isset($_GET['ddl_province'])&&$_GET['ddl_province']==$row['id']?'selected':'') ?>><?= $row['name_'.$lang] ?></option>
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
                            $member_id = $row['id'];
                ?>
                <div class="col-md-12 col-lg-6 position-relative mt-4">
                    <div class="shadow-lightgold box-member">
                        <div class="w-50">
                            <?php
                                if($row['profile']){
                            ?>
                                <div class="slider-for-item">
                                    <img src="<?= (is_file($row['profile'])?site_url($row['profile']):site_url('assets/images/img-default.jpg')) ?>" alt="<?= $row['company'] ?>">
                                </div>
                            <?php } ?>
                            <ul>
                                <?php if($album){
                                        $n=0;
                                        foreach($album as $img){
                                            if($row['member_id']){
                                                $member_id = $row['member_id'];
                                            }
                                            if($img['member_id'] == $member_id && $n<3){
                                                $n++;
                                ?>
                                    <li class="album-item">
                                        <img src="<?= (is_file($img['images'])?site_url($img['images']):site_url('assets/images/img-default.jpg')) ?>" alt="<?= $row['company'] ?>">
                                    </li>
                                <?php } } }else{ ?>
                                    <li class="album-item">
                                        <img src="<?= site_url('assets/images/img-default.jpg') ?>" alt="<?= $row['company'] ?>">
                                    </li>
                                <?php } ?>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="w-50">
                            
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