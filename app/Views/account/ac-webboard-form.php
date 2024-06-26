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
                        <div class="content-title mb-3"><strong class="ff-semibold fs-3"><?= lang('accountLang.create_wb'); ?></strong></div>
                        <form action="<?= site_url('account/webboard/save') ?>" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="hd_id" value="<?= (isset($info)?$info['id']:'') ?>">
                            <div class="form-group mb-3">
                                <select name="ddl_cate" id="ddl_cate" class="form-control">
                                    <option value="">-- <?= lang('accountLang.sl-cate') ?> --</option>
                                    <?php
                                        if($cates){
                                            foreach($cates as $cate){
                                    ?>
                                        <option value="<?= $cate['id'] ?>" <?= (isset($info) && $info['category_id']==$cate['id']?'selected':'') ?>><?= $cate['name_th'] ?></option>
                                    <?php } } ?>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" name="txt_topic" class="form-control" placeholder="<?= lang('accountLang.topic') ?>" value="<?= (isset($info)?$info['topic']:'') ?>">
                            </div>

                            <div class="form-group mb-3">
                                <textarea name="txt_desc" id="txt_desc" class="form-control" placeholder="<?= lang('accountLang.wb-detail') ?>"><?= (isset($info)?$info['desc']:'') ?></textarea>
                            </div>
                            <button type="submit" class="btn btn-black-border"><?= lang('accountLang.comfirm') ?></button>
                            <a href="<?= site_url('account/webboard') ?>" class="ff-semibold text-danger ms-5"><?= lang('accountLang.cancel') ?></a>
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