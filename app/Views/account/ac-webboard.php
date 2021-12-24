<?= $this->extend("front/app") ?>
<?= $this->section("content") ?>

    <section ection class="banner position-relative">
        <?= $this->include('account/ac-banner') ?>
    </section>   

    <section class="webboard-body mb-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <?php
                        if (session()->get('userdata')) {
                            echo $this->include('account/ac-menu');
                        }
                    ?>
                    <div class="content-body acform-body">
                        <div class="head-sect">
                            <div class="content-title mb-3 float-start"><strong class="ff-semibold fs-3"><?= lang('accountLang.my-wb') ?></strong></div>
                            <div class="float-end btn-create">
                                <a href="<?= site_url('account/webboard/form') ?>" class="btn bg-darkgold c-white w-100 ff-dbadmanBold a-hover-white"><?= lang('GlobalLang.createWebboard'); ?></a> 
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="mywebboard-desc">
                            <div class="webboard-item hide-575">
                                <div class="row forum-head m-0">
                                    <div class="col-lg-5 col-md-6 col-sm-6">
                                        <strong><?= lang('accountLang.topic') ?></strong>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2 text-end"><strong><?= lang('MenuLang.reply') ?></strong></div>
                                    <div class="col-lg-1 col-md-2 col-sm-2 text-end"><strong><?= lang('MenuLang.read') ?></strong></div>
                                    <div class="col-lg-2 text-center hide-991"><strong><?= lang('MenuLang.recent') ?></strong></div>
                                    <div class="col-lg-2 col-md-2 col-sm-2 text-center"><strong><?= lang('MenuLang.managed') ?></strong></div>
                                </div>

                                <div class="forum-body">
                                    <?php
                                        if($info){
                                            foreach($info as $row){
                                    ?>
                                        <div class="row" id="<?= 'wb-'.$row['id'] ?>">
                                            <div class="col-lg-5 col-md-6 col-sm-6">
                                                <h2 class="ff-semibold mb-0"> <a href="<?= site_url('community/post/'.$row['id']) ?>" class="fs-6 text-decoration-none c-black"><?= $row['topic']; ?></a></h2>
                                                <p class="mb-0 line-height-20px"><?= word_limiter(strip_tags($row['desc']),20) ?></p>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2 text-end">
                                                <span class="th-fz-1rem"><?= $row['reply']; ?></span>
                                            </div>
                                            <div class="col-lg-1 col-md-2 col-sm-2 text-end">
                                                <span class="th-fz-1rem"><?= $row['view']; ?></span>
                                            </div>
                                            <div class="col-lg-2 text-center hide-991">
                                                <div class="forum-date"><?= substr($row['created_at'],0,10); ?></div>
                                                <small class="th-fz-1rem"><?= substr($row['created_at'],11); ?></small>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2 text-center action-group">
                                                <a href="<?= site_url('account/webboard/form?id='.$row['id']) ?>" class="text-warning fs-5 me-1" title="Edit"><i class="far fa-edit"></i></a>
                                                <span class="hide-767"> | </span>
                                                <a href="javascript:void(0)" class="text-danger fs-5 ms-1" title="Delete" onclick="deletePost('<?= $row['id'] ?>','<?= site_url('account/webboard/deletePost') ?>','<?= 'wb-'.$row['id'] ?>')"><i class="far fa-trash-alt"></i></a>
                                            </div>
                                        </div>
                                    <?php } } ?>
                                </div>
                            </div>

                            <div class="webboard-item show-575">
                                <?php 
                                    if($info){
                                        foreach($info as $row){
                                ?>
                                <div class="forum-body">
                                    <div class="row desc-head">
                                        <div class="col-12">                            
                                            <div class="wbd-info">
                                                <div class="wbd-title text-line-1">
                                                    <h2 class="ff-semibold mb-0"> <a href="<?= site_url('community/post/'.$row['id']) ?>" class="fs-6 text-decoration-none c-black"><?= $row['topic']; ?></a></h2>
                                                    <p class="mb-0 line-height-20px"><?= word_limiter(strip_tags($row['desc']),20) ?></p>
                                                </div>
                                                <div class="wbd-desc">
                                                    <p class="mb-0 text-line-3"><?= word_limiter(strip_tags($row['desc']),20) ?></p>
                                                </div>
                                                <div class="row wbd-action">
                                                    <div class="col-6 p-0">
                                                        <strong class="text-uppercase ff-dbadmanBold fs-6"><?= lang('MenuLang.reply'); ?> : </strong>
                                                        <span><?= $row['reply']; ?></span>
                                                    </div>
                                                    <div class="col-6 p-0">
                                                        <strong class="text-uppercase ff-dbadmanBold fs-6"><?= lang('MenuLang.read'); ?> : </strong>
                                                        <span><?= $row['view']; ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } }else{ ?>
                                    <div class="tect-center p-3">ไม่พบข้อมูล</div>
                                <?php } ?>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>    

<?= $this->endSection() ?>

<?= $this->section("scripts") ?>
    <?= $this->include('account/ac-script') ?>
<?= $this->endSection() ?>