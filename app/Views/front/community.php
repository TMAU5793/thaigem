<?= $this->extend("front/app") ?>
<?= $this->section("content") ?>

    <section class="banner position-relative">
        <img src="<?= site_url('assets/images/banner/member.jpg') ?>" alt="">
    </section>

    <section class="community-content ptb-2rem">
        <div class="container">
            <div class="text-center mb-3">
                <h3 class="text-uppercase ff-semibold"><?= lang('MenuLang.webboard'); ?></h3>
            </div>
            
            <form id="frm-search-webboard" action="<?= site_url('community/search') ?>" method="GET">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="text" name="txt_keyword" class="form-control" placeholder="keyword" value="<?= (isset($keyword)?$keyword:'') ?>">
                            <div class="input-group-append btn-search-webboard" onclick="formSubmit('frm-search-webboard')">
                                <span class="input-group-text bg-darkgold c-white h-100"><i class="fas fa-search"></i></span>
                            </div>
                        </div>
                    </div>
                    <?php if($userdata['logged_member']){ ?>
                        <div class="col-md-6">                        
                            <a href="<?= site_url('account/webboard/form') ?>" class="btn bg-darkgold c-white w-100 ff-dbadmanBold a-hover-white" id="btn_create_webboard"><?= lang('GlobalLang.createWebboard'); ?></a>                        
                        </div>
                    <?php } ?>
                </div>
            </form>

            <div class="list-forum mt-4 hide-575">
                <div class="row forum-head">
                    <div class="col-lg-1 col-md-1 col-sm-1">
                        <strong><?= lang('MenuLang.forum'); ?></strong>
                    </div>
                    <div class="col-lg-4 col-md-5 col-sm-5"></div>
                    <div class="col-lg-2 col-md-2 col-sm-2 text-end"><strong><?= lang('MenuLang.reply'); ?></strong></div>
                    <div class="col-lg-1 col-md-1 col-sm-1 text-end"><strong><?= lang('MenuLang.read'); ?></strong></div>
                    <div class="col-lg-2 col-md-3 col-sm-3 community-name"><strong class="ps-3"><?= lang('MenuLang.owner'); ?></strong></div>
                    <div class="col-lg-2 col-md-2 col-sm-2 text-cente hide-991"><strong><?= lang('MenuLang.recent'); ?></strong></div>
                </div>

                <div class="forum-body">
                    <?php 
                        if($info){
                            foreach($info as $row){
                    ?>
                    <div class="row">
                        <div class="col-lg-1 col-md-1 col-sm-1">
                            <div class="forum-img" onclick="location.href='<?= site_url('community/post/'.$row['id']) ?>'">
                                <?php
                                    foreach($member as $item){
                                        if($row['member_id']==$item['id']){
                                ?>
                                    <img src="<?= (is_file($item['profile'])?site_url($item['profile']) : site_url('assets/images/img-default.png')) ?>" class="rounded-circle" alt="<?= $row['topic']; ?>">
                                <?php } } ?>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-5 col-sm-5">
                            <h4 class="ff-dbadmanBold mb-0"> <a href="<?= site_url('community/post/'.$row['id']) ?>" class="text-decoration-none c-black"><?= $row['topic']; ?></a></h4>
                            <p class="mb-0 text-line-3"><?= word_limiter(strip_tags($row['desc']),20) ?></p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 text-end">
                            <span class="th-fz-1rem"><?= $row['reply']; ?></span>
                        </div>
                        <div class="col-lg-1 col-md-1 col-sm-1 text-end">
                            <span class="th-fz-1rem"><?= $row['view']; ?></span>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-3 community-name">
                            <?php
                                foreach($member as $item){
                                    if($row['member_id']==$item['id']){
                            ?>
                                <span class="ps-3 th-fz-1rem"><?= $item['name'].' '.$item['lastname'] ?></span>
                            <?php } } ?>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 text-center hide-991">
                            <div class="forum-date"><?= substr($row['created_at'],0,10); ?></div>
                            <small class="th-fz-1rem"><?= substr($row['created_at'],11); ?></small>
                        </div>
                    </div>
                    <?php } }else{ ?>
                        <div class="tect-center p-3">ไม่พบข้อมูล</div>
                    <?php } ?>
                </div>                
            </div>
            <div class="list-forum mt-3 show-575">                
                <?php 
                    if($info){
                        foreach($info as $row){
                ?>
                <div class="forum-body">
                    <div class="row desc-head">
                        <div class="col-2">
                            <?php
                                foreach($member as $item){
                                    if($row['member_id']==$item['id']){
                            ?>
                                <img src="<?= (is_file($item['profile'])?site_url($item['profile']) : site_url('assets/images/img-default.png')) ?>" class="rounded-circle" alt="<?= $row['topic']; ?>">
                            <?php } } ?>
                        </div>
                        <div class="col-10">
                            
                            <?php
                                foreach($member as $item){
                                    if($row['member_id']==$item['id']){
                            ?>
                                <span class="ps-3 th-fz-1rem"><?= $item['name'].' '.$item['lastname'] ?></span>
                            <?php } } ?>

                        </div>
                    </div>
                </div>
                <?php } }else{ ?>
                    <div class="tect-center p-3">ไม่พบข้อมูล</div>
                <?php } ?>
            </div>            
        </div>
    </section>

<?= $this->endSection() ?>