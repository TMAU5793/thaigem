<?= $this->extend("front/app") ?>
<?= $this->section("content") ?>

    <section class="member-content ptb-2rem">        

        <div class="container mt-3">
            <div class="text-center title">
                <h1 class="text-uppercase ff-dbadmanBold fs-2 letter-spacing-1"><?= lang('GlobalLang.searchMember'); ?></h1>
            </div>

            <div class="search-member mt-4">
                <form id="frm-search-member" action="<?= site_url('member/search') ?>" method="GET">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="input-group">
                                <input type="text" name="txt_keyword" class="form-control" placeholder="<?= lang('GlobalLang.company') ?>" value="<?= (isset($_GET['txt_keyword'])?$_GET['txt_keyword']:'') ?>">
                                <div class="input-group-append btn-search-member cursor-pointer">
                                    <span class="input-group-text bg-darkgold c-white"><i class="fas fa-search"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 toggle-slow">
                            <button type="button" class="btn bg-darkgold c-white w-100 ff-dbadmanBold btn-search-member letter-spacing-1 text-uppercase"><?= lang('GlobalLang.search'); ?></button>
                        </div>                        

                        <div class="col-md-6 search-show d-none">
                            <div class="input-group">
                                <select name="ddl_product_type" id="ddl_product_type" class="w-100">
                                    <option value=""> --<?= lang('GlobalLang.product-type') ?>-- </option>
                                    <?php
                                        if($category){
                                    ?>
                                        <optgroup label="DIAMONDS">
                                            <?php
                                                foreach($category as $row){
                                                    if($row['maincate_id']==1){ ?>
                                                <option value="<?= $row['name_th'] ?>" <?= (isset($_GET['ddl_product_type'])&&$_GET['ddl_product_type']==$row['name_th']?'selected':'') ?>><?= ($row['name_en']=="" && $lang=='en' ? $row['name_th']:$row['name_'.$lang]) ?></option>
                                            <?php } } ?>
                                        </optgroup>
                                        <optgroup label="GEMSTONES">
                                            <?php
                                                foreach($category as $row){
                                                    if($row['maincate_id']==2){ ?>
                                                <option value="<?= $row['name_th'] ?>" <?= (isset($_GET['ddl_product_type'])&&$_GET['ddl_product_type']==$row['name_th']?'selected':'') ?>><?= ($row['name_en']=="" && $lang=='en' ? $row['name_th']:$row['name_'.$lang]) ?></option>
                                            <?php } } ?>
                                        </optgroup>
                                        <optgroup label="GOLD & PLATINUM JEWELRY">
                                            <?php
                                                foreach($category as $row){
                                                    if($row['maincate_id']==3){ ?>
                                                <option value="<?= $row['name_th'] ?>" <?= (isset($_GET['ddl_product_type'])&&$_GET['ddl_product_type']==$row['name_th']?'selected':'') ?>><?= ($row['name_en']=="" && $lang=='en' ? $row['name_th']:$row['name_'.$lang]) ?></option>
                                            <?php } } ?>
                                        </optgroup>
                                        <optgroup label="SILVER JEWELRY">
                                            <?php
                                                foreach($category as $row){
                                                    if($row['maincate_id']==4){ ?>
                                                <option value="<?= $row['name_th'] ?>" <?= (isset($_GET['ddl_product_type'])&&$_GET['ddl_product_type']==$row['name_th']?'selected':'') ?>><?= ($row['name_en']=="" && $lang=='en' ? $row['name_th']:$row['name_'.$lang]) ?></option>
                                            <?php } } ?>
                                        </optgroup>
                                        <optgroup label="EQUIPMENT & TOOLS">
                                            <?php
                                                foreach($category as $row){
                                                    if($row['maincate_id']==5){ ?>
                                                <option value="<?= $row['name_th'] ?>" <?= (isset($_GET['ddl_product_type'])&&$_GET['ddl_product_type']==$row['name_th']?'selected':'') ?>><?= ($row['name_en']=="" && $lang=='en' ? $row['name_th']:$row['name_'.$lang]) ?></option>
                                            <?php } } ?>
                                        </optgroup>
                                        <optgroup label="OTHER">
                                            <?php
                                                foreach($category as $row){
                                                    if($row['maincate_id']==6){ ?>
                                                <option value="<?= $row['name_th'] ?>" <?= (isset($_GET['ddl_product_type'])&&$_GET['ddl_product_type']==$row['name_th']?'selected':'') ?>><?= ($row['name_en']=="" && $lang=='en' ? $row['name_th']:$row['name_'.$lang]) ?></option>
                                            <?php } } ?>
                                        </optgroup>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-6 search-show d-none">
                            <div class="input-group">
                                <select name="ddl_business" id="ddl_business" class="w-100">
                                    <option value=""> --<?= lang('GlobalLang.business-type') ?>-- </option>
                                    <?php
                                        if($business){
                                    ?>
                                        <optgroup label="MANUFACTURING">
                                            <?php
                                                foreach($business as $row){
                                                    if($row['main_type']==1){ 
                                            ?>
                                                <option value="<?= $row['name_th'] ?>" <?= (isset($_GET['ddl_business'])&&$_GET['ddl_business']==$row['name_th']?'selected':'') ?>><?= ($row['name_en']=="" && $lang=='en' ? $row['name_th']:$row['name_'.$lang]) ?></option>
                                            <?php } } ?>
                                        </optgroup>
                                        <optgroup label="TRADING">
                                            <?php
                                                foreach($business as $row){
                                                    if($row['main_type']==2){ 
                                            ?>
                                                <option value="<?= $row['name_th'] ?>" <?= (isset($_GET['ddl_business'])&&$_GET['ddl_business']==$row['name_th']?'selected':'') ?>><?= ($row['name_en']=="" && $lang=='en' ? $row['name_th']:$row['name_'.$lang]) ?></option>
                                            <?php } } ?>
                                        </optgroup>
                                        <optgroup label="SERVICE">
                                            <?php
                                                foreach($business as $row){
                                                    if($row['main_type']==3){ 
                                            ?>
                                                <option value="<?= $row['name_th'] ?>" <?= (isset($_GET['ddl_business'])&&$_GET['ddl_business']==$row['name_th']?'selected':'') ?>><?= ($row['name_en']=="" && $lang=='en' ? $row['name_th']:$row['name_'.$lang]) ?></option>
                                            <?php } } ?>
                                        </optgroup>
                                    <?php }  ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 search-show d-none">
                            <div class="input-group">
                                <select name="ddl_province" id="ddl_province" class="w-100">
                                    <option value=""> --<?= lang('GlobalLang.province') ?>-- </option>
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
                                    <option value=""> --<?= lang('GlobalLang.mb-duration') ?>-- </option>
                                    <option value="1-3" <?= (isset($_GET['ddl_duration'])&&$_GET['ddl_duration']=='1-3'?'selected':'') ?>> 1-3 <?= lang('GlobalLang.year') ?> </option>
                                    <option value="3-5" <?= (isset($_GET['ddl_duration'])&&$_GET['ddl_duration']=='3-5'?'selected':'') ?>> 3-5 <?= lang('GlobalLang.year') ?> </option>
                                    <option value="5-10" <?= (isset($_GET['ddl_duration'])&&$_GET['ddl_duration']=='5-10'?'selected':'') ?>> 5-10 <?= lang('GlobalLang.year') ?>  </option>
                                    <option value="10up" <?= (isset($_GET['ddl_duration'])&&$_GET['ddl_duration']=='10up'?'selected':'') ?>> 10 <?= lang('GlobalLang.yearUp') ?>  </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 search-show d-none">
                            <div class="input-group">
                                <select name="ddl_employee" id="ddl_employee" class="w-100">
                                    <option value="">-- <?= lang('accountLang.employee') ?> --</option>
                                    <option value="1-10" <?= (isset($_GET['ddl_employee'])&&$_GET['ddl_employee']=='1-10'?'selected' : '') ?>>1 - 10 <?= lang('accountLang.person') ?></option>
                                    <option value="11-30" <?= (isset($_GET['ddl_employee'])&&$_GET['ddl_employee']=='11-30'?'selected' : '') ?>>11 - 30 <?= lang('accountLang.person') ?></option>
                                    <option value="31-50" <?= (isset($_GET['ddl_employee'])&&$_GET['ddl_employee']=='31-50'?'selected' : '') ?>>31 - 50 <?= lang('accountLang.person') ?></option>
                                    <option value="51-100" <?= (isset($_GET['ddl_employee'])&&$_GET['ddl_employee']=='51-100'?'selected' : '') ?>>51 - 100 <?= lang('accountLang.person') ?></option>
                                    <option value="101-500" <?= (isset($_GET['ddl_employee'])&&$_GET['ddl_employee']=='101-500'?'selected' : '') ?>>101 - 500 <?= lang('accountLang.person') ?></option>
                                    <option value="501-1000" <?= (isset($_GET['ddl_employee'])&&$_GET['ddl_employee']=='501-1000'?'selected' : '') ?>>501 - 1000 <?= lang('accountLang.person') ?></option>
                                    <option value="1000" <?= (isset($_GET['ddl_employee'])&&$_GET['ddl_employee']=='1000'?'selected' : '') ?>>1000 <?= lang('accountLang.peopleUp') ?></option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 search-show d-none">
                            <button type="button" class="btn bg-darkgold c-white w-100 ff-dbadmanBold btn-search-member letter-spacing-1 text-uppercase"><?= lang('GlobalLang.search'); ?></button>
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
                <div class="col-lg-6 col-md-12 position-relative mt-4">
                    <div class="shadow-lightgold box-member d-flex">
                        <div class="w-50">
                            <?php
                                if($row['profile']){
                            ?>
                                <div class="slider-for-item">
                                    <img src="<?= (is_file($row['profile'])?site_url($row['profile']):site_url('assets/images/default-1000x750.jpg')) ?>" alt="<?= $row['company'] ?>">
                                </div>
                            <?php }else{ ?>
                                <img src="<?= site_url('assets/images/default-1000x750.jpg') ?>" alt="<?= $row['company'] ?>">
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
                                        <img src="<?= (is_file($img['images'])?site_url($img['images']):site_url('assets/images/default-1000x750.jpg')) ?>" alt="<?= $row['company'] ?>">
                                    </li>
                                <?php } } } if($n==0){ for($i=1;$i<4;$i++){ ?>
                                    
                                    <li class="album-item invisible">
                                        <img src="<?= (site_url('assets/images/default-1000x750.jpg')) ?>" alt="<?= $row['company'] ?>">
                                    </li>
                                <?php } } ?>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="w-50 position-relative member-text">
                            
                            <div class="w-100 ps-3 text-center">
                                <h5 class="ff-dbadmanBold text-uppercase mb-0 line-height-18px mb-2 fz-1-2rem-575 text-line-4"><?= $row['company'] ?></h5>
                                <div class="cate-type mb-2">
                                    <strong class="ff-dbadmanBold c-darkgold d-block line-height-16px fz-1-2rem-575"><?= lang('GlobalLang.product-type') ?></strong>
                                    <?php
                                        foreach($cate_prod as $cate){
                                            if($cate['member_id'] == $member_id){
                                                $str = $cate['product'];
                                            
                                    ?>
                                        <p class="text-line-2 mb-0 line-height-20px"><?= ($str==''?'-':$str) ?></p>
                                    <?php } } ?>
                                </div>
                                <div class="cate-type">
                                    <strong class="ff-dbadmanBold c-darkgold d-block line-height-16px fz-1-2rem-575"><?= lang('GlobalLang.business-type') ?></strong>
                                    <?php
                                        foreach($cate_prod as $cate){
                                            if($cate['member_id'] == $member_id){
                                                $str = $cate['business'];
                                            
                                    ?>
                                        <p class="text-line-2 mb-0 line-height-20px"><?= ($str==''?'-':$str) ?></p>
                                    <?php } } ?>
                                </div>
                                <div class="event-action position-absolute start-50 translate-middle-x bottom-0 ms-2">
                                    <?php
                                        $member_id = $row['id'];
                                        if($row['code']){
                                            $member_id = $row['code'];
                                        }
                                        if($row['m_id']){
                                            $member_id = $row['m_id'];
                                        }
                                    ?>
                                    <?php if($userdata['logged_member']){ ?>
                                        <a href="<?= site_url('member/id/'.$member_id); ?>" class="btn btn-black-border text-uppercase letter-spacing-1"><?= lang('GlobalLang.viewProfile'); ?></a>
                                    <?php }else{ ?>
                                        <a href="javascript:void(0)" class="btn btn-black-border text-uppercase letter-spacing-1" data-bs-toggle="modal" data-bs-target="#loginModal" onclick="viewMember('<?= $member_id; ?>');"><?= lang('GlobalLang.viewProfile'); ?></a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } } else{ ?>
                    <div class="col-12 mt-4 text-center">
                        <span>ไม่พบข้อมูล</span>
                    </div>
                <?php } ?>
            </div>

            <?php if(isset($pager)) { ?>
                <nav class="navigation-center mt-5">
                    <?= $pager->links(); ?>
                </nav>
            <?php } ?>

            <?php if(isset($total_page)) { ?>
                <nav class="navigation-center mt-5 border-none">
                    <?php
                        $cate = $_GET['c'];
                    ?>
                    <ul class="pagination">
                        <?php
                            for($i=1;$i<=$total_page;$i++){
                        ?>
                            <li class="<?= ($page==$i?'active':'') ?>"><a href="<?= site_url('member/filter?c='.$cate.'&page='.$i) ?>"><?= $i; ?></a></li>
                        <?php } ?>
                    </ul>
                </nav>
            <?php } ?>
        </div>
        
    </section>
    
<?= $this->endSection() ?>

<?= $this->section("scripts") ?>
    <script src="<?= base_url('assets/jquery/pagination.js'); ?>"></script>
    <?= $this->include('template/slick-slide') ?>    
<?= $this->endSection() ?>