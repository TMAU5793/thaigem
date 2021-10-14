<?= $this->extend("front/app") ?>
<?= $this->section("content") ?>

    <section class="banner">
        <img src="<?= site_url('assets/images/account/banner.jpg') ?>" alt="">
    </section>    

    <section class="invoice-body mb-5">
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
                        <div class="content-title mb-3"><strong class="ff-semibold fs-3"><?= $title; ?></strong></div>
                        <form action="" method="POST">
                            <div class="form-group mb-3">
                                <select name="ddl_cate" id="ddl_cate" class="form-control">
                                    <option value="">-- select category --</option>
                                    <?php
                                        if($cates){
                                            foreach($cates as $cate){
                                    ?>
                                        <option value="<?= $cate['id'] ?>"><?= $cate['name_th'] ?></option>
                                    <?php } } ?>
                                </select>
                            </div>

                            <div class="webboard-img mb-3">
                                <div class="acform-upload text-center mb-3">
                                    
                                </div>
                                <input type="file" name="file_upload[]" class="form-control" multiple accept="image/*">
                            </div>

                            <div class="form-group mb-3">
                                <textarea name="txt_topic" id="txt_topic" class="form-control" placeholder="Webboard detail"></textarea>
                            </div>
                            <button type="button" class="btn btn-black-border">Comfirm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>    

<?= $this->endSection() ?>

<?= $this->section("scripts") ?>
    <?= $this->include('account/ac-script') ?>
<?= $this->endSection() ?>