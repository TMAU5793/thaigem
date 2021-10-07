<?= $this->extend("front/app") ?>
<?= $this->section("content") ?>

    <section class="banner position-relative">
        <img src="<?= site_url('assets/images/banner/member.jpg') ?>" alt="">
        <!-- <div class="container">
            <div class="banner-title c-darkgold">
                <h1 class="text-uppercase"><?= lang('MenuLang.navAboutus'); ?></h1>
                <strong class="display-3 ff-bold">TGJTA</strong>
            </div>
        </div> -->
    </section>

    <section class="community-content ptb-2rem">
        <div class="container">
            <div class="text-center mb-3">
                <h3 class="text-uppercase ff-semibold"><?= lang('MenuLang.webboard'); ?></h3>
            </div>
            
            <form action="">
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="keyword">
                            <div class="input-group-append">
                                <span class="input-group-text bg-darkgold c-white h-100"><i class="fas fa-search"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <button type="button" class="btn bg-darkgold c-white w-100 ff-semibold" id="btn_search_webboard"><?= lang('GlobalLang.search'); ?></button>
                    </div>
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
                    <div class="col-md-1 text-end"><strong>Post</strong></div>
                    <div class="col-md-2"><strong class="ps-3">Member name</strong></div>
                    <div class="col-md-2 text-center"><strong>Recent Comment</strong></div>
                </div>

                <div class="forum-body">
                    <?php for($i=0;$i<6;$i++){ ?>
                    <div class="row">
                        <div class="col-md-1">
                            <div class="forum-img" onclick="location.href='<?= site_url('community/desc') ?>'">
                                <img src="<?= site_url('assets/images/front/webboard-forum.jpg'); ?>" alt="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h2 class="ff-semibold mb-0"> <a href="<?= site_url('community/desc') ?>" class="fs-6 text-decoration-none c-black">Name toppic <?= $i; ?></a></h2>
                            <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting in dustry. Lorem Ipsum has been</p>
                        </div>
                        <div class="col-md-1 text-end">
                            <span>60</span>
                        </div>
                        <div class="col-md-1 text-end">
                            <span>650</span>
                        </div>
                        <div class="col-md-1 text-end">
                            <span>60</span>
                        </div>
                        <div class="col-md-2">
                            <span class="ps-3">Kanokpan Lakakum</span>
                        </div>
                        <div class="col-md-2 text-center">
                            <div class="forum-date">26/12/2020</div>
                            <small>18:00 PM</small>
                        </div>
                    </div>
                    <?php } ?>
                </div>

                

            </div>
        </div>
    </section>

<?= $this->endSection() ?>