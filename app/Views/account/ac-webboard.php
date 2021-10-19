<?= $this->extend("front/app") ?>
<?= $this->section("content") ?>

    <section class="banner">
        <img src="<?= site_url('assets/images/account/banner.jpg') ?>" alt="">
    </section>    

    <section class="webboard-body mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <?= $this->include('account/left-menu') ?>
                </div>
                <div class="col-md-9">
                    <?php
                        if (session()->get('userdata')) {
                            echo $this->include('account/ac-menu');
                        }
                    ?>
                    <div class="content-body acform-body">
                        <div class="content-title mb-3 float-start"><strong class="ff-semibold fs-3"><?= $title; ?></strong></div>
                        <div class="float-end">
                            <a href="<?= site_url('account/webboard/form') ?>" class="btn btn-primary">Create</a>
                        </div>
                        <div class="clearfix"></div>
                        <div class="mywebboard-desc">
                            <div class="webboard-item">
                                <div class="row forum-head m-0">
                                    <div class="col-md-5">
                                        <strong>Forum</strong>
                                    </div>
                                    <div class="col-md-1 text-end"><strong>Reply</strong></div>
                                    <div class="col-md-1 text-end"><strong>Read</strong></div>
                                    <div class="col-md-3 text-center"><strong>Recent Comment</strong></div>
                                    <div class="col-md-2 text-center"><strong>Managed</strong></div>
                                </div>

                                <div class="forum-body">
                                    <?php
                                        if($info){
                                            foreach($info as $row){
                                    ?>
                                        <div class="row m-0" id="<?= 'wb-'.$row['id'] ?>">
                                            <div class="col-md-5">
                                                <h2 class="ff-semibold mb-0"> <a href="<?= site_url('community/post/'.$row['id']) ?>" class="fs-6 text-decoration-none c-black"><?= $row['topic']; ?></a></h2>
                                                <p class="mb-0"><?= word_limiter(strip_tags($row['desc']),20) ?></p>
                                            </div>
                                            <div class="col-md-1 text-end">
                                                <span><?= $row['reply']; ?></span>
                                            </div>
                                            <div class="col-md-1 text-end">
                                                <span><?= $row['view']; ?></span>
                                            </div>
                                            <div class="col-md-3 text-center">
                                                <div class="forum-date"><?= substr($row['created_at'],0,10); ?></div>
                                                <small><?= substr($row['created_at'],11); ?></small>
                                            </div>
                                            <div class="col-md-2 text-center">
                                                <a href="<?= site_url('account/webboard/form?id='.$row['id']) ?>" class="text-warning fs-5 me-2" title="Edit"><i class="far fa-edit"></i></a> |
                                                <a href="javascript:void(0)" class="text-danger fs-5 ms-2" title="Delete" onclick="deletePost('<?= $row['id'] ?>','<?= site_url('account/webboard/deletePost') ?>','<?= 'wb-'.$row['id'] ?>')"><i class="far fa-trash-alt"></i></a>
                                            </div>
                                        </div>
                                    <?php } } ?>
                                </div>
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