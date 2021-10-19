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
                            <a href="<?= site_url('account/webboard/form') ?>" class="btn bg-darkgold c-white w-100 ff-semibold a-hover-white" id="btn_create_webboard"><?= lang('GlobalLang.createWebboard'); ?></a>                        
                        </div>
                    <?php } ?>
                </div>
            </form>

            <div class="list-forum mt-4">
                <div class="row forum-head">
                    <div class="col-md-1">
                        <strong>Forum</strong>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-1 text-end"><strong>Reply</strong></div>
                    <div class="col-md-1 text-end"><strong>Read</strong></div>
                    <div class="col-md-2"><strong class="ps-3">Member name</strong></div>
                    <div class="col-md-3 text-center"><strong>Recent Comment</strong></div>
                </div>

                <div class="forum-body">
                    <?php 
                        if($info){
                            foreach($info as $row){
                    ?>
                    <div class="row">
                        <div class="col-md-1">
                            <div class="forum-img" onclick="location.href='<?= site_url('community/post/'.$row['id']) ?>'">
                                <img src="<?= site_url('assets/images/front/webboard-forum.jpg'); ?>" alt="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h2 class="ff-semibold mb-0"> <a href="<?= site_url('community/post/'.$row['id']) ?>" class="fs-6 text-decoration-none c-black"><?= $row['topic']; ?></a></h2>
                            <p class="mb-0"><?= word_limiter(strip_tags($row['desc']),20) ?></p>
                        </div>
                        <div class="col-md-1 text-end">
                            <span><?= $row['reply']; ?></span>
                        </div>
                        <div class="col-md-1 text-end">
                            <span><?= $row['view']; ?></span>
                        </div>
                        <div class="col-md-2">
                            <?php
                                foreach($member as $item){
                                    if($row['member_id']==$item['id']){
                            ?>
                                <span class="ps-3"><?= $item['name'].' '.$item['lastname'] ?></span>
                            <?php } } ?>
                        </div>
                        <div class="col-md-3 text-center">
                            <div class="forum-date"><?= substr($row['created_at'],0,10); ?></div>
                            <small><?= substr($row['created_at'],11); ?></small>
                        </div>
                    </div>
                    <?php } }else{ ?>
                        <div class="tect-center p-3">ไม่พบข้อมูล</div>
                    <?php } ?>
                </div>

                

            </div>
        </div>
    </section>

<?= $this->endSection() ?>